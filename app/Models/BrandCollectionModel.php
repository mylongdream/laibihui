<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCollectionModel extends Model
{
	protected $table = 'brand_collection';
	protected $primaryKey = 'id';
	public $timestamps = true;

	public function shop()
	{
		return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
	}

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
