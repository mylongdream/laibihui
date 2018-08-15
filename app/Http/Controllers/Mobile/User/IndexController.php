<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\BrandConsumeModel;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'user');
    }

    public function index()
    {
        $setting = Cache::get('setting');
        $index = collect();
        $index->consumes = BrandConsumeModel::orderBy('created_at', 'desc')->get()->take(10);
        return view('mobile.user.index', ['index' => $index]);
    }

    public function setting()
    {
        return view('mobile.user.setting');
    }

    public function progress()
    {
        return view('mobile.user.progress');
    }
}
