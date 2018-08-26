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
    protected $fillable = ['uid'];

    public function topuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'topuid', 'uid');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

    public function allocation()
    {
        return $this->hasMany('App\Models\CrmAllocationModel', 'uid', 'uid');
    }

    public function sellcard()
    {
        return $this->hasMany('App\Models\CommonUserSellcardModel', 'uid', 'uid');
    }

}
