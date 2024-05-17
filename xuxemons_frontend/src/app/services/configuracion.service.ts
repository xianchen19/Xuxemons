import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ConfiguracionService {

  private apiUrl = 'http://127.0.0.1:8000'; // Cambia esta URL por la de tu API

  constructor(private http: HttpClient) { }

  changeConfig(nivel: any, chuches: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/configurations/${nivel}`, chuches);
  }

  changeChuchesDiarias(chuchesDiarias: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/configurations/chuches-diarias`, { chuchesDiarias });
  }

  changePorcentajeInfeccion(bajonAzucar: number, sobredosisAzucar: number, atraccon: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/enfermedades/configuracion`, { bajonAzucar, sobredosisAzucar, atraccon });
  }

  changeBajonAzucar(chuches: number): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/enfermedades/configuracion`, { chuches });
  }
}
