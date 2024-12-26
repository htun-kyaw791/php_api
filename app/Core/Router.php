<?php

namespace Core;

class Router
{
    private $routes = [];

    public function add($method, $path, $handler, $middleware = [])
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function dispatch($uri, $method)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            $pattern = $this->convertRouteToRegex($route['path']);
            if (preg_match($pattern, $uri, $matches) && $route['method'] === $method) {
                array_shift($matches); // Remove the full match
                [$controller, $action] = explode('@', $route['handler']);
                $controller = "App\\Controllers\\$controller";
                
                if (class_exists($controller) && method_exists($controller, $action)) {
                    $request = ['params' => $matches];
                    
                    // Apply middleware
                    foreach ($route['middleware'] as $middleware) {
                        $request = $middleware($request);
                    }
                    
                    return call_user_func_array([new $controller, $action], [$request]);
                }
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    private function convertRouteToRegex($route)
    {
        return '#^' . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route) . '$#';
    }
}