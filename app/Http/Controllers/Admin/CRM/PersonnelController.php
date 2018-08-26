<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CrmPersonnelModel;
use Illuminate\Http\Request;


class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = CrmPersonnelModel::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.crm.personnel.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crm.personnel.create');
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
            'topusername' => 'required|exists:common_user,username',
            'subusername' => 'required|exists:common_user,username',
        );
        $messages = array(
            'topusername.required' => '业务员用户名不允许为空！',
            'topusername.exists' => '业务员用户名不存在！',
            'subusername.required' => '卖卡会员用户名不允许为空！',
            'subusername.exists' => '业务员用户名不存在！',
        );
        $this->validate($request, $rules, $messages);

        $topuser = CommonUserModel::where('username', $request->topusername)->first();
        $subuser = CommonUserModel::where('username', $request->subusername)->first();
        $user = new CrmPersonnelModel;
        $user->topuid = $topuser->uid;
        $user->subuid = $subuser->uid;
        $user->postip = $request->getClientIp();
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.personnel.addsucceed'), 'url' => route('admin.crm.personnel.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.personnel.addsucceed'), 'url' => route('admin.crm.personnel.index')]);
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
        $user = CrmPersonnelModel::findOrFail($id);
        $user->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.personnel.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.personnel.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CrmPersonnelModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.personnel.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.personnel.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
