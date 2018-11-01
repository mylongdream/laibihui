<?php

namespace App\Http\Controllers\Mobile\Crm\Zhaoshang;

use App\Http\Controllers\Controller;
use App\Models\CrmVisitModel;
use Illuminate\Http\Request;

class VisitController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        view()->share('curmenu', 'visit');
    }

    public function index(Request $request)
    {
        $list = CrmVisitModel::where('uid', auth('crm')->user()->uid)->latest()->paginate(20);
        return view('mobile.crm.zhaoshang.visit.index', ['list' => $list]);
    }

    public function create(Request $request)
    {
        return view('mobile.crm.zhaoshang.visit.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'message' => 'required|max:150',
        );
        $messages = array(
            'message.required' => '随访记录内容不允许为空！',
            'message.max' => '随访记录内容必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $visit = new CrmVisitModel();
        $visit->uid = auth('crm')->user()->uid;
        $visit->message = $request->message;
        $visit->postip = request()->getClientIp();
        $visit->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '新增随访记录成功', 'url' => route('mobile.crm.zhaoshang.visit.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => '新增随访记录成功', 'url' => route('mobile.crm.zhaoshang.visit.index')]);
        }
    }

    public function show($id)
    {
        $visit = CrmVisitModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        return view('mobile.crm.zhaoshang.visit.show', ['visit' => $visit]);
    }

    public function edit($id)
    {
        $visit = CrmVisitModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        return view('mobile.crm.zhaoshang.visit.edit', ['visit' => $visit]);
    }

    public function update(Request $request, $id)
    {
        $visit = CrmVisitModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        $rules = array(
            'message' => 'required|max:150',
        );
        $messages = array(
            'message.required' => '随访记录内容不允许为空！',
            'message.max' => '随访记录内容必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $visit->uid = auth('crm')->user()->uid;
        $visit->message = $request->message;
        $visit->postip = request()->getClientIp();
        $visit->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '修改随访记录成功', 'url' => route('mobile.crm.zhaoshang.visit.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '修改随访记录成功', 'url' => route('mobile.crm.zhaoshang.visit.index')]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $visit = CrmVisitModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        $visit->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '删除记录成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => '删除记录成功', 'url' => back()->getTargetUrl()]);
        }
    }

}
