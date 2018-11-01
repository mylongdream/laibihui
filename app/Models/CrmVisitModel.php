<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmVisitModel extends Model
{

    protected $table = 'crm_visit';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

}
