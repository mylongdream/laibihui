<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\BrandShopArchiveModel;
use Illuminate\Http\Request;


class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = BrandShopArchiveModel::orderBy('created_at', 'desc')->get();
        return view('admin.crm.archive.index', ['list' => $list]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $archive = BrandShopArchiveModel::findOrFail($id);
        return view('admin.crm.archive.show', ['archive' => $archive]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archive = BrandShopArchiveModel::findOrFail($id);
        return view('admin.crm.archive.edit', ['archive' => $archive]);
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
        $archive = BrandShopArchiveModel::findOrFail($id);
        $rules = array(
            'status' => 'required|numeric|min:1|max:2',
            'reason' => 'required_if:status,2|max:255',
        );
        $messages = array(
            'status.required' => '审核状态不允许为空！',
            'status.numeric' => '审核状态选择错误！',
            'status.min' => '审核状态选择错误！',
            'status.max' => '审核状态选择错误！',
            'reason.required_if' => '不通过原因不允许为空！',
            'reason.max' => '不通过原因必须小于 :max 个字符！',
        );
        $this->validate($request, $rules, $messages);

        if ($request->status == 1){
            $shop = $archive->shop;
            $shop->upimage = $archive->upimage;
            $shop->upphoto = $archive->upphoto;
            $shop->message = $archive->message;
            $shop->save();
        }

        $archive->status = intval($request->status);
        $archive->reason = $request->reason;
        $archive->audited_at = time();
        $archive->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.archive.editsucceed'), 'url' => route('admin.crm.archive.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.archive.editsucceed'), 'url' => route('admin.crm.archive.index')]);
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
        $archive = BrandShopArchiveModel::findOrFail($id);
        $archive->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.archive.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.archive.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandShopArchiveModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.archive.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.archive.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
