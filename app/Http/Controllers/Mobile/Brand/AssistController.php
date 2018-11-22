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

    public function receive(Request $request){
        $info = BrandAssistModel::where('id', $request->id)->firstOrFail();
        $order = BrandAssistOrderModel::where('uid', auth()->user()->uid)->where('assist_id', $info->id)->first();
        if($order){
            return response()->redirectToRoute('mobile.brand.assist.poster', ['id' => $order->id]);
        }
        $order = new BrandAssistOrderModel;
        $order->uid = auth()->user()->uid;
        $order->assist_id = $info->id;
        $order->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $order->postip = request()->getClientIp();
        $order->save();
        return response()->redirectToRoute('mobile.brand.assist.poster', ['id' => $order->id]);
    }

    public function poster(Request $request){
        $order = BrandAssistOrderModel::where('uid', auth()->user()->uid)->where('id', $request->id)->firstOrFail();
        $info = BrandAssistModel::where('id', $order->assist_id)->firstOrFail();
        $app = app('wechat.official_account');
        $qrcode = $app->qrcode->temporary('assist_'.$order->id, 6 * 24 * 3600);
        return view('mobile.brand.assist.poster', ['info'=>$info, 'qrcode'=>$qrcode]);
    }

    public function order(Request $request){
        $list = BrandAssistOrderModel::where('uid', auth()->user()->uid)->latest()->paginate(15);
        return view('mobile.brand.assist.order', ['list'=>$list]);
    }

}
