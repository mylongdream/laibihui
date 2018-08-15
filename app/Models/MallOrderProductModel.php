<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class MallOrderProductModel extends Model
{
    use AmountTrait;

	protected $table = 'mall_order_product';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $amountFields = ['price'];

    public function order()
    {
        return $this->belongsTo('App\Models\MallOrderModel', 'order_id', 'id');
    }

}
