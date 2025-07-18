<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth\Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);


// ─── Public (no filter) ─────────────────────────────────
$routes->get('auth/login',         'Auth\Auth::login');
$routes->post('auth/attemptLogin', 'Auth\Auth::attemptLogin');
$routes->get('auth/logout',        'Auth\Auth::logout');

// ─── VOTING (must be logged in as voter) ────────────────
$routes->group('', ['filter' => 'auth'], function($r) {
    $r->get('/',                          'Vote::index');
    $r->get('vote/candidates/(:num)',     'Vote::candidates/$1');
    $r->post('vote/cast/(:num)',          'Vote::cast/$1');
    $r->get('vote/result/(:num)',         'Vote::result/$1');
});


// ─── ADMIN PANEL (must be logged in as admin) ──────────
$routes->group('admin', [
    'namespace' => 'App\Controllers\Admin',
    'filter'    => 'auth:admin'
], function($r){
    $r->get('dashboard',                'Dashboard::index');
    $r->get('elections',                'Election::index');
    $r->get('elections/create',         'Election::create');
    $r->post('elections/store',         'Election::store');
    $r->get('elections/edit/(:num)',    'Election::edit/$1');
    $r->post('elections/update/(:num)', 'Election::update/$1');
    $r->get('elections/delete/(:num)',  'Election::delete/$1');

    $r->get('candidates/(:num)',        'Candidate::index/$1');
    $r->get('candidates/create/(:num)', 'Candidate::create/$1');
    $r->post('candidates/store/(:num)', 'Candidate::store/$1');
    $r->get('candidates/delete/(:num)', 'Candidate::delete/$1');
});
