<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonCardOrderShippingModel extends Model
{
	protected $table = 'common_card_order_shipping';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function order()
    {
        return $this->belongsTo('App\Models\CommonCardOrderModel', 'order_id', 'id');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Models\CommonShippingModel', 'shipping_id', 'id');
    }

}
