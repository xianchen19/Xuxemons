import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ConfiguracionService {

  private apiUrl = 'http://127.0.0.1:8000'; // Cambia esta URL por la de tu API

  constructor(private http: HttpClient) { }

  changeConfig(newConfig: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/configuration`, newConfig);
  }
}