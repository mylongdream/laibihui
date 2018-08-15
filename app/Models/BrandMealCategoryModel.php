<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandMealCategoryModel extends Model
{
	protected $table = 'brand_meal_category';
	protected $primaryKey = 'id';
	public $timestamps = true;

	public function children()
	{
		return $this->hasMany('App\Models\BrandMealCategoryModel', 'parentid');
	}

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

    public function meallist()
    {
        return $this->hasMany('App\Models\BrandMealModel', 'catid');
    }

}
