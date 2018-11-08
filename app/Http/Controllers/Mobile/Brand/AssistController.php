<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandAssistModel;
use App\Models\BrandAssistOrderModel;
use Illuminate\Http\Request;


class AssistController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'assist');
    }

    public function index(Request $request){
        $list = BrandAssistModel::where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like', "%".$request->name."%");
            }
        })->latest()->paginate(20);
        return view('mobile.brand.assist.index', ['list' => $list]);
    }

    public function show(Request $request){
        $info = BrandAssistModel::where('id', $request->id)->firstOrFail();
        $info->increment('viewnum');
        return view('mobile.brand.assist.show', ['info'=>$info]);
    }

    public function order(Request $request){
        $list = BrandAssistOrderModel::where('uid', auth()->user->uid)->latest()->paginate(15);
        return view('mobile.brand.assist.order', ['list'=>$list]);
    }

}
