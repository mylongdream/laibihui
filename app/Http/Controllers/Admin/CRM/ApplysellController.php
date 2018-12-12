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
        $list = CrmApplysellModel::has('user')->orderBy('created_at', 'desc')->paginate(20);
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
