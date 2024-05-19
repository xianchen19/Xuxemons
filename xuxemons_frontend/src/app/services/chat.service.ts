import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Mensajes } from '../models/mensaje/mensaje.module';

@Injectable({
  providedIn: 'root'
})
export class ChatService {
  private apiUrl = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) { }

  obtenerChat(tag: string) {
    const headers = this.httpHeaders();
    return this.http.get<Mensajes[]>(`${this.apiUrl}/chat/${tag}` , { headers });
  }

  enviarMensaje(mensaje: string, tag: string): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.post<any>(`${this.apiUrl}/mensaje/${tag}`, { mensaje }, { headers });
  }

  borrarChat(tag: string): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.delete<any>(`${this.apiUrl}/borrarChat?friend_tag=${tag}` , { headers });
  }

  httpHeaders(): HttpHeaders {
    const email = sessionStorage.getItem('email');
    if (email) {
      return new HttpHeaders().set('Email', email);
    }
    return new HttpHeaders();
  }

}
