<?php

namespace App\Http\Controllers\Mobile\Crm\Tuiguang;

use App\Http\Controllers\Controller;

use App\Models\CommonSellcardModel;
use App\Models\CommonUserModel;
use App\Models\CrmPersonnelModel;
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
        $list = CrmPersonnelModel::where('topuid', auth('crm')->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.crm.tuiguang.grantsell.index', ['list' => $list]);
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

        $personnel = CrmPersonnelModel::where('topuid', auth('crm')->user()->uid)->findOrFail($request->id);
        $personnel->increment('allotnum', $request->cardnum);
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
        //剩余卡数退回
        auth('crm')->user()->personnel->increment('allotnum', $personnel->allotnum - $personnel->sellnum);



        //变回普通会员
        $personnel->user->update(['group' => 1]);
        $personnel->delete();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '成功取消授权', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '成功取消授权', 'url' => back()->getTargetUrl()]);
        }
    }

}
