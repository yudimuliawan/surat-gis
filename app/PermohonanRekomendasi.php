<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermohonanRekomendasi extends Model
{
	protected $guarded=[];

	public function get_laporan()
	{
		$this->hasMany('App\LaporanVerlok','id_permohonan_verlok','id');
	}
}
