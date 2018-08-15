<?php

namespace App\Http\Middleware;

use App\Models\CommonAdminMenuModel;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'admin')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('admin.login');
            }
        }

        $topmenus = CommonAdminMenuModel::where('parentid', 0)->orderBy('displayorder', 'asc')->get();
        $mainmenus = collect();
        foreach ($topmenus as $tmenu) {
            $mainmenus = $tmenu->children;
            foreach ($mainmenus as $cmenu) {
                $cmenulist = $cmenu->children;
                if($cmenu['route']){
                    if (starts_with($request->url(), route($cmenu['route']))){
                        $tmenu->current = 1;
                        $cmenu->current = 1;
                        break 2;
                    }
                }else{
                    foreach ($cmenulist as $smenu) {
                        if ($smenu['route'] && starts_with($request->url(), route($smenu['route']))){
                            $tmenu->current = 1;
                            $cmenu->current = 1;
                            $smenu->current = 1;
                            break 3;
                        }
                    }
                }
            }
        }
        view()->share('topmenu', $topmenus);
        view()->share('mainmenu', $mainmenus);
        return $next($request);
    }
}
