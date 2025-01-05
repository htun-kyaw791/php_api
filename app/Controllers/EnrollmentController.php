<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\EnrollmentModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;
class EnrollmentController extends Controller {
    private $enrollmentModel;

    public function __construct()
    {
        $this->enrollmentModel = new EnrollmentModel();    
    }
    public function createEnrollment()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['student_id']) || empty($requestData['section_id']) || empty($requestData['amount']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        $enrollmentData = [
            'student_id' => $requestData['student_id'],
            'section_id' => $requestData['section_id'],
            'amount' => $requestData['amount']    
        ];
        $result = $this->enrollmentModel->create($enrollmentData);
        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updateEnrollment($request)
    {
        if($request['user']['role'] =='teacher' && $request['user']['id'] != $request['params'][0] )
        {
            $response = ResponseHelper::error('Permission Denied', 403);
            return $this->jsonResponse($response, 403);
        }
        $Enrollment = $this->enrollmentModel->findById($request['params'][0]);
        if (!$Enrollment) 
        {
            $response = ResponseHelper::error('enrollment not found', 403);
            return $this->jsonResponse($response, 403);
        }
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['student_id']) && empty($requestData['section_id']) && empty($requestData['amount']) ) 
        {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        else
        {
            $enrollmentData = [
                'student_id' => $requestData['student_id'],
                'section_id' => $requestData['section_id'],
                'amount' => $requestData['amount']                
            ];
        }
        $result = $this->enrollmentModel->update($request['params'][0],$enrollmentData);

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }


    public function getEnrollment()
    {
        $enrollment = $this->enrollmentModel->fetchAll();
        $response = ResponseHelper::success($enrollment, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function getEnrollmentById($request)
    {
        $enrollment = $this->enrollmentModel->findById($request['params'][0]);

        if ($enrollment) {
            $response = ResponseHelper::success($enrollment, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Payment not found', 403);
        }

        return $this->jsonResponse($response);
    }
    public function deleteEnrollment($request)
    {
        $result = $this->enrollmentModel->delete($request['params'][0]);
        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
