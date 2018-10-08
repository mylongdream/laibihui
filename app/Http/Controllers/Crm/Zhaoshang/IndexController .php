<?php

namespace App\Http\Controllers\Crm\Zhaoshang;

use App\Http\Controllers\Controller;
use App\Models\BrandShopArchiveModel;
use App\Models\BrandShopCardAllotModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
use App\Models\CommonCardModel;
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
        $shops = BrandShopModel::whereHas('moderator', function ($query) {
            $query->where('uid', auth('crm')->user()->uid);
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
        return view('crm.zhaoshang.index', ['count' => $count]);
    }

}
