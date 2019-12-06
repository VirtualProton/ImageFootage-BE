import { Component, OnInit } from '@angular/core';
import { Hero,carouselSlider,aosSlider } from '../hero';
import { HeroService } from '../hero.service';

import { imageFooterHelper } from '../_helpers/image-footer-helper';
import { Router } from '@angular/router';

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

  randomNumber:number =0;
  searchBoxLabel:number= 1;
  page:number = 1;
  pageSize:number = 40;
  aosSliderSizes:any=[];
  

  constructor(private heroService: HeroService,private dataHelper:imageFooterHelper,private router: Router) {
   }



  ngOnInit() {
 

    this.heroService.getcarouselSliderImages()
      .subscribe(carouselSliderImages => {
        this.carouselSliderImages = carouselSliderImages;
      });

    this.heroService.getAosSliderImages()
      .subscribe(aoslSliderImages => {
        console.log(aoslSliderImages);
        this.aoslSliderImages = aoslSliderImages;
        this.aoslSliderImagesData = aoslSliderImages;

        this.maintainAosSlider();   
      });

          
  }



  getClassName(ele){
    return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
  }

  searchAosData(search){
    // debounceTime(400),
    if(search.trim().length > 2){
      this.router.navigate(['/search'], { queryParams: { type: this.searchBoxLabel,keyword:search.trim() } });
    }
  }

  maintainAosSlider(){
    let i =4,j=0;
    let randArr =[[6,2,3,1],[5,2,3,2],[4,3,2,3],[3,2,3,4],[3,1,6,2],[4,4,2,2],[5,4,2,1],[6,4,1,1],[4,2,4,2],[3,4,3,2]];
    let mathRandom = Math.floor(Math.random() * 10)
    this.aoslSliderImagesData.forEach(ele=>{
      if( i > j){ 
        // console.log(mathRandom)
        ele.eleClass = randArr[mathRandom][j];
        j=j+1;
        if(j == i){
            this.dataHelper.shuffleArray(randArr);
            j=0;
            mathRandom = Math.floor(Math.random() * 10)
        }
      }
    })
  }

  searchDropDownClick(type){
    this.searchBoxLabel=type;
    }

    
}
