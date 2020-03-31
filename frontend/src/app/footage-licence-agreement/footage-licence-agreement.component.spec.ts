import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FootageLicenceAgreementComponent } from './footage-licence-agreement.component';

describe('FootageLicenceAgreementComponent', () => {
  let component: FootageLicenceAgreementComponent;
  let fixture: ComponentFixture<FootageLicenceAgreementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FootageLicenceAgreementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FootageLicenceAgreementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
