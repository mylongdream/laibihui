<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
use App\Models\CrmGrantcancelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;

class PartnerController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'partner');
    }

    public function index(Request $request)
    {
        if(auth()->user()->group->type != 'user'){
            return view('layouts.mobile.message', ['status' => 0, 'info' => '你已不是普通会员', 'url' => back()->getTargetUrl()]);
        }
        return view('mobile.user.partner.index');
    }

    public function qrcode(Request $request)
    {
        if(auth()->user()->group->type != 'user'){
            return view('layouts.mobile.message', ['status' => 0, 'info' => '你已不是普通会员', 'url' => back()->getTargetUrl()]);
        }
        $url = route('mobile.grantsell', ['fromuser' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
        $imgurl = 'grantsell/qrcode_'.auth()->user()->uid.'.png';
        QrCode::format('png')->size(400)->generate($url, storage_path('app/public/qrcode/'.$imgurl));
        $qrcode = uploadQrcode($imgurl);
        return view('mobile.user.partner.qrcode', ['qrcode' => $qrcode]);
    }

    public function cancel(Request $request)
    {
        if(auth()->user()->group->type != 'user'){
            return view('layouts.mobile.message', ['status' => 0, 'info' => '你已不是普通会员', 'url' => back()->getTargetUrl()]);
        }
        $cancel = new CrmGrantcancelModel;
        $cancel->uid = auth()->user()->uid;
        $cancel->topuid = auth()->user()->personnel->topuid;
        $cancel->postip = $request->getClientIp();
        $cancel->save();

        if ($request->ajax()) {
            return response()->json(['status' => 1, 'info' => '成功申请取消授权办卡', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '成功申请取消授权办卡', 'url' => back()->getTargetUrl()]);
        }
    }

}
