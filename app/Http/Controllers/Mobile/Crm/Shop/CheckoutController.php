<?php

namespace App\Http\Controllers\Mobile\Crm\Shop;

use App\Http\Controllers\Controller;

use App\Models\BrandConsumeModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yansongda\LaravelPay\Facades\Pay;

class CheckoutController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'checkout');
    }

    public function index(Request $request)
    {
        return view('mobile.crm.shop.checkout.index');
    }

    public function check(Request $request)
    {
        $rules = array(
            'user_id' => 'required|numeric|exists:common_user,uid',
            'amount' => 'required|numeric',
        );
        $messages = array(
            'user_id.required' => '用户不允许为空！',
            'user_id.numeric' => '用户选择错误！',
            'user_id.exists' => '用户不存在！',
            'amount.required' => '消费总额不允许为空！',
            'amount.numeric' => '消费总额填写错误！',
        );
        $request->validate($rules, $messages);
        $userinfo = CommonUserModel::where('uid', $request->user_id)->first();
        return view('mobile.crm.shop.checkout.check', ['userinfo' => $userinfo]);
    }

    public function pay(Request $request)
    {
        $rules = array(
            'user_id' => 'required|numeric|exists:common_user,uid',
            'amount' => 'required|numeric',
            'paytype' => 'required',
        );
        $messages = array(
            'user_id.required' => '用户不允许为空！',
            'user_id.numeric' => '用户选择错误！',
            'user_id.exists' => '用户不存在！',
            'amount.required' => '消费总额不允许为空！',
            'amount.numeric' => '消费总额填写错误！',
            'paytype.required' => '支付方式不允许为空！',
        );
        $request->validate($rules, $messages);

        $order = new BrandConsumeModel();
        $order->uid = $request->user_id;
        $order->shop_id = auth('crm')->user()->shop->id;
        $order->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $order->consume_money = $request->amount;
        $order->discount_money = $request->amount * auth('crm')->user()->shop->discount / 10;
        $order->indiscount_money = $request->amount * auth('crm')->user()->shop->indiscount / 10;
        $order->tiyan_money = 0;
        $order->order_amount = $order->discount_money - $order->tiyan_money;
        $order->remark = $request->remark;
        $order->pay_type = $request->paytype;
        if($order->pay_type == 'cash'){
            $order->cash_amount = $request->money;
        }elseif($order->pay_type == 'wechat'){
            $order->pay_code = $request->paycode;
            $orderinfo = [
                'out_trade_no' => $order->order_sn,
                'total_fee' => $order->discount_money,              // 订单金额，**单位：分**
                'body' => '消费订单',                   // 订单描述
                'spbill_create_ip' => request()->getClientIp(),       // 调用 API 服务器的 IP
                'auth_code' => $order->pay_code,
            ];
            $order->api_info = Pay::wechat()->pos($orderinfo);
        }elseif($order->pay_type == 'alipay'){
            $order->pay_code = $request->paycode;
            $orderinfo = [
                'out_trade_no' => $order->order_sn,
                'total_amount' => $order->discount_money,       // 订单金额，**单位：元**
                'subject'      => '消费订单',
                'auth_code' => $order->pay_code,
            ];
            $order->api_info = Pay::alipay()->pos($orderinfo);
        }
        $order->pay_status = 1;
        $order->pay_at = time();
        $order->postip = request()->getClientIp();
        $order->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '结账成功', 'url' => route('crm.checkout.index')]);
        }else{
            return view('layouts.crm.message', ['status' => '1', 'info' => '结账成功', 'url' => route('crm.checkout.index')]);
        }
    }

    public function userinfo(Request $request)
    {
        $rules = array(
            'mobile' => 'required|exists:common_user,mobile',
        );
        $messages = array(
            'mobile.required' => '用户不允许为空！',
            'mobile.exists' => '用户不存在！',
        );
        $request->validate($rules, $messages);
        $userinfo = CommonUserModel::where('mobile', $request->mobile)->first();
        return view('mobile.crm.shop.checkout.userinfo', ['userinfo' => $userinfo]);
    }

    public function qrcode(Request $request)
    {
        $promotion = route('mobile.brand.shop.pay', ['id' => $this->shop->id]);
        $image = QrCode::format('png')->size(400)->generate($promotion);
        $qrcode = Image::make($image);
        return $qrcode->response('png', 90);
    }

}
