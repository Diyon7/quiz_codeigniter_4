<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/peraturan', 'Peraturan::index');

//Auth Routes
$routes->get('/login', 'Auth/Auth::index');
$routes->get('/logout', 'Auth/Auth::logout');

$routes->add('/quiz', 'Quiz/Soal::soal', ['filter' => 'cek_petugas']);

$routes->add('admin/login', 'Admin/AdminAuth::index', ['filter' => 'cekadmin']);
$routes->add('admin/logout', 'Admin/AdminAuth::logout');

$routes->group('admin', ['filter' => 'cekloginadmin'], function ($routes) {
	$routes->add('/', 'Admin/Dashboard::index');

	// admin soal
	$routes->add('soal/add', 'Admin/Dashboard::add');
	$routes->add('soal/edit/(:num)', 'Admin/Dashboard::edit');
	$routes->add('soal/delete/(:num)', 'Admin/Dashboard::delete');

	//hasil peserta
	$routes->add('peserta', 'Admin/Peserta::index');
	$routes->add('get_hasil', 'Admin/Peserta::get_hasil');
	$routes->add('peserta/detail', 'Admin/Peserta::Detail');
});

$routes->group('ajax/admin', function ($routes) {
	$routes->add('soal', 'Admin/Dashboard::ajax');
});


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
