<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmPersonnelModel extends Model
{
    use SoftDeletes;

    protected $table = 'crm_personnel';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function topuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'topuid', 'uid');
    }

    public function subuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'subuid', 'uid');
    }

}
