<?php

namespace App\Http\Controllers\Mobile\Crm\Zhaoshang;

use App\Http\Controllers\Controller;
use App\Models\BrandConsumeModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
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
        $shops = BrandShopModel::where('superior', auth('crm')->user()->username)->withCount(['shopcards', 'shopcards AS sellcards_count' => function ($query) {
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
        return view('mobile.crm.zhaoshang.index', ['count' => $count]);
    }

}
