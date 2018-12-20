<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatLoginModel extends Model
{

	protected $table = 'wechat_login';
	protected $primaryKey = 'token';
	public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\WechatUserModel', 'wechat_id');
    }

}
