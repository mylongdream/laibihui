<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'category');
    }

    public function index(){
        $categorylist = BrandCategoryModel::where('parentid', 0)->orderBy('displayorder', 'asc')->paginate(15);
        return view('mobile.brand.category.index', ['categorylist' => $categorylist]);
    }

}
