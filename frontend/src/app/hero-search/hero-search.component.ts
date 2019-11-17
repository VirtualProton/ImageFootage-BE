import { Component, OnInit } from '@angular/core';

import { Observable, Subject, Subscription } from 'rxjs';

import {
   debounceTime, distinctUntilChanged, switchMap
 } from 'rxjs/operators';

import { Hero, carouselSlider, aosSlider } from '../hero';
import { HeroService } from '../hero.service';
import { ActivatedRoute } from '@angular/router';
import { imageFooterHelper } from '../_helpers/image-footer-helper';

@Component({
  selector: 'app-hero-search',
  templateUrl: './hero-search.component.html',
  styleUrls: [ './hero-search.component.css' ]
})
export class HeroSearchComponent implements OnInit {
  heroes$: Observable<Hero[]>;
  private searchTerms = new Subject<string>();
  sub:Subscription;
  randomNumber:number =0;
  searchBoxLabel:string='all';
  page:number = 1;
  pageSize:number = 12;
  sidebarSubmenu1:boolean = false;
  sidebarSubmenu2:boolean = false;
  sidebarSubmenu3:boolean = false;
  sidebarSubmenu4:boolean = false;
  sidebarSubmenu5:boolean = false;
  sidebarSubmenu6:boolean = false;
  sidebarSubmenu7:boolean = false;
  name: string = '';
  carouselSliderImages: carouselSlider[] =[];
  aoslSliderImages: aosSlider[] =[];
  aoslSliderImagesData: aosSlider[] =[];

  constructor(private heroService: HeroService,private route: ActivatedRoute,private dataHelper:imageFooterHelper) {}

      // Push a search term into the observable stream.
      search(term: string): void {
        this.searchTerms.next(term);
      }

      ngOnInit(): void {
    
          this.sub = this.route
                    .queryParams
                    .subscribe(params => {
                      this.searchBoxLabel=params.type;
                      this.name=params.keyword;
                        this.heroService.getAosSliderImages()
                          .subscribe(aoslSliderImages => {
                            // console.log(aoslSliderImages);
                            // console.log(aoslSliderImages.filter(ele=> ele.name.includes(this.name)));
                            this.aoslSliderImages = aoslSliderImages;
                            this.maintainSearchData(aoslSliderImages); 
                            
                          });
                    });

          this.heroService.getcarouselSliderImages()
                    .subscribe(carouselSliderImages => {
                      this.carouselSliderImages = carouselSliderImages;   
                 
                    });
              

      }

      searchDropDownClick(type){
        this.searchBoxLabel=type;
      }

      getClassName(ele){
        return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
      }

      onKeydown(event) {
        if (event.key === "Enter") {
          // console.log(this.name);
          this.maintainSearchData(this.aoslSliderImages);
        }
      }

      maintainSearchData(aoslSliderImages){
            this.aoslSliderImagesData = aoslSliderImages;
      
            if(this.searchBoxLabel == 'all'){
              this.aoslSliderImagesData = this.aoslSliderImages;
            }else{
              this.aoslSliderImagesData = this.aoslSliderImages.filter(ele=> ele.type == this.searchBoxLabel);
            }
        
            if(this.name.length > 2){
              this.aoslSliderImagesData =  this.aoslSliderImagesData.filter(ele=> ele.name.includes(this.name.trim()));
            }
            this.maintainAosSlider();            
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

}
