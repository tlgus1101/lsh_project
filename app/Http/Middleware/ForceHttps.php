<?php

namespace App\Http\Middleware;

use Closure;

class ForceHttps
{
    public function handle($request, Closure $next) {
        //if ( $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http' ) {
        if (!$request->secure() && (env('APP_ENV') ==='prod' || env('APP_ENV') ==='production')) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}

