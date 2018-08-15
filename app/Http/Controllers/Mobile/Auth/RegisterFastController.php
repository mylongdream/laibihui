<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Models\CommonUserModel;
use App\Http\Controllers\Controller;
use App\Models\CommonUserScoreModel;
use App\Models\WechatUserModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterFastController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function redirectTo()
    {
        return route('mobile.user.index');
    }

    public function showRegistrationForm()
    {
        if(!session('wechat.oauth_user.default') && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
            return response()->redirectToRoute('wechat.login');
        }
        return view('mobile.auth.register_fast');
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function registered(Request $request, $user)
    {
        $setting = cache('setting');
        //推广注册
        $fromuid = !empty($request->cookie('promotion')) && isset($setting['promotion_register']) && $setting['promotion_register'] ? intval($request->cookie('promotion')) : 0;
        if ($fromuid && $fromuid != $user->uid){
            $fromuser = CommonUserModel::where('uid', $fromuid)->first();
            if ($fromuser) {
                $score = new CommonUserScoreModel();
                $score->uid = $fromuser->uid;
                $score->score = $setting['promotion_register'];
                $score->remark = '推广注册得积分';
                $score->postip = $request->getClientIp();
                $score->save();
                $fromuser->increment('score', $setting['promotion_register']);
            }
        }

        if(session('wechat.oauth_user.default') && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
            $userinfo = session('wechat.oauth_user.default');
            $wxuser = WechatUserModel::firstOrCreate(['openid' => $userinfo['id']]);
            $wxuser->user_id = $user->uid;
            $wxuser->save();
        }
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('auth.register'), 'url' => $this->redirectPath()]);
        }
        return false;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => 'bail|required|zh_mobile|unique:common_user|confirm_mobile_not_change',
            'smscode' => 'required|verify_code',
            'password' => 'bail|required|min:6|max:14|password_rule',
        ]);
    }

    protected function create(array $data)
    {
        return CommonUserModel::create([
            'username' => $data['mobile'],
            'password' => bcrypt($data['password']),
            'mobile' => $data['mobile'],
            'regip' => request()->getClientIp(),
        ]);
    }
}
