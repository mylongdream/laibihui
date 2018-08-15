<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\BrandHistoryModel;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'history');
    }

    public function index(Request $request)
    {
        $historys = BrandHistoryModel::where('uid', auth()->user()->uid)->has('shop')->orderBy('updated_at', 'desc')->paginate(10);
        return view('mobile.user.history.index', ['historys' => $historys]);
    }

    public function delete(Request $request, $id)
    {
        $history = BrandHistoryModel::where('uid', auth()->user()->uid)->findOrFail($id);
        $history->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('user.history.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => trans('user.history.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
