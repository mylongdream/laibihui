<?php

namespace App\Http\Controllers\Subweb;

use App\Http\Controllers\Controller;
use App\Http\Models\CommonAttrFromModel;
use App\Http\Models\HomeDesignerModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class DesignerController extends Controller
{
    public function index(){
		$attrs = array();
		$designer_attr = CommonAttrFromModel::where('from_key', 'designer')->first();
		if($designer_attr){
			$attrs = $designer_attr->attrs()->where('filter', '0')->orderBy('displayorder', 'asc')->get();
        	foreach ($attrs as $attr) {
            	$attr->values = $attr->values()->orderBy('displayorder', 'asc')->get();
        	}
        }
        $designers = HomeDesignerModel::orderBy('created_at', 'desc')->paginate(15);
        return view('subweb.designer.index', ['attrs' => $attrs, 'designers' => $designers]);
    }
    public function detail(Request $request){
        $designer = HomeDesignerModel::where('designer_id', $request->id)->firstOrFail();
        return view('subweb.designer.detail')->with('designer', $designer);
    }
}
