<?php

namespace App\Http\Controllers\Mobile\Crm\Tuiguang;

use App\Http\Controllers\Controller;

use App\Models\CommonSellcardModel;
use App\Models\CommonUserGroupModel;
use App\Models\CommonUserModel;
use App\Models\CrmAllocationModel;
use App\Models\CrmGrantcancelModel;
use App\Models\CrmPersonnelModel;
use App\Models\WechatMenuModel;
use App\Models\WechatUserModel;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class GrantsellController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        //view()->share('curmenu', 'grantsell');
    }

    public function index(Request $request)
    {
        $count = CrmGrantcancelModel::where('topuid', auth('crm')->user()->uid)->where('status', 0)->orderBy('created_at', 'desc')->count();
        return view('mobile.crm.tuiguang.grantsell.index', ['count' => $count]);
    }

    public function apply(Request $request)
    {
        if ($request->isMethod('POST')) {
            $cancel = new CrmGrantcancelModel;
            $cancel->uid = auth('crm')->user()->uid;
            $cancel->topuid = auth('crm')->user()->personnel->topuid;
            $cancel->postip = $request->getClientIp();
            $cancel->save();
        }
        $status = CrmGrantcancelModel::where('uid', auth('crm')->user()->uid)->orderBy('created_at', 'desc')->first();
        return view('mobile.crm.tuiguang.grantsell.apply', ['status' => $status]);
    }

    public function subapply(Request $request)
    {
        $list = CrmGrantcancelModel::where('topuid', auth('crm')->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.crm.tuiguang.grantsell.subapply', ['list' => $list]);
    }

    public function manage(Request $request)
    {
        $list = CrmPersonnelModel::where('topuid', auth('crm')->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.crm.tuiguang.grantsell.manage', ['list' => $list]);
    }

    public function patch(Request $request)
    {
        $rules = array(
            'cardnum' => 'required|numeric|min:1',
        );
        $messages = array(
            'cardnum.required' => '补卡数量不能为空',
            'cardnum.numeric' => '补卡数量不正确',
            'cardnum.min' => '补卡数量最少1张',
        );
        $this->validate($request, $rules, $messages);
        if(auth('crm')->user()->personnel->allotnum < $request->cardnum){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '当前余卡数量不足', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '当前余卡数量不足', 'url' => back()->getTargetUrl()]);
            }
        }

        $personnel = CrmPersonnelModel::where('topuid', auth('crm')->user()->uid)->findOrFail($request->id);
        $allocation = new CrmAllocationModel;
        $allocation->personnel_id = $personnel->id;
        $allocation->uid = $personnel->uid;
        $allocation->cardnum = $request->cardnum;
        $allocation->remark = '上级补卡分配';
        $allocation->postip = $request->getClientIp();
        $allocation->save();
        $personnel->increment('allotnum', $request->cardnum);

        $allocation = new CrmAllocationModel;
        $allocation->personnel_id = auth('crm')->user()->personnel->id;
        $allocation->uid = auth('crm')->user()->uid;
        $allocation->cardnum = -$request->cardnum;
        $allocation->remark = '下架补卡分配';
        $allocation->postip = $request->getClientIp();
        $allocation->save();
        auth('crm')->user()->personnel->decrement('allotnum', $request->cardnum);
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '成功补卡', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '成功补卡', 'url' => back()->getTargetUrl()]);
        }
    }

    public function cancel(Request $request)
    {
        $personnel = CrmPersonnelModel::where('topuid', auth('crm')->user()->uid)->findOrFail($request->id);
        if($personnel->disabled == 1){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '已取消授权', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '已取消授权', 'url' => back()->getTargetUrl()]);
            }
        }
        //剩余卡数退回
        $allocation = new CrmAllocationModel;
        $allocation->personnel_id = auth('crm')->user()->personnel->id;
        $allocation->uid = auth('crm')->user()->uid;
        $allocation->cardnum = $personnel->allotnum - $personnel->sellnum;
        $allocation->remark = '下级剩余卡数退回';
        $allocation->postip = $request->getClientIp();
        $allocation->save();
        auth('crm')->user()->personnel->increment('allotnum', $personnel->allotnum - $personnel->sellnum);

        $allocation = new CrmAllocationModel;
        $allocation->personnel_id = $personnel->id;
        $allocation->uid = $personnel->uid;
        $allocation->cardnum = $personnel->sellnum - $personnel->allotnum;
        $allocation->remark = '剩余卡数退回上级';
        $allocation->postip = $request->getClientIp();
        $allocation->save();
        $personnel->allotnum = $personnel->sellnum;
        $personnel->save();

        //变回普通会员并更新微信菜单
        $fromuser = $personnel->user;
        $fromuser->group_id = 1;
        $fromuser->save();
        $wx_info = WechatUserModel::where('user_id', $fromuser->uid)->first();
        if ($wx_info){
            $group = CommonUserGroupModel::where('id', $fromuser->group_id)->first();
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

        $personnel->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '成功取消授权', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '成功取消授权', 'url' => back()->getTargetUrl()]);
        }
    }

}
