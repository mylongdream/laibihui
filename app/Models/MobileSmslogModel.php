<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileSmslogModel extends Model
{
    use SoftDeletes;

	protected $table = 'mobile_smslog';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['last_fail_time', 'sent_time', 'deleted_at'];

    protected $fillable = [
        'phone', 'temp_id', 'data', 'content', 'voice_code'
    ];

}
