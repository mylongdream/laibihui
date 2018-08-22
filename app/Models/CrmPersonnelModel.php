<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmPersonnelModel extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'crm_personnel';
	protected $primaryKey = 'id';
	public $timestamps = true;

}
