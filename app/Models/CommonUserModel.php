<?php

namespace App\Models;


use Carbon\Carbon;
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
        return $this->hasOne('App\Models\BrandShopModel', 'moderator', 'username');
    }

    //卖卡人员
    public function personnel()
    {
        return $this->hasOne('App\Models\CrmPersonnelModel', 'uid', 'uid');
    }

    //自动注册
    public function register($data)
    {
        $user = new CommonUserModel();
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->mobile = $data['mobile'];
        $user->frozen_money = 100;
        $user->regip = request()->getClientIp();
        $user->save();
        //注册赠送优惠券
        $coupons = CommonCouponModel::where('getway', 'register')->get();
        foreach($coupons as $key => $value) {
            $user_coupon = new CommonUserCouponModel();
            $user_coupon->uid = $user->uid;
            $user_coupon->coupon_id = $value->id;
            $user_coupon->coupon_name = $value->name;
            $user_coupon->coupon_amount = $value->amount;
            $user_coupon->coupon_fullamount = $value->fullamount;
            if($value->use_limit == 1){
                $user_coupon->use_start = Carbon::now();
                $user_coupon->use_end = Carbon::now()->addDays($value->use_days);
            }else{
                $user_coupon->use_start = $value->use_start;
                $user_coupon->use_end = $value->use_end;
            }
            $user_coupon->getway = $value->getway;
            $user_coupon->remark = $value->remark;
            $user_coupon->postip = request()->getClientIp();
            $user_coupon->save();
        }
        return $user;
    }
}
