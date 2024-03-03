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
        try{
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'], 
            ]);

            return response()->json(['message' => 'Registro exitoso', 200]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario no insertado'], 404);
        }
    }
}
