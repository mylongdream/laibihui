<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonAdminUserModel;
use App\Models\CommonAdminGroupModel;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userlist = CommonAdminUserModel::orderBy('created_at', 'desc')->get();
        return view('admin.admin.user.index', ['userlist' => $userlist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grouplist = CommonAdminGroupModel::orderBy('displayorder', 'asc')->get();
        return view('admin.admin.user.create', ['grouplist' => $grouplist]);
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
            'group_id' => 'required|numeric|exists:common_admin_group,id',
            'username' => 'required|min:6|max:30|unique:common_admin_user',
            'password' => 'required|min:6|max:30|confirmed',
        );
        $messages = array(
            'group_id.required' => '管理组不允许为空！',
            'group_id.numeric' => '管理组不正确！',
            'group_id.exists' => '管理组不存在！',
            'username.required' => '用户名不允许为空！',
            'username.min' => '用户名必须大于 :min 个字符。',
            'username.max' => '用户名必须小于 :max 个字符。',
            'username.unique' => '用户名已被占用。',
            'password.required' => '密码不允许为空！',
            'password.min' => '密码必须大于 :min 个字符。',
            'password.max' => '密码必须小于 :max 个字符。',
            'password.confirmed' => '确认密码不正确！',
        );
        $this->validate($request, $rules, $messages);

        $user = new CommonAdminUserModel;
        $user->group_id = $request->group_id;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.user.addsucceed'), 'url' => route('admin.admin.user.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.user.addsucceed'), 'url' => route('admin.admin.user.index')]);
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
        $user = CommonAdminUserModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = CommonAdminUserModel::findOrFail($id);
        $grouplist = CommonAdminGroupModel::orderBy('displayorder', 'asc')->get();
        return view('admin.admin.user.edit', ['user' => $user, 'grouplist' => $grouplist]);
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
        $user = CommonAdminUserModel::findOrFail($id);
        $rules = array(
            'group_id' => 'required|numeric|exists:common_admin_group,id',
            'username' => 'required|min:6|max:30|unique:common_admin_user,username,'.$user->uid.',uid',
        );
        $messages = array(
            'group_id.required' => '管理组不允许为空！',
            'group_id.numeric' => '管理组不正确！',
            'group_id.exists' => '管理组不存在！',
            'username.required' => '用户名不允许为空！',
            'username.min' => '用户名必须大于 :min 个字符。',
            'username.max' => '用户名必须小于 :max 个字符。',
            'username.unique' => '用户名已被占用。',
        );
        $this->validate($request, $rules, $messages);

        $user->group_id = $request->group_id;
        $user->username = $request->username;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.user.editsucceed'), 'url' => route('admin.admin.user.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.user.editsucceed'), 'url' => route('admin.admin.user.index')]);
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
        $user = CommonAdminUserModel::findOrFail($id);
        $user->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonAdminUserModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.admin.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.admin.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
