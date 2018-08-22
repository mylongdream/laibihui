<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
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
        $userlist = CrmPersonnelModel::orderBy('created_at', 'desc')->get();
        return view('admin.crm.personnel.index', ['userlist' => $userlist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grouplist = config('crm.group');
        return view('admin.crm.personnel.create', ['grouplist' => $grouplist]);
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
            'topuid' => 'required|numeric|min:1',
            'subusername' => 'nullable|min:6|max:30',
        );
        $messages = array(
            'topuid.required_if' => '业务员不允许为空！',
            'topuid.numeric' => '业务员填写错误！',
        );
        $this->validate($request, $rules, $messages);

        $user = new CrmPersonnelModel;
        $user->topuid = $request->topuid;
        $user->subuid = $request->subuid;
        $user->postip = $request->getClientIp();
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.personnel.addsucceed'), 'url' => route('admin.crm.personnel.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.personnel.addsucceed'), 'url' => route('admin.crm.personnel.index')]);
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
        $user = CrmPersonnelModel::findOrFail($id);
        return view('admin.crm.personnel.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = CrmPersonnelModel::findOrFail($id);
        $grouplist = config('crm.group');
        return view('admin.crm.personnel.edit', ['user' => $user, 'grouplist' => $grouplist]);
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
        $user = CrmPersonnelModel::findOrFail($id);
        $rules = array(
            'group' => 'required',
            'realname' => 'required|min:1|max:5',
        );
        $messages = array(
            'group.required' => '部门不允许为空！',
            'shop_id.required_if' => '店铺ID不允许为空！',
            'shop_id.numeric' => '店铺ID填写错误！',
        );
        $this->validate($request, $rules, $messages);

        $user->topuid = $request->topuid;
        $user->subuid = $request->subuid;
        $user->postip = $request->getClientIp();
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.personnel.editsucceed'), 'url' => route('admin.crm.personnel.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.personnel.editsucceed'), 'url' => route('admin.crm.personnel.index')]);
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
