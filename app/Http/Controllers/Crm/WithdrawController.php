<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;

use App\Models\BrandWithdrawModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'withdraw');
    }

    public function index(Request $request)
    {
        $orders = BrandWithdrawModel::where('shop_id', auth('crm')->user()->shop->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('crm.withdraw.index', ['orders' => $orders]);
    }

}
