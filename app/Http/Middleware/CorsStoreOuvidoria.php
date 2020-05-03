<?php

namespace App\Http\Middleware;

use Closure;

class CorsStoreOuvidoria
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
        return $next($request)
            ->header('Access-Control-Allow-Origin', "*")
            ->header('Access-Control-Allow-Methods', "POST,GET,OPTIONS,PUT,DELETE")
            ->header('Access-Control-Allow-Headers', "X-Requested-With, Content-Type, Accept, Content-Type, Origin, Authorization");
    }
}
