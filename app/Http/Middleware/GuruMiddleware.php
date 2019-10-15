<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class GuruMiddleware
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
        if (preg_match("/^guru/i", $request->user()->level, $match)) {
            return $next($request);
        } else {
            return new Response(view('unauthorized')->with('role', 'guru'));
        }
    }
}
