<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\FarmOrderModel;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;
use Vinkla\Hashids\Facades\Hashids;

class OrderFarmController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'orderfarm');
    }

    public function index(Request $request)
    {
        $orders = FarmOrderModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(10);
        return view('mobile.user.orderfarm.index', ['orders' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = FarmOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('mobile.user.orderfarm.show', ['order' => $order]);
    }

    public function cancel(Request $request, $id)
    {
        $order = FarmOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        if ($order->order_status == 0 && $order->shipping_status == 0 && $order->pay_status == 0){
            $order->finish_at = time();
            $order->order_status = 1;
            $order->save();
        }else{
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => trans('user.orderfarm.cancelfailed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.orderfarm.cancelfailed'), 'url' => back()->getTargetUrl()]);
            }
        }
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.orderfarm.cancelsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.orderfarm.cancelsucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
