import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { HeroService }  from '../hero.service';
import {NgxSpinnerService} from "ngx-spinner";
import {first} from "rxjs/operators";
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
	loadingData:boolean = false;
  constructor(private route: ActivatedRoute,private formBuilder: FormBuilder,private authenticationService: HeroService,private spinner: NgxSpinnerService,private router: Router) {
  	
  }
  ngOnInit() {
	  this.otp = this.route.snapshot.paramMap.get("otp");
	  this.email = this.route.snapshot.paramMap.get("email");

	  this.changeresetpasswordForm = this.formBuilder.group({
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
		this.loadingData = true;
		
        // stop here if form is invalid
       /* if (this.changeresetpasswordForm.invalid) {
            return;
        }*/
		 this.loadingData = true;

    this.authenticationService.changeResetPassword(this.changeresetpasswordForm.value,this.otp,this.email)
        .pipe(first())
        .subscribe(
            data2 => {
				if(data2.status==1){
				    alert(data2.message);
                    this.authenticationService.logout();
                    this.router.navigate(['']);
				}else if(data2.status==0){
					alert(data2.message);
				}
              this.loadingData = false;
            },
            error => {
              this.loadingData = false;
            });
		      // display form values on success
    }
  onReset() {
        this.submitted = false;
        this.changeresetpasswordForm.reset();
  }

}
