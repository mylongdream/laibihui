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

    public function card()
    {
        return $this->hasOne('App\Models\CommonUserCardModel', 'uid');
    }

    public function survey()
    {
        return $this->hasOne('App\Models\CommonSurveyModel', 'uid');
    }

    public function collections()
    {
        return $this->hasMany('App\Models\BrandCollectionModel', 'uid');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\CommonUserAddressModel', 'uid');
    }

    public function shop()
    {
        return $this->hasOne('App\Models\BrandShopModel', 'username', 'username');
    }

}
