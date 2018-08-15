<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonFeedbackModel extends Model
{
	protected $table = 'common_feedback';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
