<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MallOrderModel extends Model
{
    use AmountTrait;
    use SoftDeletes;
	protected $table = 'mall_order';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['pay_at', 'shipping_at', 'finish_at', 'deleted_at'];
    protected $amountFields = ['goods_amount', 'shipping_fee', 'order_amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

    public function address()
    {
        return $this->hasOne('App\Models\MallOrderAddressModel', 'order_id', 'id');
    }

    public function shipping()
    {
        return $this->hasOne('App\Models\MallOrderShippingModel', 'order_id', 'id');
    }

}
