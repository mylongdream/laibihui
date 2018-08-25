<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CommonUserAccountModel;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accountlist = CommonUserAccountModel::latest()->paginate(20);
        return view('admin.user.account.index', ['accountlist' => $accountlist]);
    }

    public function create()
    {
        return view('admin.user.account.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required|exists:common_user',
            'account' => 'required',
            'remark' => 'required|max:255',
        );
        $messages = array(
            'username.required' => '用户名不允许为空！',
            'username.exists' => '用户名不存在！',
            'account.required' => '积分数不允许为空！',
            'remark.required' => '备注信息不允许为空！',
            'remark.max' => '备注信息必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $user = CommonUserModel::where('username', $request->username)->first();
        $giveaccount = $request->account;

        $account = new CommonUserAccountModel;
        $account->uid = $user->uid;
        $account->account = $giveaccount;
        $account->remark = $request->remark;
        $account->postip = $request->getClientIp();
        $account->save();
        $user->increment('account', $giveaccount);

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.user.account.addsucceed'), 'url' => route('admin.user.account.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.user.account.addsucceed'), 'url' => route('admin.user.account.index')]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $account = CommonUserModel::findOrFail($id);
        $account->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.user.account.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.user.account.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonUserAccountModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.account.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.user.account.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
