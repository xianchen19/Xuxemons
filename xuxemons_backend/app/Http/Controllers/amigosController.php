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

        // Obtener el user_tag del usuario actual
        $userTagActual = $user->tag;

        // Obtener la lista de amigos del usuario que han aceptado la solicitud
        $amigos = $user->amigos()->where('status', 'aceptada')
                                  ->where('user_tag', $userTagActual)
                                  ->get();

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
        $existingFriendship = $sender->amigos()->where('friend_tag', $friendTag)->first();
        if ($existingFriendship) {
            if ($existingFriendship->status === 'aceptada') {
                return response()->json(['error' => 'El usuario ya es tu amigo'], 400);
            } else {
                return response()->json(['error' => 'Ya has enviado una solicitud de amistad a este usuario'], 400);
            }
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


public function solicitudesPendientes(Request $request)
{
    try {
        // Obtener el email del usuario del encabezado de la solicitud
        $email = $request->header('email');

        // Buscar al usuario por su email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener las solicitudes de amistad pendientes del usuario utilizando la función solicitudesAmistad()
        $solicitudes = $user->solicitudesAmistad;

        return response()->json($solicitudes, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al obtener las solicitudes de amistad pendientes del usuario'], 500);
    }
}


public function aceptarSolicitud($userTag)
{
    try {
        // Obtener el email del usuario del encabezado de la solicitud
        $email = request()->header('email');

        // Buscar al usuario por su email
        $usuario = User::where('email', $email)->first();
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener el user_tag del usuario actual
        $userTagActual = $usuario->tag;

        // Encuentra la solicitud de amistad por el user_tag y friend_tag
        $solicitud = amigos::where('user_tag', $userTag)
        ->where('friend_tag', $userTagActual)
        ->first();

        // Verifica si la solicitud existe
        if (!$solicitud) {
            return response()->json(['error' => 'Solicitud de amistad no encontrada'], 404);
        }

        // Marca la solicitud como aceptada
        $solicitud->update(['status' => 'aceptada']);

        // Crea una nueva solicitud de amistad inversa para el otro usuario
        $amigoInverso = new amigos([
            'user_tag' => $userTagActual,
            'friend_tag' => $userTag,
            'status' => 'aceptada'
        ]);
        $amigoInverso->save();

        return response()->json(['message' => 'Solicitud de amistad aceptada con éxito'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al aceptar la solicitud de amistad: ' . $e->getMessage()], 500);
    }
}


    public function rechazarSolicitud($userTag)
    {

        // Obtener el email del usuario del encabezado de la solicitud
        $email = request()->header('email');

        // Buscar al usuario por su email
        $usuario = User::where('email', $email)->first();
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener el user_tag del usuario actual
        $userTagActual = $usuario->tag;

        // Encuentra la solicitud de amistad por el user_tag y friend_tag
        $solicitud = amigos::where('user_tag', $userTag)
        ->where('friend_tag', $userTagActual)
        ->first();

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
    // Obtener el email del usuario del encabezado de la solicitud
    $email = request()->header('email');

    try {
        // Buscar al usuario por su email
        $usuario = User::where('email', $email)->first();
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener el user_tag del usuario actual
        $userTagActual = $usuario->tag;

        $query = $request->input('query');

        // Separar los valores de usuario y tag si están en el formato usuario#000
        $valores = explode('#', $query);
        $usuario = $valores[0] ?? '';
        $tag = $valores[1] ?? '';

        // Realizar la búsqueda en la base de datos
        $queryBuilder = User::query();

        // Si se proporciona tanto usuario como tag, buscar por ambos
        if (!empty($usuario) && !empty($tag)) {
            $usuarios = $queryBuilder->where('name', 'like', "$usuario%")
                                     ->where('tag', 'like', "$tag%")
                                     ->where('tag', '!=', $userTagActual)
                                     ->get();
        } elseif (!empty($usuario)) {
            // Si solo se proporciona el usuario, buscar por usuario
            $usuarios = $queryBuilder->where('name', 'like', "$usuario%")
                                     ->where('tag', '!=', $userTagActual)
                                     ->get();
        } else {
            // Si solo se proporciona el tag, buscar por tag
            $usuarios = $queryBuilder->where('tag', 'like', "$tag%")
                                     ->where('tag', '!=', $userTagActual)
                                     ->get();
        }

        return response()->json($usuarios, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al buscar usuarios'], 500);
    }
}


}
