<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\WechatLoginModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hashKey = $this->hashKey();
        $wechatLogin = new WechatLoginModel();
        $wechatLogin->token = $hashKey;
        $wechatLogin->postip = request()->getClientIp();
        $wechatLogin->save();
        $app = app('wechat.official_account');
        $qrcode = $app->qrcode->temporary('login_'.$hashKey, 6 * 24 * 3600);
        $qrcode = $app->qrcode->url($qrcode['ticket']);
        return view('auth.wechat', ['qrcode' => $qrcode, 'checkurl' => route('auth.wechat.check', ['token' => $hashKey])]);
    }

    public function check(Request $request)
    {
        $wechatLogin = WechatLoginModel::where('token', $request->token)->first();
        if($wxuser = $wechatLogin->user){
            $wxuser->user->lastlogin = Carbon::now();
            $wxuser->user->save();
            auth()->login($wxuser->user, true);
            $wechatLogin->delete();
            return response()->json(['status' => 1, 'url' => back()->getTargetUrl()]);
        }else{
            return response()->json(['status' => 0, 'url' => back()->getTargetUrl()]);
        }
    }


    protected function hashKey()
    {
        $key = config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $key = hash_hmac('sha256', Str::random(40), $key);
        return $key;
    }
}
