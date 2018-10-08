<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MCRMAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'crm')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('mobile.crm.login', ['ReturnUrl' => $request->getUri()]);
            }
        }
        if (Auth::guard($guard)->user()->group->type != 'crm') {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '你没有权限进入']);
            }else{
                return response()->view('layouts.mobile.message', ['status' => 0, 'info' => '你没有权限进入']);
            }
        }
        //dd($request->route());
        return $next($request);
    }
}
