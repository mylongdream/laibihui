<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandActivityModel extends Model
{
	protected $table = 'brand_activity';
	protected $primaryKey = 'id';
	public $timestamps = true;

	public function subweb()
	{
		return $this->belongsTo('App\Models\CommonSubwebModel', 'subweb_id');
	}

}
