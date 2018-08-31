<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CommonUserSellcardModel;
use Illuminate\Http\Request;


class SellCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $CommonUserSellcardModel = new CommonUserSellcardModel;
        $orders = $CommonUserSellcardModel->where(function($query) use($request) {
            if($request->pay_status == 1){
                $query->where('pay_status', 0);
            }else if($request->pay_status == 2){
                $query->where('pay_status', 1);
            }
        })->where(function($query) use($request) {
            if($request->username){
                $user = CommonUserModel::where('username', $request->username)->first();
                $query->where('uid', $user->uid);
            }
        })->where(function($query) use($request) {
            if($request->order_sn){
                $query->where('order_sn', 'like', '%'.$request->order_sn.'%');
            }
        })->latest()->paginate(20);
        return view('admin.extend.sellcard.index', ['orders' => $orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = CommonUserSellcardModel::findOrFail($id);
        return view('admin.extend.sellcard.show', ['order' => $order]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $order = CommonUserSellcardModel::findOrFail($id);
        $order->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonUserSellcardModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

//退款
    public function refund(Request $request, $id)
    {
        $order = CommonUserSellcardModel::findOrFail($id);

        if($request->isMethod('POST')){


            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.extend.sellcard.refund', ['order' => $order]);
        }
    }
//关闭
    public function close(Request $request, $id)
    {
        $order = CommonUserSellcardModel::findOrFail($id);

        if($request->isMethod('POST')){


            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.sellcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.extend.sellcard.close', ['order' => $order]);
        }
    }

}
