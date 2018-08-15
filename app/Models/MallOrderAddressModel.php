<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MallOrderAddressModel extends Model
{
	protected $table = 'mall_order_address';
	protected $primaryKey = 'id';
	public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('App\Models\MallOrderModel', 'order_id', 'id');
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
