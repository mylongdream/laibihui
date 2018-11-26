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

    public function cancel(Request $request)
    {
        $user = CrmPersonnelModel::where('topuid', auth('crm')->user()->uid)->findOrFail($request->id);

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('user.score.exchangesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => trans('user.score.exchangesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
