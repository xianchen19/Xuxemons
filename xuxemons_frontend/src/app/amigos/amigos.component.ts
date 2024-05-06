import { Component, OnInit } from '@angular/core';
import { Usuario } from '../models/usuario/usuario.module';
import { Amigos } from '../models/amigo/amigo.module';
import { AmigoService } from '../services/amigo.service';

@Component({
  selector: 'app-amigos',
  templateUrl: './amigos.component.html',
  styleUrls: ['./amigos.component.css'],
})
export class AmigosComponent implements OnInit {

  amigos: Usuario[] = [];
  solicitudesAmigos: Usuario[] = [];
  busquedaAmigos: Usuario[] = [];
  terminoBusqueda: string = '';
  mostrarSolicitudes: boolean = false;

  constructor(private amigoService: AmigoService) { }

  ngOnInit(): void {
    this.obtenerAmigos();
    this.obtenerSolicitudesPendientes();
  }

  obtenerAmigos(): void {
    this.amigoService.getListaAmigos().subscribe(
      (response: Usuario[]) => {
        console.log(response);
        this.amigos = response;
      },
      error => {
        console.error('Error:', error);
      }
    );
  }

  buscarAmigos(): void {
    this.amigoService.buscarAmigo(this.terminoBusqueda).subscribe(
      (response: Usuario[]) => {
        this.busquedaAmigos = response;
      },
      error => {
        console.error('Error:', error);
      }
    );
  }

  agregarAmigo(tag: string): void {
    this.amigoService.enviarSolicitudAmistad(tag).subscribe(
      (response: any) => {
        console.log(response.message);
      },
      error => {
        console.error('Error al enviar solicitud de amistad:', error);
      }
    );
  }

  obtenerSolicitudesPendientes(): void {
    this.amigoService.obtenerSolicitudesPendientes().subscribe(
      (response: Usuario[]) => {
        console.log(response);
        this.solicitudesAmigos = response;
      },
      error => {
        console.error('Error al obtener solicitudes pendientes:', error);
      }
    );
  }

 esSolicitudPendiente(usuario: Usuario): boolean {
    return this.solicitudesAmigos.some(solicitud => solicitud.tag === usuario.tag);
  }

  aceptarSolicitud(tag: string): void {
    this.amigoService.aceptarSolicitud(tag).subscribe(
      (response: any) => {
        console.log(response.message);
        this.obtenerSolicitudesPendientes();
      },
      error => {
        console.error('Error al aceptar solicitud de amistad:', error);
      }
    );
  }

  rechazarSolicitud(tag: string): void {
    this.amigoService.rechazarSolicitud(tag).subscribe(
      (response: any) => {
        console.log(response.message);
        this.obtenerSolicitudesPendientes();
      },
      error => {
        console.error('Error al rechazar solicitud de amistad:', error);
      }
    );
  }


}
