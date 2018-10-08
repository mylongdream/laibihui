<?php

namespace App\Http\Controllers\Crm\Shop;

use App\Http\Controllers\Controller;

use App\Models\BrandConsumeModel;
use App\Models\BrandShopModel;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class ConsumeController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        view()->share(['curmenu' => 'consume']);
    }

    public function index(Request $request)
    {
        $consumes = BrandConsumeModel::where('shop_id', auth('crm')->user()->shop->id)->where(function($query) use($request) {
            if($request->order_sn){
                $query->where('order_sn', 'like',"%".$request->order_sn."%");
            }
        })->orderBy('created_at', 'desc')->paginate(20);
        return view('crm.shop.consume.index', ['consumes' => $consumes]);
    }

    public function show(Request $request, $id)
    {
        $consume = BrandConsumeModel::where('shop_id', auth('crm')->user()->shop->id)->where('order_sn', $id)->firstOrFail();
        return view('crm.shop.consume.show', ['consume' => $consume]);
    }

    public function balance(Request $request)
    {
        $datetime = new DateTime(date('Y-m-01'));
        if($request->month){
            $datetime = new DateTime($request->month);
        }
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($datetime, $interval, $datetime->format('t')-1);
        $consumes = collect();
        foreach ($period as $date) {
            if($date->format('Y-m-d') < auth('crm')->user()->shop->created_at->format('Y-m-d')){
                continue;
            }
            if($date->format('Y-m-d') >= Carbon::today()->format('Y-m-d')){
                break;
            }
            $consume = collect();
            $enddate = new DateTime($date->format('Y-m-d'));
            $enddate->add(new DateInterval('P1D'));
            $online = BrandConsumeModel::where('shop_id', auth('crm')->user()->shop->id)->where('pay_status', '1')
                ->whereDate('pay_at', '>=', $date->format('Y-m-d'))
                ->whereDate('pay_at', '<', $enddate->format('Y-m-d'))
                ->where('pay_type', '<>', 'offline')->get();
            $offline = BrandConsumeModel::where('shop_id', auth('crm')->user()->shop->id)->where('pay_status', '1')
                ->whereDate('pay_at', '>=', $date->format('Y-m-d'))
                ->whereDate('pay_at', '<', $enddate->format('Y-m-d'))
                ->where('pay_type', '=', 'offline')->get();
            $consume->date = $date;
            $consume->online = $online->sum('consume_money');
            $consume->offline = $offline->sum('consume_money');
            $consume->account = $online->sum('indiscount_money') - ($offline->sum('consume_money') - $offline->sum('indiscount_money'));
            $consumes->push($consume);
        }
        return view('crm.shop.consume.balance', ['consumes' => $consumes, 'datetime' => $datetime]);
    }

}
