import { Component, OnInit, Input, Output,EventEmitter, ViewEncapsulation } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { HeroService } from '../hero.service';

import * as AOS from 'aos';
import { Subscription } from 'rxjs';


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
  encapsulation: ViewEncapsulation.None

})
export class HeaderComponent implements OnInit {
  
  @Input() dashboardCssEle:boolean;
  @Input() footerCssEle:boolean;
  public currentUser: any;
  showloginPopup:boolean=false;
  isCollapsed:boolean=true;
  sub:Subscription;
  productType:any;
  keywordEle:any=' ';



  constructor( private router: Router,private route: ActivatedRoute, private authenticationService: HeroService) {    
    this.authenticationService.currentUser.subscribe(x => {
        this.currentUser = x;
    });  
  }

  ngOnInit() {

    AOS.init();
    this.sub = this.route
                    .queryParams
                    .subscribe(params => {
                      this.productType=params.type;
                      this.keywordEle=params.keyword;                      
                    });

  }

  searchDropDownClick(type){
    this.productType=type;
  }

  onKeydown(event) {
    if (event.key === "Enter") {
      this.router.navigate(['/search'], { queryParams: { type: this.productType,keyword:this.keywordEle.trim() } });
    }        
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
      this.router.navigate(['']);
  }
  

}
