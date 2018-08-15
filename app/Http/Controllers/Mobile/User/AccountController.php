<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'account');
    }

    public function index(Request $request)
    {
        return view('mobile.user.account.index');
    }

}
