<?php

namespace App\Http\Controllers\Mobile\Crm\Tuiguang;

use App\Http\Controllers\Controller;
use App\Models\BrandConsumeModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
use App\Models\CommonSellcardModel;
use App\Models\CrmCustomerModel;
use App\Models\CrmRewardModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $count = collect();
        $count->card_today = CommonSellcardModel::where('fromuid', auth('crm')->user()->uid)->whereDate('pay_at', '>=', $today->format('Y-m-d'))->count();
        $count->card_yesterday = CommonSellcardModel::where('fromuid', auth('crm')->user()->uid)->whereDate('pay_at', '>=', $yesterday->format('Y-m-d'))
            ->whereDate('pay_at', '<', $today->format('Y-m-d'))->count();
        $count->card_leftnum = auth('crm')->user()->personnel->allotnum - auth('crm')->user()->personnel->sellnum;
        $count->card_sellnum = auth('crm')->user()->personnel->sellnum;
        return view('mobile.crm.tuiguang.index', ['count' => $count]);
    }

}
