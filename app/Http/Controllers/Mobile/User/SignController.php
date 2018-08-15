<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserScoreModel;
use App\Models\CommonUserSignModel;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function __construct()
    {
        view()->share(['curmenu' => 'sign', 'prize' => $this->prize()]);
    }

    protected function prize()
    {
        $prize = [
            ['score' => 1, 'title' => '1个积分', 'img' => asset('static/image/mobile/sign/1.png')],
            ['score' => 2, 'title' => '2个积分', 'img' => asset('static/image/mobile/sign/2.png')],
            ['score' => 3, 'title' => '3个积分', 'img' => asset('static/image/mobile/sign/3.png')],
            ['score' => 4, 'title' => '4个积分', 'img' => asset('static/image/mobile/sign/4.png')],
            ['score' => 5, 'title' => '5个积分', 'img' => asset('static/image/mobile/sign/5.png')],
            ['score' => 6, 'title' => '6个积分', 'img' => asset('static/image/mobile/sign/6.png')],
            ['score' => 7, 'title' => '7个积分', 'img' => asset('static/image/mobile/sign/7.png')],
            ['score' => 8, 'title' => '8个积分', 'img' => asset('static/image/mobile/sign/8.png')],
            ['score' => 9, 'title' => '9个积分', 'img' => asset('static/image/mobile/sign/9.png')],
            ['score' => 10, 'title' => '10个积分', 'img' => asset('static/image/mobile/sign/10.png')]
        ];
        return $prize;
    }

    public function index(Request $request)
    {
        $todaysign = CommonUserSignModel::where('uid', auth()->user()->uid)->where('created_at', '>=', date('Ymd'))->first();
        $signs = CommonUserSignModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.user.sign.index', ['todaysign' => $todaysign, 'signs' => $signs]);
    }

    public function store(Request $request)
    {
        $todaysign = CommonUserSignModel::where('uid', auth()->user()->uid)->where('created_at', '>=', date('Ymd'))->first();
        if($todaysign) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '今日您已经签到过了']);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '今日您已经签到过了']);
            }
        }
        $prize = $this->prize();
        $prizekey = mt_rand(0,count($prize)-1);
        $angle = $prizekey*(360/count($prize));
        $prize = $prize[$prizekey];
        $givescore = $prize['score'];
        $info = '恭喜获得'.$prize['title'];

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
            return response()->json(['status' => '1', 'info' => $info, 'angle' => $angle, 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => $info, 'angle' => $angle, 'url' => back()->getTargetUrl()]);
        }
    }

}
