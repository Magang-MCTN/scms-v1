<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if ($request->user() && in_array($request->user()->id_role, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
