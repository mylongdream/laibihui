<?php

namespace App\Http\Controllers\Crm\Zhaoshang;

use App\Http\Controllers\Controller;
use App\Models\BrandShopModel;
use App\Models\CommonCardBookingModel;
use Illuminate\Http\Request;

class LackcardController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'lackcard');
    }

    public function index(Request $request)
    {
        $list = CommonCardBookingModel::latest()->paginate(20);
        return view('crm.zhaoshang.lackcard.index', ['list' => $list]);
    }

    public function handle(Request $request,$id)
    {
        $order = CommonCardBookingModel::findOrFail($id);
        $order->status = 1;
        $order->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '已处理完成', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.crm.message', ['status' => '1', 'info' => '已处理完成', 'url' => back()->getTargetUrl()]);
        }

    }

}
