<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\CommonSlideModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slides = CommonSlideModel::where('subject', 'like', '%'.$request->name.'%')->orderBy('displayorder', 'asc')->paginate(20);
        return view('admin.slide.index', ['slides' => $slides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
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
            'subject' => 'required|max:50',
        );
        $messages = array(
            'subject.required' => '幻灯名称不允许为空！',
            'subject.max' => '幻灯名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $slide = new CommonSlideModel;
        $slide->subject = $request->subject;
        $slide->subjectimage = $request->subjectimage;
        $slide->url = $request->url;
        $slide->displayorder = $request->displayorder;
        $slide->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.slide.addsucceed'), 'url' => route('admin.slide.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.slide.addsucceed'), 'url' => route('admin.slide.index')]);
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
        $slide = CommonSlideModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = CommonSlideModel::findOrFail($id);
        return view('admin.slide.edit')->with('slide', $slide);
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
        $slide = CommonSlideModel::findOrFail($id);
        $rules = array(
            'subject' => 'required|max:50',
        );
        $messages = array(
            'subject.required' => '幻灯名称不允许为空！',
            'subject.max' => '幻灯名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);
        $slide->subject = $request->subject;
        $slide->subjectimage = $request->subjectimage;
        $slide->url = $request->url;
        $slide->displayorder = $request->displayorder;
        $slide->save();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.slide.editsucceed'), 'url' => route('admin.slide.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.slide.editsucceed'), 'url' => route('admin.slide.index')]);
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
        $slide = CommonSlideModel::findOrFail($id);
        $slide->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.slide.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.slide.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function select(Request $request)
    {
        $slides = CommonSlideModel::all();
        foreach ($slides as $slide) {
            if ($slide->slide_id == $request->slide_id){
                $slide->current = 1;
                break;
            }
        }
        return view('admin.slide.select', ['slides' => $slides]);
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
            CommonSlideModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.slide.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.slide.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonSlideModel::where('slide_id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.slide.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.slide.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'info' => trans('admin.undefined.operation'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.undefined.operation'), 'url' => back()->getTargetUrl()]);
            }
        }
    }

}
