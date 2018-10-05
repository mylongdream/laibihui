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

    public function getSubscribeSceneAttribute($value)
    {
        $subscribe_scene = array(
            'ADD_SCENE_SEARCH' => '公众号搜索',
            'ADD_SCENE_ACCOUNT_MIGRATION' => '公众号迁移',
            'ADD_SCENE_PROFILE_CARD' =>'名片分享',
            'ADD_SCENE_QR_CODE' => '扫描二维码',
            'ADD_SCENE_PROFILE_LINK' => '图文页内名称点击',
            'ADD_SCENE_PROFILE_ITEM' => '图文页右上角菜单',
            'ADD_SCENE_PAID' => '支付后关注',
            'ADD_SCENE_OTHERS' => '其他',
        );
        return $subscribe_scene[$value];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'user_id');
    }

}
