<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonAppointModel;
use App\Models\CommonCardModel;
use App\Models\CommonCardOrderModel;
use App\Models\CommonUserAccountModel;
use App\Models\CommonUserCardModel;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;
use Vinkla\Hashids\Facades\Hashids;

class BindCardController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'bindcard');
    }

    public function index(Request $request)
    {
        if($request->isMethod('POST')){
            if(auth()->user()->card){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '你已经绑定过卡了']);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => '你已经绑定过卡了']);
                }
            }
            if(auth()->user()->mobile){
                $rules = array(
                    'number' => 'required|exists:common_card',
                    'password' => 'required',
                );
            }else{
                $rules = array(
                    'number' => 'required|exists:common_card',
                    'password' => 'required',
                    'mobile' => 'bail|required|zh_mobile|unique:common_user|confirm_mobile_not_change',
                    'smscode' => 'required|verify_code',
                );
            }
            $messages = array(
                'number.required' => '卡号不允许为空！',
                'number.exists' => '卡号不存在！',
                'password.required' => '密码不允许为空！',
                'password.exists' => '密码填写错误！',
            );
            $request->validate($rules, $messages);

            $card = CommonCardModel::where('number', $request->number)->where('password', $request->password)->first();
            if(!$card){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('user.card.bind.passwordwrong')]);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.card.bind.passwordwrong')]);
                }
            }
            //卡号已被绑定
            if($card->user){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('user.bindcard.bound')]);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.bindcard.bound')]);
                }
            }
            //未下单过或下单过未付款的不能绑定
            if((!$card->order || $card->order->pay_status != 1) && (!$card->sellcard || $card->sellcard->pay_status != 1)){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '卡号尚未付款无法绑定']);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => '卡号尚未付款无法绑定']);
                }
            }

            //推荐提成到可用余额
            if(auth()->user()->fromuser){
                $user_account = new CommonUserAccountModel();
                $user_account->uid = auth()->user()->fromuser->uid;
                $user_account->user_money = 5;
                $user_account->remark = '一级下线提成';
                $user_account->postip = request()->getClientIp();
                $user_account->save();
                auth()->user()->fromuser->increment('user_money', 500);//提成5元到上级用户可用余额
                if(auth()->user()->fromupuser){
                    $user_account = new CommonUserAccountModel();
                    $user_account->uid = auth()->user()->fromupuser->uid;
                    $user_account->user_money = 0.5;
                    $user_account->remark = '二级下线提成';
                    $user_account->postip = request()->getClientIp();
                    $user_account->save();
                    auth()->user()->fromupuser->increment('user_money', 50);//提成0.5元到上上级用户可用余额
                }
            }

            //邮寄办卡金额翻倍
            $order = CommonCardOrderModel::where('number', $request->number)->latest()->first();
            if ($order && $order->order_type == 1) {
                $card->money = $card->money * 2;
                $card->save();
            }

            //记录绑卡信息
            $usercard = new CommonUserCardModel();
            $usercard->uid = auth()->user()->uid;
            $usercard->number = $card->number;
            $usercard->money = $card->money * 0.9;
            $usercard->postip = request()->getClientIp();
            $usercard->save();

            auth()->user()->tiyan_money = $card->money * 0.1;
            auth()->user()->frozen_money = $card->money * 0.9;
            if(!auth()->user()->mobile){
                auth()->user()->mobile = $request->mobile;
            }
            auth()->user()->save();

            $content = '恭喜您绑卡成功，您的卡号是：'.$card->number;
            Sms::make()->to([86, auth()->user()->mobile])->content($content)->send();

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => trans('user.bindcard.updatesucceed'), 'url' => route('mobile.user.bindcard.index')]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => trans('user.bindcard.updatesucceed'), 'url' => route('mobile.user.bindcard.index')]);
            }
        }else{
            $card = auth()->user()->card;
            return view('mobile.user.bindcard.index', ['card' => $card]);
        }
    }
}
