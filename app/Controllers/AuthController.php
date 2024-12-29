<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\UserModel;
use App\Helpers\ResponseHelper;
use Firebase\JWT\JWT;
use App\Models\StudentModel;

class AuthController extends Controller
{
    private $userModel, $studentModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();

    }

    public function register()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['name']) || empty($requestData['email']) || empty($requestData['password']) || empty($requestData['nrc_id']) || empty($requestData['date_of_birth']) || empty($requestData['gender']) || empty($requestData['phone_number']) || empty($requestData['address']) || empty($requestData['guardian_name']) || empty($requestData['guardian_contact']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $existingUser = $this->userModel->findByEmail($requestData['email']);
        if ($existingUser) {
            $response = ResponseHelper::error('User Email Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }

        if (strpos($requestData['email'], '@gmail.com') === false) {
            $response = ResponseHelper::error('Email must be a Gmail address', 400);
            return $this->jsonResponse($response, 400);
        }

        $hashedPassword = password_hash($requestData['password'], PASSWORD_DEFAULT);
        $userData = [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $hashedPassword,
            'role' => 'student'
        ];

        $userId = $this->userModel->create($userData);
        if (!$userId) {
            $response = ResponseHelper::error('Failed to create user', 500);
            return $this->jsonResponse($response, 500);
        }else{
            $studentData = [
                'nrc_id' => $requestData['nrc_id'],
                'date_of_birth' => $requestData['date_of_birth'],
                'gender' => $requestData['gender'],
                'phone_number' => $requestData['phone_number'],
                'address' => $requestData['address'],
                'guardian_name' => $requestData['guardian_name'],
                'guardian_contact' => $requestData['guardian_contact'],
                'user_id' => $userId
            ];
    
            $this->studentModel->create($studentData);
        }

        $token = $this->generateToken($userId);
        $this->userModel->createAccessToken($userId, $token);

        $response = ResponseHelper::success([
            'user' => [
                'id' => $userId,
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role']
            ],
            'student' => $studentData,
            'token' => $token
        ], 'User registered successfully', 201);

        return $this->jsonResponse($response, 201);
    }

    public function login()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['email']) || empty($requestData['password'])) {
            $response = ResponseHelper::error('Missing email or password', 400);
            return $this->jsonResponse($response, 400);
        }

        $user = $this->userModel->findByEmail($requestData['email']);
        if (!$user || !password_verify($requestData['password'], $user['password'])) {
            $response = ResponseHelper::error('Invalid credentials', 401);
            return $this->jsonResponse($response, 401);
        }

        $token = $this->generateToken($user['id']);
        $this->userModel->createAccessToken($user['id'], $token);

        $response = ResponseHelper::success([
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ],
            'token' => $token
        ], 'Login successful');

        return $this->jsonResponse($response);
    }

    public function logout()
    {
        $token = $this->getTokenFromHeader();

        if (!$token) {
            $response = ResponseHelper::error('No token provided', 401);
            return $this->jsonResponse($response, 401);
        }

        $result = $this->userModel->deleteAccessToken($token);

        if ($result) {
            $response = ResponseHelper::success(null, 'Logged out successfully');
        } else {
            $response = ResponseHelper::error('Failed to logout', 500);
        }

        return $this->jsonResponse($response);
    }

    private function generateToken($userId)
    {
        $payload = [
            'iss' => 'your_app_name',
            'aud' => 'your_app_audience',
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24), // 24 hours
            'userId' => $userId
        ];

        return JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
    }

    private function getTokenFromHeader()
    {
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            return str_replace('Bearer ', '', $headers['Authorization']);
        }
        return null;
    }
}