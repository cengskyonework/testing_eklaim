<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::group(['middleware' => ['install']], function () {	

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/', 'Theme\ThemeController@index');
Route::group(['middleware' => ['auth']], function () {
	Route::get('/dashboard', 'DashboardController@index');
	//approval controller
	Route::resource('approval', 'ApprovalController');
	Route::any('apvfat/{id}', 'ApprovalController@apvfat');
	Route::any('apvacc/{id}', 'ApprovalController@apvacc');
	Route::any('approved', 'ApprovalController@approved')->name('approval.approve');
	Route::any('finance_approval', 'ApprovalController@finance_approval')->name('approval.finance_approval');
	Route::any('fa_approved', 'ApprovalController@fa_approved')->name('approval.fa_approve');
	Route::any('acc_approval', 'ApprovalController@acc_approval')->name('approval.acc_approval');
	Route::any('acc_approved', 'ApprovalController@acc_approved')->name('approval.acc_approve');
	Route::get('konfirm_acc/{id}', 'ApprovalController@konfirm_acc')->name('approval.konfirm_acc');
	Route::get('validasi/{id}', 'ApprovalController@validasi_acc')->name('approval.validasi_acc');
	Route::post('simpan_validasi_acc/{id}', 'ApprovalController@simpan_validasi_acc')->name('approval.simpan_validasi_acc');
	Route::get('edit_konfirm_acc/{id}', 'ApprovalController@edit_konfirm_acc')->name('approval.edit_konfirm_acc');
	Route::get('konfirm_fat/{id}', 'ApprovalController@konfirm_fat')->name('approval.konfirm_fat');
	Route::get('edit_konfirm_fat/{id}', 'ApprovalController@edit_konfirm_fat')->name('approval.edit_konfirm_fat');
	Route::post('simpan_konfirm_acc/{id}', 'ApprovalController@simpan_konfirm_acc')->name('approval.simpan_konfirm_acc');
	Route::post('simpan_konfirm_fat/{id}', 'ApprovalController@simpan_konfirm_fat')->name('approval.simpan_konfirm_fat');

	//Profile Controller
	Route::get('profile/edit', 'ProfileController@edit');
	Route::post('profile/update', 'ProfileController@update');
	Route::get('profile/change_password', 'ProfileController@change_password');
	Route::post('profile/update_password', 'ProfileController@update_password');

	//Dokumen Controller
	Route::resource('dokumen', 'DokumenController');

	//Produk Controller
	Route::resource('produk', 'ProdukController');
	Route::post('import', 'ProdukController@import_excel');

	//Promo Controller
	Route::resource('promo', 'PromoController');

	//List Dokumen Controller
	Route::resource('listdocumnet', 'ListDocumentController');

	//claim controller
	Route::resource('claim', 'ClaimController');
	Route::get('cetak/{id}', 'ClaimController@cetak');
	Route::get('cetak_tt/{id}', 'ClaimController@cetak_tt');
	Route::get('createx', 'ClaimController@createx');
	Route::get('edit_cc/{id}', 'ClaimController@edit_cc')->name('claim.edit_cc');
	Route::get('edit_apv/{id}', 'ClaimController@edit_apv')->name('claim.edit_apv');
	Route::get('create_acc/{id}', 'ClaimController@create_acc')->name('claim.create_acc');
	Route::get('edit_acc/{id}', 'ClaimController@edit_acc')->name('claim.edit_acc');
	Route::get('create_fat/{id}', 'ClaimController@create_fat')->name('claim.create_fat');
	Route::get('input_ap/{id}', 'ClaimController@input_ap')->name('claim.input_ap');
	Route::get('edit_fat/{id}', 'ClaimController@edit_fat')->name('claim.edit_fat');
	Route::any('update_cc/{id}', 'ClaimController@update_cc')->name('claim.update_cc');
	Route::any('update_apv/{id}', 'ClaimController@update_apv')->name('claim.update_apv');
	Route::post('simpan_acc/{id}', 'ClaimController@simpan_acc')->name('claim.simpan_acc');
	Route::post('simpan_fat/{id}', 'ClaimController@simpan_fat')->name('claim.simpan_fat');
	Route::post('simpan_ap/{id}', 'ClaimController@simpan_ap')->name('claim.simpan_ap');
	Route::get('/get_data_customer', 'ClaimController@get_data_konsumen')->name('claim.get_data_customer');
	Route::get('/get_data_chanel', 'ClaimController@get_data_chanel')->name('claim.get_data_chanel');
	Route::get('/get_data_produk', 'ClaimController@get_data_produk')->name('claim.get_data_produk');
	Route::get('/get_data_promo', 'ClaimController@get_data_promo')->name('claim.get_data_promo');
	Route::any('/cetak_bulk', 'ClaimController@cetak_bulk')->name('claim.cetak_bulk');
	Route::any('deleted/{id}', 'ClaimController@deleted');



	//bulkcontroller
	Route::resource('bulkpembayaran', 'BulkPembayaranController');

	//Region controller
	Route::resource('region', 'RegionController');
	Route::any('region/{id}', 'RegionController@destroy');

	//distributor controller
	Route::resource('distributor', 'DistributorController');
	Route::any('distributor/{id}', 'DistributorController@destroy');

	//cost center controller
	Route::resource('costcenter', 'CostCenterController');
	Route::post('import_excel', 'CostCenterController@import_excel');

	//chanell controller
	Route::resource('channel', 'ChannelController');

	//departments controller
	Route::resource('departments', 'DepartmentsController');

	//category controller
	Route::resource('category', 'CategoryController');

	//reports contrloller
	Route::resource('reports', 'ReportsController');
	Route::post('export', 'ReportsController@exports')->name('reports.export');

	//Route::group(['middleware' => ['admin']], function () {
	//User Controller
	Route::resource('users', 'UserController');
	Route::any('buat_akses/{id}', 'UserController@buat_akses');
	Route::any('edit_akses/{id}', 'UserController@edit_akses');
	Route::post('simpan_akses/{id}', 'UserController@simpan_akses');
	//Language Controller
	Route::resource('languages', 'LanguageController');

	//Utility Controller
	Route::match(['get', 'post'], 'administration/general_settings/{store?}', 'UtilityController@settings')->name('general_settings.update');
	Route::match(['get', 'post'], 'administration/theme_option/{store?}', 'UtilityController@theme_option')->name('theme_option.update');
	Route::post('administration/upload_logo', 'UtilityController@upload_logo')->name('general_settings.update');
	Route::post('administration/upload_favicon', 'UtilityController@upload_favicon')->name('general_settings.update');
	Route::get('administration/backup_database', 'UtilityController@backup_database')->name('utility.backup_database');
	//});
});


Route::fallback(function () {
	return view('Error_routes');
});
