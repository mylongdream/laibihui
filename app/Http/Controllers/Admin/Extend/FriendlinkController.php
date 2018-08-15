<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonFriendlinkModel;
use Illuminate\Http\Request;


class FriendlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $friendlinks = CommonFriendlinkModel::where('title', 'like', '%'.$request->title.'%')->orderBy('displayorder', 'asc')->latest()->paginate(10);
        return view('admin.extend.friendlink.index', ['friendlinks' => $friendlinks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extend.friendlink.create');
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
            'url' => 'required|max:255',
        );
        $messages = array(
            'title.required' => '站点名称不允许为空！',
            'title.max' => '站点名称必须小于 :max 个字符。',
            'url.required' => '站点URL不允许为空！',
            'url.max' => '站点URL必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $friendlink = new CommonFriendlinkModel;
        $friendlink->title = trim($request->title);
        $friendlink->url = $request->url;
        $friendlink->logo = $request->logo;
        $friendlink->description = $request->description;
        $friendlink->displayorder = $request->displayorder;
        $friendlink->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.friendlink.addsucceed'), 'url' => route('admin.extend.friendlink.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.friendlink.addsucceed'), 'url' => route('admin.extend.friendlink.index')]);
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
        $friendlink = CommonFriendlinkModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $friendlink = CommonFriendlinkModel::findOrFail($id);
        return view('admin.extend.friendlink.edit')->with('friendlink', $friendlink);
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
        $friendlink = CommonFriendlinkModel::findOrFail($id);
        $rules = array(
            'title' => 'required|max:50',
            'url' => 'required|max:255',
        );
        $messages = array(
            'title.required' => '站点名称不允许为空！',
            'title.max' => '站点名称必须小于 :max 个字符。',
            'url.required' => '站点URL不允许为空！',
            'url.max' => '站点URL必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $friendlink->title = trim($request->title);
        $friendlink->url = $request->url;
        $friendlink->logo = $request->logo;
        $friendlink->description = $request->description;
        $friendlink->displayorder = $request->displayorder;
        $friendlink->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.friendlink.editsucceed'), 'url' => route('admin.extend.friendlink.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.friendlink.editsucceed'), 'url' => route('admin.extend.friendlink.index')]);
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
        $friendlink = CommonFriendlinkModel::findOrFail($id);
        $friendlink->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.friendlink.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.friendlink.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonFriendlinkModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.friendlink.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.friendlink.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonFriendlinkModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.friendlink.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.friendlink.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
