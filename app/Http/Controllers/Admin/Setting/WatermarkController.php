<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\CommonSettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WatermarkController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index()
    {
        return view('admin.setting.watermark.index');
    }

    public function update(Request $request)
    {
        $settings = $request->setting ? $request->setting : array();
        foreach($settings as $key => $value) {
            $setting = CommonSettingModel::firstOrNew(['skey' => $key]);
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
