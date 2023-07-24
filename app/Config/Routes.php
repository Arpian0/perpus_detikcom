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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'LoginController::loginForm');
$routes->get('/login', 'LoginController::loginForm');
$routes->post('/login', 'LoginController::login');
$routes->get('/register', 'AuthController::registerForm');
$routes->post('/register', 'AuthController::register');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'DashboardController::index');

// app/config/Routes.php

$routes->get('/books', 'BookController::index');
$routes->get('/books/create', 'BookController::create');
$routes->post('/books/store', 'BookController::store');
$routes->get('/books/read/(:num)', 'BookController::read/$1');
$routes->get('/books/edit/(:num)', 'BookController::edit/$1');
$routes->post('/books/update/(:num)', 'BookController::update/$1');
$routes->get('/books/delete/(:num)', 'BookController::delete/$1');

$routes->get('/categories', 'CategoryController::index');
$routes->get('/categories/create', 'CategoryController::create');
$routes->post('/categories/store', 'CategoryController::store');
$routes->get('/categories/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('/categories/update/(:num)', 'CategoryController::update/$1');
$routes->get('/categories/delete/(:num)', 'CategoryController::delete/$1');

$routes->get('/books/form', 'DashboardController::form');


// $routes->get('/books', 'BookController::index');
// $routes->get('/books/create', 'BookController::create');
// $routes->post('/books/store', 'BookController::store');
// $routes->get('/books/edit/(:num)', 'BookController::edit/$1');
// $routes->post('/books/update/(:num)', 'BookController::update/$1');
// $routes->get('/books/delete/(:num)', 'BookController::delete/$1');

// app/config/Routes.php

// $routes->get('/', 'BookController::index');

// // Route untuk daftar kategori buku
// $routes->get('/categories', 'CategoryController::index');

// // Route untuk halaman tambah kategori buku
// $routes->get('/categories/create', 'CategoryController::create');

// // Route untuk aksi tambah kategori buku
// $routes->post('/categories/store', 'CategoryController::store');

// // Route untuk halaman edit kategori buku
// $routes->get('/categories/edit/(:num)', 'CategoryController::edit/$1');

// // Route untuk aksi update kategori buku
// $routes->post('/categories/update/(:num)', 'CategoryController::update/$1');

// // Route untuk aksi hapus kategori buku
// $routes->get('/categories/delete/(:num)', 'CategoryController::delete/$1');






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
