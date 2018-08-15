<?php

namespace App\Http\Controllers\Mobile\Brand;

use App\Http\Controllers\Controller;
use App\Models\CommonFaqCategoryModel;
use App\Models\CommonFaqModel;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request){
        $faqcategory = CommonFaqCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('mobile.brand.faq.index', ['faqcategory' => $faqcategory]);
    }

    public function show(Request $request, $id){
        $faq = CommonFaqModel::findOrFail($id);
        return view('mobile.brand.faq.show', ['faq' => $faq]);
    }

}
