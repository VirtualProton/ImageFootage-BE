import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ContributorSignUpComponent } from './contributor-sign-up.component';

describe('ContributorSignUpComponent', () => {
  let component: ContributorSignUpComponent;
  let fixture: ComponentFixture<ContributorSignUpComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ContributorSignUpComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ContributorSignUpComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
