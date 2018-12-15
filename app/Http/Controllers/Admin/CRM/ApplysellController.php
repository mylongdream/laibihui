<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CrmAllocationModel;
use App\Models\CrmApplysellModel;
use Illuminate\Http\Request;


class ApplysellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = CrmApplysellModel::where(function($query) use($request) {
            $request->status = $request->status ? $request->status : 0;
            if($request->status > 0){
                $query->where('status', $request->status);
            }else if($request->status == 0){
                $query->where('status', 0);
            }
        })->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.crm.applysell.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $info = CrmApplysellModel::findOrFail($id);
        return view('admin.crm.applysell.show', ['info' => $info]);
    }

    public function edit($id)
    {
        $order = CrmApplysellModel::findOrFail($id);
        return view('admin.crm.applysell.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = CrmApplysellModel::findOrFail($id);
        $rules = array(
            'status' => 'required|numeric',
        );
        $messages = array(
            'status.required' => '处理状态不允许为空！',
            'status.numeric' => '处理状态选择错误',
        );
        $this->validate($request, $rules, $messages);


        $order->status = $request->status;
        $order->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.applysell.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.applysell.editsucceed'), 'url' => back()->getTargetUrl()]);
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
        $user = CrmApplysellModel::findOrFail($id);
        $user->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.applysell.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.applysell.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CrmApplysellModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.applysell.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.applysell.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
