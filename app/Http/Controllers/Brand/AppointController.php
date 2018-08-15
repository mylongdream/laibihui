<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\CommonAppointModel;
use Illuminate\Http\Request;

class AppointController extends Controller
{
    public function index(){
        return view('brand.appoint.index');
    }

    public function store(Request $request){
        $rules = array(
            'realname' => 'required|max:10',
            'gender' => 'required|numeric',
            'mobile' => array('required','regex:/^1[34578][0-9]{9}$/'),
            'address' => 'required|max:150',
            'qq' => 'max:20',
            'remark' => 'max:250',
        );
        $messages = array(
            'realname.required' => '您的姓名不允许为空！',
            'realname.max' => '您的姓名必须小于 :max 个字符。',
            'gender.required' => '您的性别不允许为空！',
            'gender.numeric' => '您的性别选择错误！',
            'mobile.required' => '手机号码不允许为空！',
            'mobile.regex' => '手机号码填写不正确。',
            'address.required' => '您的地址不允许为空！',
            'address.max' => '您的地址必须小于 :max 个字符。',
            'qq.max' => '您的地址必须小于 :max 个字符。',
            'remark.max' => '您的地址必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $appoint = new CommonAppointModel();
        $appoint->realname = $request->realname;
        $appoint->gender = $request->gender;
        $appoint->mobile = $request->mobile;
        $appoint->address = $request->address;
        $appoint->qq = $request->qq;
        $appoint->remark = $request->remark;
        $appoint->postip = request()->getClientIp();
        $appoint->save();

        $setting = cache('setting');
        if (isset($setting['buycard_mobile']) && $setting['buycard_mobile']){
            $content = '网站有客户预约办卡，请尽快联系';
            //Sms::make()->to($setting['buycard_mobile'])->content($content)->send();
        }

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '预约办卡成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.common.message', ['status' => '1', 'info' => '预约办卡成功', 'url' => back()->getTargetUrl()]);
        }
    }

}
