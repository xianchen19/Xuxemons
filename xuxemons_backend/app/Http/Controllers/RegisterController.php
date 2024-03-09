<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;



class RegisterController extends Controller
{
    public function index()
    {
        return view('login');
    }

public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        try {
            // Crear un nuevo usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
    
            // Redirigir al login con mensaje exitoso
            return response()->json(['message' => 'Registro exitoso', 200]);
        } catch (\Exception $e) {
            // Manejar cualquier excepción
            return response()->json(['error' => 'Usuario no insertado'], 404);
        }
    }
}