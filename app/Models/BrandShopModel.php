<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandShopModel extends Model
{
    use SoftDeletes;
	protected $table = 'brand_shop';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['started_at', 'ended_at', 'deleted_at'];

	public function subweb()
	{
		return $this->belongsTo('App\Models\CommonSubwebModel', 'subweb_id');
	}

    public function category()
    {
        return $this->belongsTo('App\Models\BrandCategoryModel', 'catid', 'id');
    }

    public function mealcategory()
    {
        return $this->hasMany('App\Models\BrandMealCategoryModel', 'shop_id', 'id');
    }

    public function shopcards()
    {
        return $this->hasMany('App\Models\BrandShopCardModel', 'shop_id', 'id');
    }

    public function moderator()
    {
        return $this->hasOne('App\Models\BrandShopModeratorModel', 'shop_id', 'id');
    }

}
