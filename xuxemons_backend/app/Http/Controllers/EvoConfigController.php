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


    public function update(Request $request, $id)
    {
        $configuration = evo_config::findOrFail($id);
        
        $request->validate([
            'nivel' => 'required|integer',
            'required_chuches' => 'required|integer',
        ]);

        $configuration->update($request->all());

        return response()->json(['message' => 'Configuración de evolución actualizada correctamente'], 200);
    }

    public function updateChuchesDiarias(Request $request,$id)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'nivel' => '',
                'required_chuches' => '',
                'chuches_diarias' => 'required|integer', // Asegúrate de que el campo chuches_diarias esté presente y sea un entero
            ]);

            // Encontrar la configuración de evolución
            $config = evo_config::findOrFail($id);

            // Actualizar el número de chuches diarias
            $config->update($request->all());

            return response()->json(['message' => 'Número de chuches diarias actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el número de chuches diarias: ' . $e->getMessage()], 500);
        }
    }
    
    public function addDailyChuches(Request $request)
    {
        try {
            // Validar la cantidad de chuches diarias
            $request->validate([
                'chuchesDiarias' => 'required|integer|min:1',
            ]);

            // Obtener la cantidad de chuches diarias del request
            $cantidadChuchesDiarias = $request->input('chuchesDiarias');

            // Obtener todos los usuarios
            $users = User::all();

            // Iterar sobre cada usuario
            foreach ($users as $user) {
                // Buscar las chuches existentes en el inventario del usuario
                $chuches = $user->inventario()->where('tipo', 'chuches')->first();

                // Verificar si se encontraron chuches
                if ($chuches) {
                    // Actualizar la cantidad de chuches existentes
                    $chuches->cantidad += $cantidadChuchesDiarias; // Sumar las chuches diarias
                    $chuches->save();
                } else {
                    // Crear nuevas chuches si no se encontraron
                    $chuches = new Inventario();
                    $chuches->nombre = 'Chuches';
                    $chuches->tipo = 'chuches';
                    $chuches->cantidad = $cantidadChuchesDiarias; // Establecer la cantidad inicial de chuches
                    $user->inventario()->save($chuches);
                }
            }

            return response()->json(['message' => 'Chuches diarias añadidas correctamente a todos los usuarios'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al añadir chuches diarias: ' . $e->getMessage()], 500);
        }
    }

}
