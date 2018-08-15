<?php

namespace App\Http\Controllers\Admin\Tool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DatabaseController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.tool.database.index');
    }

}
