<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class BrandMealRecordModel extends Model
{
    use AmountTrait;

	protected $table = 'brand_meal_record';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $amountFields = ['price'];

    public function order()
    {
        return $this->belongsTo('App\Models\BrandMealOrderModel', 'order_id', 'id');
    }

}
