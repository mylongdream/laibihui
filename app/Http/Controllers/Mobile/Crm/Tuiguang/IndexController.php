<?php

namespace App\Http\Controllers\Mobile\Crm\Tuiguang;

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
        //view()->share('curmenu', 'index');
    }

    public function index(Request $request)
    {
        $count = collect();
        return view('mobile.crm.tuiguang.index', ['count' => $count]);
    }

}
