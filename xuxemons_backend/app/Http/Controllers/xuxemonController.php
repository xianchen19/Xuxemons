<?php

namespace App\Http\Controllers;

use App\Models\enfermedad;
use App\Models\evo_config;
use App\Models\xuxemons;
use Illuminate\Http\Request;
use App\Models\User;

class xuxemonController extends Controller
{
    public function index(Request $request)
{
    try {
        // Obtener el email del usuario del encabezado de la solicitud
        $email = $request->header('email');

        // Buscar al usuario por su email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener los Xuxemons asociados al usuario
        $xuxemons = $user->xuxemons;

        return response()->json($xuxemons, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al obtener los Xuxemons del usuario'], 500);
    }
}

public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string',
        'tipo' => 'required|string',
        'tamano' => 'required|string',
        'vida' => 'required|integer',
        'archivo' => 'required|string',
    ]);

    try {

        // Crear el xuxemon en la base de datos
        $xuxemon = new xuxemons();
        $xuxemon->nombre = $request->nombre;
        $xuxemon->tipo = $request->tipo;
        $xuxemon->tamano = $request->tamano;
        $xuxemon->vida = $request->vida;
        $xuxemon->archivo = $request->archivo;
        $xuxemon->save();

        return response()->json(['message' => 'Xuxemon creado'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al crear el Xuxemon'], 500);
    }
}

public function show(Request $request)
{
    try {
        // Obtener el ID del Xuxemon del encabezado de la solicitud
        $xuxemonId = $request->header('xuxemon_id');

        // Buscar el Xuxemon por su ID
        $xuxemon = xuxemons::findOrFail($xuxemonId);

        return response()->json(['message' => $xuxemon], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Xuxemon no encontrado'], 404);
    }
}

public function coleccion(Request $request)
{
    try {
        // Obtener el email del usuario del encabezado de la solicitud
        $email = $request->header('email');

        // Buscar el usuario por su email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener los xuxemons del usuario
        $xuxemons = $user->xuxemons;

        if ($xuxemons->isEmpty()) {
            return response()->json(['message' => 'El usuario no tiene xuxemons'], 200);
        }

        return response()->json(['xuxemons' => $xuxemons], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al obtener los xuxemons del usuario'], 500);
    }
}


public function update(Request $request)
{
    try {
        // Obtener el ID del Xuxemon del encabezado de la solicitud
        $xuxemonId = $request->header('xuxemon_id');

        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'tipo' => 'required|string',
            'tamano' => 'required|integer',
            'vida' => 'required|integer',
            'archivo' => 'required|string',
        ]);

        // Buscar el Xuxemon por su ID
        $xuxemon = xuxemons::findOrFail($xuxemonId);

        // Actualizar en la base de datos
        $xuxemon->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'tamano' => $request->tamano,
            'vida' => $request->vida,
            'archivo' => $request->archivo,
        ]);

        return response()->json(['message' => 'Xuxemon actualizado correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al actualizar el Xuxemon'], 404);
    }
}


    public function destroy(Request $request)
    {
        try {
            // Obtener el ID del Xuxemon del encabezado de la solicitud
            $xuxemonId = $request->header('xuxemon_id');
    
            // Buscar el Xuxemon por su ID
            $xuxemon = xuxemons::find($xuxemonId);
            if (!$xuxemon) {
                return response()->json(['error' => 'Xuxemon no encontrado'], 404);
            }
    
            // Eliminar el Xuxemon
            $xuxemon->delete();
    
            return response()->json(['message' => 'Xuxemon eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al eliminar el Xuxemon'], 500);
        }
    }
    
    
    public function randomXuxemonAdmin()
{
    // Lista de nombres ficticios de xuxemons
    $nombres = ['Blastoise', 'Reshiram', 'Zekrom', 'Charizard', 'Pikachu', 'Snorlax', 'Gyarados', 'Mewtwo'];
    $tipos = ['Acero', 'Agua', 'Bicho', 'Dragón', 'Eléctrico', 'Fantasma', 'Fuego', 'Hada', 'Hielo', 'Lucha', 'Normal', 'Planta', 'Psíquico', 'Roca', 'Siniestro', 'Tierra', 'Veneno', 'Volador'];

    // Obtener 4 nombres aleatorios de la lista
    $nombreAleatorios = array_rand($nombres, 1);
    $tipoAleatorios = array_rand($tipos, 1);

    // Verificar si se encontraron nombres aleatorios
    if (!empty($nombreAleatorios || $tipoAleatorios)) {
            $xuxemon = new xuxemons();
            $xuxemon->nombre = $nombres[$nombreAleatorios];

            $xuxemon->tipo = $tipos[$tipoAleatorios];

            // Actualizar la vida del Xuxemon seleccionado como 100
            $xuxemon->vida = 100;

            $xuxemon->save();
        
        return response()->json(['message' => 'Xuxemons aleatorios creados correctamente'], 200);
    } else {
        // No se encontraron nombres aleatorios
        return response()->json(['error' => 'No se encontraron nombres aleatorios'], 404);
    }
}
public function randomXuxemon(Request $request)
{
    try {
        // Obtener el ID del usuario del encabezado de la solicitud
        $email = $request->header('email');

        // Buscar al usuario por su ID
        $user = User::where('email', $email)->first();
        
        // Verificar si se encontró un usuario
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        
        // Lista de nombres ficticios de xuxemons
        $nombres = ['Blastoise', 'Reshiram', 'Zekrom', 'Charizard', 'Pikachu', 'Snorlax', 'Gyarados', 'Mewtwo'];
        $tipos = ['Acero', 'Agua', 'Bicho', 'Dragón', 'Eléctrico', 'Fantasma', 'Fuego', 'Hada', 'Hielo', 'Lucha', 'Normal', 'Planta', 'Psíquico', 'Roca', 'Siniestro', 'Tierra', 'Veneno', 'Volador'];
        $tamanos = ['pequeño', 'mediano', 'grande'];
        
        // Obtener un nombre y tipo aleatorio
        $nombreAleatorio = $nombres[array_rand($nombres)];
        $tipoAleatorio = $tipos[array_rand($tipos)];
        $tamano = $tamanos[array_rand($tamanos)];
        
        // Crear un nuevo Xuxemon y asociarlo al usuario
        $xuxemon = $user->xuxemons()->create([
            'nombre' => $nombreAleatorio,
            'tipo' => $tipoAleatorio,
            'tamano' => $tamano,
            'vida' => 100,
        ]);

        return response()->json(['message' => 'Xuxemon aleatorio creado y asociado al usuario correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al crear y asociar el Xuxemon aleatorio: ' . $e->getMessage()], 500);
    }
}

public function giveCandy(Request $request, $xuxemonId, $candyAmount)
{
    try {
        // Obtener el correo electrónico del encabezado
        $email = $request->header('email');

        // Encontrar al usuario basado en el correo electrónico
        $user = User::where('email', $email)->first();

        // Verificar si se encontró el usuario
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Encontrar al Xuxemon
        $xuxemon = xuxemons::find($xuxemonId);
        if (!$xuxemon) {
            return response()->json(['error' => 'Xuxemon no encontrado'], 404);
        }

        // Verificar si el usuario tiene suficientes chuches en su inventario
        $inventario = $user->inventario()->where('tipo', 'chuches')->first();
        if (!$inventario || $inventario->cantidad < $candyAmount) {
            return response()->json(['error' => 'El usuario no tiene suficientes chuches en su inventario'], 400);
        }

        // Restar la cantidad de chuches del inventario del usuario
        $inventario->cantidad -= $candyAmount;
        $inventario->save();

        // Aumentar la cantidad de chuches del Xuxemon
        $xuxemon->chuches += $candyAmount;

        // Obtener configuración de enfermedades
        $enfermedadesConfig = enfermedad::first();
        // Obtener configuración de evolución
        $evoConfig = evo_config::first();

        // Verificar si se obtuvo la configuración de enfermedades
        if (!$enfermedadesConfig || !$evoConfig) {
            return response()->json(['error' => 'Configuración no encontrada'], 500);
        }

        // Probabilidad de infección aleatoria
        $infeccionAleatoria = rand(1, 100);

        // Definir porcentajes de infección para cada enfermedad
        $porcentajeBajonAzucar = $enfermedadesConfig->porcentaje_bajon_azucar;
        $porcentajeSobredosisAzucar = $enfermedadesConfig->porcentaje_sobredosis_azucar;
        $porcentajeAtracon = $enfermedadesConfig->porcentaje_atracon;

        // Verificar si el Xuxemon se infecta
        if ($infeccionAleatoria <= $porcentajeBajonAzucar) {
            $xuxemon->bajon_azucar = true;
            $mensajeInfeccion = 'El Xuxemon se ha infectado con Bajón de azúcar';
            // Ajustar requisitos de crecimiento si se ha infectado
            $xuxemon->requisitos_crecimiento = 2;
        } elseif ($infeccionAleatoria <= ($porcentajeBajonAzucar + $porcentajeSobredosisAzucar)) {
            $xuxemon->sobredosis_azucar = true;
            $mensajeInfeccion = 'El Xuxemon se ha infectado con Sobredosis de azúcar';
        } elseif ($infeccionAleatoria <= ($porcentajeBajonAzucar + $porcentajeSobredosisAzucar + $porcentajeAtracon)) {
            $xuxemon->atracon = true;
            $mensajeInfeccion = 'El Xuxemon se ha infectado con Atracón';
        } else {
            $mensajeInfeccion = 'El Xuxemon no se ha infectado';
        }


 // Verificar si el Xuxemon ha alcanzado los requisitos para subir de nivel
if ($xuxemon->chuches >= $evoConfig->required_chuches) {
    // Verificar si ya es de tamaño grande o si el tamaño es mediano y está evolucionando
    if ($xuxemon->tamano == 'pequeño') {
        // Buscar la configuración de evolución de pequeño a mediano
        $evoConfigPequeñoMediano = Evo_Config::find(1);

        // Verificar si se encontró la configuración
        if ($evoConfigPequeñoMediano) {
            $xuxemon->tamano = 'mediano';
            $mensajeEvolucion = '¡El Xuxemon ha evolucionado a Mediano!';

        } else {
            $mensajeEvolucion = 'Error: No se encontró la configuración de evolución de pequeño a mediano';
        }
    } elseif ($xuxemon->tamano == 'mediano') {
        // Buscar la configuración de evolución de mediano a grande
        $evoConfigMedianoGrande = Evo_Config::find(2);

                // Verificar si se encontró la configuración
            // Verificar si el Xuxemon tiene suficientes chuches para evolucionar a grande
        if ($xuxemon->chuches >= $evoConfigMedianoGrande->chuches_para_subir_de_nivel) {
            // Actualizar el tamaño del Xuxemon a grande
            $xuxemon->tamano = 'grande';
            $mensajeEvolucion = '¡El Xuxemon ha evolucionado a Grande!';
        } else {
            $mensajeEvolucion = 'El Xuxemon no tiene suficientes chuches para evolucionar a Grande';
        }

    } else {
        $mensajeEvolucion = '';
    }
} else {
    $mensajeEvolucion = '';
}

 // Obtener el nivel actual del Xuxemon y la cantidad de chuches requeridas para subir de nivel
 $currentLevel = $xuxemon->nivel;
 $requiredCandies = evo_config::where('nivel', $currentLevel)->value('required_chuches');

 // Verificar si el Xuxemon ha alcanzado la cantidad necesaria de chuches para subir de nivel
 if ($xuxemon->chuches >= $requiredCandies) {
     // Actualizar el nivel del Xuxemon y restar los caramelos necesarios
     $xuxemon->nivel++;
     $xuxemon->chuches -= $requiredCandies;

     // Actualizar el tamaño del Xuxemon si alcanza cierto nivel
     if ($xuxemon->nivel == 2) {
         $xuxemon->tamano = 'mediano';
     } elseif ($xuxemon->nivel == 3) {
         $xuxemon->tamano = 'grande';
     }

     // Guardar los cambios en el Xuxemon
     $xuxemon->save();

     return response()->json(['message' => 'Xuxemon subió de nivel correctamente'], 200);
 } else {
     // Guardar los cambios en el Xuxemon
     $xuxemon->save();

     return response()->json(['message' => 'Se han dado chuches al Xuxemon'], 200);
 }
        // Guardar los cambios en el Xuxemon
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



public function xuxemonAll(){
    $xuxemons = xuxemons::all();
    return response()->json([$xuxemons,'message' => 'Xuxemon Index', 200]);
}

public function activarXuxemon(Request $request, $xuxemonId)
    {
        try {
            // Obtener el correo electrónico del encabezado
            $email = $request->header('email');

            // Encontrar al usuario basado en el correo electrónico
            $user = User::where('email', $email)->first();

            // Verificar si el usuario existe
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Verificar si el Xuxemon pertenece al usuario
            if (!$user->xuxemons()->where('xuxemons.id', $xuxemonId)->exists()) {
                return response()->json(['error' => 'El Xuxemon no pertenece al usuario'], 400);
            }

            // Verificar si el usuario ya tiene 4 Xuxemons activos
            if ($user->xuxemonsActivos()->count() >= 4) {
                return response()->json(['error' => 'No se puede activar más Xuxemons'], 400);
            }

            // Activar el Xuxemon para el usuario
            $user->xuxemons()->updateExistingPivot($xuxemonId, ['activo' => true]);

            return response()->json(['message' => 'Xuxemon activado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al activar el Xuxemon: ' . $e->getMessage()], 500);
        }
    }

    public function desactivarXuxemon(Request $request, $xuxemonId)
    {
        try {
            // Obtener el correo electrónico del encabezado
            $email = $request->header('email');

            // Encontrar al usuario basado en el correo electrónico
            $user = User::where('email', $email)->first();

            // Verificar si el usuario existe
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Verificar si el Xuxemon pertenece al usuario
            if (!$user->xuxemons()->where('xuxemons.id', $xuxemonId)->exists()) {
                return response()->json(['error' => 'El Xuxemon no pertenece al usuario'], 400);
            }

            // Desactivar el Xuxemon para el usuario
            $user->xuxemons()->updateExistingPivot($xuxemonId, ['activo' => false]);

            return response()->json(['message' => 'Xuxemon desactivado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al desactivar el Xuxemon: ' . $e->getMessage()], 500);
        }
    }

};
