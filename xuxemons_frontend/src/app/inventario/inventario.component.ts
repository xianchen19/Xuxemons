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

}
