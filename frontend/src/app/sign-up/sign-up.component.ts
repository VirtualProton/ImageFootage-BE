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

  constructor( private formBuilder: FormBuilder,
      private authenticationService: HeroService,
      private router: Router,
      private dataHelper:imageFooterHelper) { }

  ngOnInit() {

    this.registerForm = this.formBuilder.group({
        firstName: ['', Validators.required],
        lastName: ['', Validators.required],
        password: ['', [Validators.required, Validators.minLength(6)]],
        confirmPassword: ['', Validators.required],
        email: ['', [Validators.required, Validators.email]],
        jobTitle: ['', Validators.required],
        company: ['', Validators.required],
        mobileNumber: ['', [Validators.required, Validators.minLength(10), Validators.maxLength(10)]],
        phoneNumber: ['', Validators.required],
        iagree:['', Validators.required],

    }, {
       validator: this.dataHelper.mustMatch('password', 'confirmPassword')
  });
  
  }

  get f() { return this.registerForm.controls; }

  onSubmit() {
    this.submitted = true;
    // stop here if form is invalid
    if (this.registerForm.invalid) {
        return;
    }
    this.authenticationService.register(this.registerForm.value)
            .pipe(first())
            .subscribe(
                data => {
                    this.router.navigate(['/']);
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
      this.router.navigate(['/dashboard']);
    }

  }

}
