<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCollectionModel;
use App\Models\BrandConsumeModel;
use App\Models\FarmCommentModel;
use App\Models\FarmModel;
use App\Models\FarmOrderModel;
use App\Models\FarmPackageModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yansongda\Pay\Pay;


class FarmController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'farm');
    }

    public function index(Request $request)
    {
        $index = collect();
        $index->farmlist = FarmModel::latest()->get()->take(30);
        return view('mobile.brand.farm.index', ['index' => $index]);
    }

    public function search()
    {
        return view('mobile.brand.farm.search');
    }

    public function lists(Request $request){
        $FarmModel = new FarmModel;
        $farmlist = $FarmModel->where(function($query) use($request) {
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
        return view('mobile.brand.farm.lists', ['farmlist' => $farmlist]);
    }

    public function show(Request $request){
        $farm = FarmModel::where('id', $request->id)->firstOrFail();
        $commentlist = FarmCommentModel::where('farm_id', $farm->id)->latest()->get()->take(8);
        //if($article->city){
            //return redirect()->route('subweb.article.detail',[$article->city['domain'],$article->article_id]);
        //}else{
        $farm->increment('viewnum');

            return view('mobile.brand.farm.show', ['farm'=>$farm, 'commentlist'=>$commentlist]);
        //}
    }

    public function map(Request $request){
        $farm = FarmModel::where('id', $request->id)->firstOrFail();
        return view('mobile.brand.farm.map', ['farm'=>$farm]);
    }

    public function collection(Request $request){
        $farm = FarmModel::where('id', $request->id)->firstOrFail();
        if (!auth()->check()) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '请登录后再收藏', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '请登录后再收藏', 'url' => back()->getTargetUrl()]);
            }
        }
        if (auth()->user()->collections()->where('farm_id', $farm->id)->count()) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '已经收藏过此店铺', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '已经收藏过此店铺', 'url' => back()->getTargetUrl()]);
            }
        }

        $collection = new BrandCollectionModel;
        $collection->uid = auth()->user()->uid;
        $collection->farm_id = $farm->id;
        $collection->postip = request()->getClientIp();
        $collection->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '收藏成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => '收藏成功', 'url' => back()->getTargetUrl()]);
        }
    }

    public function order(Request $request){
        $farm = FarmModel::where('id', $request->id)->firstOrFail();
        if ($farm->package->where('onsale', 1)->isEmpty()) {
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'info' => '暂无设置套餐，无法预约', 'url' => route('brand.farm.show', ['id' => $farm->id])]);
            } else {
                return view('layouts.mobile.message', ['status' => 0, 'info' => '暂无设置套餐，无法预约', 'url' => route('brand.farm.show', ['id' => $farm->id])]);
            }
        }
        $setting = cache('setting');
        if ($request->isMethod('POST')) {
            $rules = array(
                'package_id' => 'required|numeric|exists:brand_farm_package,id,farm_id,'.$farm->id,
                'gotime' => 'required|date',
                'realname' => 'required',
                'mobile' => 'required',
            );
            $messages = array(
                'package_id.required' => '套餐不允许为空！',
                'package_id.numeric' => '套餐选择错误！',
                'package_id.exists' => '选择套餐不存在！',
                'gotime.required' => '到店时间不允许为空！',
                'gotime.date' => '到店时间格式错误！',
                'realname.required' => '您的姓名不允许为空！',
                'mobile.required' => '手机号码不允许为空！',
            );
            $this->validate($request, $rules, $messages);

            $package = FarmPackageModel::where('id', $request->package_id)->first();
            $order = new FarmOrderModel();
            $order->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $order->farm_id = $farm->id;
            $order->package_id = $package->id;
            $order->package_name = $package->name;
            $order->gotime = $request->gotime;
            $order->realname = $request->realname;
            $order->mobile = $request->mobile;
            $order->order_amount = $package->price;
            $order->remark = $request->remark;
            $order->postip = request()->getClientIp();
            $order->uid = auth()->user()->uid;
            $order->save();

            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => '', 'url' => route('mobile.brand.farm.pay', ['id' => $order->order_sn])]);
            } else {
                return view('layouts.mobile.message', ['status' => 1, 'info' => '', 'url' => route('mobile.brand.farm.pay', ['id' => $order->order_sn])]);
            }
        } else {
            return view('mobile.brand.farm.order', ['farm' => $farm]);
        }
    }

    public function pay(Request $request){
        $order = FarmOrderModel::where('order_sn', $request->id)->firstOrFail();
        if($request->isMethod('POST')){
            if ($request->paytype == 1){ //支付宝支付
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_amount' => '20',
                    'subject'      => '卡密购买',
                ];
                return Pay::alipay()->wap($order);
            }
            if ($request->paytype == 2){ //微信支付
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_fee' => '2000',              // 订单金额，**单位：分**
                    'body' => '卡密购买',                   // 订单描述
                    'spbill_create_ip' => request()->getClientIp(),       // 调用 API 服务器的 IP
                    'product_id' => '0',
                ];
                return Pay::wechat()->wap($order);
            }

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '消费订单生成成功', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => '1', 'info' => '消费订单生成成功', 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('mobile.brand.farm.pay', ['order'=>$order]);
        }
    }

}
