import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import { Router } from '@angular/router';
import { NgxSpinnerService } from "ngx-spinner";


@Component({
  selector: 'app-wishlist',
  templateUrl: './wishlist.component.html',
  styleUrls: ['./wishlist.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class WishlistComponent implements OnInit {


    wishListDataItems: Array<cartItemData> = [];
    priceArray: any = [];
    loadingData:boolean=false;
    promocodeflag:boolean=false;
    public currentUser: any;
    constructor(private heroService: HeroService, private authenticationService: HeroService, private router: Router,private spinner: NgxSpinnerService) {
        this.authenticationService.currentUser.subscribe(x => {
            this.currentUser = x;
            if(!this.currentUser){
                this.router.navigate(['/']);
            }

        });
    }

    ngOnInit() {
        //this.spinner.show();
        this.loadingData = true;
        // console.log(localStorage.getItem('checkoutAray'));
        this.authenticationService.getcartItemsData()
            .subscribe(
                data => {
                    this.wishListDataItems = data;
                    this.wishListDataItems.forEach(element => {
                        this.priceArray.push(element["total"]);
                    });
                    this.loadingData = false;
                    //this.spinner.hide();
                },
                error => {

                });

    }

    showTotalPrice() {
        return this.priceArray.reduce(function (acc, val) {
            return acc + val;
        }, 0);
    }

    redirectToCheckout() {
        this.router.navigate(['/checkout']);
    }

    promocode(){
        this.promocodeflag = !this.promocodeflag;
    }
    removeProductFromCart(productinfo) {
        console.log(productinfo);
        if (confirm('Are you sure?') == true) {
            this.loadingData = true;
            this.heroService.removeCartItemsData(productinfo)
                .subscribe(data => {
                    if (data["status"] == '1') {
                        this.priceArray=[];
                        this.authenticationService.getcartItemsData()
                            .subscribe(
                                data => {
                                    this.wishListDataItems = data;
                                    this.wishListDataItems.forEach(element => {
                                        this.priceArray.push(element["total"]);
                                    });
                                    this.loadingData = false;
                                },
                                error => {

                                });
                    } else {
                        alert(data["message"]);
                    }

                });
            // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated

        } else {
            return false;
        }
    }
}
