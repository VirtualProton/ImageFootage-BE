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
  submitted = false;
  loading = false;
  fileToUpload: File = null;
  form = new FormData();

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
    
  }

  get f() { return this.contributorForm.controls; }

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
     this.form.append( 'Info', JSON.stringify(this.contributorForm.value));
    //var options = { content: this.form };
    //console.log(options);
    this.authenticationService.contributorRegister(this.form)
                              .pipe(first())
                              .subscribe(
                                  data2 => {
                                    console.log(data2);
                                      //alert("Sucessfully Registered");
                                    // this.router.navigate(['/']);
                                   

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
