<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use View;
use DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Route;
use App\Models\Admin;

class AdminMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) { 
        
        $currentControoler  = class_basename(Route::current()->controller);      
        
        $currentPath = Route::currentRouteName(); //Route::getCurrentRoute()->getActionName();
        
        if (!in_array($currentPath, ['admin_login_get', 'admin_login_post'])) {

            if (!Request::cookie('adminid'))
                return Redirect::route('admin_login_get')->withErrors(__('login.login_first'));

            $admin = Admin::where('id', Request::cookie('adminid'))
                    ->select('*', DB::RAW("(CONCAT('" . env('IMAGE_URL') . "',profile_pic)) AS pic_url"))
                    ->first();
            if (!$admin)
                return Redirect::route('admin_login_get')->withErrors(__('login.login_first'));

            $time = new \DateTime('now', new \DateTimeZone($admin->timezone));
            $request['timezonez'] = $time->format('P');

            \Cookie::queue('adminid', $admin->id, 60);
            \Cookie::queue('admintz', $request['timezonez'], 60);

            \App::instance('admin', $admin);

            $request['timezone'] = $admin->timezone; 
            View::share('admin', $admin);
        }
        return $next($request);
    }

}
