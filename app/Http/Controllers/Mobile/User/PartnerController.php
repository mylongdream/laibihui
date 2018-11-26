<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
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
        return view('mobile.user.partner.index');
    }

    public function qrcode(Request $request)
    {
        $url = route('mobile.grantsell', ['fromuser' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
        $imgurl = 'grantsell/qrcode_'.auth()->user()->uid.'.png';
        QrCode::format('png')->size(400)->generate($url, storage_path('app/public/qrcode/'.$imgurl));
        $qrcode = uploadQrcode($imgurl);
        return view('mobile.user.partner.qrcode', ['qrcode' => $qrcode]);
    }

}
