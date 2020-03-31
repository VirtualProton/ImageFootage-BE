import { Component, OnInit, ViewEncapsulation, ElementRef } from '@angular/core';
import { Observable, Subject, Subscription } from 'rxjs';
import { Hero, carouselSlider, aosSlider, Search } from '../hero';
import { HeroService } from '../hero.service';
import { ActivatedRoute } from '@angular/router';
import { imageFooterHelper } from '../_helpers/image-footer-helper';
import {NgxSpinnerService} from "ngx-spinner";
import { isNullOrUndefined } from 'util';
import * as AOS from 'aos';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Router } from '@angular/router';
import {NgForm} from '@angular/forms';
import { Options } from 'ng5-slider';

//'../../../node_modules/ng-masonry-grid/ng-masonry-grid.css',
@Component({
  selector: 'app-hero-search',
  templateUrl: './hero-search.component.html',
  styleUrls: [ './hero-search.component.css','./sidebar.component.scss' ],
 
  encapsulation: ViewEncapsulation.None,
  animations: [
    trigger('slide', [
      state('up', style({ height: 0 })),
      state('down', style({ height: '*' })),
      transition('up <=> down', animate(200))
    ])
  ]
})
export class HeroSearchComponent implements OnInit {
  productType:any;
  keywordEle:any=' ';
  forrefresh:string=localStorage.getItem('forrefresh');
  priceArray: any = [];
  heroes$: Observable<Hero[]>;
  private searchTerms = new Subject<string>();
  sub:Subscription;
  randomNumber:number =0;
  searchBoxLabel:string='all';
  page:number = 1;
  public currentUser: any;
  pageSize:number = 40;
  sidebarSubmenu1:boolean = false;
  slidebarPeopleMenu:any=[];
  sidebarSubmenu2:boolean = false;
  slidebarLocationMenu:any=[];
  sidebarSubmenu3:boolean = false;
  slidebarGenderMenu:any=[];
  sidebarSubmenu4:boolean = false;
  slidebarEthnicityMenu:any=[];
  sidebarSubmenu5:boolean = false;
  slidebarColorMenu:any=[];
  sidebarSubmenu6:boolean = false;
  slidebarOrientationsMenu:any=[];
  sidebarSubmenu7:boolean = false;
  slidebarImageTypeMenu:any=[];
  sidebarSubmenu8:boolean = false;
  slidebarImageSizeMenu:any=[];
  sidebarSubmenu9:boolean=false;
  sliderSortTypeMenu:any=[];
  showloginPopup:boolean=false;
  name: string = '';
  carouselSliderImages: carouselSlider[] =[];
  aoslSliderImages: aosSlider[] =[];
  aoslSliderImagesData: aosSlider[] =[];
  searchData : Search;
  leftsideData:any;
  sideBarEle:boolean=true;
  loadingData:boolean=false;
  keyword = [];
  isMenuOpen = true;
  public show:boolean = true;
  public buttonName:any = 'Show';
  category:any ='' ;
  editorial:any='';
   totalproduct:number = 0;
   perpage:number = 30;
   totalpages:number = 0;
   pagenumber:number =0;
   resolutions:any =['5K+','4K','HD(1080)','HD(720)','2K','SD'];
   durvalue: any = 0.00;
   durhighValue: number = 2.00;
   options: Options = {
        floor: 0.00,
        ceil: 2.00,
        step: 0.01,
    };
   fpsValues:any =["23.98","24","25","29.97","30","60","60+"];
   checkArray:any = {'resolution':[],'fps':[],'people':[],'gender':[]};
   color:any = ' Pick Color';

   public searchStr: string = "";


  constructor(private heroService: HeroService,
    private route: ActivatedRoute,
    private dataHelper:imageFooterHelper,
    private myElement: ElementRef,
	private router: Router,
    private spinner: NgxSpinnerService,private authenticationService: HeroService) {
    this.searchData = new Search();
	this.authenticationService.currentUser.subscribe(x => {
        this.currentUser = x;
    });
  }
  
       // Push a search term into the observable stream.
      search(term: string): void {
        this.searchTerms.next(term);
      }

      ngOnInit(): void {
	  AOS.init();
	  this.sub = this.route
                    .queryParams
                    .subscribe(params => {
					  this.productType=params.type;
                      this.keywordEle=params.keyword;
                      this.loadingData=true;
					
					  /*if(this.keywordEle == '' && this.productType==1 && this.forrefresh == '' ){
					 
						 localStorage.setItem('forrefresh', 'yes');
					  	//this.router.navigate(window.location.href);
						//this.router.navigate([this.router.url]);
					  }else{
					  
					  	localStorage.setItem('forrefresh','');
					  }*/
                    //  this.spinner.show();
                      this.searchData.productType=params.type;
                      this.searchData.search=params.keyword;
                      if(!isNullOrUndefined(params.sideBar)){
                        this.sideBarEle=params.sideBar;
                      }
                      if(!isNullOrUndefined(params.cat)){
                            this.editorial=params.cat;
                        }
                      this.searchData.letest=0;
                      this.searchData.curated=1;
                      this.searchData.populer=0;

                      this.searchAPIRequest();
                    });
          if(!isNullOrUndefined(this.editorial) &&  this.editorial=='editorial'){
              this.category =3;
          }else{
              this.category =this.productType;
          }

          this.heroService.getSearchLeftFilter()
                    .subscribe(leftsideData => {
                      // this.carouselSliderImages = carouselSliderImages; 
                        this.leftsideData = leftsideData;
                    });
              

      }
	  public modelChange(str: string): void {
    		this.keywordEle = str;
  	  }

      searchDropDownClick(type){
        this.loadingData=true;
        this.searchData.productType=type;
        this.searchAPIRequest();
      }

      searchAPIRequest(){

          if(this.productType==2){
              this.searchData.durationless = this.durvalue;
              this.searchData.durationgrt = this.durhighValue;
              this.searchData.searchFilter = this.checkArray;
          }else {
              this.searchData.product_people = this.slidebarPeopleMenu.join();
              this.searchData.product_gender = this.slidebarGenderMenu.join();
              this.searchData.product_ethinicities = this.slidebarEthnicityMenu.join();
              this.searchData.product_locations = this.slidebarLocationMenu.join();
              //this.searchData.product_colors = this.slidebarColorMenu.join();
              this.searchData.product_colors = this.color;
              this.searchData.product_imagesizes = this.slidebarImageSizeMenu.join();
              this.searchData.product_imagetypes = this.slidebarImageTypeMenu.join();
              this.searchData.product_orientation = this.slidebarOrientationsMenu.join();
              this.searchData.product_sortType = this.sliderSortTypeMenu.join();
              if (this.editorial != '') {
                  this.searchData.product_editorial = 'editorial';
              }
          }
            if(this.pagenumber!=0){
                  this.searchData.pagenumber =this.pagenumber ;
            }

            this.heroService.getAosSliderSearchImages(this.searchData)
                          .subscribe(aoslSliderImages => {
                           //  if(aoslSliderImages.hasOwnProperty('code')) {
                                  //   window.location.href = aoslSliderImages['url']
                              //}else {
                              this.loadingData = false;
                              if(aoslSliderImages.imgfootage.length !=0) {
                                  this.totalproduct = aoslSliderImages.total;
                                  this.perpage = aoslSliderImages.perpage;
                                  this.totalpages = Math.ceil(aoslSliderImages.total / aoslSliderImages.perpage);
                                  this.aoslSliderImages = aoslSliderImages.imgfootage;
                                  let type = this.aoslSliderImages["0"].product_keywords;
                                  this.keyword = type.split(',', 9);
                                  if(aoslSliderImages.tp==1){
                                      this.searchData.search = this.keyword[0];
                                  }
                                  this.maintainAosSlider();
                              }else{
                                  alert("No Result Found");
                              }
                                 //  this.spinner.hide();


                            // }
                              // this.maintainSearchData(aoslSliderImages);
                          },
                              error => {
                                  this.loadingData=false;
                                  console.log(error);
                                  alert('No data found ....');
                              }

                          );
      }

      getSideBarClassName(type,id){
        if(type=='people'){
          let indexPeople = this.slidebarPeopleMenu.indexOf(id);
          if (indexPeople > -1) {
            return true;
          }else{
            return false;          
          }
        }else if(type == 'gender'){
          let indexGender = this.slidebarGenderMenu.indexOf(id);
          if (indexGender > -1) {
            return true;
          }else{
            return false;          
          }         
        }else if(type == 'ethinicity'){
          let indexEthnicity = this.slidebarEthnicityMenu.indexOf(id);
          if (indexEthnicity > -1) {
            return true;
          }else{
            return false;          
          }          
        }else if(type == 'locations'){
          let indexLocation = this.slidebarLocationMenu.indexOf(id);
          if (indexLocation > -1) {
            return true;
          }else{
            return false;          
          }
        }else if(type == 'colors'){
          let indexColor = this.slidebarColorMenu.indexOf(id);
          if (indexColor > -1) {
            return true;
          }else{
            return false;          
          }
        }else if(type == 'imagesizes'){
          let indexImagesize = this.slidebarImageSizeMenu.indexOf(id);
          if (indexImagesize > -1) {
            return true;
          }else{
            return false;          
          }
        }else if(type == 'imageTypes'){
          let indexImageType = this.slidebarImageTypeMenu.indexOf(id);
          if (indexImageType > -1) {
            return true;
          }else{
            return false;          
          }
        }else if(type == 'orientation'){
          let indexOrientation = this.slidebarOrientationsMenu.indexOf(id);
          if (indexOrientation > -1) {
            return true;
          }else{
            return false;          
          }
        }else if(type == 'sorttype'){
          let indexSorttype = this.sliderSortTypeMenu.indexOf(id);
          if (indexSorttype > -1) {
            return true;
          }else{
            return false;          
          }
        }
      }

      onSideMenuClick(type,id){
        this.loadingData=true;
        if(type=='people'){
          let indexPeople = this.slidebarPeopleMenu.indexOf(id);
          if (indexPeople > -1) {
            this.slidebarPeopleMenu.splice(indexPeople, 1);
          }else{
            this.slidebarPeopleMenu.push(id);           
          }
        //  this.searchData.product_people =this.slidebarPeopleMenu.join(); 
        }else if(type == 'gender'){
          let indexGender = this.slidebarGenderMenu.indexOf(id);
          if (indexGender > -1) {
            this.slidebarGenderMenu.splice(indexGender, 1);
          }else{
            this.slidebarGenderMenu.push(id);
          }
         // this.searchData.product_gender = this.slidebarGenderMenu.join();          
        }else if(type == 'ethinicity'){
          let indexEthnicity = this.slidebarEthnicityMenu.indexOf(id);
          if (indexEthnicity > -1) {
            this.slidebarEthnicityMenu.splice(indexEthnicity, 1);
          }else{
            this.slidebarEthnicityMenu.push(id);
           }
          // this.searchData.product_ethinicities = this.slidebarEthnicityMenu.join();          
        }else if(type == 'locations'){
          let indexLocation = this.slidebarLocationMenu.indexOf(id);
          if (indexLocation > -1) {
            this.slidebarLocationMenu.splice(indexLocation, 1);
          }else{
            this.slidebarLocationMenu.push(id);
          }
          // this.searchData.product_locations = this.slidebarLocationMenu.join();
        }else if(type == 'colors'){
          let indexColor = this.slidebarColorMenu.indexOf(id);
          if (indexColor > -1) {
            this.slidebarColorMenu.splice(indexColor, 1);
          }else{
            this.slidebarColorMenu.push(id);
          }
         // this.searchData.product_colors = this.slidebarColorMenu.join();
        }else if(type == 'imagesizes'){
          let indexImagesize = this.slidebarImageSizeMenu.indexOf(id);
          if (indexImagesize > -1) {
            this.slidebarImageSizeMenu.splice(indexImagesize, 1);
          }else{
            this.slidebarImageSizeMenu.push(id);
          }
        //  this.searchData.product_imagesizes = this.slidebarImageSizeMenu.join();
        }else if(type == 'imageTypes'){
          let indexImageType = this.slidebarImageTypeMenu.indexOf(id);
          if (indexImageType > -1) {
            this.slidebarImageTypeMenu.splice(indexImageType, 1);
          }else{
            this.slidebarImageTypeMenu.push(id);
          }
          // this.searchData.product_imagetypes = this.slidebarImageTypeMenu.join();
        }else if(type == 'orientation'){
          let indexOrientation = this.slidebarOrientationsMenu.indexOf(id);
          if (indexOrientation > -1) {
            this.slidebarOrientationsMenu.splice(indexOrientation, 1);
          }else{
            this.slidebarOrientationsMenu.push(id);
          }
          // this.searchData.product_orientation = this.slidebarOrientationsMenu.join();
        }else if(type == 'sorttype'){
          let indexSorttype = this.sliderSortTypeMenu.indexOf(id);
          if (indexSorttype > -1) {
            this.sliderSortTypeMenu.splice(indexSorttype, 1);
          }else{
            this.sliderSortTypeMenu.push(id);
          }
         // this.searchData.product_sortType = this.sliderSortTypeMenu.join();
        }
        //this.searchAPIRequest();
      }


      onTabClick(number){
       console.log(number);
        this.loadingData=true;
          if(number == 2){
            this.searchData.letest=0;
            this.searchData.curated=1;
            this.searchData.populer=0;
          }else if(number == 3){
            this.searchData.letest=0;
            this.searchData.curated=0;
            this.searchData.populer=1;
          }else {
            this.searchData.letest=1;
            this.searchData.curated=0;
            this.searchData.populer=0;
          }
          this.searchAPIRequest();
      }

      getClassName(ele){
       //return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
	   return 'col-6 col-md-3 col-lg-3';
	   //return '';
      }
      onPageChange = (pageNumber) => {
        let el = this.myElement.nativeElement.querySelector('main');
        el.scrollIntoView();
       }

      onKeydown(event) {
        if (event.key === "Enter") {
          this.searchData.letest=1;
          this.searchData.curated=0;
          this.searchData.populer=0;
          //this.searchAPIRequest();
        }
      }

      maintainSearchData(aoslSliderImages){
            this.aoslSliderImagesData = aoslSliderImages;
      
            if(this.searchData.productType == 1){
                this.aoslSliderImagesData = this.aoslSliderImages.filter(ele=> ele.product_main_type == "Image");
            }else if(this.searchData.productType == 2){
                this.aoslSliderImagesData = this.aoslSliderImages.filter(ele=> ele.product_main_type != "Image");
            }else{
                this.aoslSliderImagesData = this.aoslSliderImages;
            }
        
            if( this.searchData.search.length > 2){
              this.aoslSliderImagesData =  this.aoslSliderImagesData.filter(ele=> ele.product_title.includes(this.name.trim()));
            }
            this.maintainAosSlider();            
      }

      maintainAosSlider(){
          let i =4,j=0;
          let randArr =[[3,2,3,4],[5,2,3,2],[4,3,2,3],[2,2,4,4],[3,3,4,2],[4,4,2,2],[3,4,2,3],[3,3,3,3],[4,2,4,2],[3,4,3,2]];
          let mathRandom = Math.floor(Math.random() * 10)
          this.aoslSliderImages.forEach(ele=>{
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
	  toggle() {
    this.show = !this.show;

    // CHANGE THE NAME OF THE BUTTON.
    if(this.show)  
      this.buttonName = "Hide";
    else
      this.buttonName = "Show";
  }
  onNavigate(link,slug,pid,pweb,prod_type){
		//for redirect
		//alert(link+pid+'/'+pweb+'/'+prod_type);

		window.location.href=link+slug+'?webtype='+pweb+'&type='+prod_type.toLowerCase()+'&prod_id='+pid+'&cat='+this.searchData.search.toLowerCase();
  }
  clickLoginPopup(){
		this.showloginPopup = true;
		return false;
  	}
    hideLoginPopup(event){
		this.showloginPopup = false;
		this.router.navigate(['/']);
  	}
	addtolightbox(productinfo){

		//return false;
        this.loadingData =true;
        this.heroService.addWishListItemsData(productinfo.api_product_id)
            .subscribe(data => {
                if(data["status"]=='1'){
                    this.loadingData =false;
                    this.heroService.removeCartItemsData(productinfo)
                        .subscribe(data => {
                            if (data["status"] == '1') {
                                this.priceArray=[];
                           } else {
                                alert(data["message"]);
                            }

                        });
                    this.router.navigate(['/wishlist']);
                }else{
                    this.loadingData =false;
                    alert(data["message"]);
                }

            });
    }

    filters(form: NgForm){

        this.loadingData = true;

        if(form.value.category==2){
            this.searchData.productType = form.value.category;
            this.searchData.search = form.value.search;
            this.searchData.durationless = this.durvalue;
            this.searchData.durationgrt = this.durhighValue;
            this.searchData.searchFilter = this.checkArray;
        }else {
            this.searchData.productType = form.value.category;
            this.searchData.search = form.value.search;
            this.searchData.product_people = form.value.people;
            this.searchData.product_gender = form.value.gender;
            this.searchData.product_ethinicities = form.value.ethinicity;
            this.searchData.product_locations = form.value.locations;
            this.searchData.product_colors = this.color;
            this.searchData.product_imagesizes = form.value.image_size;
            this.searchData.product_imagetypes = form.value.imagetype;
            this.searchData.product_orientation = form.value.orientation;
            this.searchData.tolerance = form.value.tolerance;
        }

        this.searchData.pagenumber = 0;
        //this.searchData.product_sortType = this.sliderSortTypeMenu.join();
        this.changeQueryParams(form.value.search,form.value.category);
        this.heroService.getAosSliderSearchImages(this.searchData)
            .subscribe(aoslSliderImages => {
                    //  if(aoslSliderImages.hasOwnProperty('code')) {
                    //   window.location.href = aoslSliderImages['url']
                    //}else {
                    this.loadingData = false;
                    if(aoslSliderImages.imgfootage.length !=0) {
                        this.totalproduct = aoslSliderImages.total;
                        this.perpage = aoslSliderImages.perpage;
                        this.totalpages = Math.ceil(aoslSliderImages.total / aoslSliderImages.perpage);
                        this.aoslSliderImages = aoslSliderImages.imgfootage;
                        let type = this.aoslSliderImages["0"].product_keywords;
                        this.keyword = type.split(',', 9);
                        this.maintainAosSlider();
                    }else{
                        alert("Result Not Found");
                    }
                    //  this.spinner.hide();


                    // }
                    // this.maintainSearchData(aoslSliderImages);
                },
                error => {
                    this.loadingData=false;
                    console.log(error);
                    alert('No data found ....');
                }

            );
    }
    reset(form: NgForm){
        form.reset();
        this.route
            .queryParams
            .subscribe(params => {
                form.controls['search'].setValue(params.keyword);
                form.controls['category'].setValue(params.type);

            });
    }

    public changeQueryParams(keyword,type) {
        this.router.navigate(
            [],
            {
                relativeTo: this.route,
                queryParams: { keyword: keyword, type:type },
                queryParamsHandling: 'merge'
            });
    }



    // appendItems(startIndex, endIndex) {
    //     this.addItems(startIndex, endIndex, 'push');
    // }
    //
    // prependItems(startIndex, endIndex) {
    //     this.addItems(startIndex, endIndex, 'unshift');
    // }
    onScrollDown() {
       if(this.pagenumber < (this.totalpages-1)){
            this.pagenumber++;
            this.searchData.pagenumber = this.pagenumber ;
            this.heroService.getAosSliderSearchImages(this.searchData)
                .subscribe(aoslSliderImages => {
                        aoslSliderImages.imgfootage.forEach(ele=>{
                            this.aoslSliderImages.push(ele);
                        })

                   },
                    error => {
                       console.log(error);
                        alert('No data found ....');
                    }

                );

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
    //checkArray:any =[{}];

    onCheckboxChange(e,type) {

        if (e.target.checked) {
            this.checkArray[type].push(e.target.value);
        } else {
            let i: number = 0;
            this.checkArray[type].forEach((item,index) => {
                if (item == e.target.value) {
                    this.checkArray[type].splice(index,1);
                    return;
                }
                i++;
            });
        }
    }


}
