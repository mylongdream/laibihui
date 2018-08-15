<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use App\Models\BrandMealCategoryModel;
use App\Models\BrandShopCardAllotModel;
use App\Models\BrandShopCardModel;
use App\Models\CommonSubwebModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class AllotController extends Controller
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
		$shop = BrandShopModel::where('id', $request->shopid)->first();
        $allots = BrandShopCardAllotModel::where(function($query) use($request) {
            $shopid = intval($request->shopid);
            if($shopid){
                $query->where('shop_id', $shopid);
            }
        })->latest()->paginate(20);
        return view('admin.brand.allot.index', ['allots' => $allots, 'shop' => $shop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoplist = BrandShopModel::where('ordercard', 1)->latest()->get();
        return view('admin.brand.allot.create', ['shoplist' => $shoplist]);
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
            'shopid' => 'required|numeric|exists:brand_shop,id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required',
        );
        $messages = array(
            'shopid.required' => '所属店铺不允许为空！',
            'shopid.numeric' => '所属店铺选择错误！',
            'shopid.exists' => '所属店铺不存在！',
            'quantity.required' => '分配数量不允许为空！',
            'quantity.numeric' => '分配数量填写不正确！',
            'quantity.min' => '分配数量填写不正确！',
            'price.required' => '分配价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $allot = new BrandShopCardAllotModel;
        $allot->shop_id = intval($request->shopid);
        $allot->quantity = intval($request->quantity);
        $allot->price = $request->price;
        $allot->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.allot.addsucceed'), 'url' => route('admin.brand.allot.index', ['shopid' => $request->shopid])]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.brand.allot.addsucceed'), 'url' => route('admin.brand.allot.index', ['shopid' => $request->shopid])]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $allot = BrandShopCardAllotModel::findOrFail($request->id);
        $shoplist = BrandShopModel::where('ordercard', 1)->latest()->get();
        return view('admin.brand.allot.show', ['allot' => $allot, 'shoplist' => $shoplist]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $allot = BrandShopCardAllotModel::findOrFail($request->id);
        $shoplist = BrandShopModel::where('ordercard', 1)->latest()->get();
        return view('admin.brand.allot.edit', ['allot' => $allot, 'shoplist' => $shoplist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $allot = BrandShopCardAllotModel::findOrFail($request->id);
        $rules = array(
            'shopid' => 'required|numeric|exists:brand_shop,id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required',
        );
        $messages = array(
            'shopid.required' => '所属店铺不允许为空！',
            'shopid.numeric' => '所属店铺选择错误！',
            'shopid.exists' => '所属店铺不存在！',
            'quantity.required' => '分配数量不允许为空！',
            'quantity.numeric' => '分配数量填写不正确！',
            'quantity.min' => '分配数量填写不正确！',
            'price.required' => '分配价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $allot->shop_id = intval($request->shopid);
        $allot->quantity = intval($request->quantity);
        $allot->price = $request->price;
        $allot->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.allot.editsucceed'), 'url' => route('admin.brand.allot.index', ['shopid' => $request->shopid])]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.brand.allot.editsucceed'), 'url' => route('admin.brand.allot.index', ['shopid' => $request->shopid])]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $allot = BrandShopCardAllotModel::findOrFail($request->id);
        $allot->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.allot.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.brand.allot.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandShopCardAllotModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.brand.allot.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.brand.allot.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function cardlist(Request $request)
    {
        $shop = BrandShopModel::where('id', $request->shopid)->first();
        $cardlist = BrandShopCardModel::where('allot_id', $request->id)->latest()->paginate(20);
        return view('admin.brand.allot.cardlist', ['cardlist' => $cardlist, 'shop' => $shop]);
    }

}
