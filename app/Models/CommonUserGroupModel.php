<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonUserGroupModel extends Model
{
	protected $table = 'common_user_group';
	protected $primaryKey = 'id';
	public $timestamps = false;

    //微信标签
    public function wechat_tag()
    {
        return $this->hasOne('App\Models\WechatTagModel', 'tag_id', 'id');
    }

}
