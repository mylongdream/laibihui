<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class BrandArticleModel extends Model
{
    use SoftDeletes;
	protected $table = 'brand_article';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function getUploadImageAttribute($value)
    {
        return Hashids::connection('image')->encode($value);
    }

	public function subweb()
	{
		return $this->belongsTo('App\Models\CommonSubwebModel', 'subweb_id');
	}

}
