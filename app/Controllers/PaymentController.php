<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\PaymentModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;

class PaymentController extends Controller
{
    private $paymentModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
    }

    public function createPayment()
    {

        $requestData = $_POST;
        echo $requestData;
        if (empty($requestData['payment_type_id']) || empty($requestData['student_id']) || empty($requestData['enrollment_id']) || empty($requestData['amount'])) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $file = $_FILES['evidence_image'] ?? null;
        if ($file) {
            $uploadedFile = FileHelper::uploadFile($file, 'uploads/evidence/');
            if (!$uploadedFile) {
                $response = ResponseHelper::error('Failed to upload image', 500);
                return $this->jsonResponse($response, 500);
            }
            $requestData['evidence_image'] = $uploadedFile;
        } else {
            $response = ResponseHelper::error('Evidence image is required', 400);
            return $this->jsonResponse($response, 400);
        }

        $requestData['status'] = 'pending';

        $result = $this->paymentModel->create($requestData);
        $response = ResponseHelper::success($result, 'Payment submitted successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updatePayment($request)
    {
        $payment = $this->paymentModel->findById($request['params'][0]);
        if (!$payment) {
            $response = ResponseHelper::error('Payment not found', 403);
            return $this->jsonResponse($response, 403);
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        if (!empty($requestData['status']) && in_array($requestData['status'], ['pending', 'confirmed', 'rejected'])) {
            $result = $this->paymentModel->updateStatus($request['params'][0], $requestData['status']);

            if ($result) {
                $response = ResponseHelper::success($result, 'Payment updated successfully');
            } else {
                $response = ResponseHelper::error('Failed to update payment', 500);
            }

            return $this->jsonResponse($response);
        }

        $response = ResponseHelper::error('Invalid status', 400);
        return $this->jsonResponse($response, 400);
    }

    public function getPayments()
    {
        $payments = $this->paymentModel->fetchAll();
        $response = ResponseHelper::success($payments, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }

    public function getPaymentById($request)
    {
        $payment = $this->paymentModel->findById($request['params'][0]);

        if ($payment) {
            $response = ResponseHelper::success($payment, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Payment not found', 403);
        }

        return $this->jsonResponse($response);
    }
}
