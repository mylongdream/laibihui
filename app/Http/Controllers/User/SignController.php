<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserScoreModel;
use App\Models\CommonUserSignModel;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'sign');
    }

    public function index(Request $request)
    {
        $signs = CommonUserSignModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('user.sign.index', ['signs' => $signs]);
    }

    public function store(Request $request)
    {
        $todaysign = CommonUserSignModel::where('uid', auth()->user()->uid)->where('created_at', '>=', date('Ymd'))->first();
        if($todaysign) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '今日您已经签到过了']);
            }else{
                return view('layouts.user.message', ['status' => 0, 'info' => '今日您已经签到过了']);
            }
        }
        $givescore = mt_rand(1,10);

        $usersign = new CommonUserSignModel;
        $usersign->uid = auth()->user()->uid;
        $usersign->score = $givescore;
        $usersign->postip = $request->getClientIp();
        $usersign->save();

        $score = new CommonUserScoreModel();
        $score->uid = auth()->user()->uid;
        $score->score = $givescore;
        $score->remark = '签到领积分';
        $score->postip = $request->getClientIp();
        $score->save();
        auth()->user()->increment('score', $givescore);

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '今日签到成功', 'url' => route('user.index')]);
        }else{
            return view('layouts.user.message', ['status' => '1', 'info' => '今日签到成功', 'url' => route('user.index')]);
        }
    }

}
