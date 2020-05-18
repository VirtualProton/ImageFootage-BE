import { Component, OnInit, HostListener, Inject } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { HeroService } from '../hero.service';
import { Router } from '@angular/router';
import { first } from 'rxjs/operators';
import Swal from "sweetalert2";


@Component({
  selector: 'app-contact-us',
  templateUrl: './contact-us.component.html',
  styleUrls: ['./contact-us.component.css']
})
export class ContactUsComponent implements OnInit {

  constructor(private formBuilder: FormBuilder,private authenticationService: HeroService,private router: Router) { }
  @HostListener('window:scroll', [])
  onWindowScroll() {
    if (document.body.scrollTop > 10 ||     
    document.documentElement.scrollTop > 10) {
      document.getElementById('navbarResponsive').classList.remove('show');
      //document.getElementById('paragraph').classList.add('green');
    }
  }

    contactForm: FormGroup;
    loading = false;
    submitted = false;

  ngOnInit() {
    this.contactForm = this.formBuilder.group({
      user_name: ['', Validators.required],
      user_email: ['', [Validators.required, Validators.email]],
      mobile_number: ['', [Validators.required, Validators.minLength(10), Validators.maxLength(10)]],
      user_message:['', Validators.required],
      user_subject:['', Validators.required],
     });
  }

  get f() { return this.contactForm.controls; }

  onContactSubmit() {
    this.submitted = true;
    // stop here if form is invalid
    if (this.contactForm.invalid) {
     // console.log('at invalid');   console.log(this.contactForm);
        return;
    }
    // console.log(this.contactForm.value);
    this.authenticationService.contactUs(this.contactForm.value)
            .pipe(first())
            .subscribe(
                data => {
				if(data.status==1){
					Swal.fire('', data["message"], 'success');
                    this.router.navigate(['/']);
				}else if(data.status!=1){
					Swal.fire('', data["message"], 'error');
				}
                },
                error => {
                    this.loading = false;
                });
  }


}
