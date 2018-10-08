<?php

namespace App\Http\Controllers\Crm\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'account');
    }

    public function index(Request $request)
    {
        return view('crm.shop.account.index');
    }

    public function password(Request $request)
    {
        if ($request->isMethod('POST')) {
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

            auth('crm')->user()->password = bcrypt($request->newpassword);
            auth('crm')->user()->save();

            auth('crm')->logout();

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '密码修改成功', 'url' => route('crm.account.password')]);
            }else{
                return view('layouts.crm.message', ['status' => 1, 'info' => '密码修改成功', 'url' => route('crm.account.password')]);
            }
        }else{
            return view('crm.shop.account.password');
        }
    }

}
