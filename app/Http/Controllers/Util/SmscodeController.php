<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\CommonCardModel;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;

class SmscodeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index(Request $request)
    {
        $rules = array(
            'mobile' => ['required', 'zh_mobile']
        );
        $messages = array(
            'mobile.required' => '手机号码不允许为空！',
            'mobile.zh_mobile' => '手机号码格式不正确！',
        );
        if($request->mobilerule == 'register'){
            array_push($rules['mobile'], 'unique:common_user,mobile');
            $messages['mobile.unique'] = '该手机号码已被注册';
        }elseif($request->mobilerule == 'forgotpwd'){
            array_push($rules['mobile'], 'exists:common_user,mobile');
            $messages['mobile.exists'] = '该手机号码不存在';
        }elseif($request->mobilerule == 'active'){
            array_push($rules['mobile'], 'unique:common_user,mobile');
            $rules['number'] = ['required'];
            $rules['password'] = ['required'];
            $messages['mobile.unique'] = '该手机号码已被注册';
            $messages['number.required'] = '请先填写卡号';
            $messages['password.required'] = '请先填写密码';
        }
        $this->validate($request, $rules, $messages);

        if($request->mobilerule == 'active'){
            $card = CommonCardModel::where('number', $request->number)->where('password', $request->password)->first();
            if(!$card){
                return response()->json(['status' => '0', 'info' => '卡密填写不正确']);
            }
            if($card->uid > 0){
                return response()->json(['status' => '0', 'info' => '卡密已被绑定']);
            }
        }

        $minutes = 5;//5分钟内有效
        $seconds = 60;//再次发送验证码时间间隔

        $smscode = session('smscode');
        if ($smscode && $smscode['dateline'] + $seconds > time()){
            return response()->json(['status' => '0', 'info' => '请勿连续发送验证码', 'seconds' => $seconds]);
        }

        $code = '';
        $length = 6;
        $characters = '0123456789';
        for ($i = 0; $i < $length; ++$i) {
            $code .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        $content = '亲爱的用户，您的验证码是'.$code.'。有效期为'.$minutes.'分钟，请尽快验证';
        $result = Sms::make()->to([86, $request->mobile])->content($content)->send();
        $request->session()->put('smscode', [
            'mobile' => $request->mobile,
            'code' => $code,
            'dateline' => time(),
            'deadline' => time() + ($minutes * 60)
        ]);
        return response()->json(['status' => '1', 'info' => '您的验证码是'.$code, 'seconds' => $seconds, 'result' => $result]);
    }

}
