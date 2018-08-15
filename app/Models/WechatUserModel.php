<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class WechatUserModel extends Authenticatable
{
    use Notifiable;

	protected $table = 'wechat_user';
	protected $primaryKey = 'uid';
	public $timestamps = true;

    protected $fillable = ['openid'];


    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'user_id');
    }

}
