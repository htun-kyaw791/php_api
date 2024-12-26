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
    AuthMiddleware::authorize('admin')
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









// Dispatch the route
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);