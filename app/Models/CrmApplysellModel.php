<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmApplysellModel extends Model
{

    protected $table = 'crm_applysell';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

}
