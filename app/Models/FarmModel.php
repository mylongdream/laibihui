<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class FarmModel extends Model
{
    use AmountTrait;
    use SoftDeletes;
	protected $table = 'brand_farm';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['started_at', 'ended_at', 'deleted_at'];
    protected $amountFields = ['price'];

	public function subweb()
	{
		return $this->belongsTo('App\Models\CommonSubwebModel', 'subweb_id');
	}

    public function attrs()
    {
        return $this->hasMany('App\Models\FarmAttrModel', 'farm_id', 'id');
    }

    public function package()
    {
        return $this->hasMany('App\Models\FarmPackageModel', 'farm_id', 'id');
    }

}
