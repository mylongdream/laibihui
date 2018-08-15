<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonAdminLogModel extends Model
{
	protected $table = 'common_admin_log';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonAdminUserModel', 'uid');
    }
}
