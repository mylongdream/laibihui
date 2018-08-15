<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MallOrderShippingModel extends Model
{
	protected $table = 'mall_order_shipping';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function order()
    {
        return $this->belongsTo('App\Models\MallOrderModel', 'order_id', 'id');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Models\CommonShippingModel', 'shipping_id', 'id');
    }

}
