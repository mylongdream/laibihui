<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonAppointModel;
use App\Models\CommonCardModel;
use App\Models\CommonCardOrderModel;
use App\Models\CommonUserCardModel;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;
use Vinkla\Hashids\Facades\Hashids;

class OrderCardController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'ordercard');
    }

    public function index(Request $request)
    {
        $orders = CommonCardOrderModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(10);
        return view('mobile.user.ordercard.index', ['orders' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = CommonCardOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('mobile.user.ordercard.show', ['order' => $order]);
    }

    public function cancel(Request $request, $id)
    {
        $order = CommonCardOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        if ($order->order_status == 0 && $order->shipping_status == 0 && $order->pay_status == 0){
            $order->finish_at = time();
            $order->order_status = 1;
            $order->save();
        }else{
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => trans('user.ordercard.cancelfailed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.ordercard.cancelfailed'), 'url' => back()->getTargetUrl()]);
            }
        }
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.ordercard.cancelsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.ordercard.cancelsucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
