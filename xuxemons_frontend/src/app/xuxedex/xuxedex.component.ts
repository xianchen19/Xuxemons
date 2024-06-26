import { Component, OnInit } from '@angular/core';
import { XuxedexService } from '../services/xuxedex.service';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';

@Component({
  selector: 'app-xuxedex',
  templateUrl: './xuxedex.component.html',
  styleUrls: ['./xuxedex.component.css'],
})
export class XuxedexComponent implements OnInit {

  xuxemonsfiltrar: Xuxemon[] = [];
  listaXuxemons: Xuxemon[] = [];

  constructor(private xuxedexService: XuxedexService) { }

  ngOnInit(): void {
    this.mostrarTodos();
  }

  mostrarXuxemon(xuxemon: Xuxemon): void {
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
  

}