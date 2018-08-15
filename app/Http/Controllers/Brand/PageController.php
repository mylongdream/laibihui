<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\CommonSubwebModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    public function allcity(){
        $hotsubwebs = CommonSubwebModel::where('ifhot', '1')->orderBy('displayorder', 'asc')->get();
        $allsubweb = CommonSubwebModel::orderBy('displayorder', 'asc')->get();
        $allsubwebs = array();
        foreach ($allsubweb as $subweb) {
            if ($subweb->firstletter){
                $allsubwebs[strtoupper($subweb->firstletter)][] = $subweb;
            }
        }
        return view('home.page.subweb', ['hotsubwebs' => $hotsubwebs, 'allsubwebs' => $allsubwebs]);
    }

    public function package(){
        return view('home.page.package');
    }

    public function tequanka(){
        return view('home.page.tequanka');
    }

    public function cttx(){
        return view('home.page.cttx');
    }
}
