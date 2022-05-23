<?php

namespace App\Http\Middleware;

use Closure;

class AssetProviderMiddleware
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
        if (!$request->session()->exists('asset_provider_id')) {
            // id value cannot be found in session
            return redirect()->route('assetprovider.loginview');
        }
        return $next($request);
    }
}
