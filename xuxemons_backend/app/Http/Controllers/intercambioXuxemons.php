<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\intercambios;
use App\Models\solicitudes;
use App\Models\User;
use App\Models\user_xuxemons;



class intercambioXuxemons extends Controller
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
        $amigos = $user->intercambios()->where('status', 'aceptada')
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
        // Obtener el ID del Xuxemon para el intercambio
        $xuxemonId = $request->input('xuxemon_id');

        // Verificar si el Xuxemon existe en el inventario del usuario
        $xuxemon = $sender->xuxemons()->where('xuxemons.id', $xuxemonId)->first();
        if (!$xuxemon) {
            return response()->json(['error' => 'Xuxemon no encontrado en el inventario del usuario'], 404);
        }

        // Buscar si ya existe una solicitud de intercambio con el mismo friend_tag y xuxemon_id
        $existingExchange = intercambios::where('friend_tag', $friendTag)
                                                ->where('xuxemon_id', $xuxemonId)
                                                ->first();
            if ($existingExchange) {
                if ($existingExchange->status === 'aceptada') {
                        return response()->json(['error' => 'El intercambio ya fue aceptado'], 400);
                } elseif ($existingExchange->status === 'rechazada') {
                        $existingExchange->update(['status' => 'pendiente']);
                        return response()->json(['message' => 'Solicitud de intercambio enviada con éxito'], 201);
                } else {
                return response()->json(['error' => 'Ya has enviado una solicitud de intercambio con este Xuxemon a este usuario'], 400);
            }
        }
        
         // Crear una nueva solicitud de intercambio
         $intercambio = new IntercambioXuxemons([
            'user_tag' => $sender->tag,
            'friend_tag' => $friendTag,
            'xuxemon_id' => $xuxemonId,
            'status' => 'pendiente'
        ]);
        $intercambio->save();

        return response()->json(['message' => 'Solicitud de intercambio enviada con éxito'], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al enviar la solicitud: ' . $e->getMessage()], 500);
    }
}

public function solicitudesIntercambioPendientes(Request $request)
{
    try {
        // Obtener el email del usuario del encabezado de la solicitud
        $email = $request->header('email');

        // Buscar al usuario por su email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener las solicitudes de intercambio pendientes del usuario utilizando la función solicitudesIntercambio()
        $solicitudes = $user->solicitudesIntercambio;

        return response()->json($solicitudes, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al obtener las solicitudes de intercambio pendientes del usuario'], 500);
    }
}


public function aceptarSolicitud($userTag, $xuxemonIdUsuarioActual)
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

        // Encuentra la solicitud de intercambio por el user_tag y friend_tag
        $solicitud = intercambios::where('user_tag', $userTag)
            ->where('friend_tag', $userTagActual)
            ->first();

       // Verifica si la solicitud existe
       if (!$solicitud) {
        return response()->json(['error' => 'Solicitud de intercambio no encontrada'], 404);
         }

        // Marca la solicitud como aceptada
        $solicitud->update(['status' => 'aceptada']);

        // Obtener el Xuxemon que el usuario solicitante está dispuesto a intercambiar
        $xuxemonIdSolicitante = $solicitud->xuxemon_id;

        // Verificar que ambos Xuxemons existan en la tabla user_xuxemons
        $xuxemonUsuarioActual = User_Xuxemons::where('user_id', $usuario->id)
            ->where('xuxemons_id', $xuxemonIdUsuarioActual)
            ->first();

        $xuxemonSolicitante = User_Xuxemons::where('user_id', User::where('tag', $userTag)->first()->id)
            ->where('xuxemons_id', $xuxemonIdSolicitante)
            ->first();

        if (!$xuxemonUsuarioActual || !$xuxemonSolicitante) {
            return response()->json(['error' => 'Uno o ambos Xuxemons no encontrados en el inventario'], 404);
        }

        // Intercambiar los Xuxemons entre los usuarios
        $xuxemonUsuarioActual->update(['user_id' => User::where('tag', $userTag)->first()->id]);
        $xuxemonSolicitante->update(['user_id' => $usuario->id]);

        // Crear una nueva solicitud de intercambio inversa para el otro usuario
        $intercambioInverso = new IntercambioXuxemons([
            'user_tag' => $userTagActual,
            'friend_tag' => $userTag,
            'xuxemon_id' => $xuxemonIdUsuarioActual,
            'status' => 'aceptada'
        ]);
        $intercambioInverso->save();

        return response()->json(['message' => 'Intercambio de Xuxemons aceptado con éxito'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al aceptar el intercambio de Xuxemons: ' . $e->getMessage()], 500);
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

    // Encuentra la solicitud de intercambio por el user_tag y friend_tag
    $solicitud = intercambios::where('user_tag', $userTag)
        ->where('friend_tag', $userTagActual)
        ->first();

    // Verifica si la solicitud existe
    if (!$solicitud) {
        return response()->json(['error' => 'Solicitud de intercambio no encontrada'], 404);
    }

    // Marca la solicitud como rechazada
    $solicitud->update(['status' => 'rechazada']);

    return response()->json(['message' => 'Solicitud de intercambio rechazada con éxito'], 200);
}

}
