<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanVerlok extends Model
{
	protected $guarded=[];

	public function get_permohonan()
	{
		return $this->hasOne('App\PermohonanVerlok','id','id_permohonan_verlok');
	}

	public function get_rekomendasi()
	{
		return $this->hasMany('App\Rekomendasi','id_laporan_verlok','id');
	}
}
