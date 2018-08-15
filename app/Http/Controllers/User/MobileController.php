<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'profile');
    }

    public function index(Request $request)
    {
        return view('user.mobile.index');
    }

    public function create()
    {
        return view('user.mobile.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'mobile' => 'bail|required|zh_mobile|confirm_mobile_not_change|unique:common_user',
            'smscode' => 'required|verify_code',
        );
        $messages = array(
            'number.required' => '卡号不允许为空！',
            'number.password_check' => '卡号不存在！',
            'password.required' => '密码不允许为空！',
        );
        $request->validate($rules, $messages);

        $card = CommonMobileModel::where('number', $request->number)->where('password', $request->password)->first();
        if(!$card){
            return response()->json(['status' => '0', 'info' => trans('user.card.passwordwrong')]);
        }
        $card->uid = auth()->user()->uid;
        $card->used_at = time();
        $card->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.card.updatesucceed'), 'url' => route('user.card.index')]);
        }else{
            return view('layouts.user.message', ['status' => '1', 'info' => trans('user.card.updatesucceed'), 'url' => route('user.card.index')]);
        }
    }

    public function edit()
    {
        return view('user.mobile.edit');
    }

    public function update(Request $request)
    {
        $rules = array(
            'mobile' => 'bail|required|zh_mobile|confirm_mobile_not_change|unique:common_user',
            'smscode' => 'required|verify_code',
        );
        $messages = array(
            'number.required' => '卡号不允许为空！',
            'number.password_check' => '卡号不存在！',
            'password.required' => '密码不允许为空！',
        );
        $request->validate($rules, $messages);

        $card = CommonMobileModel::where('number', $request->number)->where('password', $request->password)->first();
        if(!$card){
            return response()->json(['status' => '0', 'info' => trans('user.card.passwordwrong')]);
        }
        $card->uid = auth()->user()->uid;
        $card->used_at = time();
        $card->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.card.updatesucceed'), 'url' => route('user.card.index')]);
        }else{
            return view('layouts.user.message', ['status' => '1', 'info' => trans('user.card.updatesucceed'), 'url' => route('user.card.index')]);
        }
    }
}
