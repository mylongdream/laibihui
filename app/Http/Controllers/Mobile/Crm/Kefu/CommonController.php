<?php

namespace App\Http\Controllers\Mobile\Crm\Kefu;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $module = auth('crm')->user()->group->module;
            if($module != 'kefu'){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '你没有权限进入']);
                }else{
                    return response()->view('layouts.mobile.message', ['status' => 0, 'info' => '你没有权限进入']);
                }
            }
            return $next($request);
        });
    }

}
