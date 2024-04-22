import { Component} from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ConfiguracionService } from '../services/configuracion.service';

@Component({
  selector: 'app-configuracion',
  templateUrl: './configuracion.component.html',
  styleUrls: ['./configuracion.component.css'],
})
export class ConfiguracionComponent {

  configuracionForm: FormGroup;

  constructor(private fb: FormBuilder, private configuracionService: ConfiguracionService ) { 

    this.configuracionForm = this.fb.group ({
      nivel: [null, Validators.required],
      chuches: [null, Validators.required]
    });

  }

  changeConfig() {
    const nuevaConf = this.configuracionForm.value;
    
  }
  
}
