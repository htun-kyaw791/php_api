<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\UserModel;
use App\Helpers\ResponseHelper;
use App\Models\StudentModel;
class UserController extends Controller
{
    private $userModel, $studentModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();

    }

    public function getTeacher()
    {
        $filters = [
            'role' => 'teacher', // Filter by role
            // 'email' => ['example1@test.com', 'example2@test.com'], // Filter by multiple emails
        ];
    
        $filteredUsers = $this->userModel->filter($filters);

        $response = ResponseHelper::success($filteredUsers, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function getTeacherById($request)
    {
        $data = $this->userModel->findTeacherId($request['params'][0]);

        if($data){
            $response = ResponseHelper::success($data, 'Data fetched successfully');
            return $this->jsonResponse($response);
        }else{
            $response = ResponseHelper::error('Teacher not found', 403);
            return $this->jsonResponse($response, 403);
        }
        
    }

    public function createTeacher()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['name']) || empty($requestData['email']) || empty($requestData['password']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $existingUser = $this->userModel->findByEmail($requestData['email']);
        if ($existingUser) {
            $response = ResponseHelper::error('User Email Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }
        

        $hashedPassword = password_hash($requestData['password'], PASSWORD_DEFAULT);


        $userData = [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => $hashedPassword,
            'role' => 'teacher'
        ];

        $result = $this->userModel->create($userData);

        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updateTeacher($request)
    {
        // if($request['user']['role'] =='teacher' && $request['user']['id'] != $request['params'][0]  )
        // {
        //     $response = ResponseHelper::error('Permission Denied', 403);
        //     return $this->jsonResponse($response, 403);
        // }
        // check if user exist and user is teacher
        $user = $this->userModel->findTeacherId($request['params'][0]);
        if(!$user || $user['role'] !== 'teacher'){
            $response = ResponseHelper::error('Teacher not found', 403);
            return $this->jsonResponse($response, 403);
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['name']) || empty($requestData['email']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $existingUser = $this->userModel->findByEmail($requestData['email']);
        if ($existingUser && $existingUser['id'] != $request['params'][0]) {
            $response = ResponseHelper::error('User Email Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }
        if(!empty($requestData['password'])){
            $hashedPassword = password_hash($requestData['password'], PASSWORD_DEFAULT);
            $userData = [
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'password' => $hashedPassword,
                'role' => 'teacher'
            ];
        }else{
            $userData = [
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'role' => 'teacher'
            ];
        }
        $result = $this->userModel->update($request['params'][0],$userData);

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }

    public function deleteTeacher($request)
    {
        $user = $this->userModel->findTeacherId($request['params'][0]);
        // check if user exist and user is teacher
        if(!$user || $user->role == 'teacher'){
            $response = ResponseHelper::error('Teacher not found', 403);
            return $this->jsonResponse($response, 403);
        }

        $result = $this->userModel->delete($request['params'][0]);

        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }

    public function getStudent()
    {
    
        $filteredUsers = $this->studentModel->fetchAll();

        $response = ResponseHelper::success($filteredUsers, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function getStudentById($request)
    {
        $data = $this->studentModel->findById($request['params'][0]);
        if($data){
            $response = ResponseHelper::success($data, 'Data fetched successfully');
            return $this->jsonResponse($response);
        }else{
            $response = ResponseHelper::error('Student not found', 403);
            return $this->jsonResponse($response, 403);
        }
        
    }

    public function updateStudent($request)
    {
        //check if user exist and user is student
        $student = $this->studentModel->findById($request['params'][0]);
        if(!$student){
            $response = ResponseHelper::error('Student not found', 403);
            return $this->jsonResponse($response, 403);
        }
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['name']) || empty($requestData['email']) || empty($requestData['nrc_id']) || empty($requestData['date_of_birth']) || empty($requestData['gender']) || empty($requestData['phone_number']) || empty($requestData['address']) || empty($requestData['guardian_name']) || empty($requestData['guardian_contact']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        $existingUser = $this->userModel->findByEmail($requestData['email']);
        if ($existingUser && $existingUser['id'] != $student['user_id']) {
            $response = ResponseHelper::error('User Email Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }

        if(!empty($requestData['password'])){
            $hashedPassword = password_hash($requestData['password'], PASSWORD_DEFAULT);
            $userData = [
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'password' => $hashedPassword,
                'role' => 'student'
            ];
        }else{
            $userData = [
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'role' => 'student'
            ];
        }


        $reaponse = $this->userModel->update($student['user_id'],$userData);
        if (!$reaponse) {
            $response = ResponseHelper::error('Failed to update user', 500);
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
                'user_id' => $student['user_id']
            ];
    
            $result = $this->studentModel->update($request['params'][0],$studentData);
        }

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }

    public function deleteStudent($request)
    {
        $student = $this->studentModel->findById($request['params'][0]);
        //check if user exist and user is student
        if(!$student){
            $response = ResponseHelper::error('Student not found', 403);
            return $this->jsonResponse($response, 403);
        }

        $this->studentModel->delete($request['params'][0]);
        $result = $this->userModel->delete($student['user_id']);

        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}

