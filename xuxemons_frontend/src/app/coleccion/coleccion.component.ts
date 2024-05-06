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
  xuxemonsActivos: Xuxemon[] = [];

  constructor(private coleccionService: ColeccionService) { }

  ngOnInit(): void {
    this.obtenerXuxemons();
  }

  obtenerXuxemons(): void {
    if (sessionStorage.getItem('rol') === 'administrador') {
      this.coleccionService.getListaXuxemonsAdmin().subscribe(
        (response: any[]) => {
          console.log(response);
          this.xuxemons = response[0];
        },
        error => {
          console.error('Error:', error);
        }
      );
    } else if (sessionStorage.getItem('rol') === 'usuario') {
      this.coleccionService.getListaXuxemonsUser().subscribe(
        (response: Xuxemon[]) => {
          console.log(response);
          this.filtrarXuxemonsInactivos(response);
          this.filtrarXuxemonsActivos(response);
        },
        error => {
          console.error('Error:', error);
        }
      );
    }
  }
  
  filtrarXuxemonsActivos(xuxemons: any[]): void {
    this.xuxemonsActivos = xuxemons.filter(xuxemon => xuxemon['pivot'].activo === 1);
  }

  filtrarXuxemonsInactivos(xuxemons: any[]): void {
    this.xuxemons = xuxemons.filter(xuxemon => xuxemon['pivot'].activo === 0);
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
      (response: any) => {
        console.log('Chuches entregadas a Xuxemon');
        if (response.infeccion) {
          console.log(response.infeccion);
        }
        this.obtenerXuxemons();
      },
      error => {
        console.error('Error al dar de comer a Xuxemon:', error);
      }
    );
  }

  activarXuxemon(xuxemonId: number): void {
    this.coleccionService.activarXuxemon(xuxemonId).subscribe(
      (response: any) => {
        console.log(response.message);
        this.obtenerXuxemons();
      },
      error => {
        console.error('Error al activar Xuxemon:', error);
      }
    );
  }

  desactivarXuxemon(xuxemonId: number): void {
    this.coleccionService.desactivarXuxemon(xuxemonId).subscribe(
      (response: any) => {
        console.log(response.message);
        this.obtenerXuxemons();
      },
      error => {
        console.error('Error al desactivar Xuxemon:', error);
      }
    );
  }

}
  
