<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonCardBookingModel;
use App\Models\CommonUserModel;
use App\Models\CrmAllocationModel;
use App\Models\CrmPersonnelModel;
use Illuminate\Http\Request;


class LackCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $CommonCardBookingModel = new CommonCardBookingModel;
        $orders = $CommonCardBookingModel->where(function($query) use($request) {
            $request->status = $request->status ? $request->status : 0;
            if($request->status > 0){
                $query->where('status', $request->status);
            }else if($request->status == 0){
                $query->where('status', 0);
            }
        })->where(function($query) use($request) {
            if($request->username){
                $user = CommonUserModel::where('username', $request->username)->first();
                $query->where('uid', $user->uid);
            }
        })->latest()->paginate(20);
        return view('admin.extend.lackcard.index', ['orders' => $orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = CommonCardBookingModel::findOrFail($id);
        return view('admin.extend.lackcard.show', ['order' => $order]);
    }

    public function edit($id)
    {
        $order = CommonCardBookingModel::findOrFail($id);
        return view('admin.extend.lackcard.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = CommonCardBookingModel::findOrFail($id);
        $rules = array(
            'status' => 'required|numeric',
        );
        $messages = array(
            'status.required' => '处理状态不允许为空！',
            'status.numeric' => '处理状态选择错误',
        );
        $this->validate($request, $rules, $messages);

        $order->status = $request->status;
        if($order->status == 1){
            $personnel = CrmPersonnelModel::where('uid', $order->uid)->first();
            if(!$personnel){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '处理失败，对方不能卖卡', 'url' => back()->getTargetUrl()]);
                }else{
                    return view('admin.layouts.message', ['status' => 0, 'info' => '处理失败，对方不能卖卡', 'url' => back()->getTargetUrl()]);
                }
            }
            $allocation = new CrmAllocationModel;
            $allocation->personnel_id = $personnel->id;
            $allocation->uid = $personnel->uid;
            $allocation->cardnum = $order->cardnum;
            $allocation->postip = $request->getClientIp();
            $allocation->save();
            $personnel->increment('allotnum', $allocation->cardnum);
        }
        $order->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.lackcard.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.extend.lackcard.editsucceed'), 'url' => back()->getTargetUrl()]);
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
        $order = CommonCardBookingModel::findOrFail($id);
        $order->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.lackcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.lackcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonCardBookingModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.lackcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.lackcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
