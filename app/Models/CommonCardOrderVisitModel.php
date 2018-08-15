<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonCardOrderVisitModel extends Model
{
	protected $table = 'common_card_order_visit';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function order()
    {
        return $this->belongsTo('App\Models\CommonCardOrderModel', 'order_id', 'id');
    }

}
