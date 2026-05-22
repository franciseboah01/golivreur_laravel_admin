<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ZoneFilterMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $admin = auth('admin')->user();

        if ($admin && $admin->zone_id) {
            // Admin de ville : injecter zone_id dans toutes les requêtes
            $request->merge(['zone_id' => $admin->zone_id]);
        }

        return $next($request);
    }
}