import { Component, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { XuxemonService } from '../../services/xuxemon.service';
import { Xuxemon } from '../../models/xuxemon/xuxemon.module';

@Component({
  selector: 'app-create-xuxemon',
  templateUrl: './create-xuxemon.component.html',
  styleUrls: ['./create-xuxemon.component.css']
})
export class CreateXuxemonComponent {

  @Output() xuxemonCreado = new EventEmitter<void>();
  @Output() cancelarCreacion = new EventEmitter<void>();

  xuxemonForm: FormGroup;

  constructor(private fb: FormBuilder, private xuxemonService: XuxemonService) {
    this.xuxemonForm = this.fb.group({
      nombre: ['', Validators.required],
      tipo: ['', Validators.required],
      tamano: [null, Validators.required],
      vida: [null, Validators.required],
      archivo: ['', Validators.required]
    });
  }

  crearXuxemon() {
    const nuevoXuxemon: Xuxemon = this.xuxemonForm.value;
    this.xuxemonService.crearXuxemon(nuevoXuxemon).subscribe(() => {
      this.xuxemonCreado.emit();
    }, error => {
      console.error('Error al crear el Xuxemon:', error);
    });
  }

  cancelar() {
    this.cancelarCreacion.emit();
  }
}
