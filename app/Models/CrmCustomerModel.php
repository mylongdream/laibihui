<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmCustomerModel extends Model
{

    protected $table = 'crm_customer';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['refer_at', 'check_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\CrmUserModel', 'uid');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\BrandCategoryModel', 'catid', 'id');
    }

    public function customerfill()
    {
        return $this->hasOne('App\Models\CrmCustomerFillModel', 'customer_id', 'id');
    }

}
