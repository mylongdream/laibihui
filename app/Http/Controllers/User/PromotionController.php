<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserCardModel;
use App\Models\CommonUserModel;
use Illuminate\Http\Request;
use Toplan\PhpSms\Facades\Sms;
use Vinkla\Hashids\Facades\Hashids;

class PromotionController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'promotion');
    }

    public function index(Request $request)
    {
        $promotion = route('promotion', ['fromuser' => Hashids::connection('promotion')->encode(auth()->user()->uid)]);
        return view('user.promotion.index', ['promotion' => $promotion]);
    }

    public function card(Request $request)
    {
        $CommonUserCardModel = new CommonUserCardModel;
        $promotions = $CommonUserCardModel->where(function($query) use($request) {
            if($request->lower){
                $query->where('fromupuid', auth()->user()->uid);
            }else{
                $query->where('fromuid', auth()->user()->uid);
            }
        })->where(function($query) use($request) {
            if($request->username){
                $uids = CommonUserModel::where('username', 'like',"%".$request->username."%")->pluck('uid');
                $query->whereIn('uid', $uids);
            }
        })->latest()->paginate(20);
        return view('user.promotion.card', ['promotions' => $promotions]);
    }

}
