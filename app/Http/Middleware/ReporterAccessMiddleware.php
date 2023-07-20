<?php

namespace App\Http\Middleware;

use Closure;

class ReporterAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'Reporter') {
            return redirect()->back()->with('message', 'Access denied. You do not have permission to view this page.');
        }

        return $next($request);
    }
}
