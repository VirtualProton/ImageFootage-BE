import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { imageFooterHelper } from '../_helpers/image-footer-helper';
import { HeroService } from '../hero.service';
import { first } from 'rxjs/operators';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {
    registerForm: FormGroup;
    loading = false;
    submitted = false;
    showloginPopup:boolean=false;
    stateInfo: any[] = [];
    countryInfo: any[] = [];
    cityInfo: any[] = [];

  constructor( private formBuilder: FormBuilder,
      private authenticationService: HeroService,
      private router: Router,
      private dataHelper:imageFooterHelper) { }

  ngOnInit() {

    this.registerForm = this.formBuilder.group({
      first_name: ['', Validators.required],
      last_name: ['', Validators.required],
        password: ['', [Validators.required, Validators.minLength(6)]],
        confirmPassword: ['', Validators.required],
        email: ['', [Validators.required, Validators.email]],
        occupation: ['', Validators.required],
        company: ['', Validators.required],
        mobileNumber: ['', [Validators.required, Validators.pattern(/^[6-9]\d{9}$/) ]],
        phoneNumber: ['', Validators.required],
        country: ['', Validators.required],
        state: ['', Validators.required],
        city: ['', Validators.required],
        pincode:['', [Validators.required, Validators.minLength(6), Validators.maxLength(6)]],
        address:['', Validators.required],
        iagree:['', Validators.required],


    }, {
       validator: this.dataHelper.mustMatch('password', 'confirmPassword')
  });
    this.getCountries();
  }

  get f() { return this.registerForm.controls; }

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

  onChangeCity(cityValue){
    // console.log(this.cityInfo[cityValue]);
   // this.registerForm.controls['city'].setValue(this.cityInfo[cityValue]);
  }

  onSubmit() {
    this.submitted = true;
    // stop here if form is invalid
    if (this.registerForm.invalid) {
      // console.log('at invalid');      console.log(this.registerForm);
        return;
    }
    // console.log(this.registerForm.value);
    this.authenticationService.register(this.registerForm.value)
            .pipe(first())
            .subscribe(
                data2 => {
                    //alert("Sucessfully Registered");
                   // this.router.navigate(['/']);
                  if(data2.status=='1'){
                    alert(data2.message);
                    this.router.navigate(['/']);
                  }else{
                    alert(data2.message);
                  }

                },
                error => {
                    this.loading = false;
                });
  }

  clickLoginPopup(){
    this.showloginPopup = true;
  }

  hideLoginPopup(event){
    this.showloginPopup = false;
    if(event){
      this.router.navigate(['']);
    }

  }

}
