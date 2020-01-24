import { Component, HostListener, OnInit, OnDestroy, Inject } from '@angular/core';
import { Router, ActivatedRoute, Event, NavigationEnd } from '@angular/router';
import { Location, DOCUMENT } from "@angular/common";
import { Subscription } from 'rxjs';

import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent implements OnInit, OnDestroy {
  scrollPosition: number = 0;

  constructor(private router: Router
    , private actRoute: ActivatedRoute
    , private spinner: NgxSpinnerService
    , @Inject(DOCUMENT) private document: Document
  ) {
  }
  title = 'Image Footage';
  private sub: Subscription;
  footerEle: boolean = true;
  dashboardEle: boolean = false;
  navIsFixed: boolean;

  ngOnInit() {
    this.sub = this.router.events.subscribe((event: Event) => {
      if (event instanceof NavigationEnd) {
        if (event.url.includes("/search?")) {
          this.footerEle = false;
        } else {
          this.footerEle = true;
        }
        if (event.url == "/" || event.url == "/#page-top") {
          this.dashboardEle = true;
        } else {
          this.dashboardEle = false;
        }
      }
	  window.scrollTo(0, 0)
    })
	
    //window.addEventListener('scroll', this.scroll, true); //third parameter

  }


  ngOnDestroy() {
    // window.removeEventListener('scroll', this.scroll, true);

  }
  @HostListener("window:scroll", [])
  onWindowScroll() {
    this.scrollPosition = document.documentElement.scrollTop;
  }

  minWidth() {
    return this.scrollPosition > 0;
  }


}
