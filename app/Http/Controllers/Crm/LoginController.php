<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/crm/index';

    protected function redirectTo()
    {
        return route('crm.index');
    }

    public function __construct()
    {
        $this->middleware('guest:crm', ['except' => 'logout']);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'verify' => 'required|captcha',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
                ['username' => $request->account, 'password' => $request->password], $request->has('remember')
            ) || $this->guard()->attempt(
                ['mobile' => $request->account, 'password' => $request->password], $request->has('remember')
            );
    }

    protected function authenticated(Request $request, $user)
    {
        $user->lastip = request()->getClientIp();
        $user->lastlogin = Carbon::now();
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('auth.succeed'), 'url' => $this->redirectTo()]);
        }else{
            return redirect()->intended($this->redirectTo());
        }
    }

    public function showLoginForm()
    {
        return view('crm.login');
    }

    protected function guard()
    {
        return auth()->guard('crm');
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
        return 'account';
    }
}
