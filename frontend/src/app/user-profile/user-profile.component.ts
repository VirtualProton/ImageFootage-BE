import {Component, OnInit, ViewEncapsulation, HostListener, Inject} from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import {ActivatedRoute, Router} from '@angular/router';
import {Location} from "@angular/common";
import {imageFooterHelper} from "../_helpers/image-footer-helper";
import {NgxSpinnerService} from "ngx-spinner";
import Swal from "sweetalert2";
import { FormGroup, FormBuilder, Validators } from '@angular/forms';


@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class UserProfileComponent implements OnInit {
  profileTab:boolean=true;
  plansTab:boolean=false;
  billingTab:boolean=false;
  purchaseTab:boolean=false;
  loadingData:boolean=false;
  editprofileTab:boolean=false;
  profileData:any ='';
  orderData:any ='';
  order_items:any='';
  public currentUser: any;
  prchage:boolean = false;
  editProfileForm: FormGroup;
  firstname:string='';
  lastname:string='';
  address:string='';
  city:string='';
  mobile:number ;
  state:string='';
  country:string='';
  postal_code:string='';
    submitted = false;
    stateInfo: any[] = [];
    countryInfo: any[] = [];
    cityInfo: any[] = [];
  constructor(
      private route: ActivatedRoute,
      private heroService: HeroService,
      private location: Location,private dataHelper:imageFooterHelper,private formBuilder: FormBuilder, private authenticationService: HeroService,private router: Router,private spinner: NgxSpinnerService
  ) {
    this.authenticationService.currentUser.subscribe(x => {
      this.currentUser = x;
      if(!this.currentUser){
        this.router.navigate(['/']);
      }
    });

  }
  @HostListener('window:scroll', [])
  onWindowScroll() {
    if (document.body.scrollTop > 10 ||     
    document.documentElement.scrollTop > 10) {
      document.getElementById('navbarResponsive').classList.remove('show');
      //document.getElementById('paragraph').classList.add('green');
    }
  }
  ngOnInit() {
    this.loadingData = true;
    let tab = this.route.snapshot.queryParamMap.get("tab");
    this.getCountries();
    this.authenticationService.getUserprofileData()
        .subscribe(
            data => {
              this.profileData = data.data;
              this.loadingData = false;
                this.firstname=data.data.first_name;
                this.lastname=data.data.last_name;
                this.address=data.data.address;
                this.mobile=data.data.mobile;
                this.country=data.data.country;
                this.state=data.data.state;
                this.city=data.data.city;
                this.postal_code=data.data.postal_code;
             },
            error => {

            });
    this.authenticationService.getUserOrderData()
        .subscribe(
            orders => {
              this.orderData = orders.data;
              this.loadingData = false;
            },
            error => {

            });
    this.tabshow(tab);
    if(this.profileData){
      this.editProfileForm = this.formBuilder.group({
          first_name: [this.profileData.first_name, Validators.required],
          last_name: [this.profileData.last_name, Validators.required],
          mobile: [this.profileData.mobile, Validators.required],
          address: [this.profileData.address, Validators.required],
          country: [this.profileData.country, Validators.required],
          state: [this.profileData.state, Validators.required],
          city: [this.profileData.city, Validators.required],
          pincode: [this.profileData.pincode, [Validators.required, Validators.minLength(6), Validators.maxLength(6)]],

      });
  }else {
    this.editProfileForm = this.formBuilder.group({
        first_name: ['', Validators.required],
        last_name: ['', Validators.required],
        mobile: ['', Validators.required],
        address: ['', Validators.required],
        country: ['', Validators.required],
        state: ['', Validators.required],
        city: ['', Validators.required],
        pincode: ['', [Validators.required, Validators.minLength(6), Validators.maxLength(6)]],
    });
}
  }

    get f() { return this.editProfileForm.controls; }
    getCountries(){
        this.authenticationService.allCountries().
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.countryInfo=data2;
                //console.log('Data:', this.countryInfo);
            },
            err => console.log(err),
            () => console.log('complete')
        )
    }

    onChangeCountry(countryValue) {
        this.loadingData = true;

        //  console.log(this.countryInfo[countryValue]);
        this.authenticationService.allstates(countryValue).
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.stateInfo=data2;
                this.loadingData = false;
                //console.log('Data:', this.countryInfo);
            },
            err => console.log(err),
            () => console.log('complete')
        )

        // this.registerForm.controls['country'].setValue(this.countryInfo[countryValue].CountryName);
        // this.stateInfo=this.countryInfo[countryValue].States;
        // this.cityInfo=this.stateInfo[0].Cities;
        //  console.log(this.cityInfo);
    }
    onChangeCity(cityValue){
        // console.log(this.cityInfo[cityValue]);
        // this.registerForm.controls['city'].setValue(this.cityInfo[cityValue]);
    }
    onChangeState(stateValue) {
        this.loadingData = true;
        // let billing_address = localStorage.getItem('billing_address');
        // if(billing_address) {
        //     var billing_state = JSON.parse(billing_address);
        //     billing_state['city'] = '';
        //     localStorage.setItem('billing_address', JSON.stringify(billing_state));
        // }
        // console.log(this.stateInfo[stateValue]);
        this.authenticationService.allCities(stateValue).
        subscribe(
            data2 => {
                //this.countryInfo=data2.Countries;
                this.cityInfo=data2;
                this.loadingData = false;
                //console.log('Data:', this.countryInfo);
            },
            err => console.log(err),
            () => console.log('complete')
        )

        // this.registerForm.controls['state'].setValue(this.stateInfo[stateValue].StateName);
        // this.cityInfo=this.stateInfo[stateValue].Cities;
        // console.log(this.cityInfo);j
    }
  tabshow(type){
    if(type=='profile'){
      this.location.go('user-profile')
      this.profileTab = true;
      this.plansTab = false;
      this.billingTab = false;
      this.purchaseTab = false;
    }else if(type=='plans'){
      this.location.go('plans')
      this.profileTab = false;
      this.plansTab = true;
      this.billingTab = false;
      this.purchaseTab = false;
      this.editprofileTab = false;
    }else if(type=='billing'){
      this.profileTab = false;
      this.plansTab = false;
      this.billingTab = true;
      this.purchaseTab = false;
      this.editprofileTab = false;
    }else if(type=='purchase'){
      this.location.go('purchase')
      this.profileTab = false;
      this.plansTab = false;
      this.billingTab = false;
      this.purchaseTab = true;
      this.editprofileTab = false;
   }else if(type=='edit-profile'){
        this.location.go('edit-profile')
        this.profileTab = false;
        this.plansTab = false;
        this.billingTab = false;
        this.purchaseTab = false;
        this.editprofileTab = true;
    }

  }

  orderDetails(dataid){
    this.order_items = this.orderData[dataid]['items']
  }


  download(orderDetials,type){
    var token = localStorage.getItem('currentUser');
    let cartval = {
      "product_info":orderDetials,
      "token":token,
      "type":type
    };

    this.heroService.downloadindi(cartval)
        .subscribe(data => {
          console.log(data);
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
                Swal.fire('', "Not Downloaded", 'error');
               }
            }
          }

        });
  }
  posterData(imgstr){
      var newstr = imgstr.toString();
      newstr = newstr.replace("main_l.mp4","iconl.jpeg")
     console.log(newstr);
     return newstr;
  }

  toggle(){
    this.prchage = ! this.prchage;
  }



}
