<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonCardRewardModel;
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
        if(!($request->type && in_array($request->type, array(1, 2)))){
            return response()->redirectToRoute('admin.extend.reward.index', ['type' => 1]);
        }
        $rewardlist = CommonCardRewardModel::where(function($query) use($request) {
            if($request->type){
                $query->where('type', $request->type);
            }
        })->orderBy('created_at', 'desc')->get();
        return view('admin.extend.reward.index', ['rewardlist' => $rewardlist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {;
        return view('admin.extend.reward.create');
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
            'type' => 'required|numeric|min:1|max:2',
            'name' => 'required|min:2|max:50',
            'upimage' => 'required',
            'cardnum' => 'required|numeric|min:1',
        );
        $messages = array(
            'type.required' => '兑奖人群不允许为空！',
            'type.numeric' => '兑奖人群填写不正确。',
            'type.min' => '兑奖人群填写不正确。',
            'type.max' => '兑奖人群填写不正确。',
            'name.required' => '奖品名称不允许为空！',
            'name.min' => '奖品名称必须大于 :min 个字符。',
            'name.max' => '奖品名称必须小于 :max 个字符。',
            'upimage.required' => '奖品图片不允许为空！',
            'cardnum.required' => '所需卡数不允许为空！',
            'cardnum.numeric' => '所需卡数填写不正确。',
            'cardnum.min' => '所需卡数必须大于 :min 个。',
        );
        $this->validate($request, $rules, $messages);

        $reward = new CommonCardRewardModel;
        $reward->type = $request->type;
        $reward->name = $request->name;
        $reward->upimage = $request->upimage;
        $reward->cardnum = intval($request->cardnum);
        $reward->onsale = intval($request->onsale);
        $reward->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.reward.addsucceed'), 'url' => route('admin.extend.reward.index', ['type' => $reward->type])]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.reward.addsucceed'), 'url' => route('admin.extend.reward.index', ['type' => $reward->type])]);
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
        $reward = CommonCardRewardModel::findOrFail($id);
        return view('admin.extend.reward.show', ['reward' => $reward]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reward = CommonCardRewardModel::findOrFail($id);
        return view('admin.extend.reward.edit', ['reward' => $reward]);
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
        $reward = CommonCardRewardModel::findOrFail($id);
        $rules = array(
            'type' => 'required|numeric|min:1|max:2',
            'name' => 'required|min:2|max:50',
            'upimage' => 'required',
            'cardnum' => 'required|numeric|min:1',
        );
        $messages = array(
            'type.required' => '兑奖人群不允许为空！',
            'type.numeric' => '兑奖人群填写不正确。',
            'type.min' => '兑奖人群填写不正确。',
            'type.max' => '兑奖人群填写不正确。',
            'name.required' => '奖品名称不允许为空！',
            'name.min' => '奖品名称必须大于 :min 个字符。',
            'name.max' => '奖品名称必须小于 :max 个字符。',
            'upimage.required' => '奖品图片不允许为空！',
            'cardnum.required' => '所需卡数不允许为空！',
            'cardnum.numeric' => '所需卡数填写不正确。',
            'cardnum.min' => '所需卡数必须大于 :min 个。',
        );
        $this->validate($request, $rules, $messages);

        $reward->type = $request->type;
        $reward->name = $request->name;
        $reward->upimage = $request->upimage;
        $reward->cardnum = intval($request->cardnum);
        $reward->onsale = intval($request->onsale);
        $reward->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.reward.editsucceed'), 'url' => route('admin.extend.reward.index', ['type' => $reward->type])]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.reward.editsucceed'), 'url' => route('admin.extend.reward.index', ['type' => $reward->type])]);
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
        $reward = CommonCardRewardModel::findOrFail($id);
        $reward->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            CommonCardRewardModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.reward.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
