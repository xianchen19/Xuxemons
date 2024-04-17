<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Obtener el correo electrónico de la solicitud
        $email = $request->header('email');

        // Buscar el usuario con el correo electrónico proporcionado
        $user = User::where('email', $email)->first(); // Añade first() para obtener el primer usuario que coincida

        // Verificar si se encontró un usuario y si su rol es 'administrador'
        if ($user && $user->role === 'administrador') {
            // Continuar con la solicitud si el usuario tiene el rol de administrador
            return $next($request);
        } else {
        // Responder con un error si el usuario no tiene el rol de administrador o si no se encontró un usuario
        return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);

        }

    }
}
