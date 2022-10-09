<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WishMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->route()->parameter('wish')) {
            return $next($request);
        }

        if ($request->route()->parameter('wish')->user_id == auth()->id()) {
            return $next($request);
        }

        abort(404);
    }
}
