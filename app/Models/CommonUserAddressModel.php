<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonUserAddressModel extends Model
{

	protected $table = 'common_user_address';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
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

    public function getstreet()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'street', 'id');
    }

}
