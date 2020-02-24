import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { DashboardComponent }   from './dashboard/dashboard.component';
import { HeroesComponent }      from './heroes/heroes.component';
import { HeroDetailComponent }  from './hero-detail/hero-detail.component';
import { AboutUsComponent } from './about-us/about-us.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { WishlistComponent } from './wishlist/wishlist.component';
import { ContactUsComponent } from './contact-us/contact-us.component';
import { LicenceAgreementComponent } from './licence-agreement/licence-agreement.component';
import { TermsAndConditionsComponent } from './terms-and-conditions/terms-and-conditions.component';
import { PrivacyPolicyComponent } from './privacy-policy/privacy-policy.component';
import { HeroSearchComponent } from './hero-search/hero-search.component';
import { CheckoutComponent } from './checkout/checkout.component';
import { ContributorSignUpComponent } from './contributor-sign-up/contributor-sign-up.component';
import { PricingComponent } from './pricing/pricing.component';
import { OrderConfirmationComponent } from './order-confirmation/order-confirmation.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { ResetPasswordComponent } from './reset-password/reset-password.component';
import { LightboxComponent } from './lightbox/lightbox.component';
import { FailOrderComponent } from './fail-order/fail-order.component';
import { ChangeResetPasswordComponent } from './change-reset-password/change-reset-password.component';
import { ChangePasswordComponent } from './change-password/change-password.component';

const routes: Routes = [
 // { path: '/', redirectTo: '', pathMatch: 'full' },
  { path: '', component: DashboardComponent },
  { path: 'detail/:id/:webtype/:type/:cat', component: HeroDetailComponent },
  { path: 'search', component: HeroSearchComponent },
  { path: 'heroes', component: HeroesComponent },
  { path: 'aboutUs', component: AboutUsComponent },
  { path: 'signUp', component: SignUpComponent },
  { path: 'cart', component: WishlistComponent },
  { path: 'contactUs', component: ContactUsComponent },
  { path: 'license', component: LicenceAgreementComponent },
  { path: 'terms', component: TermsAndConditionsComponent },
  { path: 'privacy', component: PrivacyPolicyComponent },
  { path: 'tagging', component: ContactUsComponent },
  { path: 'checkout', component: CheckoutComponent },
  { path: 'pricing', component: PricingComponent },
  { path: 'contributor-sign-up', component: ContributorSignUpComponent },
  { path: 'orderConfirmation/:id', component: OrderConfirmationComponent },
  { path: 'user-profile', component: UserProfileComponent },
  { path: 'user-reset-password', component: ResetPasswordComponent },
  { path: 'wishlist', component: LightboxComponent },
  { path: 'orderFailed/:id', component: FailOrderComponent },
  { path: 'resetpassword/:otp/:email', component: ChangeResetPasswordComponent },
   { path: 'change-password', component: ChangePasswordComponent },

];

@NgModule({
  imports: [ RouterModule.forRoot(routes) ],
  exports: [ RouterModule ]
})
export class AppRoutingModule {}
