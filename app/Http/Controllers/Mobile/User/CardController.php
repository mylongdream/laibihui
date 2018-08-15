<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonAppointModel;
use App\Models\CommonCardModel;
use App\Models\CommonCardOrderModel;
use App\Models\CommonUserCardModel;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;

class CardController extends Controller
{
    public function __construct()
    {
    }

    public function appoint(Request $request)
    {
        view()->share('curmenu', 'card-appoint');
        $appoints = CommonAppointModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(10);
        return view('mobile.user.card.appoint', ['appoints' => $appoints]);
    }

    public function bind(Request $request)
    {
        view()->share('curmenu', 'card-bind');
        if($request->isMethod('POST')){
            $rules = array(
                'number' => 'required|exists:common_card',
                'password' => 'required',
            );
            $messages = array(
                'number.required' => '卡号不允许为空！',
                'number.exists' => '卡号不存在！',
                'password.required' => '密码不允许为空！',
            );
            $request->validate($rules, $messages);

            $card = CommonCardModel::where('number', $request->number)->where('password', $request->password)->first();
            if(!$card){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('user.card.bind.passwordwrong')]);
                }else{
                    return view('layouts.user.message', ['status' => 0, 'info' => trans('user.card.bind.passwordwrong')]);
                }
            }
            if($card->user){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('user.card.bind.bound')]);
                }else{
                    return view('layouts.user.message', ['status' => 0, 'info' => trans('user.card.bind.bound')]);
                }
            }

            //推荐提成到冻结余额
            $fromuid = $fromupuid = 0;
            $order = CommonCardOrderModel::where('number', $request->number)->latest()->first();
            if ($order){
                if($order->fromuid){
                    $fromuid = $order->fromuid;
                }
                if($order->uid != auth()->user()->uid){
                    $fromuid = $order->uid;
                }
                if($fromuid){
                    $fromuser = CommonUserCardModel::where('uid', $fromuid)->first();
                    $fromuser->user->increment('frozen_money', 500);//提成5元到上级用户冻结余额
                    if ($fromuser && $fromuser->fromuid){
                        $fromupuid = $fromuser->fromuid;
                        $fromupuser = CommonUserCardModel::where('uid', $fromupuid)->first();
                        $fromupuser->user->increment('frozen_money', 50);//提成0.5元到上上级用户冻结余额
                    }
                }
            }

            if($card->order){
                if($card->order->order_type == 1) {
                    $card->money = $card->money * 2;
                    $card->save();
                }
            }
            $usercard = new CommonUserCardModel();
            $usercard->uid = auth()->user()->uid;
            $usercard->number = $card->number;
            $usercard->money = $card->money * 0.9;
            $usercard->referee = $request->referee;
            $usercard->fromuid = $fromuid;
            $usercard->fromupuid = $fromupuid;
            $usercard->postip = request()->getClientIp();
            $usercard->save();

            auth()->user()->tiyan_money += $card->money * 0.1;
            auth()->user()->frozen_money += $card->money * 0.9;
            auth()->user()->save();

            $content = '恭喜您绑卡成功，您的卡号是：'.$card->number;
            Sms::make()->to([86, auth()->user()->mobile])->content($content)->send();

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => trans('user.card.bind.updatesucceed'), 'url' => route('mobile.user.card.bind')]);
            }else{
                return view('layouts.user.message', ['status' => 1, 'info' => trans('user.card.bind.updatesucceed'), 'url' => route('mobile.user.card.bind')]);
            }
        }else{
            $card = auth()->user()->card;
            return view('mobile.user.card.bind', ['card' => $card]);
        }
    }
}
