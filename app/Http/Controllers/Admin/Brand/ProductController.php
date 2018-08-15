<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandShopModel;
use App\Models\CommonSubwebModel;
use App\Models\BrandProductModel;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $BrandProductModel = new BrandProductModel;
        $products = $BrandProductModel->where(function($query) use($request) {
            if($request->shopid){
                $query->where('shop_id', $request->shopid);
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->latest()->paginate(10);
        return view('admin.brand.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        $shoplist = BrandShopModel::orderBy('displayorder', 'asc')->get();
        return view('admin.brand.product.create', ['subwebs' => $subwebs, 'shoplist' => $shoplist]);
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
            'message' => 'max:50000',
        );
        $messages = array(
            'shop_id.required' => '商家店铺不允许为空！',
            'shop_id.numeric' => '商家店铺选择错误！',
            'shop_id.exists' => '商家店铺不存在！',
            'name.required' => '商品名称不允许为空！',
            'name.max' => '商品名称必须小于 :max 个字符。',
            'message.max' => '商品内容必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $shop = BrandShopModel::findOrFail($request->shop_id);
        $product = new BrandProductModel;
        $product->subweb_id = $shop->subweb_id;
        $product->shop_id = $shop->id;
        $product->name = $request->name;
        $product->upimage = $request->upimage;
        $product->upphoto = $request->upphoto ? serialize($request->upphoto) : '';
        $product->message = $request->message;
        $product->viewnum = $request->viewnum;
        $product->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.product.addsucceed'), 'url' => route('admin.brand.product.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.product.addsucceed'), 'url' => route('admin.brand.product.index')]);
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
        $product = BrandProductModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        $shoplist = BrandShopModel::orderBy('displayorder', 'asc')->get();
        $product = BrandProductModel::findOrFail($id);
        return view('admin.brand.product.edit', ['product' => $product, 'subwebs' => $subwebs, 'shoplist' => $shoplist]);
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
        $product = BrandProductModel::findOrFail($id);
        $rules = array(
            'shop_id' => 'required|numeric|exists:brand_shop,id',
            'name' => 'required|max:50',
            'message' => 'max:50000',
        );
        $messages = array(
            'shop_id.required' => '商家店铺不允许为空！',
            'shop_id.numeric' => '商家店铺选择错误！',
            'shop_id.exists' => '商家店铺不存在！',
            'name.required' => '商品名称不允许为空！',
            'name.max' => '商品名称必须小于 :max 个字符。',
            'message.max' => '商品内容必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $shop = BrandShopModel::findOrFail($request->shop_id);
        $product->subweb_id = $shop->subweb_id;
        $product->shop_id = $shop->id;
        $product->name = $request->name;
        $product->upimage = $request->upimage;
        $product->upphoto = $request->upphoto ? serialize($request->upphoto) : '';
        $product->message = $request->message;
        $product->viewnum = $request->viewnum;
        $product->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.product.editsucceed'), 'url' => route('admin.brand.product.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.product.editsucceed'), 'url' => route('admin.brand.product.index')]);
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
        $product = BrandProductModel::findOrFail($id);
        $product->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandProductModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function recycle(Request $request)
    {
        $products = BrandProductModel::onlyTrashed()->where('name', 'like', '%'.$request->name.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.brand.product.recycle', ['products' => $products]);
    }

    public function restore(Request $request, $id)
    {
        $product = BrandProductModel::withTrashed()->findOrFail($id);
        $product->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.product.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.product.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
