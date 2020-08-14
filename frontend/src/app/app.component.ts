import { Component, HostListener, OnInit, OnDestroy, Inject } from '@angular/core';
import {NgbModal, ModalDismissReasons} from '@ng-bootstrap/ng-bootstrap';
import { Router, ActivatedRoute, Event, NavigationEnd } from '@angular/router';
import { Location, DOCUMENT } from "@angular/common";
import { Subscription } from 'rxjs';
import { environment } from '../environments/environment';


import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent implements OnInit, OnDestroy {
  scrollPosition: number = 0;
  closeResult: string;
  constructor(private router: Router
    , private actRoute: ActivatedRoute
    , private spinner: NgxSpinnerService
    , @Inject(DOCUMENT) private document: Document
	,private modalService: NgbModal) {
  }
  title = 'Image Footage';
  private sub: Subscription;
  footerEle: boolean = true;
  dashboardEle: boolean = false;
  navIsFixed: boolean;
  /* for bootstrop model */
	open(content) {
    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    });
  }
  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return  `with: ${reason}`;
    }
  }
  /* end model */
  ngOnInit() {
    /*if (environment.production) {
	   if (location.protocol === 'http:') {
		window.location.href = location.href.replace('http', 'https');
	   }
  	}    */
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
        if (event.url == "/new-home") {
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
