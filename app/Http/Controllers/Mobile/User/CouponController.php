<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
use App\Models\CommonUserCouponModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'coupon');
    }

    public function index(Request $request)
    {

        $coupons = CommonUserCouponModel::where('uid', auth()->user()->uid)->where(function($query) use($request) {
            $status = in_array($request->status, array("0", "1", "2")) ? $request->status : 0;
            if($status == 1){
                $query->whereNull('used_at')->whereDate('use_end', '>=', Carbon::now());
            }else if($status == 2){
                $query->whereNotNull('used_at');
            }else{
                $query->whereNull('used_at')->whereDate('use_end', '<', Carbon::now());
            }
            $request->offsetSet('status', $status);
        })->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.user.coupon.index', ['coupons' => $coupons]);
    }
}
