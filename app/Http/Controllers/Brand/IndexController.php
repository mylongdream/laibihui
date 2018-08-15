<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;

use App\Models\BrandCategoryModel;
use App\Models\BrandShopModel;
use App\Models\CommonFriendlinkModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;
use Vinkla\Hashids\Facades\Hashids;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('showcat', 1);
    }

    public function index(Request $request)
    {
        $index = collect();
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();

        $catid = 2;//美食
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_food = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 11;//娱乐
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_yule = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 4;//美容化妆
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_meizhuang = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 31;//婚纱摄影
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_hunqing = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 31;//鞋帽箱包
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_xiemao = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $index->friendlinks = CommonFriendlinkModel::orderBy('displayorder', 'asc')->get();
        return view('brand.index', ['index' => $index]);
    }

    public function promotion(Request $request)
    {
        if ($request->fromuser) {
            $fromuid = Hashids::connection('promotion')->decode($request->fromuser);
            if ($fromuid) {
                $fromuser = CommonUserModel::where('uid', $fromuid)->first();
                if ($fromuser) {
                    $cookie = cookie('promotion', $fromuser->uid, 1800);
                    return response()->redirectToRoute('index')->cookie($cookie);
                }
            }
        }
        return response()->redirectToRoute('index');
    }
}
