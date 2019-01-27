<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;

class CommonCouponModel extends Model
{
    use AmountTrait;

	protected $table = 'common_coupon';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['use_start', 'use_end'];
    protected $amountFields = ['amount', 'fullamount'];

}
