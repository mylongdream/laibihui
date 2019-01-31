<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\CommonAppointModel;
use App\Models\CommonCardModel;
use App\Models\CommonCardOrderAddressModel;
use App\Models\CommonCardOrderModel;
use App\Models\CommonUserAddressModel;
use App\Models\CommonUserCardModel;
use App\Models\CommonUserModel;
use App\Models\CommonUserScoreModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;
use Yansongda\LaravelPay\Facades\Pay;

class CardController extends Controller
{
    protected $district = [175];//支持上门办卡的地区

    public function index(Request $request){
        return view('mobile.brand.card.index');
    }

    public function order(Request $request){
        $order = CommonCardOrderModel::where('uid', auth()->user()->uid)->where('order_status', '<>', '1')->first();
        if ($order) {
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'info' => '您已预约办卡', 'url' => route('mobile.user.ordercard.index')]);
            } else {
                return view('layouts.mobile.message', ['status' => 0, 'info' => '您已预约办卡', 'url' => route('mobile.user.ordercard.index')]);
            }
        }
        if ($request->isMethod('POST')) {
            $rules = array(
                'addressid' => 'required|numeric|exists:common_user_address,id,uid,'.auth()->user()->uid,
                'ordertype' => 'required|numeric|min:0|max:1',
            );
            $messages = array(
                'addressid.required' => '收货地址不允许为空！',
                'addressid.numeric' => '收货地址填写错误！',
                'addressid.exists' => '收货地址不存在！',
                'ordertype.required' => '办卡方式不允许为空！',
                'ordertype.numeric' => '办卡方式选择错误！',
                'ordertype.min' => '办卡方式选择错误！',
                'ordertype.max' => '办卡方式选择错误！',
            );
            $this->validate($request, $rules, $messages);

            $address = CommonUserAddressModel::where('uid', auth()->user()->uid)->findOrFail($request->addressid);
            if(in_array($address->province,$this->district) || in_array($address->city,$this->district) || in_array($address->area,$this->district) || in_array($address->street,$this->district)){
                $forbid = 0;
            }else{
                $forbid = 1;
            }
            if($forbid && $request->ordertype == 0){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '所在地区不支持上门办卡']);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => '所在地区不支持上门办卡']);
                }
            }

            $order = new CommonCardOrderModel();
            $order->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $order->order_type = intval($request->ordertype);
            $order->goods_amount = 10;
            $order->shipping_fee = $order->order_type == 1 ? 10 : 0;
            $order->order_amount = $order->goods_amount + $order->shipping_fee;
            $order->remark = $request->remark;
            $order->postip = request()->getClientIp();
            $order->uid = auth()->user()->uid;
            $order->save();

            $order_address = new CommonCardOrderAddressModel;
            $order_address->order_id = $order->id;
            $order_address->province = $address->province;
            $order_address->city = $address->city;
            $order_address->area = $address->area;
            $order_address->street = $address->street;
            $order_address->address = $address->address;
            $order_address->realname = $address->realname;
            $order_address->mobile = $address->mobile;
            $order_address->zipcode = $address->zipcode;
            $order_address->save();

            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => '', 'url' => route('mobile.brand.card.pay', ['id' => $order->order_sn])]);
            } else {
                return view('layouts.mobile.message', ['status' => 1, 'info' => '', 'url' => route('mobile.brand.card.pay', ['id' => $order->order_sn])]);
            }
        } else {
            $addresses = auth()->user()->addresses;
            if($addresses){
                $address = $addresses->where('id', auth()->user()->address_id)->first();
                if(!$address){
                    $address = $addresses->first();
                }
            }else{
                $address = collect();
            }
            return view('mobile.brand.card.order', ['address' => $address]);
        }
    }

    public function pay(Request $request, $id){
        $setting = cache('setting');
        $order = CommonCardOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        if ($request->isMethod('POST')) {
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

            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => '预约办卡成功', 'url' => route('user.card.appoint')]);
            } else {
                return view('layouts.mobile.message', ['status' => 1, 'info' => '预约办卡成功', 'url' => route('user.card.appoint')]);
            }
        } else {
            return view('mobile.brand.card.pay', ['order' => $order]);
        }
    }

    public function appoint(Request $request){
        $setting = cache('setting');
        if($request->isMethod('POST')){
            if (!auth()->check()) {
                return response()->json(['status' => '0', 'info' => '请登录后再办卡']);
            }

            $rules = array(
                'realname' => 'required|max:10',
                'gender' => 'required|numeric',
                'address' => 'required|max:150',
                'qq' => 'max:20',
                'remark' => 'max:250',
            );
            $messages = array(
                'realname.required' => '您的姓名不允许为空！',
                'realname.max' => '您的姓名必须小于 :max 个字符。',
                'gender.required' => '您的性别不允许为空！',
                'gender.numeric' => '您的性别选择错误！',
                'address.required' => '您的地址不允许为空！',
                'address.max' => '您的地址必须小于 :max 个字符。',
                'qq.max' => '您的地址必须小于 :max 个字符。',
                'remark.max' => '您的地址必须小于 :max 个字符。',
            );
            $this->validate($request, $rules, $messages);

            //推广办卡
            $fromuid = !empty($request->cookie('promotion')) ? intval($request->cookie('promotion')) : 0;
            if ($fromuid){
                $fromuser = CommonUserModel::where('uid', $fromuid)->first();
                if (!$fromuser) {
                    $fromuid = 0;
                }
            }else{
                $fromuid = 0;
            }

            if(auth()->user()->card){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '您已开卡，无需再办卡']);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => '您已开卡，无需再办卡']);
                }
            }

            $appoint = new CommonAppointModel();
            $appoint->realname = $request->realname;
            $appoint->gender = intval($request->gender);
            $appoint->mobile = auth()->user()->mobile;
            $appoint->address = $request->address;
            $appoint->qq = $request->qq;
            $appoint->fromuid = $fromuid == auth()->user()->uid ? 0 : $fromuid;
            $appoint->remark = $request->remark;
            $appoint->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $appoint->pay_type = intval($request->pay_type);
            $appoint->postip = request()->getClientIp();
            $appoint->uid = auth()->user()->uid;
            $appoint->save();

            if (isset($setting['buycard_mobile']) && $setting['buycard_mobile']){
                $content = '网站有客户预约办卡，请尽快联系';
                Sms::make()->to([86, $setting['buycard_mobile']])->content($content)->send();
            }

            if ($appoint->pay_type == 1){ //支付宝支付
                $order = [
                    'out_trade_no' => $appoint->order_sn,
                    'total_amount' => '20',
                    'subject'      => '知惠网卡密购买',
                ];
                return Pay::driver('alipay')->gateway('web')->pay($order);
            }
            if ($appoint->pay_type == 2){ //微信支付
                $order = [
                    'out_trade_no' => $appoint->order_sn,
                    'total_fee' => '2000',              // 订单金额，**单位：分**
                    'body' => '知惠网卡密购买',                   // 订单描述
                    'spbill_create_ip' => request()->getClientIp(),       // 调用 API 服务器的 IP
                    'product_id' => '0',
                ];
                return Pay::driver('wechat')->gateway('scan')->pay($order);
            }

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '预约办卡成功', 'url' => route('mobile.user.card.appoint')]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => '预约办卡成功', 'url' => route('mobile.user.card.appoint')]);
            }
        }else{
            return view('mobile.brand.card.appoint');
        }
    }

    public function active(Request $request){
        if(auth()->check()){
            return redirect(route('mobile.user.bindcard.index'));
        }
        if($request->isMethod('POST')){
            $rules = array(
                'mobile' => 'bail|required|zh_mobile|unique:common_user|confirm_mobile_not_change',
                'smscode' => 'required|verify_code',
                'number' => 'required|exists:common_card',
                'password' => 'required',
            );
            $messages = array(
                'number.required' => '卡号不允许为空！',
                'number.password_check' => '卡号不存在！',
                'password.required' => '密码不允许为空！',
            );
            $this->validate($request, $rules, $messages);

            $card = CommonCardModel::where('number', $request->number)->where('password', $request->password)->first();
            if(!$card){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('user.card.passwordwrong')]);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, trans('user.card.passwordwrong')]);
                }
            }
            //卡号已被绑定
            if($card->user){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('user.bindcard.bound')]);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.bindcard.bound')]);
                }
            }
            //未下单过或下单过未付款的不能绑定
            if((!$card->order || $card->order->pay_status != 1) && (!$card->sellcard || $card->sellcard->pay_status != 1)){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '卡号尚未付款无法绑定']);
                }else{
                    return view('layouts.mobile.message', ['status' => 0, 'info' => '卡号尚未付款无法绑定']);
                }
            }

            event(new Registered($user = CommonUserModel::create([
                'username' => $request->mobile,
                'password' => bcrypt($request->password),
                'mobile' => $request->mobile,
                'frozen_money' => 100,
                'regip' => request()->getClientIp(),
            ])));
            auth()->guard()->login($user);

            //记录绑卡信息
            $usercard = new CommonUserCardModel();
            $usercard->bindcard(auth()->user(), $card);

            $setting = cache('setting');
            //推广注册
            $fromuid = !empty($request->cookie('promotion')) ? intval($request->cookie('promotion')) : 0;
            if ($fromuid && $fromuid != $user->uid){
                $fromuser = CommonUserModel::where('uid', $fromuid)->first();
                if ($fromuser) {
                    $user->fromuid = $fromuser->uid;
                    $user->fromupuid = $fromuser->fromuid;
                    $user->save();
                    if(isset($setting['promotion_register']) && $setting['promotion_register']){
                        $score = new CommonUserScoreModel();
                        $score->uid = $fromuser->uid;
                        $score->score = $setting['promotion_register'];
                        $score->remark = '推广注册得积分';
                        $score->postip = $request->getClientIp();
                        $score->save();
                        $fromuser->increment('score', $setting['promotion_register']);
                    }
                }
            }

            $content = '恭喜您开卡成功，您的卡号是：'.$card->number;
            Sms::make()->to([86, auth()->user()->mobile])->content($content)->send();

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '在线开卡成功', 'url' => route('mobile.user.index')]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => '在线开卡成功', 'url' => route('mobile.user.index')]);
            }
        }else{
            return view('mobile.brand.card.active');
        }
    }

}
