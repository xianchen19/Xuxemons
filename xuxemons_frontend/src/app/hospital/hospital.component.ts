import { Component, OnInit } from '@angular/core';
import { HospitalService } from '../services/hospital.service';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';
import { InventarioService } from '../services/inventario.service';
import { Inventario } from '../models/inventario/inventario.module';
import { MatDialog } from '@angular/material/dialog';

@Component({
  selector: 'app-hospital',
  templateUrl: './hospital.component.html',
  styleUrls: ['./hospital.component.css'],
})
export class HospitalComponent implements OnInit {

  xuxemonsEnfermos: Xuxemon[] = [];
  inventario: Inventario[] = [];
  xuxemonSeleccionado: any;
  objetoSeleccionado: any;
  mostrarDialogo = false;

  constructor(private hospitalService: HospitalService, private inventarioService: InventarioService, private dialog: MatDialog) { }

  ngOnInit(): void {
    this.obtenerXuxemonsEnfermos();
    this.obtenerInventario();
  }

  obtenerXuxemonsEnfermos(): void {
    this.hospitalService.getListaXuxemonsEnfermos().subscribe(
      (response: any[]) => {
        console.log(response);
        this.xuxemonsEnfermos = response[0];
      },
      error => {
        console.error('Error:', error);
      }
    );
  }

  obtenerInventario(): void {
    if (sessionStorage.getItem('rol') === 'administrador') {
      this.inventarioService.getInventarioAdmin().subscribe(
        (response: Inventario[]) => {
          this.inventario = response;
        },
        error => {
          console.error('Error al obtener el inventario:', error);
        }
      );
    } else if (sessionStorage.getItem('rol') === 'usuario') {
      this.inventarioService.getInventarioUser().subscribe(
        (response: Inventario[]) => {
          this.inventario = response;
        },
        error => {
          console.error('Error al obtener el inventario:', error);
        }
      );
    }
  }

  curarXuxemon(xuxemonId: any, objeto: any): void {
    this.hospitalService.curarXuxemon(xuxemonId, objeto).subscribe(
      response => {
        this.obtenerXuxemonsEnfermos();
        console.log('Xuxemon curado:', response);
      },
      error => {
        console.error('Error al curar Xuxemon:', error);
      }
    );
  }
  

  seleccionarObjeto(objetoNombre: any): void {
    this.objetoSeleccionado = objetoNombre;
    this.curarXuxemon(this.xuxemonSeleccionado, this.objetoSeleccionado);
  }

  seleccionarXuxemon(xuxemonId: any): void {
    this.xuxemonSeleccionado = xuxemonId;
    this.mostrarDialogo = true;
  }

}
