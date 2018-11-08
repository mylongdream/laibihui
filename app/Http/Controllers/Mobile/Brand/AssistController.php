<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandAppointModel;
use App\Models\BrandCategoryModel;
use App\Models\BrandCollectionModel;
use App\Models\BrandCommentModel;
use App\Models\BrandConsumeModel;
use App\Models\BrandHistoryModel;
use App\Models\BrandProductModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Toplan\PhpSms\Facades\Sms;
use Yansongda\Pay\Pay;


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
