<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;

class QrcodeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function image(Request $request){
        $url = $request->url;
        $image = QrCode::format('png')->size(400)->generate($url);
        $img = Image::make($image);
        return $img->response('png', 90);
    }

}
