import { Component, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Xuxemon } from '../../models/xuxemon/xuxemon.module';
import { XuxemonService } from '../../services/xuxemon.service';

@Component({
  selector: 'app-edit-xuxemon',
  templateUrl: './edit-xuxemon.component.html',
  styleUrls: ['./edit-xuxemon.component.css']
})
export class EditXuxemonComponent {
  @Input() xuxemon: Xuxemon | null = null;
  @Output() cambiosGuardados = new EventEmitter<void>();
  @Output() cancelar = new EventEmitter<void>();

  xuxemonForm: FormGroup;

  constructor(private fb: FormBuilder, private xuxemonService: XuxemonService) {
    this.xuxemonForm = this.fb.group({
      nombre: ['', Validators.required],
      tipo: ['', Validators.required],
      tamano: ['', Validators.required],
      vida: [null, Validators.required],
      archivo: ['', Validators.required]
    });
  }

  ngOnChanges(): void {
    if (this.xuxemon) {
      this.xuxemonForm.patchValue({
        nombre: this.xuxemon.nombre,
        tipo: this.xuxemon.tipo,
        tamano: this.xuxemon.tamano,
        vida: this.xuxemon.vida,
        archivo: this.xuxemon.archivo
      });
    }
  }

  guardarCambios() {
    if (this.xuxemon) {
      const xuxemonEditado: Xuxemon = { ...this.xuxemonForm.value, id: this.xuxemon.id };
      this.xuxemonService.editarXuxemon(xuxemonEditado.id, xuxemonEditado).subscribe(() => {
        this.cambiosGuardados.emit();
      }, error => {
        console.error('Error al editar el Xuxemon:', error);
      });
    }
  }
  
  cancelarEdicion() {
    this.cancelar.emit();
  }
}
