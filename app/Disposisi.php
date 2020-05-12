<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
	protected $guarded=[];

	public function get_surat()
	{
		return $this->hasOne('App\SalinanSurat','id','id_surat');
	}
}
