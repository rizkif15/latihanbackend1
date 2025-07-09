<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetSecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //return $next($request);
        $response = $next($request);

        // Tambahkan header X-Content-Type-Options
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Opsional: Anda juga bisa menambahkan header keamanan lain di sini
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Untuk Clickjacking protection
        $response->headers->set('X-XSS-Protection', '1; mode=block'); // Untuk XSS protection

        return $response;
    }
}
