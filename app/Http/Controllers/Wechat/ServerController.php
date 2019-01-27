<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Models\CommonSettingModel;
use App\Models\CommonUploadImageModel;
use App\Models\CommonUserModel;
use App\Models\CommonUserRedpackModel;
use App\Models\CommonUserScoreModel;
use App\Models\WechatLoginModel;
use App\Models\WechatMenuModel;
use App\Models\WechatUserModel;
use EasyWeChat\Kernel\Messages\Text;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    /**
     * @param $message
     * @return Text
     */
    private function receiveEventsubscribe($message)
    {
        $app = app('wechat.official_account');
        $setting = CommonSettingModel::pluck('svalue', 'skey');
        $wxuser = WechatUserModel::where('openid', $message['FromUserName'])->first();
        $SceneId = str_replace("qrscene_","",$message['EventKey']);
        if(!$wxuser || (!$wxuser->user_id && !$wxuser->has_subscribe)){
            $wxuser = WechatUserModel::firstOrCreate(['openid' => $message['FromUserName']]);
            $seek=mt_rand(0,9999).mt_rand(0,9999).mt_rand(0,9999); //12位
            $start=mt_rand(0,20);
            $password=strtoupper(substr(md5($seek),$start,8));
            $password=str_replace("0",chr(mt_rand(65,78)),$password);
            $user = new CommonUserModel();
            $data = array(
                'username' => uniqid(),
                'password' => $password,
            );
            $user = $user->register($data);
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
            if (is_numeric($fromuid = $SceneId) && $fromuid != $user->uid){
                $fromuser = CommonUserModel::where('uid', $fromuid)->first();
                if ($fromuser) {
                    $user->fromuid = $fromuser->uid;
                    $user->fromupuid = $fromuser->fromuid;
                    $user->save();
                    //推广注册得积分
                    if(isset($setting['promotion_register']) && $setting['promotion_register']){
                        $score = new CommonUserScoreModel();
                        $score->uid = $fromuser->uid;
                        $score->score = $setting['promotion_register'];
                        $score->remark = '推广注册得积分';
                        $score->save();
                        $fromuser->increment('score', $setting['promotion_register']);
                    }
                }
            }
            $wxuser->user_id = $user->uid;
            $wxuser->save();
            auth()->login($user, true);
            //更新用户信息
            $getuser = $app->user->get($wxuser->openid);
            if($getuser){
                $wxuser->subscribe = $getuser['subscribe'];
                $wxuser->openid = $getuser['openid'];
                if($getuser['subscribe']){
                    $wxuser->nickname = $getuser['nickname'];
                    $wxuser->sex = $getuser['sex'];
                    $wxuser->language = $getuser['language'];
                    $wxuser->city = $getuser['city'];
                    $wxuser->province = $getuser['province'];
                    $wxuser->country = $getuser['country'];
                    $wxuser->headimgurl = $getuser['headimgurl'];
                    $wxuser->subscribe_time = $getuser['subscribe_time'];
                    $wxuser->remark = $getuser['remark'];
                    $wxuser->groupid = isset($getuser['groupid']) ? $getuser['groupid'] : '';
                    $wxuser->unionid = isset($getuser['unionid']) ? $getuser['unionid'] : '';
                    $wxuser->tagid_list = $getuser['tagid_list'] ? serialize($getuser['tagid_list']) : '';
                    $wxuser->subscribe_scene = $getuser['subscribe_scene'];
                    $wxuser->qr_scene = $getuser['qr_scene'];
                    $wxuser->qr_scene_str = $getuser['qr_scene_str'];
                    //头像保存到本地并作为用户头像
                    if($wxuser->headimgurl){
                        try {
                            $client = new Client();
                            $fileName = 'wxlogo';
                            $filePath = 'image/'.date('Ym').'/'.date('d').'/'.date('His').strtolower(Str::random(16)).'.jpg';
                            $data = $client->request('get', $wxuser->headimgurl)->getBody()->getContents();
                            Storage::disk('public')->put($filePath, $data);
                            $uploadimage = new CommonUploadImageModel();
                            $uploadimage->filename = $fileName;
                            $uploadimage->description = $wxuser->headimgurl;
                            $uploadimage->filepath = str_replace('image/', '', $filePath);
                            $uploadimage->filesize = Storage::disk('public')->size($filePath);
                            $uploadimage->save();
                            //更新用户头像
                            $user->headimgurl = str_replace('image/', '', $filePath);
                            $user->save();
                        } catch (RequestException $e) {
                            //echo 'fetch fail';
                        }
                    }
                    $wxuser->subscribe_time = $getuser['subscribe_time'];
                    $wxuser->unionid = isset($getuser['unionid']) ? $getuser['unionid'] : '';
                }
                $wxuser->save();
            }
        }else{
            //更新微信菜单
            if($wxuser->user && $wxuser->user->group->tag_id){
                $app->user_tag->tagUsers([$wxuser->openid], $wxuser->user->group->tag_id);
                $wxuser->tagid_list = serialize([$wxuser->user->group->tag_id]);
                $wxuser->save();
                $WechatMenuModel = new WechatMenuModel;
                $result = $WechatMenuModel->publish($wxuser->user->group->tag_id);
            }
        }
        if(!$wxuser->has_subscribe){
            $wxuser->has_subscribe = 1;
            $wxuser->save();
        }
        //网页登录授权
        if($wxuser->user && !empty($SceneId) && strpos($SceneId, 'login_')!==false){
            $token = str_replace("login_","",$SceneId);
            $wechatLogin = WechatLoginModel::where('token', $token)->first();
            $wechatLogin->wechat_id = $wxuser->id;
            $wechatLogin->save();
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
        $SceneId = $message['EventKey'];

        //网页登录授权
        if($wxuser->user && !empty($SceneId) && strpos($SceneId, 'login_')!==false){
            $token = str_replace("login_","",$SceneId);
            $wechatLogin = WechatLoginModel::where('token', $token)->first();
            if($wechatLogin){
                $wechatLogin->wechat_id = $wxuser->uid;
                $wechatLogin->save();
            }
        }

    }

    private function receiveEventclick($message) {



    }

    private function receiveEventview($message) {



    }

    private function receiveEventtemplatesendjobfinish($message) {



    }
}
