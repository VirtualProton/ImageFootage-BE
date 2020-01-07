import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import { HeroService } from '../hero.service';
import { cartItemData } from '../hero';
import {ActivatedRoute, Router} from '@angular/router';
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-order-confirmation',
  templateUrl: './order-confirmation.component.html',
  styleUrls: ['./order-confirmation.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class OrderConfirmationComponent implements OnInit {

  loadingData:boolean=false;
  id:any ='';
  OrderDetailData:any =[];
  constructor(private route: ActivatedRoute,private heroService: HeroService, private authenticationService: HeroService, private router: Router,private spinner: NgxSpinnerService) {
  }

  ngOnInit() {
    this.loadingData = true;
    this.id = +this.route.snapshot.paramMap.get('id');
    this.authenticationService.getOrderDetails(this.id)
        .subscribe(
            data => {
              if(data.status=='success'){
                this.OrderDetailData = data.data[0];
                this.loadingData = false;
              }else{
                //this.OrderDetailData = data;
                this.loadingData = false;
                alert(data.message);
              }

              //this.spinner.hide();
            },
            error => {

            });
  }

}
