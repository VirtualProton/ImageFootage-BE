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


  wishListDataItems:Array<cartItemData>=[];
  priceArray:any=[];
  
  constructor( private authenticationService: HeroService,private router: Router) { }

  ngOnInit() {
    // console.log(localStorage.getItem('checkoutAray'));
    this.authenticationService.getcartItemsData()
              .subscribe(
                  data => {
                    this.wishListDataItems=data;
                    this.wishListDataItems.forEach(element => {
                      this.priceArray.push(element["total"]);
                    });
                  },
                  error => {
                     
                  });

  }

  showTotalPrice(){  
    return this.priceArray.reduce(function(acc, val) { return acc + val; }, 0);
  }
  redirectToCheckout(){
    this.router.navigate(['/checkout']);
  }

}
