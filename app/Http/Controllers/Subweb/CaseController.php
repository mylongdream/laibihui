<?php

namespace App\Http\Controllers\Subweb;

use App\Http\Controllers\Controller;
use App\Http\Models\CommonAttrFromModel;
use App\Http\Models\HomeCaseModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class CaseController extends Controller
{
    public function index(){
        $attrs = CommonAttrFromModel::where('from_key', 'case')->first()->attrs()->where('filter', '0')->orderBy('displayorder', 'asc')->get();
        foreach ($attrs as $attr) {
            $attr->values = $attr->values()->orderBy('displayorder', 'asc')->get();
        }
        $cases = HomeCaseModel::where('city_id', session('city')->city_id)->orderBy('created_at', 'desc')->paginate(15);
        return view('subweb.case.index', ['attrs' => $attrs, 'cases' => $cases]);
    }
    public function detail(Request $request){
        $case = HomeCaseModel::where('case_id', $request->id)->where('city_id', session('city')->city_id)->firstOrFail();
        $case->increment('viewnum');
        return view('subweb.case.detail')->with('case', $case);
    }
}
