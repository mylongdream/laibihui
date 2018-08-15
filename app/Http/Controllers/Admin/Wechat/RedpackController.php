<?php

namespace App\Http\Controllers\Admin\Wechat;

use App\Http\Controllers\Controller;
use App\Models\WechatRedpackModel;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

class RedpackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redpacks = WechatRedpackModel::orderBy('id', 'asc')->paginate(12);
        return view('admin.wechat.redpack.index', ['redpacks' => $redpacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wechat.redpack.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = cache('setting');
        $options = [
            'app_id' => $setting['wechat_appid'],
            'payment' => [
                'merchant_id'        => $setting->wechat_mchid,
                'key'                => $setting->wechat_apikey,
                'cert_path'          => $setting->wechat_certpath,
                'key_path'           => $setting->wechat_keypath,
            ],
        ];
        $app = new Application($options);
        $luckyMoney = $app->lucky_money;
        $luckyMoneyData = [
            'mch_billno'       => 'xy123456',
            'send_name'        => '测试红包',
            're_openid'        => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num'        => 1,
            'total_amount'     => 100,
            'wishing'          => '祝福语',
            'client_ip'        => '192.168.0.1',
            'act_name'         => '测试活动',
            'remark'           => '测试备注',
        ];
        $result = $luckyMoney->sendNormal($luckyMoneyData);
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.wechat.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.wechat.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
        $redpack = WechatRedpackModel::findOrFail($id);
        $setting = cache('setting');
        $options = [
            'app_id' => $setting['wechat_appid'],
            'payment' => [
                'merchant_id'       => $setting['wechat_mchid'],
                'key'                => $setting['wechat_apikey'],
                'cert_path'         => storage_path('app/'.$setting['wechat_certpath']),
                'key_path'          => storage_path('app/'.$setting['wechat_keypath']),
            ],
        ];
        $app = new Application($options);
        $luckyMoney = $app->lucky_money;
        $billno = $luckyMoney->query($redpack->billno);
        return view('admin.wechat.redpack.detail', ['billno' => $billno]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $redpack = WechatRedpackModel::findOrFail($id);
        $redpack->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.wechat.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.wechat.redpack.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
