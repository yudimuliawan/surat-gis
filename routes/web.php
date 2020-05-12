<?php

use Illuminate\Support\Facades\Route;
// use Session;

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

Route::get('/', 'AuthController@v_login')->middleware('login');
Route::post('login','AuthController@login')->middleware('login');
Route::get('logout','AuthController@logout');

Route::group(['prefix' => 'superadmin','middleware'=>'superadmin'], function(){
	Route::get('/','AuthController@dashboard');
	Route::resource('user','UserController');

	Route::resource('salinan_surat','SalinanSuratController');
	Route::resource('disposisi','DisposisiController');
	Route::resource('permohonan_verlok','PermohonanVerlokController');
	Route::get('permohonan_verlok/lokasi/{id}','PermohonanVerlokController@lokasi');
	Route::resource('laporan_verlok','LaporanVerlokController');
	Route::get('laporan_verlok/lokasi/{id}','LaporanVerlokController@lokasi');
	Route::resource('rekomendasi','RekomendasiController');
	Route::get('koordinat','RekomendasiController@koordinat');
	Route::resource('wilayah','WilayahController');
	Route::get('wilayah/map/{id}','WilayahController@map');
	Route::get('map',function(){
		return view('superadmin.map.index');
	});
});

Route::group(['prefix' => 'penerima_surat_kpp','middleware'=>'penerima_surat_kpp'], function(){
	Route::get('/','AuthController@dashboard');
	Route::resource('salinan_surat','SalinanSuratController');
	Route::resource('disposisi','DisposisiController');
	Route::resource('permohonan_rekomendasi','PermohonanRekomendasiController');

});


Route::group(['prefix' => 'kepala_bidang_kpp','middleware'=>'penerima_surat_kpp'], function(){
	Route::get('/','AuthController@dashboard');
	Route::resource('salinan_surat','SalinanSuratController');
	Route::resource('disposisi','DisposisiController');
	Route::resource('rekomendasi','RekomendasiController');
	Route::get('koordinat','RekomendasiController@koordinat');
	Route::resource('wilayah','WilayahController');
	Route::get('wilayah/map/{id}','WilayahController@map');
	Route::get('map',function(){
		return view('superadmin.map.index');
	});

	Route::resource('permohonan_rekomendasi','PermohonanRekomendasiController');

});

Route::group(['prefix' => 'kepala_seksi_prl','middleware'=>'penerima_surat_kpp'], function(){
	Route::get('/','AuthController@dashboard');
	Route::resource('salinan_surat','SalinanSuratController');
	Route::resource('disposisi','DisposisiController');

	Route::resource('rekomendasi','RekomendasiController');
	Route::get('koordinat','RekomendasiController@koordinat');
	Route::resource('wilayah','WilayahController');
	Route::get('wilayah/map/{id}','WilayahController@map');
	Route::get('map',function(){
		return view('superadmin.map.index');
	});

	Route::resource('permohonan_rekomendasi','PermohonanRekomendasiController');

});


Route::group(['prefix' => 'staff_seksi_prl','middleware'=>'penerima_surat_kpp'], function(){
	Route::get('/','AuthController@dashboard');
	Route::resource('salinan_surat','SalinanSuratController');
	Route::resource('disposisi','DisposisiController');
	Route::resource('permohonan_verlok','PermohonanVerlokController');
	Route::get('permohonan_verlok/lokasi/{id}','PermohonanVerlokController@lokasi');
	Route::resource('laporan_verlok','LaporanVerlokController');
	Route::get('laporan_verlok/lokasi/{id}','LaporanVerlokController@lokasi');
	Route::resource('rekomendasi','RekomendasiController');
	Route::get('koordinat','RekomendasiController@koordinat');
	Route::resource('wilayah','WilayahController');
	Route::get('wilayah/map/{id}','WilayahController@map');
	Route::get('map',function(){
		return view('superadmin.map.index');
	});

	Route::get('rekomendasi/approve/{id}','RekomendasiController@approve');
	Route::resource('permohonan_rekomendasi','PermohonanRekomendasiController');

});


Route::group(['prefix' => 'pegawai_cabang_dinas','middleware'=>'penerima_surat_kpp'], function(){
	Route::get('/','AuthController@dashboard');
	Route::resource('salinan_surat','SalinanSuratController');
	Route::resource('disposisi','DisposisiController');
	Route::resource('permohonan_verlok','PermohonanVerlokController');
	Route::get('permohonan_verlok/lokasi/{id}','PermohonanVerlokController@lokasi');
	Route::resource('laporan_verlok','LaporanVerlokController');
	Route::get('laporan_verlok/lokasi/{id}','LaporanVerlokController@lokasi');
	Route::resource('rekomendasi','RekomendasiController');
	Route::get('koordinat','RekomendasiController@koordinat');
	Route::resource('wilayah','WilayahController');
	Route::get('wilayah/map/{id}','WilayahController@map');
	Route::get('map',function(){
		return view('superadmin.map.index');
	});

	Route::resource('permohonan_rekomendasi','PermohonanRekomendasiController');

});

Route::get('send-wa','NotifController@test');