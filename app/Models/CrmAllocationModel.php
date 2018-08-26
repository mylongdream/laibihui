<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmAllocationModel extends Model
{

    protected $table = 'crm_allocation';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

}
