<?php

namespace App\Http\Controllers\Crm\Kefu;

use App\Http\Controllers\Controller;
use App\Models\BrandShopModel;
use App\Models\BrandShopModeratorModel;
use App\Models\CrmCustomerModel;
use Illuminate\Http\Request;

class CheckCustomerController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'checkcustomer');
    }

    public function index(Request $request)
    {
        if(!in_array($request->type, array('passed', 'auditing', 'rejected'))){
            return response()->redirectToRoute('crm.kefu.checkcustomer.index', ['type' => 'auditing']);
        }
        $CrmCustomerModel = new CrmCustomerModel;
        $customers = $CrmCustomerModel->whereNotNull('refer_at')->where(function($query) use($request) {
            if($request->type == 'passed'){
                $query->where('check_status', 'passed');
            }elseif($request->type == 'auditing'){
                $query->where('check_status', 'auditing');
            }elseif($request->type == 'rejected'){
                $query->where('check_status', 'rejected');
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->latest()->paginate(20);
        return view('crm.kefu.checkcustomer.index', ['customers' => $customers]);
    }

    public function show($id)
    {
        $customer = CrmCustomerModel::findOrFail($id);
        return view('crm.kefu.checkcustomer.show', ['customer' => $customer]);
    }

    public function check(Request $request, $id)
    {
        $customer = CrmCustomerModel::whereNotNull('refer_at')->where('check_status', 'auditing')->findOrFail($id);
        if ($request->isMethod('POST')) {
            $rules = array(
                'status' => 'required',
                'shop_id' => 'required_if:status,passed|nullable|numeric|exists:brand_shop,id|unique:crm_customer,shop_id',
                'reason' => 'required_if:status,rejected|nullable|max:120',
            );
            $messages = array(
                'status.required' => '审核状态不允许为空！',
                'shop_id.required_if' => '店铺ID不允许为空！',
                'shop_id.numeric' => '店铺ID填写错误！',
                'shop_id.exists' => '店铺ID不存在！',
                'reason.required_if' => '驳回原因不允许为空！',
                'reason.max' => '驳回原因必须小于 :max 个字符。',
            );
            $this->validate($request, $rules, $messages);

            if($request->status == 'passed'){
                $shop = BrandShopModel::where('id', $request->shop_id)->firstOrFail();
                $shop->pic_zizhi = $customer->pic_zizhi;
                $shop->save();

                $moderator = new BrandShopModeratorModel();
                $moderator->uid = $customer->uid;
                $moderator->shop_id = $shop->id;
                $moderator->postip = request()->getClientIp();
                $moderator->save();

                $customer->shop_id = $shop->id;
            }else{
                $customer->check_reason = $request->reason;
            }
            $customer->check_uid = auth('crm')->user()->uid;
            $customer->check_at = time();
            $customer->check_status = $request->status;
            $customer->save();

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '客户审核成功', 'url' => route('crm.kefu.checkcustomer.index')]);
            }else{
                return view('layouts.crm.message', ['status' => 1, 'info' => '客户审核成功', 'url' => route('crm.kefu.checkcustomer.index')]);
            }
        }else{
            return view('crm.kefu.checkcustomer.check', ['customer' => $customer]);
        }
    }

}
