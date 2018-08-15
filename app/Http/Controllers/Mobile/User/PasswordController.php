<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'password');
    }

    public function index()
    {
        return view('mobile.user.password.index');
    }

    public function update(Request $request)
    {
        $rules = array(
            'oldpassword' => 'required|min:6|max:30|password_check',
            'newpassword' => 'required|min:6|max:30|confirmed',
        );
        $messages = array(
            'oldpassword.required' => '旧密码不允许为空！',
            'oldpassword.password_check' => '旧密码填写不正确！',
            'newpassword.required' => '新密码不允许为空！',
            'newpassword.confirmed' => '确认新密码错误！',
        );
        $request->validate($rules, $messages);

        auth()->user()->password = bcrypt($request->newpassword);
        auth()->user()->save();

        auth()->logout();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.password.editsucceed'), 'url' => route('mobile.user.password.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.password.editsucceed'), 'url' => route('mobile.user.password.index')]);
        }
    }
}
