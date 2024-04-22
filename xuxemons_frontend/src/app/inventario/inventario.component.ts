import { Component, OnInit } from '@angular/core';
import { InventarioService } from '../services/inventario.service';
import { Inventario } from '../models/inventario/inventario.module';

@Component({
  selector: 'app-inventario',
  templateUrl: './inventario.component.html',
  styleUrls: ['./inventario.component.css']
})
export class InventarioComponent implements OnInit {

  inventario: Inventario[] = [];
  rol  = sessionStorage.getItem('rol');
  diaChuchesDiarias: string | null = sessionStorage.getItem('diaChuchesDiarias');

  constructor(private inventarioService: InventarioService) { }

  ngOnInit(): void {
    this.obtenerInventario();
  }

  obtenerInventario(): void {
    
    if(sessionStorage.getItem('rol')==='administrador') {
      this.inventarioService.getInventarioAdmin().subscribe(
        (response: Inventario[]) => {
          this.inventario = response;
        },
        error => {
          console.error('Error al obtener el inventario:', error);
        }
      );
    } else if (sessionStorage.getItem('rol')==='usuario') {
      this.inventarioService.getInventarioUser().subscribe(
        (response: Inventario[]) => {
          this.inventario = response;
        },
        error => {
          console.error('Error al obtener el inventario:', error);
        }
      );
  }
}

  generarChuche(): void {
    this.inventarioService.getRandomChuche().subscribe(
      (response: any) => {
        this.inventario.push(response);
        this.obtenerInventario();
      },
      error => {
        console.error('Error al generar la chuche:', error);
      }
    );
  }

  chuchesDiarias(): void {
    const diaSistema = new Date().toLocaleDateString();
    if (this.diaChuchesDiarias !== diaSistema) {
      this.inventarioService.addDailyChuches().subscribe(
        (response: any) => {
          this.diaChuchesDiarias = diaSistema;
          sessionStorage.setItem('diaChuchesDiarias', this.diaChuchesDiarias);
          this.obtenerInventario();
        },
        error => {
          console.error('Error al añadir chuches diarias:', error);
        }
      );
    } else {
      console.log('Ya se han recogido las chuches diarias hoy.');
    }
  }

}
