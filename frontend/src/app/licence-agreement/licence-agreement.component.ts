import { Component, OnInit, HostListener, Inject  } from '@angular/core';

@Component({
  selector: 'app-licence-agreement',
  templateUrl: './licence-agreement.component.html',
  styleUrls: ['./licence-agreement.component.css']
})
export class LicenceAgreementComponent implements OnInit {

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
