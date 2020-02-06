import {Component, OnInit, ViewEncapsulation} from '@angular/core';
import {HeroService} from '../hero.service';
import {Router} from '@angular/router';


@Component({
    selector: 'app-lightbox',
    templateUrl: './lightbox.component.html',
    styleUrls: ['./lightbox.component.css'],
    encapsulation: ViewEncapsulation.None
})
export class LightboxComponent implements OnInit {
    lightBoxListDataItems: any = [];
    priceArray: any = [];
    loadingData: boolean = false;
    promocodeflag: boolean = false;
    public currentUser: any;

    constructor(private heroService: HeroService, private authenticationService: HeroService, private router: Router) {
        this.authenticationService.currentUser.subscribe(x => {
            this.currentUser = x;
            if (!this.currentUser) {
                this.router.navigate(['/']);
            }

        });
    }

    ngOnInit() {
        //this.spinner.show();
        this.loadingData = true;
        // console.log(localStorage.getItem('checkoutAray'));
        this.loaddata();
    }

    loaddata() {
        this.authenticationService.getLightboxItemsData()
            .subscribe(
                data => {
                    this.loadingData = false;
                    if (data.status == '1') {
                        this.lightBoxListDataItems = data.data;
                    } else {
                        alert(data.message);
                    }

                    // this.lightBoxListDataItems.forEach(element => {
                    //   this.priceArray.push(element["total"]);
                    // });

                    //this.spinner.hide();
                },
                error => {

                });
    }

    removeProductFromWishlist(productinfo) {
        if (confirm('Are you sure?') == true) {
            this.loadingData = true;
            this.authenticationService.removeDataFromWishlist(productinfo)
                .subscribe(data => {
                    this.loadingData = false;
                    if (data["status"] == '1') {
                        alert(data["message"]);
                        this.loaddata();
                       } else {
                        alert(data["message"]);
                    }

                });

        } else {
            return false;
        }
    }


}
