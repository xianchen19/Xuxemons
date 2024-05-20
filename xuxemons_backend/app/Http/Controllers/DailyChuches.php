<?php

namespace App\Http\Controllers;

use App\Models\DailyChuchesLog;
use App\Models\evo_config;
use App\Models\inventario;
use App\Models\User;
use Illuminate\Http\Request;



class DailyChuches extends Controller
{
    public function addDailyChuches(Request $request)
    {
        try {
            // Obtener el correo electrónico del encabezado
            $email = $request->header('email');

            // Verificar si se proporcionó un correo electrónico en el encabezado
            if (!$email) {
                return response()->json(['error' => 'Correo electrónico no proporcionado en el encabezado'], 400);
            }

            // Obtener la fecha actual
            $currentDate = now()->format('Y-m-d');

            // Verificar si el usuario ya utilizó esta función hoy
            $dailyChuchesLog = DailyChuchesLog::where('email', $email)
                ->whereDate('created_at', $currentDate)
                ->first();

            if ($dailyChuchesLog) {
                return response()->json(['message' => 'Ya se han asignado chuches diarias a este usuario hoy'], 400);
            }

            // Obtener la cantidad de chuches diarias de la configuración
            $config = evo_Config::first();

            if (!$config) {
                return response()->json(['error' => 'No se encontró la configuración de chuches'], 404);
            }

            $chuchesDiarias = $config->chuches_diarias;

            // Encontrar al usuario basado en el correo electrónico
            $user = User::where('email', $email)->first();

            // Verificar si se encontró el usuario
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Buscar las chuches existentes en el inventario del usuario
            $chuches = $user->inventario()->where('tipo', 'chuches')->first();

            // Verificar si se encontraron chuches
            if ($chuches) {
                // Actualizar la cantidad de chuches existentes
                $chuches->cantidad += $chuchesDiarias; // Sumar las chuches diarias
                $chuches->save();
            } else {
                // Crear nuevas chuches si no se encontraron
                $chuches = new Inventario();
                $chuches->nombre = 'Chuches';
                $chuches->tipo = 'chuches';
                $chuches->cantidad = $chuchesDiarias; // Establecer la cantidad inicial de chuches
                $user->inventario()->save($chuches);
            }

            // Registrar el uso de chuches diarias por parte del usuario
            $dailyChuchesLog = new DailyChuchesLog();
            $dailyChuchesLog->email = $email;
            $dailyChuchesLog->save();

            return response()->json(['message' => 'Chuches diarias añadidas correctamente al usuario'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al añadir chuches diarias: ' . $e->getMessage()], 500);
        }
    }
}
