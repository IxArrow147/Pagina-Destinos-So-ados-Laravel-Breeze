<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario no está logueado O no es admin, lo pateamos
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Acceso denegado. Solo administradores.');
        }

        return $next($request);
    }
}