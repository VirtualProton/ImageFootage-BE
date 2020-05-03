import { Component, OnInit, ViewEncapsulation, HostListener, Inject  } from '@angular/core';

@Component({
  selector: 'app-terms-and-conditions',
  templateUrl: './terms-and-conditions.component.html',
  styleUrls: ['./terms-and-conditions.component.css'],
  encapsulation: ViewEncapsulation.None

})
export class TermsAndConditionsComponent implements OnInit {

  constructor() { }
 @HostListener('window:scroll', [])
  onWindowScroll() {
    if (document.body.scrollTop > 10 ||     
    document.documentElement.scrollTop > 10) {
      document.getElementById('navbarResponsive').classList.remove('show');
      //document.getElementById('paragraph').classList.add('green');
    }
  }
  ngOnInit() {
  }

}
