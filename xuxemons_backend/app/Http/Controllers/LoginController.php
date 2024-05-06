<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            // Validar las credenciales del usuario
            $credentials = $request->only('email', 'password');

            // Intentar autenticar al usuario
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // Obtener el rol del usuario
                $role = $user->role; // Suponiendo que el rol del usuario está almacenado en una columna llamada 'role' en la tabla de usuarios

                // Autenticación exitosa
                return response()->json(['message' => 'Inicio de sesión exitoso', 'role' => $role], 200);
            } else {
                // Credenciales inválidas
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
        } catch (\Exception $e) {
            // Manejar cualquier excepción
            return response()->json(['error' => 'Error al iniciar sesión: ' . $e->getMessage()], 500);
        }
    }

}
