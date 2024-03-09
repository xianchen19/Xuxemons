<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class rol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Verificar si el usuario está autenticado y tiene el rol de administrador
        if ($request->user() && $request->user()->role !== 'usuario') {
            return $next($request);
        }

        // Si el usuario no tiene el rol de administrador, redirigir o responder con un error
        return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);
    
    }
}
