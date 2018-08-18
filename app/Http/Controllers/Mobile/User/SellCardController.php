<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
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
        if($request->getcode){
            $promotion = route('mobile.sellcard', ['fromuser' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
            $image = QrCode::format('png')->size(400)->generate($promotion);
            $qrcode = Image::make($image);
            return $qrcode->response('png', 90);
        }else{
            return view('mobile.user.sellcard.index');
        }
    }

    public function mysell(Request $request)
    {
        return view('mobile.user.sellcard.mysell');
    }

}
