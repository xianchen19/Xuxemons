import { Component, OnInit } from '@angular/core';
import { ColeccionService } from '../services/coleccion.service';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';

@Component({
  selector: 'app-coleccion',
  templateUrl: './coleccion.component.html',
  styleUrls: ['./coleccion.component.css']
})
export class ColeccionComponent implements OnInit {

  xuxemons: Xuxemon[] = [];

  constructor(private coleccionService: ColeccionService) { }

  ngOnInit(): void {
    this.obtenerXuxemons();
  }

  obtenerXuxemons(): void {
    if (sessionStorage.getItem('rol')==='administrador') {
      this.coleccionService.getListaXuxemonsAdmin().subscribe(
        {
          next: (response: any[]) => {
            console.log(response);
            this.xuxemons = response[0];
          },
          error: error =>{
            console.error('Error:', error);
          }
        }
      );
    } else if (sessionStorage.getItem('rol')==='usuario') {
      this.coleccionService.getListaXuxemonsUser().subscribe(
        {
          next: (response: any[]) => {
            console.log(response);
            this.xuxemons = response[0];
          },
          error: error =>{
            console.error('Error:', error);
          }
        }
      );
    }
    
  }

  randomXuxemon(): void {
    this.coleccionService.randomXuxemon().subscribe(
      (xuxemon: Xuxemon) => {
        console.log('Xuxemon generado:', xuxemon);
        this.xuxemons.push(xuxemon);
      },
      error => {
        console.error('Error al generar Xuxemon aleatorio:', error);
      }
    );
  }

  giveChuche(xuxemonId: number, candyAmount: number): void {
    this.coleccionService.giveChuche(xuxemonId, candyAmount).subscribe(
      () => {
        console.log('Chuches entregadas a Xuxemon');
        this.obtenerXuxemons();
      },
      error => {
        console.error('Error al dar de comer a Xuxemon:', error);
      }
    );
  }
}
