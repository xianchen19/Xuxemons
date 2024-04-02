<?php

namespace App\Http\Controllers;

use App\Models\evo_config;
use App\Models\xuxemons;
use Illuminate\Http\Request;
use App\Models\User;

class xuxemonController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    
        $xuxemons = $user->xuxemons;
        return response()->json($xuxemons, 200);
    }
    

    public function create()
    {  
        $xuxemons = xuxemons::all(); //coger todas las categorias del modelo
        return response()->json(['message' => 'Xuxemon actualizado correctamente', 200]);
    }

//     public function store(Request $request)
// {
//     // Validar los datos del formulario
//     $request->validate([
//         'nombre' => 'required|string',
//         'tipo' => 'required|string',
//         'tamano' => 'required|integer',
//         'vida' => 'required|integer',
//         'archivo' => 'required|string',
//     ]);

//     try {
//         // Crear el xuxemon en la base de datos
//         $xuxemon = new xuxemons();
//         $xuxemon->nombre = $request->nombre;
//         $xuxemon->tipo = $request->tipo;
//         $xuxemon->tamano = $request->tamano;
//         $xuxemon->vida = $request->vida;
//         $xuxemon->archivo = $request->archivo;
//         $xuxemon->save();

//         return response()->json(['message' => 'Xuxemon creado correctamente'], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Ha ocurrido un error al crear el Xuxemon'], 404);
//     }
// }
public function store(Request $request, $id)
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
        // Encontrar al usuario
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Crear el xuxemon en la base de datos
        $xuxemon = new xuxemons();
        $xuxemon->nombre = $request->nombre;
        $xuxemon->tipo = $request->tipo;
        $xuxemon->tamano = $request->tamano;
        $xuxemon->vida = $request->vida;
        $xuxemon->archivo = $request->archivo;
        $xuxemon->save();

        // Asociar el nuevo Xuxemon con el usuario
        $user->xuxemons()->attach($xuxemon->id);

        return response()->json(['message' => 'Xuxemon creado y asociado al usuario correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al crear el Xuxemon'], 500);
    }
}

    public function show($id)
    {
        $xuxemon = xuxemons::findOrFail($id); // buscar el id de ese producto en especifico
        return response()->json(['message' => $xuxemon, 200]);
    }

    public function edit($id)
    {

        $xuxemon = xuxemons::findOrFail($id); //coger todas las categorias del modelo
        return response()->json(['message' => 'Xuxemon actualizado correctamente', 200]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'nombre' => 'required|string',
                'tipo' => 'required|string',
                'tamano' => 'required|integer',
                'vida' => 'required|integer',
                'archivo' => 'required|string',
            ]);
    
            // Buscar el xuxemon
            $xuxemon = xuxemons::findOrFail($id);
    
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

    public function destroy($id, $xuxemonId)
    {
         try {
        //     //buscar el producto que queremos eliminar
        //     $xuxemon = xuxemons::findOrFail($id);
        //     $xuxemon->delete();
        $user = User::find($id);

        $user->xuxemons()->detach($xuxemonId);

            return response()->json(['message' => 'Xuxemon eliminado correctamente', 200]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'A ocurrido un error al eliminar'], 404);
        }
    }
    
    public function randomXuxemon()
{
    // Lista de nombres ficticios de xuxemons
    $nombres = ['Blastoise', 'Reshiram', 'Zekrom', 'Charizard', 'Pikachu', 'Snorlax', 'Gyarados', 'Mewtwo'];

    // Obtener 4 nombres aleatorios de la lista
    $nombresAleatorios = array_rand($nombres, 4);

    // Verificar si se encontraron nombres aleatorios
    if (!empty($nombresAleatorios)) {
        foreach ($nombresAleatorios as $nombreIndex) {
            $xuxemon = new xuxemons();
            $xuxemon->nombre = $nombres[$nombreIndex];

            // Actualizar la vida del Xuxemon seleccionado como 100
            $xuxemon->vida = 100;

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
