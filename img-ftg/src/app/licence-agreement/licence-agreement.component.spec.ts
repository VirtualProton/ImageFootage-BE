import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LicenceAgreementComponent } from './licence-agreement.component';

describe('LicenceAgreementComponent', () => {
  let component: LicenceAgreementComponent;
  let fixture: ComponentFixture<LicenceAgreementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LicenceAgreementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LicenceAgreementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
