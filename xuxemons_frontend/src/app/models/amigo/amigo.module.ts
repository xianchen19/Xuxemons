import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';



@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ]
})

export class Amigos {
  user_tag: string;
  friend_tag: string;
  status: string;

  constructor() {
    this.user_tag = '';
    this.friend_tag = '';
    this.status = '';
  }
}
