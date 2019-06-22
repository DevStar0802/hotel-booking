<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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

      $allowedOrigins = [env('FRONTEND_ENDPOINT', 'http://localhost:8080'), env('WORDPRESS_ENDPOINT', 'http://localhost'), env('EXTRA_ENDPOINT', 'http://127.0.0.1')];

      if($request->server('HTTP_ORIGIN')){
        if (in_array($request->server('HTTP_ORIGIN'), $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $request->server('HTTP_ORIGIN'))
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
                ->header('Access-Control-Allow-Headers', '*');
        }
      }


      return $next($request);

    }
}
