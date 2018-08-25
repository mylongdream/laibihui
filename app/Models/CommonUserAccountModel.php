<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class CommonUserAccountModel extends Model
{
    use AmountTrait;

	protected $table = 'common_user_account';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['user_money', 'frozen_money'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
