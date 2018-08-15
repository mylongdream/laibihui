<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandShopCardModel extends Model
{

    protected $table = 'brand_shop_card';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function card()
    {
        return $this->hasOne('App\Models\CommonUserCardModel', 'number', 'number');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

    public function allot()
    {
        return $this->belongsTo('App\Models\BrandShopCardAllotModel', 'allot_id', 'id');
    }

}
