<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmCommentModel extends Model
{
    use SoftDeletes;
	protected $table = 'brand_farm_comment';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid', 'uid');
    }

	public function farm()
	{
		return $this->belongsTo('App\Models\FarmModel', 'farm_id');
	}

	public function order()
	{
		return $this->belongsTo('App\Models\FarmOrderModel', 'order_id');
	}

}
