<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonSellcardModel;
use App\Models\CommonUserModel;
use App\Models\CommonUserSellcardModel;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class SellCardController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'sellcard');
    }

    public function index(Request $request)
    {
        if(!auth()->user()->personnel){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '您无权卖卡']);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '您无权卖卡']);
            }
        }
        if($request->getcode){
            $promotion = route('mobile.sellcard', ['fromtype' => 'user', 'id' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
            $image = QrCode::format('png')->size(400)->generate($promotion);
            $qrcode = Image::make($image);
            return $qrcode->response('png', 90);
        }else{
            return view('mobile.user.sellcard.index');
        }
    }

    public function order(Request $request)
    {
        $orders = CommonSellcardModel::where('fromtype', 'user')->where('fromid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.user.sellcard.order', ['orders' => $orders]);
    }

}
