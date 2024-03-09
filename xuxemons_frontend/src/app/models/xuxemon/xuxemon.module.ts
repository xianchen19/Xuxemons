import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ]
})
export class Xuxemon { 
  id: number;
  nombre: string;
  tipo: string;
  tamano: number;
  vida: number;
  archivo: string;

  constructor() {
    this.id = 0;
    this.nombre = '';
    this.tipo = '';
    this.tamano = 0;
    this.vida = 0;
    this.archivo = '';
  }
}