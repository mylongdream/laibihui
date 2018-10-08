<?php

namespace App\Http\Controllers\Crm\Kefu;

use App\Http\Controllers\Controller;
use App\Models\BrandShopModel;
use App\Models\BrandShopModeratorModel;
use App\Models\CrmCustomerModel;
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
        $count = collect();
        $count->auditingcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'auditing')->count();
        $count->passedcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'passed')->count();
        $count->rejectedcustomer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'rejected')->count();
        return view('crm.kefu.index', ['count' => $count]);
    }

}
