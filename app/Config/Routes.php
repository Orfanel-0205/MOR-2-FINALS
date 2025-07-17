<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Vote');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); // AutoRoute enabled temporarily

// Voting routes
$routes->get('/', 'Vote::index', ['filter' => 'auth']);
$routes->get('vote', 'Vote::index', ['filter' => 'auth']);
$routes->get('vote/candidates/(:num)', 'Vote::candidates/$1', ['filter' => 'auth']);
$routes->post('vote/(:num)', 'Vote::cast/$1', ['filter' => 'auth']);
$routes->get('vote/result/(:num)', 'Vote::result/$1', ['filter' => 'auth']);

// Auth routes
$routes->group('auth', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::attemptLogin');
    $routes->get('logout', 'Auth::logout');
});

// Admin routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:admin'], function ($routes) {
    $routes->get('elections', 'Election::index');
    $routes->match(['get', 'post'], 'elections/create', 'Election::create');
    $routes->get('elections/edit/(:num)', 'Election::edit/$1');
    $routes->post('elections/update/(:num)', 'Election::update/$1');
    $routes->get('elections/delete/(:num)', 'Election::delete/$1');

    $routes->get('candidates/(:num)', 'Candidate::index/$1');
    $routes->match(['get', 'post'], 'candidates/create/(:num)', 'Candidate::create/$1');
    $routes->get('candidates/edit/(:num)', 'Candidate::edit/$1');
    $routes->post('candidates/update/(:num)', 'Candidate::update/$1');
    $routes->get('candidates/delete/(:num)', 'Candidate::delete/$1');
});
