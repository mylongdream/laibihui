<?php

namespace App\Http\Controllers\Crm\Shop;

use App\Http\Controllers\Controller;

use App\Models\BrandMealModel;
use App\Models\BrandMealOrderModel;
use App\Models\BrandMealRecordModel;
use App\Models\BrandShopModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderMealController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'ordermeal');
    }

    public function index(Request $request)
    {
        $orders = BrandMealOrderModel::where('shop_id', auth('crm')->user()->shop->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('crm.shop.ordermeal.index', ['orders' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = BrandMealOrderModel::where('shop_id', auth('crm')->user()->shop->id)->where('order_sn', $id)->firstOrFail();
        return view('crm.shop.ordermeal.show', ['order' => $order]);
    }

    public function create(Request $request)
    {
        $meallist = BrandMealModel::where('shop_id', auth('crm')->user()->shop->id)->where('onsale', 1)->latest()->get();
        return view('crm.shop.ordermeal.create', ['meallist'=>$meallist]);
    }

    public function store(Request $request)
    {
        $rules = array(
            'ids' => 'required',
            'account' => 'required|exists:common_user,mobile',
        );
        $messages = array(
            'ids.required' => '点餐菜品不允许为空！',
            'account.required' => '用户账户不允许为空！',
            'account.exists' => '用户账户不存在！',
        );
        $this->validate($request, $rules, $messages);

        $user = CommonUserModel::where('mobile', $request->account)->first();
        $meallist = collect();
        $totalPrice = $totalMoney = 0;
        foreach($request->ids as $key => $value) {
            $meal = BrandMealModel::where('shop_id', auth('crm')->user()->shop->id)->find($value);
            if($meal && $meal->onsale) {
                $meal->number = intval($request->amount[$value]);
                $meallist[] = $meal;
                $totalPrice += $meal->price * $meal->number;
            }
        }
        if($user->card){
            $totalMoney = $totalPrice * auth('crm')->user()->shop->discount / 10;
        }else{
            $totalMoney = $totalPrice;
        }
        $order = new BrandMealOrderModel;
        $order->shop_id = auth('crm')->user()->shop->id;
        $order->uid = $user->uid;
        $order->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $order->consume_money = $totalPrice;
        $order->discount_money = $totalMoney;
        $order->indiscount_money = $user->card ? $totalPrice * auth('crm')->user()->shop->indiscount / 10 : $totalPrice;
        $order->order_amount = $totalMoney;
        $order->remark = $request->remark;
        $order->bindcard = $user->card ? 1 : 0;
        $order->postip = request()->getClientIp();
        $order->save();

        foreach($meallist as $value) {
            $record = new BrandMealRecordModel;
            $record->order_id = $order->id;
            $record->meal_id = $value->id;
            $record->name = $value->name;
            $record->price = $value->price;
            $record->upimage = $value->upimage;
            $record->message = $value->message;
            $record->number = $value->number;
            $record->save();
        }

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '点餐成功', 'url' => route('crm.ordermeal.create')]);
        }else{
            return view('layouts.crm.message', ['status' => '1', 'info' => '点餐成功', 'url' => route('crm.ordermeal.create')]);
        }
    }

    public function edit(Request $request, $id)
    {
        $order = BrandMealOrderModel::where('shop_id', auth('crm')->user()->shop->id)->where('order_sn', $id)->firstOrFail();
        return view('crm.shop.ordermeal.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = BrandMealOrderModel::where('shop_id', auth('crm')->user()->shop->id)->where('order_sn', $id)->firstOrFail();
        $rules = array(
            'status' => [
                'required',
                'numeric',
                Rule::in(['1', '2']),
            ],
        );
        $messages = array(
            'status.required' => '处理状态必须选择！',
            'status.numeric' => '处理状态选择错误！',
            'status.in' => '处理状态选择错误！',
        );
        $this->validate($request, $rules, $messages);

        $order->status = intval($request->status);
        $order->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '点餐订单处理成功', 'url' => route('crm.ordermeal.index')]);
        }else{
            return view('layouts.crm.message', ['status' => 1, 'info' => '点餐订单处理成功', 'url' => route('crm.ordermeal.index')]);
        }
    }

}
