<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\BrandMealOrderModel;
use Illuminate\Http\Request;

class OrderMealController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'ordermeal');
    }

    public function index(Request $request)
    {
        $orders = BrandMealOrderModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(10);
        return view('user.ordermeal.index', ['orders' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = BrandMealOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('user.ordermeal.show', ['order' => $order]);
    }

}
