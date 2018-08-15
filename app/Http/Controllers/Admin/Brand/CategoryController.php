<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.brand.category.index', ['categorylist' => category_tree($categorylist)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.brand.category.create', ['categorylist' => category_tree($categorylist)]);
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
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '分类名称不允许为空！',
            'name.max' => '分类名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $category = new BrandCategoryModel;
        $category->parentid = intval($request->parentid);
        $category->name = $request->name;
        $category->upimage = $request->upimage;
        $category->description = $request->description;
        $category->displayorder = intval($request->displayorder);
        $category->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.category.addsucceed'), 'url' => route('admin.brand.category.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.category.addsucceed'), 'url' => route('admin.brand.category.index')]);
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
        $category = BrandCategoryModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = BrandCategoryModel::findOrFail($id);
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.brand.category.edit', ['category' => $category, 'categorylist' => category_tree($categorylist)]);
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
        $category = BrandCategoryModel::findOrFail($id);
        $rules = array(
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '分类名称不允许为空！',
            'name.max' => '分类名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $category->parentid = intval($request->parentid);
        $category->name = $request->name;
        $category->upimage = $request->upimage;
        $category->description = $request->description;
        $category->displayorder = intval($request->displayorder);
        $category->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.category.editsucceed'), 'url' => route('admin.brand.category.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.category.editsucceed'), 'url' => route('admin.brand.category.index')]);
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
        $category = BrandCategoryModel::findOrFail($id);
        $category->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function move(Request $request, $id)
    {
        $category = BrandCategoryModel::findOrFail($id);
        if($request->isMethod('POST')){
            $rules = array(
                'catid' => 'required|numeric',
            );
            $messages = array(
                'catid.required' => '转移分类不允许为空！',
                'catid.numeric' => '转移分类选择错误！',
            );
            $this->validate($request, $rules, $messages);
            BrandShopModel::where('catid', $category->id)->update(['catid' => $request->catid]);
            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.brand.category.movesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.category.movesucceed'), 'url' => back()->getTargetUrl()]);
            }

        }else{
            $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
            return view('admin.brand.category.move', ['category' => $category, 'categorylist' => category_tree($categorylist)]);
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
            BrandCategoryModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    BrandCategoryModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if(is_array($request->name)) {
                foreach($request->name as $id => $name) {
                    BrandCategoryModel::where('id', $id)->update(['name' => $name]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.category.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.category.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
