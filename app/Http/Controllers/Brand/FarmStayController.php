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

class FarmStayController extends Controller
{
    public function __construct()
    {
        //view()->share('showcat', 1);
    }

    public function index(Request $request)
    {
        $index = collect();
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        $catid = 2;//美食
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_food = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        return view('brand.farmstay.index', ['index' => $index]);
    }

}
