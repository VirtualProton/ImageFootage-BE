import {Component, OnInit, ViewEncapsulation, HostListener, Inject} from '@angular/core';
import {HeroService} from '../hero.service';
import {Router} from '@angular/router';
import Swal from "sweetalert2";


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
 @HostListener('window:scroll', [])
  onWindowScroll() {
    if (document.body.scrollTop > 10 ||     
    document.documentElement.scrollTop > 10) {
      document.getElementById('navbarResponsive').classList.remove('show');
      //document.getElementById('paragraph').classList.add('green');
    }
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
                        Swal.fire('', data.message, 'error');
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
                        this.loaddata();
                        Swal.fire('', data["message"], 'success');
                       } else {
                        Swal.fire('', data["message"], 'error');
                    }

                });

        } else {
            return false;
        }
    }

    onNavigate(link,slug,pid,pweb,prod_type){
        window.location.href=link+slug+'?webtype='+pweb+'&type='+prod_type.toLowerCase()+'&prod_id='+pid+'&cat=';
    }

}
