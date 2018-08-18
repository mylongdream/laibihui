<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonUserSellcardModel extends Model
{

	protected $table = 'common_user_sellcard';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['order_amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
