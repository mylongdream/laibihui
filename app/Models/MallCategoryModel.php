<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MallCategoryModel extends Model
{
	protected $table = 'mall_category';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function children()
	{
		return $this->hasMany('App\Models\MallCategoryModel', 'parentid');
	}

}
