import { Component } from '@angular/core';
import { Router, ActivatedRoute, Event, NavigationEnd } from '@angular/router';
import { Location } from "@angular/common";
import { Subscription } from 'rxjs';
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {
  constructor(private router: Router,private actRoute: ActivatedRoute,private spinner: NgxSpinnerService) {
  }
  title = 'Image Footage';
  private sub: Subscription;
  footerEle:boolean=true;
  dashboardEle:boolean=false;


  ngOnInit() {
    this.sub = this.router.events.subscribe((event:Event) => {
      if(event instanceof NavigationEnd ){        
        if(event.url.includes("/search?")){
          this.footerEle = false;
        }else{
          this.footerEle = true;
        }
        if(event.url == "/" || event.url == "/#page-top"){
          this.dashboardEle = true;
        }else{
          this.dashboardEle = false;
        }
      }
    })
  }
}
