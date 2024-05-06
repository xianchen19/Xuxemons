import { Component } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ConfiguracionService } from '../services/configuracion.service';

@Component({
  selector: 'app-configuracion',
  templateUrl: './configuracion.component.html',
  styleUrls: ['./configuracion.component.css'],
})
export class ConfiguracionComponent {

  configuracionForm: FormGroup;
  chuchesDiariasForm: FormGroup;
  porcentajeInfeccionForm: FormGroup;
  bajonAzucarForm: FormGroup;

  constructor(
    private fb: FormBuilder, 
    private configuracionService: ConfiguracionService
  ) { 

    this.configuracionForm = this.fb.group ({
      nivel: [null, Validators.required],
      chuches: [null, Validators.required]
    });

    this.chuchesDiariasForm = this.fb.group ({
      chuchesDiarias: [null, Validators.required]
    });

    this.porcentajeInfeccionForm = this.fb.group ({
      bajonAzucar: [null, Validators.required],
      sobredosisAzucar: [null, Validators.required],
      atracon: [null, Validators.required]
    });

    this.bajonAzucarForm = this.fb.group ({
      chuches: [null, Validators.required]
    });

  }

  changeConfig() {
    const nuevaConf = this.configuracionForm.value;
    const nivel = nuevaConf.nivel;
    const chuches = nuevaConf.chuches;
    this.configuracionService.changeConfig(nivel, chuches).subscribe(
      (response) => {
        console.log('Configuración actualizada exitosamente:', response);
      },
      (error) => {
        console.error('Error al actualizar la configuración:', error);
      }
    );
  }
  

  changeChuchesDiarias() {
    const chuchesDiarias = this.chuchesDiariasForm.value.chuchesDiarias;
    this.configuracionService.changeChuchesDiarias(chuchesDiarias).subscribe(
      (response) => {
        console.log('Chuches diarias actualizadas exitosamente:', response);
      },
      (error) => {
        console.error('Error al actualizar las chuches diarias:', error);
      }
    );
  }

  changePorcentajeInfeccion() {
    const porcentajeInfeccion = this.porcentajeInfeccionForm.value;
    this.configuracionService.changePorcentajeInfeccion(
      porcentajeInfeccion.bajonAzucar,
      porcentajeInfeccion.sobredosisAzucar,
      porcentajeInfeccion.atracon
    ).subscribe(
      (response) => {
        console.log('Porcentaje de infección actualizado exitosamente:', response);
      },
      (error) => {
        console.error('Error al actualizar el porcentaje de infección:', error);
      }
    );
  }
  

  changeBajonAzucar() {
    const chuches = this.bajonAzucarForm.value.chuches;
    this.configuracionService.changeBajonAzucar(chuches).subscribe(
      (response) => {
        console.log('Bajón de azúcar actualizado exitosamente:', response);
      },
      (error) => {
        console.error('Error al actualizar el bajón de azúcar:', error);
      }
    );
  }
  
}
