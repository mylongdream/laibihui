<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonUserSignModel extends Model
{

	protected $table = 'common_user_sign';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
