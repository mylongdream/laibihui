<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandAppointModel extends Model
{
	protected $table = 'brand_appoint';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['appoint_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }
}
