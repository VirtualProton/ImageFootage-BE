import { Component, OnInit } from '@angular/core';
import { Hero,carouselSlider,aosSlider } from '../hero';
import { HeroService } from '../hero.service';
import {NgbCarouselConfig} from '@ng-bootstrap/ng-bootstrap';
import * as AOS from 'aos';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: [ './dashboard.component.css' ]
})
export class DashboardComponent implements OnInit {
  heroes: Hero[] = [];
  carouselSliderImages: carouselSlider[] =[];
  aoslSliderImages: aosSlider[] =[];
  showNavigationArrows = false;
  showNavigationIndicators = false;

  constructor(private heroService: HeroService,config: NgbCarouselConfig) {
    config.showNavigationArrows = false;
    config.showNavigationIndicators = true;
   // config.interval=1000;
    config.pauseOnHover=false
   }



  ngOnInit() {
    //this.getHeroes();
    AOS.init();
    this.heroService.getcarouselSliderImages()
      .subscribe(carouselSliderImages => {
        this.carouselSliderImages = carouselSliderImages;
      });

    this.heroService.getAosSliderImages()
      .subscribe(aoslSliderImages => {
        console.log(aoslSliderImages);
        this.aoslSliderImages = aoslSliderImages;
      });

          
  }



  getClassName(ele){
    let ran = Math.floor((Math.random()*6)+1);
    if(ran == 1){
      return 'col-6 '+'col-md-1 col-lg-1 ';
    }else if(ran == 2){
      return 'col-6 col-md-2 col-lg-2 ';
    }else if(ran == 3){
      return 'col-6 col-md-3 col-lg-3 ';
    }else if(ran == 4){
      return 'col-6 col-md-4 col-lg-4 ';
    }else{
      return 'col-6 col-md-5 col-lg-5 ';
    }
    
  }
}
