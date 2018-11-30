<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmGrantcancelModel extends Model
{

    protected $table = 'crm_grantsell_cancel';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function topuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'topuid', 'uid');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

}
