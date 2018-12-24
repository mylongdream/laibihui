<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserAddressModel;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $address_maxnum = 10;//最多允许添加收货地址数量

    public function __construct()
    {
        view()->share(['curmenu' => 'address', 'address_maxnum' => $this->address_maxnum]);
    }

    public function index(Request $request)
    {
        $addresses = CommonUserAddressModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(10);
        return view('mobile.user.address.index', ['addresses' => $addresses]);
    }

    public function create(Request $request)
    {
        if (auth()->user()->addresses->count() >= $this->address_maxnum){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => trans('user.address.limited'), 'url' => route('mobile.user.address.index')]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.address.limited'), 'url' => route('mobile.user.address.index')]);
            }
        }
        return view('mobile.user.address.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->addresses->count() >= $this->address_maxnum){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => trans('user.address.limited'), 'url' => route('mobile.user.address.index')]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.address.limited'), 'url' => route('mobile.user.address.index')]);
            }
        }
        $rules = array(
            'province' => 'required|numeric|exists:common_district,id',
            'city' => 'required|numeric|exists:common_district,id',
            'area' => 'required|numeric|exists:common_district,id',
            'street' => 'nullable|numeric|exists:common_district,id',
            'realname' => 'required|min:2|max:10',
            'mobile' => 'required',
            'address' => 'required|min:5|max:32',
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
            'realname.required' => '收货人姓名不允许为空！',
            'realname.min' => '收货人姓名必须大于 :min 个字符。',
            'realname.max' => '收货人姓名必须小于 :max 个字符。',
            'mobile.required' => '手机号码不允许为空！',
            'address.required' => '详细地址不允许为空！',
            'address.min' => '详细地址必须大于 :min 个字符。',
            'address.max' => '详细地址必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $address = new CommonUserAddressModel;
        $address->uid = auth()->user()->uid;
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
            auth()->user()->address_id = $address->id;
            auth()->user()->save();
        }

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.address.addsucceed'), 'url' => route('mobile.user.address.index'), 'geturl' => route('mobile.user.address.getitem', ['id' => $address->id])]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.address.addsucceed'), 'url' => route('mobile.user.address.index')]);
        }
    }

    public function edit($id)
    {
        $address = CommonUserAddressModel::where('uid', auth()->user()->uid)->findOrFail($id);
        return view('mobile.user.address.edit', ['address' => $address]);
    }

    public function update(Request $request, $id)
    {
        $address = CommonUserAddressModel::where('uid', auth()->user()->uid)->findOrFail($id);
        $rules = array(
            'province' => 'required|numeric|exists:common_district,id',
            'city' => 'required|numeric|exists:common_district,id',
            'area' => 'required|numeric|exists:common_district,id',
            'street' => 'nullable|numeric|exists:common_district,id',
            'realname' => 'required|min:2|max:10',
            'mobile' => 'required',
            'address' => 'required|min:5|max:32',
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
            'realname.required' => '收货人姓名不允许为空！',
            'realname.min' => '收货人姓名必须大于 :min 个字符。',
            'realname.max' => '收货人姓名必须小于 :max 个字符。',
            'mobile.required' => '手机号码不允许为空！',
            'address.required' => '详细地址不允许为空！',
            'address.min' => '详细地址必须大于 :min 个字符。',
            'address.max' => '详细地址必须小于 :max 个字符。',
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
            auth()->user()->address_id = $address->id;
            auth()->user()->save();
        }

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.address.editsucceed'), 'url' => route('mobile.user.address.index'), 'geturl' => route('mobile.user.address.getitem', ['id' => $address->id])]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.address.editsucceed'), 'url' => route('mobile.user.address.index')]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $address = CommonUserAddressModel::where('uid', auth()->user()->uid)->findOrFail($id);
        $address->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.address.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.address.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function getlist(Request $request)
    {
        $addresses = CommonUserAddressModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->get();
        return view('mobile.user.address.getlist', ['addresses' => $addresses]);
    }

    public function getitem($id)
    {
        $address = CommonUserAddressModel::where('uid', auth()->user()->uid)->findOrFail($id);
        return view('mobile.user.address.getitem', ['address' => $address]);
    }

    public function getadd(Request $request)
    {
        if (auth()->user()->addresses->count() >= $this->address_maxnum){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => trans('user.address.limited'), 'url' => route('mobile.user.address.index')]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => trans('user.address.limited'), 'url' => route('mobile.user.address.index')]);
            }
        }
        return view('mobile.user.address.getadd');
    }

    public function getedit($id)
    {
        $address = CommonUserAddressModel::where('uid', auth()->user()->uid)->findOrFail($id);
        return view('mobile.user.address.getedit', ['address' => $address]);
    }

}
