<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Web');
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
$routes->get('/', 'Web::index');

// get(nama url, 'nama controller::nama function')
$routes->post('auth/check_login', 'Auth::check_login');
$routes->get('auth/login', 'Web::index', ['as' => 'pemohon.logout']);
$routes->get('/admin', 'Utama::utama', ['as' => 'utama.dashboard']);


$routes->get('/admin', 'Home::index', ['as' => 'dashboard.utama']);
$routes->get('/admin/pemohon/senarai', 'PemohonController::index', ['as' => 'pemohon.senarai']);
$routes->get('/admin/pemohon/tambah', 'PemohonController::create', ['as' => 'pemohon.tambah']);
$routes->get('/admin/laporan/individu', 'Laporan::laporan_individu', ['as' => 'laporan.individu']);
$routes->get('admin/user/edit_user/(:num)', 'User::edit_user/$1', ['as' => 'user.edit']);
$routes->get('/admin/laporan/papar_laporan/(:num)', 'Laporan::papar_laporan/$1', ['as' => 'laporan.papar_laporan']);
$routes->get('/admin/list_sistem', 'SistemController::list_sistem', ['as' => 'senarai.sistem']);
$routes->get('/admin/senarai_cr', 'SenaraiCr::senarai_cr', ['as' => 'senarai_cr.cr']);
$routes->get('/admin/senarai_cr_pemohon', 'SenaraiCr::senarai_cr_pemohon', ['as' => 'senarai_cr.pemohon']);
$routes->get('/admin/senarai_cr_kpsu', 'SenaraiCr::senarai_cr_kpsu', ['as' => 'senarai_cr.kpsu']);
$routes->get('/admin/senarai_cr_psu', 'SenaraiCr::senarai_cr_psu', ['as' => 'senarai_cr.psu']);
$routes->get('/admin/senarai_cr_pptm', 'SenaraiCr::senarai_cr_pptm', ['as' => 'senarai_cr.pptm']);
$routes->get('/admin/senarai_cr_pengesah', 'Senaraicr::senarai_cr_pengesah', ['as' => 'senarai_cr.pdata_pemohon']);

//========pusat rekod===========
$routes->get('/admin/senarai_rekod', 'Rekod::senarai_rekod', ['as' => 'senarai_rekod.rekod']);
$routes->post('/admin/senarai_rekod', 'Rekod::senarai_rekod', ['as' => 'senarai_rekod.rekod']);
$routes->post('/admin/add_rekod', 'Rekod::add_rekod_proses', ['as' => 'senarai_rekod.add_rekod']);
$routes->get('/admin/add_rekod', 'Rekod::add_rekod', ['as' => 'senarai_rekod.add_rekod']);
$routes->get('/admin/edit_rekod/(:num)', 'Rekod::edit_rekod/$1', ['as' => 'senarai_rekod.edit_rekod']);
$routes->post('/admin/edit_rekod/(:num)', 'Rekod::edit_rekod/$1', ['as' => 'senarai_rekod.edit_rekod']);
$routes->post('/rekod/edit_rekod_proses/(:num)', 'Rekod::edit_rekod_proses/$1', ['as' => 'senarai_rekod.edit_rekod_proses']);
//$routes->get('/rekod/edit_rekod_proses/(:num)', 'Rekod::edit_rekod_proses/$1', ['as' => 'senarai_rekod.edit_rekod_proses']);
$routes->post('/rekod/upload_rekod_proses', 'Rekod::upload_rekod_proses');





//========pusat data===========
$routes->get('/admin/senarai_cr_data_pemohon', 'Senaraicr::senarai_cr_data_pemohon', ['as' => 'senarai_cr.data_pemohon']);
$routes->get('/admin/senarai_cr_data_psu', 'Senaraicr::senarai_cr_data_psu', ['as' => 'senarai_cr.data_psu']);
$routes->get('/admin/senarai_cr_data_tindakan', 'Senaraicr::senarai_cr_data_tindakan', ['as' => 'senarai_cr.data_tindakan']);
$routes->get('/admin/senarai_cr_data_pptm', 'Senaraicr::senarai_cr_data_pptm', ['as' => 'senarai_cr.data_pptm']);





$routes->post('/admin/laporan/individu', 'Laporan::laporan_individu', ['as' => 'laporan.individu']);
$routes->post('/admin/pemohon/proses_tambah', 'PemohonController::store', ['as' => 'pemohon.proses_tambah']);
$routes->post('/admin/pemohon/padam/(:num)', 'PemohonController::delete/$1', ['as' => 'pemohon.padam']);
$routes->post('/admin/pemohon/edit/(:num)', 'PemohonController::edit/$1', ['as' => 'pemohon.edit']);
$routes->post('/admin/rayuan_baru/kira', 'RayuanBaruController::store', ['as' => 'rayuan_baru.kira']);
$routes->post('/admin/rayuan_baru/download', 'RayuanBaruController::download', ['as' => 'rayuan_baru.download']);
$routes->post('/admin/rayuan_baru/selesai_perakuan', 'RayuanBaruController::selesai_perakuan', ['as' => 'rayuan_baru.selesai_perakuan']);
$routes->post('/admin/rayuan_baru/simpan_id_rayuan', 'RayuanBaruController::simpanIdRayuanBaru', ['as' => 'rayuan_baru.simpan_id_rayuan']);

$routes->get('/admin/utils/get_towns', 'PemohonController::getStateTowns', ['as' => 'pemohon.state_town']);



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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
