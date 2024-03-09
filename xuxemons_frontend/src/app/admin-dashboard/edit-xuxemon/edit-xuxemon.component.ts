// app-edit-xuxemon.component.ts
import { Component, Input } from '@angular/core';
import { Xuxemon } from '../../models/xuxemon/xuxemon.module';

@Component({
  selector: 'app-edit-xuxemon',
  templateUrl: './edit-xuxemon.component.html',
  styleUrls: ['./edit-xuxemon.component.css']
})
export class EditXuxemonComponent {
  @Input() xuxemon: Xuxemon | null = null;

  constructor() { }

  guardarCambios() {
    
  }
}
