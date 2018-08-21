<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CommonCardRewardModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;

class CardRewardController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'cardreward');
    }

    public function index(Request $request)
    {
        $list = CommonCardRewardModel::where('type', 1)->where('onsale', 1)->orderBy('created_at', 'desc')->paginate(20);
        return view('user.cardreward.index', ['list' => $list]);
    }

    public function myreward(Request $request)
    {
        $list = CommonCardRewardModel::orderBy('created_at', 'desc')->paginate(20);
        return view('user.cardreward.myreward', ['list' => $list]);
    }

    public function exchange(Request $request)
    {
        if($request->isMethod('POST')){
            $rules = array(
                'amount' => 'required|numeric|min:1',
            );
            $messages = array(
                'amount.required' => '兑换可用余额不允许为空！',
                'amount.numeric' => '兑换可用余额填写不正确！',
                'amount.min' => '兑换可用余额不少于1元！',
            );
            $request->validate($rules, $messages);

            $amount = intval($request->amount);
            $needscore = $amount * 1000;
            if($needscore > auth()->user()->score){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '兑换所需积分不足', 'url' => back()->getTargetUrl()]);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => '兑换所需积分不足', 'url' => back()->getTargetUrl()]);
                }
            }

            $score = new CommonUserScoreModel();
            $score->uid = auth()->user()->uid;
            $score->score = -$needscore;
            $score->remark = '积分兑换可用余额';
            $score->postip = $request->getClientIp();
            $score->save();
            auth()->user()->decrement('score', $needscore);
            auth()->user()->increment('user_money', $amount * 100);

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => trans('user.score.exchangesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.user.message', ['status' => 1, 'info' => trans('user.score.exchangesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('user.score.exchange');
        }
    }

}
