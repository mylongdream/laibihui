<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\CommonDistrictModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index(Request $request){
        $type = in_array($request->type, array('province', 'city', 'area', 'street')) ? $request->type : 'province';
        $upid = intval($request->upid);
        if($type == 'province'){
            $province = CommonDistrictModel::where('level', 1)->orderBy('displayorder', 'asc')->orderBy('id', 'asc')->get();
            return response()->json($province);
        }elseif($type == 'city'){
            $city = CommonDistrictModel::where('level', 2)->where('upid', $upid)->orderBy('displayorder', 'asc')->orderBy('id', 'asc')->get();
            return response()->json($city);
        }elseif($type == 'area'){
            $area = CommonDistrictModel::where('level', 3)->where('upid', $upid)->orderBy('displayorder', 'asc')->orderBy('id', 'asc')->get();
            return response()->json($area);
        }elseif($type == 'street'){
            $area = CommonDistrictModel::where('level', 4)->where('upid', $upid)->orderBy('displayorder', 'asc')->orderBy('id', 'asc')->get();
            return response()->json($area);
        }
    }
}
