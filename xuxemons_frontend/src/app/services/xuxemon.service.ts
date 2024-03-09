// xuxemon.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Xuxemon } from '../models/xuxemon/xuxemon.module'; // Importa el modelo Xuxemon

@Injectable({
  providedIn: 'root'
})
export class XuxemonService {

  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) { }

  getListaXuxemons(): Observable<Xuxemon[]> { // Usa el tipo Xuxemon[] en lugar de any[]
    return this.http.get<Xuxemon[]>(`${this.apiUrl}/xuxemons`);
  }

  deleteXuxemon(id: number): Observable<Xuxemon> {
    return this.http.delete<Xuxemon>(`${this.apiUrl}/xuxemons/${id}`);
  }

  editarXuxemon(xuxemon: Xuxemon): Observable<any> {

    return this.http.put<Xuxemon>(`${this.apiUrl}/xuxemons/${xuxemon.id}`, xuxemon);

  }
  
}
