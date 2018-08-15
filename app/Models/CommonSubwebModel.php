<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonSubwebModel extends Model
{
	protected $table = 'common_subweb';
	protected $primaryKey = 'subweb_id';
    public $timestamps = false;

	public function district()
	{
		return $this->belongsTo('App\Models\CommonDistrictModel', 'district_id');
	}

}
