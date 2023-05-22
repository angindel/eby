<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('produk/detail/(:any)', 'Home::produk_detail/$1');


$routes->cli('tools', 'Tools::message');
$routes->get('tools', 'Tools::message');
$routes->post('tools', 'Tools::message');

use App\Controllers\Administrator;
$routes->post('administrator/login', [Administrator::class, 'login']);
$routes->get('administrator/logout', [Administrator::class, 'logout']);
$routes->group('administrator',['filter' => 'adminFilter'], function ($routes) {
    $routes->get('/', [Administrator::class, 'index']);
    $routes->get('dashboard', [Administrator::class, 'dashboard']);
    $routes->get('identitas', [Administrator::class, 'identitas'], ['as' => 'admin.identitas']);
    $routes->post('identitas/proses_edit_identitas', [Administrator::class, 'edit_identitas'], ['as' => 'admin.identitas.edit']);
    $routes->get('produk', [Administrator::class, 'produk']);
    $routes->get('tambah_produk', [Administrator::class, 'tambah_produk']);
    $routes->post('proses_tambah_produk', [Administrator::class, 'proses_produk']);
    $routes->post('proses_edit_produk', [Administrator::class, 'proses_produk']);
    $routes->get('edit_produk/(:num)', [Administrator::class, 'edit_produk']);
    $routes->get('delete_produk/(:num)', [Administrator::class, 'delete_produk/$1']);
    $routes->get('kategori', [Administrator::class, 'kategori']);
    $routes->get('tambah_kategori', [Administrator::class, 'tambah_kategori']);
    $routes->post('proses_tambah_kategori', [Administrator::class, 'proses_tambah_kategori']);
    $routes->get('edit_kategori/(:num)', [Administrator::class, 'edit_kategori/$1']);
    $routes->get('delete_kategori/$1', [Administrator::class, 'delete_kategori/$1']);
    $routes->get('transaksi', [Administrator::class, 'transaksi']);
    $routes->post('ajaxpn', [Administrator::class, 'getProdukName'], ['as' => 'produk.nama']);
    $routes->post('ajdt/(:segment)', [Administrator::class, 'ajaxDatatables']);
    $routes->post('ajdt/(:segment)/(:segment)', [Administrator::class, 'ajaxDatatables']);
    $routes->get('stok', [Administrator::class, 'stok']);
    $routes->get('(:segment)', [Administrator::class, 'direct']);
});

use App\Controllers\Pages;
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
