<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonFaqCategoryModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqcates = CommonFaqCategoryModel::where('title', 'like', '%'.$request->title.'%')->orderBy('displayorder', 'asc')->paginate(10);
        return view('admin.extend.faqcate.index', ['faqcates' => $faqcates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extend.faqcate.create');
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
            'name' => 'required|max:60',
        );
        $messages = array(
            'name.required' => '分类名称不允许为空！',
            'name.max' => '分类名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $faqcate = new CommonFaqCategoryModel;
        $faqcate->name = $request->name;
        $faqcate->displayorder = intval($request->displayorder);
        $faqcate->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.faqcate.addsucceed'), 'url' => route('admin.extend.faqcate.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faqcate.addsucceed'), 'url' => route('admin.extend.faqcate.index')]);
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
        $faqcate = CommonFaqCategoryModel::findOrFail($id);
        return view('admin.extend.faqcate.show', ['faqcate' => $faqcate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faqcate = CommonFaqCategoryModel::findOrFail($id);
        return view('admin.extend.faqcate.edit', ['faqcate' => $faqcate]);
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
        $faqcate = CommonFaqCategoryModel::findOrFail($id);
        $rules = array(
            'name' => 'required|max:60',
        );
        $messages = array(
            'name.required' => '分类名称不允许为空！',
            'name.max' => '分类名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $faqcate->name = $request->name;
        $faqcate->displayorder = intval($request->displayorder);
        $faqcate->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.faqcate.editsucceed'), 'url' => route('admin.extend.faqcate.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faqcate.editsucceed'), 'url' => route('admin.extend.faqcate.index')]);
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
        $faqcate = CommonFaqCategoryModel::findOrFail($id);
        $faqcate->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.faqcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faqcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonFaqCategoryModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.faqcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faqcate.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonFaqCategoryModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.faqcate.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faqcate.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
