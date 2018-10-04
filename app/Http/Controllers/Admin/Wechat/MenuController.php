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
        $message = isset($request->message[$request->type]) ? $request->message[$request->type] : '';
        $menu->message = $message ? serialize($message) : '';
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
        $menu->message = unserialize($menu->message);
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
        $message = isset($request->message[$request->type]) ? $request->message[$request->type] : '';
        $menu->message = $message ? serialize($message) : '';
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
                return response()->json(['status' => 1, 'info' => '菜单数据错误，无法发布', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 1, 'info' => '菜单数据错误，无法发布', 'url' => back()->getTargetUrl()]);
            }
        }
        foreach($menulist as $key => $value) {
            if(!$value->parentid) {
                $sub_button = [];
                foreach($menulist as $k => $val) {
                    if($val->parentid == $value->id) {
                        $val->message = $val->message ? unserialize($val->message) : '';
                        $sub_button[] = $val;
                        unset($menulist[$k]);
                    }
                }
                $value->sub_button = $sub_button;
                $value->message = $value->message ? unserialize($value->message) : '';
            }
        }
        $pubmenu = [];
        foreach($menulist as $button) {
            if(!$button['sub_button']) {
                if(!$button['name']) {
                    //$this->error('菜单中存在“菜单标题”为空的项目，无法发布');
                }
                if($button['type'] == 'view' && !$button['message']['url']) {
                    //$this->error('菜单中存在“网页链接”为空的项目，无法发布');
                }
                if($button['type'] == 'click' && !$button['message']['key']) {
                    //$this->error('菜单中存在“关键词”为空的项目，无法发布');
                }
                if($button['type'] == 'miniprogram') {
                    //!$button['message']['url'] && $this->error('菜单中存在“网页链接”为空的项目，无法发布');
                    //!$button['message']['appid'] && $this->error('菜单中存在“小程序appid”为空的项目，无法发布');
                    //!$button['message']['pagepath'] && $this->error('菜单中存在“小程序页面路径”为空的项目，无法发布');
                }
                $item = [
                    'type' => $button['type'],
                    'name' => $button['name']
                ];
                if($button['type'] == 'view') {
                    $item['url'] = $button['message']['url'];
                }elseif($button['type'] == 'miniprogram') {
                    $item['url'] = $button['message']['url'];
                    $item['appid'] = $button['message']['appid'];
                    $item['pagepath'] = $button['message']['pagepath'];
                }else{
                    $item['key'] = $button['type'].$button['id'];
                }
                $pubmenu[] = $item;
            } else {
                if(!$button['name']) {
                    //$this->error('菜单中存在“菜单标题”为空的项目，无法发布');
                }
                $sub_buttons = [];
                foreach($button['sub_button'] as $sub_button) {
                    if(!$sub_button['name']) {
                        //$this->error('菜单中存在“菜单标题”为空的项目，无法发布');
                    }
                    if($sub_button['type'] == 'view' && !$sub_button['message']['url']) {
                        //$this->error('菜单中存在“网页链接”为空的项目，无法发布');
                    }
                    if($sub_button['type'] == 'click' && !$sub_button['message']['key']) {
                        //$this->error('菜单中存在“关键词”为空的项目，无法发布');
                    }
                    if($sub_button['type'] == 'miniprogram') {
                        //!$sub_button['message']['url'] && $this->error('菜单中存在“网页链接”为空的项目，无法发布');
                        //!$sub_button['message']['appid'] && $this->error('菜单中存在“小程序appid”为空的项目，无法发布');
                        //!$sub_button['message']['pagepath'] && $this->error('菜单中存在“小程序页面路径”为空的项目，无法发布');
                    }
                    $item = [
                        'type' => $sub_button['type'],
                        'name' => $sub_button['name']
                    ];
                    if($sub_button['type'] == 'view') {
                        $item['url'] = $sub_button['message']['url'];
                    }elseif($sub_button['type'] == 'miniprogram') {
                        $item['url'] = $sub_button['message']['url'];
                        $item['appid'] = $sub_button['message']['appid'];
                        $item['pagepath'] = $sub_button['message']['pagepath'];
                    }else{
                        $item['key'] = $sub_button['type'].$sub_button['id'];
                    }
                    $sub_buttons[] = $item;
                }
                $item = [
                    'name' => $button['name'],
                    'sub_button' => $sub_buttons
                ];
                $pubmenu[] = $item;
            }
        }
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
