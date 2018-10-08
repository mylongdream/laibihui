<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\BrandConsumeModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
use App\Models\CrmCustomerModel;
use App\Models\CommonCardRewardModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct()
    {
        //view()->share('curmenu', 'index');
    }

    public function index(Request $request)
    {
		$module = auth('crm')->user()->group->module;
        return response()->redirectToRoute("crm.".$module.".index");
    }

}
