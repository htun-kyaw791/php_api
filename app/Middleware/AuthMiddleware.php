<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserModel;
use App\Helpers\ResponseHelper;
use Dotenv\Dotenv;

class AuthMiddleware
{
    public static function authenticate($next)
    {
        return function ($request) use ($next) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
            $dotenv->load();
            
            $token = self::getTokenFromHeader();

            if (!$token) {
                $response = ResponseHelper::error('No token provided', 401);
                echo json_encode($response);
                exit;
            }

            try {
                $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
                $userModel = new UserModel();
                $user = $userModel->findById($decoded->userId);

                if (!$user) {
                    $response = ResponseHelper::error('User not found', 401);
                    echo json_encode($response);
                    exit;
                }

                $request['user'] = $user;
                return $next($request);
            } catch (\Exception $e) {
                $response = ResponseHelper::error('Invalid token', 401);
                echo json_encode($response);
                exit;
            }
        };
    }

    public static function authorize(...$roles)
    {
        return function ($request) use ($roles) {
            if (!isset($request['user'])) {
                $response = ResponseHelper::error('Unauthorized', 401);
                echo json_encode($response);
                exit;
            }

            if (!in_array($request['user']['role'], $roles)) {
                $response = ResponseHelper::error('Forbidden', 403);
                echo json_encode($response);
                exit;
            }

            return $request;
        };
    }

    private static function getTokenFromHeader()
    {
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            return str_replace('Bearer ', '', $headers['Authorization']);
        }
        return null;
    }
}