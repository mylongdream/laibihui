<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;

use App\Models\FarmModel;
use App\Models\FarmOrderModel;
use App\Models\FarmPackageModel;
use Illuminate\Http\Request;
use Yansongda\LaravelPay\Facades\Pay;

class FarmController extends Controller
{
    public function __construct()
    {
        //view()->share('showcat', 1);
        view()->share(['curmenu' => 'farm']);
    }

    public function index(Request $request)
    {
        $farm = collect();
        $farm->recommend = FarmModel::latest()->get()->take(4);
        $farm->interest = FarmModel::latest()->get()->take(8);

        return view('brand.farm.index', ['farm' => $farm]);
    }

    public function lists(Request $request)
    {
        $FarmModel = new FarmModel;
        $farmlist = $FarmModel->where(function($query) use($request) {
            if($request->group){
                $query->whereHas('attrs', function ($query) use($request) {
                    $query->where('type', 'group')->whereIn('id', explode('-', $request->group));
                });
            }
            if($request->play){
                $query->whereHas('attrs', function ($query) use($request) {
                    $query->where('type', 'play')->whereIn('id', explode('-', $request->play));
                });
            }
            if($request->minprice){
                $query->where('price', '>=', $request->minprice);
            }
            if($request->maxprice){
                $query->where('price', '<=', $request->maxprice);
            }
            if($request->keyword){
                $query->where('name', 'like',"%".$request->keyword."%");
            }
        });
        switch ($request->orderby){
            case 'discount':
                $farmlist = $farmlist->orderBy('price', 'asc');
                break;
            case 'viewnum':
                $farmlist = $farmlist->orderBy('viewnum', 'desc');
                break;
            case 'addtime':
                $farmlist = $farmlist->orderBy('created_at', 'desc');
                break;
            default:
                break;
        }
        $farmlist = $farmlist->paginate(20);
        return view('brand.farm.lists', ['farmlist' => $farmlist]);
    }

    public function show(Request $request)
    {
        $farm = FarmModel::where('id', $request->id)->firstOrFail();
        $farm->increment('viewnum');
        return view('brand.farm.show', ['farm' => $farm]);
    }

    public function order(Request $request){
        $farm = FarmModel::where('id', $request->id)->firstOrFail();
        if ($farm->package->where('onsale', 1)->isEmpty()) {
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'info' => '暂无设置套餐，无法预约', 'url' => route('brand.farm.show', ['id' => $farm->id])]);
            } else {
                return view('layouts.common.message', ['status' => 0, 'info' => '暂无设置套餐，无法预约', 'url' => route('brand.farm.show', ['id' => $farm->id])]);
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
                return response()->json(['status' => 1, 'info' => '', 'url' => route('brand.farm.pay', ['id' => $order->order_sn])]);
            } else {
                return view('layouts.common.message', ['status' => 1, 'info' => '', 'url' => route('brand.farm.pay', ['id' => $order->order_sn])]);
            }
        } else {
            return view('brand.farm.order', ['farm' => $farm]);
        }
    }

    public function pay(Request $request, $id){
        $setting = cache('setting');
        $order = FarmOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->first();
        if ($request->isMethod('POST')) {
            if ($request->paytype == 1){ //支付宝支付
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_amount' => '20',
                    'subject'      => '农家乐订单',
                ];
                return Pay::alipay()->web($order);
            }
            if ($request->paytype == 2){ //微信支付
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_fee' => '2000',              // 订单金额，**单位：分**
                    'body' => '农家乐订单',                   // 订单描述
                    'spbill_create_ip' => request()->getClientIp(),       // 调用 API 服务器的 IP
                    'product_id' => '0',
                ];
                return Pay::wechat()->scan($order);
            }

            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => '农家乐下单成功', 'url' => route('user.farm.order')]);
            } else {
                return view('layouts.common.message', ['status' => 1, 'info' => '农家乐下单成功', 'url' => route('user.farm.order')]);
            }
        } else {
            return view('brand.farm.pay', ['order' => $order]);
        }
    }

}
