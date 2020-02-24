import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { HeroService }  from '../hero.service';
import {NgxSpinnerService} from "ngx-spinner";
//import { MustMatch } from './_helpers/must-match.validator';
@Component({
  selector: 'app-change-reset-password',
  templateUrl: './change-reset-password.component.html',
  styleUrls: ['./change-reset-password.component.css']
})
export class ChangeResetPasswordComponent implements OnInit {
	otp:any=0;
	email:any='';
	 changeresetpasswordForm: FormGroup;
    submitted = false;
  constructor(private route: ActivatedRoute,private formBuilder: FormBuilder) {
  	
  }
  ngOnInit() {
	  this.otp = this.route.snapshot.paramMap.get("otp");
	  this.email = this.route.snapshot.paramMap.get("email");
	  this.changeresetpasswordForm = this.formBuilder.group({
	  		otp: ['', Validators.required],
			email: ['', Validators.required],
            title: ['', Validators.required],
            password: ['', Validators.required],
            confirm_password: ['', Validators.required]
        }, {
            //validator: MustMatch('password', 'confirm_password')
        });
  }
   // convenience getter for easy access to form fields
    get f() { return this.changeresetpasswordForm.controls; }
	onSubmit() {
	
        this.submitted = true;
console.log(this.changeresetpasswordForm.value);
        // stop here if form is invalid
        if (this.changeresetpasswordForm.invalid) {
            return;
        }
		      // display form values on success
        alert('SUCCESS!! :-)\n\n' + JSON.stringify(this.changeresetpasswordForm.value, null, 4));
    }
  onReset() {
        this.submitted = false;
        this.changeresetpasswordForm.reset();
  }

}
