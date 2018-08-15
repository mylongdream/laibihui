<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonAdminLogModel;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/index';

    protected function redirectTo()
    {
        return route('admin.index');
    }

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'verify' => 'required|captcha',
        ]);
    }
    protected function authenticated(Request $request, $user)
    {
        $user->lastip = request()->getClientIp();
        $user->lastlogin = Carbon::now();
        $user->logincount += 1;
        $user->save();

        $adminlog = new CommonAdminLogModel();
        $adminlog->uid = auth('admin')->user()->uid;
        $adminlog->action = '登录后台';
        $adminlog->useragent = $request->userAgent();
        $adminlog->postip = $request->getClientIp();
        $adminlog->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('auth.succeed'), 'url' => $this->redirectTo()]);
        }
        return false;
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('auth.logout'), 'url' => back()->getTargetUrl()]);
        }else{
            return back();
        }
    }

    public function username()
    {
        return 'username';
    }
}
