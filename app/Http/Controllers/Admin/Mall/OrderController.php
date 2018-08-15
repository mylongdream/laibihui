<?php

namespace App\Http\Controllers\Admin\Mall;

use App\Http\Controllers\Controller;
use App\Models\MallOrderModel;
use App\Models\MallOrderShippingModel;
use App\Models\CommonShippingModel;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $MallOrderModel = new MallOrderModel;
        $orders = $MallOrderModel->where(function($query) use($request) {
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
            if($request->order_sn){
                $query->where('order_sn', 'like', '%'.$request->order_sn.'%');
            }
        })->latest()->paginate(20);
        return view('admin.mall.order.index', ['orders' => $orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = MallOrderModel::findOrFail($id);
        return view('admin.mall.order.show')->with('order', $order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $order = MallOrderModel::findOrFail($id);
        $order->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            MallOrderModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }
    //发货
    public function send(Request $request, $id)
    {
        $order = MallOrderModel::findOrFail($id);
        if (!($order->order_status == 0 && $order->shipping_status == 0 && $order->pay_status == 1)){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '订单处理错误', 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => 0, 'info' => '订单处理错误', 'url' => back()->getTargetUrl()]);
            }
        }

        if($request->isMethod('POST')){
                $rules = array(
                    'shipping_id' => 'required|exists:common_shipping,id',
                    'waybill' => 'required|max:255',
                );
                $messages = array(
                    'shipping_id.required' => '物流公司不允许为空！',
                    'shipping_id.exists' => '物流公司选择错误',
                    'waybill.required' => '运单号码不允许为空！',
                    'waybill.max' => '运单号码必须小于 :max 个字符。',
                );
                $this->validate($request, $rules, $messages);

                $send = new MallOrderShippingModel;
                $send->order_id = $order->id;
                $send->shipping_id = $request->shipping_id;
                $send->waybill = $request->waybill;
                $send->remark = $request->remark;
                $send->save();

            $order->shipping_at = time();
            $order->shipping_status = 1;
            $order->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            $shippings = CommonShippingModel::get();
            return view('admin.mall.order.send', ['order' => $order, 'shippings' => $shippings]);
        }
    }
//退款
    public function refund(Request $request, $id)
    {
        $order = MallOrderModel::findOrFail($id);

        if($request->isMethod('POST')){


            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.mall.order.refund', ['order' => $order]);
        }
    }
//关闭
    public function close(Request $request, $id)
    {
        $order = MallOrderModel::findOrFail($id);

        if($request->isMethod('POST')){


            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.order.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.mall.order.close', ['order' => $order]);
        }
    }

}
