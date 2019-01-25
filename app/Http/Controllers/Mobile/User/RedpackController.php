<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
use App\Models\CommonUserRedpackModel;
use Illuminate\Http\Request;

class RedpackController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'redpack');
    }

    public function index(Request $request)
    {
        $redpacks = CommonUserRedpackModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.user.redpack.index', ['redpacks' => $redpacks]);
    }
}
