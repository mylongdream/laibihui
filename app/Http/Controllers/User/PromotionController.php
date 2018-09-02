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

    public function first(Request $request)
    {
        if(!($request->bindcard && in_array($request->bindcard, array(1, 2)))){
            //return response()->redirectToRoute('user.promotion.first', ['bindcard' => 1]);
        }
        $usercount = collect();
        $usercount->hasCard = CommonUserModel::where('fromuid', auth()->user()->uid)->has('card')->count();
        $usercount->doesntHaveCard = CommonUserModel::where('fromuid', auth()->user()->uid)->doesntHave('card')->count();
        $promotions = CommonUserModel::where('fromuid', auth()->user()->uid)->where('username', 'like',"%".$request->username."%")->where(function($query) use($request) {
            if($request->bindcard == 1){
                $query->doesntHave('card');
            }elseif($request->bindcard == 2){
                $query->has('card');
            }
        })->latest()->paginate(20);
        return view('user.promotion.first', ['usercount' => $usercount, 'promotions' => $promotions]);
    }

    public function second(Request $request)
    {
        if(!($request->bindcard && in_array($request->bindcard, array(1, 2)))){
            //return response()->redirectToRoute('user.promotion.second', ['bindcard' => 1]);
        }
        $usercount = collect();
        $usercount->hasCard = CommonUserModel::where('fromupuid', auth()->user()->uid)->has('card')->count();
        $usercount->doesntHaveCard = CommonUserModel::where('fromupuid', auth()->user()->uid)->doesntHave('card')->count();
        $promotions = CommonUserModel::where('fromupuid', auth()->user()->uid)->where('username', 'like',"%".$request->username."%")->where(function($query) use($request) {
            if($request->bindcard == 1){
                $query->doesntHave('card');
            }elseif($request->bindcard == 2){
                $query->has('card');
            }
        })->latest()->paginate(20);
        return view('user.promotion.second', ['usercount' => $usercount, 'promotions' => $promotions]);
    }

}
