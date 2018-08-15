<?php

namespace App\Http\Controllers\Admin\Wechat;

use App\Http\Controllers\Controller;
use App\Models\WechatOwnervoteModel;
use App\Models\WechatOwnervoteShareModel;
use App\Models\WechatOwnervoteUserModel;
use App\Models\WechatOwnervoteVisitModel;
use App\Models\WechatOwnervoteVoteModel;
use App\Models\WechatUserModel;
use Illuminate\Http\Request;

class OwnervoteController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if($request->isMethod('POST')){
            $settings = $request->setting ? $request->setting : array();
            foreach($settings as $key => $value) {
                $setting = WechatOwnervoteModel::firstOrNew(['skey' => $key]);
                $setting->svalue = $value;
                $setting->save();
            }
            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => trans('admin.setting.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.setting.updatesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            $setting = WechatOwnervoteModel::pluck('svalue', 'skey');
            return view('admin.wechat.ownervote.index', ['setting' => $setting]);
        }
    }

    public function apply(Request $request)
    {
        $userlist = WechatOwnervoteUserModel::where(function($query) use($request) {
            if($request->nickname){
                $query->where('nickname', 'like',"%".$request->nickname."%");
            }
        })->where(function($query) use($request) {
            if($request->openid){
                $query->where('openid', 'like',"%".$request->openid."%");
            }
        })->latest()->paginate(20);
        return view('admin.wechat.ownervote.apply', ['userlist' => $userlist]);
    }

    public function vote(Request $request)
    {
        $votelist = WechatOwnervoteVoteModel::where(function($query) use($request) {
            if($request->nickname){
                $query->where('nickname', 'like',"%".$request->nickname."%");
            }
        })->where(function($query) use($request) {
            if($request->openid){
                $query->where('openid', 'like',"%".$request->openid."%");
            }
        })->latest()->paginate(20);
        return view('admin.wechat.ownervote.vote', ['votelist' => $votelist]);
    }

    public function visit(Request $request)
    {
        $visitlist = WechatOwnervoteVisitModel::where(function($query) use($request) {
            if($request->nickname){
                $query->where('nickname', 'like',"%".$request->nickname."%");
            }
        })->where(function($query) use($request) {
            if($request->openid){
                $query->where('openid', 'like',"%".$request->openid."%");
            }
        })->latest()->paginate(20);
        return view('admin.wechat.ownervote.visit', ['visitlist' => $visitlist]);
    }

    public function share(Request $request)
    {
        $sharelist = WechatOwnervoteShareModel::where(function($query) use($request) {
            if($request->nickname){
                $query->where('nickname', 'like',"%".$request->nickname."%");
            }
        })->where(function($query) use($request) {
            if($request->openid){
                $query->where('openid', 'like',"%".$request->openid."%");
            }
        })->latest()->paginate(20);
        return view('admin.wechat.ownervote.share', ['sharelist' => $sharelist]);
    }
}
