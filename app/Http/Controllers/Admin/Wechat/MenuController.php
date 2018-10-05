<?php

namespace App\Http\Controllers\Admin\Wechat;

use App\Http\Controllers\Controller;
use App\Models\WechatMenuModel;
use App\Models\WechatTagModel;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    protected $menutype = [
        'click' => '点击推事件',
        'view' => '跳转URL',
        'miniprogram' => '关联小程序',
        'scancode_push' => '扫码推事件',
        'scancode_waitmsg' => '扫码推事件且弹出“消息接收中”提示框',
        'pic_sysphoto' => '弹出系统拍照发图',
        'pic_photo_or_album' => '弹出拍照或者相册发图',
        'pic_weixin' => '弹出微信相册发图器',
        'location_select' => '弹出地理位置选择器',
    ];

    public function __construct()
    {
        view()->share(['menutype' => $this->menutype]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taglist = WechatTagModel::orderBy('id', 'asc')->get();
        $menulist = WechatMenuModel::where(function($query) use($request) {
            $tag_id = intval($request->tag_id) ? intval($request->tag_id) : 0;
            $query->where('tag_id', $tag_id);
        })->orderBy('displayorder', 'asc')->get();
        return view('admin.wechat.menu.index', ['menulist' => category_tree($menulist), 'taglist' => $taglist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $menulist = WechatMenuModel::where(function($query) use($request) {
            $tag_id = intval($request->tag_id) ? intval($request->tag_id) : 0;
            $query->where('tag_id', $tag_id);
        })->orderBy('displayorder', 'asc')->get();
        return view('admin.wechat.menu.create', ['menulist' => category_tree($menulist)]);
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
            'name.required' => '菜单名不允许为空！',
            'name.max' => '菜单名必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $menu = new WechatMenuModel;
        $menu->tag_id = intval($request->tag_id) ? intval($request->tag_id) : 0;
        $menu->parentid = intval($request->parentid);
        $menu->name = $request->name;
        $menu->type = $request->type;
        $menu->displayorder = intval($request->displayorder);
        if($menu->type == 'click'){
            $menu->keyword = $request->click['keyword'];
        }elseif ($menu->type == 'view'){
            $menu->url = $request->view['url'];
        }elseif ($menu->type == 'miniprogram'){
            $menu->url = $request->miniprogram['url'];
            $menu->appid = $request->miniprogram['appid'];
            $menu->pagepath = $request->miniprogram['pagepath'];
        }elseif ($menu->type == 'media_id'){
            $menu->media_id = $request->media_id['media_id'];
        }elseif ($menu->type == 'view_limited'){
            $menu->media_id = $request->view_limited['media_id'];
        }
        $menu->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.wechat.menu.addsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.wechat.menu.addsucceed'), 'url' => back()->getTargetUrl()]);
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
        $menu = WechatMenuModel::findOrFail($id);
        return view('admin.wechat.menu.show', ['menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $menu = WechatMenuModel::findOrFail($id);
        $menulist = WechatMenuModel::where(function($query) use($request) {
            $tag_id = intval($request->tag_id) ? intval($request->tag_id) : 0;
            $query->where('tag_id', $tag_id);
        })->orderBy('displayorder', 'asc')->get();
        return view('admin.wechat.menu.edit', ['menu' => $menu, 'menulist' => category_tree($menulist)]);
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
        $menu = WechatMenuModel::findOrFail($id);
        $rules = array(
            'name' => 'required|max:50',
        );
        $messages = array(
            'name.required' => '菜单名不允许为空！',
            'name.max' => '菜单名必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $menu->parentid = intval($request->parentid);
        $menu->name = $request->name;
        $menu->type = $request->type;
        $menu->displayorder = intval($request->displayorder);
        if($menu->type == 'click'){
            $menu->keyword = $request->click['keyword'];
        }elseif ($menu->type == 'view'){
            $menu->url = $request->view['url'];
        }elseif ($menu->type == 'miniprogram'){
            $menu->url = $request->miniprogram['url'];
            $menu->appid = $request->miniprogram['appid'];
            $menu->pagepath = $request->miniprogram['pagepath'];
        }elseif ($menu->type == 'media_id'){
            $menu->media_id = $request->media_id['media_id'];
        }elseif ($menu->type == 'view_limited'){
            $menu->media_id = $request->view_limited['media_id'];
        }
        $menu->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.wechat.menu.editsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.wechat.menu.editsucceed'), 'url' => back()->getTargetUrl()]);
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
        $menu = WechatMenuModel::findOrFail($id);
        $menu->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.wechat.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.wechat.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            WechatMenuModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.wechat.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.wechat.menu.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }elseif ($request->operate == 'updatesubmit'){
            if(is_array($request->displayorder)) {
                foreach($request->displayorder as $id => $order) {
                    WechatMenuModel::where('id', $id)->update(['displayorder' => intval($order)]);
                }
            }
            if(is_array($request->name)) {
                foreach($request->name as $id => $name) {
                    WechatMenuModel::where('id', $id)->update(['name' => $name]);
                }
            }
            if ($request->ajax()) {
                return response()->json(['status' => 1, 'info' => trans('admin.wechat.menu.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.wechat.menu.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function publish(Request $request)
    {
        $tag_id = intval($request->tag_id) ? intval($request->tag_id) : 0;
        $menulist = WechatMenuModel::where('tag_id', $tag_id)->orderBy('displayorder', 'asc')->get();
        if(!$menulist) {
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'info' => '菜单数据错误，无法发布', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 0, 'info' => '菜单数据错误，无法发布', 'url' => back()->getTargetUrl()]);
            }
        }
        $pubmenu = [];
        foreach($menulist as $key => $value) {
            if(!$value->parentid) {
                $sub_button = [];
                foreach($menulist as $k => $val) {
                    if($val->parentid == $value->id) {
                        $item = [
                            'type' => $val->type,
                            'name' => $val->name
                        ];
                        if($val->type == 'view') {
                            $item['url'] = $val->url;
                        }elseif($val->type == 'miniprogram') {
                            $item['url'] = $val->url;
                            $item['appid'] = $val->appid;
                            $item['pagepath'] = $val->pagepath;
                        }else{
                            $item['key'] = $val->type.$val->id;
                        }
                        $sub_button[] = $item;
                        unset($menulist[$k]);
                    }
                }
                if($sub_button){
                    $item = [
                        'name' => $value->name,
                        'sub_button' => $sub_button
                    ];
                }else{
                    $item = [
                        'type' => $value->type,
                        'name' => $value->name
                    ];
                    if($value->type == 'view') {
                        $item['url'] = $value->url;
                    }elseif($value->type == 'miniprogram') {
                        $item['url'] = $value->url;
                        $item['appid'] = $value->appid;
                        $item['pagepath'] = $value->pagepath;
                    }else{
                        $item['key'] = $value->type.$value->id;
                    }
                }
                $pubmenu[] = $item;
            }
        }
        dd($pubmenu);
        $app = app('wechat.official_account');
        if($tag_id){
            $app->menu->create($pubmenu, ['tag_id' => $tag_id]);
        }else{
            $app->menu->create($pubmenu);
        }
        if ($request->ajax()) {
            return response()->json(['status' => 1, 'info' => trans('admin.wechat.menu.publishsucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => 1, 'info' => trans('admin.wechat.menu.publishsucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
