<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\CommonAnnounceModel;
use Illuminate\Http\Request;


class AnnounceController extends Controller
{
    public function index(){
        $announces = CommonAnnounceModel::orderBy('created_at', 'desc')->paginate(16);
        return view('brand.announce.index', ['announces' => $announces]);
    }

    public function show(Request $request){
        $announce = CommonAnnounceModel::where('id', $request->id)->firstOrFail();
        $announce->increment('viewnum');
        if($announce->jumpurl){
            header("HTTP/1.1 301 Moved Permanently");
            header("location: $announce->jumpurl");
        }
        return view('brand.announce.show', ['announce' => $announce]);
    }
}
