<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::loginSubmit');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::registerSubmit');

$routes->get('/recovery-password', 'Auth::recoveryPassword');
$routes->post('/recovery-password', 'Auth::recoveryPasswordSubmit');

$routes->get('/change-password', 'Auth::changePassword');
$routes->post('/change-password', 'Auth::changePassword');

$routes->get('/logout', 'Auth::logout');

$routes->get('/', 'Dashboard::index');

$routes->get('/booking', 'Booking::index');
$routes->get('/booking/create', 'Booking::create');
$routes->post('/booking/store', 'Booking::store');
$routes->get('/booking/edit/(:num)', 'Booking::edit/$1');
$routes->post('/booking/update/(:num)', 'Booking::update/$1');
$routes->post('/booking/delete/(:num)', 'Booking::delete/$1');
$routes->get('/booking/trash', 'Booking::trash');
$routes->post('/booking/restore/(:num)', 'Booking::restore/$1');
$routes->post('/booking/deletePermanent/(:num)', 'Booking::deletePermanent/$1');
$routes->post('/booking/empty_trash', 'Booking::empty_trash');

$routes->get('/doctor', 'Doctor::index');
$routes->get('/doctor/create', 'Doctor::create');
$routes->post('/doctor/store', 'Doctor::store');
$routes->get('/doctor/edit/(:num)', 'Doctor::edit/$1');
$routes->post('/doctor/update/(:num)', 'Doctor::update/$1');
$routes->post('/doctor/delete/(:num)', 'Doctor::delete/$1');
$routes->get('/doctor/trash', 'Doctor::trash');
$routes->post('/doctor/restore/(:num)', 'Doctor::restore/$1');
$routes->post('/doctor/deletePermanent/(:num)', 'Doctor::deletePermanent/$1');
$routes->post('/doctor/empty_trash', 'Doctor::empty_trash');

$routes->get('/service', 'Service::index'); 
$routes->post('service/store', 'Service::store'); 
$routes->get('/service/create', 'Service::create'); 
$routes->get('service/edit/(:num)', 'Service::edit/$1');
$routes->post('service/update/(:num)', 'Service::update/$1'); 
$routes->post('service/delete/(:num)', 'Service::delete/$1'); 
$routes->get('service/trash', 'Service::trash'); 
$routes->post('service/restore/(:num)', 'Service::restore/$1'); 
$routes->post('service/deletePermanent/(:num)', 'Service::deletePermanent/$1'); 
$routes->post('service/empty_trash', 'Service::empty_trash');

$routes->get('/patient', 'Patient::index');
$routes->get('/patient/create', 'Patient::create');
$routes->post('patient/store', 'Patient::store');
$routes->get('/patient/edit/(:num)', 'Patient::edit/$1');
$routes->post('/patient/update/(:num)', 'Patient::update/$1');
$routes->post('/patient/delete/(:num)', 'Patient::delete/$1');
$routes->get('/patient/trash', 'Patient::trash');
$routes->post('/patient/restore/(:num)', 'Patient::restore/$1');
$routes->post('/patient/deletePermanent/(:num)', 'Patient::deletePermanent/$1');
$routes->post('patient/empty_trash', 'Patient::empty_trash');

$routes->get('/pembayaran', 'Pembayaran::index');
$routes->get('/pembayaran/create', 'Pembayaran::create');
$routes->post('/pembayaran/store', 'Pembayaran::store');
$routes->get('/pembayaran/edit/(:num)', 'Pembayaran::edit/$1');
$routes->post('/pembayaran/update/(:num)', 'Pembayaran::update/$1');
$routes->post('/pembayaran/delete/(:num)', 'Pembayaran::delete/$1');
$routes->get('/pembayaran/trash', 'Pembayaran::trash');
$routes->post('/pembayaran/restore/(:num)', 'Pembayaran::restore/$1');
$routes->post('/pembayaran/deletePermanent/(:num)', 'Pembayaran::deletePermanent/$1');
$routes->post('/pembayaran/empty_trash', 'Pembayaran::empty_trash');

$routes->get('/penjualan_produk', 'PenjualanProduk::index');
$routes->get('/penjualan_produk/create', 'PenjualanProduk::create');
$routes->post('/penjualan_produk/store', 'PenjualanProduk::store');
$routes->get('/penjualan_produk/edit/(:num)', 'PenjualanProduk::edit/$1');
$routes->post('/penjualan_produk/update/(:num)', 'PenjualanProduk::update/$1');
$routes->get('/penjualan_produk/delete/(:num)', 'PenjualanProduk::delete/$1');
$routes->get('/penjualan_produk/trash', 'PenjualanProduk::trash');
$routes->post('/penjualan_produk/restore/(:num)', 'PenjualanProduk::restore/$1');
$routes->post('/penjualan_produk/deletePermanent/(:num)', 'PenjualanProduk::deletePermanent/$1');
$routes->post('/penjualan_produk/empty_trash', 'PenjualanProduk::empty_trash');

$routes->get('/product', 'Product::index');
$routes->post('product/store', 'Product::store');
$routes->get('/product/add', 'Product::add');
$routes->get('product/edit/(:num)', 'Product::edit/$1');
$routes->post('product/update/(:num)', 'Product::update/$1');
$routes->post('product/delete/(:num)', 'Product::delete/$1');
$routes->get('product/trash', 'Product::trash');
$routes->post('product/restore/(:num)', 'Product::restore/$1');
$routes->post('product/deletePermanent/(:num)', 'Product::deletePermanent/$1');
$routes->post('product/empty_trash', 'Product::empty_trash');

$routes->get('/user', 'User::index');
$routes->get('user/reset_user/(:num)', 'User::reset_user/$1');

$routes->get('/laporan_booking', 'LaporanBooking::index');
$routes->post('/laporan_booking/printlaporanbooking', 'LaporanBooking::printlaporanbooking');
$routes->post('/laporan_booking/pdflaporanbooking', 'LaporanBooking::pdflaporanbooking');

$routes->get('/laporan_penjualan_produk', 'LaporanPenjualanProduk::index');
$routes->post('/laporan_penjualan_produk/printlaporanpenjualanproduk', 'LaporanPenjualanProduk::printlaporanpenjualanproduk');
$routes->post('/laporan_penjualan_produk/pdflaporanpenjualanproduk', 'LaporanPenjualanProduk::pdflaporanpenjualanproduk');

$routes->get('/laporan_pembayaran', 'LaporanPembayaran::index');
$routes->post('/laporan_pembayaran/printlaporanpembayaran', 'LaporanPembayaran::printlaporanpembayaran');
$routes->post('/laporan_pembayaran/pdflaporanpembayaran', 'LaporanPembayaran::pdflaporanpembayaran');

$routes->get('/log_activity', 'LogActivity::index');

$routes->get('/setting', 'Setting::index');
$routes->post('/setting/update', 'Setting::update');