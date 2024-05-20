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
            'bajonAzucar' => 'nullable|integer|min:0|max:100',
            'sobredosisAzucar' => 'nullable|integer|min:0|max:100',
            'atracon' => 'nullable|integer|min:0|max:100',
        ]);

        // Obtener la configuración actual de las enfermedades
        $enfermedades = enfermedad::firstOrFail();

        // Obtener los valores de las variables
        $bajonAzucar = $request->input('bajonAzucar');
        $sobredosisAzucar = $request->input('sobredosisAzucar');
        $atracon = $request->input('atracon');

        // Actualizar la configuración con los nuevos valores si no son nulos
        if ($bajonAzucar !== null) {
            $enfermedades->porcentaje_bajon_azucar = $bajonAzucar;
        }

        if ($sobredosisAzucar !== null) {
            $enfermedades->porcentaje_sobredosis_azucar = $sobredosisAzucar;
        }

        if ($atracon !== null) {
            $enfermedades->porcentaje_atracon = $atracon;
        }

        // Guardar los cambios en la base de datos
        $enfermedades->save();

        return response()->json(['message' => 'Configuración de enfermedades actualizada correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al actualizar la configuración de enfermedades: ' . $e->getMessage()], 500);
    }
}



    public function updateXuxesBajon(Request $request)
    {
        try {

            $chuches = $request->input('chuches');

            // Obtener la configuración actual de las enfermedades
            $enfermedades = enfermedad::firstOrFail();

            if ($chuches !== null) {
                $enfermedades->xuxesBajon = $chuches;
            }

            // Guardar los cambios en la base de datos
            $enfermedades->save();

            return response()->json(['message' => 'Configuración de Bajon Azucar actualizada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar la configuración de Bajon Azucar: ' . $e->getMessage()], 500);
        }
    }

    public function giveCandy(Request $request, $xuxemonId, $candyAmount)
    {
        try {
            $email = $request->header('email');
            $user = User::where('email', $email)->first();
            $xuxemon = xuxemons::find($xuxemonId);
            $mensajeEvolucion = '';

            // Verificar si el Xuxemon está inactivo debido a un atracón
            if ($xuxemon->atracon) {
                return response()->json(['error' => 'El Xuxemon no puede recibir chuches debido a un atracón'], 400);
            }

            $inventario = $user->inventario()->where('tipo', 'chuches')->first();

            if (!$inventario || $inventario->cantidad < $candyAmount) {
                return response()->json(['error' => 'El usuario no tiene suficientes chuches en su inventario'], 400);
            }

            $inventario->cantidad -= $candyAmount;
            $inventario->save();

            $xuxemon->chuches++;
            
            $xuxemon->save();

            return response()->json([
                'message' => 'Se han dado chuches al Xuxemon',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al dar chuches al Xuxemon: ' . $e->getMessage()], 500);
        }
    }

    public function aplicarInfeccion(Request $request, $xuxemonId)
{
    $enfermedadesConfig = enfermedad::first();
    $xuxemon = xuxemons::find($xuxemonId);

    if (!$xuxemon) {
        return 'Xuxemon no encontrado';
    }

    if (!$enfermedadesConfig) {
        return 'Configuración de enfermedades no encontrada';
    }

    // Obtener los porcentajes de infección de la configuración
    $porcentajeBajonAzucar = $enfermedadesConfig->porcentaje_bajon_azucar;
    $porcentajeSobredosisAzucar = $enfermedadesConfig->porcentaje_sobredosis_azucar;
    $porcentajeAtracon = $enfermedadesConfig->porcentaje_atracon;

    // Verificar si el Xuxemon ya está infectado con alguna enfermedad
    if (!$xuxemon->bajon_azucar) {
        $infeccionAleatoria = rand(1, 100);

        if ($infeccionAleatoria <= $porcentajeBajonAzucar) {
            $xuxemon->bajon_azucar = true;
            $xuxemon->save();
            return response()->json([
                'infeccion' => 'El Xuxemon se ha infectado con Bajón de azúcar',
            ], 200);
        }
    }

    if (!$xuxemon->sobredosis_azucar) {
        $infeccionAleatoria = rand(1, 100);

        if ($infeccionAleatoria <= $porcentajeSobredosisAzucar) {
            $xuxemon->sobredosis_azucar = true;
            $xuxemon->save();
            return response()->json([
                'infeccion' => 'El Xuxemon se ha infectado con Sobredosis de azúcar',
            ], 200);
        }
    }

    if (!$xuxemon->atracon) {
        $infeccionAleatoria = rand(1, 100);

        if ($infeccionAleatoria <= $porcentajeAtracon) {
            $xuxemon->atracon = true;
            $xuxemon->save();
            return response()->json([
                'infeccion' => 'El Xuxemon se ha infectado con Atracón',
            ], 200);
        }
    }

    return response()->json([
        'infeccion' => 'El Xuxemon no se ha infectado',
    ], 200);
}

    public function aplicarEvolucion(Request $request, $xuxemonId)
    {
        $xuxemon = xuxemons::find($xuxemonId);
        if (!$xuxemon) {
            return 'Xuxemon no encontrado';
        }

        $currentLevel = $xuxemon->nivel;
        $requiredCandies = evo_config::where('nivel', $currentLevel)->value('required_chuches');

       // Obtener la configuración de las enfermedades
        $enfermedadesConfig = enfermedad::first();

        // Verificar si el Xuxemon está inactivo debido a la sobredosis de azúcar
        if ($xuxemon->sobredosis_azucar) {
        // Obtener la cantidad de chuchesBajonAzucar de la configuración de enfermedades
        $chuchesBajonAzucar = $enfermedadesConfig->xuxesBajon;

        // Sumar la cantidad de chuchesBajonAzucar a la variable $requiredCandies
        $requiredCandies += $chuchesBajonAzucar;
        }

        if ($xuxemon->chuches >= $requiredCandies) {
           
            if ($xuxemon->nivel == 1) {
                $xuxemon->nivel++;
                $xuxemon->chuches -= $requiredCandies;
                $xuxemon->tamano = 'mediano';
                return response()->json([
                    'evolucion' => 'Ha evolucionado a mediano',
                ], 200);
            } elseif ($xuxemon->nivel == 2) {
                $xuxemon->nivel++;
                $xuxemon->chuches -= $requiredCandies;
                $xuxemon->tamano = 'grande';
                return response()->json([
                    'evolucion' => 'Ha evolucionado a grande',
                ], 200);
            }
        }

        return response()->json([
            'evolucion' => '',
        ], 200);
    }

    public function usarCura(Request $request, $xuxemonId, $objeto)
    {
        try {
            // Obtener el usuario y el Xuxemon
            $email = $request->header('email');
            $user = User::where('email', $email)->first();
            $xuxemon = Xuxemons::find($xuxemonId);

            if (!$user || !$xuxemon) {
                return response()->json(['error' => 'Usuario o Xuxemon no encontrado'], 404);
            }

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
                    return response()->json(['message' => 'Se ha tratado el bajón de azúcar del Xuxemon'], 200);
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
            } elseif ($objeto === 'Xal_frutas') {
                if ($xuxemon->atracon) {
                    $inventario = $user->inventario()->where('nombre', 'Xal_frutas')->first();
                    if (!$inventario) {
                        return response()->json(['error' => 'El usuario no tiene xal de frutas en su inventario'], 400);
                    }
                    $inventario->cantidad--;
                    $inventario->save();
                    $xuxemon->atracon = false;
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
        return response()->json($xuxemons, 200);
    }
}
