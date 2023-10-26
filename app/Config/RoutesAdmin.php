<?php

use CodeIgniter\Router\RouteCollection;


use App\Controllers\Administrator;
$routes->post('administrator/login', [Administrator::class, 'login']);
$routes->get('administrator/logout', [Administrator::class, 'logout']);
$routes->group('administrator',['filter' => 'adminFilter'], function ($routes) {
    $routes->get('/', [Administrator::class, 'index']);
    $routes->get('dashboard', [Administrator::class, 'dashboard']);
    $routes->get('identitas', [Administrator::class, 'identitas'], ['as' => 'admin.identitas']);
    $routes->post('identitas/proses_edit_identitas', [Administrator::class, 'edit_identitas'], ['as' => 'admin.identitas.edit']);
   
    $routes->get('transaksi', [Administrator::class, 'transaksi']);
    $routes->get('ambil_sa/(:num)', [Administrator::class, 'asa/$1']);
    $routes->post('ajaxpn', [Administrator::class, 'getProdukName'], ['as' => 'produk.nama']);
    $routes->post('ajdt/(:segment)', [Administrator::class, 'ajaxDatatables']);
    $routes->post('ajdt/(:segment)/(:segment)', [Administrator::class, 'ajaxDatatables']);
    $routes->get('stok', [Administrator::class, 'stok']);
    $routes->get('tes', [Administrator::class, 'admin_tes']);

    // GROUP HALAMAN KATEGORI
    $routes->group('kategori', [
        'namespace' => 'App\Controllers\Admin',
        'filter' => 'adminFilter'
    ], static function($routes){
        $routes->get('/', 'Kategori::index');
        $routes->get('add', 'Kategori::tambah');
        $routes->post('add/process', 'Kategori::proses_tambah');
        $routes->get('edit/(:num)', 'Kategori::sunting/$1');
        $routes->post('edit/process', 'Kategori::proses_sunting');
        $routes->post('delete/', 'Kategori::hapus');
    });

    // GROUP HALAMAN PRODUK
    $routes->group('produk', ['namespace' => 'App\Controllers\Admin', 'filter' => 'adminFilter'], static function ($routes){
        $routes->get('/', 'Produk::index');
        $routes->get('tambah', 'Produk::tambah_produk');
        $routes->post('proses_tambah', 'Produk::proses_produk');
        $routes->get('edit/(:num)', 'Produk::edit_produk/$1');
        $routes->post('proses_edit', 'Produk::proses_produk');
        $routes->post('delete', 'Produk::delete_produk');
    });

    // GROUP HALAMAN PAYMENT CHANNEL, DELIVERY SERVICE, DAN SLIDE
    $routes->group('aio', ['namespace' => 'App\Controllers\Admin', 'filter' => 'adminFilter'], static function ($routes){
        $routes->get('(:segment)', 'Aio::index/$1');
        $routes->get('(:segment)/tambah', 'Aio::tambah/$1/$2');
        $routes->post('(:segment)/proses_tambah', 'Aio::proses_tambah/$1');
        $routes->get('(:segment)/edit/(:num)', 'Aio::edit/$1/$2');
        $routes->post('(:segment)/proses_edit', 'Aio::proses_edit/$1');
    });

    $routes->group('pengaturan',[
        'namespace' => 'App\Controllers\Admin',
        'filter' => 'adminFilter'
    ], static function($routes){
        $routes->get('ubah_password', 'Pengaturan::ubah_password');
        $routes->post('ubah_password/proses', 'Pengaturan::proses_ubah_password');
    });

    $routes->get('(:segment)', [Administrator::class, 'direct']);
});