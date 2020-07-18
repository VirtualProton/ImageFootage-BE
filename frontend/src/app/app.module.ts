import { NgModule }       from '@angular/core';
import { BrowserModule }  from '@angular/platform-browser';
import { FormsModule, ReactiveFormsModule }    from '@angular/forms';
import { HttpClientModule }    from '@angular/common/http';
import { HttpModule } from '@angular/http';
import { HttpClientInMemoryWebApiModule } from 'angular-in-memory-web-api';
import { InMemoryDataService }  from './in-memory-data.service';
import { AppRoutingModule }     from './app-routing.module';
import { AppComponent }         from './app.component';
import { DashboardComponent }   from './dashboard/dashboard.component';
import { HeroDetailComponent }  from './hero-detail/hero-detail.component';
import { HeroesComponent }      from './heroes/heroes.component';
import { HeroSearchComponent }  from './hero-search/hero-search.component';
import { MessagesComponent }    from './messages/messages.component';
import { FooterComponent } from './footer/footer.component';
import { HeaderComponent } from './header/header.component';
import { AboutUsComponent } from './about-us/about-us.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { WishlistComponent } from './wishlist/wishlist.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ContactUsComponent } from './contact-us/contact-us.component';
import { TermsAndConditionsComponent } from './terms-and-conditions/terms-and-conditions.component';
import { PrivacyPolicyComponent } from './privacy-policy/privacy-policy.component';
import { LicenceAgreementComponent } from './licence-agreement/licence-agreement.component';
import { LoginComponent } from './login/login.component';
import { CheckoutComponent } from './checkout/checkout.component';
import { ContributorSignUpComponent } from './contributor-sign-up/contributor-sign-up.component';
import { NgxSpinnerModule } from "ngx-spinner";
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
import { OrderConfirmationComponent } from './order-confirmation/order-confirmation.component';
import { PricingComponent } from './pricing/pricing.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { TabModule } from 'angular-tabs-component';
import { ResetPasswordComponent } from './reset-password/reset-password.component';
import {
    SocialLoginModule,
    AuthServiceConfig,
    GoogleLoginProvider,
    FacebookLoginProvider,
} from "angular-6-social-login";
import { LightboxComponent } from './lightbox/lightbox.component';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import {MatTooltipModule} from '@angular/material/tooltip';

//sidebar
import { PerfectScrollbarModule } from 'ngx-perfect-scrollbar';
import { PERFECT_SCROLLBAR_CONFIG } from 'ngx-perfect-scrollbar';
import { PerfectScrollbarConfigInterface } from 'ngx-perfect-scrollbar';
import { FailOrderComponent } from './fail-order/fail-order.component';
import { ChangeResetPasswordComponent } from './change-reset-password/change-reset-password.component';
import { ChangePasswordComponent } from './change-password/change-password.component';
import { ProductPricingComponent } from './product-pricing/product-pricing.component';
import { NoRightClickDirective } from './no-right-click.directive';
import { ScrollComponent } from './scroll/scroll.component';
//sidebar end
import { NgMasonryGridModule } from 'ng-masonry-grid';
import {MatExpansionModule} from '@angular/material/expansion';
//import { MasonryLayoutComponent } from 'ngx-masonry-layout';
import { Ng5SliderModule } from 'ng5-slider';
import { ColorPickerModule } from 'ngx-color-picker';
import { FootageLicenceAgreementComponent } from './footage-licence-agreement/footage-licence-agreement.component';
import { EditProfileComponent } from './edit-profile/edit-profile.component';
import { ProfileMenuComponent } from './profile-menu/profile-menu.component';



// Configs 
export function getAuthServiceConfigs() {
  let config = new AuthServiceConfig( [
        {
          id: FacebookLoginProvider.PROVIDER_ID,
          provider: new FacebookLoginProvider("509349303296309")
		  // live 509349303296309
		  // test 396074584437141
        },
        {
          id: GoogleLoginProvider.PROVIDER_ID,
          provider: new GoogleLoginProvider("1015801520785-q9mr6cas6mkp5l13l27dm9ke7ejhv9la.apps.googleusercontent.com")
		  // amit 167319950494-feg723qt2cnhkugetigtguo6314tog9r.apps.googleusercontent.com
		  // aksrinivas 1015801520785-q9mr6cas6mkp5l13l27dm9ke7ejhv9la.apps.googleusercontent.com
        }
      ]
  );
  return config;
}
//sidebar
const DEFAULT_PERFECT_SCROLLBAR_CONFIG: PerfectScrollbarConfigInterface = {
  suppressScrollX: true
};
//sidebar end

@NgModule({
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule,
    HttpModule,
    NgbModule,
    ReactiveFormsModule,
    NgxSpinnerModule,
	TabModule,
    NoopAnimationsModule,
	SocialLoginModule,
	PerfectScrollbarModule,
	NgMasonryGridModule,
    InfiniteScrollModule,
	MatExpansionModule,
    Ng5SliderModule,
    ColorPickerModule,
    MatTooltipModule

	    
    // The HttpClientInMemoryWebApiModule module intercepts HTTP requests
    // and returns simulated server responses.
    // Remove it when a real server is ready to receive requests.
    // HttpClientInMemoryWebApiModule.forRoot(
    //   InMemoryDataService, { dataEncapsulation: false }
    // )
  ],
  declarations: [
    AppComponent,
    DashboardComponent,
    HeroesComponent,
    HeroDetailComponent,
    MessagesComponent,
    HeroSearchComponent,
    FooterComponent,
    HeaderComponent,
    AboutUsComponent,
    SignUpComponent,
    WishlistComponent,
    ContactUsComponent,
    TermsAndConditionsComponent,
    PrivacyPolicyComponent,
    LicenceAgreementComponent,
    LoginComponent,
    CheckoutComponent,
    ContributorSignUpComponent,
    OrderConfirmationComponent,
    PricingComponent,
    UserProfileComponent,
    ResetPasswordComponent,
    LightboxComponent,
    FailOrderComponent,
    ChangeResetPasswordComponent,
    ChangePasswordComponent,
    ProductPricingComponent,
    NoRightClickDirective,
    ScrollComponent,
    FootageLicenceAgreementComponent,
    EditProfileComponent,
    ProfileMenuComponent
    /*,
	MasonryLayoutComponent*/

  ],
  exports:[LoginComponent],
  providers: [
    {
      provide: AuthServiceConfig,
      useFactory: getAuthServiceConfigs
    },
	{
      provide: PERFECT_SCROLLBAR_CONFIG,
      useValue: DEFAULT_PERFECT_SCROLLBAR_CONFIG
    }
  ],
  bootstrap: [ AppComponent ]
})

export class AppModule { }
