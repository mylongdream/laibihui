<?php

namespace App\Http\Controllers\Mobile\Crm\Shop;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SuperiorController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        //view()->share('curmenu', 'superior');
    }

    public function index()
    {
        return view('mobile.crm.shop.superior.index');
    }

}
