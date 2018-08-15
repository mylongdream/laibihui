<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\CommonNavModel;
use Illuminate\Http\Request;


class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $navlist = CommonNavModel::orderBy('displayorder', 'asc')->get();
        return view('admin.setting.nav.index', ['navlist' => category_tree($navlist)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navlist = CommonNavModel::orderBy('displayorder', 'asc')->get();
        return view('admin.setting.nav.create', ['navlist' => category_tree($navlist)]);
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
        );
        $messages = array(
            'title.required' => '导航名称不允许为空！',
            'title.max' => '导航名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $nav = new CommonNavModel;
        $nav->parentid = intval($request->parentid);
        $nav->title = $request->title;
        $nav->route = $request->route;
        $nav->hidden = $request->hidden;
        $nav->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.setting.nav.addsucceed'), 'url' => route('admin.setting.nav.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.setting.nav.addsucceed'), 'url' => route('admin.setting.nav.index')]);
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
        $nav = CommonNavModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nav = CommonNavModel::findOrFail($id);
        $navlist = CommonNavModel::orderBy('displayorder', 'asc')->get();
        return view('admin.setting.nav.edit', ['nav' => $nav, 'navlist' => category_tree($navlist)]);
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
        $nav = CommonNavModel::findOrFail($id);
        $rules = array(
            'title' => 'required|max:50',
        );
        $messages = array(
            'title.required' => '导航名称不允许为空！',
            'title.max' => '导航名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $nav->parentid = intval($request->parentid);
        $nav->title = $request->title;
        $nav->route = $request->route;
        $nav->hidden = $request->hidden;
        $nav->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.setting.nav.editsucceed'), 'url' => route('admin.setting.nav.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.setting.nav.editsucceed'), 'url' => route('admin.setting.nav.index')]);
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
        $nav = CommonNavModel::findOrFail($id);
        $nav->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.setting.nav.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.setting.nav.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonNavModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.setting.nav.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.setting.nav.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonNavModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if(is_array($request->title)) {
                foreach($request->title as $id => $title) {
                    CommonNavModel::where('id', $id)->update(['title' => $title]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.setting.nav.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.setting.nav.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
