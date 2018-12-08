<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmGrantsellModel extends Model
{

    protected $table = 'crm_grantsell';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function topuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'topuid', 'uid');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

    public function getprovince()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'province', 'id');
    }

    public function getcity()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'city', 'id');
    }

    public function getarea()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'area', 'id');
    }

}
