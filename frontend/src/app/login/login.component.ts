import { Component, OnInit, Input, Output,EventEmitter } from '@angular/core';
import { FormGroup, FormControl, Validators, FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { first } from 'rxjs/operators';
import { HeroService } from '../hero.service';

.3

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  @Input() openLoginPopup:boolean;
  @Output() closeLoginPopup:EventEmitter<boolean> = new EventEmitter<boolean>();

  closeResult: string;
  loginForm: FormGroup;
  loading = false;
  submitted = false;



  constructor(private formBuilder: FormBuilder,
    private router: Router,
    private authenticationService: HeroService,

    
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

    // convenience getter for easy access to form fields
    get f() { return this.loginForm.controls; }

 
    closePopup(){     
       this.closeLoginPopup.emit(false);
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
                     this.closeLoginPopup.emit(true);

                  },
                  error => {
                      this.loading = false;
                  });
      }

}
