<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\BrandAllocationModel;
use App\Models\BrandGiftcardModel;
use Illuminate\Http\Request;


class GiftcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = BrandGiftcardModel::has('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.brand.giftcard.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $info = BrandGiftcardModel::findOrFail($id);
        return view('admin.brand.giftcard.show', ['info' => $info]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = BrandGiftcardModel::findOrFail($id);
        $user->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.giftcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.brand.giftcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandGiftcardModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.giftcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.brand.giftcard.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
