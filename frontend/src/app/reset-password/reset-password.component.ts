import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { HeroService } from '../hero.service';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { cartItemData } from '../hero';
import { Router } from '@angular/router';
import {NgxSpinnerService} from "ngx-spinner";
import {first} from "rxjs/operators";
import { imageFooterHelper } from '../_helpers/image-footer-helper';


@Component({
  selector: 'app-reset-password',
  templateUrl: './reset-password.component.html',
  styleUrls: ['./reset-password.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class ResetPasswordComponent implements OnInit {

  public currentUser: any;
  loadingData:boolean = false;
  resetpasswordForm: FormGroup;
  requestOtpForm: FormGroup;
  requestOtpForm2: FormGroup;
  submitted = false;
  loading = false;
  toemail:boolean = true;
  tomobile:boolean = false;
  step1otp:boolean = true;
  step2otp:boolean = false;
  passwordotpForm:FormGroup;
  fmobile:string='';
  constructor(private heroService: HeroService,private formBuilder: FormBuilder, private authenticationService: HeroService, private router: Router,private spinner: NgxSpinnerService, private dataHelper:imageFooterHelper) {
    this.authenticationService.currentUser.subscribe(x => {
      this.currentUser = x;
      if(this.currentUser){
        this.router.navigate(['/']);
      }

    });
  }

  ngOnInit() {
    this.resetpasswordForm = this.formBuilder.group({
      user_email: ['', Validators.required],
    });
	this.requestOtpForm = this.formBuilder.group({
      user_mobile: ['', Validators.required],
    });
	this.requestOtpForm2 = this.formBuilder.group({
	  /*user_mobile1: ['', Validators.required],*/
      user_otp: ['', Validators.required],
	  user_password: ['', Validators.required],
	  user_rpassword: ['', Validators.required],
    },{
            validator:  this.dataHelper.mustMatch('user_password', 'user_rpassword')
     });
  }
   
  get f() { return this.resetpasswordForm.controls; }
  get o() { return this.requestOtpForm.controls; }
  get r() { return this.requestOtpForm2.controls; }
 
  showtoemail(){
	  this.toemail=true;
	  this.tomobile=false;
  }
  showtomobile(){
	  this.toemail=false;
	  this.tomobile=true;
  }

  onSubmit() {
    this.submitted = true;
    // stop here if form is invalid
    if (this.resetpasswordForm.invalid) {
      console.log('at invalid');
      console.log(this.resetpasswordForm);
      return;
    }
    this.loadingData = true;
    this.authenticationService.resetPassword(this.resetpasswordForm.value)
        .pipe(first())
        .subscribe(
            data2 => {
              console.log(data2);
              this.loadingData = false;
              if(data2.status=='1'){
                // this.otp = true;
                // this.error_message = null;
                // this.success_message = data2.message;
				alert(data2.message);
				this.router.navigate(['/']);
              }else{
                // this.otp = false;
                // this.success_message = null;
                // this.error_message = data2.message;
				alert(data2.message);
              }

            },
            error => {
              this.loading = false;
            });

  }
  requestOtp(){
  	this.submitted = true;
    // stop here if form is invalid
    if(this.requestOtpForm.invalid) {
      console.log('at invalid 2');
      console.log(this.requestOtpForm);
      return;
    }
	this.loadingData = true;
	this.fmobile=this.requestOtpForm.value.user_mobile;
	localStorage.setItem('userotpmobile', this.requestOtpForm.value.user_mobile);
    this.authenticationService.requestOtpPassword(this.requestOtpForm.value)
        .pipe(first())
        .subscribe(
            data2 => {
              this.loadingData = false;
              if(data2.status=='1'){
			  this.fmobile=localStorage.getItem('userotpmobile');
                this.step1otp= false;
  				this.step2otp= true;
				alert(data2.message);
              }else{
				alert(data2.message);
              }

            },
            error => {
              this.loading = false;
            });
	
  }
  onChangePass(){
  	this.submitted = true;
    // stop here if form is invalid
    if(this.requestOtpForm2.invalid) {
      return;
    }
	this.loadingData = true;
    /*this.requestOtpForm2.value,*/
	this.authenticationService.requestChangePassword(this.fmobile,this.requestOtpForm2.value.user_otp,this.requestOtpForm2.value.user_password,this.requestOtpForm2.value.user_rpassword)
        .pipe(first())
        .subscribe(
            data2 => {
              this.loadingData = false;
              if(data2.status=='1'){
				alert(data2.message);
				localStorage.removeItem('userotpmobile');    
				this.router.navigate(['/']);
              }else{
				alert(data2.message);
              }

            },
            error => {
              this.loading = false;
           });
  }
}
