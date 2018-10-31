<?php

namespace App\Http\Controllers\Mobile\Crm\Zhaoshang;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use App\Models\BrandShopModel;
use App\Models\CrmCustomerFillModel;
use App\Models\CrmCustomerModel;
use App\Models\CrmGroupModel;
use Illuminate\Http\Request;

class CustomerController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'customer');
    }

    public function index(Request $request)
    {
        $CrmCustomerModel = new CrmCustomerModel;
        $customers = $CrmCustomerModel->where('uid', auth('crm')->user()->uid)->whereNull('refer_at')->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->where(function($query) use($request) {
            if($request->address){
                $query->where('address', 'like',"%".$request->address."%");
            }
        })->latest()->paginate(20);
        return view('mobile.crm.zhaoshang.customer.index', ['customers' => $customers]);
    }

    public function create(Request $request)
    {
        view()->share('curmenu', 'addcustomer');
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('mobile.crm.zhaoshang.customer.create', ['categorylist' => category_tree($categorylist)]);
    }

    public function store(Request $request)
    {
        $rules = array(
            'catid' => 'required|numeric|exists:brand_category,id',
            'name' => 'required|max:50',
            'address' => 'required|max:150',
            'phone' => 'required|max:50',
            'status' => 'required',
        );
        $messages = array(
            'catid.required' => '经营类目不允许为空！',
            'catid.numeric' => '经营类目选择错误！',
            'catid.exists' => '经营类目不存在！',
            'name.required' => '商户名称不允许为空！',
            'name.max' => '商户名称必须小于 :max 个字符。',
            'address.required' => '商户地址不允许为空！',
            'address.max' => '商户地址必须小于 :max 个字符。',
            'phone.required' => '联系电话不允许为空！',
            'phone.max' => '联系电话必须小于 :max 个字符。',
            'status.required' => '跟进情况不允许为空！',
        );
        $this->validate($request, $rules, $messages);

        $customer = new CrmCustomerModel();
        $customer->uid = auth('crm')->user()->uid;
        $customer->catid = $request->catid;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->maplng = $request->maplng;
        $customer->maplat = $request->maplat;
        $customer->phone = $request->phone;
        $customer->openhours = $request->openhours;
        $customer->status = $request->status;
        $customer->pic_hetong = $request->pic_hetong ? serialize($request->pic_hetong) : $request->pic_hetong;
        $customer->pic_zizhi = $request->pic_zizhi ? serialize($request->pic_zizhi) : $request->pic_zizhi;
        $customer->pic_mentou = $request->pic_mentou ? serialize($request->pic_mentou) : $request->pic_mentou;
        $customer->pic_neijing = $request->pic_neijing ? serialize($request->pic_neijing) : $request->pic_neijing;
        $customer->pic_caidan = $request->pic_caidan ? serialize($request->pic_caidan) : $request->pic_caidan;
        $customer->pic_caipin = $request->pic_caipin ? serialize($request->pic_caipin) : $request->pic_caipin;
        $customer->remark = $request->remark;
        $customer->postip = request()->getClientIp();
        $customer->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '新增客户成功', 'url' => route('mobile.crm.zhaoshang.customer.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => '新增客户成功', 'url' => route('mobile.crm.zhaoshang.customer.index')]);
        }
    }

    public function show($id)
    {
        $customer = CrmCustomerModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        return view('mobile.crm.zhaoshang.customer.show', ['customer' => $customer]);
    }

    public function edit($id)
    {
        $customer = CrmCustomerModel::where('uid', auth('crm')->user()->uid)->whereNull('refer_at')->findOrFail($id);
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('mobile.crm.zhaoshang.customer.edit', ['customer' => $customer, 'categorylist' => category_tree($categorylist)]);
    }

    public function update(Request $request, $id)
    {
        $customer = CrmCustomerModel::where('uid', auth('crm')->user()->uid)->whereNull('refer_at')->findOrFail($id);
        $rules = array(
            'catid' => 'required|numeric|exists:brand_category,id',
            'name' => 'required|max:50',
            'address' => 'required|max:150',
            'phone' => 'required|max:50',
            'status' => 'required',
        );
        $messages = array(
            'catid.required' => '经营类目不允许为空！',
            'catid.numeric' => '经营类目选择错误！',
            'catid.exists' => '经营类目不存在！',
            'name.required' => '商户名称不允许为空！',
            'name.max' => '商户名称必须小于 :max 个字符。',
            'address.required' => '商户地址不允许为空！',
            'address.max' => '商户地址必须小于 :max 个字符。',
            'phone.required' => '联系电话不允许为空！',
            'phone.max' => '联系电话必须小于 :max 个字符。',
            'status.required' => '跟进情况不允许为空！',
        );
        $this->validate($request, $rules, $messages);

        $customer->catid = $request->catid;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->maplng = $request->maplng;
        $customer->maplat = $request->maplat;
        $customer->openhours = $request->openhours;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        $customer->pic_hetong = $request->pic_hetong ? serialize($request->pic_hetong) : $request->pic_hetong;
        $customer->pic_zizhi = $request->pic_zizhi ? serialize($request->pic_zizhi) : $request->pic_zizhi;
        $customer->pic_mentou = $request->pic_mentou ? serialize($request->pic_mentou) : $request->pic_mentou;
        $customer->pic_neijing = $request->pic_neijing ? serialize($request->pic_neijing) : $request->pic_neijing;
        $customer->pic_caidan = $request->pic_caidan ? serialize($request->pic_caidan) : $request->pic_caidan;
        $customer->pic_caipin = $request->pic_caipin ? serialize($request->pic_caipin) : $request->pic_caipin;
        $customer->remark = $request->remark;
        $customer->postip = request()->getClientIp();
        $customer->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '修改客户成功', 'url' => route('mobile.crm.zhaoshang.customer.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '修改客户成功', 'url' => route('mobile.crm.zhaoshang.customer.index')]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $customer = CrmCustomerModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        $customer->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '删除客户成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '删除客户成功', 'url' => back()->getTargetUrl()]);
        }
    }

    public function nearby(Request $request)
    {
        $rules = array(
            'catid' => 'required|numeric|min:1',
            'maplng' => 'required|numeric|min:0|max:180',
            'maplat' => 'required|numeric|min:-90|max:90',
        );
        $messages = array(
            'catid.required' => '商家分类不能为空！',
            'catid.numeric' => '商家分类格式错误！',
            'catid.min' => '商家分类格式错误！',
            'maplng.required' => '地图坐标经度不能为空！',
            'maplng.numeric' => '地图坐标经度格式错误！',
            'maplng.min' => '地图坐标经度格式错误！',
            'maplng.max' => '地图坐标经度格式错误！',
            'maplat.required' => '地图坐标纬度不能为空！',
            'maplat.numeric' => '地图坐标纬度格式错误！',
            'maplat.min' => '地图坐标纬度格式错误！',
            'maplat.max' => '地图坐标纬度格式错误！',
        );
        $this->validate($request, $rules, $messages);
        $maplat = $request->maplat;
        $maplng = $request->maplng;
        $shops = BrandShopModel::select('*')->selectRaw('ROUND(2 * 6378.137* ASIN(SQRT(POW(SIN(PI()*('.$maplat.'-maplat)/360),2)+COS(PI()*'.$maplat.'/180)* COS(maplat * PI()/180)*POW(SIN(PI()*('.$maplng.'-maplng)/360),2)))*1000) AS distance')->where('maplat', '>', 0)->where('maplng', '>', 0)->where(function($query) use($request) {
            if($request->catid){
                $query->where('catid', $request->catid);
            }
        })->where(function($query) use($request) {
            if($request->id){
                $query->where('id', '<>', $request->id);
            }
        })->orderBy('distance', 'asc')->latest()->get()->take(5);
        if ($shops->isEmpty() && $request->ajax()){
            return response()->json(['status' => 0, 'info' => '附近暂无商户', 'url' => back()->getTargetUrl()]);
        }else{
            return view('mobile.crm.zhaoshang.customer.nearby', ['shops' => $shops]);
        }
    }

    public function refer(Request $request, $id)
    {
        $customer = CrmCustomerModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        if ($customer->status != 'finish') {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '客户尚未完成', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '客户尚未完成', 'url' => back()->getTargetUrl()]);
            }
        }
        if ($request->isMethod('POST')) {
            $customer->refer_at = time();
            $customer->check_status = 'auditing';
            $customer->save();

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '客户提交审核成功', 'url' => route('crm.zhaoshang.customer.referlist')]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => '客户提交审核成功', 'url' => route('crm.zhaoshang.customer.referlist')]);
            }
        }else{
            return view('mobile.crm.zhaoshang.customer.refer', ['customer' => $customer]);
        }
    }

    public function referlist(Request $request)
    {
        if(!in_array($request->type, array('passed', 'auditing', 'rejected'))){
            return response()->redirectToRoute('crm.zhaoshang.customer.referlist', ['type' => 'auditing']);
        }
        $CrmCustomerModel = new CrmCustomerModel;
        $customers = $CrmCustomerModel->where('uid', auth('crm')->user()->uid)->whereNotNull('refer_at')->where(function($query) use($request) {
            if($request->type == 'passed'){
                $query->where('check_status', 'passed');
            }elseif($request->type == 'auditing'){
                $query->where('check_status', 'auditing');
            }elseif($request->type == 'rejected'){
                $query->where('check_status', 'rejected');
            }
        })->orderBy('refer_at', 'desc')->paginate(20);
        return view('mobile.crm.zhaoshang.customer.referlist', ['customers' => $customers]);
    }

}
