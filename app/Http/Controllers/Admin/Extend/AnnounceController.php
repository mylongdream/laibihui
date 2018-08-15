<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonAnnounceModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $announces = CommonAnnounceModel::where('title', 'like', '%'.$request->title.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.extend.announce.index', ['announces' => $announces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extend.announce.create');
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
            'message' => 'required|max:25500',
            'jumpurl' => 'nullable|url',
        );
        $messages = array(
            'title.required' => '公告主题不允许为空！',
            'title.max' => '公告主题必须小于 :max 个字符。',
            'message.required' => '公告内容不允许为空！',
            'message.max' => '公告内容必须小于 :max 个字符。',
            'jumpurl.url' => '跳转链接必须是有效的 URL。',
        );
        $this->validate($request, $rules, $messages);

        $announce = new CommonAnnounceModel;
        $announce->title = $request->title;
        $announce->message = $request->message;
        $announce->jumpurl = $request->jumpurl;
        $announce->displayorder = intval($request->displayorder);
        $announce->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.announce.addsucceed'), 'url' => route('admin.extend.announce.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.announce.addsucceed'), 'url' => route('admin.extend.announce.index')]);
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
        $announce = CommonAnnounceModel::findOrFail($id);
        return view('admin.extend.announce.show', ['announce' => $announce]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announce = CommonAnnounceModel::findOrFail($id);
        return view('admin.extend.announce.edit', ['announce' => $announce]);
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
        $announce = CommonAnnounceModel::findOrFail($id);
        $rules = array(
            'title' => 'required|max:60',
            'message' => 'required|max:25500',
            'jumpurl' => 'nullable|url',
        );
        $messages = array(
            'title.required' => '公告主题不允许为空！',
            'title.max' => '公告主题必须小于 :max 个字符。',
            'message.required' => '公告内容不允许为空！',
            'message.max' => '公告内容必须小于 :max 个字符。',
            'jumpurl.url' => '跳转链接必须是有效的 URL。',
        );
        $this->validate($request, $rules, $messages);

        $announce->title = $request->title;
        $announce->message = $request->message;
        $announce->jumpurl = $request->jumpurl;
        $announce->displayorder = intval($request->displayorder);
        $announce->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.announce.editsucceed'), 'url' => route('admin.extend.announce.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.announce.editsucceed'), 'url' => route('admin.extend.announce.index')]);
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
        $announce = CommonAnnounceModel::findOrFail($id);
        $announce->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.announce.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.announce.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonAnnounceModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.announce.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.announce.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonAnnounceModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.announce.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.announce.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
