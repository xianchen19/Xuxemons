<?php

namespace App\Http\Controllers;

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

    // Obtener 4 nombres aleatorios de la lista
    $nombresAleatorios = array_rand($nombres, 4); // Obtener 4 nombres aleatorios
    $tipos = ['agua', 'tierra', 'aire'];

    // Elegir un tipo aleatorio
    $tipoAleatorio = $tipos[array_rand($tipos)];

    // Verificar si se encontraron nombres aleatorios
    if (!empty($nombresAleatorios)) {
        foreach ($nombresAleatorios as $nombreIndex) {
            $xuxemon = new xuxemons();
            $xuxemon->nombre = $nombres[$nombreIndex];

            // Actualizar la vida del Xuxemon seleccionado como 100
            $xuxemon->vida = 100;

            $xuxemon->tipo = $tipoAleatorio;

            // Actualizar el tamaño del Xuxemon seleccionado con un valor del enum: pequeño, mediano o grande
            $tamanos = ['pequeño', 'mediano', 'grande'];
            $xuxemon->tamano = $tamanos[array_rand($tamanos)];

            $xuxemon->save();
        }
        
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
        
        // Lista de nombres ficticios de xuxemons
        $nombres = ['Blastoise', 'Reshiram', 'Zekrom', 'Charizard', 'Pikachu', 'Snorlax', 'Gyarados', 'Mewtwo'];
        $tipos = ['Acero', 'Agua', 'Bicho', 'Dragón', 'Eléctrico', 'Fantasma', 'Fuego', 'Hada', 'Hielo', 'Lucha', 'Normal', 'Planta', 'Psíquico', 'Roca', 'Siniestro', 'Tierra', 'Veneno', 'Volador'];

        // Obtener un nombre y tipo aleatorio
        $nombreAleatorio = $nombres[array_rand($nombres)];
        $tipoAleatorio = $tipos[array_rand($tipos)];

        // Crear un nuevo Xuxemon
        $xuxemon = new xuxemons();
        $xuxemon->nombre = $nombreAleatorio;
        $xuxemon->tipo = $tipoAleatorio;
        $xuxemon->vida = 100;
        $xuxemon->save();

        // Asociar el Xuxemon al usuario
        $user->xuxemons()->attach($xuxemon->id);

        return response()->json(['message' => 'Xuxemon aleatorio creado y asociado al usuario correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al crear y asociar el Xuxemon aleatorio: ' . $e->getMessage()], 500);
    }
}




    public function giveCandy($xuxemonId, $candyAmount)
{
    $xuxemon = xuxemons::find($xuxemonId);
    $xuxemon->chuches += $candyAmount; // Aumentar la cantidad de chuches del Xuxemon

    $currentLevel = $xuxemon->nivel;
    $requiredCandies = evo_config::where('nivel', $currentLevel + 1)->value('required_chuches');

    if ($xuxemon->chuches >= $requiredCandies) {
        // Actualizar el nivel del Xuxemon y restar los caramelos necesarios
        $xuxemon->nivel++;
        $xuxemon->chuches -= $requiredCandies;

        if ($xuxemon->nivel == 2) {
            $xuxemon->tamano = 'mediano';
        } elseif ($xuxemon->nivel == 3) {
            $xuxemon->tamano = 'grande';
        }

        $xuxemon->save();

        return response()->json(['message' => 'Xuxemon subió de nivel correctamente'], 200);
    } else {
        return response()->json(['message' => 'Se han dado chuches al Xuxemon'], 200);
    }
}

};
