import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import {ActivatedRoute, Router} from '@angular/router';
import {Location} from "@angular/common";
import {imageFooterHelper} from "../_helpers/image-footer-helper";
import {NgxSpinnerService} from "ngx-spinner";
import Swal from "sweetalert2";


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
  profileData:any ='';
  orderData:any ='';
  order_items:any='';
  public currentUser: any;
  constructor(
      private route: ActivatedRoute,
      private heroService: HeroService,
      private location: Location,private dataHelper:imageFooterHelper, private authenticationService: HeroService,private router: Router,private spinner: NgxSpinnerService
  ) {
    this.authenticationService.currentUser.subscribe(x => {
      this.currentUser = x;
      if(!this.currentUser){
        this.router.navigate(['/']);
      }
    });

  }
  ngOnInit() {
    this.loadingData = true;
    let tab = this.route.snapshot.queryParamMap.get("tab");

    this.authenticationService.getUserprofileData()
        .subscribe(
            data => {
              this.profileData = data.data;
              this.loadingData = false;
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
    }else if(type=='billing'){
      this.profileTab = false;
      this.plansTab = false;
      this.billingTab = true;
      this.purchaseTab = false;
    }else if(type=='purchase'){
      this.location.go('purchase')
      this.profileTab = false;
      this.plansTab = false;
      this.billingTab = false;
      this.purchaseTab = true;
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


}
