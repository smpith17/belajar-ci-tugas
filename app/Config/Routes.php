<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login', ['filter' => 'redirect']);
$routes->get('logout', 'AuthController::logout');

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('diskon', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'DiskonController::index');              // List diskon
    $routes->get('create', 'DiskonController::create');       // Form tambah
    $routes->post('store', 'DiskonController::store');        // Simpan tambah
    $routes->get('edit/(:num)', 'DiskonController::edit/$1'); // Form edit
    $routes->post('update/(:num)', 'DiskonController::update/$1'); // Simpan edit
    $routes->get('delete/(:num)', 'DiskonController::delete/$1');  // Hapus
});

$routes->get('api/jumlah-item', 'ApiController::jumlah_item');


$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->group('kategori', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'KategoriController::index');
    $routes->post('', 'KategoriController::create');
    $routes->post('edit/(:any)', 'KategoriController::edit/$1');
    $routes->get('delete/(:any)', 'KategoriController::delete/$1');
});

$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('faq', 'Home::faq', ['filter' => 'auth']);
$routes->get('contact', 'Home::contact', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);

