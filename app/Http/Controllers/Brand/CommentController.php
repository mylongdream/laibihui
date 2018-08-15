<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCommentModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function index(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        $newshops = BrandShopModel::latest()->get()->take(5);
        $hotshops = BrandShopModel::orderBy('viewnum', 'desc')->get()->take(5);
        $commentlist = BrandCommentModel::where('shop_id', $shop->id)->latest()->paginate(2);
        return view('brand.shop.comment', ['commentlist' => $commentlist,'shop'=>$shop,'newshops'=>$newshops,'hotshops'=>$hotshops]);
    }

    public function store(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if (!auth()->check()) {
            return response()->json(['status' => '0', 'info' => '请登录后再评论']);
        }

        $rules = array(
            'message' => 'required|max:50',
        );
        $messages = array(
            'message.required' => '评论内容不允许为空！',
            'message.max' => '评论内容必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $comment = new BrandCommentModel;
        $comment->uid = auth()->user()->uid;
        $comment->shop_id = $shop->id;
        $comment->message = $request->message;
        $comment->service = intval($request->service);
        $comment->environment = intval($request->environment);
        $comment->priceratio = intval($request->priceratio);
        $comment->postip = request()->getClientIp();
        $comment->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '评论发表成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('home.layouts.message', ['status' => '1', 'info' => '评论发表成功', 'url' => back()->getTargetUrl()]);
        }
    }
}
