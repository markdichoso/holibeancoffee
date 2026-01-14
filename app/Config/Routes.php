<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/timein', 'AttendanceController::TimeIn');
$routes->get('/timeout', 'AttendanceController::TimeOut');
$routes->get('/location', 'AttendanceController::Location');
$routes->get('/login', 'LoginController::Sign_in');

