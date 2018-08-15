<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonAdminGroupModel;
use Illuminate\Http\Request;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grouplist = CommonAdminGroupModel::orderBy('displayorder', 'asc')->get();
        return view('admin.admin.group.index', ['grouplist' => $grouplist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.group.create');
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
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '管理组名不允许为空！',
            'name.max' => '管理组名必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $group = new CommonAdminGroupModel;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->displayorder = intval($request->displayorder);
        $group->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.group.addsucceed'), 'url' => route('admin.admin.group.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.group.addsucceed'), 'url' => route('admin.admin.group.index')]);
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
        $group = CommonAdminGroupModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = CommonAdminGroupModel::findOrFail($id);
        return view('admin.admin.group.edit', ['group' => $group]);
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
        $group = CommonAdminGroupModel::findOrFail($id);
        $rules = array(
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '管理组名不允许为空！',
            'name.max' => '管理组名必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $group->name = $request->name;
        $group->description = $request->description;
        $group->displayorder = intval($request->displayorder);
        $group->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.group.editsucceed'), 'url' => route('admin.admin.group.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.group.editsucceed'), 'url' => route('admin.admin.group.index')]);
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
        $group = CommonAdminGroupModel::findOrFail($id);
        $group->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonAdminGroupModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.admin.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonAdminGroupModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.admin.group.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.group.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
