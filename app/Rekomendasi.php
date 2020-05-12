<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
	protected $guarded=[];

	public function get_surat()
	{
		return $this->hasOne('App\SalinanSurat','id','id_surat');
	}

	public function get_laporan()
	{
		return $this->hasOne('App\LaporanVerlok','id','id_laporan_verlok');
	}
}
