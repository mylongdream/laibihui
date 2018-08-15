<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class WeixinWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Socialite::with('weixinweb')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('weixinweb')->user();
    }

}
