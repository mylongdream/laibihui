<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonDistrictModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $upid = $request->upid ? $request->upid : 0;
        $districts = CommonDistrictModel::where('upid', $upid)->orderBy('displayorder', 'asc')->get();
        return view('admin.district.index', ['districts' => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $upid = $request->upid ? $request->upid : 0;
        $parent = CommonDistrictModel::find($upid);
        return view('admin.district.create', ['parent' => $parent]);
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
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '区域名称不允许为空！',
            'name.max' => '区域名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $district = new CommonDistrictModel;
        $district->upid = intval($request->upid);
        $district->name = $request->name;
        if($district->upid){
            $parent = CommonDistrictModel::find($district->upid);
            if($parent){
                $district->level = $parent->level + 1;
            }else{
                $district->level = 1;
            }
        }else{
            $district->level = 1;
        }
        $district->displayorder = intval($request->displayorder);
        $district->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.district.addsucceed'), 'url' => route('admin.district.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.district.addsucceed'), 'url' => route('admin.district.index')]);
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
        $district = CommonDistrictModel::findOrFail($id);
        return view('admin.district.show', ['district' => $district]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = CommonDistrictModel::findOrFail($id);
        return view('admin.district.edit', ['district' => $district]);
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
        $district = CommonDistrictModel::findOrFail($id);
        $rules = array(
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '区域名称不允许为空！',
            'name.max' => '区域名称必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $district->name = $request->name;
        $district->displayorder = intval($request->displayorder);
        $district->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.district.editsucceed'), 'url' => route('admin.district.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.district.editsucceed'), 'url' => route('admin.district.index')]);
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
        $district = CommonDistrictModel::findOrFail($id);
        $district->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.district.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.district.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function select(Request $request)
    {
        if ($request->city_id) {
            $areas = CommonDistrictModel::where('city_id', $request->city_id)->get();
        }else{
            $areas = array();
        }
        foreach ($areas as $area) {
            if ($area->area_id == $request->area_id){
                $area->current = 1;
                break;
            }
        }
        return view('admin.district.select', ['areas' => $areas]);
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
            CommonDistrictModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.district.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.district.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    CommonDistrictModel::where('area_id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.district.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.district.updatesucceed'), 'url' => back()->getTargetUrl()]);
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
