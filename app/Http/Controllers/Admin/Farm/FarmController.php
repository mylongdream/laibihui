<?php

namespace App\Http\Controllers\Admin\Farm;

use App\Http\Controllers\Controller;
use App\Models\FarmAttrModel;
use App\Models\CommonSubwebModel;
use App\Models\FarmModel;
use Illuminate\Http\Request;


class FarmController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $FarmModel = new FarmModel;
        $farms = $FarmModel->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->latest()->paginate(20);
        return view('admin.farm.farm.index', ['farms' => $farms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        return view('admin.farm.farm.create', ['subwebs' => $subwebs]);
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
            'subweb_id' => 'required|numeric|exists:common_subweb',
            'name' => 'required|max:50|unique:brand_farm,name',
            'upphoto' => 'required',
        );
        $messages = array(
            'subweb_id.required' => '所属分站不允许为空！',
            'subweb_id.numeric' => '所属分站选择错误！',
            'subweb_id.exists' => '所属分站不存在！',
            'name.required' => '农家乐名称不允许为空！',
            'name.max' => '农家乐名称必须小于 :max 个字符。',
            'name.unique' => '农家乐名称已经存在。',
            'upphoto.required' => '展示图片不允许为空！',
        );
        $request->validate($rules, $messages);

        $farm = new FarmModel;
        $farm->subweb_id = $request->subweb_id;
        $farm->name = $request->name;
        $farm->upimage = array_first($request->upphoto);
        $farm->upphoto = serialize($request->upphoto);
        $farm->address = $request->address;
        $farm->maplng = floatval($request->maplng);
        $farm->maplat = floatval($request->maplat);
        $farm->phone = $request->phone;
        $farm->mobile = $request->mobile;
        $farm->price = $request->price;
        $farm->viewnum = $request->viewnum;
        $farm->message = $request->message;
        $farm->environment = $request->environment;
        $farm->seo_title = $request->seo_title;
        $farm->seo_keywords = $request->seo_keywords;
        $farm->seo_description = $request->seo_description;
        $farm->save();
        foreach ($request->group as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'group';
            $farmattr->save();
        }
        foreach ($request->play as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'play';
            $farmattr->save();
        }
        foreach ($request->service as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'service';
            $farmattr->save();
        }
        foreach ($request->support as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'support';
            $farmattr->save();
        }
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.farm.farm.addsucceed'), 'url' => route('admin.farm.farm.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.farm.farm.addsucceed'), 'url' => route('admin.farm.farm.index')]);
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
        $farm = FarmModel::findOrFail($id);
        return view('admin.farm.farm.show', ['farm' => $farm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        $farm = FarmModel::findOrFail($id);
        return view('admin.farm.farm.edit', ['farm' => $farm, 'subwebs' => $subwebs]);
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
        $farm = FarmModel::findOrFail($id);
        $rules = array(
            'subweb_id' => 'required|numeric|exists:common_subweb',
            'name' => 'required|max:50|unique:brand_farm,name,'.$farm->id.',id',
            'upphoto' => 'required',
        );
        $messages = array(
            'subweb_id.required' => '所属分站不允许为空！',
            'subweb_id.numeric' => '所属分站选择错误！',
            'subweb_id.exists' => '所属分站不存在！',
            'name.required' => '农家乐名称不允许为空！',
            'name.max' => '农家乐名称必须小于 :max 个字符。',
            'name.unique' => '农家乐名称已经存在。',
            'upphoto.required' => '展示图片不允许为空！',
        );
        $request->validate($rules, $messages);

        $farm->subweb_id = $request->subweb_id;
        $farm->name = $request->name;
        $farm->upimage = array_first($request->upphoto);
        $farm->upphoto = serialize($request->upphoto);
        $farm->address = $request->address;
        $farm->maplng = floatval($request->maplng);
        $farm->maplat = floatval($request->maplat);
        $farm->phone = $request->phone;
        $farm->mobile = $request->mobile;
        $farm->price = $request->price;
        $farm->viewnum = $request->viewnum;
        $farm->message = $request->message;
        $farm->environment = $request->environment;
        $farm->seo_title = $request->seo_title;
        $farm->seo_keywords = $request->seo_keywords;
        $farm->seo_description = $request->seo_description;
        $farm->save();

        FarmAttrModel::where("farm_id", $farm->id)->delete();
        foreach ($request->group as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'group';
            $farmattr->save();
        }
        foreach ($request->play as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'play';
            $farmattr->save();
        }
        foreach ($request->service as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'service';
            $farmattr->save();
        }
        foreach ($request->support as $value){
            $farmattr = new FarmAttrModel;
            $farmattr->farm_id = $farm->id;
            $farmattr->attr_id = $value;
            $farmattr->type = 'support';
            $farmattr->save();
        }
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.farm.farm.editsucceed'), 'url' => route('admin.farm.farm.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.farm.farm.editsucceed'), 'url' => route('admin.farm.farm.index')]);
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
        $farm = FarmModel::findOrFail($id);
        $farm->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.farm.farm.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.farm.farm.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            FarmModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.farm.farm.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.farm.farm.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function recycle(Request $request)
    {
        $farms = FarmModel::onlyTrashed()->where('name', 'like', '%'.$request->name.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.farm.farm.recycle', ['farms' => $farms]);
    }

    public function restore(Request $request, $id)
    {
        $farm = FarmModel::withTrashed()->findOrFail($id);
        $farm->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.farm.farm.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.farm.farm.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
