<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCommentModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;


class RecommendController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'recommend');
    }

    public function index(Request $request){
        $BrandShopModel = new BrandShopModel;
        $shoplist = $BrandShopModel->latest()->paginate(20);
        return view('mobile.brand.recommend.index', ['shoplist' => $shoplist]);
    }


}
