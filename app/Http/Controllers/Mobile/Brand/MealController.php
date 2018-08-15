<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandMealCartModel;
use App\Models\BrandMealOrderModel;
use App\Models\BrandMealRecordModel;
use App\Models\BrandShopModel;
use App\Models\BrandMealModel;
use Illuminate\Http\Request;
use Yansongda\LaravelPay\Facades\Pay;


class MealController extends Controller
{
    public function __construct(Request $request)
    {
        $this->shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        view()->share('shop', $this->shop);
    }

    public function index(Request $request){
        if(!$this->shop->ordermeal){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '本店未开通在线点餐', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '本店未开通在线点餐', 'url' => back()->getTargetUrl()]);
            }
        }
        $meallist = BrandMealModel::where('shop_id', $this->shop->id)->where('onsale', 1)->latest()->get();
        $total = $this->totalcart();
        return view('mobile.brand.meal.index', ['meallist'=>$meallist, 'total'=>$total]);
    }

    public function show(Request $request){
        $meal = BrandMealModel::where('shop_id', $this->shop->id)->where('id', $request->meal_id)->first();
        if(!$meal){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '菜品不存在', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '菜品不存在', 'url' => back()->getTargetUrl()]);
            }
        }
        if(!$meal->onsale){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '菜品已下架', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '菜品已下架', 'url' => back()->getTargetUrl()]);
            }
        }
        return view('mobile.brand.meal.show', ['meal'=>$meal]);
    }

    public function order(Request $request){
        if(!$this->shop->ordermeal){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '本店未开通在线点餐', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '本店未开通在线点餐', 'url' => back()->getTargetUrl()]);
            }
        }
        $totalPrice = $totalMoney = 0;
        $cartlist = BrandMealCartModel::where('shop_id', $this->shop->id)->where('uid', auth()->user()->uid)->latest()->get();
        foreach($cartlist as $key => $value) {
            if($value->meal && $value->meal->onsale) {
                $totalPrice += $value->meal->price * $value->number;
            }else{
                $value->delete();
                unset($cartlist[$key]);
            }
        }
        if(auth()->user()->card){
            $totalMoney = $totalPrice * $this->shop->discount / 10;
        }else{
            $totalMoney = $totalPrice;
        }
        if($cartlist->isEmpty()){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '你还尚未点餐', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '你还尚未点餐', 'url' => back()->getTargetUrl()]);
            }
        }
        if($request->isMethod('POST')){

            $order = new BrandMealOrderModel;
            $order->shop_id = $this->shop->id;
            $order->uid = auth()->user()->uid;
            $order->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $order->consume_money = $totalPrice;
            $order->discount_money = $totalMoney;
            $order->indiscount_money = auth()->user()->card ? $totalPrice * $this->shop->indiscount / 10 : $totalPrice;
            $order->order_amount = $totalMoney;
            $order->remark = $request->remark;
            $order->bindcard = auth()->user()->card ? 1 : 0;
            $order->postip = request()->getClientIp();
            $order->save();

            foreach($cartlist as $value) {
                $record = new BrandMealRecordModel;
                $record->order_id = $order->id;
                $record->meal_id = $value->meal_id;
                $record->name = $value->meal->name;
                $record->price = $value->meal->price;
                $record->upimage = $value->meal->upimage;
                $record->message = $value->meal->message;
                $record->number = $value->number;
                $record->save();
                $value->delete();
            }

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '点餐下单成功', 'url' => route('mobile.brand.shop.meal.pay', ['id' => $this->shop->id, 'orderid' => $order->order_sn])]);
            }else{
                return view('layouts.mobile.message', ['status' => 1, 'info' => '点餐下单成功', 'url' => route('mobile.brand.shop.meal.pay', ['id' => $this->shop->id, 'orderid' => $order->order_sn])]);
            }
        }else {
            return view('mobile.brand.meal.order', ['cartlist'=>$cartlist, 'totalMoney' => $totalMoney]);
        }
    }

    public function pay(Request $request){
        $setting = cache('setting');
        $order = BrandMealOrderModel::where('uid', auth()->user()->uid)->where('order_sn', $request->orderid)->firstOrFail();
        if ($request->isMethod('POST')) {
            if ($request->paytype == 1){ //支付宝支付
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_amount' => '20',
                    'subject'      => '在线点餐',
                ];
                return Pay::alipay()->wap($order);
            }
            if ($request->paytype == 2){ //微信支付
                $order = [
                    'out_trade_no' => $order->order_sn,
                    'total_fee' => '2000',              // 订单金额，**单位：分**
                    'body' => '在线点餐',                   // 订单描述
                    'spbill_create_ip' => request()->getClientIp(),       // 调用 API 服务器的 IP
                    'product_id' => '0',
                ];
                return Pay::wechat()->wap($order);
            }

            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => '点餐下单成功', 'url' => route('user.card.appoint')]);
            } else {
                return view('layouts.common.message', ['status' => 1, 'info' => '点餐下单成功', 'url' => route('user.card.appoint')]);
            }
        } else {
            return view('mobile.brand.meal.pay', ['order' => $order]);
        }
    }

    public function addcart(Request $request){
        $rules = array(
            'meal_id' => 'required|exists:brand_meal,id',
            'num' => 'required|numeric|min:1',
        );
        $messages = array(
            'meal_id.required' => '选择菜品不能为空',
            'meal_id.exists' => '选择菜品不存在',
            'num.required' => '选择数量不能为空',
            'num.numeric' => '选择数量不正确',
            'num.min' => '选择数量最少1份',
        );
        $this->validate($request, $rules, $messages);

        $meal = BrandMealModel::where('shop_id', $this->shop->id)->where('id', $request->meal_id)->first();
        if(!$meal->onsale){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '菜品已下架', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '菜品已下架', 'url' => back()->getTargetUrl()]);
            }
        }

        $cart = BrandMealCartModel::where('uid', auth()->user()->uid)->where('meal_id', $request->meal_id)->first();
        if ($cart){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '', 'url' => back()->getTargetUrl()]);
            }
        }else{
            $cart = new BrandMealCartModel;
            $cart->uid = auth()->user()->uid;
            $cart->shop_id = $this->shop->id;
            $cart->meal_id = $request->meal_id;
            $cart->number = intval($request->num);
            $cart->save();
            $total = $this->totalcart();
            if ($request->ajax()){
                return response()->json(['status' => '1', 'total'=>$total]);
            }else{
                return view('layouts.mobile.message', ['status' => '1', 'total'=>$total]);
            }
        }
    }

    public function updatecart(Request $request){
        $rules = array(
            'meal_id' => 'required|exists:brand_meal,id',
            'num' => 'required|numeric|min:1',
        );
        $messages = array(
            'meal_id.required' => '选择菜品不能为空',
            'meal_id.exists' => '选择菜品不存在',
            'num.required' => '选择数量不能为空',
            'num.numeric' => '选择数量不正确',
            'num.min' => '选择数量最少1份',
        );
        $this->validate($request, $rules, $messages);

        $meal = BrandMealModel::where('shop_id', $this->shop->id)->where('id', $request->meal_id)->first();
        if(!$meal->onsale){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '菜品已下架', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '菜品已下架', 'url' => back()->getTargetUrl()]);
            }
        }

        $cart = BrandMealCartModel::where('uid', auth()->user()->uid)->where('meal_id', $request->meal_id)->first();
        if ($cart){
            $cart->number = intval($request->num);
            $cart->save();
            $total = $this->totalcart();
            if ($request->ajax()){
                return response()->json(['status' => '1', 'total'=>$total]);
            }else{
                return view('layouts.mobile.message', ['status' => '1', 'total'=>$total]);
            }
        }else{
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '菜品未选择', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '菜品未选择', 'url' => back()->getTargetUrl()]);
            }
        }
    }

    public function delcart(Request $request){
        $rules = array(
            'meal_id' => 'required|exists:brand_meal,id',
        );
        $messages = array(
            'meal_id.required' => '选择菜品不能为空',
            'meal_id.exists' => '选择菜品不存在',
        );
        $this->validate($request, $rules, $messages);

        $cart = BrandMealCartModel::where('uid', auth()->user()->uid)->where('meal_id', $request->meal_id)->first();
        $cart->delete();
        $total = $this->totalcart();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'total'=>$total]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'total'=>$total]);
        }
    }

    protected function totalcart(){
        $totalPrice = $totalMoney = 0;
        if(auth()->check()){
            $cartlist = BrandMealCartModel::where('shop_id', $this->shop->id)->where('uid', auth()->user()->uid)->latest()->get();
            foreach($cartlist as $key => $value) {
                if($value->meal && $value->meal->onsale) {
                    $totalPrice += $value->meal->price * $value->number;
                }else{
                    $value->delete();
                    unset($cartlist[$key]);
                }
            }
            if(auth()->user()->card){
                $totalMoney = $totalPrice * $this->shop->discount / 10;
            }else{
                $totalMoney = $totalPrice;
            }
        }
        return ['price' => number_format($totalPrice,2), 'money' => number_format($totalMoney,2)];
    }

}
