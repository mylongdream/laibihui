<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;

class CommonUserRedpackModel extends Model
{
    use AmountTrait;

	protected $table = 'common_user_redpack';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['use_start', 'use_end', 'used_at'];
    protected $amountFields = ['redpack_amount', 'redpack_fullamount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
