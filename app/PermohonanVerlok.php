<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermohonanVerlok extends Model
{
	protected $guarded=[];

	public function get_surat()
	{
		return $this->hasOne('App\SalinanSurat','id','id_surat');
	}

	public function get_laporan()
	{
		return $this->hasMany('App\LaporanVerlok','id_permohonan_verlok','id');
	}
}
