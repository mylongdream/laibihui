<?php

namespace App\Http\Controllers\Api\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlipayController extends Controller
{

    public function __construct()
    {
        //
    }

    public function callback(Request $request)
    {
        return 'username';
    }

    public function notify(Request $request)
    {
        return 'username';
    }
}
