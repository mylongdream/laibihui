<?php

namespace App\Http\Controllers\Subweb;

use App\Http\Controllers\Controller;
use App\Http\Models\HomeCommunityModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommunityController extends Controller
{
    public function index(){

        $communitys = HomeCommunityModel::orderBy('created_at', 'desc')->paginate(15);
        return view('subweb.community.index', ['communitys' => $communitys]);
    }
    public function detail(Request $request){
        $community = HomeCommunityModel::where('community_id', $request->id)->firstOrFail();
        return view('subweb.community.detail')->with('community', $community);
    }
}
