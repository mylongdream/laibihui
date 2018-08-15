<?php

namespace App\Http\Controllers\Subweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view('subweb.index');
    }
}
