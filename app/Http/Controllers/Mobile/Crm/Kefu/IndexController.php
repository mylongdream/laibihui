<?php

namespace App\Http\Controllers\Mobile\Crm\Kefu;

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
        $count = collect();
        $count->auditingcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'auditing')->count();
        $count->passedcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'passed')->count();
        $count->rejectedcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'rejected')->count();
        return view('mobile.crm.kefu.index', ['count' => $count]);
    }

}
