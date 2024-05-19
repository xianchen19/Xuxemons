<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chat;
use App\Events\Message;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    
    public function index(Request $request, $friendTag)
{
    // Obtener el email del usuario del encabezado de la solicitud
    $email = $request->header('Email');
    
    // Buscar al usuario que envía la solicitud por su email
    $sender = User::where('email', $email)->first();
    if (!$sender) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }
    
    // Buscar al usuario amigo por su tag
    $friend = User::where('tag', $friendTag)->first();
    if (!$friend) {
        return response()->json(['error' => 'Usuario amigo no encontrado'], 404);
    }
    
    // Obtener todos los registros de la tabla Chats donde el userTag y el friendTag correspondan y el estado sea 'enviado'
    $chats = Chat::where(function ($query) use ($sender, $friend) {
        $query->where('userTag', $sender->tag)->where('friendTag', $friend->tag)->where('email', $sender->email)
              ->orWhere('userTag', $friend->tag)->where('friendTag', $sender->tag)->where('email', $sender->email);
    })->orderBy('created_at', 'asc')->get();
    
    // Crear un array para almacenar los chats con los usuarios
    $chatsWithUsers = [];
    
    // Iterar sobre los chats y agregar el campo 'name' del usuario asociado a cada chat
    foreach ($chats as $chat) {
        $chatWithUser = $chat->toArray(); // Convertir el chat a array
    
        if ($chat->status == 'enviado' && $chat->userTag == $sender->tag) {
            $chatWithUser['username'] = $sender->name; // Nombre del usuario que envió el mensaje
        } elseif ($chat->status == 'recibido' && $chat->friendTag == $friend->tag) {
            $chatWithUser['username'] = $friend->name; // Nombre del amigo que recibió el mensaje
        }
    
        // Agregar el campo 'status' al array del chat
        $chatWithUser['status'] = $chat->status;
    
        $chatsWithUsers[] = $chatWithUser;
    }

    return response()->json($chatsWithUsers, 200);
}

    public function enviarMensaje(Request $request, $friendTag)
{
    // Obtener el email del usuario del encabezado de la solicitud
    $email = $request->header('Email');

    // Buscar al usuario que envía la solicitud por su email
    $sender = User::where('email', $email)->first();
    if (!$sender) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $receiver = User::where('tag', $friendTag)->first();
    if (!$receiver) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Guardar el campo tag y username en variables
    $tag = $sender->tag;
    $username = $sender->name;
    
    $friendEmail = $receiver->email;

    // Obtener el mensaje del cuerpo de la solicitud como un objeto
    $mensaje = $request->input('mensaje');

    // Crear un nuevo registro de chat para el usuario que envía el mensaje con status 'enviado'
    $chatSender = new Chat();
    $chatSender->userTag = $tag;
    $chatSender->friendTag = $friendTag;
    $chatSender->email = $email;
    $chatSender->message = $mensaje;
    $chatSender->status = 'enviado';
    $chatSender->created_at = now();
    $chatSender->save();

    // Crear un nuevo registro de chat para el usuario amigo al que se envía el mensaje con status 'recibido'
    $chatFriend = new Chat();
    $chatFriend->userTag = $friendTag;
    $chatFriend->friendTag = $tag;
    $chatFriend->email = $friendEmail;
    $chatFriend->message = $mensaje;
    $chatFriend->status = 'recibido';
    $chatFriend->created_at = now();
    $chatFriend->save();

    // Emitir el evento Message
    event(new Message($username, $tag, $mensaje));

    return response()->json(['message' => 'Mensaje enviado con éxito'], 201);
}


public function destroy(Request $request)
{
    // Obtener el email del usuario del encabezado de la solicitud
    $email = $request->header('Email');

    // Buscar al usuario por su email
    $user = User::where('email', $email)->first();
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Obtener el tag del amigo al que se eliminará la conversación
    $friendTag = $request->input('friend_tag');

    // Eliminar los registros de chat del usuario que coinciden con las condiciones especificadas
    Chat::where(function ($query) use ($user, $friendTag, $email) {
        $query->where('userTag', $user->tag)
              ->where('friendTag', $friendTag)
              ->where('email', $email);
    })->orWhere(function ($query) use ($user, $friendTag, $email) {
        $query->where('userTag', $friendTag)
              ->where('friendTag', $user->tag)
              ->where('email', $email);
    })->delete();

    return response()->json(['message' => 'Registros de chat eliminados con éxito'], 200);
}




}
