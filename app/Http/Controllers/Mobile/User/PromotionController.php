<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserCardModel;
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
        $usercount = collect();
        $usercount->first = CommonUserModel::where('fromuid', auth()->user()->uid)->count();
        $usercount->second = CommonUserModel::where('fromupuid', auth()->user()->uid)->count();
        return view('mobile.user.promotion.index', ['usercount' => $usercount]);
    }

    public function rule(Request $request)
    {
        return view('mobile.user.promotion.rule');
    }

    public function qrcode(Request $request)
    {
        $promotion = route('mobile.promotion', ['fromuser' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
        if($request->getcode){
            $imgurl = 'qrcode/user/qrcode_'.(strpos(request()->userAgent(), 'MicroMessenger') !== false ? 'wx_' : '').auth()->user()->uid.'.png';
            if(!Storage::disk('public')->exists($imgurl)) {
                $image = QrCode::format('png')->size(400)->generate($promotion);
                $qrcode = Image::make($image);
                if (strpos(request()->userAgent(), 'MicroMessenger') !== false){
                    $app = app('wechat.official_account');
                    $qrcode = $app->qrcode->forever(auth()->user()->uid);
                    $qrcode = $app->qrcode->url($qrcode['ticket']);
                    $qrcode = file_get_contents($qrcode);
                    $qrcode = Image::make($qrcode)->resize(400, 400);
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
            return view('mobile.user.promotion.qrcode', ['shareData' => $shareData]);
        }
    }

    public function first(Request $request)
    {
        $CommonUserModel = new CommonUserModel;
        $promotions = $CommonUserModel->where('fromuid', auth()->user()->uid)->where(function($query) use($request) {
            if($request->username){
                $uids = CommonUserModel::where('username', 'like',"%".$request->username."%")->pluck('uid');
                $query->whereIn('uid', $uids);
            }
        })->latest()->paginate(20);
        return view('mobile.user.promotion.first', ['promotions' => $promotions]);
    }

    public function second(Request $request)
    {
        $CommonUserModel = new CommonUserModel;
        $promotions = $CommonUserModel->where('fromupuid', auth()->user()->uid)->where(function($query) use($request) {
            if($request->username){
                $uids = CommonUserModel::where('username', 'like',"%".$request->username."%")->pluck('uid');
                $query->whereIn('uid', $uids);
            }
        })->latest()->paginate(20);
        return view('mobile.user.promotion.second', ['promotions' => $promotions]);
    }

}
