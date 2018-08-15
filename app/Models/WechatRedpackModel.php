<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;

class WechatRedpackModel extends Model
{
    use AmountTrait;

	protected $table = 'wechat_redpack';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['amount'];

    public function user()
    {
        return $this->belongsTo('App\Models\WechatUserModel', 'openid', 'openid');
    }

}
