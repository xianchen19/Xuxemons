import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';



@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ]
})
export class Usuario {
  name: string;
  email: string;
  password: string;
  tag: string;

  constructor() {
    this.name = "";
    this.email = "";
    this.password = "";
    this.tag = '';
  }
 }
