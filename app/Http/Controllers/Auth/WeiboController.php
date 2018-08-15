<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class WeiboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Socialite::with('weibo')->redirect();
    }

    public function callback()
    {
        //$user = Socialite::driver('weixinweb')->user();
        return view('auth.weibo.callback');
    }

    public function login()
    {
        $user = Socialite::driver('weibo')->user();
    }

    public function register()
    {
        $user = Socialite::driver('weibo')->user();
    }

}
