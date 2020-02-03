import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import {ActivatedRoute, Router} from '@angular/router';
import {Location} from "@angular/common";
import {imageFooterHelper} from "../_helpers/image-footer-helper";
import {NgxSpinnerService} from "ngx-spinner";

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
    this.authenticationService.getUserprofileData()
        .subscribe(
            data => {
              this.profileData = data.data[0];
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
  }


  tabshow(type){
    if(type=='profile'){
      this.location.go('user-profile')
      this.profileTab = true;
      this.plansTab = false;
      this.billingTab = false;
      this.purchaseTab = false;
    }else if(type=='plans'){
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

}
