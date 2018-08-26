<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\CrmCustomerModel;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = CrmCustomerModel::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.crm.customer.index', ['list' => $list]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = CrmCustomerModel::findOrFail($id);
        return view('admin.crm.customer.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = CrmCustomerModel::findOrFail($id);
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.crm.customer.edit', ['customer' => $customer, 'categorylist' => category_tree($categorylist)]);
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
        $customer = CrmCustomerModel::findOrFail($id);
        $rules = array(
            'catid' => 'required|numeric|exists:brand_category,id',
            'name' => 'required|max:50',
            'address' => 'required|max:150',
            'phone' => 'required|max:50',
            'status' => 'required|numeric|min:0|max:5',
        );
        $messages = array(
            'catid.required' => '经营类目不允许为空！',
            'catid.numeric' => '经营类目选择错误！',
            'catid.exists' => '经营类目不存在！',
            'name.required' => '商户名称不允许为空！',
            'name.max' => '商户名称必须小于 :max 个字符。',
            'address.required' => '商户地址不允许为空！',
            'address.max' => '商户地址必须小于 :max 个字符。',
            'phone.required' => '联系电话不允许为空！',
            'phone.max' => '联系电话必须小于 :max 个字符。',
            'status.required' => '跟进情况不允许为空！',
            'status.numeric' => '跟进情况选择错误！',
            'status.min' => '跟进情况选择错误！',
            'status.max' => '跟进情况选择错误！',
        );
        $this->validate($request, $rules, $messages);

        $customer->catid = $request->catid;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->status = intval($request->status);
        $customer->remark = $request->remark;
        $customer->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.customer.editsucceed'), 'url' => route('admin.crm.customer.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.customer.editsucceed'), 'url' => route('admin.crm.customer.index')]);
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
        $customer = CrmCustomerModel::findOrFail($id);
        $customer->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.customer.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.customer.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CrmCustomerModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.customer.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.customer.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
