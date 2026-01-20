<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');
$routes->add('/timein', 'AttendanceController::TimeIn');
$routes->get('/timeout', 'AttendanceController::TimeOut');
$routes->post('/location', 'AttendanceController::Location');
$routes->post('/send_in', 'AttendanceController::Send_In');
$routes->add('/loginvalidation', 'LoginValidation::Sign_in');


