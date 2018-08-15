<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmPackageModel extends Model
{
	protected $table = 'brand_farm_package';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function farm()
	{
		return $this->belongsTo('App\Models\FarmModel', 'farm_id');
	}

}
