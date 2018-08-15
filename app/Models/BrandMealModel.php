<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class BrandMealModel extends Model
{
    use AmountTrait;

	protected $table = 'brand_meal';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $amountFields = ['price'];
    protected $appends = ['cart'];

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\BrandMealCategoryModel', 'catid', 'id');
    }

    public function getCartAttribute()
    {
        $cart = '';
        if(auth()->check()){
            $cart = BrandMealCartModel::where('meal_id', $this->id)->where('uid', auth()->user()->uid)->latest()->first();
        }
        return $cart;
    }

}
