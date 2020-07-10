import { Component, OnInit, Input, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Location } from '@angular/common';

import { Hero, carouselSliderImages, aosSlider, market, detailPageInfo,Search }         from '../hero';
import { HeroService }  from '../hero.service';
import { imageFooterHelper } from '../_helpers/image-footer-helper';
import { isNullOrUndefined } from 'util';
import { element } from 'protractor';
import {DomSanitizer} from '@angular/platform-browser';
import {NgbModalConfig,NgbModal} from '@ng-bootstrap/ng-bootstrap';


import { NgxSpinnerService } from "ngx-spinner";
import Swal from "sweetalert2";

@Component({
  selector: 'app-hero-detail',
  templateUrl: './hero-detail.component.html',
  styleUrls: [ './hero-detail.component.css' ],
  encapsulation: ViewEncapsulation.None,
  providers:[NgbModalConfig,NgbModal]

})
export class HeroDetailComponent implements OnInit {
  carouselSliderImages: carouselSliderImages;
  hero:Hero;
  aoslSliderImagesData: aosSlider[] =[];
  searchData : Search;
  page:number = 1;
  pageSize:number = 12;
  relatedData:any=[];
  marketDetails:market;
  detailPageInfo:detailPageInfo;
  public currentUser: any;
  checkoutArray:any=[];
  showloginPopup:boolean=false;
  id:number=0;
  vfound:boolean =false;
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
  imagefootId:any ='';
  fileName: string;
  filePreview: string;
  category:any ='' ;
  prodid:any='';
    profileData:any ='';
  lightBoxListDataItems: any = [];
    totalproduct:number = 0;
    perpage:number = 30;
    totalpages:number = 0;
    pagenumber:number =0;
    packeagechoose:any=[];
    refrencemodel:any ='';
    milliseconds:any;
    hours:any;
    minutes:any;
    seconds:any;

  constructor(
    private route: ActivatedRoute,
    private heroService: HeroService,
    private location: Location,private dataHelper:imageFooterHelper, private authenticationService: HeroService,private router: Router,private sanitizer: DomSanitizer,config: NgbModalConfig, private modalService: NgbModal ) {
    this.authenticationService.currentUser.subscribe(x => {
        this.currentUser = x;
    });
	config.backdrop = 'static';
    config.keyboard = false;
  }

  ngOnInit(): void {
      //this.spinner.show();
      this.loadingData =true;
      this.route
          .queryParams
          .subscribe(params => {
              this.category = params.cat;
              this.id = params.prod_id;
              this.webtype = params.webtype;
              this.type = params.type;

          });
     //this.getcategoryCarouselImages();
     this.getDetailinfo();
	 this.lightBoxListDataItems=localStorage.getItem('lightboxData');
	if(this.lightBoxListDataItems != null){
	  	//this.vfound=this.lightBoxListDataItems.indexOf(this.route.snapshot.paramMap.get('id')) > -1;
	}
	
	//console.log(this.lightBoxListDataItems);
	//console.log(this.vfound);
      this.authenticationService.currentUser.subscribe(x => {
          this.currentUser = x;
      });
      //console.log(this.currentUser);
      //let category = this.route.snapshot.paramMap.get('cat');
      //let imgtype =  this.route.snapshot.paramMap.get('webtype');
     // this.prodid =  this.route.snapshot.paramMap.get('id');
	 

      this.getRelatedProducts(this.category,this.webtype);
     // this.heroService.getMarketdeatils()
     //  .subscribe(data => {
     //    this.marketDetails = data;
     //  });
      if(this.currentUser) {
          this.authenticationService.getUserprofileData()
              .subscribe(
                  data => {
                      this.profileData = data.data;
                       if(this.profileData["plans"]){

                          if(this.webtype==3){
                              var ptype= 'Footage';
                          }else{
                              var ptype='Image';
                          }
                          this.profileData["plans"].forEach(ele=>{
                              if(ele.package_type==ptype) {
                                  this.packeagechoose.push(ele);
                              }
                          })

                      }
                      //this.loadingData = false;
                  },
                  error => {

                  });


      }

  }
  getRelatedProducts(keyword,prodtype){
 	 this.heroService.getRelatedProductData(keyword,prodtype,this.pagenumber).subscribe(relatedData => {
       //console.log(relatedData);
	     this.relatedData=relatedData.imgfootage;
         this.totalproduct = relatedData.total;
         this.perpage = relatedData.perpage;
         this.totalpages = Math.ceil(relatedData.total/relatedData.perpage);
         
      });
	
  }

  getDetailinfo(){
    //this.id = +this.route.snapshot.paramMap.get('id');
    //this.webtype = +this.route.snapshot.paramMap.get('webtype');
    //this.type = this.route.snapshot.paramMap.get('type');

    this.heroService.getDetailPagedetails(this.id,this.webtype,this.type)
      .subscribe(data => {
         //console.log(data);
         if(this.webtype==2){
             this.detailPageInfo = data[0];
             this.imagefootId = data[1];
             let keywords  = this.detailPageInfo['metadata']['keywords_top10'];
             this.keyword = keywords.split(",").map(item => item.trim());
             this.filePreview = data[2];
            // this.getRelatedProducts(this.keyword[0]);
             //this.base64changefunction(this.detailPageInfo['media']['preview_url_no_wm']);
         }else if(this.webtype==3){
             this.detailPageInfo = data;
             let keywords  = this.detailPageInfo[0].clip_data.pic_keywords;
             this.keyword = keywords.split(",").map(item => item.trim());
             if(this.detailPageInfo[3]){
                 this.getimagedownloadSample(this.detailPageInfo[3]);
             }

         }

         //this.keyword = keywords.split(',',10);
         //this.spinner.hide();
          this.loadingData =false;
      });

  }
  checkout(){
      this.router.navigate(['/checkout']);
  }

  getimagedownloadSample(footID){
      this.heroService.getDownloadFootageSample(footID)
          .subscribe(data => {
              //console.log(data);
                  this.detailPageInfo[4] = data;
            });
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

  /*getClassName(ele){
    return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
  }*/

  addToCheckoutItem(productinfo,cartproduct,total,extended,type){
    if (!this.currentUser) {
      this.showloginPopup = true;
      localStorage.setItem('beforeLoginCart', JSON.stringify({productinfo,cartproduct,total,extended,type}));
    }else{
         if(cartproduct.length==0){
             Swal.fire('', 'Please select size of product !!.', 'warning');
             return false;
        }
        this.loadingData = true;
        this.addedCartItem = !this.addedCartItem;
        this.token = localStorage.getItem('currentUser');
        delete productinfo['4'];

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
               // console.log(data);
				this.checkoutArray.push(cartval);
                if(data["status"]=='1'){
                    this.loadingData =false;
                    localStorage.setItem('checkoutAray', this.checkoutArray);
                    this.router.navigate(['/cart']);
                }else{
                    this.loadingData =false;
                    Swal.fire('', data["message"], 'error');
                }

            });
      // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated

    }

  }

   checkPriceTotal(selectedPrice){
        //console.log(selectedPrice);
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
        //console.log(selectedPrice);
        this.currunt_selected_price = selectedPrice.pr;
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
        //this.addToCheckoutItem(this.detailPageInfo,this.standard,this.total,this.extended,'2');
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
  base64changefunction(fileUrl){
    let reader = new FileReader();
    if (fileUrl) {
        let file = fileUrl;
        reader.readAsDataURL(file);
        reader.onload = () => {
            alert((<string>reader.result).split(',')[1]);
            this.fileName = file.name + " " + file.type;
            this.filePreview = 'data:image/png' + ';base64,' + (<string>reader.result).split(',')[1];
        };
    }
}

    sanitize(url: string) {
        //return url;
        return this.sanitizer.bypassSecurityTrustUrl(url);
    }

    addtolightbox(id){
       // console.log(id);
		let element = document.getElementById('adtow')
        if (!this.currentUser) {
            this.showloginPopup = true;
       }else {
            //this.loadingData = true;
            this.heroService.addWishListItemsData(id)
                .subscribe(data => {
                    if (data["status"] == '1') {
                        this.loadingData = false;
						element.style.color = 'red';
						this. loaddata();
						//alert(data["message"]);
                       // this.router.navigate(['/wishlist']);
                    }if (data["status"] == '2') {
						element.style.color = '#ffffffa8';
						this. loaddata();
					} else if (data["status"] == '0') { 
                        this.loadingData = false;
                        //alert(data["message"]);
                        Swal.fire('', data["message"], 'error');
                    }

                });
        }
    }
	 loaddata() {
        this.authenticationService.getLightboxfsItemsData()
            .subscribe(
                data => {
                    if (data.status == '1') {
						localStorage.setItem('lightboxData', JSON.stringify(data.data));
                    } 
                },
                error => {

                });
    }
	open(content) {
    	this.modalService.open(content);
    }
	getClassName(ele){
       // return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
	   return 'col-6 col-md-3 col-lg-3';
    }
    onNavigate(link,slug,pid,pweb,prod_type){
        //for redirect
        //alert(link+pid+'/'+pweb+'/'+prod_type);
        let category = this.category;
       // window.location.href=link+pid+'/'+pweb+'/'+prod_type.toLowerCase()+'?cat='+category.toLowerCase();
        window.location.href=link+slug+'?webtype='+pweb+'&type='+prod_type.toLowerCase()+'&prod_id='+pid+'&cat='+category.toLowerCase();
    }

    download(productinfo,cartproduct,total,extended,type,pricecontent){
        var flag=0;
        if(cartproduct && Object.keys(cartproduct).length>0){
            flag =1;
        }
        if(extended && Object.keys(extended).length>0){
            flag =1;
        }
        if(flag==0){
            Swal.fire('', 'Please select size of product !!', 'warning');
            return false;
        }
        if(this.packeagechoose.length > 1){
            this.refrencemodel = this.modalService.open(pricecontent);
            return false;
        }

        this.loadingData = true;
        this.token = localStorage.getItem('currentUser');

        let cartval = {
            "product_info":productinfo,
            "selected_product":cartproduct,
            "total":total,
            "extended":extended,
            "token":this.token,
            "type":type,
            "package":this.packeagechoose[0].id
        };

        this.heroService.download(cartval)
            .subscribe(data => {
               // console.log(data);
                if(data) {
                    if (type == 3) {
                        this.loadingData = false;
                         window.location.href = data['url'];
                    } else {
                        if (data["stat"] == 'ok') {
                            this.loadingData = false;
                            window.location.href = data["download_status"]["download_url"];
                        } else {
                            this.loadingData = false;
                            Swal.fire('', 'Not Downloaded !!', 'error');
                        }
                    }
                }

            });
    }
    downloadselect(productinfo,cartproduct,total,extended,type,selected){
        //console.log(selected);
        this.loadingData = true;
        this.token = localStorage.getItem('currentUser');
        this.refrencemodel.close();
        let cartval = {
            "product_info":productinfo,
            "selected_product":cartproduct,
            "total":total,
            "extended":extended,
            "token":this.token,
            "type":type,
            "package":selected
        };
        //console.log(cartval);
        this.heroService.download(cartval)
            .subscribe(data => {
                //console.log(data);
                if(data) {
                    if (type == 3) {
                        this.loadingData = false;
                        window.location.href = data['url'];
                    } else {
                        if (data["stat"] == 'ok') {
                            this.loadingData = false;
                            window.location.href = data["download_status"]["download_url"];
                        } else {
                            this.loadingData = false;
                            //alert("Not Downloaded");
                            Swal.fire('', 'Not Downloaded !!', 'error');
                        }
                    }
                }

            });
    }
    onScrollDown() {

        if(this.pagenumber!=this.totalpages){
            this.pagenumber++;
            let imgtype =  this.route.snapshot.paramMap.get('webtype');
            this.heroService.getRelatedProductData(this.category,imgtype,this.pagenumber).subscribe(relatedData => {
                //console.log(relatedData);
                relatedData.imgfootage.forEach(ele=>{
                    this.relatedData.push(ele);
                })
                //this.relatedData=relatedData;

            });
            //console.log(this.relatedData);

        }

    }

    onScrollUp() {

        if(this.pagenumber!=0){
            this.pagenumber--;
            //this.searchAPIRequest();
            // this.heroService.getAosSliderSearchImages(this.searchData)
            //     .subscribe(aoslSliderImages => {
            //             this.aoslSliderImages['unshift'] = aoslSliderImages.imgfootage;
            //         },
            //         error => {
            //             console.log(error);
            //             alert('No data found ....');
            //         }
            //
            //     );

        }
    }

    msToTime(duration) {
        this.milliseconds = (duration % 1000) ;
        this.seconds = Math.floor((duration / 1000) % 60);
        this.minutes = Math.floor((duration / (1000 * 60)) % 60);
        this.hours = Math.floor((duration / (1000 * 60 * 60)) % 24);

        this.hours = (this.hours < 10) ? "0" + this.hours : this.hours;
        this.minutes = (this.minutes < 10) ? "0" + this.minutes : this.minutes;
        this.seconds = (this.seconds < 10) ? "0" + this.seconds : this.seconds;

        return this.hours + ":" + this.minutes + ":" + this.seconds + "." + this.milliseconds;
    }
}
