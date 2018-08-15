<?php

namespace App\Http\Controllers\User;

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
        return view('user.orderfarm.index', ['orders' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = FarmOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('user.orderfarm.show', ['order' => $order]);
    }

}
