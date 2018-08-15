<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonFaqModel extends Model
{
	protected $table = 'common_faq';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function category()
    {
        return $this->belongsTo('App\Models\CommonFaqCategoryModel', 'catid', 'id');
    }

}
