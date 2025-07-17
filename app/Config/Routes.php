<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Vote');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Auth
$routes->get('auth/login', 'Auth\Auth::login');
$routes->post('auth/attemptLogin', 'Auth\Auth::attemptLogin');
$routes->get('auth/logout', 'Auth\Auth::logout');

// Voting System (Public routes with explicit filters)
$routes->get('/', 'Vote::index', ['filter' => 'auth']);
$routes->get('vote/(:num)', 'Vote::show/$1', ['filter' => 'auth']);
$routes->get('vote/candidates/(:num)', 'Vote::candidates/$1', ['filter' => 'auth']);
$routes->post('vote/(:num)', 'Vote::cast/$1', ['filter' => 'auth']);
$routes->get('vote/result/(:num)', 'Vote::result/$1', ['filter' => 'auth']);

// Admin Panel (Protected by admin filter)
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    $routes->get('elections', 'Election::index');
    $routes->get('elections/create', 'Election::create');
    $routes->post('elections/store', 'Election::store');
    $routes->get('elections/edit/(:num)', 'Election::edit/$1');
    $routes->post('elections/update/(:num)', 'Election::update/$1');
    $routes->get('elections/delete/(:num)', 'Election::delete/$1');

    $routes->get('candidates/(:num)', 'Candidate::index/$1');
    $routes->get('candidates/create/(:num)', 'Candidate::create/$1');
    $routes->post('candidates/store/(:num)', 'Candidate::store/$1');
    $routes->get('candidates/delete/(:num)', 'Candidate::delete/$1');
});
