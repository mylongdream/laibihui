<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
use App\Models\CommonUserScoreModel;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'score');
    }

    public function index(Request $request)
    {
        $scores = CommonUserScoreModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('user.score.index', ['scores' => $scores]);
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
                    return view('layouts.user.message', ['status' => 0, 'info' => '兑换所需积分不足', 'url' => back()->getTargetUrl()]);
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

    public function transfer(Request $request)
    {
        if($request->isMethod('POST')){
            $rules = array(
                'amount' => 'required|numeric|min:1',
                'account' => 'required',
                'message' => 'nullable|max:20',
            );
            $messages = array(
                'amount.required' => '转让积分数不允许为空！',
                'amount.numeric' => '转让积分数填写不正确！',
                'amount.min' => '转让积分数不能少于1个！',
                'account.required' => '转让对方账户不允许为空！',
                'message.max' => '转让说明必须小于 :max 个字符！',
            );
            $request->validate($rules, $messages);

            $amount = intval($request->amount);
            if($amount > auth()->user()->score){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '转让积分数不足', 'url' => back()->getTargetUrl()]);
                }else{
                    return view('layouts.user.message', ['status' => 0, 'info' => '转让积分数不足', 'url' => back()->getTargetUrl()]);
                }
            }

            $user = CommonUserModel::where('username', $request->account)->orWhere('mobile', $request->account)->first();
            if(!$user){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '转让对方账户不存在', 'url' => back()->getTargetUrl()]);
                }else{
                    return view('layouts.user.message', ['status' => 0, 'info' => '转让对方账户不存在', 'url' => back()->getTargetUrl()]);
                }
            }

            $score = new CommonUserScoreModel();
            $score->uid = $user->uid;
            $score->score = $amount;
            $score->remark = '积分转让'.($request->message ? '('.$request->message.')' : '');
            $score->postip = $request->getClientIp();
            $score->save();
            $user->increment('score', $amount);

            $score = new CommonUserScoreModel();
            $score->uid = auth()->user()->uid;
            $score->score = -$amount;
            $score->remark = '积分转让给用户'.$user->username;
            $score->postip = $request->getClientIp();
            $score->save();
            auth()->user()->decrement('score', $amount);

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => trans('user.score.transfersucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.user.message', ['status' => 1, 'info' => trans('user.score.transfersucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('user.score.transfer');
        }
    }

}
