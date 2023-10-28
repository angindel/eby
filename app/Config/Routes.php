<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// HALAMAN UTAMA
$routes->get('/', 'Home::index');

/**
 * USER LOGIN
 */
// $routes->get('/login', '\App\Controllers\Auth\LoginController::login_page');
$routes->post('/login/proses', 'Home::login_proses');
$routes->get('/auth/google/login', 'Home::login_google_proses');

/**
 * USER REGISTER
 */
// $routes->get('/register', 'Home::register_page');


// TELEPON
// $routes->get('/telepon', 'Home::telepon');
// $routes->get('/cetaktelepon/(:num)', 'Home::cetak_telp/$1');
// $routes->get('/ct/(:num)', 'Home::ct/$1');
// $routes->post('/datatelp', 'Home::data_telp');
// $routes->post('/datatelp/(:segment)', 'Home::data_telp/$1');

$routes->get('produk/page/(:num)', 'Produk::index/$1');
$routes->get('produk/detail/(:any)', 'Home::produk_detail/$1');
$routes->get('produk/kategori/(:any)', 'Home::produk_kategori/$1');


// $routes->cli('tools', 'Tools::message');
// $routes->get('tools', 'Tools::message');
// $routes->post('tools', 'Tools::message');
// $routes->get('tes', 'Home::fake');
// $routes->get('dbtes', 'Home::dbtes');
$routes->get('tes/(:num)/(:num)', 'Home::produkIS/$1/$2');

/**
 * USER DASHBOARD
 */
$routes->get('/user/dashboard', 'Auth\LoginController::dashboard_page');
$routes->get('/user/logout', 'Auth\LoginController::logout');


$routes->get('/login', 'Auth\LoginController::login_page');
$routes->get('/register', 'Auth\RegisterController::register_page');
$routes->get('/login/magic-link', 'Auth\MagicLinkController::loginView', ['as' => 'magic-link']);
service('auth')->routes($routes);