<?php

namespace App\Http\Controllers\Mobile\Crm\Shop;

use App\Http\Controllers\Controller;

use App\Models\BrandMealOrderModel;
use Illuminate\Http\Request;

class OrderMealController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        //view()->share('curmenu', 'ordermeal');
    }

    public function index(Request $request)
    {
        $orders = BrandMealOrderModel::where('shop_id', $this->shop->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('mobile.crm.shop.ordermeal.index', ['orders' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = BrandMealOrderModel::where('shop_id', $this->shop->id)->where('order_sn', $id)->firstOrFail();
        return view('mobile.crm.shop.ordermeal.show', ['order' => $order]);
    }

}
