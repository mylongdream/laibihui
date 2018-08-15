<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonAdminMenuModel extends Model
{
	protected $table = 'common_admin_menu';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function children()
	{
		return $this->hasMany('App\Models\CommonAdminMenuModel', 'parentid');
	}
}
