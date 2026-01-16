<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/home', 'Home::index');
$routes->get('/timein', 'AttendanceController::TimeIn');
$routes->get('/timeout', 'AttendanceController::TimeOut');
$routes->get('/location', 'AttendanceController::Location');
$routes->add('/loginvalidation', 'LoginValidation::Sign_in');


