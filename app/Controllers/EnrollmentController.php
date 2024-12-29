<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\EnrollmentModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;
defined('BASEPATH') OR exit('No direct script access allowed');

class EnrollmentController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('EnrollmentModel');
        $this->load->model('SectionModel');
        $this->enrollmentModel = new EnrollmentModel();
    }
// class EnrollmentController extends Controller
// {
//     private $enrollmentModel;

//     public function __construct()
//     {
//         parent::__construct();
//         $this->load->model('EnrollmentModel');
//         $this->load->model('SectionModel');
//         $this->enrollmentModel = new EnrollmentModel();
//     }

    public function createEnrollment()
    {
        $section_id = $this->input->post('section_id');
        $student_id = $this->input->post('student_id');

        $section = $this->sectionModel->getSectionById($section_id);
        if (!$section) {
            // Section not found
            $this->output->set_status_header(400);
            echo json_encode(['error' => 'Invalid section ID']);
            return;
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        // echo json_encode($requestData);
        if (empty($requestData['student_id']) || empty($requestData['section_id']) ) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        
        $enrollmentData = [
            'student_id' => $requestData['student_id'],
            'section_id' => $requestData['section_id'],
            'amount' => $section['amount']            
        ];
        $result = $this->enrollmentModel->create($enrollmentData);
        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updateEnrollment($request)
    {
        $enrollment = $this->enrollmentModel->findById($request['params'][0]);
        if (!$enrollment) {
            $response = ResponseHelper::error('Enrollment not found', 403);
            return $this->jsonResponse($response, 403);
        }
        $enrollmentData = [
            'student_id' => $requestData['student_id'],
            'section_id' => $requestData['section_id'],
            'amount' => $requestData['amount'],
            
        ];
        $result = $this->enrollmentModel->create($enrollmentData);
        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
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
}
