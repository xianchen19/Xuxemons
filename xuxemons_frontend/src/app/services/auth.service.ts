// auth.service.ts
import { Injectable } from '@angular/core';
import { UsuarioService } from './usuario.service';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  isLoggedIn = false;

  constructor(private usuarioService: UsuarioService, private router: Router) {}

  login(rememberMe: boolean, email: string) {
    this.isLoggedIn = true;

    sessionStorage.setItem('email', email);

    if (rememberMe) {
      localStorage.setItem('isLoggedIn', 'true');
    } else {
      sessionStorage.setItem('isLoggedIn', 'true');
    }
  }
  
  logout() {
    this.isLoggedIn = false;
    localStorage.removeItem('isLoggedIn');
    sessionStorage.removeItem('isLoggedIn');
    sessionStorage.removeItem('email');
  }

  checkLoggedIn(): boolean {
    const localStorageLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const sessionStorageLoggedIn = sessionStorage.getItem('isLoggedIn') === 'true';
    
    return localStorageLoggedIn || sessionStorageLoggedIn;
  }
}
