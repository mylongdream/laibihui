<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;

use App\Models\BrandAppointModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;

class AppointController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'appoint');
    }

    public function index(Request $request)
    {
        $appoints = BrandAppointModel::where('shop_id', auth('crm')->user()->shop->id)->where(function($query) use($request) {
            $request->status = $request->status ? $request->status : 0;
            if($request->status > 0){
                $query->where('status', $request->status);
            }else if($request->status == 0){
                $query->where('status', 0);
            }
        })->where(function($query) use($request) {
            if($request->order_sn){
                $query->where('order_sn', 'like',"%".$request->order_sn."%");
            }
        })->latest()->paginate(10);
        return view('crm.appoint.index', ['appoints' => $appoints]);
    }

    public function show(Request $request, $id)
    {
        $appoint = BrandAppointModel::where('shop_id', auth('crm')->user()->shop->id)->where('order_sn', $id)->firstOrFail();
        return view('crm.appoint.show', ['appoint' => $appoint]);
    }

    public function edit(Request $request, $id)
    {
        $appoint = BrandAppointModel::where('shop_id', auth('crm')->user()->shop->id)->where('order_sn', $id)->firstOrFail();
        if ($appoint->status > 0){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '预约订单已经处理', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.crm.message', ['status' => 0, 'info' => '预约订单已经处理', 'url' => back()->getTargetUrl()]);
            }
        }
        return view('crm.appoint.edit', ['appoint' => $appoint]);
    }

    public function update(Request $request, $id)
    {
        $appoint = BrandAppointModel::where('shop_id', auth('crm')->user()->shop->id)->where('order_sn', $id)->firstOrFail();
        if ($appoint->status > 0){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '预约订单已经处理', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.crm.message', ['status' => 0, 'info' => '预约订单已经处理', 'url' => back()->getTargetUrl()]);
            }
        }
        $rules = array(
            'status' => 'required|numeric',
        );
        $messages = array(
            'status.required' => '预约状态不允许为空！',
            'status.numeric' => '预约状态选择错误',
        );
        $this->validate($request, $rules, $messages);

        $appoint->status = $request->status;
        $appoint->reason = $request->reason;
        $appoint->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '预约订单处理成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.crm.message', ['status' => '1', 'info' => '预约订单处理成功', 'url' => back()->getTargetUrl()]);
        }
    }

}
