<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\SubjectModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;

class SubjectController extends Controller
{
    private $subjectModel;

    public function __construct()
    {
        $this->subjectModel = new SubjectModel();
    }
    public function createSubject()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['name']) || empty($requestData['course_id'])  ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $existingName = $this->subjectModel->findByName($requestData['name']);
        if ($existingName) {
            $response = ResponseHelper::error('Name Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }

        $subjectData = [
            'name' => $requestData['name'],
            'course_id' => $requestData['course_id']
        ];
        $result = $this->subjectModel->create($subjectData);
        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updateSubject($request)
    {
        // not allow teachers to update data
        if($request['user']['role'] =='teacher' && $request['user']['id'] != $request['params'][0]  )
        {
            $response = ResponseHelper::error('Permission Denied', 403);
            return $this->jsonResponse($response, 403);
        }

        $Subject = $this->subjectModel->findById($request['params'][0]);
        if (!$Subject) 
        {
            $response = ResponseHelper::error('Subject not found', 403);
            return $this->jsonResponse($response, 403);
        }

        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['name']) && empty($requestData['course_id']) ) 
        {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        $existingName = $this->subjectModel->findByName($requestData['name']);
        if ($existingName) {
            $response = ResponseHelper::error('Name Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }
        else{
            $subjectData = [
                'name' => $requestData['name'],
                'course_id' => $requestData['course_id']
            ];
        }
        $result = $this->subjectModel->update($request['params'][0],$subjectData);

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }


    public function getSubject()
    {
        $subjects = $this->subjectModel->fetchAll();
        $response = ResponseHelper::success($subjects, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }
    public function getSubjectById($request)
    {
        $subject = $this->subjectModel->findById($request['params'][0]);
        if ($subject) {
            $response = ResponseHelper::success($subject, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Subject not found', 403);
        }

        return $this->jsonResponse($response);
    }
    public function getTeacherByID($request)
    {
        $subject = $this->subjectModel->findByTeacherId($request['params'][0]);
        if ($subject) {
            $response = ResponseHelper::success($subject, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Subject not found', 403);
        }

        return $this->jsonResponse($response);
    }
    public function deleteSubject($request)
    {
        $result = $this->subjectModel->delete($request['params'][0]);
        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
    