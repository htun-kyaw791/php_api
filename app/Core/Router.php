<?php

namespace Core;

class Router
{
    private $routes = [];

    public function add($path, $handler)
    {
        $this->routes[$path] = $handler;
    }

    public function dispatch($uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        if (isset($this->routes[$uri])) {
            [$controller, $method] = explode('@', $this->routes[$uri]);
            $controller = "App\\Controllers\\$controller";
            if (class_exists($controller) && method_exists($controller, $method)) {
                return call_user_func([new $controller, $method]);
            }
        }
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}
