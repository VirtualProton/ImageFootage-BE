import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import { Router } from '@angular/router';
import {NgxSpinnerService} from "ngx-spinner";

@Component({
  selector: 'app-reset-password',
  templateUrl: './reset-password.component.html',
  styleUrls: ['./reset-password.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class ResetPasswordComponent implements OnInit {

  public currentUser: any;
  constructor(private heroService: HeroService, private authenticationService: HeroService, private router: Router,private spinner: NgxSpinnerService) {
    this.authenticationService.currentUser.subscribe(x => {
      this.currentUser = x;
      if(this.currentUser){
        this.router.navigate(['/']);
      }

    });
  }

  ngOnInit() {
  }

}
