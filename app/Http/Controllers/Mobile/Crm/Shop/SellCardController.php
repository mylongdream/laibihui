<?php

namespace App\Http\Controllers\Mobile\Crm\Shop;

use App\Http\Controllers\Controller;

use App\Models\BrandSellcardModel;
use App\Models\CommonSellcardModel;
use App\Models\CrmPersonnelModel;
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
        if(!$this->shop->ordercard){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '您无权卖卡']);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '您无权卖卡']);
            }
        }
        if($request->getcode){
            $promotion = route('mobile.sellcard', ['fromtype' => 'shop', 'id' => Hashids::connection('promotion')->encode($this->shop->id)]);
            $image = QrCode::format('png')->size(400)->generate($promotion);
            $qrcode = Image::make($image);
            return $qrcode->response('png', 90);
        }else{
            return view('mobile.crm.shop.sellcard.index');
        }
    }

    public function order(Request $request)
    {
        $orders = CommonSellcardModel::where('fromtype', 'shop')->where('fromid', $this->shop->id)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.crm.shop.sellcard.order', ['orders' => $orders]);
    }

}
