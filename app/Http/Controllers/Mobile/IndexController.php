<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;

use App\Models\CommonCardModel;
use App\Models\CommonSellcardModel;
use App\Models\CommonUserAccountModel;
use App\Models\CrmGrantsellModel;
use App\Models\CrmPersonnelModel;
use Illuminate\Http\Request;
use App\Models\BrandCategoryModel;
use App\Models\BrandShopModel;
use App\Models\CommonUserModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Vinkla\Hashids\Facades\Hashids;
use Yansongda\Pay\Pay;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'index');
    }

    public function index(Request $request)
    {
        $index = collect();
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();

        $catid = 2;//美食
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_food = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $catid = 11;//娱乐
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_yule = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $catid = 4;//美容化妆
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_meizhuang = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $catid = 31;//婚纱摄影
        $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
        $index->shops_hunqing = BrandShopModel::whereIn('catid', $incatid)->latest()->get()->take(15);

        $location = Cookie::get('location');
        if($location){
            $location = collect(json_decode($location));
            $location = $location['position'];
            $maplat = $location->lat;
            $maplng = $location->lng;
            $index->shops = BrandShopModel::select('*')->selectRaw('(2 * 6378.137* ASIN(SQRT(POW(SIN(PI()*('.$maplat.'-maplat)/360),2)+COS(PI()*'.$maplat.'/180)* COS(maplat * PI()/180)*POW(SIN(PI()*('.$maplng.'-maplng)/360),2)))) AS distance')->orderBy('distance', 'asc')->latest()->get()->take(30);
        }else{
            $index->shops = BrandShopModel::latest()->get()->take(30);
        }
        return view('mobile.index', ['index' => $index]);
    }

    public function search()
    {
        return view('mobile.search');
    }

    public function grantsell(Request $request)
    {
        if (!auth()->user()->group->grantsellcard) {
            return view('layouts.mobile.message', ['status' => 0, 'info' => '你没有开通授权办卡的权限']);
        }
        if ($request->fromuser && $fromuid = Hashids::connection('promotion')->decode($request->fromuser)){
            $fromuser = CommonUserModel::where('uid', $fromuid)->first();
            if ($fromuser) {
                if (!$fromuser->card) {
                    //return view('layouts.mobile.message', ['status' => 0, 'info' => '对方尚未绑卡，不能授权办卡']);
                }
                if ($request->isMethod('POST')) {
                    if($fromuser->personnel && !$fromuser->personnel->disabled){
                        return view('layouts.mobile.message', ['status' => 0, 'info' => '业务员'.($fromuser->personnel->topuser ? $fromuser->personnel->topuser->username : '').'已为TA开通卖卡']);
                    }
                    $grantsell = new CrmGrantsellModel;
                    $grantsell->uid = $fromuser->uid;
                    $grantsell->topuid = auth()->user()->uid;
                    $grantsell->realname = $request->realname;
                    $grantsell->mobile = $request->mobile;
                    $grantsell->age = $request->age;
                    $grantsell->idcard = $request->idcard;
                    $grantsell->province = $request->province;
                    $grantsell->city = $request->city;
                    $grantsell->idcardpic = $request->idcardpic;
                    $grantsell->grantpic = $request->grantpic;
                    $grantsell->postip = $request->getClientIp();
                    $grantsell->save();
                    if(!$fromuser->personnel){
                        $personnel = new CrmPersonnelModel;
                        $personnel->uid = $fromuser->uid;
                        $personnel->topuid = auth()->user()->uid;
                        $personnel->realname = $request->realname;
                        $personnel->mobile = $request->mobile;
                        $personnel->postip = $request->getClientIp();
                        $personnel->save();
                    }else{
                        $fromuser->personnel->disabled = 0;
                        $fromuser->personnel->topuid = auth()->user()->uid;
                        $fromuser->personnel->realname = $request->realname;
                        $fromuser->personnel->mobile = $request->mobile;
                        $fromuser->personnel->postip = $request->getClientIp();
                        $fromuser->personnel->created_at = time();
                        $fromuser->personnel->save();
                    }
                    return view('layouts.mobile.message', ['status' => 1, 'info' => '授权办卡功能开通成功']);
                }else{
                    return view('mobile.grantsell', ['fromuser' => $fromuser]);
                }
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '地址错误']);
            }
        }else{
            return view('layouts.mobile.message', ['status' => 0, 'info' => '地址错误']);
        }
    }

    public function sellcard(Request $request)
    {
        $fromuid = $request->fromuser ? Hashids::connection('promotion')->decode($request->fromuser) : 0;
        $fromuid = $fromuid ? $fromuid : 0;
        $fromuser = CommonUserModel::where('uid', $fromuid)->first();
        if(!$fromuser || !$fromuser->personnel){
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'info' => '地址错误', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.mobile.message', ['status' => 0, 'info' => '地址错误']);
            }
        }
        if ($request->isMethod('POST')) {
            if(empty($request->number)){
                return view('layouts.mobile.message', ['status' => 0, 'info' => '卡号不允许为空']);
            }
            $card = CommonCardModel::where('number', $request->number)->first();
            if(!$card){
                return view('layouts.mobile.message', ['status' => 0, 'info' => '卡号不存在']);
            }
            if($card->user){
                return view('layouts.mobile.message', ['status' => 0, 'info' => '卡号已被人绑定了']);
            }
            $sellorder = CommonSellcardModel::where('number', $request->number)->where('pay_status', '>', 0)->first();
            if($sellorder){
                return view('layouts.mobile.message', ['status' => 0, 'info' => '该卡号已经付款过了']);
            }
            //删除该卡号生成的未付款订单
            CommonSellcardModel::where('number', $request->number)->where('pay_status', 0)->delete();
            $sellorder = new CommonSellcardModel();
            $sellorder->uid = auth()->check() ? auth()->user()->uid : 0;
            $sellorder->fromuid = $fromuser->uid;
            $sellorder->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $sellorder->number = $request->number;
            $sellorder->order_amount = 10;
            $sellorder->postip = request()->getClientIp();
            //微信浏览器里
            if (strpos(request()->userAgent(), 'MicroMessenger') !== false){
                $sellorder->pay_type = 'wechat';
                $sellorder->save();
                $config = config('pay.alipay');
                $config['notify_url'] = route('api.alipay.consume.notify');
                $order = [
                    'out_trade_no' => $sellorder->order_sn,
                    'total_fee' => $sellorder->order_amount * 100,              // 订单金额，**单位：分**
                    'body' => '面对面办卡',                   // 订单描述
                    'spbill_create_ip' => request()->getClientIp(),       // 调用 API 服务器的 IP
                    'product_id' => '0',
                ];
                //return Pay::wechat($config)->wap($order);
            }
            //支付宝浏览器里
            if (strpos(request()->userAgent(), 'AlipayClient') !== false){
                $sellorder->pay_type = 'alipay';
                $sellorder->save();
                $config = config('pay.alipay');
                $config['notify_url'] = route('api.alipay.consume.notify');
                $config['return_url'] = route('api.alipay.consume.callback');
                $order = [
                    'out_trade_no' => $sellorder->order_sn,
                    'total_amount' => $sellorder->order_amount,
                    'subject'      => '面对面办卡',
                ];
                //return Pay::alipay($config)->wap($order);
            }
            //付款成功后回调
            $sellorder->pay_status = 1;
            $sellorder->pay_at = time();
            $sellorder->save();

            $user_account = new CommonUserAccountModel();
            $user_account->uid = $fromuser->uid;
            $user_account->user_money = 5;
            $user_account->remark = '面对面办卡提成';
            $user_account->postip = request()->getClientIp();
            $user_account->save();
            $fromuser->increment('user_money', 500);//提成5元到卖卡人员可用余额
            $fromuser->personnel->increment('sellnum');
            if($fromuser->personnel->topuser){
                $user_account = new CommonUserAccountModel();
                $user_account->uid = $fromuser->personnel->topuser->uid;
                $user_account->user_money = 0.5;
                $user_account->remark = '下线面对面办卡提成';
                $user_account->postip = request()->getClientIp();
                $user_account->save();
                $fromuser->personnel->topuser->increment('user_money', 50);//提成0.5元到业务员可用余额
            }

            return view('layouts.mobile.message', ['status' => 1, 'info' => '付款成功']);

            //return view('layouts.mobile.message', ['status' => 0, 'info' => '请用微信或支付宝支付']);
        }else{
            return view('mobile.sellcard', ['fromuser' => $fromuser]);
        }
    }

    public function promotion(Request $request)
    {
        if ($request->fromuser) {
            $fromuid = Hashids::connection('promotion')->decode($request->fromuser);
            if ($fromuid && $fromuser = CommonUserModel::where('uid', $fromuid)->first()) {
                if (strpos(request()->userAgent(), 'MicroMessenger') !== false){
                    $imgurl = 'user/qrcode_wx_'.$fromuser->uid.'.png';
                    $app = app('wechat.official_account');
                    $qrcode = $app->qrcode->forever($fromuser->uid);
                    $qrcode = $app->qrcode->url($qrcode['ticket']);
                    //$qrcode = file_get_contents($qrcode);
                    file_put_contents(storage_path('app/public/qrcode/'.$imgurl), $qrcode);
                    $qrcode = uploadQrcode($imgurl);
                    return view('mobile.promotion', ['fromuser' => $fromuser, 'qrcode' => $qrcode]);
                }else{
                    $cookie = cookie('promotion', $fromuser->uid, 1800);
                    return response()->redirectToRoute('mobile.index')->cookie($cookie);
                }
            }
        }
        return response()->redirectToRoute('mobile.index');
    }
}
