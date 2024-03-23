// admin-dashboard.component.ts
import { Component, OnInit } from '@angular/core';
import { XuxemonService } from '../services/xuxemon.service';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';

@Component({
  selector: 'app-admin-dashboard',
  templateUrl: './admin-dashboard.component.html',
  styleUrls: ['./admin-dashboard.component.css']
})
export class AdminDashboardComponent implements OnInit {

  xuxemons: Xuxemon[] = [];
  xuxemonEditando: Xuxemon | null = null;
  xuxemonCreacion: boolean = false;


  constructor(private xuxemonService: XuxemonService) { }

  ngOnInit(): void {
    this.obtenerXuxemons();
  }

  obtenerXuxemons(): void {
    this.xuxemonService.getListaXuxemons().subscribe(
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

  eliminarXuxemon(id: number): void {
    if (window.confirm('¿Estás seguro de que deseas eliminar este Xuxemon?')) {
      this.xuxemonService.deleteXuxemon(id).subscribe(() => {
        this.xuxemons = this.xuxemons.filter(xuxemon => xuxemon.id !== id);
      });
    }
  }
  
  editarXuxemon(xuxemon: Xuxemon) {
    this.xuxemonEditando = xuxemon;
  }

  cancelarEdicion() {
    this.xuxemonEditando = null;
  }

  guardarCambiosEditXuxemon() {
    this.xuxemonEditando = null;
  }

  mostrarCreacionXuxemon() {
    this.xuxemonCreacion = true;
  }
  
  ocultarCreacionXuxemon() {
    this.xuxemonCreacion = false;
  }
  
  xuxemonCreado() {
    this.xuxemonCreacion = false;
    this.obtenerXuxemons();
  }

  xuxemonDebug() {
    this.xuxemonService.xuxemonAleatorio().subscribe(
      (xuxemon: Xuxemon) => {
        this.xuxemons.push(xuxemon);
        this.obtenerXuxemons();
      },
      error => {
        console.error('Error al obtener Xuxemons aleatorios:', error);
      }
    );
  }
  

}
