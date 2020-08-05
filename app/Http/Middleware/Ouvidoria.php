<?php

namespace App\Http\Middleware;

use App\Models\TokenApi;
use Closure;
use Illuminate\Support\Str;

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
        $authorization = $request->header('Authorization');

        if (is_null($authorization)) {
            return response()->json([
                'error' => [
                    'Authorization Key not Found'
                ]
            ], 401);
        }
        if (!Str::contains($authorization, 'Bearer ')) {
            return response()->json([
                'error' => [
                    'Authorization Key format not correctly'
                ]
            ], 401);
        }

        [, $access_token] = explode('Bearer ', $authorization);

        $user = TokenApi::where(['token' => $access_token])->get();

        if (is_null($user)) {
            return response()->json([
                'error' => [
                    'Token expiraded or incorrectly'
                ]
            ], 401);
        }

        return $next($request);
    }
}
