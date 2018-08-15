<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Models\CommonSettingModel;
use App\Models\CommonUserModel;
use App\Models\CommonUserScoreModel;
use App\Models\WechatUserModel;
use EasyWeChat\Kernel\Messages\Text;

class ServerController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $app = app('wechat.official_account');
        $app->server->push(function($message){
            if ($message['MsgType'] == 'event') {
                $FunctionName = 'receiveEvent' . $message['Event'];
            } else {
                $FunctionName = 'receiveMsg' . $message['MsgType'];
            }
            return $this->$FunctionName($message);
        });

        return $app->server->serve();
    }

    private function receiveMsgtext($message) {

    }

    private function receiveEventsubscribe($message)
    {
        $app = app('wechat.official_account');
        $setting = CommonSettingModel::pluck('svalue', 'skey');
        $wxuser = WechatUserModel::where('openid', $message['FromUserName'])->first();
        if(!$wxuser || (!$wxuser->user_id && !$wxuser->has_subscribe)){
            $wxuser = WechatUserModel::firstOrCreate(['openid' => $message['FromUserName']]);
            $seek=mt_rand(0,9999).mt_rand(0,9999).mt_rand(0,9999); //12位
            $start=mt_rand(0,20);
            $password=strtoupper(substr(md5($seek),$start,8));
            $password=str_replace("0",chr(mt_rand(65,78)),$password);
            $user = new CommonUserModel();
            $user->username = uniqid();
            $user->password = bcrypt($password);
            $user->frozen_money = 100;
            $user->save();
            $user->username = 100000000 + $user->uid;
            $user->save();
            //发送注册成功模板消息
            $app->template_message->send([
                'touser' => $wxuser->openid,
                'template_id' => 'UGKJYmmuGUIo07dQFPS71KurESDmCpySPj153qwmMgY',
                'url' => '',
                'data' => [
                    'first' => '您好，你已经成功注册成为会员',
                    'keyword1' => $user->username,
                    'keyword2' => $password,
                    'remark' => '如有任何疑问，请回复咨询'
                ],
            ]);
            //推广注册
            $fromuid = $message['EventKey'];
            if ($fromuid && $fromuid != $user->uid){
                $fromuser = CommonUserModel::where('uid', $fromuid)->first();
                if ($fromuser) {
                    $user->fromuid = $fromuser->uid;
                    $user->fromupuid = $fromuser->fromuid;
                    $user->save();
                    $score = new CommonUserScoreModel();
                    $score->uid = $fromuser->uid;
                    $score->score = $setting['promotion_register'];
                    $score->remark = '推广注册得积分';
                    $score->save();
                    $fromuser->increment('score', $setting['promotion_register']);
                }
            }
            $wxuser->user_id = $user->uid;
            $wxuser->save();
            auth()->login($user, true);
        }
        if(!$wxuser->has_subscribe){
            $wxuser->has_subscribe = 1;
            $wxuser->save();
        }
        $getuser = $app->user->get($wxuser->openid);
        if($getuser){
            $wxuser->subscribe = $getuser['subscribe'];
            $wxuser->openid = $getuser['openid'];
            if($getuser['subscribe']){
                $wxuser->nickname = $getuser['nickname'];
                $wxuser->sex = $getuser['sex'];
                $wxuser->city = $getuser['city'];
                $wxuser->province = $getuser['province'];
                $wxuser->headimgurl = $getuser['headimgurl'];
                $wxuser->subscribe_time = $getuser['subscribe_time'];
                $wxuser->unionid = isset($getuser['unionid']) ? $getuser['unionid'] : '';
            }
            $wxuser->save();
        }
        $text = new Text('您好！欢迎关注我们。');
        return $text;
    }

    private function receiveEventunsubscribe($message) {
        $wxuser = WechatUserModel::where('openid', $message['FromUserName'])->first();
        if(!$wxuser){
            $wxuser->subscribe = 0;
            $wxuser->save();
        }

    }

    private function receiveEventscan($message) {
        $setting = CommonSettingModel::pluck('svalue', 'skey');
        $wxuser = WechatUserModel::firstOrCreate(['openid' => $message['FromUserName']]);



    }

    private function receiveEventclick($message) {



    }
}