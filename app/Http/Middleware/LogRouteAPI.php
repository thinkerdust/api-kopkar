<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\LoggingAPI;

class LogRouteAPI
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
        $response = $next($request);
        LoggingAPI::create([
            'uri' => $request->getUri(),
            'method' => $request->getMethod(),
            'request' => json_encode($request->all()),
            'response' => $response->getContent(),
            'ip' => $request->ip(),
            'user_id' => auth()->check() ? auth()->user()->id : 0,
        ]);

        // Log::info($request->getUri());

        return $next($request);
    }
}
