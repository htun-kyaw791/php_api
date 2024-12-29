<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\PaymentTypeModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;
use App\Models\UserModel;

class PaymentTypeController extends Controller
{
    private $paymentTypeModel;

    public function __construct()
    {
        $this->paymentTypeModel = new PaymentTypeModel();
    }

    public function createPaymentType()
    {
        $requestData = $_POST;
        if ( empty($requestData['paymenttypename']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        $file = $_FILES['paymenttypeimage'] ?? null;
        // echo json_encode($file);
        if ($file) {
            $uploadedFile = FileHelper::uploadFile($file, 'uploads/paymentType/');
            if (!$uploadedFile) {
                $response = ResponseHelper::error('Failed to upload image', 500);
                return $this->jsonResponse($response, 500);
            }
            $requestData['paymenttypeimage'] = $uploadedFile;
        } else {
            echo "I am here";
            $response = ResponseHelper::error('Payment type image is required', 400);
            return $this->jsonResponse($response, 400);
        }
        $result = $this->paymentTypeModel->create($requestData);
        $response = ResponseHelper::success($result, 'Payment type name submitted successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updatePaymentType($request)
    {
        $requestData = $_POST;       
        if (empty($requestData['paymenttypename']) ) 
        {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $file = $_FILES['paymenttypeimage'] ?? null;
        if ($file) {
            $uploadedFile = FileHelper::uploadFile($file, 'uploads/paymentType/');
            if (!$uploadedFile) {
                $response = ResponseHelper::error('Failed to upload image', 500);
                return $this->jsonResponse($response, 500);
            }
            $requestData['image'] = $uploadedFile;
        } 
        $paymentTypeData = [
            'paymenttypename' => $requestData['paymenttypename'],
            'paymenttypeimage' => $requestData['image']
        ];
        

        $result = $this->paymentTypeModel->update($request['params'][0],$paymentTypeData);
        
        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }
    public function getPaymentType()
    {
        $paymentType = $this->paymentTypeModel->fetchAll();
        $response = ResponseHelper::success($paymentType, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function getPaymentById($request)
    {
        $payment = $this->paymentTypeModel->findById($request['params'][0]);

        if ($payment) {
            $response = ResponseHelper::success($payment, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Payment not found', 403);
        }

        return $this->jsonResponse($response);
    }
    public function deletePaymentType($request)
    {
        
        // $requestData = $_POST; 
        $paymentType = $this->paymentTypeModel->findPaymentTypeId($request['params'][0]);
        // $admin = $this->paymentTypeModel->findById($request['params'][0]);
        // if(!$admin)
        // {
        //     $response = ResponseHelper::error('Admin not found', 403);
        //     return $this->jsonResponse($response, 403);
        // }

        $this->paymentTypeModel->delete($request['params'][0]);
        $result = $this->paymentTypeModel->delete($paymentType['paymentypeid']);

        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
