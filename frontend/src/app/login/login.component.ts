import { Component, OnInit, Input, Output,EventEmitter } from '@angular/core';
import { FormGroup, FormControl, Validators, FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { first } from 'rxjs/operators';
import { HeroService } from '../hero.service';
import {
    AuthService,
    FacebookLoginProvider,
    GoogleLoginProvider
} from 'angular-6-social-login';
import Swal from "sweetalert2";


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  @Input() openLoginPopup:boolean;
  @Output() closeLoginPopup:EventEmitter<boolean> = new EventEmitter<boolean>();
  @Input() closeLoginPopupForReg:boolean;

  closeResult: string;
  loginForm: FormGroup;
  loading = false;
  submitted = false;
  constructor(private formBuilder: FormBuilder,
    private router: Router,
    private authenticationService: HeroService,
	private socialAuthService: AuthService
    ) {
      if (this.authenticationService.currentUserValue) {
            this.router.navigate(['/']);
      }

    }

  ngOnInit() {

      this.loginForm = this.formBuilder.group({
          email: ['',  Validators.compose([
                  Validators.required,
                  Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')
                ])],
          password: ['', Validators.required]
      });

  }
  
  /* sign in with social media */ 
   public socialSignIn(socialPlatform : string) {
    let socialPlatformProvider;
    if(socialPlatform == "facebook"){
      socialPlatformProvider = FacebookLoginProvider.PROVIDER_ID;
    }else if(socialPlatform == "google"){
      socialPlatformProvider = GoogleLoginProvider.PROVIDER_ID;
    }/* else if (socialPlatform == "linkedin") {
      socialPlatformProvider = LinkedinLoginProvider.PROVIDER_ID;
    }*/
    
    this.socialAuthService.signIn(socialPlatformProvider).then(
      (userData) => {
        console.log(socialPlatform+" sign in data : " , userData);
        // Now sign-in with userData
        console.log(userData.name);
		console.log(userData.email);
		//fbLogin
		  this.authenticationService.fbLogin(userData)
              .pipe(first())
              .subscribe(
                  data => {
                    console.log(data);
                     if(data==undefined){
                         Swal.fire('', "You are non registered user", 'warning');
                     }else{
                         this.closeLoginPopup.emit(true);
                     }
                    },
                  error => {
                      this.loading = false;
                  });
            
      }
    );
  }
  /* end signin with social media */
  
 

    // convenience getter for easy access to form fields
    get f() { return this.loginForm.controls; }


    closePopup(){
        this.closeLoginPopup.emit(false);
    }
	/* closeLoginPopupForReg(){
	 	this.closeLoginPopup.emit(false);
	} */
     signUp(){
	 this.closeLoginPopup.emit(false);
	 this.router.navigate(['/signUp']);
	 
	 }
  onSubmit() {
      this.submitted = true;
      // stop here if form is invalid
      if (this.loginForm.invalid) {
          return;
      }

      this.loading = true;
      this.authenticationService.getLogin(this.f.email.value, this.f.password.value)
              .pipe(first())
              .subscribe(
                  data => {
                    console.log(data);
                     if(data==undefined){
                         this.loading = false;
                         Swal.fire('', "Please enter correct username or password", 'warning');
                     }else{
					 	  this.loaddata();
					      Swal.fire('', "Login Successful", 'success');
                         this.closeLoginPopup.emit(true);
                     }
                    },
                  error => {
                      this.loading = false;
                  });
      }
	  loaddata() {
        this.authenticationService.getLightboxfsItemsData()
            .subscribe(
                data => {
                    if (data.status == '1') {
						localStorage.setItem('lightboxData', JSON.stringify(data.data));
                    } 
                },
                error => {

                });
    }
  resetPassword(){
      this.closePopup();
      this.router.navigate(['/user-reset-password']);
  }

}
