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

    public function update(Request $request, $nivel, $chuches)
{

    // Obtener la configuración actual basada en el nivel proporcionado en la URL
    $currentConfig = evo_config::where('nivel', $nivel)->first();

    $currentConfig->required_chuches = $chuches;

    // Guardar los cambios en la base de datos
    $currentConfig->save();

    return response()->json(['message' => 'Configuración de evolución actualizada correctamente'], 200);
}

public function updateDailyChuches(Request $request)
{
    $request->validate([
        'chuchesDiarias' => 'nullable|integer',
    ]);

    $currentConfig = evo_config::first();

    // Obtener la variable del cuerpo de la solicitud
    $chuchesDiarias = $request->input('chuchesDiarias');

    // Actualizar el campo chuches_diarias si la variable está presente en la solicitud
    if ($chuchesDiarias !== null) {
        $currentConfig->chuches_diarias = $chuchesDiarias;
        $currentConfig->save();
    }

    return response()->json(['message' => 'Configuracion de chuches diarias actualizada correctamente'], 200);
}


}
