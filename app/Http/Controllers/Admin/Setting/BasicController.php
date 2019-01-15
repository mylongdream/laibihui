<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\CommonFaqModel;
use App\Models\WechatMenuModel;
use App\Models\CommonSettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BasicController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index()
    {
        return view('admin.setting.basic.index');
    }

    public function update(Request $request)
    {
        $settings = $request->setting ? $request->setting : array();
        foreach($settings as $key => $value) {
            $setting = CommonSettingModel::firstOrNew(['skey' => $key]);
            //更新网站内容中网站名称
            if($setting->skey == 'sitename' && $setting->svalue != $value){
                $faqs = CommonFaqModel::orderBy('displayorder', 'asc')->get();
                foreach($faqs as $k => $v) {
                    $v->title = str_replace($setting->svalue, $value, $v->title);
                    $v->message = str_replace($setting->svalue, $value, $v->message);
                    $v->save();
                }
            }
            //更新微信菜单中的链接地址
            if($setting->skey == 'siteurl' && 1){
                $menus = WechatMenuModel::orderBy('displayorder', 'asc')->get();
                foreach($menus as $k => $v) {
                    $v->url = str_replace('http://zhihui.hztbg.com/', 'http://lbh.qzkdd.com/', $v->url);
                    $v->save();
                }
            }
            $setting->svalue = $value;
            $setting->save();
        }
        Cache::forget('setting');
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.setting.updatesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.setting.updatesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
