<?php

namespace App\Http\Controllers\Wechat;

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
        $this->setting = WechatOwnervoteModel::pluck('svalue', 'skey');
        $this->userinfo = session('wechat.oauth_user.default');
    }

    public function index(Request $request)
    {
        $userlist = WechatOwnervoteUserModel::where(function($query) use($request) {
            if($request->keyword){
                $query->where('name', 'like',"%".$request->keyword."%")->orWhere('id', $request->keyword);
            }
        })->latest()->paginate(20);
        $countdata = collect();
        $countdata->usernum = WechatOwnervoteUserModel::where('audit', 1)->count();
        $countdata->pollnum = WechatOwnervoteUserModel::where('audit', 1)->sum('pollnum');
        $countdata->viewnum = $this->setting['viewnum'];
        dd(session('wechat.oauth_user'));
        return view('wechat.ownervote.index', ['userlist' => $userlist]);
    }

    public function apply()
    {

        return view('wechat.ownervote.apply');
    }

    public function detail(Request $request, $id)
    {
        $voteuser = WechatOwnervoteUserModel::where('audit', 1)->find($id);
        $voteuser->hasvote = WechatOwnervoteVoteModel::where('user_id', $voteuser->id)->where('openid', $this->userinfo['openid'])->where('created_at', '>=', date('Ymd'))->first();
        return view('wechat.ownervote.detail', ['voteuser' => $voteuser]);
    }

    public function rank()
    {
        $usernum = 100;
        $userlist = WechatOwnervoteUserModel::where('audit', 1)->orderBy('pollnum', 'desc')->orderBy('created_at', 'asc')->take($usernum)->get();
        return view('wechat.ownervote.rank', ['usernum' => $usernum, 'userlist' => $userlist]);
    }

    public function vote(Request $request, $id)
    {
        if (isset($this->setting['subscribe']) && $this->setting['subscribe']) {
            $wxuser = WechatUserModel::where('openid', $this->userinfo['openid'])->where('subscribe', 1)->first();
            if(!$wxuser){

            }
        }
        $voteuser = WechatOwnervoteUserModel::where('audit', 1)->find($id);
        if(!$voteuser){

        }
        $voteinfo = WechatOwnervoteVoteModel::where('openid', $this->userinfo['openid'])->where('created_at', '>=', date('Ymd'))->first();
        if($voteinfo){

        }
        $vote = new WechatOwnervoteVoteModel();
        $vote->nickname = $this->userinfo['nickname'];
        $vote->headimgurl = $this->userinfo['headimgurl'];
        $vote->openid = $this->userinfo['openid'];
        $vote->user_id = $voteuser->id;
        $vote->postip = $request->getClientIp();
        $vote->save();

        $voteuser->increment('pollnum');
        return view('wechat.ownervote.index');
    }

    public function visit(Request $request)
    {
        $visit = new WechatOwnervoteVisitModel();
        $visit->nickname = $this->userinfo['nickname'];
        $visit->headimgurl = $this->userinfo['headimgurl'];
        $visit->openid = $this->userinfo['openid'];
        $visit->referer = $request->referer;
        $visit->postip = $request->getClientIp();
        $visit->save();
    }

    public function share(Request $request)
    {
        $share = new WechatOwnervoteShareModel();
        $share->nickname = $this->userinfo['nickname'];
        $share->headimgurl = $this->userinfo['headimgurl'];
        $share->openid = $this->userinfo['openid'];
        $share->shareto = $request->shareto;
        $share->postip = $request->getClientIp();
        $share->save();
    }
}
