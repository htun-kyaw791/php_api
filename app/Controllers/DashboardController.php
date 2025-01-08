<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\SectionModel;
use App\Models\EnrollmentModel;
use App\Models\PaymentModel;
use App\Models\StudentModel;
use App\Helpers\ResponseHelper;

class DashboardController extends Controller
{
    private $sectionModel;
    private $enrollmentModel;
    private $paymentModel;
    private $studentModel;

    public function __construct()
    {
        $this->sectionModel = new SectionModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->paymentModel = new PaymentModel();
        $this->studentModel = new StudentModel();
    }
    
    public function getAdminDashboard()
    {
        $sections = $this->sectionModel->withEnrollmentCount();
        $paymentSummary = $this->paymentModel->getPaymentSummary();
        $revenueByPaymentType = $this->paymentModel->revenueByPaymentType();
        $enrollmentTrends = $this->enrollmentModel->dailyEnrollmentTrends();
        $totalEnrollments = $this->enrollmentModel->totalEnrollments();
        $studentCount = $this->studentModel->totalStudents();
        $genderBreakdown = $this->studentModel->genderBreakdown();
        $recentRegistrations = $this->studentModel->recentRegistrations();

        // Combine all data for response
        $data = [
            'sections' => $sections,
            'paymentSummary' => $paymentSummary,
            'revenueByPaymentType' => $revenueByPaymentType,
            'enrollmentTrends' => $enrollmentTrends,
            'totalEnrollments' => $totalEnrollments,
            'studentCount' => $studentCount,
            'genderBreakdown' => $genderBreakdown,
            'recentRegistrations' => $recentRegistrations,
        ];
        $response = ResponseHelper::success($data, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }
}
