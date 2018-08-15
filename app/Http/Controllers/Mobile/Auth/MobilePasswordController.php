<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MobilePasswordController extends Controller
{
    protected $expires = 60 * 60;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('mobile.auth.forgotpwd.mobile');
    }

    public function sendResetLinkMobile(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'bail|required|zh_mobile|exists:common_user|confirm_mobile_not_change',
            'smscode' => 'required|verify_code',
        ]);
        $expiredAt = Carbon::now()->subSeconds($this->expires);
        DB::table('common_user_password_mobile')->where('created_at', '<', $expiredAt)->delete();
        DB::table('common_user_password_mobile')->where('mobile', $request->mobile)->delete();
        $hashKey = $this->hashKey();
        DB::table('common_user_password_mobile')->insert(
            ['mobile' => $request->mobile, 'token' => $hashKey, 'created_at'=>Carbon::now()]
        );
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '', 'url' => route('forgotpwd.reseturl', ['token' => $hashKey])]);
        }else{
            return redirect()->route('mobile.forgotpwd.reseturl', ['token' => $hashKey]);
        }
    }

    public function showResetForm(Request $request, $token = null)
    {
        $reset = DB::table('common_user_password_mobile')->where('token', $token)->first();
        if(!$reset){
            return back();
        }
        return view('mobile.auth.forgotpwd.reset')->with(
            ['token' => $token, 'mobile' => $reset->mobile]
        );
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|exists:common_user_password_mobile,token',
            'mobile' => 'required|zh_mobile|exists:common_user_password_mobile,mobile',
            'password' => 'bail|required|min:6|max:14|password_rule|confirmed',
        ]);
        $token = DB::table('common_user_password_mobile')->where('mobile', $request->mobile)->where('token', $request->token)->first();
        DB::table('common_user')->where('mobile', $token->mobile)->update(['password' => bcrypt($request->password)]);
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('auth.reset'), 'url' => route('login')]);
        }else {
            return redirect()->route('login');
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
