<?php

namespace App\Http\Controllers\Crm\Tuiguang;

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
        view()->share('curmenu', 'index');
    }

    public function index(Request $request)
    {
        $count = collect();
        return view('crm.tuiguang.index', ['count' => $count]);
    }

}
