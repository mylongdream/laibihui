<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonRedpackModel;
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
        $redpacks = CommonRedpackModel::where('name', 'like', '%'.$request->name.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.extend.redpack.index', ['redpacks' => $redpacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extend.redpack.create');
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
            'name' => 'required|max:60',
            'amount' => 'required|max:25500',
            'fullamount' => 'required|max:25500',
        );
        $messages = array(
            'name.required' => '红包名称不允许为空！',
            'name.max' => '红包名称必须小于 :max 个字符。',
            'amount.required' => '红包金额不允许为空！',
            'amount.max' => '红包金额必须小于 :max 。',
            'fullamount.required' => '红包满额不允许为空！',
            'fullamount.max' => '红包满额必须小于 :max 。',
        );
        $this->validate($request, $rules, $messages);

        $redpack = new CommonRedpackModel;
        $redpack->name = $request->name;
        $redpack->amount = $request->amount;
        $redpack->fullamount = $request->fullamount;
        $redpack->use_start = $request->use_start;
        $redpack->use_end = $request->use_end;
        $redpack->remark = $request->remark;
        $redpack->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.redpack.addsucceed'), 'url' => route('admin.extend.redpack.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.redpack.addsucceed'), 'url' => route('admin.extend.redpack.index')]);
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
        $redpack = CommonRedpackModel::findOrFail($id);
        return view('admin.extend.redpack.show', ['redpack' => $redpack]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $redpack = CommonRedpackModel::findOrFail($id);
        return view('admin.extend.redpack.edit', ['redpack' => $redpack]);
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
        $redpack = CommonRedpackModel::findOrFail($id);
        $rules = array(
            'name' => 'required|max:60',
            'amount' => 'required|max:25500',
            'fullamount' => 'required|max:25500',
        );
        $messages = array(
            'name.required' => '红包名称不允许为空！',
            'name.max' => '红包名称必须小于 :max 个字符。',
            'amount.required' => '红包金额不允许为空！',
            'amount.max' => '红包金额必须小于 :max 。',
            'fullamount.required' => '红包满额不允许为空！',
            'fullamount.max' => '红包满额必须小于 :max 。',
        );
        $this->validate($request, $rules, $messages);

        $redpack->name = $request->name;
        $redpack->amount = $request->amount;
        $redpack->fullamount = $request->fullamount;
        $redpack->use_start = $request->use_start;
        $redpack->use_end = $request->use_end;
        $redpack->remark = $request->remark;
        $redpack->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.redpack.editsucceed'), 'url' => route('admin.extend.redpack.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.redpack.editsucceed'), 'url' => route('admin.extend.redpack.index')]);
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
        $redpack = CommonRedpackModel::findOrFail($id);
        $redpack->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonRedpackModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
