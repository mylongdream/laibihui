<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonAppointModel;
use App\Models\CommonCardModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;


class AppointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $CommonAppointModel = new CommonAppointModel;
        $appoints = $CommonAppointModel->where(function($query) use($request) {
            $request->status = $request->status ? $request->status : 0;
            if($request->status > 0){
                $query->where('status', $request->status);
            }else if($request->status == 0){
                $query->where('status', 0);
            }
        })->where(function($query) use($request) {
            if($request->pay_type == 1){
                $query->where('pay_type', 0);
            }else if($request->pay_type == 2){
                $query->where('pay_type', '>', 0);
            }
        })->where(function($query) use($request) {
            if($request->realname){
                $query->where('realname', 'like', '%'.$request->realname.'%');
            }
        })->latest()->paginate(20);
        return view('admin.extend.appoint.index', ['appoints' => $appoints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extend.appoint.create');
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
            'username' => 'required|exists:common_user',
            'realname' => 'required|max:10',
            'gender' => 'required|numeric',
            'mobile' => 'required|zh_mobile|confirm_mobile_not_change',
            'smscode' => 'required|verify_code',
            'address' => 'required|max:150',
            'qq' => 'max:20',
            'remark' => 'max:250',
        );
        $messages = array(
            'username.required' => '用户名不允许为空！',
            'username.exists' => '用户名不存在！',
            'realname.required' => '用户姓名不允许为空！',
            'realname.max' => '用户姓名必须小于 :max 个字符。',
            'gender.required' => '用户性别不允许为空！',
            'gender.numeric' => '用户性别选择错误！',
            'address.required' => '用户地址不允许为空！',
            'address.max' => '用户地址必须小于 :max 个字符。',
            'qq.max' => '用户地址必须小于 :max 个字符。',
            'remark.max' => '用户地址必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $user = CommonUserModel::where('username', $request->username)->first();

        $appoint = new CommonAppointModel();
        $appoint->realname = $request->realname;
        $appoint->gender = intval($request->gender);
        $appoint->mobile = auth()->user()->mobile;
        $appoint->address = $request->address;
        $appoint->qq = $request->qq;
        $appoint->fromuid = 0;
        $appoint->remark = $request->remark;
        $appoint->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $appoint->pay_type = intval($request->pay_type);
        $appoint->postip = request()->getClientIp();
        $appoint->uid = $user->uid;
        $appoint->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.appoint.addsucceed'), 'url' => route('admin.extend.appoint.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.appoint.addsucceed'), 'url' => route('admin.extend.appoint.index')]);
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
        $appoint = CommonAppointModel::findOrFail($id);
        return view('admin.extend.appoint.show')->with('appoint', $appoint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appoint = CommonAppointModel::findOrFail($id);
        return view('admin.extend.appoint.edit')->with('appoint', $appoint);
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
        $appoint = CommonAppointModel::findOrFail($id);
        $rules = array(
            'status' => 'required|numeric',
            'number' => 'required_if:status,1',
        );
        $messages = array(
            'status.required' => '预约状态不允许为空！',
            'status.numeric' => '预约状态选择错误',
            'number.required_if' => '办卡卡号不能为空',
            'number.exists' => '办卡卡号不存在',
        );
        $this->validate($request, $rules, $messages);

        $appoint->status = $request->status;
        if($appoint->status == 0) {
            $appoint->number = '';
            $appoint->result = '';
        }else if($appoint->status == 1){
            $card = CommonCardModel::where('number', $request->number)->first();
            if(!$card){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('admin.extend.card.notexists')]);
                }else{
                    return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.extend.card.notexists')]);
                }
            }
            if($card->user){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('admin.extend.card.hasbind')]);
                }else{
                    return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.extend.card.hasbind')]);
                }
            }
            if($appoint->number != $request->number && $card->appoint){
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => trans('admin.extend.card.hasappoint')]);
                }else{
                    return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.extend.card.hasappoint')]);
                }
            }
            $appoint->number = $request->number;
        }else if($appoint->status == 2){
            $appoint->number = '';
            $appoint->result = $request->result;
        }
        $appoint->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.appoint.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.extend.appoint.editsucceed'), 'url' => back()->getTargetUrl()]);
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
        $appoint = CommonAppointModel::findOrFail($id);
        $appoint->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonAppointModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.appoint.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
