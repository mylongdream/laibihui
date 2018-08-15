<?php

namespace App\Http\Middleware;

use App\Models\CommonSubwebModel;
use Closure;

class CheckSubweb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        global $subweb;
        $subweb = CommonSubwebModel::where('domain', $request->domain)->first();
        if (empty($subweb)) {
            abort(404);
        }else{
            session(['subweb' => $subweb]);
        }
        view()->share('subweb', $subweb);
        return $next($request);
    }
}
