<?php

namespace App\Http\Middleware;

use App\Models\BrandCategoryModel;
use App\Models\CommonNavModel;
use App\Models\CommonSettingModel;
use Closure;

class CheckWeb
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
        if (cache('setting')) {
            $setting = cache('setting');
        }else{
            $setting = CommonSettingModel::pluck('svalue', 'skey');
            cache(['setting'=>$setting], 300);
        }
        view()->share('setting', $setting);

        if (cache('navs')) {
            $navs = cache('navs');
        }else{
            $navs = CommonNavModel::get();
            cache(['navs'=>$navs], 300);
        }
        view()->share('navs', $navs);
        $categorylist = BrandCategoryModel::where('parentid', 0)->orderBy('displayorder', 'asc')->get();
        view()->share('categorylist', $categorylist);
        return $next($request);
    }
}
