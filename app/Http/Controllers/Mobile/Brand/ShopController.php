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


class ShopController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'shop');
    }

    public function index(Request $request){
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        $catid = intval($request->catid);
        if($catid){
            $category = BrandCategoryModel::where('id', $catid)->first();
            if($category){
                $catid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
            }else{
                $catid = 0;
            }
        }
        $BrandShopModel = new BrandShopModel;
        $shoplist = $BrandShopModel->where(function($query) use($catid) {
            if($catid){
                $query->whereIn('catid', $catid);
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like', "%".$request->name."%");
            }
        })->where(function($query) use($request) {
            if($request->keyword){
                if(is_numeric($request->keyword)){
                    $query->where('id', '=', $request->keyword);
                }else{
                    $query->where('name', 'like', "%".$request->keyword."%")
                        ->orWhere('address', 'like', "%".$request->keyword."%");
                }
            }
        })->latest()->paginate(20);
        return view('mobile.brand.shop.index', ['shoplist' => $shoplist]);
    }

    public function show(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        $commentlist = BrandCommentModel::where('shop_id', $shop->id)->latest()->get()->take(8);
        //if($article->city){
            //return redirect()->route('subweb.article.detail',[$article->city['domain'],$article->article_id]);
        //}else{
        $shop->increment('viewnum');
        if (auth()->check()) {
            $history = BrandHistoryModel::firstOrNew(['uid' => auth()->user()->uid, 'shop_id' => $shop->id]);
            $history->uid = auth()->user()->uid;
            $history->shop_id = $shop->id;
            $history->postip = request()->getClientIp();
            $history->updated_at = time();
            $history->save();
        }
            return view('mobile.brand.shop.show', ['shop'=>$shop, 'commentlist'=>$commentlist]);
        //}
    }

    public function product(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        $products = BrandProductModel::where('shop_id', $shop->id)->latest()->paginate(15);
        return view('mobile.brand.shop.product', ['shop'=>$shop, 'products' => $products]);
    }

    public function map(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        return view('mobile.brand.shop.map', ['shop'=>$shop]);
    }

    public function zizhi(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        return view('mobile.brand.shop.zizhi', ['shop'=>$shop]);
    }

    public function comment(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if($request->isMethod('POST')){
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
            $comment->upphoto = serialize($request->upphoto);
            $comment->postip = request()->getClientIp();
            $comment->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '评论发表成功', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => '1', 'info' => '评论发表成功', 'url' => back()->getTargetUrl()]);
            }
        }else {
            $commentlist = BrandCommentModel::where('shop_id', $shop->id)->latest()->paginate(12);
            return view('mobile.brand.shop.comment', ['commentlist' => $commentlist, 'shop' => $shop]);
        }
    }

    public function commentcreate(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if($request->isMethod('POST')){
            if (!auth()->check()) {
                return response()->json(['status' => '0', 'info' => '请登录后再评论']);
            }

            $rules = array(
                'service' => 'required|numeric|min:1|max:5',
                'environment' => 'required|numeric|min:1|max:5',
                'priceratio' => 'required|numeric|min:1|max:5',
                'message' => 'required|max:50',
            );
            $messages = array(
                'service.required' => '服务尚未评分！',
                'service.numeric' => '服务评分错误。',
                'service.min' => '服务评分错误。',
                'service.max' => '服务评分错误。',
                'environment.required' => '环境尚未评分！',
                'environment.numeric' => '环境评分错误。',
                'environment.min' => '环境评分错误。',
                'environment.max' => '环境评分错误。',
                'priceratio.required' => '性价比尚未评分！',
                'priceratio.numeric' => '性价比评分错误。',
                'priceratio.min' => '性价比评分错误。',
                'priceratio.max' => '性价比评分错误。',
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
            if($request->upphoto) {
                $comment->upphoto = serialize($request->upphoto);
            }
            $comment->postip = request()->getClientIp();
            $comment->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '评论发表成功', 'url' => route('mobile.brand.shop.comment', $shop->id)]);
            }else{
                return view('layouts.mobile.message', ['status' => '1', 'info' => '评论发表成功', 'url' => route('mobile.brand.shop.comment', $shop->id)]);
            }
        }else {
            return view('mobile.brand.shop.comment_create', ['shop' => $shop]);
        }
    }

    public function appoint(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if($request->isMethod('POST')){
            if (!auth()->check()) {
                return response()->json(['status' => '0', 'info' => '请登录后再预约']);
            }

            $rules = array(
                'realname' => 'required|max:10',
                'number' => 'required|numeric|min:1',
                'mobile' => 'required|zh_mobile|max:15',
                'appoint_at' => 'required|date|after:today',
            );
            $messages = array(
                'realname.required' => '顾客姓名不允许为空！',
                'realname.max' => '顾客姓名必须小于 :max 个字符。',
                'number.required' => '预约人数不允许为空！',
                'number.numeric' => '预约人数必须为数值。',
                'number.min' => '预约人数不能少于 :min 人。',
                'mobile.required' => '手机号码不允许为空！',
                'mobile.zh_mobile' => '手机号码填写错误！',
                'mobile.max' => '手机号码必须小于 :max 个字符。',
                'appoint_at.required' => '预约时间不允许为空！',
                'appoint_at.max' => '预约时间格式不对。',
                'appoint_at.after' => '预约时间填写错误。',
            );
            $this->validate($request, $rules, $messages);

            $appoint = new BrandAppointModel;
            $appoint->uid = auth()->user()->uid;
            $appoint->shop_id = $shop->id;
            $appoint->realname = $request->realname;
            $appoint->number = intval($request->number);
            $appoint->mobile = $request->mobile;
            $appoint->appoint_at = $request->appoint_at ? strtotime($request->appoint_at) : $request->appoint_at;
            $appoint->remark = $request->remark;
            $appoint->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $appoint->postip = request()->getClientIp();
            $appoint->save();

            if ($shop->mobile){
                $content = '店铺有客户预约，姓名：'.$appoint->realname.'，手机：'.$appoint->mobile.'，预约人数：'.$appoint->number.'人，预约时间：'.$appoint->appoint_at->format('Y-m-d H:i').($appoint->remark ? '，备注：'.$appoint->remark : '');
                Sms::make()->to([86, $shop->mobile])->content($content)->send();
            }

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '预约成功', 'url' => route('mobile.user.appoint.index')]);
            }else{
                return view('layouts.mobile.message', ['status' => '1', 'info' => '预约成功', 'url' => route('mobile.user.appoint.index')]);
            }
        }else{
            return view('mobile.brand.shop.appoint', ['shop'=>$shop]);
        }
    }

    public function collection(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if (!auth()->check()) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '请登录后再收藏', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '请登录后再收藏', 'url' => back()->getTargetUrl()]);
            }
        }
        if (auth()->user()->collections()->where('shop_id', $shop->id)->count()) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '已经收藏过此店铺', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '已经收藏过此店铺', 'url' => back()->getTargetUrl()]);
            }
        }

        $collection = new BrandCollectionModel;
        $collection->uid = auth()->user()->uid;
        $collection->shop_id = $shop->id;
        $collection->postip = request()->getClientIp();
        $collection->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '收藏成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => '收藏成功', 'url' => back()->getTargetUrl()]);
        }
    }

    public function pay(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if($request->isMethod('POST')){
            $rules = array(
                'amount' => 'required|numeric',
                'paytype' => ['required', Rule::in(['alipay', 'wechat', 'offline'])],
            );
            $messages = array(
                'amount.required' => '支付金额不允许为空！',
                'amount.max' => '支付金额必须为数值。',
                'paytype.required' => '付款方式不允许为空！',
                'paytype.in' => '付款方式选择错误！',
            );
            $this->validate($request, $rules, $messages);

            $order = new BrandConsumeModel();
            $order->uid = auth()->user()->uid;
            $order->shop_id = $shop->id;
            $order->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $order->pay_type = $request->paytype;
            $order->consume_money = $request->amount;
            $order->discount_money = $request->amount * $shop->discount / 10;
            $order->indiscount_money = $request->amount * $shop->indiscount / 10;
            $order->tiyan_money = 0;
            $order->order_amount = $order->discount_money - $order->tiyan_money;
            $order->postip = request()->getClientIp();
            $order->save();

            if ($order->pay_type == 'alipay'){ //支付宝支付
                $config = config('pay.alipay');
                $config['notify_url'] = route('api.alipay.consume.notify');
                $config['return_url'] = route('api.alipay.consume.callback');
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_amount' => $order->order_amount,
                    'subject'      => '买单消费',
                ];
                $alipay = Pay::alipay($config)->wap($order);
                return $alipay->send();
            }
            if ($order->pay_type == 'wechat'){ //微信支付
                $config = config('pay.alipay');
                $config['notify_url'] = route('api.alipay.consume.notify');
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_fee' => $order->order_amount * 100,              // 订单金额，**单位：分**
                    'body' => '买单消费',                   // 订单描述
                    'spbill_create_ip' => request()->getClientIp(),       // 调用 API 服务器的 IP
                    'product_id' => '0',
                ];
                return Pay::wechat($config)->wap($order);
            }

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '消费订单生成成功', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => '1', 'info' => '消费订单生成成功', 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('mobile.brand.shop.pay', ['shop'=>$shop]);
        }
    }

}
