<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function __construct()
    {
        //view()->share('curmenu', 'survey');
    }

    public function index(Request $request)
    {
        return view('user.survey.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'gender' => 'required|numeric',
            'birthday' => 'required|date',
        );
        $messages = array(
            'oldpassword.required' => '旧密码不允许为空！',
            'oldpassword.password_check' => '旧密码填写不正确！',
            'newpassword.required' => '新密码不允许为空！',
            'newpassword.confirmed' => '确认新密码错误！',
        );
        $request->validate($rules, $messages);

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.survey.editsucceed'), 'url' => route('user.survey.index')]);
        }else{
            return view('layouts.user.message', ['status' => '1', 'info' => trans('user.survey.editsucceed'), 'url' => route('user.survey.index')]);
        }
    }

}
