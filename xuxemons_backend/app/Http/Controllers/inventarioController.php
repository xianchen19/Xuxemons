<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class inventarioController extends Controller
{
    public function index($id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Obtener el inventario del usuario
    $inventario = $user->inventario;
    return response()->json($inventario, 200);
}

    /*public function create()
    {  
        $inventarios = inventario::all(); //coger todas las categorias del modelo
        return response()->json(['message' => 'inventario actualizado correctamente', 200]);
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string',
        'tipo' => 'required|string',
        'tamano' => 'required|integer',
        'vida' => 'required|integer',
        'archivo' => 'required|string',
    ]);

    try {
        // Crear el xuxemon en la base de datos
        $xuxemon = new inventario();
        $xuxemon->nombre = $request->nombre;
        $xuxemon->tipo = $request->tipo;
        $xuxemon->tamano = $request->tamano;
        $xuxemon->vida = $request->vida;
        $xuxemon->archivo = $request->archivo;
        $xuxemon->save();

        return response()->json(['message' => 'Inventario creado correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al crear el Xuxemon'], 404);
    }
}
    public function show($id)
    {
        $inventarios = inventario::findOrFail($id); // buscar el id de ese producto en especifico
        return response()->json(['message' => $inventarios, 200]);
    }

    public function edit($id)
    {

        $inventarios = inventario::findOrFail($id); //coger todas las categorias del modelo
        return response()->json(['message' => 'Inventario actualizado correctamente', 200]);
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
            $inventarios = inventario::findOrFail($id);
    
            // Actualizar en la base de datos
            $inventarios->update([
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'tamano' => $request->tamano,
                'vida' => $request->vida,
                'archivo' => $request->archivo,
            ]);
    
            return response()->json(['message' => 'Inventario actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al actualizar el Xuxemon'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            //buscar el producto que queremos eliminar
            $inventarios = inventario::findOrFail($id);
            $inventarios->delete();
    
            return response()->json(['message' => 'inventario eliminado correctamente', 200]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'A ocurrido un error al eliminar'], 404);
        }
    }
*/
public function randomChuche()
{
    try {
        // Array de nombres y tipos
        $nombres = ['Chocolate', 'Piruleta']; // Agrega aquí tus nombres
        // Elegir aleatoriamente un nombre y un tipo
        $nombreAleatorio = $nombres[array_rand($nombres)];

        // Generar cantidad aleatoria entre 1 y 10
        $cantidadAleatoria = rand(1, 10);

        // Crear el inventario en la base de datos
        $inventario = new inventario();
        $inventario->nombre = $nombreAleatorio;
        $inventario->tipo = 'chuches';
        $inventario->cantidad = $cantidadAleatoria;

        Auth::user()->inventario()->save($inventario);

        return response()->json(['message' => 'Inventario aleatorio creado correctamente'], 200);
    } catch (\Exception $e) {
        // Manejar el error y devolver una respuesta apropiada
        return response()->json(['error' => 'Error al crear inventario aleatorio: ' . $e->getMessage()], 500);
    }
}

}