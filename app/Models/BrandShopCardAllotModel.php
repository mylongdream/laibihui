<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class BrandShopCardAllotModel extends Model
{
    use AmountTrait;

    protected $table = 'brand_shop_card_allot';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['price'];

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

    public function cardlist()
    {
        return $this->hasMany('App\Models\BrandShopCardModel', 'allot_id');
    }

}
