import { Component } from '@angular/core';
import { Router, ActivatedRoute, Event, NavigationEnd } from '@angular/router';
import { Location } from "@angular/common";
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {
  constructor(private router: Router,private actRoute: ActivatedRoute) {   
  }
  title = 'Image Footage';
  private sub: Subscription;
  footerEle:boolean=true;


  ngOnInit() {
    this.sub = this.router.events.subscribe((event:Event) => {
      if(event instanceof NavigationEnd ){        
        if(event.url.includes("/search?")){
          this.footerEle = false;
        }else{
          this.footerEle = true;
        }
      }
    })
  }
}
