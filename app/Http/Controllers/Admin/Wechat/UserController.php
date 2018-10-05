<?php

namespace App\Http\Controllers\Admin\Wechat;

use App\Http\Controllers\Controller;
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
        $userlist = WechatUserModel::where(function($query) use($request) {
            if($request->subscribe == 'yes'){
                $query->where('subscribe', 1);
            }elseif($request->subscribe == 'no'){
                $query->where('subscribe', 0);
            }
        })->where(function($query) use($request) {
            if($request->openid){
                $query->where('openid', 'like',"%".$request->openid."%");
            }
        })->where(function($query) use($request) {
            if($request->nickname){
                $query->where('nickname', 'like',"%".$request->nickname."%");
            }
        })->latest()->paginate(20);
        return view('admin.wechat.user.index', ['userlist' => $userlist]);
    }

    public function show($id)
    {
        $user = WechatUserModel::findOrFail($id);
        return view('admin.wechat.user.show', ['user' => $user]);
    }

    public function import(Request $request)
    {
        $app = app('wechat.official_account');
        $users = $app->user->list($request->next_openid);
        if($users["count"] > 0){
            foreach ($users["data"]["openid"] as $value) {
                $user = WechatUserModel::where('openid', $value)->first();
                if(!$user){
                    $user = new WechatUserModel();
                    $user->subscribe = 1;
                    $user->openid = $value;
                    $user->save();
                }
            }
        }
        if($users['next_openid']) {
            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '继续导入下一批用户信息', 'url' => route('admin.wechat.user.import', ['next_openid' => $users['next_openid']])]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => '继续导入下一批用户信息', 'url' => route('admin.wechat.user.import', ['next_openid' => $users['next_openid']])]);
            }
        }else{
            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '用户信息已全部导入成功', 'url' => route('admin.wechat.user.index')]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => '用户信息已全部导入成功', 'url' => route('admin.wechat.user.index')]);
            }
        }
    }

    public function upall(Request $request)
    {
        $app = app('wechat.official_account');
        $userlist = WechatUserModel::latest()->paginate(20);
        foreach ($userlist as $value) {
            $user = $app->user->get($value->openid);
            if($user){
                $value->subscribe = $user['subscribe'];
                $value->openid = $user['openid'];
                if($user['subscribe']){
                    $value->nickname = $user['nickname'];
                    $value->sex = $user['sex'];
                    $value->language = $user['language'];
                    $value->city = $user['city'];
                    $value->province = $user['province'];
                    $value->country = $user['country'];
                    $value->headimgurl = $user['headimgurl'];
                    $value->subscribe_time = $user['subscribe_time'];
                    $value->remark = $user['remark'];
                    $value->groupid = isset($user['groupid']) ? $user['groupid'] : '';
                    $value->unionid = isset($user['unionid']) ? $user['unionid'] : '';
                    $value->tagid_list = $user['tagid_list'] ? serialize($user['tagid_list']) : '';
                    $value->subscribe_scene = $user['subscribe_scene'];
                    $value->qr_scene = $user['qr_scene'];
                    $value->qr_scene_str = $user['qr_scene_str'];
                }
                $value->save();
            }
        }
        if($userlist->nextPageUrl()) {
            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '继续更新下一批用户信息', 'url' => $userlist->nextPageUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => '继续更新下一批用户信息', 'url' => $userlist->nextPageUrl()]);
            }
        }else{
            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '用户信息已全部更新成功', 'url' => route('admin.wechat.user.index')]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => '用户信息已全部更新成功', 'url' => route('admin.wechat.user.index')]);
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $userinfo = WechatUserModel::findOrFail($id);
        $app = app('wechat.official_account');
        $getuser = $app->user->get($userinfo->openid);
        if($getuser){
            $userinfo->subscribe = $getuser['subscribe'];
            $userinfo->openid = $getuser['openid'];
            if($getuser['subscribe']){
                $userinfo->nickname = $getuser['nickname'];
                $userinfo->sex = $getuser['sex'];
                $userinfo->language = $getuser['language'];
                $userinfo->city = $getuser['city'];
                $userinfo->province = $getuser['province'];
                $userinfo->country = $getuser['country'];
                $userinfo->headimgurl = $getuser['headimgurl'];
                $userinfo->subscribe_time = $getuser['subscribe_time'];
                $userinfo->remark = $getuser['remark'];
                $userinfo->groupid = isset($getuser['groupid']) ? $getuser['groupid'] : '';
                $userinfo->unionid = isset($getuser['unionid']) ? $getuser['unionid'] : '';
                $userinfo->tagid_list = $getuser['tagid_list'] ? serialize($getuser['tagid_list']) : '';
                $userinfo->subscribe_scene = $getuser['subscribe_scene'];
                $userinfo->qr_scene = $getuser['qr_scene'];
                $userinfo->qr_scene_str = $getuser['qr_scene_str'];
            }
            $userinfo->save();
        }
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '用户信息已更新成功', 'url' => route('admin.wechat.user.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => '用户信息已更新成功', 'url' => route('admin.wechat.user.index')]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = WechatUserModel::findOrFail($id);
        $user->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.wechat.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.wechat.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            WechatUserModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.wechat.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.wechat.user.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.undefined.operation')]);
        }
    }

}
