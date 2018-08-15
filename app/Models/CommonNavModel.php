<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonNavModel extends Model
{
	protected $table = 'common_nav';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function subweb()
    {
        return $this->belongsTo('App\Models\CommonSubwebModel', 'subweb_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\CommonNavModel', 'parentid');
    }
}
