<?php

namespace App\Http\Controllers\Mobile\Crm;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\WechatUserModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/mobile/crm/index';

    protected function redirectTo()
    {
        return route('mobile.crm.index');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:crm', ['except' => 'logout']);
    }

    public function showLoginForm(Request $request)
    {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
            $userinfo = session('wechat.oauth_user.default');
            if(!$userinfo){
                return response()->redirectToRoute('wechat.login', ['ReturnUrl' => $request->ReturnUrl]);
            }else{
                $wxuser = WechatUserModel::firstOrCreate(['openid' => $userinfo['id']]);
                if($wxuser->user_id){
                    return response()->redirectToRoute('wechat.login', ['ReturnUrl' => $request->ReturnUrl]);
                }
            }
        }
        return view('mobile.crm.login');
    }

    protected function attemptLogin(Request $request)
    {
        $login_type = in_array($request->login_type, array('normal', 'fast')) ? $request->login_type : 'normal';
        if($login_type == 'normal'){
            return $this->guard()->attempt(
                    ['username' => $request->account, 'password' => $request->password], $request->has('remember')
                ) || $this->guard()->attempt(
                    ['mobile' => $request->account, 'password' => $request->password], $request->has('remember')
                );
        }
        if($login_type == 'fast'){
            $user = CommonUserModel::where('mobile', $request->mobile)->first();
            if(is_null($user)){
                return false;
            }
            $this->guard()->login($user, $request->has('remember'));
            return true;
        }
        return false;
    }

    protected function authenticated(Request $request, $user)
    {
        $user->lastip = request()->getClientIp();
        $user->lastlogin = Carbon::now();
        $user->save();
        if(session('wechat.oauth_user.default') && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
            $userinfo = session('wechat.oauth_user.default');
            $wxuser = WechatUserModel::firstOrCreate(['openid' => $userinfo['id']]);
            $wxuser->user_id = $user->uid;
            $wxuser->save();
        }
        $ReturnUrl = $request->ReturnUrl ? $request->ReturnUrl : $this->redirectTo();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('auth.succeed'), 'url' => $ReturnUrl]);
        }else{
            return redirect()->intended($ReturnUrl);
        }
    }

    protected function validateLogin(Request $request)
    {
        $login_type = in_array($request->login_type, array('normal', 'fast')) ? $request->login_type : 'normal';
        if($login_type == 'normal'){
            $this->validate($request, [
                'account' => 'required',
                'password' => 'required',
                'verify' => 'required|captcha',
            ]);
        }
        if($login_type == 'fast'){
            $this->validate($request, [
                'mobile' => 'bail|required|zh_mobile|exists:common_user|confirm_mobile_not_change',
                'smscode' => 'required|verify_code',
            ]);
        }
    }

    protected function guard()
    {
        return auth()->guard('crm');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        if(session('wechat.oauth_user.default') && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
            $userinfo = session('wechat.oauth_user.default');
            $wxuser = WechatUserModel::firstOrCreate(['openid' => $userinfo['id']]);
            $wxuser->user_id = 0;
            $wxuser->save();
        }
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('auth.logout'), 'url' => back()->getTargetUrl()]);
        }else{
            return back();
        }
    }

    public function username()
    {
        return 'account';
    }

}
