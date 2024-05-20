import { Component, OnInit } from '@angular/core';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';
import xuxemonJson from '../../assets/json/xuxemons.json';

interface XuxemonJSON {
  id: number;
  nombre: string;
  tipo: string;
  tamano: number;
  archivo: string;
}

@Component({
  selector: 'app-xuxedex',
  templateUrl: './xuxedex.component.html',
  styleUrls: ['./xuxedex.component.css'],
})
export class XuxedexComponent implements OnInit {

  listaXuxemons: XuxemonJSON[] = xuxemonJson as XuxemonJSON[];
  xuxemons: XuxemonJSON[] = xuxemonJson as XuxemonJSON[];

  constructor() { }

  ngOnInit(): void {
    console.log(this.xuxemons);
  }

  mostrarTodos(): void{
    this.xuxemons = xuxemonJson as XuxemonJSON[];
  }

  filtrarPorTipo(tipo: string): void {
    this.xuxemons = this.listaXuxemons.filter((xuxemon: XuxemonJSON) => xuxemon.tipo.includes(tipo));
  }

}

/* mostrarXuxemon(xuxemon: Xuxemon): void {
    this.listaXuxemons.push(xuxemon);
  }

  mostrarTodos(): void {
    this.xuxedexService.obtenerTodos().subscribe(
      {
        next: (response: any[]) => {
          console.log(response);
          this.listaXuxemons = response[0];
        },
        error: error =>{
          console.error('Error:', error);
        }
      }
    );
  }

  filtrarPorTipo(tipo: string): void {
    this.xuxedexService.obtenerTodos().subscribe(
      {
        next: (response: any[]) => {
          console.log(response);
          this.listaXuxemons = response[0].filter((xuxemon: Xuxemon) => xuxemon.tipo.includes(tipo));
        },
        error: error => {
          console.error('Error al obtener xuxemons por tipo:', error);
        }
      }
    );
  }
  */