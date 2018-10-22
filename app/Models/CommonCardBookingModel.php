<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonCardBookingModel extends Model
{
	protected $table = 'common_card_booking';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

}
