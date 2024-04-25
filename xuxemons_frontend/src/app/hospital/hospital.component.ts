import { Component, OnInit } from '@angular/core';
import { HospitalService } from '../services/hospital.service';
import { Xuxemon } from '../models/xuxemon/xuxemon.module';

@Component({
  selector: 'app-hospital',
  templateUrl: './hospital.component.html',
  styleUrls: ['./hospital.component.css'],
})
export class HospitalComponent  implements OnInit {

  xuxemonsEnfermos: Xuxemon[] = [];

  constructor(private hospitalService: HospitalService) { }

  ngOnInit(): void {
    this.obtenerXuxemonsEnfermos();
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

    curarXuxemon() {

    }

}
