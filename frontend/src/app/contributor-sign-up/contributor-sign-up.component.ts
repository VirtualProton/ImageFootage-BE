import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { HeroService } from '../hero.service';
import { first } from 'rxjs/operators';

@Component({
  selector: 'contributor-sign-up',
  templateUrl: './contributor-sign-up.component.html',
  styleUrls: ['./contributor-sign-up.component.css'],
//  encapsulation: ViewEncapsulation.None

})
export class ContributorSignUpComponent implements OnInit {

  showloginPopup:boolean=false;
  contributorForm: FormGroup;
  contributorotpForm:FormGroup;
  submitted = false;
  loading = false;
  fileToUpload: File = null;
  form = new FormData();
  error_message:string = null;
  success_message:string = null;
  loadingData:boolean =false;
  otp:boolean =false;
  completflag:boolean=false;

  constructor(      
    private router: Router,
    private formBuilder: FormBuilder,
    private authenticationService: HeroService,

    ) { }

  ngOnInit() {

    this.contributorForm = this.formBuilder.group({
      contributor_fname: ['', Validators.required],
      contributor_lname: ['', Validators.required],
      contributor_name: ['', Validators.required],
      contributor_email: ['', [Validators.required, Validators.email]],
      contributor_mobile: ['', [Validators.required,Validators.pattern(/^[6-9]\d{9}$/)]],
      contributor_password: ['', [Validators.required, Validators.minLength(6)]],
      contributor_type: ['', Validators.required],
      contributor_idproof: ['', Validators.required],
      bank_holder_name: ['', Validators.required],
      bank_account_number: ['', [Validators.required, Validators.pattern(/[0-9]/)]],
      ifsc_number: ['', Validators.required],
      bank_name: ['', [Validators.required]],
      contributor_acceptTerms: ['', Validators.required]
    });

    this.contributorotpForm = this.formBuilder.group({
      otp:['', Validators.required]
    })
    
  }

  get f() { return this.contributorForm.controls; }
  get o() { return this.contributorotpForm.controls; }

  clickLoginPopup(){
    this.showloginPopup = true;
  }
  handleFileInput(files){
    //const form = new FormData();
    //this.fileToUpload = files.item(0);
    //this.formData.append( "file", file[i], file[i]['name'] );
    for ( let i = 0; i < files.length; i++ ) {
      console.log(files[i]);
      console.log(files[i]['name']);
      this.form.append( "image", files[i], files[i]['name'] );
    }
    console.log(this.form);
  }
  onSubmit() {
    this.submitted = true;
    // stop here if form is invalid
    if (this.contributorForm.invalid) {
       console.log('at invalid');
       console.log(this.contributorForm);
        return;
    }
     this.loadingData = true;
     this.form.append( 'Info', JSON.stringify(this.contributorForm.value));
    //var options = { content: this.form };
    //console.log(options);
    this.authenticationService.contributorRegister(this.form)
                              .pipe(first())
                              .subscribe(
                                  data2 => {
                                    console.log(data2);
                                    this.loadingData = false;
                                    if(data2.status=='1'){
                                      this.otp = true;
                                      this.error_message = null;
                                      this.success_message = data2.message;
                                    }else{
                                      this.otp = false;
                                      this.success_message = null;
                                      this.error_message = data2.message;
                                    }

                                    },
                                  error => {
                                      this.loading = false;
                                  });

  }

  resend_otp(){
    this.loadingData = true;
    let email = this.contributorForm.controls['contributor_email'].value;
    let mobile = this.contributorForm.controls['contributor_mobile'].value;
    this.authenticationService.resendOtp(email,mobile)
        .pipe(first())
        .subscribe(
            data2 => {
              console.log(data2);
              this.loadingData = false;
              if(data2.status=='1'){
               this.error_message = null;
                this.success_message = data2.message;
              }else{
                this.success_message = null;
                this.error_message = data2.message;
              }

            },
            error => {
              this.loading = false;
            });

  }

  onSubmitotp(){
    this.submitted = true;
    // stop here if form is invalid
    if (this.contributorotpForm.invalid) {
      console.log('at invalid');
      console.log(this.contributorotpForm);
      return;
    }
    this.loadingData = true;
    let email = this.contributorForm.controls['contributor_email'].value;
    let mobile = this.contributorForm.controls['contributor_mobile'].value;
    this.authenticationService.verifyOtp(email,mobile,this.contributorotpForm.value)
        .pipe(first())
        .subscribe(
            data2 => {
              console.log(data2);
              this.loadingData = false;
              if(data2.status=='1'){
                this.error_message = null;
                this.contributorotpForm.reset();
                this.completflag= true;
                this.success_message = data2.message;
               }else{
                this.success_message = null;
                this.error_message = data2.message;
              }

            },
            error => {
              this.loading = false;
            });

  }



  hideLoginPopup(event){
    this.showloginPopup = false;
    if(event){
      this.router.navigate(['']);
    }
  }

}
