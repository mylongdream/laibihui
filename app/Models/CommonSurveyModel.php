<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonSurveyModel extends Model
{
	protected $table = 'common_survey';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['birthday'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
