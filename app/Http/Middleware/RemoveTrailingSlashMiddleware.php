<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RemoveTrailingSlashMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (preg_match('/.+\/$/', $request->getRequestUri())) {
            return Redirect::to(rtrim($request->getRequestUri(), '/'), 301);
        }

        return $next($request);
    }
}
