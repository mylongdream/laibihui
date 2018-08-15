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


class MealController extends Controller
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
        $BrandMealModel = new BrandMealModel;
        $meals = $BrandMealModel->where(function($query) use($request) {
            $shopid = intval($request->shopid);
            if($shopid){
                $query->where('shop_id', $shopid);
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->latest()->paginate(20);
        return view('admin.brand.meal.index', ['meals' => $meals, 'shoplist' => $shoplist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoplist = BrandShopModel::where('ordermeal', 1)->latest()->get();
        return view('admin.brand.meal.create', ['shoplist' => $shoplist]);
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
            'name' => 'required|max:50',
            'upimage' => 'required',
            'price' => 'required',
        );
        $messages = array(
            'shop_id.required' => '所属店铺不允许为空！',
            'shop_id.numeric' => '所属店铺选择错误！',
            'shop_id.exists' => '所属店铺不存在！',
            'name.required' => '菜品名称不允许为空！',
            'name.max' => '菜品名称必须小于 :max 个字符。',
            'upimage.required' => '菜品Logo不允许为空！',
            'price.required' => '菜品价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $meal = new BrandMealModel;
        $meal->shop_id = $request->shop_id;
        $meal->catid = intval($request->catid);
        $meal->name = $request->name;
        $meal->upimage = $request->upimage;
        $meal->price = $request->price;
        $meal->message = $request->message;
        $meal->onsale = intval($request->onsale) ? 1 : 0;
        $meal->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.meal.addsucceed'), 'url' => route('admin.brand.meal.index')]);
        }else{
            return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.meal.addsucceed'), 'url' => route('admin.brand.meal.index')]);
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
        $meal = BrandMealModel::findOrFail($id);
        $shoplist = BrandShopModel::where('ordermeal', 1)->latest()->get();
        return view('admin.brand.meal.show', ['meal' => $meal, 'shoplist' => $shoplist]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = BrandMealModel::findOrFail($id);
        $shoplist = BrandShopModel::where('ordermeal', 1)->latest()->get();
        return view('admin.brand.meal.edit', ['meal' => $meal, 'shoplist' => $shoplist]);
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
        $meal = BrandMealModel::findOrFail($id);
        $rules = array(
            'shop_id' => 'required|numeric|exists:brand_shop,id',
            'name' => 'required|max:50',
            'upimage' => 'required',
            'price' => 'required',
        );
        $messages = array(
            'shop_id.required' => '所属店铺不允许为空！',
            'shop_id.numeric' => '所属店铺选择错误！',
            'shop_id.exists' => '所属店铺不存在！',
            'name.required' => '菜品名称不允许为空！',
            'name.max' => '菜品名称必须小于 :max 个字符。',
            'upimage.required' => '菜品Logo不允许为空！',
            'price.required' => '菜品价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $meal->shop_id = $request->shop_id;
        $meal->catid = intval($request->catid);
        $meal->name = $request->name;
        $meal->upimage = $request->upimage;
        $meal->price = $request->price;
        $meal->message = $request->message;
        $meal->onsale = intval($request->onsale) ? 1 : 0;
        $meal->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.meal.editsucceed'), 'url' => route('admin.brand.meal.index')]);
        }else{
            return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.meal.editsucceed'), 'url' => route('admin.brand.meal.index')]);
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
        $meal = BrandMealModel::findOrFail($id);
        $meal->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.brand.meal.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.meal.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandMealModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.brand.meal.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.brand.meal.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => 0, 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function recycle(Request $request)
    {
        $meals = BrandMealModel::onlyTrashed()->where('name', 'like', '%'.$request->name.'%')->latest()->paginate(10);
        return view('admin.brand.meal.recycle', ['meals' => $meals]);
    }

    public function restore(Request $request, $id)
    {
        $meal = BrandMealModel::withTrashed()->findOrFail($id);
        $meal->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.meal.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.meal.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function getcate(Request $request)
    {
        $catelist = BrandMealCategoryModel::where('shop_id', $request->shop_id)->latest()->get();
        return response()->json(['catelist' => $catelist]);
    }

}
