<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonCardOrderModel;
use App\Models\CommonCardModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;


class CardOrderController extends Controller
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
            $request->status = $request->status ? $request->status : 0;

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
        return view('admin.extend.cardorder.index', ['orders' => $orders]);
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
        return view('admin.extend.cardorder.show')->with('order', $order);
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
            return response()->json(['status' => '1', 'info' => trans('admin.extend.cardorder.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.cardorder.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
                return response()->json(['status' => '1', 'info' => trans('admin.extend.cardorder.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.cardorder.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
