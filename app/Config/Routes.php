<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');
$routes->add('/timein', 'AttendanceController::TimeIn');
$routes->post('/timein', 'AttendanceController::TimeIn');
$routes->get('/timeout', 'AttendanceController::TimeOut');
$routes->post('/location', 'AttendanceController::Location');
$routes->post('/send_in', 'AttendanceController::Send_In');
$routes->post('/send_out', 'AttendanceController::Send_Out');
$routes->post('/loginvalidation', 'LoginValidation::Sign_in');
$routes->get('/loginvalidation', 'LoginValidation::Sign_in');
$routes->add('/destroy', 'Home::session_destroyer');
$routes->get('/dashboard', 'Home::dashboard');
// app/Config/Routes.php
$routes->get('/capture', 'Image::capture');
$routes->post('/image/upload', 'Image::upload');
$routes->get('/image/upload', 'Image::upload');




