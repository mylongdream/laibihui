<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\CommonCardModel;
use Illuminate\Http\Request;

class CheckController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function username(Request $request)
    {
        $rules = array(
            'username' => ['required', 'username_rule', 'unique:common_user,username']
        );
        $messages = array(
            'username.required' => '用户名不允许为空！',
            'username.username_rule' => '用户名格式不正确！',
            'username.unique' => '该用户名已被注册',
        );
        $this->validate($request, $rules, $messages);

        return "true";
    }

    public function mobileRegister(Request $request)
    {
        $rules = array(
            'mobile' => ['required', 'zh_mobile', 'unique:common_user,mobile']
        );
        $messages = array(
            'mobile.required' => '手机号码不允许为空！',
            'mobile.zh_mobile' => '手机号码格式不正确！',
            'mobile.unique' => '该手机号码已被注册',
        );
        $this->validate($request, $rules, $messages);

        return "true";
    }

    public function mobileReset(Request $request)
    {
        $rules = array(
            'mobile' => ['required', 'zh_mobile', 'exists:common_user,mobile']
        );
        $messages = array(
            'mobile.required' => '手机号码不允许为空！',
            'mobile.zh_mobile' => '手机号码格式不正确！',
            'mobile.exists' => '该手机号码不存在',
        );
        $this->validate($request, $rules, $messages);

        return "true";
    }

    public function cardNumber(Request $request)
    {
        $rules = array(
            'number' => ['required', 'exists:common_card,number']
        );
        $messages = array(
            'number.required' => '卡号不能为空',
            'number.exists' => '卡号不正确',
        );
        $this->validate($request, $rules, $messages);

        $card = CommonCardModel::where('number', $request->number)->first();
        if(!$card){
            return response()->json(['status' => '0', 'info' => '卡号不正确']);
        }
        if($card->user){
            return response()->json(['status' => '0', 'info' => '卡号已被绑定']);
        }

        return "true";
    }

    public function cardPassword(Request $request)
    {
        $rules = array(
            'number' => ['required', 'exists:common_card,number'],
            'password' => 'required'
        );
        $messages = array(
            'number.required' => '卡号不能为空',
            'number.exists' => '卡号不正确',
            'password.required' => '密码不能为空',
        );
        $this->validate($request, $rules, $messages);

        $card = CommonCardModel::where('number', $request->number)->where('password', $request->password)->first();
        if(!$card){
            return response()->json(['status' => '0', 'info' => '密码不正确']);
        }
        if($card->user){
            return response()->json(['status' => '0', 'info' => '卡号已被绑定']);
        }

        return "true";
    }

    public function smscode(Request $request)
    {
        $rules = array(
            'smscode' => ['required', 'captcha_check']
        );
        $messages = array(
            'smscode.required' => '验证码不能为空',
            'smscode.captcha_check' => '验证码错误',
        );
        $this->validate($request, $rules, $messages);

        return "true";
    }

}
