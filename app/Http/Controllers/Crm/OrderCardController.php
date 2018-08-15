<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;

use App\Models\BrandMealOrderModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;

class OrderCardController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'ordercard');
    }

    public function index(Request $request)
    {
        $orders = BrandShopCardModel::where('shop_id', auth('crm')->user()->shop->id)->where(function($query) use($request) {
            if($request->number){
                $query->where('number', 'like',"%".$request->number."%");
            }
        })->has('card')->orderBy('created_at', 'desc')->paginate(10);
        return view('crm.ordercard.index', ['orders' => $orders]);
    }

    public function remain(Request $request)
    {
        $orders = BrandShopCardModel::where('shop_id', auth('crm')->user()->shop->id)->where(function($query) use($request) {
            if($request->number){
                $query->where('number', 'like',"%".$request->number."%");
            }
        })->doesntHave('card')->orderBy('created_at', 'desc')->paginate(10);
        return view('crm.ordercard.remain', ['orders' => $orders]);
    }

}
