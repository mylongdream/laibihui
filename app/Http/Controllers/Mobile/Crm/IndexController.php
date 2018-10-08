<?php

namespace App\Http\Controllers\Mobile\Crm;

use App\Http\Controllers\Controller;
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
