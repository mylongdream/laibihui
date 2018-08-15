<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class BrandProductModel extends Model
{
    use SoftDeletes;
	protected $table = 'brand_product';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id');
    }

	public function subweb()
	{
		return $this->belongsTo('App\Models\CommonSubwebModel', 'subweb_id');
	}

}
