<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalinanSurat extends Model
{
	protected $guarded=[];

	public function get_disposisi()
	{
		return $this->hasMany('App\Disposisi','id_surat','id');
	}

	public function get_verlok()
	{
		return $this->hasMany('App\PermohonanVerlok','id_surat','id');
	}

	public function get_rekomendasi()
	{
		return $this->hasMany('App\Rekomendasi','id_surat','id');
	}
}
