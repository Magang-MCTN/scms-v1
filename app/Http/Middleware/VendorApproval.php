<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VendorApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->guard('web_vendor')->user()->role_id == 8 && !auth()->guard('web_vendor')->user()->approved) {
            return redirect('/')->with('error', 'Your account is pending approval.');
        }

        return $next($request);
    }
}
