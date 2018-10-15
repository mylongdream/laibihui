<?php

namespace App\Http\Controllers\Mobile\Crm\Shop;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FunctionController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        //view()->share('curmenu', 'function');
    }

    public function index()
    {
        return view('mobile.crm.shop.function.index');
    }

}
