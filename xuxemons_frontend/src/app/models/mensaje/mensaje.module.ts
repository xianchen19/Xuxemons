import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';



@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ]
})
export class Mensajes { 
  username: string;
  tag: number;
  message: string;
  status: '';
  date: string;

  constructor() {
    this.username = '';
    this.tag = 0;
    this.message = '';
    this.status = '';
    this.date = '';
  }
}
