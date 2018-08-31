<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CrmAllocationModel;
use Illuminate\Http\Request;


class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = CrmAllocationModel::where(function($query) use($request) {
            if($request->username){
                $user = CommonUserModel::where('username', $request->username)->first();
                $query->where('uid', $user->uid);
            }
        })->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.crm.allocation.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crm.allocation.create');
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
            'username' => 'required|exists:common_user,username',
            'cardnum' => 'required',
        );
        $messages = array(
            'username.required' => '卖卡人员用户名不允许为空！',
            'username.exists' => '卖卡人员用户名不存在！',
            'cardnum.required' => '分配卡数不允许为空！',
        );
        $this->validate($request, $rules, $messages);

        $user = CommonUserModel::where('username', $request->username)->first();
        $allocation = new CrmAllocationModel;
        $allocation->uid = $user->uid;
        $allocation->cardnum = $request->cardnum;
        $allocation->postip = $request->getClientIp();
        $allocation->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.allocation.addsucceed'), 'url' => route('admin.crm.allocation.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.allocation.addsucceed'), 'url' => route('admin.crm.allocation.index')]);
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
        $allocation = CrmAllocationModel::findOrFail($id);
        $allocation->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.allocation.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.allocation.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CrmAllocationModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.allocation.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.allocation.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
