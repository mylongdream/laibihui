<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandMealCartModel extends Model
{
	protected $table = 'brand_meal_cart';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

    public function meal()
    {
        return $this->belongsTo('App\Models\BrandMealModel', 'meal_id', 'id');
    }
}
