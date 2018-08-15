<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCommentModel extends Model
{
	protected $table = 'brand_comment';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
    }
}
