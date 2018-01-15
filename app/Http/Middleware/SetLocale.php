<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
class SetLocale
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
        $locale = '';
        if(in_array(Request::segment(1),Config::get('application.languages'))){
            $locale = Request::segment(1);
        }else{
            $locale = Config::get('application.language');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
