<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\BrandConsumeModel;
use Illuminate\Http\Request;

class ConsumeController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'consume');
    }

    public function index(Request $request)
    {
        $consumes = BrandConsumeModel::where('uid', auth()->user()->uid)->has('shop')->orderBy('created_at', 'desc')->paginate(10);
        return view('user.consume.index', ['consumes' => $consumes]);
    }

    public function show(Request $request, $id)
    {
        $consume = BrandConsumeModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('user.consume.show', ['consume' => $consume]);
    }

    public function pay(Request $request, $id)
    {
        $consume = BrandConsumeModel::where('uid', auth()->user()->uid)->where('order_sn', $id)->firstOrFail();
        return view('user.consume.show', ['consume' => $consume]);
    }

}
