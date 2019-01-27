<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonCouponModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coupons = CommonCouponModel::where('name', 'like', '%'.$request->name.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.extend.coupon.index', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|max:60',
            'amount' => 'required|max:25500',
            'fullamount' => 'required|max:25500',
        );
        $messages = array(
            'name.required' => '优惠券名称不允许为空！',
            'name.max' => '优惠券名称必须小于 :max 个字符。',
            'amount.required' => '优惠券金额不允许为空！',
            'amount.max' => '优惠券金额必须小于 :max 。',
            'fullamount.required' => '优惠券满额不允许为空！',
            'fullamount.max' => '优惠券满额必须小于 :max 。',
        );
        $this->validate($request, $rules, $messages);

        $coupon = new CommonCouponModel;
        $coupon->name = $request->name;
        $coupon->amount = $request->amount;
        $coupon->fullamount = $request->fullamount;
        $coupon->use_limit = intval($request->use_limit);
        $coupon->use_start = $request->use_start ? strtotime($request->use_start) : $request->use_start;
        $coupon->use_end = $request->use_end ? strtotime($request->use_end) : $request->use_end;
        $coupon->use_days = intval($request->use_days);
        $coupon->getway = $request->getway;
        $coupon->remark = $request->remark;
        $coupon->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.coupon.addsucceed'), 'url' => route('admin.extend.coupon.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.coupon.addsucceed'), 'url' => route('admin.extend.coupon.index')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = CommonCouponModel::findOrFail($id);
        return view('admin.extend.coupon.show', ['coupon' => $coupon]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = CommonCouponModel::findOrFail($id);
        return view('admin.extend.coupon.edit', ['coupon' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = CommonCouponModel::findOrFail($id);
        $rules = array(
            'name' => 'required|max:60',
            'amount' => 'required|max:25500',
            'fullamount' => 'required|max:25500',
        );
        $messages = array(
            'name.required' => '优惠券名称不允许为空！',
            'name.max' => '优惠券名称必须小于 :max 个字符。',
            'amount.required' => '优惠券金额不允许为空！',
            'amount.max' => '优惠券金额必须小于 :max 。',
            'fullamount.required' => '优惠券满额不允许为空！',
            'fullamount.max' => '优惠券满额必须小于 :max 。',
        );
        $this->validate($request, $rules, $messages);

        $coupon->name = $request->name;
        $coupon->amount = $request->amount;
        $coupon->fullamount = $request->fullamount;
        $coupon->use_limit = intval($request->use_limit);
        $coupon->use_start = $request->use_start ? strtotime($request->use_start) : $request->use_start;
        $coupon->use_end = $request->use_end ? strtotime($request->use_end) : $request->use_end;
        $coupon->use_days = intval($request->use_days);
        $coupon->getway = $request->getway;
        $coupon->remark = $request->remark;
        $coupon->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.coupon.editsucceed'), 'url' => route('admin.extend.coupon.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.coupon.editsucceed'), 'url' => route('admin.extend.coupon.index')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $coupon = CommonCouponModel::findOrFail($id);
        $coupon->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonCouponModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
