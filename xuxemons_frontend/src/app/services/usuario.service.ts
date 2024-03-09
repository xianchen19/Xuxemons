import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Usuario } from '../models/usuario/usuario.module';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {
  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) { }

  login(userdata: Usuario ) {
    return this.http.post(`${this.apiUrl}/userLogin`, userdata);
  }

  register(userData: Usuario) {
    return this.http.post(`${this.apiUrl}/userRegister`, userData);
  }
  
}
