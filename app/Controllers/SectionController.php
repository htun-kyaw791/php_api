<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\SectionModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;

class SectionController extends Controller
{
    private $sectionModel;

    public function __construct()
    {
        $this->sectionModel = new SectionModel();
    }
    public function createSection()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['name']) || empty($requestData['start_date']) || empty($requestData['end_date']) || empty($requestData['cost'])|| empty($requestData['course_ids']) ) {
            
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $existingName = $this->sectionModel->findByName($requestData['name']);
        if ($existingName) {
            $response = ResponseHelper::error('Name Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }

        $sectionData = [
            'name' => $requestData['name'],
            'start_date' => $requestData['start_date'],
            'end_date' => $requestData['end_date'],
            'cost' => $requestData['cost'],
            'course_ids' => $requestData['course_ids']
        ];
        $result = $this->sectionModel->create($sectionData);
        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updateSection($request)
    {
        // not allow teachers to update data
        if($request['user']['role'] =='teacher' && $request['user']['id'] != $request['params'][0] )
        {
            $response = ResponseHelper::error('Permission Denied', 403);
            return $this->jsonResponse($response, 403);
        }

        $Section = $this->sectionModel->findById($request['params'][0]);
        if (!$Section) 
        {
            $response = ResponseHelper::error('Course not found', 403);
            return $this->jsonResponse($response, 403);
        }

        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['name']) && empty($requestData['start_date']) && empty($requestData['end_date']) && empty($requestData['cost']) && empty($requestData['course_ids']) ) 
        {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        $existingName = $this->sectionModel->findByName($requestData['name']);
        // echo json_encode($existingName);
        if ($existingName) {
            $response = ResponseHelper::error('Name Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }
        else{
            $courseData = [
                'name' => $requestData['name'],
                'start_date' => $requestData['start_date'],
                'end_date' => $requestData['end_date'],
                'cost' => $requestData['cost'],
                'course_ids' => $requestData['course_ids']
            ];
        }
        $result = $this->sectionModel->update($request['params'][0],$courseData);

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }

    public function getSection()
    {
        $section = $this->sectionModel->fetchAll();
        echo json_encode($section);
        $response = ResponseHelper::success($section, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    // public function getPaymentById($request)
    // {
    //     $payment = $this->courseController->findById($request['params'][0]);

    //     if ($payment) {
    //         $response = ResponseHelper::success($payment, 'Data fetched successfully');
    //     } else {
    //         $response = ResponseHelper::error('Payment not found', 403);
    //     }

    //     return $this->jsonResponse($response);
    // }
    public function deleteSection($request)
    {
        $result = $this->sectionModel->delete($request['params'][0]);
        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
    