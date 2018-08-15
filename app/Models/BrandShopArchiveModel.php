<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandShopArchiveModel extends Model
{

    protected $table = 'brand_shop_archive';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['audited_at'];

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\CrmUserModel', 'uid');
    }

}
