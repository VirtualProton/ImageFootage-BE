import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import {ActivatedRoute, Router} from '@angular/router';
import {NgxSpinnerService} from "ngx-spinner";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'pricing',
  templateUrl: './pricing.component.html',
  styleUrls: ['./pricing.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class PricingComponent implements OnInit {

  loadingData:boolean=false;
  planform: FormGroup;
  subscriptionform: FormGroup;
  plansData:any =[];
  yearly:boolean = true;
  monthly:boolean = false;
  submitted = false;
  submitted2 = false;
  paymentShow:boolean  =false;
  selectedData:any = [];
  constructor(private route: ActivatedRoute,private heroService: HeroService, private authenticationService: HeroService, private router: Router,private formBuilder: FormBuilder) {
  }


  ngOnInit() {
    this.loadingData = true;
    this.authenticationService.getSubscriptionData()
        .subscribe(
            data => {
              this.loadingData = false;
              if(data.status=='success'){
                this.plansData = data.data;
                this.loadingData = false;
              }else{
                alert(data.message);
              }

              //this.spinner.hide();
            },
            error => {

            });
    this.planform = this.formBuilder.group({
      plan: ['', [Validators.required]]

    });
    this.subscriptionform = this.formBuilder.group({
      subplan: ['', [Validators.required]]
    });


  }
  get f() { return this.planform.controls; }
  get g() { return this.subscriptionform.controls; }
  showperImgPrice(pack){
      if(pack.package_expiry_yearly==1 && pack.package_plan==2){
         var perprice = pack.package_price/(12*pack.package_products_count);
      }else if(pack.package_expiry_yearly==0 && pack.package_plan==2){
        var perprice = pack.package_price/pack.package_products_count;
      }else{
        var perprice = pack.package_price/pack.package_products_count;
      }
      return perprice;
  }
  showprice(){
    this.yearly = !this.yearly;
    this.monthly = !this.monthly;
  }

  onSubmit() {
    this.loadingData = true;
    this.submitted = true;
    //console.log(this.checkoutForm);
    // stop here if form is invalid
    if (this.planform.invalid) {
      console.log('at invalid');
      this.loadingData = false;
      //console.log(this.checkoutForm);
      return;
    }
    this.paymentShow  =true;
    this.loadingData = false;
    console.log(this.planform.value);
    this.selectedData ;
    //localStorage.setItem('billing_address', JSON.stringify(this.planform.value));
    window.scrollTo(0, 0)
  }

  onSubmitsubscription(){
    this.loadingData = true;
    this.submitted2 = true;
    //console.log(this.checkoutForm);
    // stop here if form is invalid
    if (this.subscriptionform.invalid) {
      console.log('at invalid');
      this.loadingData = false;
      //console.log(this.checkoutForm);
      return;
    }
    this.paymentShow  =true;
    this.loadingData = false;
    console.log(this.subscriptionform.value);
    //localStorage.setItem('billing_address', JSON.stringify(this.planform.value));
     window.scrollTo(0, 0)
  }

}
