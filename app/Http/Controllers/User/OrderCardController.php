<?php

namespace App\Http\Controllers\User;

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
        return view('user.ordercard.index', ['orders' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = CommonCardOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('user.ordercard.show', ['order' => $order]);
    }

}
