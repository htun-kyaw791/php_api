<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\CourseModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;

class CourseController extends Controller
{
    private $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }
    public function createCourse()
    {
        $requestData = $_POST;
        
        if (empty($requestData['name']) || empty($requestData['description']) || empty($requestData['teacher_id']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $file = $_FILES['image'] ?? null;
        if ($file) {
            $uploadedFile = FileHelper::uploadFile($file, 'uploads/course/');
            if (!$uploadedFile) {
                $response = ResponseHelper::error('Failed to upload image', 500);
                return $this->jsonResponse($response, 500);
            }
            $requestData['image'] = $uploadedFile;
        } else {
            $response = ResponseHelper::error('Evidence image is required', 400);
            return $this->jsonResponse($response, 400);
        }

        $existingName = $this->courseModel->findByName($requestData['name']);
        // echo json_encode($existingName);
        if ($existingName) {
            $response = ResponseHelper::error('Name Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }

        $courseData = [
            'name' => $requestData['name'],
            'image' => $requestData['image'],
            'description' => $requestData['description'],
            'teacher_id' => $requestData['teacher_id']
        ];
        $result = $this->courseModel->create($courseData);
        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updateCourse($request)
    {
        $requestData = $_POST;
        // not allow teachers to update data
        if($request['user']['role'] =='teacher' && $request['user']['id'] != $request['params'][0]  )
        {
            $response = ResponseHelper::error('Permission Denied', 403);
            return $this->jsonResponse($response, 403);
        }

        $Course = $this->courseModel->findById($request['params'][0]);
        if (!$Course) 
        {
            $response = ResponseHelper::error('Course not found', 403);
            return $this->jsonResponse($response, 403);
        }
        $file = $_FILES['image'] ?? null;
        if ($file) {
            $uploadedFile = FileHelper::uploadFile($file, 'uploads/course/');
            if (!$uploadedFile) {
                $response = ResponseHelper::error('Failed to upload image', 500);
                return $this->jsonResponse($response, 500);
            }
                $oldCourse = $this->courseModel->findById($request['params'][0]);
                // echo ('uploads/course/'.$oldCourse['image']);
                FileHelper::deleteFile('uploads/course/'.$oldCourse['image']);
                $requestData['image'] = $uploadedFile;

        } 
        if (empty($requestData['name']) && empty($requestData['description']) && empty($requestData['teacher_id']) ) 
        // in_array($requestData['status'], ['pending', 'confirmed', 'rejected'])
        {
            echo json_encode($requestData['name']);
            echo json_encode($requestData['description']);
            echo json_encode($requestData['teacher_id']);
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        else{
            $courseData = [
                'name' => $requestData['name'],
                'image' => $requestData['image'],
                'description' => $requestData['description'],
                'teacher_id' => $requestData['teacher_id']
            ];
        }
        $result = $this->courseModel->update($request['params'][0],$courseData);

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }

    public function getCourse()
    {
        $courses = $this->courseModel->fetchAll();
        $response = ResponseHelper::success($courses, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function getCourseById($request)
    {
        $course = $this->courseModel->findById($request['params'][0]);
        if ($course) {
            $response = ResponseHelper::success($course, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Course not found', 403);
        }

        return $this->jsonResponse($response);
    }
    public function getTeacherByID($request)
    {
        $teacher = $this->courseModel->findByTeacherId($request['params'][0]);
        if ($teacher) {
            $response = ResponseHelper::success($teacher, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Teacher not found', 403);
        }

        return $this->jsonResponse($response);
    }
    
    public function deleteCourse($request)
    {
        $result = $this->courseModel->delete($request['params'][0]);
        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
    