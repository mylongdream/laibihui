<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonAdminMenuModel;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menulist = CommonAdminMenuModel::orderBy('displayorder', 'asc')->get();
        return view('admin.admin.menu.index', ['menulist' => category_tree($menulist)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menulist = CommonAdminMenuModel::orderBy('displayorder', 'asc')->get();
        return view('admin.admin.menu.create', ['menulist' => category_tree($menulist)]);
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
            'title.required' => '菜单名称不允许为空！',
            'title.max' => '菜单名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $menu = new CommonAdminMenuModel;
        $menu->parentid = intval($request->parentid);
        $menu->title = $request->title;
        $menu->route = $request->route;
        $menu->hidden = $request->hidden;
        $menu->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.menu.addsucceed'), 'url' => route('admin.admin.menu.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.admin.menu.addsucceed'), 'url' => route('admin.admin.menu.index')]);
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
        $menu = CommonAdminMenuModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = CommonAdminMenuModel::findOrFail($id);
        $menulist = CommonAdminMenuModel::orderBy('displayorder', 'asc')->get();
        return view('admin.admin.menu.edit', ['menu' => $menu, 'menulist' => category_tree($menulist)]);
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
        $menu = CommonAdminMenuModel::findOrFail($id);
        $rules = array(
            'title' => 'required|max:50',
        );
        $messages = array(
            'title.required' => '菜单名称不允许为空！',
            'title.max' => '菜单名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $menu->parentid = intval($request->parentid);
        $menu->title = $request->title;
        $menu->route = $request->route;
        $menu->hidden = $request->hidden;
        $menu->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.menu.editsucceed'), 'url' => route('admin.admin.menu.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.admin.menu.editsucceed'), 'url' => route('admin.admin.menu.index')]);
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
        $menu = CommonAdminMenuModel::findOrFail($id);
        $menu->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.admin.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.admin.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonAdminMenuModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.admin.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.admin.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonAdminMenuModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if(is_array($request->title)) {
                foreach($request->title as $id => $title) {
                    CommonAdminMenuModel::where('id', $id)->update(['title' => $title]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.admin.menu.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.admin.menu.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
