<?php

use Illuminate\Support\Facades\Route;

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

//
Auth::routes([
    'register' => true
]);

//Dashboard
Route::get('/', 'App\Http\Controllers\MainController@index')->name('dashboard')->middleware('auth');

//Pasien
Route::get('/pasien', 'App\Http\Controllers\PasienController@index')->name('pasien')->middleware('auth');
Route::post('/pasien/add', 'App\Http\Controllers\PasienController@save_pasien')->name('pasien_save')->middleware('auth');
Route::get('/pasien/edit/{id}', 'App\Http\Controllers\PasienController@edit_pasien')->name('pasien_edit')->middleware('auth');
Route::post('/pasien/edit/update', 'App\Http\Controllers\PasienController@update_pasien')->name('pasien_update')->middleware('auth');
Route::delete('/pasien/remove/{id}', 'App\Http\Controllers\PasienController@remove_pasien')->name('pasien_delete')->middleware('auth');

//Lab
Route::get('/lab', 'App\Http\Controllers\LabController@index')->name('lab')->middleware('auth');
Route::post('/lab/add', 'App\Http\Controllers\LabController@save_lab')->name('lab_save')->middleware('auth');
Route::get('/lab/edit/{id}', 'App\Http\Controllers\LabController@edit_lab')->name('lab_edit')->middleware('auth');
Route::post('/lab/edit/update', 'App\Http\Controllers\LabController@update_lab')->name('lab_update')->middleware('auth');
Route::delete('/lab/remove/{id}', 'App\Http\Controllers\LabController@remove_lab')->name('lab_delete')->middleware('auth');

//Obat
Route::get('/obat', 'App\Http\Controllers\ObatController@index')->name('obat')->middleware('auth');
Route::post('/obat/add', 'App\Http\Controllers\ObatController@save_obat')->name('obat_save')->middleware('auth');
Route::get('/obat/edit/{id}', 'App\Http\Controllers\ObatController@edit_obat')->name('obat_edit')->middleware('auth');
Route::post('/obat/edit/update', 'App\Http\Controllers\ObatController@update_obat')->name('obat_update')->middleware('auth');
Route::delete('/obat/remove/{id}', 'App\Http\Controllers\ObatController@remove_obat')->name('obat_delete')->middleware('auth');

//Rekam Medis
Route::get('/rekam-medis', 'App\Http\Controllers\RekamMedisController@index')->name('rekam_medis')->middleware('auth');
Route::get('/rekam-medis/add/{idpasien}', 'App\Http\Controllers\RekamMedisController@btn_show_iden')->name('rekammedis_add')->middleware('auth');
Route::post('/rekam-medis/simpan/', 'App\Http\Controllers\RekamMedisController@save_rekam_medis')->name('rekammedis_save')->middleware('auth');
Route::post('/rekam-medis/update', 'App\Http\Controllers\RekamMedisController@update_rekam_medis')->name('rekammedis_update')->middleware('auth');
Route::get('/rekam-medis/view/{id}', 'App\Http\Controllers\RekamMedisController@view_rm')->name('rekammedis_view')->middleware('auth');
Route::get('/rekam-medis/edit/{id}', 'App\Http\Controllers\RekamMedisController@edit_rekam_medis')->name('rekammedis_edit')->middleware('auth');
Route::delete('/rekam-medis/remove/{id}', 'App\Http\Controllers\RekamMedisController@remove_rekam_medis')->name('rekammedis_delete')->middleware('auth');

//Tagihan
Route::get('/tagihan/{id}', 'App\Http\Controllers\RekamMedisController@tagihan')->name('tagihan')->middleware('auth');
