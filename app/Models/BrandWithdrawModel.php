<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class BrandWithdrawModel extends Model
{
    use AmountTrait;

	protected $table = 'brand_withdraw';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $amountFields = ['money'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }
}
