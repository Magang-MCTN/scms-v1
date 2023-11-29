<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPerwakilanDaftar
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
        $user = auth()->guard('web_vendor')->user();

        if (!$user || !$user->perwakilan_daftar) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Perwakilan belum didaftarkan.'], 403);
            }

            return redirect()->route('vendor-page.profile')->with('perwakilan_alert', true);
        }

        return $next($request);
    }
}
