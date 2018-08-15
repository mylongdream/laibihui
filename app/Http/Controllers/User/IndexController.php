<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
;
use App\Models\BrandConsumeModel;
use App\Models\CommonAnnounceModel;
use App\Models\CommonFaqModel;
use App\Models\CommonUserSignModel;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'index');
    }

    public function index()
    {
        $setting = cache('setting');
        $todaysign = CommonUserSignModel::where('uid', auth()->user()->uid)->where('created_at', '>=', date('Ymd'))->first();
        $index = collect();
        $index->announces = CommonAnnounceModel::orderBy('created_at', 'desc')->get()->take(8);
        $index->consumes = BrandConsumeModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->get()->take(10);
        $index->faqs = CommonFaqModel::orderBy('displayorder', 'asc')->get()->take(10);
        return view('user.index', ['index' => $index, 'todaysign' => $todaysign]);
    }
}
