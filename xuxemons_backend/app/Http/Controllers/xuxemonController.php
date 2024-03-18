<?php

namespace App\Http\Controllers;

use App\Models\xuxemons;
use Illuminate\Http\Request;


class xuxemonController extends Controller
{
   public function index()
    {
        $xuxemons = xuxemons::all(); //coger todos los productos del modelo
        //dd($xuxemons);
        return response()->json([$xuxemons, 200]);   
    }

    public function create()
    {  
        $xuxemons = xuxemons::all(); //coger todas las categorias del modelo
        return response()->json(['message' => 'Xuxemon actualizado correctamente', 200]);
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
        $xuxemon = new xuxemons();
        $xuxemon->nombre = $request->nombre;
        $xuxemon->tipo = $request->tipo;
        $xuxemon->tamano = $request->tamano;
        $xuxemon->vida = $request->vida;
        $xuxemon->archivo = $request->archivo;
        $xuxemon->save();

        return response()->json(['message' => 'Xuxemon creado correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al crear el Xuxemon'], 404);
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

    public function destroy($id)
    {
        try {
            //buscar el producto que queremos eliminar
            $xuxemon = xuxemons::findOrFail($id);
            $xuxemon->delete();
    
            return response()->json(['message' => 'Xuxemon eliminado correctamente', 200]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'A ocurrido un error al eliminar'], 404);
        }
    }
    
    public function randomXuxemon()
    {
        // Obtener un Xuxemon aleatorio de la base de datos
        $xuxemon = xuxemons::inRandomOrder()->first();
    
        // Verificar si se encontró un Xuxemon
        if ($xuxemon) {
            // Actualizar la vida del Xuxemon seleccionado como 100
            $xuxemon->vida = 100;
    
            // Actualizar el tamaño del Xuxemon seleccionado con un valor del enum: pequeño, mediano o grande
            $xuxemon->tamano = $xuxemon->getTamanoOptions()[array_rand($xuxemon->getTamanoOptions())];
    
            $xuxemon->save();
    
            return response()->json(['message' => 'Xuxemon aleatorio actualizado correctamente'], 200);
        } else {
            // No se encontró ningún Xuxemon en la base de datos
            return response()->json(['error' => 'No se encontró ningún Xuxemon en la base de datos'], 404);
        }
    }
};
