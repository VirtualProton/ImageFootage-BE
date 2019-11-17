import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Location } from '@angular/common';

import { Hero, carouselSliderImages, aosSlider, market, detailPageInfo }         from '../hero';
import { HeroService }  from '../hero.service';
import { imageFooterHelper } from '../_helpers/image-footer-helper';
import { isNullOrUndefined } from 'util';
import { element } from 'protractor';

@Component({
  selector: 'app-hero-detail',
  templateUrl: './hero-detail.component.html',
  styleUrls: [ './hero-detail.component.css' ]
})
export class HeroDetailComponent implements OnInit {
  carouselSliderImages: carouselSliderImages;
  hero:Hero;
  aoslSliderImagesData: aosSlider[] =[];
  page:number = 1;
  pageSize:number = 12;
  marketDetails:market;
  detailPageInfo:detailPageInfo;
  public currentUser: any;
  checkoutArray:any=[];
  showloginPopup:boolean=false;
  id:number=0;
  addedCartItem:boolean=false;

  constructor(
    private route: ActivatedRoute,
    private heroService: HeroService,
    private location: Location,private dataHelper:imageFooterHelper, private authenticationService: HeroService,private router: Router
  ) {
    this.authenticationService.currentUser.subscribe(x => {
        this.currentUser = x;
    });  

  }

  ngOnInit(): void {
     this.getcategoryCarouselImages();
     this.getDetailinfo();

      this.authenticationService.currentUser.subscribe(x => {
          this.currentUser = x;
      });
      
     this.heroService.getMarketdeatils()
      .subscribe(data => {
        this.marketDetails = data;
      });
      
     this.heroService.getAosSliderImages()
        .subscribe(aoslSliderImages => {
           this.aoslSliderImagesData = aoslSliderImages;
          //let tempCarouselSlider= this.chunkArray(aoslSliderImages, 4);
         // this.aoslSliderImagesData = JSON.parse(JSON.stringify(aoslSliderImages));
          let randArr = [4, 3, 2,3];
          let i =4,j=0;
          this.aoslSliderImagesData.forEach(ele=>{
            if( i > j){ 
              ele.eleClass = randArr[j];
              j=j+1;
              if(j == i){
                  this.dataHelper.shuffleArray(randArr);
                  j=0;
              }
            }
          })
          // console.log(this.aoslSliderImagesData);
        });
  }

  getDetailinfo(){
    this.id = +this.route.snapshot.paramMap.get('id');
    this.heroService.getDetailPagedetails(this.id)
      .subscribe(data => {
        console.log(data);
        this.detailPageInfo = data[0];
      });

  }

  getcategoryCarouselImages(): void {
    const id = +this.route.snapshot.paramMap.get('id');

    this.heroService.getcategoryCarouselImages(1)
      .subscribe(images => {
          if(!isNullOrUndefined(images)){
              this.carouselSliderImages = images[0];

              let randArr = [4, 3, 2,3];
              let tempCarouselSlider= this.chunkArray(this.carouselSliderImages.categoryImages, 4);
              this.carouselSliderImages.categoryImages = JSON.parse(JSON.stringify(tempCarouselSlider));
                  for(let i=0; i<this.carouselSliderImages.categoryImages.length;i++){
                        if(this.carouselSliderImages.categoryImages[i].length<4){
                          let lessItem = 4-this.carouselSliderImages.categoryImages[i].length;
                          let newArray = tempCarouselSlider[0].splice(0,lessItem);
                          this.carouselSliderImages.categoryImages[i] = this.carouselSliderImages.categoryImages[i].concat(newArray);
                        }
                  }         
              this.carouselSliderImages.categoryImages.forEach(element=>{
                  let temp = 0;
                  this.dataHelper.shuffleArray(randArr);
                  element.forEach(ele=>{
                    ele.eleClass = randArr[temp];
                    temp=temp+1;
                  })
              })                  
          }
      });
      
  }

  getClassName(ele){
    return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
  }

  addToCheckoutItem(id){
    if (!this.currentUser) {
      this.showloginPopup = true;
    }else{
      this.addedCartItem = !this.addedCartItem;
      this.checkoutArray.push(id);
      // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated
      localStorage.setItem('checkoutAray', this.checkoutArray);
      this.router.navigate(['/wishlist']);
    }

  }

 /* showCartLabel(){
    let addCart = this.checkoutArray.find(ele=>ele == this.id);
    if(isNullOrUndefined(addCart))
          this.addedCartItem=false;
    else
      this.addedCartItem=true;
  }*/



  chunkArray(myArray, chunk_size){
        let results = [];
        
        while (myArray.length) {
            results.push(myArray.splice(0, chunk_size));
        }
        
        return results;
    }



    hideLoginPopup(event){
      this.showloginPopup = false;
      if(event){
        this.addToCheckoutItem(this.id);
      }
    }
}
