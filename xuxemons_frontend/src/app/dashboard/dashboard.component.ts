import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import xuxemonsData from '../xuxemons.json';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  rol = sessionStorage.getItem('rol');
  xuxemons: any[] = xuxemonsData;

  constructor(protected router: Router) {}

  ngOnInit(): void {
  }
}
