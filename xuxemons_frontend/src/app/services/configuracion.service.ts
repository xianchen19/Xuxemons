import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ConfiguracionService {

  private apiUrl = 'http://127.0.0.1:8000'; // Cambia esta URL por la de tu API

  constructor(private http: HttpClient) { }

  changeConfig(nivel: any, chuches: any): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.put<any>(`${this.apiUrl}/configurations/${nivel}/${chuches}`, {}, { headers });
  }

  changeChuchesDiarias(chuchesDiarias: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.put<any>(`${this.apiUrl}/configurations/chuches-diarias`, { chuchesDiarias }, { headers });
  }

  changePorcentajeInfeccion(bajonAzucar: number, sobredosisAzucar: number, atracon: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.put<any>(`${this.apiUrl}/enfermedades/configuracion`, { bajonAzucar, sobredosisAzucar, atracon }, { headers });
  }

  changeBajonAzucar(chuches: number): Observable<any> {
    const headers = this.httpHeaders();
    return this.http.put<any>(`${this.apiUrl}/enfermedades/confBajon`, { chuches }, { headers });
  }

  httpHeaders(): HttpHeaders {
    const email = sessionStorage.getItem('email');
    
    if (email) {
      return new HttpHeaders().set('Email', email);
    }
    return new HttpHeaders();
  }
}
