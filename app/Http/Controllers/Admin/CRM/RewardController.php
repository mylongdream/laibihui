<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\CrmRewardModel;
use Illuminate\Http\Request;


class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rewardlist = CrmRewardModel::orderBy('created_at', 'desc')->get();
        return view('admin.crm.reward.index', ['rewardlist' => $rewardlist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {;
        return view('admin.crm.reward.create');
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
            'name' => 'required|min:2|max:50',
            'upimage' => 'required',
            'cardnum' => 'required|numeric|min:1',
        );
        $messages = array(
            'name.required' => '奖品名称不允许为空！',
            'name.min' => '奖品名称必须大于 :min 个字符。',
            'name.max' => '奖品名称必须小于 :max 个字符。',
            'upimage.required' => '奖品图片不允许为空！',
            'cardnum.required' => '所需卡数不允许为空！',
            'cardnum.numeric' => '所需卡数填写不正确。',
            'cardnum.min' => '所需卡数必须大于 :min 个。',
        );
        $this->validate($request, $rules, $messages);

        $reward = new CrmRewardModel;
        $reward->name = $request->name;
        $reward->upimage = $request->upimage;
        $reward->cardnum = intval($request->cardnum);
        $reward->onsale = intval($request->onsale);
        $reward->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.reward.addsucceed'), 'url' => route('admin.crm.reward.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.reward.addsucceed'), 'url' => route('admin.crm.reward.index')]);
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
        $reward = CrmRewardModel::findOrFail($id);
        return view('admin.crm.reward.show', ['reward' => $reward]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reward = CrmRewardModel::findOrFail($id);
        return view('admin.crm.reward.edit', ['reward' => $reward]);
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
        $reward = CrmRewardModel::findOrFail($id);
        $rules = array(
            'name' => 'required|min:2|max:50',
            'upimage' => 'required',
            'cardnum' => 'required|numeric|min:1',
        );
        $messages = array(
            'name.required' => '奖品名称不允许为空！',
            'name.min' => '奖品名称必须大于 :min 个字符。',
            'name.max' => '奖品名称必须小于 :max 个字符。',
            'upimage.required' => '奖品图片不允许为空！',
            'cardnum.required' => '所需卡数不允许为空！',
            'cardnum.numeric' => '所需卡数填写不正确。',
            'cardnum.min' => '所需卡数必须大于 :min 个。',
        );
        $this->validate($request, $rules, $messages);

        $reward->name = $request->name;
        $reward->upimage = $request->upimage;
        $reward->cardnum = intval($request->cardnum);
        $reward->onsale = intval($request->onsale);
        $reward->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.reward.editsucceed'), 'url' => route('admin.crm.reward.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.reward.editsucceed'), 'url' => route('admin.crm.reward.index')]);
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
        $reward = CrmRewardModel::findOrFail($id);
        $reward->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.crm.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CrmRewardModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.crm.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.crm.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
