import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuario } from '../models/usuario/usuario.module';

@Injectable({
  providedIn: 'root'
})
export class AmigoService {

  private apiUrl = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) { }

  getListaAmigos(): Observable<Usuario[]> {
    const headers = this.httpHeaders();
    return this.http.get<Usuario[]>(`${this.apiUrl}/amigos`, { headers });
  }

  buscarAmigo(query: string): Observable<Usuario[]> {
    const headers = this.httpHeaders();
    const params = { query };
    return this.http.get<Usuario[]>(`${this.apiUrl}/buscar-usuarios`, { headers, params });
  }

  enviarSolicitudAmistad(tag: string): Observable<any> {
    const headers = this.httpHeaders();
    const body = { friend_tag: tag };
    return this.http.post<any>(`${this.apiUrl}/amigos`, body, { headers });
  }

  obtenerSolicitudesPendientes(): Observable<Usuario[]> {
    const headers = this.httpHeaders();
    return this.http.get<Usuario[]>(`${this.apiUrl}/amigos/pendientes`, { headers });
  }

  aceptarSolicitud(userTag: string): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.post<any>(`${this.apiUrl}/amigos/aceptar/${userTag}`, {}, { headers });
  }

  rechazarSolicitud(userTag: string): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.post<any>(`${this.apiUrl}/amigos/rechazar/${userTag}`, {}, { headers });
  }

  eliminarAmigo(tag: string): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.delete<any>(`${this.apiUrl}/amigos?friend_tag=${tag}`, { headers });
  }

  httpHeaders(): HttpHeaders {
    const email = sessionStorage.getItem('email');
    if (email) {
      return new HttpHeaders().set('Email', email);
    }
    return new HttpHeaders();
  }
}
