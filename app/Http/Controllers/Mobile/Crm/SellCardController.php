<?php

namespace App\Http\Controllers\Mobile\Crm;

use App\Http\Controllers\Controller;

use App\Models\CrmPersonnelModel;
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
            $promotion = route('mobile.grantsell', ['fromuser' => Hashids::connection('promotion')->encode(auth('crm')->user()->uid)]);
            $image = QrCode::format('png')->size(400)->generate($promotion);
            $qrcode = Image::make($image);
            return $qrcode->response('png', 90);
        }else{
            return view('mobile.crm.sellcard.index');
        }
    }

    public function users(Request $request)
    {
        $users = CrmPersonnelModel::where('topuid', auth('crm')->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.crm.sellcard.users', ['users' => $users]);
    }

}
