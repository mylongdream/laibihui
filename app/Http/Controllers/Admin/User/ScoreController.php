<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUserModel;
use App\Models\CommonUserScoreModel;
use Illuminate\Http\Request;


class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $scorelist = CommonUserScoreModel::latest()->paginate(20);
        return view('admin.user.score.index', ['scorelist' => $scorelist]);
    }

    public function create()
    {
        return view('admin.user.score.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required|exists:common_user',
            'score' => 'required',
            'remark' => 'required|max:255',
        );
        $messages = array(
            'username.required' => '用户名不允许为空！',
            'username.exists' => '用户名不存在！',
            'score.required' => '积分数不允许为空！',
            'remark.required' => '备注信息不允许为空！',
            'remark.max' => '备注信息必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $user = CommonUserModel::where('username', $request->username)->first();
        $givescore = $request->score;

        $score = new CommonUserScoreModel;
        $score->uid = $user->uid;
        $score->score = $givescore;
        $score->remark = $request->remark;
        $score->postip = $request->getClientIp();
        $score->save();
        $user->increment('score', $givescore);

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.user.score.addsucceed'), 'url' => route('admin.user.score.index')]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.user.score.addsucceed'), 'url' => route('admin.user.score.index')]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $score = CommonUserModel::findOrFail($id);
        $score->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.user.score.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.user.score.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonUserScoreModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.user.score.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.user.score.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
