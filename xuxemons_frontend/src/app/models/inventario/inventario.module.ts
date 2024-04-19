import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ]
})
export class Inventario {
  nombre: string;
  tipo: string;
  cantidad: number;
  descripcion: string;
  imagen: string;

  constructor() {
    this.nombre = '';
    this.tipo = '';
    this.cantidad = 0;
    this.descripcion = '';
    this.imagen = '';
  }
}