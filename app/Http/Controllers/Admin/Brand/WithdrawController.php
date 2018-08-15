<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandWithdrawModel;
use Illuminate\Http\Request;


class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $withdrawlist = BrandWithdrawModel::latest()->paginate(20);
        return view('admin.brand.withdraw.index', ['withdrawlist' => $withdrawlist]);
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
            BrandWithdrawModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.withdraw.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.brand.withdraw.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}