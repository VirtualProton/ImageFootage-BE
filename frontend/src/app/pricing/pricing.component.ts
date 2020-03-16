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
  footageplansData:any =[];
  yearly:boolean = true;
  monthly:boolean = false;
  pimages:boolean = true;
  pfootages:boolean = false;
  submitted = false;
  submitted2 = false;
  submitted3 = false;
  submitted4= false;
  submitted5=false;
  paymentShow:boolean  =false;
  selectedData:any = [];
  selectedPlanType:string ='';
  public currentUser: any;
  subscriptionmonthlyform: FormGroup;
  footagehdform:FormGroup;
  footagekform:FormGroup;
 showloginPopup:boolean=false;

  constructor(private route: ActivatedRoute,private heroService: HeroService,private authenticationService: HeroService, private router: Router,private formBuilder: FormBuilder) {
      this.authenticationService.currentUser.subscribe(x => {
          this.currentUser = x;
      });
  }


  ngOnInit() {
    this.loadingData = true;

    this.authenticationService.getSubscriptionData()
        .subscribe(
            data => {
              this.loadingData = false;
              if(data.status=='success'){
                 this.plansData = data.data.Image;
                 this.footageplansData = data.data.Footage;
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
      this.subscriptionmonthlyform = this.formBuilder.group({
          submplan: ['', [Validators.required]]
      });

      this.footagehdform = this.formBuilder.group({
          hdfplan: ['', [Validators.required]]
      });
      this.footagekform = this.formBuilder.group({
          kfplan: ['', [Validators.required]]
      });
  }
  get f() { return this.planform.controls; }
  get g() { return this.subscriptionform.controls; }
  get h() { return this.subscriptionmonthlyform.controls; }
  get i() { return this.footagehdform.controls; }
  get j() { return this.footagekform.controls; }
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
  showpricefoot(){
	  this.pimages= !this.pimages;
	  this.pfootages=!this.pfootages;
  }

  onSubmit() {
      if (!this.currentUser) {
          this.showloginPopup = true;
     }else {
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
          this.paymentShow = true;
          this.loadingData = false;
          this.plansData["download_pack"].forEach(element => {

              if (element["package_id"] == this.planform.value.plan) {
                  this.selectedData = element;
                  this.selectedPlanType = 'Download Plan for 1 Year';
              }
          });
          console.log(this.planform.value);
		  

          //localStorage.setItem('billing_address', JSON.stringify(this.planform.value));
          window.scrollTo(0, 0)
      }
  }

  onSubmitsubscription(){
      if (!this.currentUser) {
          this.showloginPopup = true;
      }else {
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
          this.paymentShow = true;
          this.loadingData = false;
          this.plansData["yearly_pack"].forEach(element => {
              if (element["package_id"] == this.subscriptionform.value.subplan) {
                  this.selectedData = element;
                  this.selectedPlanType = 'Anuual Plan';
              }
          });

          console.log(this.selectedData);
          //localStorage.setItem('billing_address', JSON.stringify(this.planform.value));
          window.scrollTo(0, 0)
      }
  }
    onSubmitmonthsubscription(){
        if (!this.currentUser) {
            this.showloginPopup = true;
        }else {
            this.loadingData = true;
            this.submitted3 = true;
            //console.log(this.checkoutForm);
            // stop here if form is invalid
            if (this.subscriptionmonthlyform.invalid) {
                console.log('at invalid');
                this.loadingData = false;
                //console.log(this.checkoutForm);
                return;
            }
            this.paymentShow = true;
            this.loadingData = false;

            this.plansData["monthly_pack"].forEach(element => {
                if (element["package_id"] == this.subscriptionmonthlyform.value.submplan) {
                    this.selectedData = element;
                    this.selectedPlanType = 'Monthly Plan';
                }
            });
            console.log(this.selectedData);
            //localStorage.setItem('billing_address', JSON.stringify(this.planform.value));
            window.scrollTo(0, 0)
        }
    }

    onSubmitfoothd(){
        if (!this.currentUser) {
            this.showloginPopup = true;
        }else {
            this.loadingData = true;
            this.submitted4 = true;
            //console.log(this.checkoutForm);
            // stop here if form is invalid
            if (this.footagehdform.invalid) {
                console.log('at invalid');
                this.loadingData = false;
                //console.log(this.checkoutForm);
                return;
            }
            this.paymentShow = true;
            this.loadingData = false;

            this.footageplansData.download_pack['HD'].forEach(element => {
                if (element["package_id"] == this.footagehdform.value.hdfplan) {
                    this.selectedData = element;
                    this.selectedPlanType = 'HD Footage Plan';
                }
            });
            console.log(this.selectedData);
            //localStorage.setItem('billing_address', JSON.stringify(this.planform.value));
            window.scrollTo(0, 0)
        }
    }

    onSubmitfk(){
        if (!this.currentUser) {
            this.showloginPopup = true;
        }else {
            this.loadingData = true;
            this.submitted5 = true;
            //console.log(this.checkoutForm);
            // stop here if form is invalid
            if (this.footagekform.invalid) {
                console.log('at invalid');
                this.loadingData = false;
                //console.log(this.checkoutForm);
                return;
            }
            this.paymentShow = true;
            this.loadingData = false;

            this.footageplansData.download_pack['4K'].forEach(element => {
                if (element["package_id"] == this.footagekform.value.kfplan) {
                    this.selectedData = element;
                    this.selectedPlanType = '4K Footage Plan';
                }
            });
            console.log(this.selectedData);
            //localStorage.setItem('billing_address', JSON.stringify(this.planform.value));
            window.scrollTo(0, 0)
        }
    }
  purchagePlanPayment(paymentgatway){
    this.loadingData = true;
    console.log(paymentgatway);

    this.authenticationService.paymentplan(this.selectedData,paymentgatway)
    // .pipe(first())
        .subscribe(
            data2 => {

              // alert("Sucessfully Registered");
              console.log(data2.url);
              console.log(paymentgatway);
              this.loadingData = false;
              if(paymentgatway=='atom')  {
                window.location.href = data2.url;
              }else if(paymentgatway=='payu'){
                console.log(data2);
                //this.hash = data2.hash;
                window.location.href = data2.url;
                //document.getElementById('payuform').onsubmit;
                //this.payuData = data2;
              }

              //this.router.navigate([data2.url]);
              // console.log(data2);
              // console.log(data2.message);
              // console.log(data2["message"]);
              // if(data2.status=='1'){
              //   alert(data2.message);
              //   this.router.navigate(['/']);
              // }else{
              //   alert(data2.message);
              // }

            },
            error => {
              this.loadingData = false;
            });
  }


    hideLoginPopup(event){
        this.showloginPopup = false;
        if(event){

        }
    }

}
