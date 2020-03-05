import { Component, OnInit, Input, Output,EventEmitter, ViewEncapsulation, HostListener } from '@angular/core';
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
  @Input() scrollEle:boolean;
  public currentUser: any;
  showloginPopup:boolean=false;
  isCollapsed:boolean=true;
  sub:Subscription;
  productType:any;
  keywordEle:any=' ';
  //forimgredi:string='http://'+window.location.hostname+':4200';
   forimgredi:string='https://'+window.location.hostname;



  constructor( 
  //  private window:Window,
  //  private document: Document,
    private router: Router,
    private route: ActivatedRoute, 
    private authenticationService: HeroService) {    
    this.authenticationService.currentUser.subscribe(x => {
        this.currentUser = x;
    });  
    
  }

  /*
  @HostListener("window:scroll", [])
  onWindowScroll() {
    let number = this.window.pageYOffset || this.document.documentElement.scrollTop || this.document.body.scrollTop || 0;
    console.log(number);
    if (number > 100) {
    //  this.navIsFixed = true;
    } else if (this.navIsFixed &amp;&amp; number < 10) {
      this.navIsFixed = false;
    }
  }*/

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
  alert('Logout successful.');
      this.authenticationService.logout();
      this.router.navigate(['']);
  }
  

}
