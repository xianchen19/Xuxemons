<?php

namespace App\Http\Controllers;

use App\Models\evo_config;
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
}
