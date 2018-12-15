<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
use App\Models\CrmApplysellModel;
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
        $order = CrmApplysellModel::where('uid', auth()->user()->uid)->where('status', 0)->first();
        return view('mobile.user.partner.qrcode', ['qrcode' => $qrcode, 'order' => $order]);
    }

    public function apply(Request $request)
    {
        if(auth()->user()->group->type != 'user'){
            return view('layouts.mobile.message', ['status' => 0, 'info' => '你已不是普通会员', 'url' => back()->getTargetUrl()]);
        }
        $order = CrmApplysellModel::where('uid', auth()->user()->uid)->where('status', 0)->first();
        if($order){
            return view('layouts.mobile.message', ['status' => 0, 'info' => '你已申请，正等待受理', 'url' => back()->getTargetUrl()]);
        }
        if ($request->isMethod('POST')) {
            $rules = array(
                'realname' => 'required|max:10',
                'mobile' => 'bail|required|zh_mobile',
                'wechatid' => 'required',
                'address' => 'required',
            );
            $messages = array(
                'realname.required' => '真实姓名不允许为空！',
                'realname.max' => '真实姓名填写错误！',
                'wechatid.required' => '微信号不允许为空！',
                'address.required' => '联系地址不允许为空！',
            );
            $request->validate($rules, $messages);

            $applysell = new CrmApplysellModel;
            $applysell->uid = auth()->user()->uid;
            $applysell->realname = $request->realname;
            $applysell->mobile = $request->mobile;
            $applysell->wechatid = $request->wechatid;
            $applysell->address = $request->address;
            $applysell->remark = $request->remark;
            $applysell->postip = $request->getClientIp();
            $applysell->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '申请成功', 'url' => route('mobile.user.partner.qrcode')]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => '申请成功', 'url' => route('mobile.user.partner.qrcode')]);
            }
        }else{
            return view('mobile.user.partner.apply');
        }
    }

    public function order(Request $request)
    {
        $orders = CrmApplysellModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.user.partner.order', ['orders' => $orders]);
    }

}
