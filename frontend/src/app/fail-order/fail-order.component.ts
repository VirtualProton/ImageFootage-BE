import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { HeroService } from '../hero.service';
import {ActivatedRoute, Router} from '@angular/router';
import Swal from "sweetalert2";

@Component({
  selector: 'app-fail-order',
  templateUrl: './fail-order.component.html',
  styleUrls: ['./fail-order.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class FailOrderComponent implements OnInit {

  loadingData:boolean=false;
  id:any ='';
  OrderDetailData:any =[];
  constructor(private route: ActivatedRoute,private heroService: HeroService, private authenticationService: HeroService, private router: Router) { }

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
                Swal.fire('', data.message, 'error');
              }

              //this.spinner.hide();
            },
            error => {

            });
  }

}
