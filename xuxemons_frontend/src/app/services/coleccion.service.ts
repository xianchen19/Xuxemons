import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';

@Injectable({
  providedIn: 'root'
})
export class ColeccionService {

  private apiUrl = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) { }

  getListaXuxemonsAdmin(): Observable<Xuxemon[]> {
    const headers = this.httpHeaders();
    return this.http.get<Xuxemon[]>(`${this.apiUrl}/xuxemons`, { headers });
  }

  getListaXuxemonsUser(): Observable<Xuxemon[]> {
    const headers = this.httpHeaders();
    return this.http.get<Xuxemon[]>(`${this.apiUrl}/xuxemons/user`, { headers });
  }

  randomXuxemon(): Observable<Xuxemon> {
    const headers = this.httpHeaders();
    return this.http.get<Xuxemon>(`${this.apiUrl}/random_xuxemon`, { headers });
  }

  giveChuche(xuxemonId: number, candyAmount: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.post<any>(`${this.apiUrl}/give_chuche/${xuxemonId}/${candyAmount}`, {} , { headers });
  }

  checkInfeccion(xuxemonId: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.post<any>(`${this.apiUrl}/infeccion/${xuxemonId}`, {} , { headers });
  }

  checkEvolucion(xuxemonId: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.post<any>(`${this.apiUrl}/evolucion/${xuxemonId}`, {} , { headers });
  }

  // Agrega un console log para verificar el email aquí
  activarXuxemon(xuxemonId: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.put<any>(`${this.apiUrl}/xuxemons/${xuxemonId}/activate`, {}, { headers });
  }

  // Agrega un console log para verificar el email aquí
  desactivarXuxemon(xuxemonId: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.put<any>(`${this.apiUrl}/xuxemons/${xuxemonId}/deactivate`, {}, { headers }); 
  }
  
  httpHeaders(): HttpHeaders {
    const email = sessionStorage.getItem('email');
    
    if (email) {
      return new HttpHeaders().set('Email', email);
    }
    return new HttpHeaders();
  }
}
