<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BindingController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'binding');
    }

    public function index()
    {
        return view('user.binding.index');
    }
}
