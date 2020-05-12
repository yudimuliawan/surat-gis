<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\{SalinanSurat,LaporanVerlok,Disposisi,PermohonanVerlok};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-surat/{id}',function($id){
	return SalinanSurat::find($id);
});

Route::get('get-laporan-verlok/{id}',function($id){
	return LaporanVerlok::with('get_permohonan')->find($id);
});

Route::get('get-kode-disposisi/{type}',function($type){
	$number = disposisi::latest()->first();
	if (!empty($number)) {
		$number = $number->id + 1;
	}else{
		$number = 1;
	}

	if ($type=='K') {
		$kode  = '545/'.str_pad($number, 4,0,STR_PAD_LEFT).'/124.3/'.date('Y');
	}else{
		$kode  = '545/'.str_pad($number, 4,0,STR_PAD_LEFT).'/124.2/'.date('Y');
	}
	return $kode;
});

Route::get('get-permohonan/{id_surat}',function($id){
	return PermohonanVerlok::find($id);
});