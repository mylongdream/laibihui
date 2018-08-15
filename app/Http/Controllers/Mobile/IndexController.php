<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BrandCategoryModel;
use App\Models\BrandShopModel;
use App\Models\CommonUserModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Vinkla\Hashids\Facades\Hashids;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'index');
    }

    public function index(Request $request)
    {
        $index = collect();
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();

        $catid = 2;//美食
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_food = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $catid = 11;//娱乐
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_yule = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $catid = 4;//美容化妆
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_meizhuang = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $catid = 31;//婚纱摄影
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_hunqing = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $location = Cookie::get('location');
        if($location){
            $location = collect(json_decode($location));
            $location = $location['position'];
            $maplat = $location->lat;
            $maplng = $location->lng;
            $index->shops = BrandShopModel::select('*')->selectRaw('(2 * 6378.137* ASIN(SQRT(POW(SIN(PI()*('.$maplat.'-maplat)/360),2)+COS(PI()*'.$maplat.'/180)* COS(maplat * PI()/180)*POW(SIN(PI()*('.$maplng.'-maplng)/360),2)))) AS distance')->orderBy('distance', 'asc')->latest()->get()->take(30);
        }else{
            $index->shops = BrandShopModel::latest()->get()->take(30);
        }
        return view('mobile.index', ['index' => $index]);
    }

    public function search()
    {
        return view('mobile.search');
    }

    public function promotion(Request $request)
    {
        if ($request->fromuser) {
            $fromuid = Hashids::connection('promotion')->decode($request->fromuser);
            if ($fromuid) {
                $fromuser = CommonUserModel::where('uid', $fromuid)->first();
                if ($fromuser) {
                    if (strpos(request()->userAgent(), 'MicroMessenger') !== false){
                        $imgurl = 'qrcode/user/qrcode_'.(strpos(request()->userAgent(), 'MicroMessenger') !== false ? 'wx_' : '').$fromuser->uid.'.png';
                        if(!Storage::disk('public')->exists($imgurl)) {
                            $app = app('wechat.official_account');
                            $qrcode = $app->qrcode->forever($fromuser->uid);
                            $qrcode = $app->qrcode->url($qrcode['ticket']);
                            $qrcode = file_get_contents($qrcode);
                            $qrcode = Image::make($qrcode)->resize(400, 400);

                            $img = Image::make(public_path('static/image/mobile/qrcode_bg.jpg'));
                            $headimgurl = $fromuser->headimgurl && Storage::disk('public')->exists('image/'.$fromuser->headimgurl) ? storage_path('app/public/image/'.$fromuser->headimgurl) : public_path('static/image/common/getheadimg.jpg');
                            $headimgurl = Image::make($headimgurl)->resize(50, 50);

                            $img->insert($headimgurl, 'top-left', 15, 15);
                            $img->text($fromuser->username, 80, 50, function($font) {
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
                        $cookie = cookie('promotion', $fromuser->uid, 1800);
                        return response()->redirectToRoute('mobile.index')->cookie($cookie);
                    }
                }
            }
        }
        return response()->redirectToRoute('mobile.index');
    }
}
