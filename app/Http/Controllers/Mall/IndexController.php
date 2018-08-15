<?php

namespace App\Http\Controllers\Mall;

use App\Http\Controllers\Controller;

use App\Models\MallCategoryModel;
use App\Models\MallProductModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $index = collect();
        $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();

        $catid = 2;//美食
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_food = MallProductModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 11;//娱乐
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_yule = MallProductModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 4;//美容化妆
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_meizhuang = MallProductModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 31;//婚纱摄影
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_hunqing = MallProductModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        $catid = 31;//鞋帽箱包
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_xiemao = MallProductModel::whereIn('catid', $incatid)->latest()->get()->take(25);

        return view('mall.index', ['index' => $index]);
    }

}
