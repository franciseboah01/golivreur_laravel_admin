<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, $permission = null)
    {
        if (!auth('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $admin = auth('admin')->user();

        if ($permission && !$admin->hasPermission($permission)) {
            abort(403, 'Accès non autorisé');
        }

        return $next($request);
    }
}