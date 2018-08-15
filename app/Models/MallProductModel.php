<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MallProductModel extends Model
{
    use SoftDeletes;
	protected $table = 'mall_product';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['started_at', 'ended_at', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Models\MallCategoryModel', 'catid', 'id');
    }

}
