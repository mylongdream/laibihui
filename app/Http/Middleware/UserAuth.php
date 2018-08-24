<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = '')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('login', ['ReturnUrl' => $request->getUri()]);
            }
        }
        $actions = $request->route()->getAction();
        $actions['as'] = isset($actions['as']) ? $actions['as'] : '';
        if(!auth()->user()->mobile && $actions['as'] != 'user.profile.mobile'){
            //return redirect()->route('user.profile.mobile');
        }
        return $next($request);
    }
}
