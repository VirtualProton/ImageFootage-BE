import {Component, OnInit, ViewEncapsulation, HostListener, Inject} from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { cartItemData } from '../hero';
import { HeroService } from '../hero.service';
import { Router } from '@angular/router';
import { first } from 'rxjs/operators';
import {imageFooterHelper} from "../_helpers/image-footer-helper";
import { NgxSpinnerService } from "ngx-spinner";
declare var Razorpay: any;

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class CheckoutComponent implements OnInit {

  checkoutForm: FormGroup;
  wishListDataItems:Array<cartItemData>=[];
  priceArray:any=[];
  loading = false;
  submitted = false;
  stateInfo: any[] = [];
  countryInfo: any[] = [];
  cityInfo: any[] = [];
  taxPrice:any =10;
  loadingData:boolean=false;
  paymentShow:boolean=false;
  payuData:any ='';
  firstname:string='';
  lastname:string='';
  address:string='';
  city:string='';
  state:string='';
  country:string='';
  postal_code:string='';
  totalPrice:number=0;
  payuForm: FormGroup;
  hash:any='';
  rozResponse:any ='';
  public currentUser: any;
  constructor(private authenticationService: HeroService,private router: Router, private formBuilder: FormBuilder,private dataHelper:imageFooterHelper,private spinner: NgxSpinnerService) {
      this.authenticationService.currentUser.subscribe(x => {
          this.currentUser = x;
          if(!this.currentUser){
              this.router.navigate(['/']);
          }

      });
  }
 @HostListener('window:scroll', [])
  onWindowScroll() {
    if (document.body.scrollTop > 20 ||     
    document.documentElement.scrollTop > 20) {
      document.getElementById('navbarResponsive').classList.remove('show');
      //document.getElementById('paragraph').classList.add('green');
    }
  }
  ngOnInit() {
      //this.spinner.show();
        this.loadingData = true;
      let billing_address = localStorage.getItem('billing_address');
      if(billing_address){
          let billdata = JSON.parse(billing_address);
          this.onChangeCountry(billdata.country);
          this.onChangeState(billdata.state);
          this.checkoutForm = this.formBuilder.group({
              first_name: [billdata.first_name, Validators.required],
              last_name: [billdata.last_name, Validators.required],
              address: [billdata.address, Validators.required],
              country: [billdata.country, Validators.required],
              state: [billdata.state, Validators.required],
              city: [billdata.city, Validators.required],
              pincode: [billdata.pincode, [Validators.required, Validators.minLength(6), Validators.maxLength(6)]],
              terms: [false, Validators.requiredTrue]
            });
      }else {
          this.checkoutForm = this.formBuilder.group({
              first_name: ['', Validators.required],
              last_name: ['', Validators.required],
              address: ['', Validators.required],
              country: ['', Validators.required],
              state: ['', Validators.required],
              city: ['', Validators.required],
              pincode: ['', [Validators.required, Validators.minLength(6), Validators.maxLength(6)]],
              //paymentGatway :['', Validators.required],
              terms: [false, Validators.requiredTrue]

          });
      }
    this.getCountries();
	this.getUserAddress();
    this.authenticationService.getcartItemsData()
              .subscribe(
                  data => {
                    this.wishListDataItems=data;
                    this.wishListDataItems.forEach(element => {
                      console.log(element);
                      this.priceArray.push(element["total"]);
                    });
                     // this.spinner.hide();
                      this.loadingData = false;
                  },
                  error => {
                     
                  });

  }
  getUserAddress(){
    this.authenticationService.getUserAddress()
      .subscribe(data => {
		  this.firstname=data.data.first_name;
		  this.lastname=data.data.last_name;
		  this.address=data.data.address;
		  this.country=data.data.country;
          this.state=data.data.state;
          this.city=data.data.city;
          this.postal_code=data.data.postal_code;
      });
  }
    get f() { return this.checkoutForm.controls; }
    getCountries(){
        this.authenticationService.allCountries().
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.countryInfo=data2;
                //console.log('Data:', this.countryInfo);
            },
            err => console.log(err),
            () => console.log('complete')
        )
    }

    onChangeCountry(countryValue) {
        this.loadingData = true;
        let billing_address = localStorage.getItem('billing_address');
        if(billing_address) {
            var billing_state = JSON.parse(billing_address);
            billing_state['state'] = '';
            billing_state['city'] = '';
            localStorage.setItem('billing_address', JSON.stringify(billing_state));
        }
        //  console.log(this.countryInfo[countryValue]);
        this.authenticationService.allstates(countryValue).
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.stateInfo=data2;
                this.loadingData = false;
                //console.log('Data:', this.countryInfo);
            },
            err => console.log(err),
            () => console.log('complete')
        )

        // this.registerForm.controls['country'].setValue(this.countryInfo[countryValue].CountryName);
        // this.stateInfo=this.countryInfo[countryValue].States;
        // this.cityInfo=this.stateInfo[0].Cities;
        //  console.log(this.cityInfo);
    }
    onChangeCity(cityValue){
        // console.log(this.cityInfo[cityValue]);
        // this.registerForm.controls['city'].setValue(this.cityInfo[cityValue]);
    }
    onChangeState(stateValue) {
        this.loadingData = true;
        let billing_address = localStorage.getItem('billing_address');
        if(billing_address) {
            var billing_state = JSON.parse(billing_address);
            billing_state['city'] = '';
            localStorage.setItem('billing_address', JSON.stringify(billing_state));
        }
        // console.log(this.stateInfo[stateValue]);
        this.authenticationService.allCities(stateValue).
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.cityInfo=data2;
                this.loadingData = false;
                //console.log('Data:', this.countryInfo);
            },
            err => console.log(err),
            () => console.log('complete')
        )

        // this.registerForm.controls['state'].setValue(this.stateInfo[stateValue].StateName);
        // this.cityInfo=this.stateInfo[stateValue].Cities;
        // console.log(this.cityInfo);j
    }
    onSubmit() {
        this.loadingData = true;
        this.submitted = true;
        //console.log(this.checkoutForm);
        // stop here if form is invalid
        if (this.checkoutForm.invalid) {
            console.log('at invalid');
            this.loadingData = false;
            //console.log(this.checkoutForm);
            return;
        }
        this.paymentShow  =true;
        this.loadingData = false;
        localStorage.setItem('billing_address', JSON.stringify(this.checkoutForm.value));
        window.scrollTo(0, 0)
    }
    showTotalPrice(){
        this.totalPrice = this.priceArray.reduce(function(acc, val) { return acc + val; }, 0);
        return  this.totalPrice;
    }
    showTax() {
        return this.totalPrice*12/100;
    }
  goToWishList(){
    this.router.navigate(['/cart']);
  }

  onSubmitPayment(paymentgatway){
      this.loadingData = true;

      this.authenticationService.payment(this.checkoutForm.value,this.priceArray,paymentgatway)
      // .pipe(first())
          .subscribe(
              data2 => {
                if(paymentgatway=='atom')  {
                      this.loadingData = false;
                      window.location.href = data2.url;
                  }else if(paymentgatway=='payu'){
                      this.loadingData = false;
                     window.location.href = data2.url;
                  }else if(paymentgatway=='rozerpay'){
                    // window.location.href = data2;
                      var options = data2;

                          /**
                           * The entire list of Checkout fields is available at
                           * https://docs.razorpay.com/docs/checkout-form#checkout-fields
                           */
                          options.handler = this.razorpayRes.bind(this)
                      // function (response){
                      //         this.loading = true;
                      //         this.rozResponse = response;
                      //         //document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                      //         //document.getElementById('razorpay_signature').value = response.razorpay_signature;
                      //        // document.razorpayform.submit();
                      //         this.razorpayRes(this.rozResponse);
                      //
                      //         console.log(response);
                      //         console.log(response.razorpay_payment_id);
                      //         console.log(response.razorpay_signature);
                      //     };

                      // Boolean whether to show image inside a white frame. (default: true)
                      options.theme.image_padding = false;

                      options.modal = {
                          ondismiss: function() {
                              console.log("This code runs when the popup is closed");
                          },
                          // Boolean indicating whether pressing escape key
                          // should close the checkout form. (default: true)
                          escape: true,
                          // Boolean indicating whether clicking translucent blank
                          // space outside checkout form should close the form. (default: false)
                          backdropclose: false
                      };

                      var rzp = new Razorpay(options);
                      rzp.open();
                      event.preventDefault();
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
                  this.loading = false;
              });
    }

    editAddress(){
      this.paymentShow = false;
    }

    razorpayRes(payres){
        this.loadingData = true;
        this.authenticationService.razorponse(payres)
            .subscribe(data => {
                this.loadingData = false;
                window.location.href = data.url;
            });
    }


}
