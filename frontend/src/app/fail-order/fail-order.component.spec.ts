import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FailOrderComponent } from './fail-order.component';

describe('FailOrderComponent', () => {
  let component: FailOrderComponent;
  let fixture: ComponentFixture<FailOrderComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FailOrderComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FailOrderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
