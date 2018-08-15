<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\CommonFaqCategoryModel;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function faq(Request $request){
        $faqcategory = CommonFaqCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('brand.about.faq', ['faqcategory' => $faqcategory]);
    }

    public function join(Request $request){
        return view('brand.about.join');
    }

    public function legal(Request $request){
        return view('brand.about.legal');
    }

    public function contact(Request $request){
        return view('brand.about.contact');
    }
}
