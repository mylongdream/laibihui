<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
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
    protected $redirectTo = '/user/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        return route('user.index');
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
            ]);
        }
        if($login_type == 'fast'){
            $this->validate($request, [
                'mobile' => 'bail|required|zh_mobile|exists:common_user|confirm_mobile_not_change',
                'smscode' => 'required|verify_code',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('auth.logout'), 'url' => back()->getTargetUrl()]);
        }else{
            return back();
        }
    }

}
