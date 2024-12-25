<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ApiModel;
use App\Helpers\ResponseHelper;

class ApiController extends Controller
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

        if (empty($requestData['name'])) {
            $response = ResponseHelper::error('Name is required', 422);
            return $this->jsonResponse($response, 422);
        }

        $model = new ApiModel();
        $result = $model->saveData($requestData);

        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }
}
