<?php

namespace App\Http\Controllers\Crm\Shop;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $module = auth('crm')->user()->group->module;
            if($module != 'shop'){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '你没有权限进入']);
                }else{
                    return response()->view('layouts.crm.message', ['status' => 0, 'info' => '你没有权限进入']);
                }
            }
            $shop = auth('crm')->user()->shop;
            if(!$shop){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '管理店铺不存在']);
                }else{
                    return response()->view('layouts.crm.message', ['status' => 0, 'info' => '管理店铺不存在']);
                }
            }
            view()->share('shop', $shop);
            $this->shop = $shop;
            return $next($request);
        });
    }

}
