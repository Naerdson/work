<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class UsuarioAdministrator
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
        if(!Auth::user()->nivel_id != 3){
            return redirect()->route('admin/home')->with(['message' => 'Você não tem permissão de super administrador', 'type' => 'danger']);
        }

        return $next($request);
    }
}
