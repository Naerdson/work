<?php

namespace App\Http\Middleware;

use Closure;

class Ouvidoria
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
        if($request->getClientIp() == '10.1.15.119' && $request->getPort() == '8082') {
            return $next($request);

        }

        return response()->json([
            'error' => 'Não autorizado'
        ], 401);
    }
}
