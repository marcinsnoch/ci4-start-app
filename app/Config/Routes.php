<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->addRedirect('/', 'home');
$routes->get('terms-and-conditions', 'Terms::index');
$routes->get('logout', 'Auth::logout');

$routes->match(['get', 'post'], 'login', 'Auth::login', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'register', 'Auth::register', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'forgot-password', 'Auth::forgotPassword', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'reset-password', 'Auth::resetPassword', ['filter' => 'noauth']);
$routes->get('activation', 'Auth::activation', ['filter' => 'noauth']);

//Auth required
$routes->get('home', 'Home::index', ['filter' => 'auth']);
$routes->get('search', 'Search::index', ['filter' => 'auth']);

$routes->get('profile', 'Profile::index', ['filter' => 'auth']);
$routes->post('profile', 'Profile::update', ['filter' => 'auth']);

$routes->get('products/table_data', 'Products::table_data', ['filter' => 'auth']);
$routes->presenter('products', ['filter' => 'auth']);
