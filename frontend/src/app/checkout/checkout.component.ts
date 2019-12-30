import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { cartItemData } from '../hero';
import { HeroService } from '../hero.service';
import { Router } from '@angular/router';
import { first } from 'rxjs/operators';
import {imageFooterHelper} from "../_helpers/image-footer-helper";
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
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
  
  constructor(private authenticationService: HeroService,private router: Router, private formBuilder: FormBuilder,private dataHelper:imageFooterHelper,private spinner: NgxSpinnerService) { }

  ngOnInit() {
      this.spinner.show();
 this.checkoutForm = this.formBuilder.group({
          first_name: ['', Validators.required],
          last_name: ['', Validators.required],
          address:['', Validators.required],
          country: ['', Validators.required],
          state: ['', Validators.required],
          city: ['', Validators.required],
          pincode:['', [Validators.required, Validators.minLength(6), Validators.maxLength(6)]],
          paymentGatway :['', Validators.required],

    });
    this.getCountries();
    this.authenticationService.getcartItemsData()
              .subscribe(
                  data => {
                    this.wishListDataItems=data;
                    this.wishListDataItems.forEach(element => {
                      console.log(element);
                      this.priceArray.push(element["total"]);
                    });
                      this.spinner.hide();
                  },
                  error => {
                     
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
        //  console.log(this.countryInfo[countryValue]);
        this.authenticationService.allstates(countryValue).
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.stateInfo=data2;
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
        // console.log(this.stateInfo[stateValue]);
        this.authenticationService.allCities(stateValue).
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.cityInfo=data2;
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
        this.submitted = true;
        // stop here if form is invalid
        if (this.checkoutForm.invalid) {
            console.log('at invalid');
            //console.log(this.checkoutForm);
            return;
        }
        // console.log(this.checkoutForm);
        this.authenticationService.payment(this.checkoutForm.value,this.priceArray)
           // .pipe(first())
            .subscribe(
                data2 => {
                   // alert("Sucessfully Registered");
                    console.log(data2);
                    console.log(data2.url);
                    window.location.href = data2.url;
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
    showTotalPrice(){

    return this.priceArray.reduce(function(acc, val) { return acc + val; }, 0);
  }

  goToWishList(){
    this.router.navigate(['/wishlist']);
  }

}
