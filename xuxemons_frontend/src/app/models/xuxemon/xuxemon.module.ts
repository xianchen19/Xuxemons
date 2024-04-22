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
  activo: number;
  bajon_azucar: number;
  sobredosis_azucar: number;
  atracon: number;



  constructor() {
    this.id = 0;
    this.nombre = '';
    this.tipo = '';
    this.tamano = 0;
    this.vida = 0;
    this.archivo = '';
    this.activo = 0;
    this.bajon_azucar = 0;
    this.sobredosis_azucar = 0;
    this. atracon = 0;
  }
}