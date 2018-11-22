<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;

class PromotionController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'promotion');
    }

    public function index(Request $request)
    {
        $cardcount = collect();
        $cardcount->firstnum = CommonUserModel::where('fromuid', auth()->user()->uid)->has('card')->count();
        $cardcount->firstmoney = $cardcount->firstnum * 5;
        $cardcount->secondnum = CommonUserModel::where('fromupuid', auth()->user()->uid)->has('card')->count();
        $cardcount->secondmoney = $cardcount->secondnum * 0.5;
        $usercount = collect();
        $usercount->first = CommonUserModel::where('fromuid', auth()->user()->uid)->count();
        $usercount->second = CommonUserModel::where('fromupuid', auth()->user()->uid)->count();
        return view('mobile.user.promotion.index', ['cardcount' => $cardcount, 'usercount' => $usercount]);
    }

    public function rule(Request $request)
    {
        return view('mobile.user.promotion.rule');
    }

    public function qrcode(Request $request)
    {
        $promotion = route('mobile.promotion', ['fromuser' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
        //获取二维码
        if (strpos(request()->userAgent(), 'MicroMessenger') !== false){
            $imgurl = 'user/qrcode_wx_'.auth()->user()->uid.'.png';
            $app = app('wechat.official_account');
            $qrcode = $app->qrcode->forever(auth()->user()->uid);
            $qrcode = $app->qrcode->url($qrcode['ticket']);
            //$qrcode = file_get_contents($qrcode);
            file_put_contents(storage_path('app/public/qrcode/'.$imgurl), $qrcode);
        }else{
            $imgurl = 'user/qrcode_'.auth()->user()->uid.'.png';
            QrCode::format('png')->size(400)->generate($promotion, storage_path('app/public/qrcode/'.$imgurl));
        }
        $qrcode = uploadQrcode($imgurl);
        $shareData = ['link' => $promotion];
        return view('mobile.user.promotion.qrcode', ['qrcode' => $qrcode, 'shareData' => $shareData]);
    }

    public function first(Request $request)
    {
        if(!($request->bindcard && in_array($request->bindcard, array(1, 2)))){
            return response()->redirectToRoute('mobile.user.promotion.first', ['bindcard' => 1]);
        }
        $usercount = collect();
        $usercount->hasCard = CommonUserModel::where('fromuid', auth()->user()->uid)->has('card')->count();
        $usercount->doesntHaveCard = CommonUserModel::where('fromuid', auth()->user()->uid)->doesntHave('card')->count();
        $promotions = CommonUserModel::where('fromuid', auth()->user()->uid)->where('username', 'like',"%".$request->username."%")->where(function($query) use($request) {
            if($request->bindcard == 1){
                $query->doesntHave('card');
            }elseif($request->bindcard == 2){
                $query->has('card');
            }
        })->latest()->paginate(20);
        return view('mobile.user.promotion.first', ['usercount' => $usercount, 'promotions' => $promotions]);
    }

    public function second(Request $request)
    {
        if(!($request->bindcard && in_array($request->bindcard, array(1, 2)))){
            return response()->redirectToRoute('mobile.user.promotion.second', ['bindcard' => 1]);
        }
        $usercount = collect();
        $usercount->hasCard = CommonUserModel::where('fromupuid', auth()->user()->uid)->has('card')->count();
        $usercount->doesntHaveCard = CommonUserModel::where('fromupuid', auth()->user()->uid)->doesntHave('card')->count();
        $promotions = CommonUserModel::where('fromupuid', auth()->user()->uid)->where('username', 'like',"%".$request->username."%")->where(function($query) use($request) {
            if($request->bindcard == 1){
                $query->doesntHave('card');
            }elseif($request->bindcard == 2){
                $query->has('card');
            }
        })->latest()->paginate(20);
        return view('mobile.user.promotion.second', ['usercount' => $usercount, 'promotions' => $promotions]);
    }

}
