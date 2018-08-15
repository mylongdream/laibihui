<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmOrderModel extends Model
{
    use AmountTrait;
    use SoftDeletes;
	protected $table = 'brand_farm_order';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['gotime', 'pay_at', 'finish_at', 'deleted_at'];
    protected $amountFields = ['order_amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

	public function farm()
	{
		return $this->belongsTo('App\Models\FarmModel', 'farm_id');
	}

}
