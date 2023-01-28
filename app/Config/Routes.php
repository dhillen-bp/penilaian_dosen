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
$routes->setAutoRoute(true);
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
$routes->get('/', 'Login::index');
// routing untuk auth
$routes->get('/mahasiswa', 'Mahasiswa::index', ['filter' => 'auth']);
$routes->get('/mahasiswa', 'Mahasiswa::nilai_dosen', ['filter' => 'auth']);
$routes->get('/mahasiswa', 'Mahasiswa::detail_dosen', ['filter' => 'auth']);
$routes->get('/admin', 'Admin::data_mahasiswa', ['filter' => 'auth_admin']);

// routing untuk mahasiswa
$routes->get('/mahasiswa/index', 'Mahasiswa::index');
$routes->get('/mahasiswa/nilai_dosen', 'Mahasiswa::nilai_dosen');
$routes->get('/mahasiswa/detail_dosen/(:segment)', 'Mahasiswa::detail_dosen/$1');

// routing untuk dosen
$routes->get('/admin/profil_dosen', 'Admin::profil_dosen');

// routing untuk admin
$routes->get('/admin/index', 'Admin::index');
$routes->get('/admin/data_mahasiswa', 'Admin::data_mahasiswa');
$routes->get('/admin/tambah_mahasiswa', 'Admin::tambah_mahasiswa');
$routes->post('/admin/tambah_mahasiswa', 'Admin::tambah_mahasiswa');
$routes->get('/admin/edit_mahasiswa/(:segment)', 'Admin::edit_mahasiswa/$1');
$routes->post('/admin/edit_mahasiswa/(:segment)', 'Admin::edit_mahasiswa/$1');
$routes->delete('/admin/hapus_mahasiswa/(:segment)', 'Admin::hapus_mahasiswa/$1');
$routes->get('/admin/data_dosen', 'Admin::data_dosen');
$routes->get('/admin/data_kuesioner', 'Admin::data_kuesioner');
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
