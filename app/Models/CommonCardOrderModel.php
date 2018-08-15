<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonCardOrderModel extends Model
{
    use AmountTrait;
    use SoftDeletes;
	protected $table = 'common_card_order';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['pay_at', 'shipping_at', 'finish_at', 'deleted_at'];
    protected $amountFields = ['goods_amount', 'shipping_fee', 'order_amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'fromuid', 'uid');
    }

    public function address()
    {
        return $this->hasOne('App\Models\CommonCardOrderAddressModel', 'order_id', 'id');
    }

    public function visit()
    {
        return $this->hasOne('App\Models\CommonCardOrderVisitModel', 'order_id', 'id');
    }

    public function shipping()
    {
        return $this->hasOne('App\Models\CommonCardOrderShippingModel', 'order_id', 'id');
    }

}
