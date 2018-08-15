<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\WechatUserModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if(auth()->check()){
            if($request->ReturnUrl){
                return redirect()->to($request->ReturnUrl);
            }else{
                return redirect()->route('mobile.user.index');
            }
        }
        $userinfo = session('wechat.oauth_user.default');
        $wxuser = WechatUserModel::firstOrCreate(['openid' => $userinfo['id']]);
        if($wxuser->user){
            if (1) {
                auth()->login($wxuser->user, true);
                $ReturnUrl = $request->ReturnUrl ? $request->ReturnUrl : route('mobile.user.index');
                return redirect()->to($ReturnUrl);
            }
            if ($request->isMethod('POST')) {
                $ReturnUrl = $request->ReturnUrl;
                if ($request->type == 'login') {
                    auth()->login($wxuser->user, true);
                    $ReturnUrl = $ReturnUrl ? $ReturnUrl : route('mobile.user.index');
                } else {
                    $wxuser->user_id = 0;
                    $wxuser->save();
                    $ReturnUrl = route('mobile.login', ['ReturnUrl' => $ReturnUrl]);
                }
                if ($request->ajax()){
                    return response()->json(['status' => 1, 'url' => $ReturnUrl]);
                }else{
                    return redirect()->to($ReturnUrl);
                }
            } else {
                return view('wechat.login.index', ['user' => $wxuser->user]);
            }
        }
        return redirect()->route('mobile.login', ['ReturnUrl' => $request->ReturnUrl]);
    }

}