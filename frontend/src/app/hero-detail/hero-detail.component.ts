import { Component, OnInit, Input, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Location } from '@angular/common';

import { Hero, carouselSliderImages, aosSlider, market, detailPageInfo }         from '../hero';
import { HeroService }  from '../hero.service';
import { imageFooterHelper } from '../_helpers/image-footer-helper';
import { isNullOrUndefined } from 'util';
import { element } from 'protractor';
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-hero-detail',
  templateUrl: './hero-detail.component.html',
  styleUrls: [ './hero-detail.component.css' ],
  encapsulation: ViewEncapsulation.None

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
  webtype:number=0;
  type:string='';
  total:number=0;
  extended_price:number=0;
  currunt_selected_price = 0;
  cart:any=[];
  token:any ='';
  checkoutAray:any =[];
  extended:any=[];
  standard:any=[];
  standardTab:boolean =true;
  extendedTab:boolean =false;
  keyword:any=[];
  loadingData:boolean=false;
  constructor(
    private route: ActivatedRoute,
    private heroService: HeroService,
    private location: Location,private dataHelper:imageFooterHelper, private authenticationService: HeroService,private router: Router,private spinner: NgxSpinnerService
  ) {
    this.authenticationService.currentUser.subscribe(x => {
        this.currentUser = x;
    });  

  }

  ngOnInit(): void {
      //this.spinner.show();
      this.loadingData =true;
     //this.getcategoryCarouselImages();
     this.getDetailinfo();

      this.authenticationService.currentUser.subscribe(x => {
          this.currentUser = x;
      });
      
     // this.heroService.getMarketdeatils()
     //  .subscribe(data => {
     //    this.marketDetails = data;
     //  });
      
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
    this.webtype = +this.route.snapshot.paramMap.get('webtype');
    this.type = this.route.snapshot.paramMap.get('type');
    this.heroService.getDetailPagedetails(this.id,this.webtype,this.type)
      .subscribe(data => {
         console.log(data);
         this.detailPageInfo = data;
         if(this.webtype==2){
             let keywords  = this.detailPageInfo['metadata']['keywords_top10'];
             this.keyword = keywords.split(",").map(item => item.trim());
         }else if(this.webtype==3){
             let keywords  = this.detailPageInfo[0].items[0].kw;
             this.keyword = keywords.split(",").map(item => item.trim());
         }

         //this.keyword = keywords.split(',',10);
         //this.spinner.hide();
          this.loadingData =false;
      });

  }
  checkout(){
      this.router.navigate(['/checkout']);
  }

  getcategoryCarouselImages(): void {
    const id = +this.route.snapshot.paramMap.get('id');

    this.heroService.getAosSliderImages()
      .subscribe(aoslSliderImages => {
          if(!isNullOrUndefined(aoslSliderImages)){
              this.carouselSliderImages = aoslSliderImages;

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

  addToCheckoutItem(productinfo,cartproduct,total,extended,type){
    if (!this.currentUser) {
      this.showloginPopup = true;
    }else{
        this.loadingData = true;
      this.addedCartItem = !this.addedCartItem;
        this.token = localStorage.getItem('currentUser');
       let cartval = {
           "product_info":productinfo,
           "selected_product":cartproduct,
           "total":total,
           "extended":extended,
           "token":this.token,
           "type":type
         };

      this.heroService.addcartItemsData(cartval)
            .subscribe(data => {
                console.log(data);
                this.checkoutArray.push(cartval);
                if(data["status"]=='1'){
                    this.loadingData =false;
                    localStorage.setItem('checkoutAray', this.checkoutArray);
                    this.router.navigate(['/cart']);
                }else{
                    this.loadingData =false;
                    alert(data["message"]);
                }

            });
      // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated

    }

  }

   checkPriceTotal(selectedPrice){
        console.log(selectedPrice);
        this.currunt_selected_price = selectedPrice.price*80;
        this.total = this.currunt_selected_price;
       this.extended_price =0;
       this.standard=selectedPrice;
    }

    addExtendedPriceTotal(selectedPrice){

        this.extended_price = selectedPrice.price*80;
        this.total =  this.extended_price;
        this.currunt_selected_price = 0;
        this.extended=selectedPrice;
    }

    checkPriceTotalFootage(selectedPrice){
        console.log(selectedPrice);
        this.currunt_selected_price = selectedPrice.pr*80;
        this.total = this.currunt_selected_price;
        this.standard= selectedPrice;
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
        this.addToCheckoutItem(this.detailPageInfo,this.standard,this.total,this.extended,'2');
      }
    }

    tabshow(type){
      if(type=='1'){
        this.standardTab = true;
        this.extendedTab = false;
      }else if(type=='2'){
          this.standardTab = false;
          this.extendedTab = true;
      }

    }
}
