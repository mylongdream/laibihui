<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandConsumeModel extends Model
{
    use AmountTrait;
    use SoftDeletes;

	protected $table = 'brand_consume';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['pay_at', 'deleted_at'];
	protected $amountFields = ['consume_money', 'discount_money', 'indiscount_money', 'tiyan_money', 'order_amount', 'cash_amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }
}
