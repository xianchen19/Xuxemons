import { Component, OnInit, Input } from '@angular/core';
import { Mensajes } from '../models/mensaje/mensaje.module';
import { ChatService } from '../services/chat.service';
import { ActivatedRoute } from '@angular/router';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

@Component({
  selector: 'app-chat',
  templateUrl: './chat.component.html',
  styleUrls: ['./chat.component.css'],
})
export class ChatComponent implements OnInit {
  mensajes: Mensajes[] = [];
  nuevoMensaje = '';
  echo?: Echo;
  tagUsuario: string = '';
  friendUsername: string = '';

  constructor(private chatService: ChatService, private route: ActivatedRoute) {}

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.tagUsuario = params['tagUsuario'];
      this.friendUsername = params['usuario'];
      if (this.tagUsuario) {
        this.obtenerChat(this.tagUsuario);
      }

      (window as any).Pusher = Pusher;

      this.echo = new Echo({
        broadcaster: 'pusher',
        key: '6d0738cd673b2556062a',
        cluster: 'eu',
        encrypted: true,
      });

      this.echo.channel('chat').listen('.message', (data: Mensajes) => {
        this.mensajes.push(data);
      });
    });
  }

  obtenerChat(tagUsuario: string): void {
    this.chatService.obtenerChat(tagUsuario).subscribe(
      (response: Mensajes[]) => {
        console.log(response);
        this.mensajes= response;
      },
      error => {
        console.error('Error al obtener el chat:', error);
      }
    );
  }

  enviar(): void {
    this.chatService.enviarMensaje(this.nuevoMensaje, this.tagUsuario).subscribe(() => (this.nuevoMensaje = ''));
    console.log(this.mensajes);
  }

  borrarChat(): void {
    this.chatService.borrarChat(this.tagUsuario).subscribe(
      (response: any) => {
        console.log(response.message);
        this.obtenerChat(this.tagUsuario);
      },
      error => {
        console.error('Error al borrar el chat:', error);
      }
    );
  }
}
