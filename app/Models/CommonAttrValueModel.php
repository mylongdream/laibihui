<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonAttrValueModel extends Model
{
	protected $table = 'common_attr_value';
	protected $primaryKey = 'attr_value_id';
	public $timestamps = false;

    public function attr()
    {
        return $this->belongsTo('App\Models\CommonAttrModel', 'attr_id');
    }

}
