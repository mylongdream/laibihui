<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandProductModel;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(){
        $products = BrandProductModel::orderBy('created_at', 'desc')->paginate(16);
        return view('brand.product.index', ['products' => $products]);
    }

    public function detail(Request $request){
        $product = BrandProductModel::where('id', $request->id)->firstOrFail();
        $product->increment('viewnum');
        $shop = $product->shop;
        return view('brand.product.detail', ['product' => $product, 'shop' => $shop]);
    }
}
