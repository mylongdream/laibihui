<?php

namespace App\Http\Controllers\Admin\Wechat;

use App\Http\Controllers\Controller;
use App\Models\WechatTagModel;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $app = app('wechat.official_account');
        $tags = $app->user_tag->list();
        foreach ($tags['tags'] as $value){
            $tag = WechatTagModel::find($value['id']);
            if(!$tag){
                $tag = new WechatTagModel;
                $tag->id = $value['id'];
                $tag->name = $value['name'];
                $tag->count = $value['count'];
                $tag->save();
            }
        }
        $taglist = WechatTagModel::orderBy('id', 'asc')->get();
        return view('admin.wechat.tag.index', ['taglist' => $taglist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wechat.tag.create');
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
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '标签名不允许为空！',
            'name.max' => '标签名必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $app = app('wechat.official_account');
		$return = $app->user_tag->create($request->name);
        $wechat_tag = $return['tag'];

        $tag = new WechatTagModel;
        $tag->id = $wechat_tag['id'];
        $tag->name = $wechat_tag['name'];
        $tag->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.wechat.tag.addsucceed'), 'url' => route('admin.wechat.tag.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.wechat.tag.addsucceed'), 'url' => route('admin.wechat.tag.index')]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $tag = WechatTagModel::findOrFail($id);
        $tag->delete();
        $app = app('wechat.official_account');
		$app->user_tag->delete($id);
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.wechat.tag.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.wechat.tag.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
