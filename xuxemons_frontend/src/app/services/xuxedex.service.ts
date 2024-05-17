import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';

@Injectable({
  providedIn: 'root'
})
export class XuxedexService {

  private apiUrl = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) { }

  obtenerTodos(): Observable<Xuxemon[]> {
    const headers = this.httpHeaders();
    return this.http.get<Xuxemon[]>(`${this.apiUrl}/xuxemons`, { headers });
  }
  
  httpHeaders(): HttpHeaders {
    const email = sessionStorage.getItem('email');
    if (email) {
      return new HttpHeaders().set('Email', email);
    }
    return new HttpHeaders();
  }

}
