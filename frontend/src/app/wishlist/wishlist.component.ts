import { Component, OnInit } from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import { Router } from '@angular/router';

@Component({
  selector: 'app-wishlist',
  templateUrl: './wishlist.component.html',
  styleUrls: ['./wishlist.component.css']
})
export class WishlistComponent implements OnInit {


    wishListDataItems: Array<cartItemData> = [];
    priceArray: any = [];

    constructor(private heroService: HeroService, private authenticationService: HeroService, private router: Router) {
    }

    ngOnInit() {
        // console.log(localStorage.getItem('checkoutAray'));
        this.authenticationService.getcartItemsData()
            .subscribe(
                data => {
                    this.wishListDataItems = data;
                    this.wishListDataItems.forEach(element => {
                        this.priceArray.push(element["total"]);
                    });
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


    removeProductFromCart(productinfo) {
        console.log(productinfo);
        if (confirm('Are you sure?') == true) {
            this.heroService.removeCartItemsData(productinfo)
                .subscribe(data => {
                    if (data["status"] == '1') {
                        this.authenticationService.getcartItemsData()
                            .subscribe(
                                data => {
                                    this.wishListDataItems = data;
                                    this.wishListDataItems.forEach(element => {
                                        this.priceArray.push(element["total"]);
                                    });
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