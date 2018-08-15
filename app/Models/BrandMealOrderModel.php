<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class BrandMealOrderModel extends Model
{
    use AmountTrait;

	protected $table = 'brand_meal_order';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $amountFields = ['consume_money', 'discount_money', 'indiscount_money', 'tiyan_money', 'order_amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

    public function records()
    {
        return $this->hasMany('App\Models\BrandMealRecordModel', 'order_id', 'id');
    }

}
