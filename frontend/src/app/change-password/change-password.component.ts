import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { HeroService }  from '../hero.service';
import {NgxSpinnerService} from "ngx-spinner";
import {first} from "rxjs/operators";
import Swal from "sweetalert2";

@Component({
  selector: 'app-change-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.css']
})
export class ChangePasswordComponent implements OnInit {
 	changepasswordForm: FormGroup;
    submitted = false;
	loadingData:boolean = false;
	public currentUser: any;
  constructor(private route: ActivatedRoute,private formBuilder: FormBuilder,private authenticationService: HeroService,private spinner: NgxSpinnerService,private router: Router) { 
  this.authenticationService.currentUser.subscribe(x => {
          this.currentUser = x;
          if(!this.currentUser){
              this.router.navigate(['/']);
          }

      });
  }

  ngOnInit() {
  console.log(this.currentUser.Utype);
  this.changepasswordForm = this.formBuilder.group({
      old_password: ['', Validators.required],
      password: ['', Validators.required],
      confirm_password: ['', Validators.required]
      // }, {
      //     validator: MustMatch('password', 'confirm_password')
      // }
    });
  }
  // convenience getter for easy access to form fields
    get f() { return this.changepasswordForm.controls; }
	onSubmit() {
        this.submitted = true;
		//this.loadingData = true;
		console.log();
        // stop here if form is invalid
        if (this.changepasswordForm.invalid) {
            return false;
        }
		 this.loadingData = true;

    this.authenticationService.userchangepassword(this.changepasswordForm.value,this.currentUser.Utype)
        .pipe(first())
        .subscribe(
            data2 => {
				if(data2.status==1){
				    Swal.fire('', data2.message, 'success');
					this.router.navigate(['/']);
				}else if(data2.status==0){
                    Swal.fire('', data2.message, 'error');
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
        this.changepasswordForm.reset();
  }

}
