import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProductPricingComponent } from './product-pricing.component';

describe('ProductPricingComponent', () => {
  let component: ProductPricingComponent;
  let fixture: ComponentFixture<ProductPricingComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProductPricingComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProductPricingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
