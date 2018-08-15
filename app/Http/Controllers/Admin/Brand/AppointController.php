<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandAppointModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;


class AppointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $BrandAppointModel = new BrandAppointModel;
        $appoints = $BrandAppointModel->where(function($query) use($request) {
            $request->status = $request->status ? $request->status : 0;
            if($request->status > 0){
                $query->where('status', $request->status);
            }else if($request->status == 0){
                $query->where('status', 0);
            }
        })->where(function($query) use($request) {
            if($request->shopid){
                $query->where('shop_id', $request->shopid);
            }
        })->where(function($query) use($request) {
            if($request->order_sn){
                $query->where('order_sn', 'like', '%'.$request->order_sn.'%');
            }
        })->where(function($query) use($request) {
            if($request->realname){
                $query->where('realname', 'like', '%'.$request->realname.'%');
            }
        })->latest()->paginate(20);
        return view('admin.brand.appoint.index', ['appoints' => $appoints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.appoint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required|exists:common_user',
        );
        $messages = array(
            'username.required' => '用户名不允许为空！',
            'username.exists' => '用户名不存在！',
        );
        $this->validate($request, $rules, $messages);

        $user = CommonUserModel::where('username', $request->username)->first();

        $appoint = new BrandAppointModel;
        $appoint->uid = $user->uid;
        $appoint->shop_id = $request->shop_id;
        $appoint->realname = $request->realname;
        $appoint->number = intval($request->number);
        $appoint->mobile = $request->mobile;
        $appoint->appoint_at = $request->appoint_at ? strtotime($request->appoint_at) : $request->appoint_at;
        $appoint->remark = $request->remark;
        $appoint->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $appoint->postip = request()->getClientIp();
        $appoint->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.appoint.addsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.appoint.addsucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appoint = BrandAppointModel::findOrFail($id);
        return view('admin.brand.appoint.show')->with('appoint', $appoint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appoint = BrandAppointModel::findOrFail($id);
        return view('admin.brand.appoint.edit')->with('appoint', $appoint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appoint = BrandAppointModel::findOrFail($id);
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
            return response()->json(['status' => '1', 'info' => trans('admin.brand.appoint.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.appoint.editsucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $appoint = BrandAppointModel::findOrFail($id);
        $appoint->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function batch(Request $request)
    {
        if($request->operate == 'delsubmit') {
            $rules = array(
                'ids' => 'required',
            );
            $messages = array(
                'ids.required' => '请选择要删除的记录！',
            );
            $this->validate($request, $rules, $messages);
            BrandAppointModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
