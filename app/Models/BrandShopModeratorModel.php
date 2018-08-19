<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandShopModeratorModel extends Model
{

    protected $table = 'brand_shop_moderator';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

}
