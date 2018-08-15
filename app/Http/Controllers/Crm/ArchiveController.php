<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\BrandShopModel;
use App\Models\BrandShopArchiveModel;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{

    public function __construct()
    {
        view()->share('curmenu', 'shop');
    }

    public function index(Request $request)
    {
        if(!in_array($request->type, array('passed', 'auditing', 'rejected'))){
            return response()->redirectToRoute('crm.archive.index', ['type' => 'auditing']);
        }
        $BrandShopArchiveModel = new BrandShopArchiveModel;
        $archives = $BrandShopArchiveModel->where('uid', auth('crm')->user()->uid)->where(function($query) use($request) {
            if($request->type == 'passed'){
                $query->where('status', 1);
            }elseif($request->type == 'auditing'){
                $query->where('status', 0);
            }elseif($request->type == 'rejected'){
                $query->where('status', 2);
            }
        })->latest()->paginate(20);
        return view('crm.archive.index', ['archives' => $archives]);
    }

    public function show($id)
    {
        $archive = BrandShopArchiveModel::where('uid', auth('crm')->user()->uid)->findOrFail($id);
        return view('crm.archive.show', ['archive' => $archive]);
    }

}
