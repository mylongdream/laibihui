<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use App\Models\CommonSubwebModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ShopAllotController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shop = BrandShopModel::findOrFail($id);
        $allots = BrandShopCardAllotModel::where('shop_id', $shop->id)->latest()->paginate(20);
        return view('admin.brand.shop.index', ['shop' => $shop, 'allots' => $allots]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = BrandShopModel::findOrFail($id);
        return view('admin.brand.shop.create', ['shop' => $shop]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = BrandShopModel::findOrFail($id);
        $rules = array(
            'quantity' => 'required|numeric|min:1',
            'price' => 'required',
        );
        $messages = array(
            'quantity.required' => '分配数量不允许为空！',
            'quantity.numeric' => '分配数量填写不正确！',
            'quantity.min' => '分配数量填写不正确！',
            'price.required' => '分配价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $allot = new BrandShopCardAllotModel;
        $allot->shop_id = $shop->id;
        $allot->quantity = intval($request->quantity);
        $allot->price = $request->price;
        $allot->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.addsucceed'), 'url' => route('admin.brand.shop.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.shop.addsucceed'), 'url' => route('admin.brand.shop.index')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = BrandShopModel::findOrFail($id);
        $allot = BrandShopCardAllotModel::findOrFail($aid);
        return view('admin.brand.shop.edit', ['shop' => $shop, 'allot' => $allot]);
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
        $shop = BrandShopModel::findOrFail($id);
        $allot = BrandShopCardAllotModel::findOrFail($aid);
        $rules = array(
            'quantity' => 'required|numeric|min:1',
            'price' => 'required',
        );
        $messages = array(
            'quantity.required' => '分配数量不允许为空！',
            'quantity.numeric' => '分配数量填写不正确！',
            'quantity.min' => '分配数量填写不正确！',
            'price.required' => '分配价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $allot->shop_id = $shop->id;
        $allot->quantity = intval($request->quantity);
        $allot->price = $request->price;
        $allot->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.editsucceed'), 'url' => route('admin.brand.shop.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.shop.editsucceed'), 'url' => route('admin.brand.shop.index')]);
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
        $shop = BrandShopModel::findOrFail($id);
        $allot = BrandShopCardAllotModel::findOrFail($aid);
        $allot->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandShopModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }


}
