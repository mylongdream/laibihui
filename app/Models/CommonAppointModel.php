<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonAppointModel extends Model
{
	protected $table = 'common_appoint';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['pay_at'];

    public function fromuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'fromuid', 'uid');
    }

}
