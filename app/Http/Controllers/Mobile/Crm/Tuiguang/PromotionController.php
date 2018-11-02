<?php

namespace App\Http\Controllers\Mobile\Crm\Tuiguang;

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
        return view('mobile.crm.tuiguang.promotion.index', ['cardcount' => $cardcount, 'usercount' => $usercount]);
    }

    public function rule(Request $request)
    {
        return view('mobile.crm.tuiguang.promotion.rule');
    }

    public function qrcode(Request $request)
    {
        $promotion = route('mobile.promotion', ['fromuser' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
        if($request->getcode){
            $imgurl = 'qrcode/user/qrcode_'.(strpos(request()->userAgent(), 'MicroMessenger') !== false ? 'wx_' : '').auth()->user()->uid.'.png';
            if(!Storage::disk('public')->exists($imgurl)) {
                //获取二维码
                if (strpos(request()->userAgent(), 'MicroMessenger') !== false){
                    $app = app('wechat.official_account');
                    $qrcode = $app->qrcode->forever(auth()->user()->uid);
                    $qrcode = $app->qrcode->url($qrcode['ticket']);
                    $qrcode = file_get_contents($qrcode);
                    $qrcode = Image::make($qrcode)->resize(400, 400);
                }else{
                    $image = QrCode::format('png')->size(400)->generate($promotion);
                    $qrcode = Image::make($image);
                }

                $img = Image::make(public_path('static/image/mobile/qrcode_bg.jpg'));
                $headimgurl = auth()->user()->headimgurl && Storage::disk('public')->exists('image/'.auth()->user()->headimgurl) ? storage_path('app/public/image/'.auth()->user()->headimgurl) : public_path('static/image/common/getheadimg.jpg');
                $headimgurl = Image::make($headimgurl)->resize(50, 50);

                $img->insert($headimgurl, 'top-left', 15, 15);
                $img->text(auth()->user()->username, 80, 50, function($font) {
                    $font->file(public_path('/static/font/ch/yahei.ttf'));
                    $font->size(28);
                    $font->color('#fff');
                });
                $img->insert($qrcode, 'bottom', 0, 0);
                $img->save(storage_path('app/public/'.$imgurl));
            }
            $img = Image::make(Storage::disk('public')->get($imgurl));
            return $img->response('png', 90);
        }else{
            $shareData = ['link' => $promotion];
            return view('mobile.crm.tuiguang.promotion.qrcode', ['shareData' => $shareData]);
        }
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
        return view('mobile.crm.tuiguang.promotion.first', ['usercount' => $usercount, 'promotions' => $promotions]);
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
        return view('mobile.crm.tuiguang.promotion.second', ['usercount' => $usercount, 'promotions' => $promotions]);
    }

}
