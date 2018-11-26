<?php

namespace App\Http\Controllers\Mobile\Crm\Tuiguang;

use App\Http\Controllers\Controller;

use App\Models\CommonSellcardModel;
use App\Models\CommonUserModel;
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
        return view('mobile.crm.tuiguang.grantsell.index');
    }

    public function apply(Request $request)
    {
        $fromuid = $request->fromuser ? Hashids::connection('promotion')->decode($request->fromuser) : 0;
        $fromuid = $fromuid ? $fromuid : 0;
        $fromuser = CommonUserModel::where('uid', $fromuid)->first();
        if($request->isMethod('POST')){
            $rules = array(
                'amount' => 'required|numeric|min:1',
            );
            $messages = array(
                'amount.required' => '兑换可用余额不允许为空！',
                'amount.numeric' => '兑换可用余额填写不正确！',
                'amount.min' => '兑换可用余额不少于1元！',
            );
            $request->validate($rules, $messages);

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => trans('user.score.exchangesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => trans('user.score.exchangesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('mobile.crm.tuiguang.grantsell.apply', ['user' => $fromuser]);
        }
    }

}
