<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCommentModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'comment');
    }

    public function index(Request $request){
            $commentlist = BrandCommentModel::latest()->paginate(12);
            return view('mobile.brand.comment.index', ['commentlist' => $commentlist]);
    }


}
