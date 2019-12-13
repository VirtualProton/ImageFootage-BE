import { Component, OnInit } from '@angular/core';
import { cartItemData } from '../hero';
import { HeroService } from '../hero.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit {

  wishListDataItems:Array<cartItemData>=[];
  priceArray:any=[];
  
  constructor(private authenticationService: HeroService,private router: Router) { }

  ngOnInit() {

    this.authenticationService.getcartItemsData()
              .subscribe(
                  data => {
                    this.wishListDataItems=data;
                    this.wishListDataItems.forEach(element => {
                      console.log(element);
                      this.priceArray.push(element["total"]);
                    });
                  },
                  error => {
                     
                  });
  }

  showTotalPrice(){

    return this.priceArray.reduce(function(acc, val) { return acc + val; }, 0);
  }

  goToWishList(){
    this.router.navigate(['/wishlist']);
  }

}
