<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class CommonCardModel extends Model
{
    use AmountTrait;

    use SoftDeletes;
	protected $table = 'common_card';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $amountFields = ['money'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserCardModel', 'number', 'number');
    }

    public function allot()
    {
        return $this->belongsTo('App\Models\BrandShopCardModel', 'number', 'number');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\CommonCardOrderModel', 'number', 'number');
    }

}
