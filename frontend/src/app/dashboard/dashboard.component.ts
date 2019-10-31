import { Component, OnInit } from '@angular/core';
import { Hero,carouselSlider,aosSlider } from '../hero';
import { HeroService } from '../hero.service';
import {NgbCarouselConfig} from '@ng-bootstrap/ng-bootstrap';
import * as AOS from 'aos';
import { isNullOrUndefined } from 'util';
import { debounceTime } from 'rxjs/operators';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: [ './dashboard.component.css' ]
})
export class DashboardComponent implements OnInit {
  heroes: Hero[] = [];
  carouselSliderImages: carouselSlider[] =[];
  aoslSliderImages: aosSlider[] =[];
  aoslSliderImagesData: aosSlider[] =[];
  //showNavigationArrows = false;
  // showNavigationIndicators = false;
  randomNumber:number =0;
  searchBoxLabel:string='all';
  page:number = 1;
  pageSize:number = 12;
  aosSliderSizes:any=[];
  

  constructor(private heroService: HeroService,config: NgbCarouselConfig) {
  //  config.showNavigationArrows = true;
   // config.showNavigationIndicators = true;
    //config.interval=1000;
   // config.pauseOnHover=true;
   }



  ngOnInit() {
 
    AOS.init();
    this.heroService.getcarouselSliderImages()
      .subscribe(carouselSliderImages => {
        this.carouselSliderImages = carouselSliderImages;
      });

    this.heroService.getAosSliderImages()
      .subscribe(aoslSliderImages => {
        this.aoslSliderImages = aoslSliderImages;
        this.aoslSliderImagesData = aoslSliderImages;
        let i =4,j=0;
        let randArr = [4, 3, 2,3];
        this.aoslSliderImagesData.forEach(ele=>{
          if( i > j){ 
            ele.eleClass = randArr[j];
            j=j+1;
            if(j == i){
                this.shuffleArray(randArr);
                j=0;
            }
          }
        })
      });

          
  }



  getClassName(ele){
    return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
  }

  searchAosData(search){
    // debounceTime(400),
    if(this.searchBoxLabel == 'all'){
      this.aoslSliderImagesData = this.aoslSliderImages;
    }else{
      this.aoslSliderImagesData = this.aoslSliderImages.filter(ele=> ele.type == this.searchBoxLabel);
    }

    if(search.trim().length > 2){
      this.aoslSliderImagesData =  this.aoslSliderImagesData.filter(ele=> ele.name == search.trim());
    }
  }

  searchDropDownClick(type){
    this.searchBoxLabel=type;
    }

    shuffleArray (array) {
      let m = array.length, t, i;
    
      // While there remain elements to shuffle
      while (m) {
        // Pick a remaining element…
        i = Math.floor(Math.random() * m--);
    
        // And swap it with the current element.
        t = array[m];
        array[m] = array[i];
        array[i] = t;
      }
    
      return array;
    }
}
