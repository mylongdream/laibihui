<?php

namespace App\Http\Controllers\Mobile\Crm\Shop;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StatisticsController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        //view()->share('curmenu', 'statistics');
    }

    public function index()
    {
        return view('mobile.crm.shop.statistics.index');
    }

    public function income()
    {
        return view('mobile.crm.shop.statistics.income');
    }

    public function order()
    {
        return view('mobile.crm.shop.statistics.order');
    }

}
