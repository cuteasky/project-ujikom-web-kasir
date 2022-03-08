<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Auth
$routes->get('/', 'Auth::index');
$routes->get('/logout/(:num)', 'Auth::logout/$1');

// Kasir
$routes->get('/kasir', 'Kasir::index');
$routes->get('/delete/(:num)', 'Kasir::deleteMenu/$1');
$routes->get('/keranjang/(:num)', 'Kasir::keranjang/$1');
$routes->get('/bayar/(:num)', 'Kasir::checkout/$1');
$routes->get('/kasir/riwayat/(:num)', 'Kasir::riwayatKasir/$1');
$routes->get('/kasir/riwayat', 'Kasir::dtRiwayat');
$routes->get('/struk', 'Kasir::cetakStruk');

// Manager
$routes->get('/manager', 'Adman::index');
$routes->get('/manager/manage-menu', 'Adman::manageMenu');
$routes->get('/manager/log-kasir', 'Adman::mLogKasir');
$routes->post('/simpan-menu', 'Adman::addMenu');
$routes->post('/sunting-menu/(:num)', 'Adman::suntingMenu/$1');
$routes->get('/hapus-menu/(:num)', 'Adman::deleteMenu/$1');
$routes->get('/manager/total-transaksi', 'Adman::rekapTransaksi');
$routes->get('/manager/rekap-transaksi', 'Adman::rekapTransaksiAllKasir');
$routes->get('/manager/rekap-transaksi-harian', 'Adman::rekapTransaksiHarian');
$routes->get('/manager/rekap-transaksi-bulanan', 'Adman::rekapTransaksiBulanan');

// Admin
$routes->get('/admin', 'Adman::index');
$routes->get('/admin/manage-pegawai', 'Adman::managePegawai');
$routes->get('/admin/log-pegawai', 'Adman::logPegawai');
$routes->post('/simpan-pegawai', 'Adman::addPegawai');
$routes->post('/sunting-pegawai/(:num)', 'Adman::suntingPegawai/$1');
$routes->get('/delete-pegawai/(:num)', 'Adman::deletePegawai/$1');
$routes->get('/profile', 'Adman::profile');
$routes->post('/update-setting', 'Adman::updateProfileApp');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
