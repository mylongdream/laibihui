<?php

namespace App\Http\Controllers\Admin\Mall;

use App\Http\Controllers\Controller;
use App\Models\MallCategoryModel;
use App\Models\MallShopModel;
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
        $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.mall.category.index', ['categorylist' => category_tree($categorylist)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.mall.category.create', ['categorylist' => category_tree($categorylist)]);
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

        $category = new MallCategoryModel;
        $category->parentid = intval($request->parentid);
        $category->name = $request->name;
        $category->upimage = $request->upimage;
        $category->description = $request->description;
        $category->displayorder = intval($request->displayorder);
        $category->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.mall.category.addsucceed'), 'url' => route('admin.mall.category.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.category.addsucceed'), 'url' => route('admin.mall.category.index')]);
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
        $category = MallCategoryModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = MallCategoryModel::findOrFail($id);
        $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.mall.category.edit', ['category' => $category, 'categorylist' => category_tree($categorylist)]);
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
        $category = MallCategoryModel::findOrFail($id);
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
            return response()->json(['status' => '1', 'info' => trans('admin.mall.category.editsucceed'), 'url' => route('admin.mall.category.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.category.editsucceed'), 'url' => route('admin.mall.category.index')]);
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
        $category = MallCategoryModel::findOrFail($id);
        $category->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.mall.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function move(Request $request, $id)
    {
        $category = MallCategoryModel::findOrFail($id);
        if($request->isMethod('POST')){
            $rules = array(
                'catid' => 'required|numeric',
            );
            $messages = array(
                'catid.required' => '转移分类不允许为空！',
                'catid.numeric' => '转移分类选择错误！',
            );
            $this->validate($request, $rules, $messages);
            MallShopModel::where('catid', $category->id)->update(['catid' => $request->catid]);
            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.mall.category.movesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.category.movesucceed'), 'url' => back()->getTargetUrl()]);
            }

        }else{
            $categorylist = MallCategoryModel::orderBy('displayorder', 'asc')->get();
            return view('admin.mall.category.move', ['category' => $category, 'categorylist' => category_tree($categorylist)]);
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
            MallCategoryModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.mall.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.category.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    MallCategoryModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if(is_array($request->name)) {
                foreach($request->name as $id => $name) {
                    MallCategoryModel::where('id', $id)->update(['name' => $name]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.mall.category.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.mall.category.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
