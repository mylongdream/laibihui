<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use HaoLi\LaravelAmount\Traits\AmountTrait;


class CommonUserModel extends Authenticatable
{
    use AmountTrait;

    use Notifiable;

	protected $table = 'common_user';
	protected $primaryKey = 'uid';
	public $timestamps = true;
    protected $dates = ['lastlogin'];
    protected $amountFields = ['user_money', 'frozen_money', 'tiyan_money', 'consume_money'];

    protected $fillable = [
        'username', 'mobile', 'password', 'regip',
    ];

	protected $hidden = [
		'password', 'remember_token',
	];

    public function group()
    {
        return $this->belongsTo('App\Models\CommonUserGroupModel', 'group_id');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\CommonUserProfileModel', 'uid');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'fromuid', 'uid');
    }

    public function fromupuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'fromupuid', 'uid');
    }

    //用户绑卡
    public function card()
    {
        return $this->hasOne('App\Models\CommonUserCardModel', 'uid');
    }

    //用户调查
    public function survey()
    {
        return $this->hasOne('App\Models\CommonSurveyModel', 'uid');
    }

    //用户收藏
    public function collections()
    {
        return $this->hasMany('App\Models\BrandCollectionModel', 'uid');
    }

    //收货地址
    public function addresses()
    {
        return $this->hasMany('App\Models\CommonUserAddressModel', 'uid');
    }

    //管理商家
    public function shop()
    {
        return $this->hasOne('App\Models\BrandShopModel', 'username', 'username');
    }

    //卖卡人员
    public function personnel()
    {
        return $this->hasOne('App\Models\CrmPersonnelModel', 'uid', 'uid');
    }
}
