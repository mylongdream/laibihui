<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCategoryModel extends Model
{
	protected $table = 'brand_category';
	protected $primaryKey = 'id';
	public $timestamps = false;
    protected $appends = ['shoplist'];

	public function children()
	{
		return $this->hasMany('App\Models\BrandCategoryModel', 'parentid');
	}

    public function shops()
    {
        return $this->hasMany('App\Models\BrandShopModel', 'catid', 'id');
    }

    public function getShoplistAttribute()
    {
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        $incatid = collect(category_tree($categorylist, $this->id))->pluck('id')->prepend($this->id);
        $shoplist = BrandShopModel::whereIn('catid', $incatid)->latest()->get();
        return $shoplist;
    }

    public function subshops()
    {
        return $this->hasManyThrough('App\Models\BrandShopModel', 'App\Models\BrandCategoryModel', 'parentid', 'catid', 'id');
    }
}
