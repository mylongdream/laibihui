<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\CrmUserModel;
use App\Models\CrmGroupModel;
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
        $grouplist = config('crm.group');
        $userlist = CrmUserModel::orderBy('created_at', 'desc')->get();
        return view('admin.crm.user.index', ['grouplist' => $grouplist, 'userlist' => $userlist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grouplist = config('crm.group');
        return view('admin.crm.user.create', ['grouplist' => $grouplist]);
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
            'group' => 'required',
            'shop_id' => 'required_if:group,shangjia|nullable|numeric|exists:brand_shop,id',
            'realname' => 'required|min:1|max:5',
            'password' => 'nullable|min:6|max:30',
            'mobile' => 'required|unique:crm_user,mobile',
        );
        $messages = array(
            'group.required' => '部门不允许为空！',
            'shop_id.required_if' => '店铺ID不允许为空！',
            'shop_id.numeric' => '店铺ID填写错误！',
            'shop_id.exists' => '所填店铺不存在！',
            'realname.required' => '真实姓名不允许为空！',
            'realname.min' => '真实姓名必须大于 :min 个字符。',
            'realname.max' => '真实姓名必须小于 :max 个字符。',
            'password.min' => '密码必须大于 :min 个字符。',
            'password.max' => '密码必须小于 :max 个字符。',
            'mobile.required' => '手机号码不允许为空！',
            'mobile.unique' => '手机号码已被占用。',
        );
        $this->validate($request, $rules, $messages);

        $user = new CrmUserModel;
        $user->group = $request->group;
        if($user->group == 'shangjia'){
            $user->shop_id = $request->shop_id;
        }else{
            $user->shop_id = 0;
        }
        $user->realname = $request->realname;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->qq = $request->qq;
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.user.addsucceed'), 'url' => route('admin.crm.user.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.user.addsucceed'), 'url' => route('admin.crm.user.index')]);
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
        $user = CrmUserModel::findOrFail($id);
        return view('admin.crm.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = CrmUserModel::findOrFail($id);
        $grouplist = config('crm.group');
        return view('admin.crm.user.edit', ['user' => $user, 'grouplist' => $grouplist]);
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
        $user = CrmUserModel::findOrFail($id);
        $rules = array(
            'group' => 'required',
            'shop_id' => 'required_if:group,shangjia|nullable|numeric|exists:brand_shop,id',
            'realname' => 'required|min:1|max:5',
            'password' => 'nullable|min:6|max:30',
            'mobile' => 'required|unique:crm_user,mobile,'.$user->uid.',uid',
        );
        $messages = array(
            'group.required' => '部门不允许为空！',
            'shop_id.required_if' => '店铺ID不允许为空！',
            'shop_id.numeric' => '店铺ID填写错误！',
            'shop_id.exists' => '所填店铺不存在！',
            'realname.required' => '真实姓名不允许为空！',
            'realname.min' => '真实姓名必须大于 :min 个字符。',
            'realname.max' => '真实姓名必须小于 :max 个字符。',
            'password.min' => '密码必须大于 :min 个字符。',
            'password.max' => '密码必须小于 :max 个字符。',
            'mobile.required' => '手机号码不允许为空！',
            'mobile.unique' => '手机号码已被占用。',
        );
        $this->validate($request, $rules, $messages);

        $user->group = $request->group;
        if($user->group == 'shangjia'){
            $user->shop_id = $request->shop_id;
        }else{
            $user->shop_id = 0;
        }
        $user->realname = $request->realname;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->mobile = $request->mobile;
        $user->qq = $request->qq;
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.user.editsucceed'), 'url' => route('admin.crm.user.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.user.editsucceed'), 'url' => route('admin.crm.user.index')]);
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
        $user = CrmUserModel::findOrFail($id);
        $user->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CrmUserModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
