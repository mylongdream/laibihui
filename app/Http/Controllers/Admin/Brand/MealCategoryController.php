<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use App\Models\BrandMealCategoryModel;
use App\Models\BrandMealModel;
use App\Models\CommonSubwebModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class MealCategoryController extends Controller
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
        $shoplist = BrandShopModel::where('ordermeal', 1)->latest()->get();
        $BrandMealCategoryModel = new BrandMealCategoryModel;
        $mealcates = $BrandMealCategoryModel->where(function($query) use($request) {
            $shopid = intval($request->shopid);
            if($shopid){
                $query->where('shop_id', $shopid);
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->latest()->paginate(20);
        return view('admin.brand.mealcate.index', ['mealcates' => $mealcates, 'shoplist' => $shoplist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoplist = BrandShopModel::where('ordermeal', 1)->latest()->get();
        return view('admin.brand.mealcate.create', ['shoplist' => $shoplist]);
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
            'shop_id' => 'required|numeric|exists:brand_shop,id',
            'name' => 'required|max:10',
        );
        $messages = array(
            'shop_id.required' => '所属店铺不允许为空！',
            'shop_id.numeric' => '所属店铺选择错误！',
            'shop_id.exists' => '所属店铺不存在！',
            'name.required' => '分类名称不允许为空！',
            'name.max' => '分类名称必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $mealcate = new BrandMealCategoryModel;
        $mealcate->shop_id = $request->shop_id;
        $mealcate->name = $request->name;
        $mealcate->displayorder = intval($request->displayorder);
        $mealcate->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.mealcate.addsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.mealcate.addsucceed'), 'url' => back()->getTargetUrl()]);
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
        $mealcate = BrandMealCategoryModel::findOrFail($id);
        $shoplist = BrandShopModel::where('ordermeal', 1)->latest()->get();
        return view('admin.brand.mealcate.show', ['mealcate' => $mealcate, 'shoplist' => $shoplist]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mealcate = BrandMealCategoryModel::findOrFail($id);
        $shoplist = BrandShopModel::where('ordermeal', 1)->latest()->get();
        return view('admin.brand.mealcate.edit', ['mealcate' => $mealcate, 'shoplist' => $shoplist]);
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
        $mealcate = BrandMealCategoryModel::findOrFail($id);
        $rules = array(
            'shop_id' => 'required|numeric|exists:brand_shop,id',
            'name' => 'required|max:10',
        );
        $messages = array(
            'shop_id.required' => '所属店铺不允许为空！',
            'shop_id.numeric' => '所属店铺选择错误！',
            'shop_id.exists' => '所属店铺不存在！',
            'name.required' => '分类名称不允许为空！',
            'name.max' => '分类名称必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $mealcate->shop_id = $request->shop_id;
        $mealcate->name = $request->name;
        $mealcate->displayorder = intval($request->displayorder);
        $mealcate->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.mealcate.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.mealcate.editsucceed'), 'url' => back()->getTargetUrl()]);
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
        $mealcate = BrandMealCategoryModel::findOrFail($id);
        $mealcate->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.mealcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.mealcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandMealCategoryModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.brand.mealcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.mealcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => 0, 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function recycle(Request $request)
    {
        $mealcates = BrandMealCategoryModel::onlyTrashed()->where('name', 'like', '%'.$request->name.'%')->latest()->paginate(10);
        return view('admin.brand.mealcate.recycle', ['mealcates' => $mealcates]);
    }

    public function restore(Request $request, $id)
    {
        $mealcate = BrandMealCategoryModel::withTrashed()->findOrFail($id);
        $mealcate->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.mealcate.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.mealcate.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
