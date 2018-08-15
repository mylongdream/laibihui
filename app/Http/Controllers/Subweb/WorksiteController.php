<?php

namespace App\Http\Controllers\Subweb;

use App\Http\Controllers\Controller;
use App\Http\Models\CommonAttrFromModel;
use App\Http\Models\HomeWorksiteModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class WorksiteController extends Controller
{
    public function index(){
		$attrs = array();
		$worksite_attr = CommonAttrFromModel::where('from_key', 'worksite')->first();
		if($worksite_attr){
		    $attrs = $worksite_attr->attrs()->where('filter', '0')->orderBy('displayorder', 'asc')->get();
            foreach ($attrs as $attr) {
                $attr->values = $attr->values()->orderBy('displayorder', 'asc')->get();
            }
        }
        $worksites = HomeWorksiteModel::orderBy('created_at', 'desc')->paginate(15);
        return view('subweb.worksite.index', ['attrs' => $attrs, 'worksites' => $worksites]);
    }
    public function detail(Request $request){
        $worksite = HomeWorksiteModel::where('worksite_id', $request->id)->firstOrFail();
        return view('subweb.worksite.detail')->with('worksite', $worksite);
    }
}
