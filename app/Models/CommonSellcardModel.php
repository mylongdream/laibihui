<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class CommonSellcardModel extends Model
{

    use AmountTrait;

	protected $table = 'common_sellcard';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['pay_at'];
    protected $amountFields = ['order_amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'fromuid');
    }

}
