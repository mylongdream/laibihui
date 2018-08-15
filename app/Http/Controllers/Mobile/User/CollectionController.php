<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;

use App\Models\BrandCollectionModel;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'collection');
    }

    public function index(Request $request)
    {
        $collections = BrandCollectionModel::where('uid', auth()->user()->uid)->has('shop')->latest()->paginate(10);
        return view('mobile.user.collection.index', ['collections' => $collections]);
    }

    public function delete(Request $request, $id)
    {
        $collection = BrandCollectionModel::where('uid', auth()->user()->uid)->findOrFail($id);
        $collection->delete();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('user.collection.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.mobile.message', ['status' => 1, 'info' => trans('user.collection.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
