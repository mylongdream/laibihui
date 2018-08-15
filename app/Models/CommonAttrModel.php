<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonAttrModel extends Model
{
	protected $table = 'common_attr';
	protected $primaryKey = 'attr_id';
	public $timestamps = false;

    public function values()
    {
        return $this->hasMany('App\Models\CommonAttrValueModel', 'attr_id');
    }
}
