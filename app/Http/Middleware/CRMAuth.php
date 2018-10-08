<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CRMAuth
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
                return redirect()->route('crm.login');
            }
        }
        if (Auth::guard($guard)->user()->group->type != 'crm') {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '你没有权限进入']);
            }else{
                return response()->view('layouts.crm.message', ['status' => 0, 'info' => '你没有权限进入']);
            }
        }
        return $next($request);
    }
}
