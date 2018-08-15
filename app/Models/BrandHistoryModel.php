<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandHistoryModel extends Model
{
	protected $table = 'brand_history';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = ['uid', 'shop_id'];

	public function shop()
	{
		return $this->belongsTo('App\Models\BrandShopModel', 'shop_id', 'id');
	}

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

}
