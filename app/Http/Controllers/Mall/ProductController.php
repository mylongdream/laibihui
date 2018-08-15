<?php

namespace App\Http\Controllers\Mall;

use App\Http\Controllers\Controller;
use App\Models\MallProductModel;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(){
        $products = MallProductModel::orderBy('created_at', 'desc')->paginate(16);
        return view('mall.product.index', ['products' => $products]);
    }

    public function detail(Request $request){
        $product = MallProductModel::where('id', $request->id)->firstOrFail();
        $product->increment('viewnum');
        return view('mall.product.detail', ['product' => $product]);
    }
}
