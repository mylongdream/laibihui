<?php

namespace App\Http\Controllers\Admin\Attr;

use App\Http\Controllers\Controller;
use App\Models\CommonAttrModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class AttrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attrs = CommonAttrModel::orderBy('displayorder', 'asc')->paginate(12);
        return view('admin.attr.attr.index', ['attrs' => $attrs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attr.attr.create');
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
            'title' => 'required|max:50',
            'attr_key' => 'required|max:50|unique:common_attr,attr_key',
        );
        $messages = array(
            'title.required' => '属性名称不允许为空！',
            'title.max' => '属性名称必须小于 :max 个字符。',
            'attr_key.required' => '属性KEY不允许为空！',
            'attr_key.max' => '属性KEY必须小于 :max 个字符。',
            'attr_key.unique' => '属性KEY已经存在！',
        );
        $this->validate($request, $rules, $messages);

        $attr = new CommonAttrModel;
        $attr->title = $request->title;
        $attr->attr_key = $request->attr_key;
        $attr->displayorder = intval($request->displayorder);
        $attr->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.attr.attr.addsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.attr.addsucceed'), 'url' => back()->getTargetUrl()]);
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
        $attr = CommonAttrModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attr = CommonAttrModel::findOrFail($id);
        return view('admin.attr.attr.edit')->with('attr', $attr);
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
        $attr = CommonAttrModel::findOrFail($id);

        $rules = array(
            'title' => 'required|max:50',
            'attr_key' => 'required|max:50|unique:common_attr,attr_key,'.$attr->attr_id.',attr_id',
        );
        $messages = array(
            'title.required' => '属性名称不允许为空！',
            'title.max' => '属性名称必须小于 :max 个字符。',
            'attr_key.required' => '属性KEY不允许为空！',
            'attr_key.max' => '属性KEY必须小于 :max 个字符。',
            'attr_key.unique' => '属性KEY已经存在！',
        );
        $this->validate($request, $rules, $messages);

        $attr->title = $request->title;
        $attr->attr_key = $request->attr_key;
        $attr->displayorder = intval($request->displayorder);
        $attr->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.attr.attr.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.attr.editsucceed'), 'url' => back()->getTargetUrl()]);
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
        $attr = CommonAttrModel::findOrFail($id);
        $attr->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.attr.attr.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.attr.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonAttrModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.attr.attr.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.attr.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $displayorder) {
                    CommonAttrModel::where('attr_id', $id)->update(['displayorder' => $displayorder]);
                }
            }
            if(is_array($request->title)) {
                foreach($request->title as $id => $title) {
                    CommonAttrModel::where('attr_id', $id)->update(['title' => $title]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.attr.attr.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.attr.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
