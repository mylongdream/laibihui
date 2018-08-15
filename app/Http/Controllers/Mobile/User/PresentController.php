<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PresentController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'present');
    }

    public function index(Request $request)
    {
        return view('mobile.user.present.index');
    }

}
