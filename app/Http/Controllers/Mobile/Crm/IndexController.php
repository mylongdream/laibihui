<?php

namespace App\Http\Controllers\Mobile\Crm;

use App\Http\Controllers\Controller;
use App\Models\BrandConsumeModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
use App\Models\CrmCustomerModel;
use App\Models\CrmRewardModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct()
    {
        view()->share('curmenu', 'index');
    }

    public function index(Request $request)
    {
		$module = auth()->user()->group->module;
        return $this->$module($request);
    }

    public function zhaoshang(Request $request)
    {
        $shops = BrandShopModel::whereHas('moderator', function ($query) {
            $query->where('uid', auth()->user()->uid);
        })->withCount(['shopcards', 'shopcards AS sellcards_count' => function ($query) {
            $query->has('card');
        }])->get();
        $count = collect();
        $count->shopcards = $count->sellcards = $count->shops = $count->cardmoney = $count->shopmoney = 0;
        foreach ($shops as $value){
            $count->shopcards += $value->shopcards_count;
            $count->sellcards += $value->sellcards_count;
            $count->shops++;
            $count->shopmoney += (10 - $value->indiscount) * 100;
        }
        $count->cardmoney = $count->sellcards * 0.5;
        return view('mobile.crm.index.zhaoshang', ['count' => $count]);
    }

    public function kefu(Request $request)
    {
        $count = collect();
        $count->auditingcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'auditing')->count();
        $count->passedcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'passed')->count();
        $count->rejectedcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'rejected')->count();
        return view('mobile.crm.index.kefu', ['count' => $count]);
    }

    public function tuiguang(Request $request)
    {
        $count = collect();
        return view('mobile.crm.index.tuiguang', ['count' => $count]);
    }

    public function shangjia(Request $request)
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $online = BrandConsumeModel::where('shop_id', auth()->user()->shop->id)->where('pay_status', '1')
            ->whereDate('pay_at', '>=', $yesterday->format('Y-m-d'))
            ->whereDate('pay_at', '<', $today->format('Y-m-d'))
            ->where('pay_type', '<>', 'offline')->get();
        $offline = BrandConsumeModel::where('shop_id', auth()->user()->shop->id)->where('pay_status', '1')
            ->whereDate('pay_at', '>=', $yesterday->format('Y-m-d'))
            ->whereDate('pay_at', '<', $today->format('Y-m-d'))
            ->where('pay_type', '=', 'offline')->get();
        $count = collect();
        $count->consume_online = $online->sum('consume_money');
        $count->consume_offline = $offline->sum('consume_money');
        $count->consume_account = $online->sum('indiscount_money') - ($offline->sum('consume_money') - $offline->sum('indiscount_money'));

        $count->ordercard_sellcard = BrandShopCardModel::where('shop_id', auth()->user()->shop->id)->has('card')->count();
        $count->ordercard_remaincard = BrandShopCardModel::where('shop_id', auth()->user()->shop->id)->doesntHave('card')->count();
        $count->ordercard_account = $count->ordercard_sellcard * 5;

        $rewards = CrmRewardModel::where('onsale', 1)->get();
        return view('mobile.crm.index.shangjia', ['count' => $count, 'rewards' => $rewards]);
    }

}
