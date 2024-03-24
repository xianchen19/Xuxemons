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
                // Autenticación exitosa
                return response()->json(['message' => 'Inicio de sesión exitoso'], 200);
            } else {
                // Credenciales inválidas
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
        } catch (\Exception $e) {
            // Manejar cualquier excepción
            return response()->json(['error' => 'Error al iniciar sesion ' . $e->getMessage()], 404);
        }
    }
   /* {
        try {
            $credentials = $request->only('email', 'password');
    
            // Buscar al usuario con el correo electrónico proporcionado
            $user = User::where('email', $credentials['email'])->first();
    
            // Verifica si hay un usuario y si la contraseña es correcta
            if ($user && $credentials['password'] === $user->password) {
                // La autenticación fue exitosa
                return response()->json(['message' => 'Login exitoso', 200]);
           }
    
            // Las credenciales son incorrectas
            return response()->json(['message' => 'Error al iniciar sesion', 404]);
        } catch (\Exception $e) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ha ocurrido un error al intentar iniciar sesión.'], 500);
        }
    }*/
    
}
