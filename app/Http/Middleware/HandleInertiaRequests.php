<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class HandleInertiaRequests
{
    public function handle(Request $request, \Closure $next)
    {
        return $next($request);
    }
}