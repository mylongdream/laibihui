<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonUserAccountModel extends Model
{

	protected $table = 'common_user_account';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['user_money', 'frozen_money'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
