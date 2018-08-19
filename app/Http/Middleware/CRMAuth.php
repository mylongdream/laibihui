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
        if (Auth::guard($guard)->user()->group->module == 'shangjia' && !Auth::guard($guard)->user()->shop) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '管理店铺不存在']);
            }else{
                return response()->view('layouts.crm.message', ['status' => 0, 'info' => '管理店铺不存在']);
            }
        }
        $actions = $request->route()->getAction();
        if (isset($actions['allow']) && $actions['allow']) {
            foreach ($actions['allow'] as $allow) {
                if (Auth::guard($guard)->user()->group->module == $allow) {
                    return $next($request);
                }
            }
            abort(404);
        }

        //dd($request->route());
        return $next($request);
    }
}
