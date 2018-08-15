<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonFaqCategoryModel;
use App\Models\CommonFaqModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs = CommonFaqModel::where('title', 'like', '%'.$request->title.'%')->orderBy('displayorder', 'asc')->paginate(10);
        return view('admin.extend.faq.index', ['faqs' => $faqs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqcategory = CommonFaqCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.extend.faq.create', ['faqcategory' => $faqcategory]);
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
            'title' => 'required|max:60',
            'message' => 'required|max:255',
        );
        $messages = array(
            'title.required' => '帮助名称不允许为空！',
            'title.max' => '帮助名称必须小于 :max 个字符。',
            'message.required' => '帮助内容不允许为空！',
            'message.max' => '帮助内容必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $faq = new CommonFaqModel;
        $faq->catid = intval($request->catid);
        $faq->title = $request->title;
        $faq->message = $request->message;
        $faq->displayorder = intval($request->displayorder);
        $faq->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.faq.addsucceed'), 'url' => route('admin.extend.faq.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faq.addsucceed'), 'url' => route('admin.extend.faq.index')]);
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
        $faqcategory = CommonFaqCategoryModel::orderBy('displayorder', 'asc')->get();
        $faq = CommonFaqModel::findOrFail($id);
        return view('admin.extend.faq.show', ['faq' => $faq, 'faqcategory' => $faqcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = CommonFaqModel::findOrFail($id);
        $faqcategory = CommonFaqCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.extend.faq.edit', ['faq' => $faq, 'faqcategory' => $faqcategory]);
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
        $faq = CommonFaqModel::findOrFail($id);
        $rules = array(
            'title' => 'required|max:60',
            'message' => 'required|max:255',
        );
        $messages = array(
            'title.required' => '帮助名称不允许为空！',
            'title.max' => '帮助名称必须小于 :max 个字符。',
            'message.required' => '帮助内容不允许为空！',
            'message.max' => '帮助内容必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $faq->catid = intval($request->catid);
        $faq->title = $request->title;
        $faq->message = $request->message;
        $faq->displayorder = intval($request->displayorder);
        $faq->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.faq.editsucceed'), 'url' => route('admin.extend.faq.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faq.editsucceed'), 'url' => route('admin.extend.faq.index')]);
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
        $faq = CommonFaqModel::findOrFail($id);
        $faq->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.faq.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faq.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonFaqModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.faq.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faq.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonFaqModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.faq.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.faq.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
