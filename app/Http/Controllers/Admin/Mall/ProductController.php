<?php

namespace App\Http\Controllers\Admin\Mall;

use App\Http\Controllers\Controller;
use App\Models\MallCategoryModel;
use App\Models\MallShopModel;
use App\Models\CommonSubwebModel;
use App\Models\MallProductModel;
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
        $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();
        $MallProductModel = new MallProductModel;
        $products = $MallProductModel->where(function($query) use($request) {
            if($request->catid){
                $query->where('catid', $request->catid);
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->latest()->paginate(10);
        return view('admin.mall.product.index', ['products' => $products, 'categorylist' => category_tree($categorylist)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.mall.product.create', ['categorylist' => category_tree($categorylist)]);
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
            'catid' => 'required|numeric|exists:mall_category,id',
            'name' => 'required|max:50',
            'message' => 'max:50000',
        );
        $messages = array(
            'catid.required' => '商品分类不允许为空！',
            'catid.numeric' => '商品分类选择错误！',
            'catid.exists' => '商品分类不存在！',
            'name.required' => '商品名称不允许为空！',
            'name.max' => '商品名称必须小于 :max 个字符。',
            'message.max' => '商品内容必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $product = new MallProductModel;
        $product->catid = $request->catid;
        $product->name = $request->name;
        $product->upimage = $request->upimage;
        $product->upphoto = $request->upphoto ? serialize($request->upphoto) : '';
        $product->price = $request->price;
        $product->score = $request->score;
        $product->stock = $request->stock;
        $product->sellnum = $request->sellnum;
        $product->viewnum = $request->viewnum;
        $product->onsale = intval($request->onsale) ? 1 : 0;
        $product->message = $request->message;
        $product->seo_title = $request->seo_title;
        $product->seo_keywords = $request->seo_keywords;
        $product->seo_description = $request->seo_description;
        $product->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.mall.product.addsucceed'), 'url' => route('admin.mall.product.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.product.addsucceed'), 'url' => route('admin.mall.product.index')]);
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
        $product = MallProductModel::findOrFail($id);
        return view('admin.mall.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = MallProductModel::findOrFail($id);
        $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.mall.product.edit', ['product' => $product, 'categorylist' => category_tree($categorylist)]);
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
        $product = MallProductModel::findOrFail($id);
        $rules = array(
            'catid' => 'required|numeric|exists:mall_category,id',
            'name' => 'required|max:50',
            'message' => 'max:50000',
        );
        $messages = array(
            'catid.required' => '商品分类不允许为空！',
            'catid.numeric' => '商品分类选择错误！',
            'catid.exists' => '商品分类不存在！',
            'name.required' => '商品名称不允许为空！',
            'name.max' => '商品名称必须小于 :max 个字符。',
            'message.max' => '商品内容必须小于 :max 个字符。',
        );
        $request->validate($rules, $messages);

        $product->catid = $request->catid;
        $product->name = $request->name;
        $product->upimage = $request->upimage;
        $product->upphoto = $request->upphoto ? serialize($request->upphoto) : '';
        $product->price = $request->price;
        $product->score = $request->score;
        $product->stock = $request->stock;
        $product->sellnum = $request->sellnum;
        $product->viewnum = $request->viewnum;
        $product->onsale = intval($request->onsale) ? 1 : 0;
        $product->message = $request->message;
        $product->seo_title = $request->seo_title;
        $product->seo_keywords = $request->seo_keywords;
        $product->seo_description = $request->seo_description;
        $product->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.mall.product.editsucceed'), 'url' => route('admin.mall.product.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.product.editsucceed'), 'url' => route('admin.mall.product.index')]);
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
        $product = MallProductModel::findOrFail($id);
        $product->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.mall.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            MallProductModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.mall.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.product.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function recycle(Request $request)
    {
        $products = MallProductModel::onlyTrashed()->where('name', 'like', '%'.$request->name.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.mall.product.recycle', ['products' => $products]);
    }

    public function restore(Request $request, $id)
    {
        $product = MallProductModel::withTrashed()->findOrFail($id);
        $product->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.mall.product.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.product.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
