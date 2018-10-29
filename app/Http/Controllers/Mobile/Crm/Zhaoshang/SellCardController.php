<?php

namespace App\Http\Controllers\Mobile\Crm\Zhaoshang;

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
        if(!$this->shop->sellcard || !auth('crm')->user()->personnel){
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
            return view('mobile.crm.zhaoshang.sellcard.index');
        }
    }

    public function order(Request $request)
    {
        $orders = CommonSellcardModel::where('fromuid', auth('crm')->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.crm.zhaoshang.sellcard.order', ['orders' => $orders]);
    }

}
