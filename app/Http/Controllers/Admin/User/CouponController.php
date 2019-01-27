<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUserCouponModel;
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
        $coupons = CommonUserCouponModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.coupon.index', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.coupon.create');
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
            'title' => 'required|max:60',
            'message' => 'required|max:25500',
            'jumpurl' => 'nullable|url',
        );
        $messages = array(
            'title.required' => '优惠券主题不允许为空！',
            'title.max' => '优惠券主题必须小于 :max 个字符。',
            'message.required' => '优惠券内容不允许为空！',
            'message.max' => '优惠券内容必须小于 :max 个字符。',
            'jumpurl.url' => '跳转链接必须是有效的 URL。',
        );
        $this->validate($request, $rules, $messages);

        $coupon = new CommonUserCouponModel;
        $coupon->title = $request->title;
        $coupon->message = $request->message;
        $coupon->jumpurl = $request->jumpurl;
        $coupon->displayorder = intval($request->displayorder);
        $coupon->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.coupon.addsucceed'), 'url' => route('admin.user.coupon.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.coupon.addsucceed'), 'url' => route('admin.user.coupon.index')]);
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
        $coupon = CommonUserCouponModel::findOrFail($id);
        return view('admin.user.coupon.show', ['coupon' => $coupon]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = CommonUserCouponModel::findOrFail($id);
        return view('admin.user.coupon.edit', ['coupon' => $coupon]);
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
        $coupon = CommonUserCouponModel::findOrFail($id);
        $rules = array(
            'title' => 'required|max:60',
            'message' => 'required|max:25500',
            'jumpurl' => 'nullable|url',
        );
        $messages = array(
            'title.required' => '优惠券主题不允许为空！',
            'title.max' => '优惠券主题必须小于 :max 个字符。',
            'message.required' => '优惠券内容不允许为空！',
            'message.max' => '优惠券内容必须小于 :max 个字符。',
            'jumpurl.url' => '跳转链接必须是有效的 URL。',
        );
        $this->validate($request, $rules, $messages);

        $coupon->title = $request->title;
        $coupon->message = $request->message;
        $coupon->jumpurl = $request->jumpurl;
        $coupon->displayorder = intval($request->displayorder);
        $coupon->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.coupon.editsucceed'), 'url' => route('admin.user.coupon.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.coupon.editsucceed'), 'url' => route('admin.user.coupon.index')]);
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
        $coupon = CommonUserCouponModel::findOrFail($id);
        $coupon->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonUserCouponModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.coupon.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonUserCouponModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.coupon.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.coupon.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
