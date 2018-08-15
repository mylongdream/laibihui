<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonDistrictModel extends Model
{
	protected $table = 'common_district';
	protected $primaryKey = 'id';
    public $timestamps = false;

    public function subweb() {
        return $this->hasOne('App\Models\CommonSubwebModel');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'upid');
    }

    public function children()
    {
        return $this->hasMany('App\Models\CommonDistrictModel', 'upid');
    }
}
