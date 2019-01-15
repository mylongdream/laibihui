<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonCardModel;
use App\Models\CommonCardOrderModel;
use App\Models\CommonCardOrderShippingModel;
use App\Models\CommonCardOrderVisitModel;
use App\Models\CommonShippingModel;
use Illuminate\Http\Request;


class OrderCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $CommonCardOrderModel = new CommonCardOrderModel;
        $orders = $CommonCardOrderModel->where(function($query) use($request) {
            switch ($request->status) {
                case "waitpay":
                    $query->where('order_status', 0)->where('shipping_status', 0)->where('pay_status', 0);
                    break;
                case "waitsend":
                    $query->where('order_status', 0)->where('shipping_status', 0)->where('pay_status', 1);
                    break;
                case "havesend":
                    $query->where('order_status', 0)->where('shipping_status', 1)->where('pay_status', 1);
                    break;
                case "refunding":
                    $query->where('order_status', 0)->where('pay_status', 2);
                    break;
                case "success":
                    $query->where('order_status', 2);
                    break;
                case "closed":
                    $query->where('order_status', 1);
                    break;
                default:
                    break;
            }
        })->where(function($query) use($request) {
            if($request->pay_type == 1){
                $query->where('order_type', 0);
            }else if($request->pay_type == 2){
                $query->where('order_type', 1);
            }
        })->where(function($query) use($request) {
            if($request->order_sn){
                $query->where('order_sn', 'like', '%'.$request->order_sn.'%');
            }
        })->latest()->paginate(20);
        return view('admin.extend.ordercard.index', ['orders' => $orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = CommonCardOrderModel::findOrFail($id);
        return view('admin.extend.ordercard.show')->with('order', $order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $order = CommonCardOrderModel::findOrFail($id);
        $order->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.ordercard.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.ordercard.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function batch(Request $request)
    {
        if($request->operate == 'delsubmit') {
            $rules = array(
                'ids' => 'required',
            );
            $messages = array(
                'ids.required' => '请选择要删除的记录！',
            );
            $this->validate($request, $rules, $messages);
            CommonCardOrderModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.ordercard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.ordercard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }
    //发货
    public function send(Request $request, $id)
    {
        $order = CommonCardOrderModel::findOrFail($id);
        if (!($order->order_status == 0 && $order->shipping_status == 0 && $order->pay_status == 1)){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '订单处理错误', 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => 0, 'info' => '订单处理错误', 'url' => back()->getTargetUrl()]);
            }
        }

        if($request->isMethod('POST')){
            if($order->order_type == 0){
                $rules = array(
                    'number' => 'required|exists:common_card,number',
                    'realname' => 'required|max:50',
                    'mobile' => 'required|zh_mobile',
                );
                $messages = array(
                    'number.required' => '办卡卡号不能为空',
                    'number.exists' => '办卡卡号不存在',
                    'realname.required' => '业务员姓名不允许为空！',
                    'realname.max' => '业务员姓名必须小于 :max 个字符。',
                    'mobile.required' => '手机号码不允许为空！',
                    'mobile.zh_mobile' => '手机号码填写不正确。',
                );
                $this->validate($request, $rules, $messages);

                $card = CommonCardModel::where('number', $request->number)->first();
                if ($card->user){
                    if ($request->ajax()){
                        return response()->json(['status' => 0, 'info' => '办卡卡号已被绑定', 'url' => back()->getTargetUrl()]);
                    }else{
                        return view('admin.layouts.message', ['status' => 0, 'info' => '办卡卡号已被绑定', 'url' => back()->getTargetUrl()]);
                    }
                }else{
                    if ($card->order){
                        if ($request->ajax()){
                            return response()->json(['status' => 0, 'info' => '办卡卡号已被预约', 'url' => back()->getTargetUrl()]);
                        }else{
                            return view('admin.layouts.message', ['status' => 0, 'info' => '办卡卡号已被预约', 'url' => back()->getTargetUrl()]);
                        }
                    }
                }

                $send = new CommonCardOrderVisitModel;
                $send->order_id = $order->id;
                $send->realname = $request->realname;
                $send->mobile = $request->mobile;
                $send->remark = $request->remark;
                $send->save();
            }else{
                $rules = array(
                    'number' => 'required|exists:common_card,number',
                    'shipping_id' => 'required|exists:common_shipping,id',
                    'waybill' => 'required|max:255',
                );
                $messages = array(
                    'number.required' => '办卡卡号不能为空',
                    'number.exists' => '办卡卡号不存在',
                    'shipping_id.required' => '物流公司不允许为空！',
                    'shipping_id.exists' => '物流公司选择错误',
                    'waybill.required' => '运单号码不允许为空！',
                    'waybill.max' => '运单号码必须小于 :max 个字符。',
                );
                $this->validate($request, $rules, $messages);

                $card = CommonCardModel::where('number', $request->number)->first();
                if ($card->user){
                    if ($request->ajax()){
                        return response()->json(['status' => 0, 'info' => '办卡卡号已被绑定', 'url' => back()->getTargetUrl()]);
                    }else{
                        return view('admin.layouts.message', ['status' => 0, 'info' => '办卡卡号已被绑定', 'url' => back()->getTargetUrl()]);
                    }
                }else{
                    if ($card->order){
                        if ($request->ajax()){
                            return response()->json(['status' => 0, 'info' => '办卡卡号已被预约', 'url' => back()->getTargetUrl()]);
                        }else{
                            return view('admin.layouts.message', ['status' => 0, 'info' => '办卡卡号已被预约', 'url' => back()->getTargetUrl()]);
                        }
                    }
                }

                $send = new CommonCardOrderShippingModel;
                $send->order_id = $order->id;
                $send->shipping_id = $request->shipping_id;
                $send->waybill = $request->waybill;
                $send->remark = $request->remark;
                $send->save();
            }

            $order->number = $request->number;
            $order->shipping_at = time();
            $order->shipping_status = 1;
            $order->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.extend.ordercard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.ordercard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            $shippings = CommonShippingModel::get();
            return view('admin.extend.ordercard.send', ['order' => $order, 'shippings' => $shippings]);
        }
    }
//完成付款
    public function pay(Request $request, $id)
    {
        $order = CommonCardOrderModel::findOrFail($id);

        $order->pay_at = time();
        $order->pay_status = 1;
        $order->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.ordercard.paysucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.ordercard.paysucceed'), 'url' => back()->getTargetUrl()]);
        }

    }
//退款
    public function refund(Request $request, $id)
    {
        $order = CommonCardOrderModel::findOrFail($id);

        if($request->isMethod('POST')){

            $order->pay_status = 3;
            $order->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.extend.ordercard.refundsucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.ordercard.refundsucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.extend.ordercard.refund', ['order' => $order]);
        }
    }
//关闭
    public function close(Request $request, $id)
    {
        $order = CommonCardOrderModel::findOrFail($id);

        if($request->isMethod('POST')){

            $order->order_status = 1;
            $order->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.extend.ordercard.closesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.ordercard.closesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.extend.ordercard.close', ['order' => $order]);
        }
    }

}
