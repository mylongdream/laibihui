<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;

class CommonUserCouponModel extends Model
{
    use AmountTrait;

	protected $table = 'common_user_coupon';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['use_start', 'use_end', 'used_at'];
    protected $amountFields = ['coupon_amount', 'coupon_fullamount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
