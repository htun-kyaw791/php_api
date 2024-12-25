<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\StaffModel;
use App\Helpers\ResponseHelper;

class StaffController extends Controller
{
    public function getData()
    {
        $model = new StaffModel();
        $data = $model->fetchData();

        $response = ResponseHelper::success($data, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function createData()
    {
        
        $requestData = json_decode(file_get_contents('php://input'), true);
        // $requestData['file']
        // fileupload
        // $requestData['filename']=file name
        $model = new StaffModel();
        $result = $model->saveData($requestData);

        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }
    public function updateData()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['id'])) {
            $response = ResponseHelper::error('id is required', 422);
            return $this->jsonResponse($response, 422);
        }
        $model = new StaffModel();
        $result = $model->updateData($requestData['id'], $requestData);

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }
    public function deleteData()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['id'])) {
            $response = ResponseHelper::error('id is required', 422);
            return $this->jsonResponse($response, 422);
        }
        $model = new StaffModel();
        $result = $model->deleteData($requestData['id']);

        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
