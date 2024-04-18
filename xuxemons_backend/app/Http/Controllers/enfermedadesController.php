<?php

namespace App\Http\Controllers;

use App\Models\enfermedad;
use Illuminate\Http\Request;


class enfermedadesController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'bajonAzucar' => 'required|integer|min:0|max:100',
                'sobredosisAzucar' => 'required|integer|min:0|max:100',
                'atracon' => 'required|integer|min:0|max:100',
            ]);

            // Obtener la configuración actual de las enfermedades
            $enfermedades = enfermedad::firstOrFail();

            // Actualizar la configuración con los nuevos valores
            $enfermedades->update([
                'porcentaje_bajon_azucar' => $request->bajonAzucar,
                'porcentaje_sobredosis_azucar' => $request->sobredosisAzucar,
                'porcentaje_atracon' => $request->atracon,
            ]);

            return response()->json(['message' => 'Configuración de enfermedades actualizada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar la configuración de enfermedades: ' . $e->getMessage()], 500);
        }
    }
}
