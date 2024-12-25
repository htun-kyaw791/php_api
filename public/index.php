<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();

// Define routes
$router->add('/api/data', 'ApiController@getData');
$router->add('/api/data/create', 'ApiController@createData');

// Dispatch the route
$router->dispatch($_SERVER['REQUEST_URI']);
