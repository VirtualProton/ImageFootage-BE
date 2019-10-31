import { Component, OnInit, Input, Output,EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
import { HeroService } from '../hero.service';




@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  public currentUser: any;
  showloginPopup:boolean=false;


  constructor( private router: Router, private authenticationService: HeroService) {    
    this.authenticationService.currentUser.subscribe(x => {
        this.currentUser = x;
    });  
  }

  ngOnInit() {

  }

  clickLoginPopup(){
    this.showloginPopup = true;
  }

  hideLoginPopup(event){
    this.showloginPopup = false;
    this.router.navigate(['/']);
  }

  logout() {
      this.authenticationService.logout();
      this.router.navigate(['/dashboard']);
  }
  

}
