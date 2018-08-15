<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonFeedbackModel;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'feedback');
    }

    public function index(Request $request)
    {
        return view('mobile.user.feedback.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'message' => 'required|min:10|max:200',
        );
        $messages = array(
            'message.required' => '问题描述不允许为空！',
            'message.min' => '问题描述必须大于 :min 个字符。',
            'message.max' => '问题描述必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $feedback = new CommonFeedbackModel();
        $feedback->message = $request->message;
        $feedback->upphoto = serialize($request->upphoto);
        $feedback->phone = $request->phone;
        $feedback->postip = request()->getClientIp();
        $feedback->uid = auth()->user()->uid;
        $feedback->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '提交成功', 'url' => route('mobile.user.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => '提交成功', 'url' => route('mobile.user.index')]);
        }
    }

}
