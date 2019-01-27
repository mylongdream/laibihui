<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\CommonUserModel;
use App\Models\CommonUserCouponModel;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'coupon');
    }

    public function index(Request $request)
    {
        $coupons = CommonUserCouponModel::where('uid', auth()->user()->uid)->orderBy('created_at', 'desc')->paginate(20);
        return view('mobile.user.coupon.index', ['coupons' => $coupons]);
    }
}
