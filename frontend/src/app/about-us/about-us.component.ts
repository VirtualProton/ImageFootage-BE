import { Component, OnInit, ViewEncapsulation, HostListener, Inject } from '@angular/core';

@Component({
  selector: 'app-about-us',
  templateUrl: './about-us.component.html',
  styleUrls: ['./about-us.component.css'],
  encapsulation: ViewEncapsulation.None

})
export class AboutUsComponent implements OnInit {

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
