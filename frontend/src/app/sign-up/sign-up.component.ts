import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { imageFooterHelper } from '../_helpers/image-footer-helper';
import { HeroService } from '../hero.service';
import { first } from 'rxjs/operators';
import {NgbModule ,NgbModal, ModalDismissReasons} from '@ng-bootstrap/ng-bootstrap';
import Swal from "sweetalert2";

@Component({
   selector: 'app-sign-up',
   templateUrl: './sign-up.component.html',
    styleUrls: ['./sign-up.component.css'],
    encapsulation: ViewEncapsulation.None
})
export class SignUpComponent implements OnInit {
	closeResult: string;
    registerForm: FormGroup;
    loading = false;
    submitted = false;
    showloginPopup:boolean=false;
    stateInfo: any[] = [];
    countryInfo: any[] = [];
    cityInfo: any[] = [];
    token:any ;
    checkoutArray:any=[];
    loadingData:boolean=false;

  constructor( private formBuilder: FormBuilder,
      private authenticationService: HeroService,
      private router: Router,
      private dataHelper:imageFooterHelper,private modalService: NgbModal) { }

  ngOnInit() {

    this.registerForm = this.formBuilder.group({
	 iagree:['', Validators.required],
      first_name: ['', Validators.required],
      last_name: ['', Validators.required],
        password: ['', [Validators.required, Validators.minLength(6)]],
        confirmPassword: ['', Validators.required],
        email: ['', [Validators.required, Validators.email]],
        occupation: ['', Validators.required],
        company: ['', Validators.required],
        mobileNumber: ['', [Validators.required, Validators.pattern(/^[6-9]\d{9}$/) ]],
       
        country: ['', Validators.required],
        state: ['', Validators.required],
        city: ['', Validators.required],
        pincode:['', [Validators.required, Validators.minLength(6), Validators.maxLength(6)]],
        address:['', Validators.required],
       


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
      this.loadingData =true;
    // console.log(this.registerForm.value);
    this.authenticationService.register(this.registerForm.value)
            .pipe(first())
            .subscribe(
                data2 => {
                    //alert("Sucessfully Registered");
                   // this.router.navigate(['/']);
                  if(data2.status=='1'){
                       Swal.fire('', data2.message, 'error');
                      let cartData = localStorage.getItem('beforeLoginCart');
					  if(cartData != null){
						  if(cartData.length >0){
							  let finalData =  JSON.parse(cartData);
							  this.token = localStorage.getItem('currentUser');
							  //console.log(finalData);
							 // console.log(finalData.productinfo);
							  let cartval = {
								  "product_info":finalData.productinfo,
								  "selected_product":finalData.cartproduct,
								  "total":finalData.total,
								  "extended":finalData.extended,
								  "token":this.token,
								  "type":finalData.type
							  };
							  this.authenticationService.addcartItemsData(cartval)
								  .subscribe(data => {
									  console.log(data);
									  this.checkoutArray.push(cartval);
									  if(data["status"]=='1'){
										  this.loadingData =false;
										  localStorage.setItem('checkoutAray', this.checkoutArray);
										  localStorage.removeItem("beforeLoginCart");
										  this.router.navigate(['/cart']);
									  }else{
										  this.loadingData =false;
										  Swal.fire('', data["message"], 'error');
									  }
	
								  });
						  }else{
							  this.loadingData =false;
							  this.router.navigate(['/']);
						  }
					  }else{
					  	 	 this.loadingData =false;
							 this.router.navigate(['/']);
					  }

                  }else{
                      this.loadingData =false;
                      Swal.fire('', data2.message, 'warning');
                      if(data2.message=='User have been already registered'){
						this.router.navigate(['/']);
					 }

                  }

                },
                error => {
                    this.loading = false;
                });
  }
  /* for bootstrop model */
  open(content) {
    this.modalService.open(content, { size: 'lg',backdrop: 'static',ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    });
  }
   private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return  `with: ${reason}`;
    }
  }
  /* end model */
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
