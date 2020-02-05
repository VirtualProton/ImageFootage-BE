import { Component, OnInit, ViewEncapsulation, ElementRef } from '@angular/core';
import { Hero,carouselSlider,aosSlider } from '../hero';
import { HeroService } from '../hero.service';


import { imageFooterHelper } from '../_helpers/image-footer-helper';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: [ './dashboard.component.css' ],
  encapsulation: ViewEncapsulation.None

})
export class DashboardComponent implements OnInit {
  heroes: Hero[] = [];
  carouselSliderImages: carouselSlider[] =[];
  aoslSliderImages: aosSlider[] =[];
  aoslSliderImagesData: aosSlider[] =[];

  randomNumber:number =0;
  searchBoxLabel:number= 1;
  page:number = 1;
  pageSize:number = 32;
  aosSliderSizes:any=[];
  

  constructor(private heroService: HeroService,
    private dataHelper:imageFooterHelper,
    private myElement: ElementRef,
    private router: Router) {
   }
ngOnInit() {
 

     this.heroService.getcarouselSliderImages()
        .subscribe(data => {

            let _carouselSlider = new carouselSlider();
            let _carouselSliderArray = new Array<carouselSlider>();
            _carouselSlider.id = 1;
            _carouselSlider.categoryNames = data["0"];
            // [{id: data[], name: 'Skin Care'}, {id: 2, name: 'Cannabis'}, {
            //     id: 3,
            //     name: 'Business'
            // }, {id: 4, name: 'Curated'}, {id: 5, name: 'Video'}, {id: 6, name: 'Autumn'}]
            _carouselSliderArray.push(_carouselSlider);
            let _carouselSlider1 = new carouselSlider();
            _carouselSlider1.id = 2;
            _carouselSlider1.categoryNames = data["1"];

            //     [{id: 11, name: 'Dr Nice'}, {id: 12, name: 'Narco'}, {
            //     id: 13,
            //     name: 'Bombasto'
            // }, {id: 14, name: 'Celeritas'}, {id: 15, name: 'Magneta'}, {id: 16, name: 'RubberMan'}]
            _carouselSliderArray.push(_carouselSlider1);
            let _carouselSlider2 = new carouselSlider();
            _carouselSlider2.id = 3;
            _carouselSlider2.categoryNames = data["2"];

            //     [{id: 21, name: 'Family'}, {id: 22, name: 'Halloween'}, {
            //     id: 23,
            //     name: 'Seniors'
            // }, {id: 24, name: 'Cats & Dogs'}, {id: 25, name: 'Time to Party'}, {id: 26, name: 'Food'}]
            _carouselSliderArray.push(_carouselSlider2);
            let _carouselSlider3 = new carouselSlider();
            _carouselSlider3.id = 4;
            _carouselSlider3.categoryNames = data["3"];

            //     [{id: 31, name: 'The Digital Frontier'}, {
            //     id: 32,
            //     name: 'Christmas'
            // }, {id: 33, name: 'Real People & Places'}, {id: 34, name: 'Art & Concept'}, {
            //     id: 35,
            //     name: 'Magma'
            // }, {id: 36, name: 'Tornado'}]
            _carouselSliderArray.push(_carouselSlider3);

                this.carouselSliderImages = _carouselSliderArray; ;

    });
    //console.log( this.carouselSliderImages);
      // .subscribe(carouselSliderImages => {
      //   console.log(carouselSliderImages);
      //   this.carouselSliderImages = carouselSliderImages;
      // });

    this.heroService.getAosSliderImages()
      .subscribe(aoslSliderImages => {
        // console.log(aoslSliderImages);
        this.aoslSliderImages = aoslSliderImages;
        this.aoslSliderImagesData = aoslSliderImages;
        this.maintainAosSlider();   
      });

          
  }



  getClassName(ele){
    //return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
	return 'col-6 col-md-3 col-lg-3';
  }

  searchAosData(search){
    // debounceTime(400),
    if(search.trim().length > 2){
      this.router.navigate(['/search'], { queryParams: { type: this.searchBoxLabel,keyword:search.trim() } });
    }
  }

  onPageChange = (pageNumber) => {
    let el = this.myElement.nativeElement.querySelector('ngb-carousel');
    el.scrollIntoView();
   }

  maintainAosSlider(){
    let i =4,j=0;
    let randArr =[[3,2,3,4],[5,2,3,2],[4,3,2,3],[2,2,4,4],[3,3,4,2],[4,4,2,2],[3,4,2,3],[3,3,3,3],[4,2,4,2],[3,4,3,2]];
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

    returnonposter(footage){
        console.log('hello');
        //console.log(footage);
        //let posterUrl = footage.getAttribute('poster');
        //console.log(posterUrl);
        footage.load();
		footage.play();

        //let posterUrl = footage.getAttribute('poster');
       // footage.getAttribute('poster','');
       // footage.setAttribute('poster',posterUrl);
    }
	returnonposterpause(footage){
 		footage.pause();
		//alert ('hi');
    }
    
}
