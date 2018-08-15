<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUserAddressModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $addresslist = CommonUserAddressModel::latest()->paginate(12);
        return view('admin.user.address.index', ['addresslist' => $addresslist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.address.create');
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
            'province' => 'required|numeric|exists:common_district,id',
            'city' => 'required|numeric|exists:common_district,id',
            'area' => 'required|numeric|exists:common_district,id',
            'street' => 'nullable|numeric|exists:common_district,id',
            'realname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        );
        $messages = array(
            'username.required' => '用户名不允许为空！',
            'username.exists' => '用户名不存在！',
            'province.required' => '所在省份不允许为空！',
            'province.numeric' => '所在省份选择错误！',
            'province.exists' => '所在省份不存在！',
            'city.required' => '所在城市不允许为空！',
            'city.numeric' => '所在城市选择错误！',
            'city.exists' => '所在城市不存在！',
            'area.required' => '所在地区不允许为空！',
            'area.numeric' => '所在地区选择错误！',
            'area.exists' => '所在地区不存在！',
            'street.numeric' => '所在街道选择错误！',
            'street.exists' => '所在街道不存在！',
            'realname.required' => '收货人不允许为空！',
            'mobile.required' => '手机号码不允许为空！',
            'address.required' => '详细地址不允许为空！',
        );
        $request->validate($rules, $messages);

        $user = CommonUserModel::where('username', $request->username)->first();

        $address = new CommonUserAddressModel;
        $address->uid = $user->uid;
        $address->province = intval($request->province);
        $address->city = intval($request->city);
        $address->area = intval($request->area);
        $address->street = intval($request->street);
        $address->address = $request->address;
        $address->realname = $request->realname;
        $address->mobile = $request->mobile;
        $address->zipcode = $request->zipcode;
        $address->save();

        if ($request->default){
            $user->address_id = $address->id;
            $user->save();
        }

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.address.addsucceed'), 'url' => route('admin.user.address.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.address.addsucceed'), 'url' => route('admin.user.address.index')]);
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
        $address = CommonUserAddressModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = CommonUserAddressModel::findOrFail($id);
        return view('admin.user.address.edit', ['address' => $address]);
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
        $address = CommonUserAddressModel::findOrFail($id);
        $rules = array(
            'province' => 'required|numeric|exists:common_district,id',
            'city' => 'required|numeric|exists:common_district,id',
            'area' => 'required|numeric|exists:common_district,id',
            'street' => 'nullable|numeric|exists:common_district,id',
            'realname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        );
        $messages = array(
            'province.required' => '所在省份不允许为空！',
            'province.numeric' => '所在省份选择错误！',
            'province.exists' => '所在省份不存在！',
            'city.required' => '所在城市不允许为空！',
            'city.numeric' => '所在城市选择错误！',
            'city.exists' => '所在城市不存在！',
            'area.required' => '所在地区不允许为空！',
            'area.numeric' => '所在地区选择错误！',
            'area.exists' => '所在地区不存在！',
            'street.numeric' => '所在街道选择错误！',
            'street.exists' => '所在街道不存在！',
            'realname.required' => '收货人不允许为空！',
            'mobile.required' => '手机号码不允许为空！',
            'address.required' => '详细地址不允许为空！',
        );
        $request->validate($rules, $messages);

        $address->province = intval($request->province);
        $address->city = intval($request->city);
        $address->area = intval($request->area);
        $address->street = intval($request->street);
        $address->address = $request->address;
        $address->realname = $request->realname;
        $address->mobile = $request->mobile;
        $address->zipcode = $request->zipcode;
        $address->save();

        if ($request->default){
            $address->user->address_id = $address->id;
            $address->user->save();
        }
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.address.editsucceed'), 'url' => route('admin.user.address.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.address.editsucceed'), 'url' => route('admin.user.address.index')]);
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
        $address = CommonUserAddressModel::findOrFail($id);
        $address->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.address.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.address.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonUserAddressModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.address.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.address.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
