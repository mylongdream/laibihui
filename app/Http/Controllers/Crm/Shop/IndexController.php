<?php

namespace App\Http\Controllers\Crm\Shop;

use App\Http\Controllers\Controller;
use App\Models\BrandConsumeModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
use App\Models\CrmCustomerModel;
use App\Models\CommonCardRewardModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'index');
    }

    public function index(Request $request)
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $online = BrandConsumeModel::where('shop_id', auth('crm')->user()->shop->id)->where('pay_status', '1')
            ->whereDate('pay_at', '>=', $yesterday->format('Y-m-d'))
            ->whereDate('pay_at', '<', $today->format('Y-m-d'))
            ->where('pay_type', '<>', 'offline')->get();
        $offline = BrandConsumeModel::where('shop_id', auth('crm')->user()->shop->id)->where('pay_status', '1')
            ->whereDate('pay_at', '>=', $yesterday->format('Y-m-d'))
            ->whereDate('pay_at', '<', $today->format('Y-m-d'))
            ->where('pay_type', '=', 'offline')->get();
        $count = collect();
        $count->consume_online = $online->sum('consume_money');
        $count->consume_offline = $offline->sum('consume_money');
        $count->consume_account = $online->sum('indiscount_money') - ($offline->sum('consume_money') - $offline->sum('indiscount_money'));

        $count->ordercard_sellcard = BrandShopCardModel::where('shop_id', auth('crm')->user()->shop->id)->has('card')->count();
        $count->ordercard_remaincard = BrandShopCardModel::where('shop_id', auth('crm')->user()->shop->id)->doesntHave('card')->count();
        $count->ordercard_account = $count->ordercard_sellcard * 5;

        $rewards = CommonCardRewardModel::where('type', 2)->where('onsale', 1)->get();
        return view('crm.shop.index', ['count' => $count, 'rewards' => $rewards]);
    }

}
