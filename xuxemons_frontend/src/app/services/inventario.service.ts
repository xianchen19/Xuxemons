import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Inventario } from '../models/inventario/inventario.module';

@Injectable({
  providedIn: 'root'
})
export class InventarioService {

  private apiUrl = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) { }

  getRandomChuche(): Observable<Inventario> {
    const headers = this.httpHeaders();
    return this.http.get<Inventario>(`${this.apiUrl}/randomChuche`, { headers });
  }

  getInventarioUser(): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.get<Inventario>(`${this.apiUrl}/inventario`, { headers });
  }

  getInventarioAdmin(): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.get<Inventario>(`${this.apiUrl}/inventarioAdmin`, { headers });
  }

  httpHeaders(): HttpHeaders {
    const email = sessionStorage.getItem('email');
    if (email) {
      return new HttpHeaders().set('Email', email);
    }
    return new HttpHeaders();
  }
  
}
