<?php

namespace App\Http\Controllers;

use App\Models\evo_config;
use App\Models\inventario;
use App\Models\User;
use Illuminate\Http\Request;


class EvoConfigController extends Controller
{
    public function index()
    {
        $configurations = evo_config::all();
        return response()->json($configurations, 200);
    }

    public function update(Request $request)
{
    // Obtener la configuración actual
    $currentConfig = evo_config::first();

    // Validar los datos de la solicitud
    $request->validate([
        'nivel' => 'nullable|integer',
        'required_chuches' => 'nullable|integer',
        'chuches_diarias' => 'nullable|integer',
    ]);

    // Actualizar los campos si están presentes en la solicitud o mantener los valores actuales
    $updateData = [];
    if ($request->has('nivel')) {
        $updateData['nivel'] = $request->nivel;
    } else {
        $updateData['nivel'] = $currentConfig->nivel;
    }
    
    if ($request->has('required_chuches')) {
        $updateData['required_chuches'] = $request->required_chuches;
    } else {
        $updateData['required_chuches'] = $currentConfig->required_chuches;
    }

    

    // Guardar los cambios en la base de datos
    $currentConfig->update($updateData);

    return response()->json(['message' => 'Configuración de evolución actualizada correctamente'], 200);
}


    public function updateDailyChuches(Request $request){
        $request->validate([
            'chuches_diarias' => 'nullable|integer',
        ]);
        $currentConfig = evo_config::first();

        if ($request->has('chuches_diarias')) {
            $updateData['chuches_diarias'] = $request->chuches_diarias;
        } else {
            $updateData['chuches_diarias'] = $currentConfig->chuches_diarias;
        }
        return response()->json(['message' => 'Configuracion de chuches diarias actualizada correctamente'], 200);

    }
   
}
