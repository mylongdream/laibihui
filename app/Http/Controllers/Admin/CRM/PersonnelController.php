<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CrmAllocationModel;
use App\Models\CrmPersonnelModel;
use App\Models\WechatMenuModel;
use App\Models\WechatUserModel;
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
        $list = CrmPersonnelModel::whereHas('user', function ($query) {
            $query->where('group_id', '6');
        })->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.crm.personnel.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topusers = CrmPersonnelModel::where('topuid', 0)->has('user')->orderBy('created_at', 'desc')->get();
        return view('admin.crm.personnel.create', ['topusers' => $topusers]);
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
            'topuid' => 'required|exists:crm_personnel,uid',
            'subusername' => 'required|exists:common_user,username',
        );
        $messages = array(
            'topuid.required' => '业务员不允许为空！',
            'topuid.exists' => '业务员不存在！',
            'subusername.required' => '卖卡会员用户名不允许为空！',
            'subusername.exists' => '卖卡会员用户名不存在！',
        );
        $this->validate($request, $rules, $messages);

        $subuser = CommonUserModel::where('username', $request->subusername)->first();
        $user = new CrmPersonnelModel;
        $user->topuid = $request->topuid;
        $user->uid = $subuser->uid;
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
        $personnel = CrmPersonnelModel::findOrFail($id);
        $this->_destroy($personnel);
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
                'ids.required' => '请选择要取消授权的记录！',
            );
            $this->validate($request, $rules, $messages);
            CrmPersonnelModel::destroy($request->ids);
            $personnels = CrmPersonnelModel::whereIn('id', $request->ids)->get();
            foreach ($personnels as $key => $value){
                $this->_destroy($value);
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.personnel.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.personnel.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function allocate(Request $request, $id)
    {
        $personnel = CrmPersonnelModel::findOrFail($id);
        if ($request->isMethod('POST')) {
            $rules = array(
                'cardnum' => 'required',
            );
            $messages = array(
                'cardnum.required' => '分配卡数不允许为空！',
            );
            $this->validate($request, $rules, $messages);

            $allocation = new CrmAllocationModel;
            $allocation->personnel_id = $personnel->id;
            $allocation->uid = $personnel->uid;
            $allocation->cardnum = $request->cardnum;
            $allocation->remark = '系统后台分配';
            $allocation->postip = $request->getClientIp();
            $allocation->save();
            $personnel->increment('allotnum', $allocation->cardnum);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.personnel.allocatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.crm.personnel.allocatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.crm.personnel.allocate', ['personnel' => $personnel]);
        }
    }

    public function allocation(Request $request, $id)
    {
        $personnel = CrmPersonnelModel::findOrFail($id);
        $list = CrmAllocationModel::where('personnel_id', $personnel->id)->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.crm.personnel.allocation', ['list' => $list]);
    }

    private function _destroy($personnel)
    {
        //变回普通会员并更新微信菜单
        $fromuser = $personnel->user;
        $fromuser->group_id = 1;
        $fromuser->save();
        $wx_info = WechatUserModel::where('user_id', $fromuser->uid)->first();
        if ($wx_info){
            $app = app('wechat.official_account');
            if ($wx_info->tagid_list){
                foreach (unserialize($wx_info->tagid_list) as $value) {
                    $app->user_tag->untagUsers([$wx_info->openid], $value);
                }
            }
            if ($fromuser->group->tag_id){
                $app->user_tag->tagUsers([$wx_info->openid], $fromuser->group->tag_id);
                $wx_info->tagid_list = serialize([$fromuser->group->tag_id]);
                $wx_info->save();
            }else{
                $wx_info->tagid_list = '';
                $wx_info->save();
            }
            $WechatMenuModel = new WechatMenuModel;
            $result = $WechatMenuModel->publish($fromuser->group->tag_id);
        }

        $personnel->delete();

    }

}
