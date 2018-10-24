<?php

namespace App\Http\Controllers\Mobile\Crm\Shop;

use App\Http\Controllers\Controller;

use App\Models\CommonCardBookingModel;
use App\Models\CommonSellcardModel;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class SellCardController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        //view()->share('curmenu', 'sellcard');
    }

    public function index(Request $request)
    {
        if(!$this->shop->ordercard || !auth('crm')->user()->personnel){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '您无权卖卡']);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '您无权卖卡']);
            }
        }
        if($request->getcode){
            $promotion = route('mobile.sellcard', ['fromuser' => Hashids::connection('promotion')->encode(auth('crm')->user()->uid)]);
            $image = QrCode::format('png')->size(400)->generate($promotion);
            $qrcode = Image::make($image);
            return $qrcode->response('png', 90);
        }else{
            return view('mobile.crm.shop.sellcard.index');
        }
    }

    public function order(Request $request)
    {
        $orders = CommonSellcardModel::where('fromuid', auth('crm')->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.crm.shop.sellcard.order', ['orders' => $orders]);
    }

    public function checkin(Request $request)
    {
        if(!$this->shop->ordercard || !auth('crm')->user()->personnel){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '您无权卖卡']);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '您无权卖卡']);
            }
        }
        $leftcardnum = auth('crm')->user()->personnel->allotnum - auth('crm')->user()->personnel->sellnum;
        if($request->isMethod('POST')){
            $rules = array(
                'cardnum' => 'required|numeric|min:100|max:10000',
            );
            $messages = array(
                'cardnum.required' => '预定卡数不允许为空！',
                'cardnum.numeric' => '预定卡数填写不正确。',
                'cardnum.min' => '预定卡数不能小于 :min 张。',
                'cardnum.max' => '预定卡数不能大于 :max 张。',
            );
            $this->validate($request, $rules, $messages);

            $booking = new CommonCardBookingModel;
            $booking->uid = auth('crm')->user()->uid;
            $booking->cardnum = $request->cardnum;
            $booking->save();
            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '缺卡登记信息提交成功', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => '缺卡登记信息提交成功', 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('mobile.crm.shop.sellcard.checkin', ['leftcardnum' => $leftcardnum]);
        }
    }

}
