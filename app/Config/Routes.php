<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// Auth
$routes->get('/', 'AuthController::index');
$routes->post('login', 'AuthController::login');

$routes->group('admin', static function ($routes) {
    $routes->get('users', 'Admin\Users::index');
});
