<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CommonUserGroupModel;
use App\Models\CrmPersonnelModel;
use App\Models\WechatMenuModel;
use App\Models\WechatUserModel;
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
        $CommonUserModel = new CommonUserModel;
        $userlist = $CommonUserModel->where(function($query) use($request) {
            if($request->group_id){
                $query->where('group_id', $request->group_id);
            }
        })->where(function($query) use($request) {
            if($request->bindcard == 1){
                $query->doesntHave('card');
            }elseif($request->bindcard == 2){
                $query->has('card');
            }
        })->where(function($query) use($request) {
            if($request->mobile){
                $query->where('mobile', 'like',"%".$request->mobile."%");
            }
        })->latest()->paginate(20);
        $grouplist = CommonUserGroupModel::orderBy('displayorder', 'asc')->get();
        return view('admin.user.user.index', ['userlist' => $userlist, 'grouplist' => $grouplist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grouplist = CommonUserGroupModel::orderBy('displayorder', 'asc')->get();
        return view('admin.user.user.create', ['grouplist' => $grouplist]);
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
            'username' => 'required|min:4|max:16|unique:common_admin_user',
            'password' => 'required|min:6|max:14|confirmed',
        );
        $messages = array(
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

        $user = new CommonUserModel;
        $user->headimgurl = $request->headimgurl;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->realname = $request->realname;
        $user->mobile = $request->mobile;
        $user->qq = $request->qq;
        $user->wechatid = $request->wechatid;
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.user.addsucceed'), 'url' => route('admin.user.user.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.user.addsucceed'), 'url' => route('admin.user.user.index')]);
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
        $user = CommonUserModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = CommonUserModel::findOrFail($id);
        $grouplist = CommonUserGroupModel::orderBy('displayorder', 'asc')->get();
        return view('admin.user.user.edit', ['user' => $user, 'grouplist' => $grouplist]);
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
        $user = CommonUserModel::findOrFail($id);
        $rules = array(
            'username' => 'required|min:6|max:30|unique:common_admin_user,username,'.$user->uid.',uid',
        );
        $messages = array(
            'username.required' => '用户名不允许为空！',
            'username.min' => '用户名必须大于 :min 个字符。',
            'username.max' => '用户名必须小于 :max 个字符。',
            'username.unique' => '用户名已被占用。',
        );
        $this->validate($request, $rules, $messages);

        $user->headimgurl = $request->headimgurl;
        $user->username = $request->username;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->realname = $request->realname;
        $user->mobile = $request->mobile;
        $user->qq = $request->qq;
        $user->wechatid = $request->wechatid;
        $user->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.user.editsucceed'), 'url' => route('admin.user.user.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.user.editsucceed'), 'url' => route('admin.user.user.index')]);
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
        $user = CommonUserModel::findOrFail($id);
        $user->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function group(Request $request, $id)
    {
        $user = CommonUserModel::findOrFail($id);
        if ($request->isMethod('POST')) {
            $rules = array(
                'group_id' => 'required',
            );
            $messages = array(
                'group_id.required' => '用户组不允许为空！',
            );
            $this->validate($request, $rules, $messages);

            if ($user->group_id != $request->group_id){
                $group = CommonUserGroupModel::find($request->group_id);
                //授权卖卡业务员
                if ($group->grantsellcard){
                    $personnel = CrmPersonnelModel::onlyTrashed()->where('uid', $user->uid)->first();
                    if($personnel) {
                        $personnel->restore();
                    }else {
                        CrmPersonnelModel::firstOrCreate(['uid' => $user->uid]);
                    }
                }else{
                    CrmPersonnelModel::where('uid', $user->uid)->delete();
                }

                // 授权微信账号给微信分组
                $wx_info = WechatUserModel::where('user_id', $user->uid)->first();
                if ($wx_info){
                    $app = app('wechat.official_account');
                    if ($wx_info->tagid_list){
                        foreach (unserialize($wx_info->tagid_list) as $value) {
                            $app->user_tag->untagUsers([$wx_info->openid], $value);
                        }
                    }
                    if ($group->tag_id){
                        $app->user_tag->tagUsers([$wx_info->openid], $group->tag_id);
                        $wx_info->tagid_list = serialize([$group->tag_id]);
                        $wx_info->save();
                    }else{
                        $wx_info->tagid_list = '';
                        $wx_info->save();
                    }
                    $WechatMenuModel = new WechatMenuModel;
                    $result = $WechatMenuModel->publish($group->tag_id);
                }
            }
            $user->group_id = $request->group_id;
            $user->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.user.user.editsucceed'), 'url' => route('admin.user.user.index')]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.user.editsucceed'), 'url' => route('admin.user.user.index')]);
            }
        }else{
            $grouplist = CommonUserGroupModel::orderBy('displayorder', 'asc')->get();
            return view('admin.user.user.group', ['user' => $user, 'grouplist' => $grouplist]);
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
            CommonUserModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function promotion(Request $request)
    {
        $CommonUserModel = new CommonUserModel;
        $userlist = $CommonUserModel->where('fromuid', '>', 0)->where(function($query) use($request) {
            if($request->username){
                $query->where('username', 'like',"%".$request->username."%");
            }
        })->latest()->paginate(20);
        return view('admin.user.user.promotion', ['userlist' => $userlist]);
    }

}
