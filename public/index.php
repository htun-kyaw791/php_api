<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();

// Define routes
$router->add('/api/data', 'ApiController@getData');
$router->add('/api/data/create', 'ApiController@createData');
$router->add('/api/data/update', 'ApiController@updateData');
$router->add('/api/data/delete', 'ApiController@deleteData');

// staff role
$router->add('/api/staff-role', 'StaffRoleController@getData');
$router->add('/api/staff-role/create', 'StaffRoleController@createData');
$router->add('/api/staff-role/update', 'StaffRoleController@updateData');
$router->add('/api/staff-role/delete', 'StaffRoleController@deleteData');

// staff 
$router->add('/api/staff', 'StaffController@getData');
$router->add('/api/staff/create', 'StaffController@createData');
$router->add('/api/staff/update', 'StaffController@updateData');
$router->add('/api/staff/delete', 'StaffController@deleteData');

// Dispatch the route
$router->dispatch($_SERVER['REQUEST_URI']);

