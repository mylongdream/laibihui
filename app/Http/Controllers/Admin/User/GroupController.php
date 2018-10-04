<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUserGroupModel;
use App\Models\WechatTagModel;
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
        $grouplist = CommonUserGroupModel::orderBy('displayorder', 'asc')->get();
        return view('admin.user.group.index', ['grouplist' => $grouplist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taglist = WechatTagModel::orderBy('id', 'asc')->get();
        return view('admin.user.group.create', ['taglist' => $taglist]);
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

        $group = new CommonUserGroupModel;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->displayorder = intval($request->displayorder);
        $group->tag_id = intval($request->tag_id);
        $group->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.group.addsucceed'), 'url' => route('admin.user.group.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.group.addsucceed'), 'url' => route('admin.user.group.index')]);
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
        $group = CommonUserGroupModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = CommonUserGroupModel::findOrFail($id);
        return view('admin.user.group.edit', ['group' => $group]);
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
        $group = CommonUserGroupModel::findOrFail($id);
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
        $group->tag_id = intval($request->tag_id);
        $group->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.group.editsucceed'), 'url' => route('admin.user.group.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.group.editsucceed'), 'url' => route('admin.user.group.index')]);
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
        $group = CommonUserGroupModel::findOrFail($id);
        $group->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonUserGroupModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.group.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonUserGroupModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.group.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.group.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
