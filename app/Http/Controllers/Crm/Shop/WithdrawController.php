<?php

namespace App\Http\Controllers\Crm\Shop;

use App\Http\Controllers\Controller;

use App\Models\BrandWithdrawModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;

class WithdrawController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'withdraw');
    }

    public function index(Request $request)
    {
        $orders = BrandWithdrawModel::where('shop_id', auth('crm')->user()->shop->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('crm.shop.withdraw.index', ['orders' => $orders]);
    }

}
