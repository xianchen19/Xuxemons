<?php

namespace App\Http\Controllers;

use App\Models\amigos;
use App\Models\solicitudes;
use App\Models\User;
use Illuminate\Http\Request;


class amigosController extends Controller
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
    
            // Obtener la lista de amigos del usuario excluyendo aquellos con estado 'rechazado'
            $amigos = $user->amigos()->where('status', '!=', 'rechazada')->get();
    
            return response()->json($amigos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al obtener los amigos del usuario'], 500);
        }
    }
    

    
public function store(Request $request)
{
    try {
        // Obtener el email del usuario del encabezado de la solicitud
        $email = $request->header('email');

        // Buscar al usuario que envía la solicitud por su email
        $sender = User::where('email', $email)->first();
        if (!$sender) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener el tag del amigo al que se enviará la solicitud
        $friendTag = $request->input('friend_tag');

        // Verificar si el amigo ya está en la lista de amigos del usuario
        if ($sender->amigos()->where('friend_tag', $friendTag)->exists()) {
            return response()->json(['error' => 'El usuario ya es tu amigo'], 400);
        }

        // Crear una nueva solicitud de amistad
        $amigo = new amigos([
            'user_tag' => $sender->tag,
            'friend_tag' => $friendTag,
            'status' => 'pendiente'
        ]);
        $amigo->save();

        return response()->json(['message' => 'Solicitud de amistad enviada con éxito'], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'A ocurrido un error al enviar la solicitud:' . $e->getMessage()], 500);
    }           
}

public function aceptarSolicitud($solicitudId)
{
    // Encuentra la solicitud de amistad por su ID
    $solicitud = amigos::find($solicitudId);

    // Verifica si la solicitud existe
    if (!$solicitud) {
        return response()->json(['error' => 'Solicitud de amistad no encontrada'], 404);
    }

    // Marca la solicitud como aceptada
    $solicitud->update(['status' => 'aceptada']);

    // Opcionalmente, realiza otras acciones como agregar al remitente a la lista de amigos del destinatario

    return response()->json(['message' => 'Solicitud de amistad aceptada con éxito'], 200);
}

public function rechazarSolicitud($solicitudId)
{
    // Encuentra la solicitud de amistad por su ID
    $solicitud = amigos::find($solicitudId);

    // Verifica si la solicitud existe
    if (!$solicitud) {
        return response()->json(['error' => 'Solicitud de amistad no encontrada'], 404);
    }

    // Marca la solicitud como rechazada
    $solicitud->update(['status' => 'rechazada']);

    return response()->json(['message' => 'Solicitud de amistad rechazada con éxito'], 200);
}

public function buscarUsuarios(Request $request)
{
    try {
        $query = $request->input('query');

        // Realizar la búsqueda en la base de datos
        $usuarios = User::where('tag', 'like', "%$query%")->get();

        return response()->json($usuarios, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al buscar usuarios'], 500);
    }
}


}
