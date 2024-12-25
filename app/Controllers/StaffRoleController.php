<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\StaffRoleModel;
use App\Helpers\ResponseHelper;

class StaffRoleController extends Controller
{
    public function getData()
    {
        $model = new ApiModel();
        $data = $model->fetchData();

        $response = ResponseHelper::success($data, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function createData()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['Rolename'])) {
            $response = ResponseHelper::error('Name is required', 422);
            return $this->jsonResponse($response, 422);
        }

        $model = new StaffRoleModel();
        $result = $model->saveData($requestData);

        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }
    public function updateData()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['name'])) {
            $response = ResponseHelper::error('Name is required', 422);
            return $this->jsonResponse($response, 422);
        }
        if (empty($requestData['RoleID'])) {
            $response = ResponseHelper::error('RoleID is required', 422);
            return $this->jsonResponse($response, 422);
        }
        $model = new ApiModel();
        $result = $model->updateData($requestData['RoleID'], $requestData);

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
        if (empty($requestData['RoleID'])) {
            $response = ResponseHelper::error('RoleID is required', 422);
            return $this->jsonResponse($response, 422);
        }
        $model = new ApiModel();
        $result = $model->deleteData($requestData['RoleID']);

        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
