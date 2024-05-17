// xuxemon.service.ts
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';

@Injectable({
  providedIn: 'root'
})
export class XuxemonService {

  private apiUrl = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) { }

  getListaXuxemons(): Observable<Xuxemon[]> {
    const headers = this.httpHeaders();
    return this.http.get<Xuxemon[]>(`${this.apiUrl}/xuxemons`, { headers });
  }

  deleteXuxemon(id: number): Observable<Xuxemon> {
    const headers = this.httpHeaders();
    return this.http.delete<Xuxemon>(`${this.apiUrl}/xuxemons/${id}`, { headers });
  }

  editarXuxemon(id: number, xuxemon: Xuxemon): Observable<Xuxemon> {
    const headers = this.httpHeaders();
    return this.http.put<Xuxemon>(`${this.apiUrl}/xuxemons/${id}`, xuxemon, { headers });
  }

  xuxemonAleatorio(): Observable<Xuxemon> {
    const headers = this.httpHeaders();
    return this.http.get<Xuxemon>(`${this.apiUrl}/randomXuxemonAdmin`, { headers });
  }
  
  crearXuxemon(xuxemon: Xuxemon): Observable<Xuxemon> {
    const headers = this.httpHeaders();
    return this.http.post<Xuxemon>(`${this.apiUrl}/xuxemons`, xuxemon, { headers });
  }

  httpHeaders(): HttpHeaders {
    const email = sessionStorage.getItem('email');
    if (email) {
      return new HttpHeaders().set('Email', email);
    }
    return new HttpHeaders();
  }
  
}
