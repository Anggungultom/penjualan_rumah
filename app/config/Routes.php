<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); // <<< INI PENTING

$routes->get('/', 'Home::index');
$routes->get('/rumah', 'Rumah::index');
$routes->get('/rumah/tambah', 'Rumah::tambah');
$routes->post('/rumah/simpan', 'Rumah::simpan');
$routes->get('/rumah/detail/(:num)', 'Rumah::detail/$1');
$routes->get('/rumah/hapus/(:num)', 'Rumah::hapus/$1');
$routes->get('/tesenv', 'Home::tesEnv');
$routes->get('/rumah/edit/(:num)', 'Rumah::edit/$1');
$routes->post('/rumah/update/(:num)', 'Rumah::update/$1');
