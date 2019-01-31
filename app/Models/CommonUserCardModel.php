<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class CommonUserCardModel extends Model
{
    use AmountTrait;

    protected $table = 'common_user_card';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['money'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
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
        return $this->belongsTo('App\Models\CommonCardModel', 'number', 'number');
    }

    //用户首次绑卡
    public function bindcard($user, $card)
    {

        $usercard = new CommonUserCardModel();
        $usercard->uid = $user->uid;
        $usercard->number = $card->number;
        $usercard->money = $card->money * 0.9;
        $usercard->postip = request()->getClientIp();
        $usercard->save();

        $user->increment('tiyan_money', $card->money * 0.1)->increment('frozen_money', $card->money * 0.9);

        //优惠券额度转入冻结余额
        $coupons = CommonUserCouponModel::where('uid', $user->uid)->where('getway', 'register')->get();
        foreach($coupons as $key => $value) {
            $value->used_at = Carbon::now();
            $value->save();
            $user->increment('frozen_money', $value->amount);
        }

        return true;
    }

}
