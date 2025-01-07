<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use App\Middleware\AuthMiddleware;

$router = new Router();

// Auth routes
$router->add('POST', '/api/auth/register', 'AuthController@register');
$router->add('POST', '/api/auth/login', 'AuthController@login');
$router->add('POST', '/api/auth/logout', 'AuthController@logout', [AuthMiddleware::authenticate(function($request) { return $request; })]);



// Teacher routes
$router->add('GET', '/api/teacher', 'UserController@getTeacher', [AuthMiddleware::authenticate(function($request) { return $request; })]);
$router->add('GET', '/api/teacher/{id}', 'UserController@getTeacherById', [AuthMiddleware::authenticate(function($request) { return $request; })]);
$router->add('POST', '/api/teacher/create', 'UserController@createTeacher', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);
$router->add('PUT', '/api/teacher/update/{id}', 'UserController@updateTeacher', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin','teacher')
]);
$router->add('DELETE', '/api/teacher/delete/{id}', 'UserController@deleteTeacher', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);


//Student routes
$router->add('GET', '/api/student', 'UserController@getStudent', [AuthMiddleware::authenticate(function($request) { return $request; })]);
$router->add('GET', '/api/student/{stu_id}', 'UserController@getStudentById', [AuthMiddleware::authenticate(function($request) { return $request; })]);
$router->add('PUT', '/api/student/update/{stu_id}', 'UserController@updateStudent', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin','student')
]);
$router->add('DELETE', '/api/student/delete/{stu_id}', 'UserController@deleteStudent', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin','student')
]);






//payment routes
// Student submits payment
$router->add('POST', '/api/payment/create', 'PaymentController@createPayment', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('student')
]);

// Admin updates payment status
$router->add('PUT', '/api/payment/update/{id}', 'PaymentController@updatePayment', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

// Fetch all payments (admin only)
$router->add('GET', '/api/payment', 'PaymentController@getPayments', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

// Fetch specific payment by ID
$router->add('GET', '/api/payment/{id}', 'PaymentController@getPaymentById', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin', 'student')
]);
$router->add('GET', '/api/payment/{student_id}', 'PaymentController@getStudentById', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);


//payment_type routes
// Student submits payment
$router->add('POST', '/api/payment-type/create', 'PaymentTypeController@createPaymentType', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

// Admin updates payment status
$router->add('POST', '/api/payment-type/update/{id}', 'PaymentTypeController@updatePaymentType', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('DELETE', '/api/payment-type/delete/{id}', 'PaymentTypeController@deletePaymentType', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);


// Fetch all payments (admin only)
$router->add('GET', '/api/payment-type', 'PaymentTypeController@getPaymentType', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

// Fetch all payments (admin only)
$router->add('GET', '/api/payment-type/{id}', 'PaymentTypeController@getPaymentTypeById', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

//course
$router->add('POST', '/api/course/create', 'CourseController@createCourse', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('POST', '/api/course/update/{id}', 'CourseController@updateCourse', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('DELETE', '/api/course/delete/{id}', 'CourseController@deleteCourse', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);


$router->add('GET', '/api/course', 'CourseController@getCourse', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('GET', '/api/course/{id}', 'CourseController@getCourseById', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize()
]);
// 'admin'

$router->add('GET', '/api/course-subject/{id}', 'CourseController@getTeacherByID', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin','teacher')
]);
// getTeacherByID
//subject
$router->add('POST', '/api/subject/create', 'SubjectController@createSubject', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('POST', '/api/subject/update/{id}', 'SubjectController@updateSubject', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('DELETE', '/api/subject/delete/{id}', 'SubjectController@deleteSubject', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('GET', '/api/subject', 'SubjectController@getSubject', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('GET', '/api/subject/{id}', 'SubjectController@getSubjectById', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);
$router->add('GET', '/api/subject-teacher/{id}', 'SubjectController@getTeacherByID', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin', 'teacher')
]);

// getTeacherByID

//section
$router->add('POST', '/api/section/create', 'SectionController@createSection', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('POST', '/api/section/update/{id}', 'SectionController@updateSection', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('DELETE', '/api/section/delete/{id}', 'SectionController@deleteSection', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);


$router->add('GET', '/api/section', 'SectionController@getSection');
// , 
// [
//     AuthMiddleware::authenticate(function($request) { return $request; }),
//     AuthMiddleware::authorize('admin')
// ]);

$router->add('GET', '/api/section/{id}', 'SectionController@getSectionById', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);



//enrollment
$router->add('POST', '/api/enrollment/create', 'EnrollmentController@createEnrollment', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('student')
]);

$router->add('POST', '/api/enrollment/update/{id}', 'EnrollmentController@updateEnrollment', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('DELETE', '/api/enrollment/delete/{id}', 'EnrollmentController@deleteEnrollment', [
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin')
]);

$router->add('GET', '/api/enrollment', 'EnrollmentController@getEnrollment', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin', 'student')
]);

$router->add('GET', '/api/enrollment/{id}', 'EnrollmentController@getEnrollment', 
[
    AuthMiddleware::authenticate(function($request) { return $request; }),
    AuthMiddleware::authorize('admin', 'student')
]);

// Allow from all origins
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Dispatch the route
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);