<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function register(Request $request){
 
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == 'admin') 
            {
              return redirect();
            }
            else
            {
              return redirect();
            }
        }
        else
        {
            return redirect()
            ->route('login')
            ->with('error','Incorrect email or password!.');
        }
    }

    public function register(Request $request){
        //validacion
        $credentials =[
            "email"=> $request->email,
            "password" =>$request->password,
        ]

        if(Auth::attempt($credentials)){ //comprovar si coinciden las credenciales

            $request->session()->regenerate();

            return redirect() //redirigir a la pagina principal

        }else{
            return redirect() //redirigir a login
        }
    }

    public function logout(Request $request){
        Auth::logout(); //cerrar sesion
        $request->session()->invalidate(); //invalidar la sesion
        $request->session()->regenerateToken(); //regenerar 

        return redirect(); //redirigir a pagina 
    }

}
