<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonFaqCategoryModel extends Model
{
	protected $table = 'common_faq_category';
	protected $primaryKey = 'id';
	public $timestamps = false;

    public function faqs()
    {
        return $this->hasMany('App\Models\CommonFaqModel', 'catid', 'id');
    }

}
