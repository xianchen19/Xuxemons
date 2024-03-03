<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'contraseña');
    
            // Buscar al usuario con el correo electrónico proporcionado
            $user = User::where('email', $credentials['email'])->first();
    
            // Verifica si hay un usuario y si la contraseña es correcta
              if ($user && $credentials['contraseña'] === $user->contraseña) {
                // La autenticación fue exitosa
                return response()->json(['message' => 'Login exitoso', 200]);
            }
    
            // Las credenciales son incorrectas
            return response()->json(['message' => 'Error al iniciar sesion', 404]);
        } catch (\Exception $e) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ha ocurrido un error al intentar iniciar sesión.'], 500);
        }
    }
    
}
