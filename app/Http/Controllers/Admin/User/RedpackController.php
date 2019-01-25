<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUserRedpackModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class RedpackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redpacks = CommonUserRedpackModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.redpack.index', ['redpacks' => $redpacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.redpack.create');
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

        $redpack = new CommonUserRedpackModel;
        $redpack->title = $request->title;
        $redpack->message = $request->message;
        $redpack->jumpurl = $request->jumpurl;
        $redpack->displayorder = intval($request->displayorder);
        $redpack->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.redpack.addsucceed'), 'url' => route('admin.user.redpack.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.redpack.addsucceed'), 'url' => route('admin.user.redpack.index')]);
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
        $redpack = CommonUserRedpackModel::findOrFail($id);
        return view('admin.user.redpack.show', ['redpack' => $redpack]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $redpack = CommonUserRedpackModel::findOrFail($id);
        return view('admin.user.redpack.edit', ['redpack' => $redpack]);
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
        $redpack = CommonUserRedpackModel::findOrFail($id);
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

        $redpack->title = $request->title;
        $redpack->message = $request->message;
        $redpack->jumpurl = $request->jumpurl;
        $redpack->displayorder = intval($request->displayorder);
        $redpack->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.redpack.editsucceed'), 'url' => route('admin.user.redpack.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.redpack.editsucceed'), 'url' => route('admin.user.redpack.index')]);
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
        $redpack = CommonUserRedpackModel::findOrFail($id);
        $redpack->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.user.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonUserRedpackModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonUserRedpackModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.redpack.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.user.redpack.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
