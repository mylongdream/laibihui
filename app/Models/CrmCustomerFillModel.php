<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmCustomerFillModel extends Model
{

    protected $table = 'crm_customer_fill';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo('App\Models\CrmCustomerModel', 'customer_id', 'id');
    }

}
