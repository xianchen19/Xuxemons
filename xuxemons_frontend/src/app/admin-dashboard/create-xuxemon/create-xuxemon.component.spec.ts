import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateXuxemonComponent } from './create-xuxemon.component';

describe('CreateXuxemonComponent', () => {
  let component: CreateXuxemonComponent;
  let fixture: ComponentFixture<CreateXuxemonComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [CreateXuxemonComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CreateXuxemonComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
