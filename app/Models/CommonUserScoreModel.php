<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonUserScoreModel extends Model
{

	protected $table = 'common_user_score';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
