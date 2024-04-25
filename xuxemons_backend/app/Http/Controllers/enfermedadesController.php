<?php

namespace App\Http\Controllers;

use App\Models\enfermedad;
use App\Models\evo_config;
use App\Models\xuxemons;
use Illuminate\Http\Request;
use App\Models\User;


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

    public function updateXuxesBajon(Request $request)
    {
        try {
        $request->validate([
            'xuxes_bajon' => 'required|integer',
        ]);

        $config = enfermedad::firstOrFail(); // Obtener la primera fila de la tabla evo_config

        $config->update([
            'xuxesBajon' => $request->xuxes_bajon,
        ]);

        return response()->json(['message' => 'Configuración de enfermedades actualizada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar la configuración de enfermedades: ' . $e->getMessage()], 500);
        }
    }

    public function giveCandy(Request $request, $xuxemonId, $candyAmount)
{
    try {
        $email = $request->header('email');
        $user = User::where('email', $email)->first();
        $xuxemon = xuxemons::find($xuxemonId);

        if (!$user || !$xuxemon) {
            return response()->json(['error' => 'Usuario o Xuxemon no encontrado'], 404);
        }

        // Verificar si el Xuxemon está inactivo debido a un atracón
        if ($xuxemon->atracon) {
            return response()->json(['error' => 'El Xuxemon no puede recibir chuches debido a un atracón'], 400);
        }

         // Verificar si el Xuxemon está inactivo debido a la sobredosis de azúcar
         if ($xuxemon->sobredosis_azucar) {
            return response()->json(['error' => 'El Xuxemon no puede realizar ninguna acción debido a una sobredosis de azúcar'], 400);
        }
        $inventario = $user->inventario()->where('tipo', 'chuches')->first();

        if (!$inventario || $inventario->cantidad < $candyAmount) {
            return response()->json(['error' => 'El usuario no tiene suficientes chuches en su inventario'], 400);
        }

        $inventario->cantidad -= $candyAmount;
        $inventario->save();

         // Solo agregar las chuches al Xuxemon si no tiene atracón
         if (!$xuxemon->atracon) {
            $xuxemon->chuches += $candyAmount;
        }

        $mensajeInfeccion = $this->aplicarInfeccion($xuxemon);
        $mensajeEvolucion = $this->aplicarEvolucion($xuxemon);
        $xuxemon->save();

        return response()->json([
            'message' => 'Se han dado chuches al Xuxemon',
            'infeccion' => $mensajeInfeccion,
            'evolucion' => $mensajeEvolucion
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al dar chuches al Xuxemon: ' . $e->getMessage()], 500);
    }
}

private function aplicarInfeccion($xuxemon)
{
    // Verificar si el Xuxemon ya está infectado con alguna enfermedad
    if ($xuxemon->bajon_azucar || $xuxemon->sobredosis_azucar || $xuxemon->atracon) {
        return 'El Xuxemon ya está infectado';
    }

    $enfermedadesConfig = enfermedad::first();

    if (!$enfermedadesConfig) {
        return 'Configuración de enfermedades no encontrada';
    }

    $infeccionAleatoria = rand(1, 100);
    $porcentajeBajonAzucar = $enfermedadesConfig->porcentaje_bajon_azucar;
    $porcentajeSobredosisAzucar = $enfermedadesConfig->porcentaje_sobredosis_azucar;
    $porcentajeAtracon = $enfermedadesConfig->porcentaje_atracon;

    if ($infeccionAleatoria <= $porcentajeBajonAzucar) {
        $xuxemon->bajon_azucar = true;
        return 'El Xuxemon se ha infectado con Bajón de azúcar';
    } elseif ($infeccionAleatoria <= ($porcentajeBajonAzucar + $porcentajeSobredosisAzucar)) {
        $xuxemon->sobredosis_azucar = true;
        return 'El Xuxemon se ha infectado con Sobredosis de azúcar';
    } elseif ($infeccionAleatoria <= ($porcentajeBajonAzucar + $porcentajeSobredosisAzucar + $porcentajeAtracon)) {
        $xuxemon->atracon = true;
        return 'El Xuxemon se ha infectado con Atracón';
    } else {
        return 'El Xuxemon no se ha infectado';
    }
}


private function aplicarEvolucion($xuxemon)
{
    $currentLevel = $xuxemon->nivel;
    $requiredCandies = evo_config::where('nivel', $currentLevel)->value('required_chuches');

     // Verificar si el Xuxemon está infectado con "Bajón de azúcar"
     if ($xuxemon->bajon_azucar) {
        // Aumentar el requisito de chuches en 2 si está infectado con "Bajón de azúcar"
        $requiredCandies += 2;
    }


    if ($xuxemon->chuches >= $requiredCandies) {
        $xuxemon->nivel++;
        $xuxemon->chuches -= $requiredCandies;

        if ($xuxemon->nivel == 2) {
            $xuxemon->tamano = 'mediano';
            return 'Ha evolucionado a mediano';
        } elseif ($xuxemon->nivel == 3) {
            $xuxemon->tamano = 'grande';
            return 'Ha evolucionado a grande';
        }
    }

    return '';
}

public function usarCura(Request $request, $xuxemonId)
    {
        try {
            // Obtener el usuario y el Xuxemon
            $email = $request->header('email');
            $user = User::where('email', $email)->first();
            $xuxemon = Xuxemons::find($xuxemonId);

            if (!$user || !$xuxemon) {
                return response()->json(['error' => 'Usuario o Xuxemon no encontrado'], 404);
            }

            $objeto = $request->input('objeto');

            if ($objeto === 'Xocolatina') {
                if ($xuxemon->bajon_azucar) {
                    $inventario = $user->inventario()->where('nombre', 'Xocolatina')->first();
                    if (!$inventario) {
                        return response()->json(['error' => 'El usuario no tiene xocolatinas en su inventario'], 400);
                    }
                    $inventario->cantidad--;
                    $inventario->save();
                    $xuxemon->bajon_azucar = false;
                    $xuxemon->save();
                    return response()->json(['message' => 'Se ha curado el bajón de azúcar del Xuxemon'], 200);
                }
            } elseif ($objeto === 'Inxulina') {
                if ($xuxemon->sobredosis_azucar) {
                    $inventario = $user->inventario()->where('nombre', 'Inxulina')->first();
                    if (!$inventario) {
                        return response()->json(['error' => 'El usuario no tiene inxulina en su inventario'], 400);
                    }
                    $inventario->cantidad--;
                    $inventario->save();
                    $xuxemon->sobredosis_azucar = false;
                    $xuxemon->save();
                    return response()->json(['message' => 'Se ha tratado la sobredosis de azúcar del Xuxemon con inxulina'], 200);
                }
            } elseif ($objeto === 'Xal de frutas') {
                if ($xuxemon->sobredosis_azucar) {
                    $inventario = $user->inventario()->where('nombre', 'Xal de frutas')->first();
                    if (!$inventario) {
                        return response()->json(['error' => 'El usuario no tiene xal de frutas en su inventario'], 400);
                    }
                    $inventario->cantidad--;
                    $inventario->save();
                    $xuxemon->sobredosis_azucar = false;
                    $xuxemon->save();
                    return response()->json(['message' => 'Se ha tratado la sobredosis de azúcar del Xuxemon con xal de frutas'], 200);
                }
            }

            return response()->json(['message' => 'No se pudo usar la cura'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al usar la cura: ' . $e->getMessage()], 500);
        }
    }

    public function xuxemonsConEnfermedad()
{
    // Buscar todos los Xuxemons que tengan al menos una enfermedad activa
    $xuxemons = xuxemons::where('bajon_azucar', true)
                         ->orWhere('sobredosis_azucar', true)
                         ->orWhere('atracon', true)
                         ->get();

    // Verificar si se encontraron Xuxemons con alguna enfermedad
    if ($xuxemons->isEmpty()) {
        return response()->json(['message' => 'No hay Xuxemons infectados con ninguna enfermedad'], 200);
    }

    // Devolver los Xuxemons encontrados
    return response()->json(['xuxemons' => $xuxemons], 200);
}


}
