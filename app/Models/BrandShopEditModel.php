<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandShopEditModel extends Model
{

    protected $table = 'brand_shop_edit';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

}
