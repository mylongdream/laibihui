<?php

namespace App\Http\Controllers\Admin\Farm;

use App\Http\Controllers\Controller;
use App\Models\FarmPackageModel;
use App\Models\FarmModel;
use Illuminate\Http\Request;


class PackageController extends Controller
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
        $farm = FarmModel::find($request->farm_id);
        $farmlist = FarmModel::latest()->get();
        $FarmPackageModel = new FarmPackageModel;
        $packages = $FarmPackageModel->where(function($query) use($request) {
            $farmid = intval($request->farm_id);
            if($farmid){
                $query->where('farm_id', $farmid);
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->orderBy('displayorder', 'asc')->latest()->paginate(20);
        return view('admin.farm.package.index', ['farmlist' => $farmlist, 'packages' => $packages, 'farm' => $farm]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $farm = FarmModel::find($request->farm_id);
        $farmlist = FarmModel::latest()->get();
        return view('admin.farm.package.create', ['farmlist' => $farmlist, 'farm' => $farm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $farm = FarmModel::find($request->farm_id);
        $rules = array(
            'farm_id' => 'required|numeric|exists:brand_farm,id',
            'name' => 'required|max:50',
            'price' => 'required',
        );
        $messages = array(
            'farm_id.required' => '所属店铺不允许为空！',
            'farm_id.numeric' => '所属店铺选择错误！',
            'farm_id.exists' => '所属店铺不存在！',
            'name.required' => '套餐名称不允许为空！',
            'name.max' => '套餐名称必须小于 :max 个字符。',
            'price.required' => '套餐价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $package = new FarmPackageModel;
        $package->farm_id = $request->farm_id;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->onsale = intval($request->onsale) ? 1 : 0;
        $package->displayorder = intval($request->displayorder);
        $package->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.farm.package.addsucceed'), 'url' => route('admin.farm.package.index', ['farm_id' => request('farm_id')])]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.farm.package.addsucceed'), 'url' => route('admin.farm.package.index', ['farm_id' => request('farm_id')])]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $package = FarmPackageModel::findOrFail($request->id);
        $farmlist = FarmModel::latest()->get();
        return view('admin.farm.package.show', ['package' => $package, 'farmlist' => $farmlist]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $package = FarmPackageModel::findOrFail($request->id);
        $farmlist = FarmModel::latest()->get();
        return view('admin.farm.package.edit', ['package' => $package, 'farmlist' => $farmlist]);
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
        $package = FarmPackageModel::findOrFail($request->id);
        $rules = array(
            'farm_id' => 'required|numeric|exists:brand_farm,id',
            'name' => 'required|max:50',
            'price' => 'required',
        );
        $messages = array(
            'farm_id.required' => '所属店铺不允许为空！',
            'farm_id.numeric' => '所属店铺选择错误！',
            'farm_id.exists' => '所属店铺不存在！',
            'name.required' => '套餐名称不允许为空！',
            'name.max' => '套餐名称必须小于 :max 个字符。',
            'price.required' => '套餐价格不允许为空！',
        );
        $request->validate($rules, $messages);

        $package->farm_id = $request->farm_id;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->onsale = intval($request->onsale) ? 1 : 0;
        $package->displayorder = intval($request->displayorder);
        $package->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.farm.package.editsucceed'), 'url' => route('admin.farm.package.index', ['farm_id' => request('farm_id')])]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.farm.package.editsucceed'), 'url' => route('admin.farm.package.index', ['farm_id' => request('farm_id')])]);
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
        $package = FarmPackageModel::findOrFail($request->id);
        $package->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.farm.package.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.farm.package.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            FarmPackageModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.farm.package.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.farm.package.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    FarmPackageModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.farm.package.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.farm.package.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function recycle(Request $request)
    {
        $packages = FarmPackageModel::onlyTrashed()->where('name', 'like', '%'.$request->name.'%')->latest()->paginate(10);
        return view('admin.farm.package.recycle', ['packages' => $packages]);
    }

    public function restore(Request $request, $id)
    {
        $package = FarmPackageModel::withTrashed()->findOrFail($request->id);
        $package->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.farm.package.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.farm.package.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
