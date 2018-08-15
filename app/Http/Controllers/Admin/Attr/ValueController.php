<?php

namespace App\Http\Controllers\Admin\Attr;

use App\Http\Controllers\Controller;
use App\Models\CommonAttrModel;
use App\Models\CommonAttrValueModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if ($request->attr_id) {
            $attrvalues = CommonAttrValueModel::where('attr_id', $request->attr_id)->orderBy('displayorder', 'asc')->paginate(20);
        }else{
            $attrvalues = CommonAttrValueModel::orderBy('displayorder', 'asc')->paginate(20);
        }
        return view('admin.attr.value.index', ['attrvalues' => $attrvalues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attrlist = CommonAttrModel::orderBy('displayorder', 'asc')->get();
        return view('admin.attr.value.create', ['attrlist' => $attrlist]);
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
            'attr_id' => 'required|numeric|exists:common_attr',
            'title' => 'required|max:50',
        );
        $messages = array(
            'attr_id.required' => '所属属性不允许为空！',
            'attr_id.numeric' => '所属属性选择错误！',
            'attr_id.exists' => '所属属性不存在！',
            'title.required' => '选项名称不允许为空！',
            'title.max' => '选项名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $attrvalue = new CommonAttrValueModel;
        $attrvalue->attr_id = $request->attr_id;
        $attrvalue->title = $request->title;
        $attrvalue->displayorder = $request->displayorder;
        $attrvalue->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.attr.value.addsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.value.addsucceed'), 'url' => back()->getTargetUrl()]);
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
        $attrvalue = CommonAttrValueModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attrvalue = CommonAttrValueModel::findOrFail($id);
        $attrlist = CommonAttrModel::orderBy('displayorder', 'asc')->get();
        return view('admin.attr.value.edit', ['attrvalue' => $attrvalue, 'attrlist' => $attrlist]);
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
        $attrvalue = CommonAttrValueModel::findOrFail($id);
        $rules = array(
            'attr_id' => 'required|numeric|exists:common_attr',
            'title' => 'required|max:50',
        );
        $messages = array(
            'attr_id.required' => '所属属性不允许为空！',
            'attr_id.numeric' => '所属属性选择错误！',
            'attr_id.exists' => '所属属性不存在！',
            'title.required' => '选项名称不允许为空！',
            'title.max' => '选项名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $attrvalue->attr_id = $request->attr_id;
        $attrvalue->title = $request->title;
        $attrvalue->displayorder = $request->displayorder;
        $attrvalue->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.attr.value.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.value.editsucceed'), 'url' => back()->getTargetUrl()]);
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
        $attrvalue = CommonAttrValueModel::findOrFail($id);
        $attrvalue->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.attr.value.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.value.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonAttrValueModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.attr.value.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.value.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonAttrValueModel::where('attr_value_id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if(is_array($request->title)) {
                foreach($request->title as $id => $title) {
                    CommonAttrValueModel::where('attr_value_id', $id)->update(['title' => $title]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.attr.value.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.attr.value.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
