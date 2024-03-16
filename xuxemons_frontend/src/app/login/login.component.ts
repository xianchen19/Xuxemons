import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { UsuarioService } from '../services/usuario.service';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
import { Usuario } from '../models/usuario/usuario.module';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  
  constructor(
    private usuarioService: UsuarioService,
    private authService: AuthService,
    private router: Router
  ) {}

  formLogin: FormGroup = new FormGroup({
    email: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
    rememberMe: new FormControl(false)
  });

  login() {
    if (this.formLogin.valid) { 
      const userData: Usuario = {
        name: '',
        email: this.formLogin.get('email')?.value,
        password: this.formLogin.get('password')?.value
      };
      
      const rememberMe = this.formLogin.get('rememberMe')?.value;
      const email = this.formLogin.get('email')?.value;

      this.usuarioService.login(userData).subscribe(
        (response) => {
          console.log('Inicio exitoso:', response);
          this.authService.login(rememberMe, email);
          this.router.navigate(['/dashboard']);
        },
        (error) => {
          console.error('Error al iniciar sesión:', error);
        }
      );
    } else {
      console.error('El formulario es inválido');
    }
  }

}
