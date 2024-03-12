import { Component, OnInit } from '@angular/core';
import xuxemonsData from '../xuxemons.json';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  xuxemons: any[] = xuxemonsData;

  constructor() { }

  ngOnInit(): void {
  }
}
