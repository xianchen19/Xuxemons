<?php

namespace App\Http\Controllers;

use App\Models\xuxemons;
use Illuminate\Http\Request;


class xuxemonController extends Controller
{
     public function index()
    {
        $xuxemons = xuxemons::all(); // Obtener todos los xuxemons
        return view('index', compact('xuxemons')); 
    }

    public function create()
    {  
        $xuxemons = xuxemons::all(); //coger todas las categorias del modelo
        return view('crearXuxemon',['xuxemons' => $xuxemons]);
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'imagen' => 'required|string',
        'nombre' => 'required|string',
        'tipo' => 'required|string',
        'tamaño' => 'required|integer',
        'vida' => 'r    equired|integer',
        'archivo' => 'required|string',
    ]);

    try {
        // Crear el xuxemon en la base de datos
        $xuxemon = new xuxemons();
        $xuxemon->imagen = $request->imagen;
        $xuxemon->nombre = $request->nombre;
        $xuxemon->tipo = $request->tipo;
        $xuxemon->tamaño = $request->tamaño;
        $xuxemon->vida = $request->vida;
        $xuxemon->archivo = $request->archivo;
        $xuxemon->save();

        return redirect()->route('categorias.index')->with('crearExito', 'Categoria creado correctamente.');

    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Error al crear la categoria: ' . $e->getMessage());
    }
}
    public function show($id)
    {
        $xuxemon = xuxemons::findOrFail($id); // buscar el id de ese producto en especifico
        return view('administrador.categorias.verCategoria', ['xuxemon' => $xuxemon]);
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
                'imagen' => 'required|string',
                'nombre' => 'required|string',
                'tipo' => 'required|string',
                'tamaño' => 'required|integer',
                'vida' => 'required|integer',
                'archivo' => 'required|string',
            ]);
    
            // Buscar el xuxemon
            $xuxemon = xuxemons::findOrFail($id);
    
            // Actualizar en la base de datos
            $xuxemon->update([
                'imagen' => $request->imagen,
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'tamaño' => $request->tamaño,
                'vida' => $request->vida,
                'archivo' => $request->archivo,
            ]);
    
            return redirect()->route('categorias.index')->with('actualizarExito', 'Categoria actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar la Categoria: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            //buscar el producto que queremos eliminar
            $xuxemon = xuxemons::findOrFail($id);
            $xuxemon->delete();
    
            return redirect()->route('categorias.index')->with('deleteExito', 'Categoria eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function randomXuxemon()
    {
            // Array de nombres y tipos
        $nombres = ['Blastoise', 'Reshiram', 'Zekrom']; // Agrega aquí tus nombres
        $tipos = ['Agua', 'Tierra', 'Aire']; // Agrega aquí tus tipos

        // Elegir aleatoriamente un nombre y un tipo
        $nombreAleatorio = $nombres[array_rand($nombres)];
        $tipoAleatorio = $tipos[array_rand($tipos)];

        // Generar otros valores aleatorios para los campos
        $tamaño = rand(1, 100); // Tamaño aleatorio entre 1 y 100
        $vida = rand(1, 100); // Vida aleatoria entre 1 y 100

        // Crear el xuxemon en la base de datos
        $xuxemon = new xuxemons();
        $xuxemon->nombre = $nombreAleatorio;
        $xuxemon->tipo = $tipoAleatorio;
        $xuxemon->tamaño = $tamaño;
        $xuxemon->vida = $vida;

        $xuxemon->save();

        return redirect()->route('xuxemons.index')->with('success', 'Xuxemon aleatorio creado correctamente');
    }
   /* public function index()
    {
        $xuxemons = xuxemons::all(); //coger todos los productos del modelo
        return response()->json([$xuxemons,'message' => 'Xuxemon Index', 200]);   
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
        'imagen' => 'required|string',
        'nombre' => 'required|string',
        'tipo' => 'required|string',
        'tamaño' => 'required|integer',
        'vida' => 'r    equired|integer',
        'archivo' => 'required|string',
    ]);

    try {
        // Crear el xuxemon en la base de datos
        $xuxemon = new xuxemons();
        $xuxemon->imagen = $request->imagen;
        $xuxemon->nombre = $request->nombre;
        $xuxemon->tipo = $request->tipo;
        $xuxemon->tamaño = $request->tamaño;
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
        return response()->json(['message' => 'Mostrando xuxemons', 200]);
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
                'imagen' => 'required|string',
                'nombre' => 'required|string',
                'tipo' => 'required|string',
                'tamaño' => 'required|integer',
                'vida' => 'required|integer',
                'archivo' => 'required|string',
            ]);
    
            // Buscar el xuxemon
            $xuxemon = xuxemons::findOrFail($id);
    
            // Actualizar en la base de datos
            $xuxemon->update([
                'imagen' => $request->imagen,
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'tamaño' => $request->tamaño,
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
    
            return response()->json(['message' => 'Usuario eliminado correctamente', 200]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'A ocurrido un error al eliminar'], 404);
        }
    }

    public function randomXuxemon()
    {
            // Array de nombres y tipos
        $nombres = ['Blastoise', 'Reshiram', 'Zekrom']; // Agrega aquí tus nombres
        $tipos = ['Agua', 'Tierra', 'Aire']; // Agrega aquí tus tipos

        // Elegir aleatoriamente un nombre y un tipo
        $nombreAleatorio = $nombres[array_rand($nombres)];
        $tipoAleatorio = $tipos[array_rand($tipos)];

        // Generar otros valores aleatorios para los campos
        $tamaño = rand(1, 100); // Tamaño aleatorio entre 1 y 100
        $vida = rand(1, 100); // Vida aleatoria entre 1 y 100

        // Crear el xuxemon en la base de datos
        $xuxemon = new xuxemons();
        $xuxemon->nombre = $nombreAleatorio;
        $xuxemon->tipo = $tipoAleatorio;
        $xuxemon->tamaño = $tamaño;
        $xuxemon->vida = $vida;

        $xuxemon->save();

        return response()->json(['message' => 'Xuxemon aleatorio creado correctamente'], 200);
    }*/
}
