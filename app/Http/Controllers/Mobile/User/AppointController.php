<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\BrandAppointModel;
use Illuminate\Http\Request;

class AppointController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'appoint');
    }

    public function index(Request $request)
    {
        $appoints = BrandAppointModel::where('uid', auth()->user()->uid)->has('shop')->latest()->paginate(10);
        return view('mobile.user.appoint.index', ['appoints' => $appoints]);
    }

    public function show(Request $request, $id)
    {
        $appoint = BrandAppointModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('mobile.user.appoint.show', ['appoint' => $appoint]);
    }

    public function cancel(Request $request, $id)
    {
        $appoint = BrandAppointModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        if($appoint->status > 0){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '取消预约失败', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '取消预约失败', 'url' => back()->getTargetUrl()]);
            }
        }
        if($request->isMethod('POST')){
            if($appoint->status == 0){
                $rules = array(
                    'reason' => 'required',
                );
                $messages = array(
                    'reason.required' => '请选择取消原因！',
                );
                $request->validate($rules, $messages);

                $appoint->status = 3;
                $appoint->reason = $request->reason;
                $appoint->save();
                if ($request->ajax()){
                    return response()->json(['status' => 1, 'info' => '取消预约成功', 'url' => route('mobile.user.appoint.index')]);
                }else{
                    return view('layouts.mobile.message', ['status' => 1, 'info' => '取消预约成功', 'url' => route('mobile.user.appoint.index')]);
                }
            }else{
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '取消预约失败', 'url' => back()->getTargetUrl()]);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => '取消预约失败', 'url' => back()->getTargetUrl()]);
                }
            }
        }else{
            return view('mobile.user.appoint.cancel', ['appoint' => $appoint]);
        }
    }

}
