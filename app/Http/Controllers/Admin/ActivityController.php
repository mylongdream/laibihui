<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandActivityModel;
use Illuminate\Http\Request;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activitys = BrandActivityModel::where('subject', 'like', '%'.$request->subject.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.activity.index', ['activitys' => $activitys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activity.create');
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
            'city_id' => 'required|numeric|exists:common_city',
            'subject' => 'required|max:50',
            'message' => 'required',
        );
        $messages = array(
            'city_id.required' => '所属城市不允许为空！',
            'city_id.numeric' => '所属城市选择错误！',
            'city_id.exists' => '所属城市不存在！',
            'subject.required' => '文章名称不允许为空！',
            'subject.max' => '文章名称必须小于 :max 个字符。',
            'message.required' => '文章详情不允许为空！',
        );
        $this->validate($request, $rules, $messages);

        $activity = new BrandActivityModel;
        $activity->city_id = $request->city_id;
        $activity->subject = $request->subject;
        $activity->subjectimage = $request->subjectimage;
        $activity->desc = $request->desc;
        $activity->message = $request->message;
        $activity->jumpurl = $request->jumpurl;
        $activity->viewnum = $request->viewnum;
        $activity->seo_title = $request->seo_title;
        $activity->seo_keywords = $request->seo_keywords;
        $activity->seo_description = $request->seo_description;
        $activity->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.activity.addsucceed'), 'url' => route('admin.activity.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.activity.addsucceed'), 'url' => route('admin.activity.index')]);
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
        $activity = BrandActivityModel::findOrFail($id);
        return view('admin.activity.show', ['activity' => $activity]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = BrandActivityModel::findOrFail($id);
        return view('admin.activity.edit', ['activity' => $activity]);
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
        $activity = BrandActivityModel::findOrFail($id);
        $rules = array(
            'city_id' => 'required|numeric|exists:common_city',
            'subject' => 'required|max:50',
            'message' => 'required',
        );
        $messages = array(
            'city_id.required' => '所属城市不允许为空！',
            'city_id.numeric' => '所属城市选择错误！',
            'city_id.exists' => '所属城市不存在！',
            'subject.required' => '文章名称不允许为空！',
            'subject.max' => '文章名称必须小于 :max 个字符。',
            'message.required' => '文章详情不允许为空！',
        );
        $this->validate($request, $rules, $messages);

        $activity->city_id = $request->city_id;
        $activity->subject = $request->subject;
        $activity->subjectimage = $request->subjectimage;
        $activity->desc = $request->desc;
        $activity->message = $request->message;
        $activity->jumpurl = $request->jumpurl;
        $activity->viewnum = $request->viewnum;
        $activity->seo_title = $request->seo_title;
        $activity->seo_keywords = $request->seo_keywords;
        $activity->seo_description = $request->seo_description;
        $activity->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.activity.editsucceed'), 'url' => route('admin.activity.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.activity.editsucceed'), 'url' => route('admin.activity.index')]);
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
        $activity = BrandActivityModel::findOrFail($id);
        $activity->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.activity.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.activity.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandActivityModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.activity.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.activity.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
