<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonSubwebModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class SubwebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subwebs = CommonSubwebModel::where('name', 'like', '%'.$request->name.'%')->orderBy('displayorder', 'asc')->paginate(20);
        return view('admin.subweb.index', ['subwebs' => $subwebs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subweb.create');
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
            'province' => 'required|numeric|exists:common_district,id',
            'city' => 'required|numeric|exists:common_district,id',
            'name' => 'required|max:50',
            'fullletter' => 'required|max:50',
            'firstletter' => 'required|max:1',
            'directory' => 'required|max:50',
            'domain' => 'required|max:50',
        );
        $messages = array(
            'province.required' => '所属省份不允许为空！',
            'province.numeric' => '所属省份选择错误！',
            'province.exists' => '所属省份不存在！',
            'city.required' => '所属城市不允许为空！',
            'city.numeric' => '所属城市选择错误！',
            'city.exists' => '所属城市不存在！',
            'name.required' => '分站名称不允许为空！',
            'name.max' => '分站名称必须小于 :max 个字符。',
            'fullletter.required' => '分站全拼不允许为空！',
            'fullletter.max' => '分站全拼必须小于 :max 个字符。',
            'firstletter.required' => '拼音首字母不允许为空！',
            'firstletter.max' => '拼音首字母必须小于 :max 个字符。',
            'directory.required' => '二级目录不允许为空！',
            'directory.max' => '二级目录必须小于 :max 个字符。',
            'domain.required' => '域名前缀不允许为空！',
            'domain.max' => '域名前缀必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $subweb = new CommonSubwebModel;
        $subweb->district_id = $request->city;
        $subweb->name = $request->name;
        $subweb->fullletter = $request->fullletter;
        $subweb->firstletter = $request->firstletter;
        $subweb->directory = $request->directory;
        $subweb->domain = $request->domain;
        $subweb->mappoint = $request->mappoint;
        $subweb->statcode = $request->statcode;
        $subweb->ifhot = $request->ifhot;
        $subweb->bbclosed = $request->bbclosed;
        $subweb->displayorder = intval($request->displayorder);
        $subweb->seo_title = $request->seo_title;
        $subweb->seo_keywords = $request->seo_keywords;
        $subweb->seo_description = $request->seo_description;
        $subweb->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.subweb.addsucceed'), 'url' => route('admin.subweb.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.subweb.addsucceed'), 'url' => route('admin.subweb.index')]);
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
        $subweb = CommonSubwebModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subweb = CommonSubwebModel::findOrFail($id);
        return view('admin.subweb.edit')->with('subweb', $subweb);
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
        $subweb = CommonSubwebModel::findOrFail($id);

        $rules = array(
            'province' => 'required|numeric|exists:common_district,id',
            'city' => 'required|numeric|exists:common_district,id',
            'name' => 'required|max:50',
            'fullletter' => 'required|max:50',
            'firstletter' => 'required|max:1',
            'directory' => 'required|max:50',
            'domain' => 'required|max:50',
        );
        $messages = array(
            'province.required' => '所属省份不允许为空！',
            'province.numeric' => '所属省份选择错误！',
            'province.exists' => '所属省份不存在！',
            'city.required' => '所属城市不允许为空！',
            'city.numeric' => '所属城市选择错误！',
            'city.exists' => '所属城市不存在！',
            'name.required' => '分站名称不允许为空！',
            'name.max' => '分站名称必须小于 :max 个字符。',
            'fullletter.required' => '分站全拼不允许为空！',
            'fullletter.max' => '分站全拼必须小于 :max 个字符。',
            'firstletter.required' => '拼音首字母不允许为空！',
            'firstletter.max' => '拼音首字母必须小于 :max 个字符。',
            'directory.required' => '二级目录不允许为空！',
            'directory.max' => '二级目录必须小于 :max 个字符。',
            'domain.required' => '域名前缀不允许为空！',
            'domain.max' => '域名前缀必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $subweb->district_id = $request->city;
        $subweb->name = $request->name;
        $subweb->fullletter = $request->fullletter;
        $subweb->firstletter = $request->firstletter;
        $subweb->directory = $request->directory;
        $subweb->domain = $request->domain;
        $subweb->mappoint = $request->mappoint;
        $subweb->statcode = $request->statcode;
        $subweb->ifhot = $request->ifhot;
        $subweb->bbclosed = $request->bbclosed;
        $subweb->displayorder = intval($request->displayorder);
        $subweb->seo_title = $request->seo_title;
        $subweb->seo_keywords = $request->seo_keywords;
        $subweb->seo_description = $request->seo_description;
        $subweb->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.subweb.editsucceed'), 'url' => route('admin.subweb.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.subweb.editsucceed'), 'url' => route('admin.subweb.index')]);
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
        $subweb = CommonSubwebModel::findOrFail($id);
        $subweb->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.subweb.deletesucceed'), 'url' => route('admin.subweb.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.subweb.deletesucceed'), 'url' => route('admin.subweb.index')]);
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
            CommonSubwebModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.subweb.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.subweb.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonSubwebModel::where('subweb_id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.subweb.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.subweb.updatesucceed'), 'url' => back()->getTargetUrl()]);
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
