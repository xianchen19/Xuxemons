import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  isLoggedIn = false;
  isAdmin = false;

  constructor(private authService: AuthService, private router: Router, private location: Location) {}

  ngOnInit() {
    this.isLoggedIn = this.authService.checkLoggedIn();
  }

  logout() {
    this.authService.logout();
     // Si la ruta actual es /landscape, recarga la página
     if (this.location.path() === '/landscape') {
      window.location.reload();
    }
  }
}
