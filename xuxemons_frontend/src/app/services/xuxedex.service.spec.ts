import { TestBed } from '@angular/core/testing';

import { XuxedexService } from './xuxedex.service';

describe('XuxedexService', () => {
  let service: XuxedexService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(XuxedexService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
