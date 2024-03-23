import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { UsuarioService } from '../services/usuario.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {
  
  constructor(private usuarioService: UsuarioService, private router: Router) {}

  formRegister: FormGroup = new FormGroup({
    name: new FormControl('', [Validators.required]),
    email: new FormControl('', [Validators.required, Validators.email]),
    password: new FormControl('', [Validators.required, Validators.minLength(8)]),
    confirmPassword: new FormControl('', [Validators.required]),
  });

  register() {
    if (this.formRegister.valid) { 
      const userData = {
        name: this.formRegister.get('name')?.value,
        email: this.formRegister.get('email')?.value,
        password: this.formRegister.get('password')?.value
      };
      
      this.usuarioService.register(userData).subscribe(
        (response) => {
          console.log('Registro exitoso:', response);
          this.router.navigate(['/login']);
        },
        (error) => {
          console.error('Error al registrar:', error);
        }
      );
    } else {
      console.error('El formulario es inválido');
    }
  }

}
