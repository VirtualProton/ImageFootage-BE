(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["main"],{

/***/ "./$$_lazy_route_resource lazy recursive":
/*!******************************************************!*\
  !*** ./$$_lazy_route_resource lazy namespace object ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function webpackEmptyAsyncContext(req) {
	// Here Promise.resolve().then() is used instead of new Promise() to prevent
	// uncaught exception popping up in devtools
	return Promise.resolve().then(function() {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	});
}
webpackEmptyAsyncContext.keys = function() { return []; };
webpackEmptyAsyncContext.resolve = webpackEmptyAsyncContext;
module.exports = webpackEmptyAsyncContext;
webpackEmptyAsyncContext.id = "./$$_lazy_route_resource lazy recursive";

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/about-us/about-us.component.html":
/*!****************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/about-us/about-us.component.html ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<section class=\"banner-area relative\">\r\n        <div class=\"overlay overlay-bg\"></div>\r\n        <div class=\"banner-content text-center\">\r\n          <h1>About Image Footage</h1>\r\n          <p>We are a privately owned group offering a variety of services that include,\r\n            <br />\r\n             stock imagery,stock footage, photography\r\n          </p>\r\n        </div>\r\n      </section>\r\n    \r\n    <section class=\"pt-5\">\r\n    \r\n      <div class=\"container f-18\">\r\n      \r\n      <p class=\"\">We are a privately owned group offering a variety of services that include stock imagery,stock footage, photography, image rendering, computer graphics (CG), 3D, and print publishing.</p>\r\n  <p>\r\n  The companies within the group cater to the ever evolving visual content and technology demands of leading corporationscreative agencies, and media organisations in the Asia Pacific & Middle Eastern Regions.With our networking capabilities, complementary resources, and the collaborative power to penetrate new markets,\r\n  </p>\r\n  <p>\r\n  we add immense value to our affiliate businesses and clients. Our global creative network combines an array of industryprofessionals and supply of visual content to leading media and marketing enterprises across the Asia Pacific and the Middle East.</p>\r\n  <p>\r\n  \r\n  Speed and technology are critical to our operations as we make things happen for you as a creative partner.</p>\r\n      \r\n      </div>\r\n    </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/app.component.html":
/*!**************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/app.component.html ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!-- <h1>{{title}}</h1>\r\n<nav>\r\n  <a routerLink=\"/dashboard\">Dashboard</a>\r\n  <a routerLink=\"/heroes\">Heroes</a>\r\n</nav> -->\r\n\r\n\r\n\r\n <app-header></app-header> \r\n<router-outlet></router-outlet>\r\n<!-- <app-messages></app-messages>  -->\r\n<app-footer *ngIf=\"footerEle\"></app-footer>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/checkout/checkout.component.html":
/*!****************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/checkout/checkout.component.html ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<section class=\"mt-5\">\r\n  \r\n        <div class=\"container\"> \r\n    \r\n                            <div class=\"row\">\r\n                   <div class=\"col-lg-5 col-md-5 col-sm-6 bg-light\">\r\n                      <div class=\"card z-depth-0\">\r\n                     <form class=\"loignForm p-5\">\r\n                     <h3 class=\"f-20 mb-3\">BILLING ADDRESS</h3>\r\n                       <div class=\"row form-group\">\r\n                       <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                         <label>First Name</label>\r\n                         <input type=\"text\" class=\"form-control rounded-0\">\r\n                       </div>\r\n                      \r\n                       <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                         <label>Last Name</label>\r\n                         <input type=\"text\" class=\"form-control\">\r\n                       </div>\r\n                       \r\n                        </div>\r\n                        \r\n                     <div class=\"form-group\">\r\n                         <label>Street Address</label>\r\n                         <textarea  class=\"form-control rounded-0\" rows=\"2\" style=\"min-height:70px;\"></textarea>\r\n                       </div>\r\n                       \r\n                     <div class=\"form-group\">\r\n                         <label>City</label>\r\n                         <input type=\"text\" class=\"form-control rounded-0\">\r\n                       </div>\r\n                       \r\n                       <div class=\"form-group\">\r\n                         <label>Country</label>\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">India</option>\r\n                          <option value=\"\">Canada</option>\r\n                          <option value=\"\">USA</option>\r\n                          <option value=\"\">Aus</option>\r\n                         </select>\r\n                       </div>\r\n                       \r\n                       <div class=\"row form-group pt-4\">\r\n                       <div class=\"col-md-6 col-lg-6 col-sm-6\">\r\n                         <label>State/province</label>\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">India</option>\r\n                          <option value=\"\">Canada</option>\r\n                          <option value=\"\">USA</option>\r\n                          <option value=\"\">Aus</option>\r\n                         </select>\r\n                       </div>\r\n                       \r\n                       <div class=\"col-md-6 col-sm-6 col-lg-6\">\r\n                         <label>Zipcode</label>\r\n                         <input type=\"text\" class=\"form-control\">\r\n                       </div>\r\n                       </div>\r\n                       \r\n                       <div class=\"form-group pt-3\">\r\n                       \r\n                         <button type=\"button\" class=\"btn btn-success btn-block text-white p-3 text-uppercase\"><strong>Enter Address\r\n                         </strong></button>\r\n                         <div class=\"clearfix\"></div>\r\n                         <hr>\r\n                         <h3 class=\"f-20 mb-4 mt-5\">PAYMENT INFORMATION</h3>\r\n    \r\n                         <div class=\"row\">\r\n                           <div class=\"col-md-8 col-sm-8 col-lg-8 col-xs-8\">\r\n                             \r\n                             <div class=\"custom-control custom-radio\">\r\n        <input type=\"radio\" class=\"custom-control-input\" id=\"customRadio\" name=\"example1\" value=\"customEx\" checked=\"\">\r\n        <label class=\"custom-control-label\" for=\"customRadio\"><strong>Credit Card</strong></label>\r\n      </div>\r\n                           </div>\r\n    \r\n                           <div class=\"col-md-4 col-sm-4 col-lg-4 col-xs-4\">\r\n                             \r\n                             <span><img src=\"assets/images/visa.png\" class=\"border p-1\" height=\"24\"></span>\r\n                             <span><img src=\"assets/images/mastarcard.png\"  class=\"border p-1\"  height=\"24\"></span>\r\n                           </div>\r\n    \r\n                         </div>\r\n                          <div class=\"row form-group mt-4\">\r\n                       <div class=\"col-lg-12 col-md-12 col-sm-12\">\r\n                         <label>Credit Card Number</label>\r\n                         <input type=\"number\" class=\"form-control rounded-0\">\r\n                       </div>                  \r\n                        </div>\r\n    \r\n                       <div class=\"row form-group\">\r\n                      <div class=\"col-md-8 col-lg-8 col-sm-8\">\r\n                         <label>Expiry Date</label>\r\n                         <div class=\"row\">\r\n                          <div class=\"col-md-6 col-sm-6 col-lg-6\">\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">MM</option>\r\n                          <option value=\"\">01</option>\r\n                          <option value=\"\">02</option>\r\n                          <option value=\"\">03</option>\r\n                         </select>\r\n                       </div>\r\n                       <div class=\"col-md-6 col-sm-6 col-lg-6\">\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">YY</option>\r\n                          <option value=\"\">2019</option>\r\n                          <option value=\"\">2018</option>\r\n                          <option value=\"\">2017</option>\r\n                         </select>\r\n                       </div>\r\n                       </div>\r\n                       </div>\r\n                      \r\n                       <div class=\"col-lg-4 col-md-4 col-sm-4\">\r\n                         <label>Security Code</label>\r\n                         <input type=\"text\" class=\"form-control\" placeholder=\"CVV\">\r\n                       </div>\r\n                       \r\n                        </div>\r\n    \r\n                         <div class=\"row form-group\">\r\n                       <div class=\"col-lg-12 col-md-12 col-sm-12\">\r\n                         <label>Name on Card</label>\r\n                         <input type=\"text\" class=\"form-control rounded-0\">\r\n                       </div>                  \r\n                        </div>\r\n                        \r\n                       \r\n                       </div>\r\n                       \r\n                       \r\n                     </form>\r\n                   </div>\r\n                   \r\n                   \r\n                   </div>\r\n                   \r\n                   <div class=\"col-lg-7 col-md-7 col-sm-6\">\r\n                    <div class=\"card\">\r\n                    <div class=\"table-responsive\">\r\n                      <table class=\"table cart-table checkout-table\">\r\n                        <thead class=\"f-16\">\r\n                          <tr>\r\n                            <th colspan=\"2\"><h3 class=\"f-18\">CART</h3>\r\n                            <p class=\"mb-0\">2 Items</p></th>\r\n                            <th align=\"right\" class=\"text-right\"><button class=\"btn btn-default rounded-0\" (click)=\"goToWishList()\">Edit</button></th>                          \r\n                          </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                          <tr *ngFor=\"let checkout of wishListDataItems;let i= index\">\r\n                            <td width=\"25%\" align=\"center\">\r\n                              <div class=\"product-info\">\r\n                                <img src=\"{{checkout.product_thumb}}\" alt=\"product-img\" height=\"100\">\r\n                              </div>                             \r\n                            </td>                            \r\n                            <td width=\"50%\">\r\n                               <p class=\"mb-1 text-black\"><strong>{{checkout.product_name}}</strong></p>\r\n                               <p class=\"mb-1\"><strong>Size:</strong>  {{checkout.standard_size}}</p>\r\n                            </td>\r\n                             <td width=\"25%\" align=\"right\"><p class=\"f-16 text-black\"><strong>{{checkout.total}} INR</strong></p>\r\n                             </td>\r\n                          </tr>\r\n                        </tbody>\r\n                        <tfoot class=\"text-black\">\r\n                          <tr class=\"f-20\">\r\n                          <td></td>\r\n                            <td align=\"right\"><strong>TOTAL</strong></td>\r\n                            <td align=\"right\"><strong>{{showTotalPrice()}} USD</strong></td>\r\n                          </tr>\r\n                          <tr class=\"f-20\">\r\n                              <td></td>\r\n                              <td align=\"right\"><strong>Taxes</strong></td>\r\n                              <td align=\"right\"><strong>10.00 INR</strong></td>\r\n                          </tr>\r\n                          <tr class=\"f-16\">\r\n                          <td></td>\r\n                            <td align=\"right\"><strong>BALANCE DUE</strong></td>\r\n                            <td align=\"right\"><strong>{{showTotalPrice() + 10 }} USD</strong></td>\r\n                          </tr>\r\n                        </tfoot>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n               </div>\r\n                \r\n            </div>\r\n        </div>\r\n      </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/contact-us/contact-us.component.html":
/*!********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/contact-us/contact-us.component.html ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<section class=\"banner-area relative\">\r\n    <div class=\"overlay overlay-bg\"></div>\r\n    <div class=\"banner-content text-center\">\r\n      <h1>Contact Us</h1>\r\n      <p>\r\n        Elementum libero hac leo integer. Risus hac parturient feugiat litora\r\n        <br />\r\n        cursus hendrerit bibendum per\r\n      </p>\r\n    </div>\r\n  </section>\r\n  <section class=\"contact-page-area section-gap\">\r\n    <div class=\"container\">\r\n      <div class=\"row\">\r\n       \r\n        <div class=\"col-lg-4 d-flex flex-column address-wrap\">\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\"><span class=\"icon-home2 mr-1\"></span></div>\r\n            <div class=\"contact-details\">\r\n              <h5>Binghamton, New York</h5>\r\n              <p>4343 Hinkle Deegan Lake Road</p>\r\n            </div>\r\n          </div>\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\">\r\n              <span class=\"icon-phone2 mr-1\"></span>\r\n            </div>\r\n            <div class=\"contact-details\">\r\n              <h5>00 (958) 9865 562</h5>\r\n              <p>Mon to Fri 9am to 6 pm</p>\r\n            </div>\r\n          </div>\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\"><span class=\"icon-envelope-o mr-1\"></span></div>\r\n            <div class=\"contact-details\">\r\n              <h5>support@colorlib.com</h5>\r\n              <p>Send us your query anytime!</p>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <div class=\"col-lg-8\">\r\n          <form class=\"form-area contact-form text-right\"  id=\"myForm\" [formGroup]=\"contactForm\" (ngSubmit)=\"onContactSubmit()\">\r\n            <div class=\"row\">\r\n              <div class=\"col-lg-6 form-group\">\r\n                <input name=\"name\" formControlName=\"user_name\" [ngClass]=\"{ 'is-invalid': submitted && f.user_name.errors }\"   placeholder=\"Enter your name\"  class=\"common-input mb-20 form-control\"   type=\"text\" />\r\n                <div *ngIf=\"submitted && f.user_name.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_name.errors.required\">Name is required</div>\r\n                </div>\r\n                <input name=\"email\" type=\"text\" placeholder=\"Enter email address\" class=\"common-input mb-20 form-control\" formControlName=\"user_email\" [ngClass]=\"{ 'is-invalid': submitted && f.user_email.errors }\"/>\r\n                <div *ngIf=\"submitted && f.user_email.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_email.errors.required\">Email is required</div>\r\n                    <div *ngIf=\"f.user_email.errors.email\">Email must be a valid email address</div>\r\n                </div>\r\n                <input  name=\"subject\" placeholder=\"Enter subject\"  class=\"common-input mb-20 form-control\" type=\"text\"  formControlName=\"user_subject\" [ngClass]=\"{ 'is-invalid': submitted && f.user_subject.errors }\"/>\r\n                <div *ngIf=\"submitted && f.user_subject.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_subject.errors.required\">Subject is required</div>\r\n                </div>\r\n                <input placeholder=\"Enter mobile number\"  class=\"common-input mb-20 form-control\" pattern=\"[0-9]*\"  type=\"text\" id=\"mbnum\" formControlName=\"mobile_number\" [ngClass]=\"{ 'is-invalid': submitted && f.mobile_number.errors }\" class=\"form-control text-white\">\r\n                <div *ngIf=\"submitted && f.mobile_number.errors\" class=\"invalid-feedback\">\r\n                  <div *ngIf=\"f.mobile_number.errors.required\">Mobile Number is required</div>\r\n                  <div *ngIf=\"f.mobile_number.errors.minlength || f.mobile_number.errors.maxlength\">Mobile number should be 10 digits</div>\r\n                  <div *ngIf=\"f.mobile_number.errors.pattern\">Mobile numberr should be only numbers</div>\r\n                </div>\r\n              </div>\r\n              <div class=\"col-lg-6 form-group\">\r\n                <textarea  class=\"common-textarea form-control\"  name=\"message\" formControlName=\"user_message\" [ngClass]=\"{ 'is-invalid': submitted && f.user_message.errors }\" placeholder=\"Enter Messege\"  ></textarea>\r\n                <div *ngIf=\"submitted && f.user_message.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_message.errors.required\">Message is required</div>\r\n                </div>\r\n              </div>\r\n              <div class=\"col-lg-12\">\r\n                <div class=\"alert-msg\" style=\"text-align: left;\"></div>\r\n                <button  [disabled]=\"loading\" type=\"submit\" class=\"primary-btn text-uppercase\"   style=\"float: right;\">Send Message </button>\r\n              </div>\r\n            </div>\r\n          </form>\r\n        </div>\r\n      </div>\r\n      \r\n       <div class=\"row pt-5\">\r\n       <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243647.31698201783!2d78.2679590430495!3d17.412299801300147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99daeaebd2c7%3A0xae93b78392bafbc2!2sHyderabad%2C%20Telangana!5e0!3m2!1sen!2sin!4v1570531072830!5m2!1sen!2sin\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>\r\n       </div>\r\n    </div>\r\n  </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/dashboard/dashboard.component.html":
/*!******************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/dashboard/dashboard.component.html ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\r\n<div class=\"video-background-holder\">\r\n  <div class=\"video-background-overlay\"></div>\r\n  <video playsinline=\"playsinline\" autoplay muted=\"muted\" loop>\r\n        <source src=\"https://imagefootage.com/video/VIDEO_2_25MB_home.mp4\" type=\"video/mp4\">\r\n    </video>\r\n  <div class=\"video-background-content container h-100\">\r\n    <div class=\"d-flex h-100 text-center align-items-center\">\r\n      <div class=\"col-md-10 col-sm-10 col-lg-10 m-auto\">\r\n      <div class=\"w-100 text-white vedio_text\">\r\n        <h1 class=\"display-4\"><strong>Bring Your Vision to Life Without Compromise</strong></h1>\r\n           \r\n          <form class=\"search_m\">\r\n    <div class=\"input-group\">\r\n          <div class=\"input-group-btn\" ngbDropdown >\r\n            <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n             <span *ngIf='searchBoxLabel == 1'>Photos Only</span>\r\n             <span *ngIf='searchBoxLabel == 2'>Videos Only</span>\r\n             <span *ngIf='searchBoxLabel == 3'>Photos + Videos</span>\r\n\r\n\r\n            </button>\r\n            <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('1')\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('3')\" ngbDropdownItem>Photos + Videos</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('2')\" ngbDropdownItem>Videos Only</a>\r\n               </div>\r\n          </div>\r\n          <input type=\"text\" class=\"form-control\" #searchBoxEle  aria-label=\"Text input with dropdown button\">\r\n          <a href=\"javascript:void(0)\" class=\"iconSearch\" (click)=\"searchAosData(searchBoxEle.value)\"><span class=\"fa fa-camera text-gray\"></span></a>\r\n        </div>\r\n  </form>\r\n      </div>\r\n    </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<!--<header class=\"masthead\">\r\n    <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n            <video id=\"theVideo\" autoplay=\"autoplay\" loop=\"loop\" controls=\"controls\" muted=\"muted\" style=\"position: absolute;\r\n    display: block;\r\n    z-index: -1;\r\n    top: 0;\r\n    left: 0;\r\n    object-fit: cover;\r\n    height: 100%;\r\n    min-width: 100%;\" poster=\"https://imagefootage.com/img/bg.png\"><source src=\"https://imagefootage.com/video/VIDEO_2_25MB_home.mp4\" type=\"video/mp4\"></video>\r\n        </div>\r\n      <div class=\"intro-text\">\r\n      \r\n        <div class=\"intro-lead-in text-warning\">Bring Your Vision to Life</div>\r\n        <div class=\"intro-heading text-uppercase\">Without Compromise</div>\r\n        <div class=\"col-md-9 col-sm-9 m-auto\">\r\n            <form class=\"search_m\">\r\n    <div class=\"input-group\">\r\n          <div class=\"input-group-btn\" ngbDropdown >\r\n            <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n             <span *ngIf='searchBoxLabel == 1'>Photos Only</span>\r\n             <span *ngIf='searchBoxLabel == 2'>Videos Only</span>\r\n             <span *ngIf='searchBoxLabel == 3'>Photos + Videos</span>\r\n\r\n\r\n            </button>\r\n            <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('1')\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('3')\" ngbDropdownItem>Photos + Videos</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('2')\" ngbDropdownItem>Videos Only</a>\r\n               </div>\r\n          </div>\r\n          <input type=\"text\" class=\"form-control\" #searchBoxEle  aria-label=\"Text input with dropdown button\">\r\n          <a href=\"javascript:void(0)\" class=\"iconSearch\" (click)=\"searchAosData(searchBoxEle.value)\"><span class=\"icon-search\"></span></a>\r\n        </div>\r\n  </form>\r\n        \r\n        </div>\r\n      </div>\r\n    </div>\r\n  </header>-->\r\n\r\n  <div class=\"site-wrap\">\r\n    <div class=\"container-fluid text-center my-5\">\r\n      <div class=\"row mx-auto my-auto\">\r\n          <div id=\"recipeCarousel\" class=\"carousel slide w-100\">\r\n              <div class=\"carousel-inner\" role=\"listbox\">\r\n               {{carouselSliderImages.categoryNames | json}}\r\n               <ngb-carousel [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\">\r\n                    <div class=\"carousel-item\">\r\n                        <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages;let i= index\">\r\n                          <div class=\"col-11 m-auto\">\r\n                              <div class=\"row\">\r\n                                    <div class=\"col-md-2 col-sm-2 col-4 text-center\" *ngFor=\"let images of carouseimges.categoryNames\">\r\n                                      <a href=\"javascript:void(0)\" [routerLink]=\"['/search']\" [queryParams]=\"{type:1,keyword:images.name}\">{{images.name}}</a>\r\n                                    </div>\r\n                              </div>\r\n                          </div>\r\n                        </ng-template>\r\n                    </div>\r\n                </ngb-carousel>\r\n\r\n                \r\n              </div>\r\n\r\n            </div>\r\n        </div>\r\n      </div>\r\n      <main class=\"main-content mt-3\">\r\n          <div class=\"container-fluid photos\">\r\n            <div class=\"row align-items-stretch\">\r\n\r\n                <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n                    <a *ngIf=\"aosimges.product_web == '2' || aosimges.product_web == '1'\" routerLink=\"/detail/{{aosimges.api_product_id}}/{{aosimges.product_web}}/{{aosimges.product_main_type}}\" class=\"d-block photo-item\">\r\n\r\n                      <img  src=\"{{aosimges.product_thumbnail}}\" alt=\"Image\" class=\"img-fluid\">\r\n\r\n                        <!-- <iframe  *ngIf=\"aosimges.mimetype != 'image/jpeg'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>  -->\r\n                      <div class=\"photo-text-more\">\r\n                      \r\n                        <div class=\"photo-text-more\">\r\n                        <h3 class=\"heading\">{{aosimges.product_title}}</h3>\r\n                        <span class=\"meta\">{{aosimges.product_description}}</span>\r\n                      </div>\r\n                      </div>\r\n                    </a>\r\n                    <a  *ngIf=\"aosimges.product_web == '3'\" routerLink=\"/detail/{{aosimges.api_product_id}}/{{aosimges.product_web}}/{{aosimges.product_main_type}}\" class=\"d-block \">\r\n                         <video  width=\"400\" height=\"300\" controls onmouseover=\"this.play()\" onmouseout=\"this.pause()\">\r\n                            <source src=\"{{aosimges.product_thumbnail}}\" type=\"video/mp4\">\r\n                            Your browser does not support the video tag.\r\n                        </video>\r\n                        <!-- <iframe  *ngIf=\"aosimges.mimetype != 'image/jpeg'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>  -->\r\n                 </a>\r\n                </div>\r\n\r\n           </div>\r\n\r\n            \r\n\r\n            <div class=\"col-md-5 col-sm-6 col-12 m-auto\" *ngIf=\"aoslSliderImagesData.length !=0\"> \r\n                    <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \r\n            </div>\r\n\r\n          </div>\r\n      </main>\r\n          \r\n\r\n\r\n    </div>\r\n<!-- <app-hero-search></app-hero-search> -->\r\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/footer/footer.component.html":
/*!************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/footer/footer.component.html ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<footer>\n\n    <div class=\"container\">\n      \n      \n        <div class=\"row\">\n           <div class=\"col-md-4 col-sm-4\">\n              <h3>About Image Footage</h3>\n              <p>We are a privately owned group offering a variety of services that include stock imagery,stock footage, photography, image rendering, computer graphics (CG), 3D, and print publishing.</p>\n           \n           </div>\n           \n           <div class=\"col-md-3 col-sm-3 offset-md-1 offset-sm-1\">\n              <h3>Quick Links</h3>\n             <ul>\n               <li><a routerLink=\"/aboutUs\">About Us</a></li>\n                <li><a routerLink=\"/contactUs\">Contact Us</a></li>\n                 <li><a routerLink=\"/licene\">License Agreement</a></li>\n                  <li><a routerLink=\"/terms\">Terms & Conditions</a></li>\n                   <li><a routerLink=\"/privacy\">Privacy Policy</a></li>\n                    <li><a routerLink=\"/tagging\">Tagging tutorial</a></li>\n                     \n             </ul>\n           \n           </div>\n           \n           <div class=\"col-md-4 col-sm-4\">\n              <h3>Contact Info</h3>\n              \n              <p class=\"tollfree\">  Toll free: 18004198123</p>\n              <p><a href=\"#\" class=\"text-white\">info@imagefootage.com</a></p>\n              <p><a href=\"#\"  class=\"text-white\">admin@imagefootage.com</a></p>\n             \n           \n           </div>\n        \n        </div>  \n       \n       <div class=\"clearfix\"></div>\n       <hr>\n       <div class=\"row justify-content-center\">\n          <div class=\"col-md-12 text-center py-3\">\n            <p>\n         Copyright 2019 imagefotage. All right reserved\n        </p>\n          </div>\n        </div>\n    \n    </div>\n  \n  \n  </footer>\n  "

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/header/header.component.html":
/*!************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/header/header.component.html ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--<nav class=\"navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink\" id=\"mainNav\">\r\n    <div class=\"container\">\r\n      <a class=\"navbar-brand js-scroll-trigger\" routerLink=\"/dashboard\">Image Footage</a>\r\n      <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\r\n        Menu\r\n        <i class=\"fas fa-bars\"></i>\r\n      </button>\r\n      <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">\r\n        <ul class=\"navbar-nav text-uppercase ml-auto\">\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" [routerLink]=\"['/search']\" [queryParams]=\"{type:1,keyword:''}\">Images</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\"  [routerLink]=\"['/search']\" [queryParams]=\"{type:2,keyword:''}\">Footage</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/about\">Editorial</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/team\">Pricing</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/wishlist\">Cart</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" (click)=\"clickLoginPopup()\">Cart</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"clickLoginPopup()\">Login</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"logout()\">Logout</a>\r\n          </li>\r\n          <li class=\"nav-item\"  *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/signUp\">Sign Up</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n              <a class=\"nav-link js-scroll-trigger\"  routerLink=\"/wishlist\">wishlist</a>\r\n            </li>\r\n        </ul>\r\n      </div>\r\n    </div>\r\n  </nav>-->\r\n  \r\n  <!-- Navigation -->\r\n  <nav class=\"navbar navbar-expand-lg navbar-dark fixed-top\" id=\"mainNav\">\r\n    <div class=\"container-fluid\">\r\n      <a class=\"navbar-brand js-scroll-trigger\" href=\"#page-top\">Image Footage</a>\r\n      <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\r\n        Menu\r\n        <i class=\"fas fa-bars\"></i>\r\n      </button>\r\n      <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">\r\n        <ul class=\"navbar-nav text-uppercase ml-auto\">\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" [routerLink]=\"['/search']\" [queryParams]=\"{type:1,keyword:''}\">Images</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\"  [routerLink]=\"['/search']\" [queryParams]=\"{type:2,keyword:''}\">Footage</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/about\">Editorial</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/team\">Pricing</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/wishlist\">Cart</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" (click)=\"clickLoginPopup()\">Cart</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"clickLoginPopup()\">Login</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"logout()\">Logout</a>\r\n          </li>\r\n          <li class=\"nav-item\"  *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/signUp\">Sign Up</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n              <a class=\"nav-link js-scroll-trigger\"  routerLink=\"/wishlist\">wishlist</a>\r\n            </li>\r\n        </ul>\r\n      </div>\r\n    </div>\r\n  </nav>\r\n\r\n\r\n<ng-container *ngIf=\"showloginPopup\">\r\n  <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n</ng-container>\r\n  "

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/hero-detail/hero-detail.component.html":
/*!**********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/hero-detail/hero-detail.component.html ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"site-wrap mt-5 pt-5 bg-dark\">   \r\n  <main class=\"main-content p-0\">\r\n    <div class=\"container-fluid photos\">\r\n      <div class=\"row mr-2\">\r\n        <div class=\"col-md-8 col-sm-8 col-xl-8 col-lg-8\">\r\n          <div class=\"cartItem\" *ngIf=\"detailPageInfo\">\r\n            <div class=\"p-3\">          \r\n              <div data-aos=\"fade-up\">\r\n                  <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                      <img src=\"{{detailPageInfo.media.preview_url_no_wm}}\" alt=\"Image\" class=\"img-fluid\">\r\n                      <div class=\"photo-text-more\">            \r\n                        <div class=\"photo-text-more\">\r\n                          <h3 class=\"heading\">{{detailPageInfo.metadata.title}}</h3>\r\n                          <span class=\"meta\">{{detailPageInfo.photoCount}} Photos</span>\r\n                        </div>\r\n                      </div>\r\n                  </a>\r\n              </div>         \r\n              <p class=\"text-white f-18\">{{detailPageInfo.metadata.description}}</p>\r\n              <p>{{detailPageInfo.shortInfo}}</p>\r\n              <p class=\"text-warning\">Related Keywords</p>            \r\n              <div class=\"related_key\">{{detailPageInfo.metadata.keywords}}\r\n<!--                <ng-container *ngFor=\"let keyele of detailPageInfo?.keywords\">                  -->\r\n<!--                    <a href=\"javascript:void(0)\"  class=\"btn btn-outline-light\" title=\"{{keyele.id}}\">{{keyele.name}}</a>-->\r\n<!--                </ng-container>   -->\r\n                            \r\n              </div>\r\n            </div>\r\n              \r\n          </div>\r\n        </div>\r\n         \r\n        <div class=\"col-md-4 col-sm-4 col-xl-4 col-lg-4 pt-3 cart_right pl-3 mt-3\" *ngIf=\"detailPageInfo\">\r\n          <div  class=\"p-3\">\r\n            <ngb-tabset class=\"nav nav-tabs mytabs\">\r\n                <ngb-tab   class=\"nav-item\">\r\n                    <ng-template ngbTabTitle class=\"nav-link active\">Standard Licence</ng-template>\r\n                  <ng-template ngbTabContent >\r\n                      <div class=\"tab-content pt-3\">\r\n                          <div>\r\n                              <p class=\"text-white text-uppercase lsp-1 f-14 pt-3\">standard Royalty Free Licenses</p>\r\n                              <div class=\"btn-group btn-group-toggle mb-1\" data-toggle=\"buttons\">\r\n                                  <ng-container *ngFor=\"let cost of detailPageInfo.articles.singlebuy_list.singlebuy[0].sizes.article;let i=index;let first=first;\">\r\n                                      <label class=\"btn btn-dark\" [ngClass]=\"first ? 'active' : ''\">\r\n                                          <input type=\"radio\" name=\"options\" id=\"option{{i}}\" autocomplete=\"off\" [class]=\"i==0 ? 'checked' : ''\" (click)=\"checkPriceTotal(cost)\">\r\n                                          <p class=\"mb-0\">{{cost.description}}</p>\r\n                                          <p><small><span class=\"text-warning\"> {{cost.description}}</span> {{cost.width}}x{{cost.height}} </small></p>\r\n                                          <p class=\"f-30 mb-0\"> <i class=\"fa fa-dollar\"></i>{{cost.price*80}}</p>\r\n                                      </label>\r\n                                  </ng-container>\r\n                              \r\n                              </div>\r\n\r\n                          </div>\r\n                      </div>\r\n                  </ng-template>\r\n                </ngb-tab>\r\n\r\n                <ngb-tab class=\"nav-item\">\r\n                  <ng-template ngbTabTitle class=\"nav-link\">Extended Licence</ng-template>\r\n                  <ng-template  ngbTabContent>\r\n                      <div class=\"tab-content pt-3\">\r\n                          <div>\r\n                              <p class=\"text-white lsp-1 f-14 text-uppercase pt-3\">Extended Licenses</p>\r\n                              <div class=\"btn-group btn-group-toggle mb-4  d-block\" data-toggle=\"buttons\">\r\n                                  <ng-container *ngFor=\"let license of detailPageInfo.articles.singlebuy_list.singlebuy[0].extended_rights.article;let j=index;let first=first;\">\r\n                                      <label class=\"btn btn-dark\" [ngClass]=\"first ? 'active' : ''\">\r\n                                          <input type=\"radio\" name=\"options\" id=\"option{{j}}\" autocomplete=\"off\" [class]=\"j==0 ? 'checked' : ''\" (click)=\"addExtendedPriceTotal(license)\">\r\n                                          <div class=\"row align-items-center\">\r\n                                              <div class=\"col-md-9 col-sm-9 col-lg-9\">\r\n                                                <p class=\"f-14\"> {{license.name}}</p>\r\n                                              </div>\r\n                                              <div class=\"col-md-3 col-sm-3 col-lg-3\">\r\n                                                  <p class=\"mb-0\"> <i class=\"fa fa-dollar\"></i>{{license.price*80}}</p>\r\n                                              </div>\r\n                                          </div>\r\n                                      </label>\r\n                                  </ng-container>\r\n                                \r\n                              </div>\r\n                              \r\n                           </div>\r\n                      </div>\r\n                  </ng-template>\r\n                </ngb-tab>\r\n            </ngb-tabset>\r\n          </div>\r\n            <div class=\"row mt-5\" *ngIf=\"total>0\">\r\n                <div class=\"col-12\">\r\n                    <p class=\"text-white\" *ngIf=\"currunt_selected_price>0\">Selected Price:-  {{currunt_selected_price}} </p>\r\n                    <p class=\"text-white\" *ngIf=\"extended_price>0\">Selected Extended Price :-  {{extended_price}}</p>\r\n                </div>\r\n                <div class=\"col-4\">\r\n                    <p class=\"text-white\"><strong>Total</strong></p>\r\n                </div>\r\n                <div class=\"col-8 text-right\">\r\n                    <h2 class=\"text-warning f-24\"><strong>{{total}} INR</strong></h2>\r\n                </div>\r\n            </div>\r\n            <div class=\"row mt-2 mb-5\">\r\n              <div class=\"col-12\">\r\n                  <button type=\"button\" *ngIf=\"!addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" (click)=\"addToCheckoutItem(detailPageInfo,standard,total,extended,'2')\">ADD TO CART</button>\r\n                  <button type=\"button\" *ngIf=\"addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" >ADDED TO CART</button>\r\n                  <p>This image is exclusive to Image Footage</p>\r\n              </div>\r\n            </div>\r\n            <p class=\"\">DETAILS</p>\r\n            <table class=\"f-12\">\r\n              <tbody>\r\n                <tr>\r\n                  <td width=\"20%\">Restrictions :</td>\r\n                  <td>Contact your local office for all commercial or promotional uses.</td>\r\n                </tr>\r\n                <tr>\r\n                  <td>Credit :</td>\r\n                  <td>{{detailPageInfo.metadata.author_realname}}</td>\r\n                </tr>\r\n                <tr>\r\n                  <td>Editorial # :</td>\r\n                  <td>{{detailPageInfo.metadata.editorial}}</td>\r\n                </tr>\r\n<!--                <tr>-->\r\n<!--                  <td>Collection :</td>-->\r\n<!--                  <td>Getty Images News</td>-->\r\n<!--                </tr>-->\r\n                <tr>\r\n                  <td>Date created :</td>\r\n                  <td>{{detailPageInfo.metadata.date}}</td>\r\n                </tr>\r\n                <tr>\r\n                  <td>Licence type :</td>\r\n                  <td *ngIf=\"detailPageInfo.options.extended=='yes'\">Extended</td>\r\n                    <td *ngIf=\"detailPageInfo.options.rights_managed=='yes'\">Extended</td>\r\n                </tr>\r\n                <tr>\r\n                  <td>Release info :</td>\r\n                  <td>Not released. More information</td>\r\n                </tr>\r\n<!--                <tr>-->\r\n<!--                  <td>Source :</td>-->\r\n<!--                  <td>Getty Images AsiaPac</td>-->\r\n<!--                </tr>-->\r\n\r\n                <tr>\r\n                  <td>Object name :</td>\r\n                  <td>{{detailPageInfo.media.id}}</td>\r\n                </tr>\r\n\r\n                <tr>\r\n                  <td>Max file size :</td>\r\n                  <td>{{detailPageInfo.media.width}} x {{detailPageInfo.media.height}} </td>\r\n                </tr>\r\n              </tbody>\r\n\r\n            </table>\r\n        </div> \r\n\r\n        \r\n      </div>\r\n \r\n    \r\n    \r\n      <div class=\"bg-black p-3\">\r\n        <div class=\"row align-items-stretch\">\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">                    \r\n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>   \r\n                            </ng-template>\r\n                        </div> \r\n                    </ngb-carousel>\r\n                     \r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">                    \r\n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>   \r\n                            </ng-template>\r\n                        </div> \r\n                    </ngb-carousel>\r\n                     \r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">                    \r\n                    <ngb-carousel  [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>   \r\n                            </ng-template>\r\n                        </div> \r\n                    </ngb-carousel>\r\n                     \r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n\r\n          <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n            <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\r\n              <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n              <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n              <div class=\"photo-text-more\">\r\n              \r\n                <div class=\"photo-text-more\">\r\n                <h3 class=\"heading\">{{aosimges.name}}</h3>\r\n                <span class=\"meta\">{{aosimges.count}} Photos</span>\r\n              </div>\r\n              </div>\r\n            </a>\r\n          </div>\r\n\r\n          <div class=\"col-md-5 col-sm-6 col-12 m-auto\">\r\n\r\n                <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \r\n        </div>\r\n\r\n\r\n\r\n\r\n      \r\n      \r\n      \r\n\r\n\r\n   \r\n      \r\n        \r\n        \r\n\r\n      </div>\r\n      \r\n       \r\n      </div>\r\n    </div>\r\n  </main>\r\n\r\n</div> \r\n\r\n<ng-container *ngIf=\"showloginPopup\">\r\n    <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n</ng-container>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/hero-search/hero-search.component.html":
/*!**********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/hero-search/hero-search.component.html ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"site-wrap\">\r\n  <div class=\"page-wrapper chiller-theme toggled\">\r\n    <a id=\"show-sidebar\" class=\"btn btn-sm btn-dark\" href=\"javascript:void(0)\">\r\n      <i class=\"fas fa-bars\"></i>\r\n    </a>\r\n    <nav id=\"sidebar\" class=\"sidebar-wrapper\">\r\n      <div class=\"sidebar-content\">\r\n          <div class=\"sidebar-brand\">\r\n              <a href=\"javascript:void(0)\">FILTERS</a>\r\n              <div id=\"close-sidebar\">\r\n                <i class=\"fas fa-times\"></i>\r\n              </div>\r\n          </div>\r\n          <div class=\"sidebar-header\"> \r\n                <div class=\"btn-group btn-group-toggle search-select\" data-toggle=\"buttons\">\r\n                  <label  [class]=\"searchData.productType == 1 ? 'btn btn-dark active' : 'btn btn-dark'\">\r\n                    <input type=\"radio\"  name=\"options\" [(ngModel)]=\"searchData.productType\" value=\"1\">\r\n                    <p class=\"mb-0\"> <i class=\"fa fa-camera\"></i> </p>\r\n                    <p class=\"mb-0\">PHOTOS</p> \r\n                  </label>\r\n                  <label  [class]=\"searchData.productType == 2 ? 'btn btn-dark active' : 'btn btn-dark'\">\r\n                    <input type=\"radio\" name=\"options\" [(ngModel)]=\"searchData.productType\" value=\"2\">\r\n                    <p class=\"mb-0\"> <i class=\"fa fa-video\"></i> </p>\r\n                    <p class=\"mb-0\">  VIDEOS </p>\r\n                  </label>  \r\n                </div>\r\n          </div>\r\n        <div class=\"sidebar-menu\">\r\n          <ul>           \r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu1=!sidebarSubmenu1\">  \r\n                <i class=\"fa fa-tachometer-alt\"></i>\r\n                <span> People</span>              \r\n              </a>  \r\n               <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu1\">\r\n                <ul>\r\n                  <li *ngFor=\"let peoples of leftsideData.product_peoples\">\r\n                    <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('people',peoples.people_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('people',peoples.people_id)\">{{peoples.people_name}}</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu2=!sidebarSubmenu2\">\r\n                <i class=\"fa fa-shopping-cart\"></i>\r\n                <span>Gender</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu sidebar-submenu-btn\" *ngIf=\"sidebarSubmenu2\">\r\n                <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('gender',gender.gender_id) ? 'btn btn-dark active' : 'btn btn-dark'\"  *ngFor=\"let gender of leftsideData.product_gender\" (click)=\"onSideMenuClick('gender',gender.gender_id)\"> \r\n                  {{gender.gender_name}}</a>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu3=!sidebarSubmenu3\">\r\n                <i class=\"far fa-gem\"></i>\r\n                <span>Ethnicity</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu3\">\r\n                <ul>\r\n                  <li *ngFor=\"let ethinicities of leftsideData.product_ethinicities\">\r\n                    <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('ethinicity',ethinicities.ethinicity_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('ethinicity',ethinicities.ethinicity_id)\">{{ethinicities.ethinicity_name}}</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu4=!sidebarSubmenu4\">\r\n                <i class=\"fa fa-chart-line\"></i>\r\n                <span>Location</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu4\">\r\n                <ul>\r\n                  <li  *ngFor=\"let locations of leftsideData.product_locations\">\r\n                    <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('locations',locations.location_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('locations',locations.location_id)\">{{locations.location_name}}</a>\r\n                 </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu5=!sidebarSubmenu5\">\r\n                <i class=\"fa fa-globe\"></i>\r\n                <span>Color</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu5\">\r\n                <ul>\r\n                  <li  *ngFor=\"let colors of leftsideData.product_colors\">\r\n                    <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('colors',colors.pcolor_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('colors',colors.pcolor_id)\">{{colors.pcolor_name}}</a>\r\n                  </li>\r\n                 \r\n                </ul>\r\n              </div>\r\n            </li>\r\n             <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu6=!sidebarSubmenu6\">\r\n                <i class=\"fa fa-globe\"></i>\r\n                <span>Orientations</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu6\">\r\n                <ul>\r\n                  <li *ngFor=\"let orientation of leftsideData.product_orientations\">\r\n                    <a href=\"javascript:void(0)\"  [ngClass]=\"getSideBarClassName('orientation',orientation.orientation_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('orientation',orientation.orientation_id)\">{{orientation.orientation_name}}</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n             <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu7=!sidebarSubmenu7\">\r\n                <i class=\"fa fa-globe\"></i>\r\n                <span>Image Types</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu7\">\r\n                <ul>\r\n                  <li *ngFor=\"let imageTypes of leftsideData.product_imagetypes\">\r\n                    <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('imageTypes',imageTypes.imagetype_id) ? 'active' : ' '\"    (click)=\"onSideMenuClick('imageTypes',imageTypes.imagetype_id)\">{{imageTypes.imagetype_name}}</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu8=!sidebarSubmenu8\">\r\n                <i class=\"fa fa-globe\"></i>\r\n                <span>Image Sizes</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu8\">\r\n                <ul>\r\n                  <li *ngFor=\"let imagesizes of leftsideData.product_imagesizes\">\r\n                    <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('imagesizes',imagesizes.imagesize_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('imagesizes',imagesizes.imagesize_id)\">{{imagesizes.imagesize_name}}</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n                <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu9=!sidebarSubmenu9\">\r\n                  <i class=\"fa fa-globe\"></i>\r\n                  <span>Sort Types</span>\r\n                </a>\r\n                <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu9\">\r\n                  <ul>\r\n                    <li *ngFor=\"let sorttype of leftsideData.product_sorttype\">\r\n                      <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('sorttype',sorttype.sorttype_id) ? 'active' : ' '\" (click)=\"onSideMenuClick('sorttype',sorttype.sorttype_id)\">{{sorttype.sorttype_name}}</a>\r\n                    </li>\r\n                  </ul>\r\n                </div>\r\n              </li>\r\n          </ul>\r\n        </div>\r\n        <!-- sidebar-menu  -->\r\n      </div>\r\n      <!-- sidebar-content  -->\r\n      <div class=\"sidebar-footer\">\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-bell\"></i>\r\n          <span class=\"badge badge-pill badge-warning notification\">3</span>\r\n        </a>\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-envelope\"></i>\r\n          <span class=\"badge badge-pill badge-success notification\">7</span>\r\n        </a>\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-cog\"></i>\r\n          <span class=\"badge-sonar\"></span>\r\n        </a>\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-power-off\"></i>\r\n        </a>\r\n      </div>\r\n    </nav>\r\n    <!-- sidebar-wrapper  -->\r\n    <main class=\"page-content\">\r\n      <main class=\"main-content\">\r\n          <div class=\"search_m header_serach mt-3 mb-3\">\r\n              <div class=\"input-group search-bar\">\r\n                  <div class=\"input-group-btn\" ngbDropdown >\r\n                      <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n                        <span *ngIf='searchData.productType == 3'>Photos + Videos</span>\r\n                        <span *ngIf='searchData.productType == 1'>Photos Only</span>\r\n                        <span *ngIf='searchData.productType == 2'>Videos Only</span>\r\n                      </button>\r\n                      <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(3)\" ngbDropdownItem>Photos + Videos</a>\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(1)\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(2)\" ngbDropdownItem>Videos Only</a>\r\n                      </div>\r\n                  </div>\r\n                  <input type=\"text\" [(ngModel)]=\"searchData.search\" #ctrl=\"ngModel\" (keydown)=\"onKeydown($event)\" class=\"form-control\" aria-label=\"Text input with dropdown button\">\r\n                  <i class=\"fa fa-camera\"></i>\r\n              </div>\r\n          </div>\r\n          <div class=\"bg-dark search_menu_l\">\r\n            <ul class=\"search_menu search_menu col-md-6 m-auto col-sm-6\">\r\n              <li [class]=\"searchData.letest == 1 ? 'active' : ' '\"><a href=\"javascript:void(0)\" (click)=\"onTabClick(1)\">LATEST</a></li>\r\n              <li [class]=\"searchData.curated == 1 ? 'active' : ' '\"><a href=\"javascript:void(0)\" (click)=\"onTabClick(2)\">RELEVENCE</a></li>\r\n              <li [class]=\"searchData.populer == 1 ? 'active' : ' '\"><a href=\"javascript:void(0)\" (click)=\"onTabClick(3)\">POPULAR</a></li>\r\n            </ul>\r\n          </div>\r\n          <div class=\"clearfix\"></div>\r\n          <div class=\"photos mt-5 pt-5\">\r\n            <div class=\"row align-items-stretch\">  \r\n                <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImages | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n                    <a routerLink=\"/detail/{{aosimges.product_id}}/{{aosimges.product_web}}/{{aosimges.product_main_type}}\" class=\"d-block photo-item\">\r\n                      <img *ngIf=\"aosimges.product_main_type == 'Image'\" src=\"{{aosimges.product_main_image}}\" alt=\"Image\" class=\"img-fluid\">\r\n                      <iframe  *ngIf=\"aosimges.product_main_type != 'Image'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                      <div class=\"photo-text-more\">\r\n                      \r\n                        <div class=\"photo-text-more\">\r\n                        <h3 class=\"heading\">{{aosimges.product_title}}</h3>\r\n                        <span class=\"meta\">{{aosimges.description}} Photos</span>\r\n                      </div>\r\n                      </div>\r\n                    </a>\r\n                </div>\r\n            </div>\r\n        \r\n            <div class=\"col-md-5 col-sm-6 col-12 m-auto\" *ngIf=\"aoslSliderImages.length !=0\">\r\n              <ngb-pagination [collectionSize]=\"aoslSliderImages.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \r\n    \r\n            </div>        \r\n          </div>\r\n    </main>\r\n  \r\n    </main>\r\n    <!-- page-content\" -->\r\n  </div>\r\n  \r\n  </div> \r\n  "

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/heroes/heroes.component.html":
/*!************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/heroes/heroes.component.html ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<h2>My Heroes</h2>\n\n<div>\n  <label>Hero name:\n    <input #heroName />\n  </label>\n  <!-- (click) passes input value to add() and then clears the input -->\n  <button (click)=\"add(heroName.value); heroName.value=''\">\n    add\n  </button>\n</div>\n\n<ul class=\"heroes\">\n  <li *ngFor=\"let hero of heroes\">\n    <a routerLink=\"/detail/{{hero.id}}\">\n      <span class=\"badge\">{{hero.id}}</span> {{hero.name}}\n    </a>\n    <button class=\"delete\" title=\"delete hero\"\n      (click)=\"delete(hero)\">x</button>\n  </li>\n</ul>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/licence-agreement/licence-agreement.component.html":
/*!**********************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/licence-agreement/licence-agreement.component.html ***!
  \**********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<p>licence-agreement works!</p>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/login/login.component.html":
/*!**********************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/login/login.component.html ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\r\n        <div style=\"position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1050;outline: 0;\">    \r\n            <div class=\"modal-dialog modal-lg\">\r\n                <div class=\"modal-content rounded-0\">\r\n                    <div class=\"modal-header border-0\">\r\n                        <button type=\"button\" class=\"close f-36\" data-dismiss=\"modal\" (click)=\"closePopup()\">×</button>\r\n                    </div>\r\n                    <div class=\"modal-body\">\r\n                        <div class=\"col-lg-8 offset-lg-2 col-md-8 offset-md- col-sm-10 offset-sm-1\">\r\n                            <div class=\"pl-5 pr-5 pt-2 pb-2\">           \r\n                                <div class=\"login-sec\">\r\n                                    <h2 class=\"text-center f-20 text-black mb-3\"><strong>Sign in to Image Footage</strong></h2>\r\n                                    <form class=\"loignForm\" [formGroup]=\"loginForm\" (ngSubmit)=\"onSubmit()\">\r\n                                        <div class=\"text-center\">\r\n                                            <button type=\"button\" class=\"btn btn-outline-dark pt-2 pb-2 pl-5 pr-5 rounded-0\"><span class=\"icon-facebook text-primary\"></span> Facebook</button>\r\n                                            <button type=\"button\" class=\"btn btn-outline-dark pt-2 pb-2 pl-5 pr-5 rounded-0 ml-2\"><span class=\"icon-google text-danger\"></span> Google</button>\r\n                                            <p class=\"pt-3 f-12\">All your activity will remain private.</p>\r\n                                            <div class=\"orSec\"><span class=\"ortextNew\">or</span></div>\r\n                                        </div>\r\n                                        \r\n                                        <div class=\"form-group mt-5\">\r\n                                            <label class=\"text-uppercase f-14 text-black\">Email </label>\r\n                                            <input type=\"email\" class=\"form-control\" formControlName=\"email\" name=\"email\" [ngClass]=\"{ 'is-invalid': submitted && f.email?.errors }\">\r\n                                            <div *ngIf=\"submitted && f.email?.errors\" class=\"invalid-feedback\">\r\n                                              <div *ngIf=\"f.email?.errors.required\">Email is required</div>\r\n                                              <div *ngIf=\"f.email?.errors.pattern\">Invalid email format</div>\r\n                                            </div>\r\n                                          </div>\r\n                                        <div class=\"form-group mt-3\">\r\n                                            <label class=\"text-uppercase f-14 text-black\">Password</label>\r\n                                            <input type=\"password\" class=\"form-control\" formControlName=\"password\"  [ngClass]=\"{ 'is-invalid': submitted && f.password?.errors }\">\r\n                                            <div *ngIf=\"submitted && f.password?.errors\" class=\"invalid-feedback\">\r\n                                              <div *ngIf=\"f.password?.errors.required\">Password is required</div>\r\n                                          </div>\r\n                                        </div>\r\n                \r\n                                        <a href=\"#\" class=\"f-14 text-primary\">Forgot Password?</a>\r\n                \r\n                                        <div class=\"form-group mt-3\">                                \r\n                                            <button type=\"submit\" [disabled]=\"loading\" class=\"btn btn-dark w-100 d-block rounded-0 p-3 text-white shadow-lg mb-3\">Submit</button>\r\n                                            <p class=\"f-12 text-center\">Not a member as yet?<a routerLink=\"/signUp\" class=\"text-primary\"> Register Now</a></p>\r\n                                        </div>      \r\n                                    </form>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        \r\n            <!-- <div class=\"modal-footer\">\r\n              <button type=\"button\" class=\"btn btn-outline-dark\" (click)=\"modal.close('Save click')\">Save</button>\r\n            </div> -->\r\n        </div>\r\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/messages/messages.component.html":
/*!****************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/messages/messages.component.html ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div *ngIf=\"messageService.messages.length\">\n\n  <h2>Messages</h2>\n  <button class=\"clear\"\n          (click)=\"messageService.clear()\">clear</button>\n  <div *ngFor='let message of messageService.messages'> {{message}} </div>\n\n</div>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/privacy-policy/privacy-policy.component.html":
/*!****************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/privacy-policy/privacy-policy.component.html ***!
  \****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<p>privacy-policy works!</p>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/sign-up/sign-up.component.html":
/*!**************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/sign-up/sign-up.component.html ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"site-wrap mt-5 pt-5\">\r\n    <main class=\"main-content mt-5 pt-5\">\r\n      <div class=\"container photos\">\r\n        <div class=\"row\">\r\n          \r\n          <div class=\"col-md-10 pt-3\"  data-aos=\"fade-up\">\r\n            <h2 class=\"text-white mb-4\">Create your Image Footage account</h2>\r\n            <p>Already have an account? <a (click)=\"clickLoginPopup()\">Login</a></p>\r\n  \r\n                    <form [formGroup]=\"registerForm\" (ngSubmit)=\"onSubmit()\"  class=\"mt-5 pt-5\">\r\n  \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"col-md-4 col-sm-4 mb-3 mb-md-0\">\r\n                              <label class=\"text-white\">First Name</label>\r\n                              <input type=\"text\" formControlName=\"first_name\" [ngClass]=\"{ 'is-invalid': submitted && f.first_name.errors }\" class=\"form-control text-white\">\r\n                              <div *ngIf=\"submitted && f.first_name.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.first_name.errors.required\">First Name is required</div>\r\n                              </div>\r\n                          </div>\r\n                          <div class=\"col-md-4 col-sm-4 \">\r\n                              <label class=\"text-white\" >Last Name</label>\r\n                              <input type=\"text\" formControlName=\"last_name\" id=\"lname\" [ngClass]=\"{ 'is-invalid': submitted && f.last_name.errors }\"  class=\"form-control text-white\">\r\n                              <div *ngIf=\"submitted && f.last_name.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.last_name.errors.required\">Last Name is required</div>\r\n                              </div>\r\n                          </div>\r\n                          <div class=\"col-md-4 col-sm-4 \">\r\n                            <label class=\"text-white\">Email</label> \r\n                            <input type=\"text\" formControlName=\"email\" id=\"email\" class=\"form-control text-white\" [ngClass]=\"{ 'is-invalid': submitted && f.email.errors }\">\r\n                            <div *ngIf=\"submitted && f.email.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.email.errors.required\">Email is required</div>\r\n                                <div *ngIf=\"f.email.errors.email\">Email must be a valid email address</div>\r\n                            </div>\r\n                          </div>\r\n                      </div>\r\n  \r\n                      <div class=\"row form-group mb-5\">                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Password</label> \r\n                            <input type=\"password\" formControlName=\"password\" [ngClass]=\"{ 'is-invalid': submitted && f.password.errors }\" id=\"pswrd\" class=\"form-control text-white\">\r\n                            <div *ngIf=\"submitted && f.password.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.password.errors.required\">Password is required</div>\r\n                                <div *ngIf=\"f.password.errors.minlength\">Password must be at least 6 characters</div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\">Confirm Password</label> \r\n                            <input type=\"password\" formControlName=\"confirmPassword\" id=\"cnfpswrd\" [ngClass]=\"{ 'is-invalid': submitted && f.confirmPassword.errors }\" class=\"form-control text-white\">\r\n                            <div *ngIf=\"submitted && f.confirmPassword.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.confirmPassword.errors.required\">Confirm Password is required</div>\r\n                                <div *ngIf=\"f.confirmPassword.errors.mustMatch\">Passwords must match</div>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Job Title</label> \r\n                          <input type=\"text\" formControlName=\"occupation\" id=\"jobTitle\" [ngClass]=\"{ 'is-invalid': submitted && f.occupation.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.occupation.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.occupation.errors.required\">JobTitle is required</div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                \r\n                      <div class=\"row form-group mb-5\">\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Company</label> \r\n                          <input type=\"text\" id=\"companyName\" formControlName=\"company\" [ngClass]=\"{ 'is-invalid': submitted && f.company.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.company.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.company.errors.required\">Company is required</div>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Phone</label> \r\n                          <input type=\"text\" id=\"phne\" formControlName=\"phoneNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.phoneNumber.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.phoneNumber.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.phoneNumber.errors.required\">PhoneNumber is required</div>\r\n                          </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Mobile Number</label> \r\n                          <input type=\"text\" id=\"mbnum\" formControlName=\"mobileNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.mobileNumber.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.mobileNumber.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.mobileNumber.errors.required\">MobileNumber is required</div>\r\n                            <div *ngIf=\"f.mobileNumber.errors.minlength || f.mobileNumber.errors.maxlength\">Mobile number should be 10 digits</div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                      \r\n                      <div class=\"row form-group mb-5\">\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Select Country</label>\r\n                            <select class=\"form-control\" id=\"select-language1\" [ngClass]=\"{ 'is-invalid': submitted && f.country.errors }\"  formControlName=\"country\" (change)=\"onChangeCountry($event.target.value)\">\r\n                                <option *ngFor=\"let country of countryInfo; let i = index\"  value=\"{{country.id}}\">{{country.name}}</option>\r\n                            </select> \r\n                            <div *ngIf=\"submitted && f.country.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.country.errors.required\">Country is required</div>\r\n                             </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Select State</label>                           \r\n                            <select class=\"form-control\" id=\"select-language2\" formControlName=\"state\" [ngClass]=\"{ 'is-invalid': submitted && f.state.errors }\" (change)=\"onChangeState($event.target.value)\">\r\n                                <option *ngIf=\"stateInfo == ''\" value=\"-1\">--Select State--</option>\r\n                                <option *ngFor=\"let state of stateInfo; let j = index\"  value=\"{{state.id}}\">{{state.state}}</option>\r\n                            </select> \r\n                            <div *ngIf=\"submitted && f.state.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.state.errors.required\">State is required</div>\r\n                             </div>\r\n                        </div>                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\">Select City</label> \r\n                            <select class=\"form-control  text-white\" id=\"select-language3\" formControlName=\"city\" [ngClass]=\"{ 'is-invalid': submitted && f.city.errors }\" (change)=\"onChangeCity($event.target.value)\">\r\n                                <option *ngIf=\"cityInfo == ''\" value=\"-1\">--Select CIty--</option>\r\n                                <option *ngFor=\"let city of cityInfo; let k = index\"  value=\"{{city.id}}\">{{city.name}}</option>\r\n                            </select> \r\n                            <div *ngIf=\"submitted && f.city.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.city.errors.required\">City is required</div>\r\n                             </div>\r\n                        </div>\r\n                      </div>\r\n  \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Zip Code</label> \r\n                            <input type=\"text\" id=\"pincode\" class=\"form-control\" formControlName=\"pincode\"  [ngClass]=\"{ 'is-invalid': submitted && f.pincode.errors }\">\r\n                            <div *ngIf=\"submitted && f.pincode.errors\" class=\"invalid-feedback\" >\r\n                                <div *ngIf=\"f.pincode.errors.required\">ZipCode is required</div>\r\n                                <div *ngIf=\"f.pincode.errors.minlength || f.pincode.errors.maxlength\">ZipCode number should be 6 digits</div>\r\n                              </div>\r\n                          </div>\r\n                          \r\n                          <div class=\"col-md-8 col-sm-8\">\r\n                            <label class=\"text-white\">Address</label> \r\n                            <textarea name=\"address\" id=\"address\" cols=\"5\" rows=\"1\" class=\"form-control\" placeholder=\"\" [ngClass]=\"{ 'is-invalid': submitted && f.address.errors }\" formControlName=\"address\"></textarea>\r\n                            <div *ngIf=\"submitted && f.address.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.address.errors.required\">Address is required</div>\r\n                            </div>\r\n                          </div>                        \r\n                      </div>\r\n                      \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"custom-control custom-checkbox\">\r\n                              <input type=\"checkbox\" class=\"custom-control-input\" formControlName=\"iagree\" [ngClass]=\"{ 'is-invalid': submitted && f.iagree.errors }\" id=\"customCheck\">\r\n                              <label class=\"custom-control-label\" for=\"customCheck\"> Make me an Approved Client* with the ability to license and download images online without a credit card.</label>\r\n                              <div *ngIf=\"submitted && f.iagree.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.iagree.errors.required\">Please accept Terms & Conditions</div>\r\n                              </div>   \r\n                          </div>\r\n                      </div>\r\n                    \r\n                      <div class=\"row form-group text-center\">\r\n                        <div class=\"col-md-12\">\r\n                          <button [disabled]=\"loading\" type=\"submit\" class=\"btn btn-warning btn-md text-white\">Create Account</button>\r\n                        </div>\r\n                      </div>\r\n  \r\n          \r\n                    </form>\r\n                 \r\n          \r\n          </div>\r\n  \r\n        </div>\r\n  \r\n        \r\n      </div>\r\n    </main>\r\n  \r\n  </div>\r\n\r\n  <ng-container *ngIf=\"showloginPopup\">\r\n      <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n  </ng-container>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/terms-and-conditions/terms-and-conditions.component.html":
/*!****************************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/terms-and-conditions/terms-and-conditions.component.html ***!
  \****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<p>terms-and-conditions works!</p>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/wishlist/wishlist.component.html":
/*!****************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/wishlist/wishlist.component.html ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<section>\r\n <div class=\"container\">\r\n          <div class=\"card pb-3 shadow-sm\" *ngIf=\"wishListDataItems.length>0\">\r\n            <form method=\"#\">\r\n              <div class=\"table-responsive\">\r\n                <table class=\"table cart-table\">\r\n                  <tbody>\r\n                    <tr *ngFor=\"let wishList of wishListDataItems;let i= index\">\r\n                      <td width=\"25%\" align=\"center\">\r\n                          <div class=\"product-info\">\r\n                              <a href=\"javascript:void(0)\">\r\n                                <img src=\"{{wishList.product_thumb}}\" alt=\"product-img\" />\r\n                              </a>\r\n                              <div class=\"pt-3 cart_option\">\r\n<!--                                  <a href=\"javascript:void(0)\" class=\"f-22\"><i class=\"fa fa-plus-circle\"></i></a>-->\r\n                                  <a href=\"javascript:void(0)\"  class=\"f-22 pl-1\" (click)=\"removeProductFromCart(wishList)\"><i class=\"fa fa-times-circle\"></i></a>\r\n                              </div>\r\n                          </div>                       \r\n                      </td>                      \r\n                      <td width=\"50%\">\r\n                         <p class=\"mb-1 text-black f-18\"><strong>{{wishList.product_name}}</strong></p>\r\n                         <p class=\"mb-1 f-16\"><strong>Size:</strong>  {{wishList.standard_size}}</p>\r\n                         <p class=\"mb-1\">{{wishList.product_desc}}</p>\r\n                      </td>\r\n                       <td width=\"25%\" align=\"right\"><p class=\"f-18 text-black\"><strong>{{wishList.total}} INR</strong></p>\r\n                       </td>\r\n                    </tr>\r\n                  </tbody>\r\n                </table>\r\n              </div>\r\n\r\n              <hr>\r\n            \r\n                <div class=\"col-12\">\r\n                <div class=\"p-3 row\">\r\n                  <div class=\"col-md-4 col-sm-4 col-lg-4\">\r\n                  <a href=\"javascript:void();\" id=\"promocode\">Have a promo code ?</a>\r\n                  <div class=\" show-promocode\">\r\n                  <div class=\"row\">\r\n                    <div class=\"col-md-8 col-sm-8 col-lg-8\">                        \r\n                      <input type=\"text\" name=\"\" class=\"form-control\" placeholder=\"Coupon Code\">\r\n                    </div>\r\n                    <div class=\"col-md-4 col-sm-4 col-lg-4 pl-1\">                        \r\n                      <button class=\"btn btn-success\">Apply</button>\r\n                    </div>\r\n                  </div>\r\n                  </div>\r\n                </div>\r\n                 <div class=\"col-md-8 col-sm-8 col-lg-8\">\r\n                  <ul class=\"list-unstyled text-right text-black f-18 text-black\">\r\n                    <li class=\"pb-3 fw-6 \">Sub Total <span class=\"d-inline-block w-100px\">{{showTotalPrice()}} INR</span></li>\r\n                    <li class=\"pb-5 fw-6 \">Taxes <span class=\"d-inline-block w-100px\">10.00 INR</span></li>\r\n                    <li class=\"pb-2 fw-8 f-22\">Grand Total <span class=\"d-inline-block w-100px\">{{showTotalPrice() + 10}} INR</span></li>\r\n                  </ul>\r\n                  </div>\r\n                  </div>\r\n                  <div class=\"my-3\">\r\n                   <hr>\r\n              <a href=\"javascript:void(0)\"  class=\"btn btn-success float-right pt-3 pb-3 pl-5 pr-5 f-20 text-uppercase\" (click)=\"redirectToCheckout()\"><strong>Checkout</strong></a>\r\n              </div>\r\n                </div>\r\n              \r\n             \r\n            </form>\r\n          </div>\r\n     <div class=\"card pb-3 shadow-sm\" *ngIf=\"wishListDataItems.length==0\">\r\n        Your Cart is Empty.\r\n     </div>\r\n  </div>\r\n</section>"

/***/ }),

/***/ "./src/app/_helpers/image-footer-helper.ts":
/*!*************************************************!*\
  !*** ./src/app/_helpers/image-footer-helper.ts ***!
  \*************************************************/
/*! exports provided: imageFooterHelper */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "imageFooterHelper", function() { return imageFooterHelper; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let imageFooterHelper = class imageFooterHelper {
    // custom validator to check that two fields match
    mustMatch(controlName, matchingControlName) {
        return (formGroup) => {
            const control = formGroup.controls[controlName];
            const matchingControl = formGroup.controls[matchingControlName];
            if (matchingControl.errors && !matchingControl.errors.mustMatch) {
                // return if another validator has already found an error on the matchingControl
                return;
            }
            // set error on matchingControl if validation fails
            if (control.value !== matchingControl.value) {
                matchingControl.setErrors({ mustMatch: true });
            }
            else {
                matchingControl.setErrors(null);
            }
        };
    }
    shuffleArray(array) {
        let m = array.length, t, i;
        // While there remain elements to shuffle
        while (m) {
            // Pick a remaining element…
            i = Math.floor(Math.random() * m--);
            // And swap it with the current element.
            t = array[m];
            array[m] = array[i];
            array[i] = t;
        }
        return array;
    }
};
imageFooterHelper = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({ providedIn: 'root' })
], imageFooterHelper);



/***/ }),

/***/ "./src/app/about-us/about-us.component.css":
/*!*************************************************!*\
  !*** ./src/app/about-us/about-us.component.css ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2Fib3V0LXVzL2Fib3V0LXVzLmNvbXBvbmVudC5jc3MifQ== */"

/***/ }),

/***/ "./src/app/about-us/about-us.component.ts":
/*!************************************************!*\
  !*** ./src/app/about-us/about-us.component.ts ***!
  \************************************************/
/*! exports provided: AboutUsComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AboutUsComponent", function() { return AboutUsComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let AboutUsComponent = class AboutUsComponent {
    constructor() { }
    ngOnInit() {
    }
};
AboutUsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-about-us',
        template: __webpack_require__(/*! raw-loader!./about-us.component.html */ "./node_modules/raw-loader/index.js!./src/app/about-us/about-us.component.html"),
        styles: [__webpack_require__(/*! ./about-us.component.css */ "./src/app/about-us/about-us.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], AboutUsComponent);



/***/ }),

/***/ "./src/app/app-routing.module.ts":
/*!***************************************!*\
  !*** ./src/app/app-routing.module.ts ***!
  \***************************************/
/*! exports provided: AppRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AppRoutingModule", function() { return AppRoutingModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./dashboard/dashboard.component */ "./src/app/dashboard/dashboard.component.ts");
/* harmony import */ var _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./heroes/heroes.component */ "./src/app/heroes/heroes.component.ts");
/* harmony import */ var _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./hero-detail/hero-detail.component */ "./src/app/hero-detail/hero-detail.component.ts");
/* harmony import */ var _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./about-us/about-us.component */ "./src/app/about-us/about-us.component.ts");
/* harmony import */ var _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./sign-up/sign-up.component */ "./src/app/sign-up/sign-up.component.ts");
/* harmony import */ var _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./wishlist/wishlist.component */ "./src/app/wishlist/wishlist.component.ts");
/* harmony import */ var _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./contact-us/contact-us.component */ "./src/app/contact-us/contact-us.component.ts");
/* harmony import */ var _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./licence-agreement/licence-agreement.component */ "./src/app/licence-agreement/licence-agreement.component.ts");
/* harmony import */ var _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./terms-and-conditions/terms-and-conditions.component */ "./src/app/terms-and-conditions/terms-and-conditions.component.ts");
/* harmony import */ var _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./privacy-policy/privacy-policy.component */ "./src/app/privacy-policy/privacy-policy.component.ts");
/* harmony import */ var _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./hero-search/hero-search.component */ "./src/app/hero-search/hero-search.component.ts");
/* harmony import */ var _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./checkout/checkout.component */ "./src/app/checkout/checkout.component.ts");















const routes = [
    { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
    { path: 'dashboard', component: _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_3__["DashboardComponent"] },
    { path: 'detail/:id/:webtype/:type', component: _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_5__["HeroDetailComponent"] },
    { path: 'search', component: _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_13__["HeroSearchComponent"] },
    { path: 'heroes', component: _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_4__["HeroesComponent"] },
    { path: 'aboutUs', component: _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_6__["AboutUsComponent"] },
    { path: 'signUp', component: _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_7__["SignUpComponent"] },
    { path: 'wishlist', component: _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_8__["WishlistComponent"] },
    { path: 'contactUs', component: _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_9__["ContactUsComponent"] },
    { path: 'licence', component: _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_10__["LicenceAgreementComponent"] },
    { path: 'terms', component: _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_11__["TermsAndConditionsComponent"] },
    { path: 'privacy', component: _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_12__["PrivacyPolicyComponent"] },
    { path: 'tagging', component: _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_9__["ContactUsComponent"] },
    { path: 'checkout', component: _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_14__["CheckoutComponent"] },
];
let AppRoutingModule = class AppRoutingModule {
};
AppRoutingModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forRoot(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })
], AppRoutingModule);



/***/ }),

/***/ "./src/app/app.component.css":
/*!***********************************!*\
  !*** ./src/app/app.component.css ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2FwcC5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/app.component.ts":
/*!**********************************!*\
  !*** ./src/app/app.component.ts ***!
  \**********************************/
/*! exports provided: AppComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AppComponent", function() { return AppComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");



let AppComponent = class AppComponent {
    constructor(router, actRoute) {
        this.router = router;
        this.actRoute = actRoute;
        this.title = 'Image Footage';
        this.footerEle = true;
    }
    ngOnInit() {
        this.sub = this.router.events.subscribe((event) => {
            if (event instanceof _angular_router__WEBPACK_IMPORTED_MODULE_2__["NavigationEnd"]) {
                if (event.url.includes("/search?")) {
                    this.footerEle = false;
                }
                else {
                    this.footerEle = true;
                }
            }
        });
    }
};
AppComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-root',
        template: __webpack_require__(/*! raw-loader!./app.component.html */ "./node_modules/raw-loader/index.js!./src/app/app.component.html"),
        styles: [__webpack_require__(/*! ./app.component.css */ "./src/app/app.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"]])
], AppComponent);



/***/ }),

/***/ "./src/app/app.module.ts":
/*!*******************************!*\
  !*** ./src/app/app.module.ts ***!
  \*******************************/
/*! exports provided: AppModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AppModule", function() { return AppModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/platform-browser */ "./node_modules/@angular/platform-browser/fesm2015/platform-browser.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm2015/forms.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");
/* harmony import */ var _angular_http__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/http */ "./node_modules/@angular/http/fesm2015/http.js");
/* harmony import */ var _app_routing_module__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./app-routing.module */ "./src/app/app-routing.module.ts");
/* harmony import */ var _app_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./app.component */ "./src/app/app.component.ts");
/* harmony import */ var _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./dashboard/dashboard.component */ "./src/app/dashboard/dashboard.component.ts");
/* harmony import */ var _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./hero-detail/hero-detail.component */ "./src/app/hero-detail/hero-detail.component.ts");
/* harmony import */ var _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./heroes/heroes.component */ "./src/app/heroes/heroes.component.ts");
/* harmony import */ var _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./hero-search/hero-search.component */ "./src/app/hero-search/hero-search.component.ts");
/* harmony import */ var _messages_messages_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./messages/messages.component */ "./src/app/messages/messages.component.ts");
/* harmony import */ var _footer_footer_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./footer/footer.component */ "./src/app/footer/footer.component.ts");
/* harmony import */ var _header_header_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./header/header.component */ "./src/app/header/header.component.ts");
/* harmony import */ var _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./about-us/about-us.component */ "./src/app/about-us/about-us.component.ts");
/* harmony import */ var _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./sign-up/sign-up.component */ "./src/app/sign-up/sign-up.component.ts");
/* harmony import */ var _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./wishlist/wishlist.component */ "./src/app/wishlist/wishlist.component.ts");
/* harmony import */ var _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! @ng-bootstrap/ng-bootstrap */ "./node_modules/@ng-bootstrap/ng-bootstrap/fesm2015/ng-bootstrap.js");
/* harmony import */ var _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./contact-us/contact-us.component */ "./src/app/contact-us/contact-us.component.ts");
/* harmony import */ var _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! ./terms-and-conditions/terms-and-conditions.component */ "./src/app/terms-and-conditions/terms-and-conditions.component.ts");
/* harmony import */ var _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ./privacy-policy/privacy-policy.component */ "./src/app/privacy-policy/privacy-policy.component.ts");
/* harmony import */ var _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ./licence-agreement/licence-agreement.component */ "./src/app/licence-agreement/licence-agreement.component.ts");
/* harmony import */ var _login_login_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ./login/login.component */ "./src/app/login/login.component.ts");
/* harmony import */ var _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ./checkout/checkout.component */ "./src/app/checkout/checkout.component.ts");

























let AppModule = class AppModule {
};
AppModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [
            _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__["BrowserModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormsModule"],
            _app_routing_module__WEBPACK_IMPORTED_MODULE_6__["AppRoutingModule"],
            _angular_common_http__WEBPACK_IMPORTED_MODULE_4__["HttpClientModule"],
            _angular_http__WEBPACK_IMPORTED_MODULE_5__["HttpModule"],
            _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_18__["NgbModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_3__["ReactiveFormsModule"],
        ],
        declarations: [
            _app_component__WEBPACK_IMPORTED_MODULE_7__["AppComponent"],
            _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_8__["DashboardComponent"],
            _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_10__["HeroesComponent"],
            _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_9__["HeroDetailComponent"],
            _messages_messages_component__WEBPACK_IMPORTED_MODULE_12__["MessagesComponent"],
            _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_11__["HeroSearchComponent"],
            _footer_footer_component__WEBPACK_IMPORTED_MODULE_13__["FooterComponent"],
            _header_header_component__WEBPACK_IMPORTED_MODULE_14__["HeaderComponent"],
            _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_15__["AboutUsComponent"],
            _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_16__["SignUpComponent"],
            _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_17__["WishlistComponent"],
            _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_19__["ContactUsComponent"],
            _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_20__["TermsAndConditionsComponent"],
            _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_21__["PrivacyPolicyComponent"],
            _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_22__["LicenceAgreementComponent"],
            _login_login_component__WEBPACK_IMPORTED_MODULE_23__["LoginComponent"],
            _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_24__["CheckoutComponent"]
        ],
        exports: [_login_login_component__WEBPACK_IMPORTED_MODULE_23__["LoginComponent"]],
        bootstrap: [_app_component__WEBPACK_IMPORTED_MODULE_7__["AppComponent"]]
    })
], AppModule);



/***/ }),

/***/ "./src/app/checkout/checkout.component.css":
/*!*************************************************!*\
  !*** ./src/app/checkout/checkout.component.css ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2NoZWNrb3V0L2NoZWNrb3V0LmNvbXBvbmVudC5jc3MifQ== */"

/***/ }),

/***/ "./src/app/checkout/checkout.component.ts":
/*!************************************************!*\
  !*** ./src/app/checkout/checkout.component.ts ***!
  \************************************************/
/*! exports provided: CheckoutComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "CheckoutComponent", function() { return CheckoutComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");




let CheckoutComponent = class CheckoutComponent {
    constructor(authenticationService, router) {
        this.authenticationService = authenticationService;
        this.router = router;
        this.wishListDataItems = [];
        this.priceArray = [];
    }
    ngOnInit() {
        this.authenticationService.getcartItemsData()
            .subscribe(data => {
            this.wishListDataItems = data;
            this.wishListDataItems.forEach(element => {
                console.log(element);
                this.priceArray.push(element["total"]);
            });
        }, error => {
        });
    }
    showTotalPrice() {
        console.log(this.priceArray);
        return this.priceArray.reduce(function (acc, val) { return acc + val; }, 0);
    }
    goToWishList() {
        this.router.navigate(['/wishlist']);
    }
};
CheckoutComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-checkout',
        template: __webpack_require__(/*! raw-loader!./checkout.component.html */ "./node_modules/raw-loader/index.js!./src/app/checkout/checkout.component.html"),
        styles: [__webpack_require__(/*! ./checkout.component.css */ "./src/app/checkout/checkout.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
], CheckoutComponent);



/***/ }),

/***/ "./src/app/contact-us/contact-us.component.css":
/*!*****************************************************!*\
  !*** ./src/app/contact-us/contact-us.component.css ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "body{ font-weight:normal;}\r\n#mainNav{background:#000;}\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvY29udGFjdC11cy9jb250YWN0LXVzLmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUEsTUFBTSxrQkFBa0IsQ0FBQztBQUN6QixTQUFTLGVBQWUsQ0FBQyIsImZpbGUiOiJzcmMvYXBwL2NvbnRhY3QtdXMvY29udGFjdC11cy5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiYm9keXsgZm9udC13ZWlnaHQ6bm9ybWFsO31cclxuI21haW5OYXZ7YmFja2dyb3VuZDojMDAwO30iXX0= */"

/***/ }),

/***/ "./src/app/contact-us/contact-us.component.ts":
/*!****************************************************!*\
  !*** ./src/app/contact-us/contact-us.component.ts ***!
  \****************************************************/
/*! exports provided: ContactUsComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ContactUsComponent", function() { return ContactUsComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm2015/forms.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm2015/operators/index.js");






let ContactUsComponent = class ContactUsComponent {
    constructor(formBuilder, authenticationService, router) {
        this.formBuilder = formBuilder;
        this.authenticationService = authenticationService;
        this.router = router;
        this.loading = false;
        this.submitted = false;
    }
    ngOnInit() {
        this.contactForm = this.formBuilder.group({
            user_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            user_email: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].email]],
            mobile_number: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(10), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(10)]],
            user_message: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            user_subject: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
        });
    }
    get f() { return this.contactForm.controls; }
    onContactSubmit() {
        this.submitted = true;
        // stop here if form is invalid
        if (this.contactForm.invalid) {
            // console.log('at invalid');   console.log(this.contactForm);
            return;
        }
        // console.log(this.contactForm.value);
        this.authenticationService.contactUs(this.contactForm.value)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_5__["first"])())
            .subscribe(data => {
            this.router.navigate(['/']);
        }, error => {
            this.loading = false;
        });
    }
};
ContactUsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-contact-us',
        template: __webpack_require__(/*! raw-loader!./contact-us.component.html */ "./node_modules/raw-loader/index.js!./src/app/contact-us/contact-us.component.html"),
        styles: [__webpack_require__(/*! ./contact-us.component.css */ "./src/app/contact-us/contact-us.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]])
], ContactUsComponent);



/***/ }),

/***/ "./src/app/dashboard/dashboard.component.css":
/*!***************************************************!*\
  !*** ./src/app/dashboard/dashboard.component.css ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2Rhc2hib2FyZC9kYXNoYm9hcmQuY29tcG9uZW50LmNzcyJ9 */"

/***/ }),

/***/ "./src/app/dashboard/dashboard.component.ts":
/*!**************************************************!*\
  !*** ./src/app/dashboard/dashboard.component.ts ***!
  \**************************************************/
/*! exports provided: DashboardComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "DashboardComponent", function() { return DashboardComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");





let DashboardComponent = class DashboardComponent {
    constructor(heroService, dataHelper, router) {
        this.heroService = heroService;
        this.dataHelper = dataHelper;
        this.router = router;
        this.heroes = [];
        this.carouselSliderImages = [];
        this.aoslSliderImages = [];
        this.aoslSliderImagesData = [];
        this.randomNumber = 0;
        this.searchBoxLabel = 1;
        this.page = 1;
        this.pageSize = 40;
        this.aosSliderSizes = [];
    }
    ngOnInit() {
        this.carouselSliderImages = this.heroService.getcarouselSliderImages();
        console.log(this.carouselSliderImages);
        // .subscribe(carouselSliderImages => {
        //   console.log(carouselSliderImages);
        //   this.carouselSliderImages = carouselSliderImages;
        // });
        this.heroService.getAosSliderImages()
            .subscribe(aoslSliderImages => {
            // console.log(aoslSliderImages);
            this.aoslSliderImages = aoslSliderImages;
            this.aoslSliderImagesData = aoslSliderImages;
            this.maintainAosSlider();
        });
    }
    getClassName(ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    }
    searchAosData(search) {
        // debounceTime(400),
        if (search.trim().length > 2) {
            this.router.navigate(['/search'], { queryParams: { type: this.searchBoxLabel, keyword: search.trim() } });
        }
    }
    maintainAosSlider() {
        let i = 4, j = 0;
        let randArr = [[6, 2, 3, 1], [5, 2, 3, 2], [4, 3, 2, 3], [3, 2, 3, 4], [3, 1, 6, 2], [4, 4, 2, 2], [5, 4, 2, 1], [6, 4, 1, 1], [4, 2, 4, 2], [3, 4, 3, 2]];
        let mathRandom = Math.floor(Math.random() * 10);
        this.aoslSliderImagesData.forEach(ele => {
            if (i > j) {
                // console.log(mathRandom)
                ele.eleClass = randArr[mathRandom][j];
                j = j + 1;
                if (j == i) {
                    this.dataHelper.shuffleArray(randArr);
                    j = 0;
                    mathRandom = Math.floor(Math.random() * 10);
                }
            }
        });
    }
    searchDropDownClick(type) {
        this.searchBoxLabel = type;
    }
};
DashboardComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-dashboard',
        template: __webpack_require__(/*! raw-loader!./dashboard.component.html */ "./node_modules/raw-loader/index.js!./src/app/dashboard/dashboard.component.html"),
        styles: [__webpack_require__(/*! ./dashboard.component.css */ "./src/app/dashboard/dashboard.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_3__["imageFooterHelper"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]])
], DashboardComponent);



/***/ }),

/***/ "./src/app/footer/footer.component.css":
/*!*********************************************!*\
  !*** ./src/app/footer/footer.component.css ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2Zvb3Rlci9mb290ZXIuY29tcG9uZW50LmNzcyJ9 */"

/***/ }),

/***/ "./src/app/footer/footer.component.ts":
/*!********************************************!*\
  !*** ./src/app/footer/footer.component.ts ***!
  \********************************************/
/*! exports provided: FooterComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "FooterComponent", function() { return FooterComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let FooterComponent = class FooterComponent {
    constructor() { }
    ngOnInit() {
    }
};
FooterComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-footer',
        template: __webpack_require__(/*! raw-loader!./footer.component.html */ "./node_modules/raw-loader/index.js!./src/app/footer/footer.component.html"),
        styles: [__webpack_require__(/*! ./footer.component.css */ "./src/app/footer/footer.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], FooterComponent);



/***/ }),

/***/ "./src/app/header/header.component.css":
/*!*********************************************!*\
  !*** ./src/app/header/header.component.css ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2hlYWRlci9oZWFkZXIuY29tcG9uZW50LmNzcyJ9 */"

/***/ }),

/***/ "./src/app/header/header.component.ts":
/*!********************************************!*\
  !*** ./src/app/header/header.component.ts ***!
  \********************************************/
/*! exports provided: HeaderComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "HeaderComponent", function() { return HeaderComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! aos */ "./node_modules/aos/dist/aos.js");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(aos__WEBPACK_IMPORTED_MODULE_4__);





let HeaderComponent = class HeaderComponent {
    constructor(router, authenticationService) {
        this.router = router;
        this.authenticationService = authenticationService;
        this.showloginPopup = false;
        this.authenticationService.currentUser.subscribe(x => {
            this.currentUser = x;
        });
    }
    ngOnInit() {
        aos__WEBPACK_IMPORTED_MODULE_4__["init"]();
    }
    clickLoginPopup() {
        this.showloginPopup = true;
    }
    hideLoginPopup(event) {
        this.showloginPopup = false;
        this.router.navigate(['/']);
    }
    logout() {
        this.authenticationService.logout();
        this.router.navigate(['/dashboard']);
    }
};
HeaderComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-header',
        template: __webpack_require__(/*! raw-loader!./header.component.html */ "./node_modules/raw-loader/index.js!./src/app/header/header.component.html"),
        styles: [__webpack_require__(/*! ./header.component.css */ "./src/app/header/header.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"]])
], HeaderComponent);



/***/ }),

/***/ "./src/app/hero-detail/hero-detail.component.css":
/*!*******************************************************!*\
  !*** ./src/app/hero-detail/hero-detail.component.css ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2hlcm8tZGV0YWlsL2hlcm8tZGV0YWlsLmNvbXBvbmVudC5jc3MifQ== */"

/***/ }),

/***/ "./src/app/hero-detail/hero-detail.component.ts":
/*!******************************************************!*\
  !*** ./src/app/hero-detail/hero-detail.component.ts ***!
  \******************************************************/
/*! exports provided: HeroDetailComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "HeroDetailComponent", function() { return HeroDetailComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/fesm2015/common.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");
/* harmony import */ var util__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! util */ "./node_modules/util/util.js");
/* harmony import */ var util__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(util__WEBPACK_IMPORTED_MODULE_6__);







let HeroDetailComponent = class HeroDetailComponent {
    constructor(route, heroService, location, dataHelper, authenticationService, router) {
        this.route = route;
        this.heroService = heroService;
        this.location = location;
        this.dataHelper = dataHelper;
        this.authenticationService = authenticationService;
        this.router = router;
        this.aoslSliderImagesData = [];
        this.page = 1;
        this.pageSize = 12;
        this.checkoutArray = [];
        this.showloginPopup = false;
        this.id = 0;
        this.addedCartItem = false;
        this.webtype = 0;
        this.type = '';
        this.total = 0;
        this.extended_price = 0;
        this.currunt_selected_price = 0;
        this.cart = [];
        this.token = '';
        this.checkoutAray = [];
        this.extended = [];
        this.standard = [];
        this.authenticationService.currentUser.subscribe(x => {
            this.currentUser = x;
        });
    }
    ngOnInit() {
        // this.getcategoryCarouselImages();
        this.getDetailinfo();
        this.authenticationService.currentUser.subscribe(x => {
            this.currentUser = x;
        });
        this.heroService.getMarketdeatils()
            .subscribe(data => {
            this.marketDetails = data;
        });
        this.heroService.getAosSliderImages()
            .subscribe(aoslSliderImages => {
            this.aoslSliderImagesData = aoslSliderImages;
            //let tempCarouselSlider= this.chunkArray(aoslSliderImages, 4);
            // this.aoslSliderImagesData = JSON.parse(JSON.stringify(aoslSliderImages));
            let randArr = [4, 3, 2, 3];
            let i = 4, j = 0;
            this.aoslSliderImagesData.forEach(ele => {
                if (i > j) {
                    ele.eleClass = randArr[j];
                    j = j + 1;
                    if (j == i) {
                        this.dataHelper.shuffleArray(randArr);
                        j = 0;
                    }
                }
            });
            // console.log(this.aoslSliderImagesData);
        });
    }
    getDetailinfo() {
        this.id = +this.route.snapshot.paramMap.get('id');
        this.webtype = +this.route.snapshot.paramMap.get('webtype');
        this.type = this.route.snapshot.paramMap.get('type');
        this.heroService.getDetailPagedetails(this.id, this.webtype, this.type)
            .subscribe(data => {
            console.log(data);
            this.detailPageInfo = data;
        });
    }
    getcategoryCarouselImages() {
        const id = +this.route.snapshot.paramMap.get('id');
        this.heroService.getcategoryCarouselImages(1)
            .subscribe(images => {
            if (!Object(util__WEBPACK_IMPORTED_MODULE_6__["isNullOrUndefined"])(images)) {
                this.carouselSliderImages = images[0];
                let randArr = [4, 3, 2, 3];
                let tempCarouselSlider = this.chunkArray(this.carouselSliderImages.categoryImages, 4);
                this.carouselSliderImages.categoryImages = JSON.parse(JSON.stringify(tempCarouselSlider));
                for (let i = 0; i < this.carouselSliderImages.categoryImages.length; i++) {
                    if (this.carouselSliderImages.categoryImages[i].length < 4) {
                        let lessItem = 4 - this.carouselSliderImages.categoryImages[i].length;
                        let newArray = tempCarouselSlider[0].splice(0, lessItem);
                        this.carouselSliderImages.categoryImages[i] = this.carouselSliderImages.categoryImages[i].concat(newArray);
                    }
                }
                this.carouselSliderImages.categoryImages.forEach(element => {
                    let temp = 0;
                    this.dataHelper.shuffleArray(randArr);
                    element.forEach(ele => {
                        ele.eleClass = randArr[temp];
                        temp = temp + 1;
                    });
                });
            }
        });
    }
    getClassName(ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    }
    addToCheckoutItem(productinfo, cartproduct, total, extended, type) {
        if (!this.currentUser) {
            this.showloginPopup = true;
        }
        else {
            this.addedCartItem = !this.addedCartItem;
            this.token = localStorage.getItem('currentUser');
            let cartval = {
                "product_info": productinfo,
                "selected_product": cartproduct,
                "total": total,
                "extended": extended,
                "token": this.token,
                "type": type
            };
            this.heroService.addcartItemsData(cartval)
                .subscribe(data => {
                console.log(data);
                this.checkoutArray.push(cartval);
                if (data["status"] == '1') {
                    localStorage.setItem('checkoutAray', this.checkoutArray);
                    this.router.navigate(['/wishlist']);
                }
                else {
                    alert(data["message"]);
                }
            });
            // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated
        }
    }
    checkPriceTotal(selectedPrice) {
        console.log(selectedPrice);
        this.currunt_selected_price = selectedPrice.price * 80;
        this.total = this.currunt_selected_price;
        this.standard = selectedPrice;
    }
    addExtendedPriceTotal(selectedPrice) {
        this.extended_price = selectedPrice.price * 80;
        this.total = this.total + this.extended_price;
        this.extended = selectedPrice;
    }
    /* showCartLabel(){
       let addCart = this.checkoutArray.find(ele=>ele == this.id);
       if(isNullOrUndefined(addCart))
             this.addedCartItem=false;
       else
         this.addedCartItem=true;
     }*/
    chunkArray(myArray, chunk_size) {
        let results = [];
        while (myArray.length) {
            results.push(myArray.splice(0, chunk_size));
        }
        return results;
    }
    hideLoginPopup(event) {
        this.showloginPopup = false;
        if (event) {
            this.addToCheckoutItem(this.detailPageInfo, this.standard, this.total, this.extended, '2');
        }
    }
};
HeroDetailComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-hero-detail',
        template: __webpack_require__(/*! raw-loader!./hero-detail.component.html */ "./node_modules/raw-loader/index.js!./src/app/hero-detail/hero-detail.component.html"),
        styles: [__webpack_require__(/*! ./hero-detail.component.css */ "./src/app/hero-detail/hero-detail.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"],
        _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"],
        _angular_common__WEBPACK_IMPORTED_MODULE_3__["Location"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"], _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]])
], HeroDetailComponent);



/***/ }),

/***/ "./src/app/hero-search/hero-search.component.css":
/*!*******************************************************!*\
  !*** ./src/app/hero-search/hero-search.component.css ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/* HeroSearch private styles */\n.search-result li {\n  border-bottom: 1px solid gray;\n  border-left: 1px solid gray;\n  border-right: 1px solid gray;\n  width: 195px;\n  height: 16px;\n  padding: 5px;\n  background-color: white;\n  cursor: pointer;\n  list-style-type: none;\n}\n.search-result li:hover {\n  background-color: #607D8B;\n}\n.search-result li a {\n  color: #888;\n  display: block;\n  text-decoration: none;\n}\n.search-result li a:hover {\n  color: white;\n}\n.search-result li a:active {\n  color: white;\n}\n#search-box {\n  width: 200px;\n  height: 20px;\n}\nul.search-result {\n  margin-top: 0;\n  padding-left: 0;\n}\n\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaGVyby1zZWFyY2gvaGVyby1zZWFyY2guY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSw4QkFBOEI7QUFDOUI7RUFDRSw2QkFBNkI7RUFDN0IsMkJBQTJCO0VBQzNCLDRCQUE0QjtFQUM1QixZQUFZO0VBQ1osWUFBWTtFQUNaLFlBQVk7RUFDWix1QkFBdUI7RUFDdkIsZUFBZTtFQUNmLHFCQUFxQjtBQUN2QjtBQUVBO0VBQ0UseUJBQXlCO0FBQzNCO0FBRUE7RUFDRSxXQUFXO0VBQ1gsY0FBYztFQUNkLHFCQUFxQjtBQUN2QjtBQUVBO0VBQ0UsWUFBWTtBQUNkO0FBQ0E7RUFDRSxZQUFZO0FBQ2Q7QUFDQTtFQUNFLFlBQVk7RUFDWixZQUFZO0FBQ2Q7QUFHQTtFQUNFLGFBQWE7RUFDYixlQUFlO0FBQ2pCIiwiZmlsZSI6InNyYy9hcHAvaGVyby1zZWFyY2gvaGVyby1zZWFyY2guY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbIi8qIEhlcm9TZWFyY2ggcHJpdmF0ZSBzdHlsZXMgKi9cbi5zZWFyY2gtcmVzdWx0IGxpIHtcbiAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkIGdyYXk7XG4gIGJvcmRlci1sZWZ0OiAxcHggc29saWQgZ3JheTtcbiAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgZ3JheTtcbiAgd2lkdGg6IDE5NXB4O1xuICBoZWlnaHQ6IDE2cHg7XG4gIHBhZGRpbmc6IDVweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogd2hpdGU7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgbGlzdC1zdHlsZS10eXBlOiBub25lO1xufVxuXG4uc2VhcmNoLXJlc3VsdCBsaTpob3ZlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICM2MDdEOEI7XG59XG5cbi5zZWFyY2gtcmVzdWx0IGxpIGEge1xuICBjb2xvcjogIzg4ODtcbiAgZGlzcGxheTogYmxvY2s7XG4gIHRleHQtZGVjb3JhdGlvbjogbm9uZTtcbn1cblxuLnNlYXJjaC1yZXN1bHQgbGkgYTpob3ZlciB7XG4gIGNvbG9yOiB3aGl0ZTtcbn1cbi5zZWFyY2gtcmVzdWx0IGxpIGE6YWN0aXZlIHtcbiAgY29sb3I6IHdoaXRlO1xufVxuI3NlYXJjaC1ib3gge1xuICB3aWR0aDogMjAwcHg7XG4gIGhlaWdodDogMjBweDtcbn1cblxuXG51bC5zZWFyY2gtcmVzdWx0IHtcbiAgbWFyZ2luLXRvcDogMDtcbiAgcGFkZGluZy1sZWZ0OiAwO1xufVxuIl19 */"

/***/ }),

/***/ "./src/app/hero-search/hero-search.component.ts":
/*!******************************************************!*\
  !*** ./src/app/hero-search/hero-search.component.ts ***!
  \******************************************************/
/*! exports provided: HeroSearchComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "HeroSearchComponent", function() { return HeroSearchComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! rxjs */ "./node_modules/rxjs/_esm2015/index.js");
/* harmony import */ var _hero__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../hero */ "./src/app/hero.ts");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");







let HeroSearchComponent = class HeroSearchComponent {
    constructor(heroService, route, dataHelper) {
        this.heroService = heroService;
        this.route = route;
        this.dataHelper = dataHelper;
        this.searchTerms = new rxjs__WEBPACK_IMPORTED_MODULE_2__["Subject"]();
        this.randomNumber = 0;
        this.searchBoxLabel = 'all';
        this.page = 1;
        this.pageSize = 40;
        this.sidebarSubmenu1 = false;
        this.slidebarPeopleMenu = [];
        this.sidebarSubmenu2 = false;
        this.slidebarLocationMenu = [];
        this.sidebarSubmenu3 = false;
        this.slidebarGenderMenu = [];
        this.sidebarSubmenu4 = false;
        this.slidebarEthnicityMenu = [];
        this.sidebarSubmenu5 = false;
        this.slidebarColorMenu = [];
        this.sidebarSubmenu6 = false;
        this.slidebarOrientationsMenu = [];
        this.sidebarSubmenu7 = false;
        this.slidebarImageTypeMenu = [];
        this.sidebarSubmenu8 = false;
        this.slidebarImageSizeMenu = [];
        this.sidebarSubmenu9 = false;
        this.sliderSortTypeMenu = [];
        this.name = '';
        this.carouselSliderImages = [];
        this.aoslSliderImages = [];
        this.aoslSliderImagesData = [];
        this.searchData = new _hero__WEBPACK_IMPORTED_MODULE_3__["Search"]();
    }
    // Push a search term into the observable stream.
    search(term) {
        this.searchTerms.next(term);
    }
    ngOnInit() {
        this.sub = this.route
            .queryParams
            .subscribe(params => {
            console.log(params);
            this.searchData.productType = params.type;
            this.searchData.search = params.keyword;
            this.searchData.letest = 1;
            this.searchData.curated = 0;
            this.searchData.populer = 0;
            this.searchAPIRequest();
        });
        this.heroService.getSearchLeftFilter()
            .subscribe(leftsideData => {
            // this.carouselSliderImages = carouselSliderImages; 
            console.log(leftsideData);
            this.leftsideData = leftsideData;
        });
    }
    searchDropDownClick(type) {
        this.searchData.productType = type;
    }
    searchAPIRequest() {
        this.searchData.product_people = this.slidebarPeopleMenu.join();
        this.searchData.product_gender = this.slidebarGenderMenu.join();
        this.searchData.product_ethinicities = this.slidebarEthnicityMenu.join();
        this.searchData.product_locations = this.slidebarLocationMenu.join();
        this.searchData.product_colors = this.slidebarColorMenu.join();
        this.searchData.product_imagesizes = this.slidebarImageSizeMenu.join();
        this.searchData.product_imagetypes = this.slidebarImageTypeMenu.join();
        this.searchData.product_orientation = this.slidebarOrientationsMenu.join();
        this.searchData.product_sortType = this.sliderSortTypeMenu.join();
        this.heroService.getAosSliderSearchImages(this.searchData)
            .subscribe(aoslSliderImages => {
            this.aoslSliderImages = aoslSliderImages;
            this.maintainAosSlider();
            // this.maintainSearchData(aoslSliderImages);                             
        });
    }
    getSideBarClassName(type, id) {
        if (type == 'people') {
            let indexPeople = this.slidebarPeopleMenu.indexOf(id);
            if (indexPeople > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'gender') {
            let indexGender = this.slidebarGenderMenu.indexOf(id);
            if (indexGender > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'ethinicity') {
            let indexEthnicity = this.slidebarEthnicityMenu.indexOf(id);
            if (indexEthnicity > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'locations') {
            let indexLocation = this.slidebarLocationMenu.indexOf(id);
            if (indexLocation > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'colors') {
            let indexColor = this.slidebarColorMenu.indexOf(id);
            if (indexColor > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'imagesizes') {
            let indexImagesize = this.slidebarImageSizeMenu.indexOf(id);
            if (indexImagesize > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'imageTypes') {
            let indexImageType = this.slidebarImageTypeMenu.indexOf(id);
            if (indexImageType > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'orientation') {
            let indexOrientation = this.slidebarOrientationsMenu.indexOf(id);
            if (indexOrientation > -1) {
                return true;
            }
            else {
                return false;
            }
        }
        else if (type == 'sorttype') {
            let indexSorttype = this.sliderSortTypeMenu.indexOf(id);
            if (indexSorttype > -1) {
                return true;
            }
            else {
                return false;
            }
        }
    }
    onSideMenuClick(type, id) {
        if (type == 'people') {
            let indexPeople = this.slidebarPeopleMenu.indexOf(id);
            if (indexPeople > -1) {
                //  this.slidebarPeopleMenu.splice(indexPeople, 1);
            }
            else {
                this.slidebarPeopleMenu.push(id);
            }
            this.searchData.product_people = this.slidebarPeopleMenu.join();
        }
        else if (type == 'gender') {
            let indexGender = this.slidebarGenderMenu.indexOf(id);
            if (indexGender > -1) {
                this.slidebarGenderMenu.splice(indexGender, 1);
            }
            else {
                this.slidebarGenderMenu.push(id);
            }
            // this.searchData.product_gender = this.slidebarGenderMenu.join();          
        }
        else if (type == 'ethinicity') {
            let indexEthnicity = this.slidebarEthnicityMenu.indexOf(id);
            if (indexEthnicity > -1) {
                this.slidebarEthnicityMenu.splice(indexEthnicity, 1);
            }
            else {
                this.slidebarEthnicityMenu.push(id);
            }
            // this.searchData.product_ethinicities = this.slidebarEthnicityMenu.join();          
        }
        else if (type == 'locations') {
            let indexLocation = this.slidebarLocationMenu.indexOf(id);
            if (indexLocation > -1) {
                this.slidebarLocationMenu.splice(indexLocation, 1);
            }
            else {
                this.slidebarLocationMenu.push(id);
            }
            // this.searchData.product_locations = this.slidebarLocationMenu.join();
        }
        else if (type == 'colors') {
            let indexColor = this.slidebarColorMenu.indexOf(id);
            if (indexColor > -1) {
                this.slidebarColorMenu.splice(indexColor, 1);
            }
            else {
                this.slidebarColorMenu.push(id);
            }
            // this.searchData.product_colors = this.slidebarColorMenu.join();
        }
        else if (type == 'imagesizes') {
            let indexImagesize = this.slidebarImageSizeMenu.indexOf(id);
            if (indexImagesize > -1) {
                this.slidebarImageSizeMenu.splice(indexImagesize, 1);
            }
            else {
                this.slidebarImageSizeMenu.push(id);
            }
            //  this.searchData.product_imagesizes = this.slidebarImageSizeMenu.join();
        }
        else if (type == 'imageTypes') {
            let indexImageType = this.slidebarImageTypeMenu.indexOf(id);
            if (indexImageType > -1) {
                this.slidebarImageTypeMenu.splice(indexImageType, 1);
            }
            else {
                this.slidebarImageTypeMenu.push(id);
            }
            // this.searchData.product_imagetypes = this.slidebarImageTypeMenu.join();
        }
        else if (type == 'orientation') {
            let indexOrientation = this.slidebarOrientationsMenu.indexOf(id);
            if (indexOrientation > -1) {
                this.slidebarOrientationsMenu.splice(indexOrientation, 1);
            }
            else {
                this.slidebarOrientationsMenu.push(id);
            }
            // this.searchData.product_orientation = this.slidebarOrientationsMenu.join();
        }
        else if (type == 'sorttype') {
            let indexSorttype = this.sliderSortTypeMenu.indexOf(id);
            if (indexSorttype > -1) {
                this.sliderSortTypeMenu.splice(indexSorttype, 1);
            }
            else {
                this.sliderSortTypeMenu.push(id);
            }
            // this.searchData.product_sortType = this.sliderSortTypeMenu.join();
        }
        this.searchAPIRequest();
    }
    onTabClick(number) {
        if (number == 2) {
            this.searchData.letest = 0;
            this.searchData.curated = 1;
            this.searchData.populer = 0;
        }
        else if (number == 3) {
            this.searchData.letest = 0;
            this.searchData.curated = 0;
            this.searchData.populer = 1;
        }
        else {
            this.searchData.letest = 1;
            this.searchData.curated = 0;
            this.searchData.populer = 0;
        }
        this.searchAPIRequest();
    }
    getClassName(ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    }
    onKeydown(event) {
        if (event.key === "Enter") {
            this.searchData.letest = 1;
            this.searchData.curated = 0;
            this.searchData.populer = 0;
            this.searchAPIRequest();
        }
    }
    maintainSearchData(aoslSliderImages) {
        this.aoslSliderImagesData = aoslSliderImages;
        if (this.searchData.productType == 1) {
            this.aoslSliderImagesData = this.aoslSliderImages.filter(ele => ele.product_main_type == "Image");
        }
        else if (this.searchData.productType == 2) {
            this.aoslSliderImagesData = this.aoslSliderImages.filter(ele => ele.product_main_type != "Image");
        }
        else {
            this.aoslSliderImagesData = this.aoslSliderImages;
        }
        if (this.searchData.search.length > 2) {
            this.aoslSliderImagesData = this.aoslSliderImagesData.filter(ele => ele.product_title.includes(this.name.trim()));
        }
        this.maintainAosSlider();
    }
    maintainAosSlider() {
        let i = 4, j = 0;
        let randArr = [[6, 2, 3, 1], [5, 2, 3, 2], [4, 3, 2, 3], [3, 2, 3, 4], [3, 1, 6, 2], [4, 4, 2, 2], [5, 4, 2, 1], [6, 4, 1, 1], [4, 2, 4, 2], [3, 4, 3, 2]];
        let mathRandom = Math.floor(Math.random() * 10);
        this.aoslSliderImages.forEach(ele => {
            if (i > j) {
                // console.log(mathRandom)
                ele.eleClass = randArr[mathRandom][j];
                j = j + 1;
                if (j == i) {
                    this.dataHelper.shuffleArray(randArr);
                    j = 0;
                    mathRandom = Math.floor(Math.random() * 10);
                }
            }
        });
    }
};
HeroSearchComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-hero-search',
        template: __webpack_require__(/*! raw-loader!./hero-search.component.html */ "./node_modules/raw-loader/index.js!./src/app/hero-search/hero-search.component.html"),
        styles: [__webpack_require__(/*! ./hero-search.component.css */ "./src/app/hero-search/hero-search.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_5__["ActivatedRoute"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_6__["imageFooterHelper"]])
], HeroSearchComponent);



/***/ }),

/***/ "./src/app/hero.service.ts":
/*!*********************************!*\
  !*** ./src/app/hero.service.ts ***!
  \*********************************/
/*! exports provided: HeroService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "HeroService", function() { return HeroService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs */ "./node_modules/rxjs/_esm2015/index.js");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm2015/operators/index.js");
/* harmony import */ var _hero__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./hero */ "./src/app/hero.ts");
/* harmony import */ var _message_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./message.service */ "./src/app/message.service.ts");







let HeroService = class HeroService {
    constructor(http, messageService) {
        this.http = http;
        this.messageService = messageService;
        this.heroesUrl = 'http://ec2-18-218-154-217.us-east-2.compute.amazonaws.com/backend/api/'; // URL to web api
        this.localhostUrl = 'http://localhost/backend/api/';
        this.carouselImagesUrl = 'api/carouselImages';
        this.aosImagesUrl = 'api/aosImages';
        this.countryUrl = "https://raw.githubusercontent.com/sagarshirbhate/Country-State-City-Database/master/Contries.json";
        this.httpOptions = {
            headers: new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({ 'Content-Type': 'application/json' })
        };
        this.currentUserSubject = new rxjs__WEBPACK_IMPORTED_MODULE_3__["BehaviorSubject"](JSON.parse(localStorage.getItem('currentUser')));
        this.currentUser = this.currentUserSubject.asObservable();
    }
    get currentUserValue() {
        return this.currentUserSubject.value;
    }
    allCountries() {
        const url = `${this.heroesUrl}getCountyStatesCityList`;
        //return this.http.get(this.countryUrl);
        return this.http.get(url);
    }
    allstates(country) {
        const url = `${this.heroesUrl}getCountyStatesList/` + country;
        //return this.http.get(this.countryUrl);
        return this.http.get(url);
    }
    allCities(state) {
        const url = `${this.heroesUrl}getStateCityList/` + state;
        //return this.http.get(this.countryUrl);
        return this.http.get(url);
    }
    /** GET Slider Images from the server */
    getcarouselSliderImages() {
        //  const url = `${this.heroesUrl}home`;
        /*return this.http.get<any[]>(this.carouselImagesUrl)
          .pipe(
            tap(_ => this.log('fetched carousel Images')),
            catchError(this.handleError<any[]>('getCarouselImages', []))
          );*/
        let _carouselSlider = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();
        let _carouselSliderArray = new Array();
        _carouselSlider.id = 1;
        _carouselSlider.categoryNames = [{ id: 1, name: 'Skin Care' }, { id: 2, name: 'Cannabis' }, { id: 3, name: 'Business' }, { id: 4, name: 'Curated' }, { id: 5, name: 'Video' }, { id: 5, name: 'Autumn' }, { id: 6, name: 'Dynama' }];
        _carouselSliderArray.push(_carouselSlider);
        let _carouselSlider1 = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();
        _carouselSlider1.id = 2;
        _carouselSlider1.categoryNames = [{ id: 11, name: 'Dr Nice' }, { id: 12, name: 'Narco' }, { id: 13, name: 'Bombasto' }, { id: 14, name: 'Celeritas' }, { id: 15, name: 'Magneta' }, { id: 16, name: 'RubberMan' }];
        _carouselSliderArray.push(_carouselSlider1);
        let _carouselSlider2 = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();
        _carouselSlider2.id = 3;
        _carouselSlider2.categoryNames = [{ id: 21, name: 'Family' }, { id: 22, name: 'Halloween' }, { id: 23, name: 'Seniors' }, { id: 24, name: 'Cats & Dogs' }, { id: 25, name: 'Time to Party' }, { id: 26, name: 'Food' }];
        _carouselSliderArray.push(_carouselSlider2);
        let _carouselSlider3 = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();
        _carouselSlider3.id = 4;
        _carouselSlider3.categoryNames = [{ id: 31, name: 'The Digital Frontier' }, { id: 32, name: 'Christmas' }, { id: 33, name: 'Real People & Places' }, { id: 34, name: 'Art & Concept' }, { id: 35, name: 'Magma' }, { id: 36, name: 'Tornado' }];
        _carouselSliderArray.push(_carouselSlider3);
        return _carouselSliderArray;
    }
    /** GET Slider Images from the server */
    /** GET Slider Images from the server */
    getAosSliderImages() {
        const url = `${this.heroesUrl}home`;
        return this.http.get(url)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(aosImagesUrl => {
            return aosImagesUrl.api;
            // return aosImagesUrl;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getCarouselImages', [])));
    }
    getAosSliderSearchImages(searchData) {
        let url = `${this.heroesUrl}search`;
        /* if(searchData.productType == 2){
           url = `${this.localhostUrl}search`;
         }*/
        return this.http.post(url, searchData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(searchResultSet => {
            return searchResultSet.imgfootage;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to get data`)));
    }
    getSearchLeftFilter() {
        const url = `${this.heroesUrl}get_side_filtes`;
        return this.http.get(url)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(searchSideMenu => {
            return searchSideMenu.data;
            // return aosImagesUrl;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('searchSideMenu', [])));
    }
    getLogin(email, password) {
        const url = `${this.heroesUrl}login`;
        return this.http.post(url, { email, password }, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(user => {
            console.log(user);
            localStorage.setItem('currentUser', JSON.stringify(user));
            this.currentUserSubject.next(user);
            return user;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to get data`)));
    }
    register(usrData) {
        const url = `${this.heroesUrl}signup`;
        return this.http.post(url, usrData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(userInfo => {
            return true;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to register data`)));
        ;
    }
    contactUs(contactData) {
        const url = `${this.heroesUrl}user_contactus`;
        return this.http.post(url, contactData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(userInfo => {
            return true;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to user_contactus data`)));
        ;
    }
    logout() {
        localStorage.removeItem('currentUser');
        this.currentUserSubject.next(null);
    }
    getcategoryCarouselImages(categoryId) {
        const url = `api/detailPageCarouselImages/?${categoryId}`;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`fetched CarouselImages id=${categoryId}`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`getHero id=${categoryId}`)));
    }
    getDetailPagedetails(id, webtype, type) {
        console.log(id);
        //const url = `api/detailPageInfo/?${id}`;
        const url = `${this.heroesUrl}details/${id}/${webtype}/${type}`;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`fetched detail Page Info id=${id}`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`getHero id=${id}`)));
    }
    addcartItemsData(product) {
        const url = `${this.heroesUrl}add_to_cart`;
        let tokenData = JSON.parse(product.token);
        let headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.token
        });
        let options = { headers: headers };
        return this.http.post(url, { product }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(cart => {
            console.log(cart);
            //this.currentUserSubject.next(cart);
            return cart;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to get data`)));
    }
    removeCartItemsData(product) {
        console.log(product);
        const url = `${this.heroesUrl}delete_cart_item`;
        //let tokenData =JSON.parse(product.token);
        let headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json'
        });
        let options = { headers: headers };
        return this.http.post(url, { product }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(cart => {
            console.log(cart);
            return cart;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to get data`)));
    }
    getcartItemsData() {
        //let params = new HttpParams();
        const url = `${this.heroesUrl}user_cart_list`;
        let tokenData = JSON.parse(localStorage.getItem('currentUser'));
        let headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.access_token
        });
        let options = { headers: headers };
        return this.http.post(url, tokenData, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(cart => {
            console.log(cart);
            //this.currentUserSubject.next(cart);
            return cart;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to get data`)));
    }
    getMarketdeatils() {
        const url = `api/marketFreeze`;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`fetched market Info id`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`getHero id`)));
    }
    /** GET heroes from the server */
    getHeroes() {
        return this.http.get(this.heroesUrl)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log('fetched heroes')), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getHeroes', [])));
    }
    /** GET hero by id. Return `undefined` when id not found */
    getHeroNo404(id) {
        const url = `${this.heroesUrl}/?id=${id}`;
        return this.http.get(url)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(heroes => heroes[0]), // returns a {0|1} element array
        Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(h => {
            const outcome = h ? `fetched` : `did not find`;
            this.log(`${outcome} hero id=${id}`);
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`getHero id=${id}`)));
    }
    /** GET hero by id. Will 404 if id not found */
    getHero(id) {
        const url = `${this.heroesUrl}/${id}`;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`fetched hero id=${id}`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`getHero id=${id}`)));
    }
    /* GET heroes whose name contains search term */
    searchHeroes(term) {
        if (!term.trim()) {
            // if not search term, return empty hero array.
            return Object(rxjs__WEBPACK_IMPORTED_MODULE_3__["of"])([]);
        }
        return this.http.get(`${this.heroesUrl}/?name=${term}`).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`found heroes matching "${term}"`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('searchHeroes', [])));
    }
    //////// Save methods //////////
    /** POST: add a new hero to the server */
    addHero(hero) {
        return this.http.post(this.heroesUrl, hero, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])((newHero) => this.log(`added hero w/ id=${newHero.id}`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('addHero')));
    }
    /** DELETE: delete the hero from the server */
    deleteHero(hero) {
        const id = typeof hero === 'number' ? hero : hero.id;
        const url = `${this.heroesUrl}/${id}`;
        return this.http.delete(url, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`deleted hero id=${id}`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('deleteHero')));
    }
    /** PUT: update the hero on the server */
    updateHero(hero) {
        return this.http.put(this.heroesUrl, hero, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`updated hero id=${hero.id}`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('updateHero')));
    }
    /**
     * Handle Http operation that failed.
     * Let the app continue.
     * @param operation - name of the operation that failed
     * @param result - optional value to return as the observable result
     */
    handleError(operation = 'operation', result) {
        return (error) => {
            // TODO: send the error to remote logging infrastructure
            console.error(error); // log to console instead
            // TODO: better job of transforming error for user consumption
            this.log(`${operation} failed: ${error.message}`);
            // Let the app keep running by returning an empty result.
            return Object(rxjs__WEBPACK_IMPORTED_MODULE_3__["of"])(result);
        };
    }
    /** Log a HeroService message with the MessageService */
    log(message) {
        this.messageService.add(`HeroService: ${message}`);
    }
};
HeroService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({ providedIn: 'root' }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"],
        _message_service__WEBPACK_IMPORTED_MODULE_6__["MessageService"]])
], HeroService);



/***/ }),

/***/ "./src/app/hero.ts":
/*!*************************!*\
  !*** ./src/app/hero.ts ***!
  \*************************/
/*! exports provided: Hero, carouselSlider, Category, Search, aosSlider, userData, carouselSliderImages, detailPageInfo, market, cartItemData */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Hero", function() { return Hero; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "carouselSlider", function() { return carouselSlider; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Category", function() { return Category; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Search", function() { return Search; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "aosSlider", function() { return aosSlider; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "userData", function() { return userData; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "carouselSliderImages", function() { return carouselSliderImages; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "detailPageInfo", function() { return detailPageInfo; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "market", function() { return market; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "cartItemData", function() { return cartItemData; });
class Hero {
}
class carouselSlider {
}
class Category {
}
class Search {
}
class aosSlider {
}
class userData {
}
class carouselSliderImages {
}
class detailPageInfo {
}
class market {
}
class cartItemData {
}


/***/ }),

/***/ "./src/app/heroes/heroes.component.css":
/*!*********************************************!*\
  !*** ./src/app/heroes/heroes.component.css ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/* HeroesComponent's private CSS styles */\n.heroes {\n  margin: 0 0 2em 0;\n  list-style-type: none;\n  padding: 0;\n  width: 15em;\n}\n.heroes li {\n  position: relative;\n  cursor: pointer;\n  background-color: #EEE;\n  margin: .5em;\n  padding: .3em 0;\n  height: 1.6em;\n  border-radius: 4px;\n}\n.heroes li:hover {\n  color: #607D8B;\n  background-color: #DDD;\n  left: .1em;\n}\n.heroes a {\n  color: #333;\n  text-decoration: none;\n  position: relative;\n  display: block;\n  width: 250px;\n}\n.heroes a:hover {\n  color:#607D8B;\n}\n.heroes .badge {\n  display: inline-block;\n  font-size: small;\n  color: white;\n  padding: 0.8em 0.7em 0 0.7em;\n  background-color:#405061;\n  line-height: 1em;\n  position: relative;\n  left: -1px;\n  top: -4px;\n  height: 1.8em;\n  min-width: 16px;\n  text-align: right;\n  margin-right: .8em;\n  border-radius: 4px 0 0 4px;\n}\nbutton {\n  background-color: #eee;\n  border: none;\n  padding: 5px 10px;\n  border-radius: 4px;\n  cursor: pointer;\n  cursor: hand;\n  font-family: Arial;\n}\nbutton:hover {\n  background-color: #cfd8dc;\n}\nbutton.delete {\n  position: relative;\n  left: 194px;\n  top: -32px;\n  background-color: gray !important;\n  color: white;\n}\n\n\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaGVyb2VzL2hlcm9lcy5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLHlDQUF5QztBQUN6QztFQUNFLGlCQUFpQjtFQUNqQixxQkFBcUI7RUFDckIsVUFBVTtFQUNWLFdBQVc7QUFDYjtBQUNBO0VBQ0Usa0JBQWtCO0VBQ2xCLGVBQWU7RUFDZixzQkFBc0I7RUFDdEIsWUFBWTtFQUNaLGVBQWU7RUFDZixhQUFhO0VBQ2Isa0JBQWtCO0FBQ3BCO0FBRUE7RUFDRSxjQUFjO0VBQ2Qsc0JBQXNCO0VBQ3RCLFVBQVU7QUFDWjtBQUVBO0VBQ0UsV0FBVztFQUNYLHFCQUFxQjtFQUNyQixrQkFBa0I7RUFDbEIsY0FBYztFQUNkLFlBQVk7QUFDZDtBQUVBO0VBQ0UsYUFBYTtBQUNmO0FBRUE7RUFDRSxxQkFBcUI7RUFDckIsZ0JBQWdCO0VBQ2hCLFlBQVk7RUFDWiw0QkFBNEI7RUFDNUIsd0JBQXdCO0VBQ3hCLGdCQUFnQjtFQUNoQixrQkFBa0I7RUFDbEIsVUFBVTtFQUNWLFNBQVM7RUFDVCxhQUFhO0VBQ2IsZUFBZTtFQUNmLGlCQUFpQjtFQUNqQixrQkFBa0I7RUFDbEIsMEJBQTBCO0FBQzVCO0FBRUE7RUFDRSxzQkFBc0I7RUFDdEIsWUFBWTtFQUNaLGlCQUFpQjtFQUNqQixrQkFBa0I7RUFDbEIsZUFBZTtFQUNmLFlBQVk7RUFDWixrQkFBa0I7QUFDcEI7QUFFQTtFQUNFLHlCQUF5QjtBQUMzQjtBQUVBO0VBQ0Usa0JBQWtCO0VBQ2xCLFdBQVc7RUFDWCxVQUFVO0VBQ1YsaUNBQWlDO0VBQ2pDLFlBQVk7QUFDZCIsImZpbGUiOiJzcmMvYXBwL2hlcm9lcy9oZXJvZXMuY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbIi8qIEhlcm9lc0NvbXBvbmVudCdzIHByaXZhdGUgQ1NTIHN0eWxlcyAqL1xuLmhlcm9lcyB7XG4gIG1hcmdpbjogMCAwIDJlbSAwO1xuICBsaXN0LXN0eWxlLXR5cGU6IG5vbmU7XG4gIHBhZGRpbmc6IDA7XG4gIHdpZHRoOiAxNWVtO1xufVxuLmhlcm9lcyBsaSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUVFO1xuICBtYXJnaW46IC41ZW07XG4gIHBhZGRpbmc6IC4zZW0gMDtcbiAgaGVpZ2h0OiAxLjZlbTtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xufVxuXG4uaGVyb2VzIGxpOmhvdmVyIHtcbiAgY29sb3I6ICM2MDdEOEI7XG4gIGJhY2tncm91bmQtY29sb3I6ICNEREQ7XG4gIGxlZnQ6IC4xZW07XG59XG5cbi5oZXJvZXMgYSB7XG4gIGNvbG9yOiAjMzMzO1xuICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgZGlzcGxheTogYmxvY2s7XG4gIHdpZHRoOiAyNTBweDtcbn1cblxuLmhlcm9lcyBhOmhvdmVyIHtcbiAgY29sb3I6IzYwN0Q4Qjtcbn1cblxuLmhlcm9lcyAuYmFkZ2Uge1xuICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG4gIGZvbnQtc2l6ZTogc21hbGw7XG4gIGNvbG9yOiB3aGl0ZTtcbiAgcGFkZGluZzogMC44ZW0gMC43ZW0gMCAwLjdlbTtcbiAgYmFja2dyb3VuZC1jb2xvcjojNDA1MDYxO1xuICBsaW5lLWhlaWdodDogMWVtO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGxlZnQ6IC0xcHg7XG4gIHRvcDogLTRweDtcbiAgaGVpZ2h0OiAxLjhlbTtcbiAgbWluLXdpZHRoOiAxNnB4O1xuICB0ZXh0LWFsaWduOiByaWdodDtcbiAgbWFyZ2luLXJpZ2h0OiAuOGVtO1xuICBib3JkZXItcmFkaXVzOiA0cHggMCAwIDRweDtcbn1cblxuYnV0dG9uIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VlZTtcbiAgYm9yZGVyOiBub25lO1xuICBwYWRkaW5nOiA1cHggMTBweDtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGN1cnNvcjogaGFuZDtcbiAgZm9udC1mYW1pbHk6IEFyaWFsO1xufVxuXG5idXR0b246aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjY2ZkOGRjO1xufVxuXG5idXR0b24uZGVsZXRlIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBsZWZ0OiAxOTRweDtcbiAgdG9wOiAtMzJweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogZ3JheSAhaW1wb3J0YW50O1xuICBjb2xvcjogd2hpdGU7XG59XG5cbiJdfQ== */"

/***/ }),

/***/ "./src/app/heroes/heroes.component.ts":
/*!********************************************!*\
  !*** ./src/app/heroes/heroes.component.ts ***!
  \********************************************/
/*! exports provided: HeroesComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "HeroesComponent", function() { return HeroesComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");



let HeroesComponent = class HeroesComponent {
    constructor(heroService) {
        this.heroService = heroService;
    }
    ngOnInit() {
        this.getHeroes();
    }
    getHeroes() {
        this.heroService.getHeroes()
            .subscribe(heroes => this.heroes = heroes);
    }
    add(name) {
        name = name.trim();
        if (!name) {
            return;
        }
        this.heroService.addHero({ name })
            .subscribe(hero => {
            this.heroes.push(hero);
        });
    }
    delete(hero) {
        this.heroes = this.heroes.filter(h => h !== hero);
        this.heroService.deleteHero(hero).subscribe();
    }
};
HeroesComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-heroes',
        template: __webpack_require__(/*! raw-loader!./heroes.component.html */ "./node_modules/raw-loader/index.js!./src/app/heroes/heroes.component.html"),
        styles: [__webpack_require__(/*! ./heroes.component.css */ "./src/app/heroes/heroes.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]])
], HeroesComponent);



/***/ }),

/***/ "./src/app/licence-agreement/licence-agreement.component.css":
/*!*******************************************************************!*\
  !*** ./src/app/licence-agreement/licence-agreement.component.css ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2xpY2VuY2UtYWdyZWVtZW50L2xpY2VuY2UtYWdyZWVtZW50LmNvbXBvbmVudC5jc3MifQ== */"

/***/ }),

/***/ "./src/app/licence-agreement/licence-agreement.component.ts":
/*!******************************************************************!*\
  !*** ./src/app/licence-agreement/licence-agreement.component.ts ***!
  \******************************************************************/
/*! exports provided: LicenceAgreementComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LicenceAgreementComponent", function() { return LicenceAgreementComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let LicenceAgreementComponent = class LicenceAgreementComponent {
    constructor() { }
    ngOnInit() {
    }
};
LicenceAgreementComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-licence-agreement',
        template: __webpack_require__(/*! raw-loader!./licence-agreement.component.html */ "./node_modules/raw-loader/index.js!./src/app/licence-agreement/licence-agreement.component.html"),
        styles: [__webpack_require__(/*! ./licence-agreement.component.css */ "./src/app/licence-agreement/licence-agreement.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], LicenceAgreementComponent);



/***/ }),

/***/ "./src/app/login/login.component.css":
/*!*******************************************!*\
  !*** ./src/app/login/login.component.css ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2xvZ2luL2xvZ2luLmNvbXBvbmVudC5jc3MifQ== */"

/***/ }),

/***/ "./src/app/login/login.component.ts":
/*!******************************************!*\
  !*** ./src/app/login/login.component.ts ***!
  \******************************************/
/*! exports provided: LoginComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LoginComponent", function() { return LoginComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm2015/forms.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm2015/operators/index.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");






.3;
let LoginComponent = class LoginComponent {
    constructor(formBuilder, router, authenticationService) {
        this.formBuilder = formBuilder;
        this.router = router;
        this.authenticationService = authenticationService;
        this.closeLoginPopup = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.loading = false;
        this.submitted = false;
        if (this.authenticationService.currentUserValue) {
            this.router.navigate(['/']);
        }
    }
    ngOnInit() {
        this.loginForm = this.formBuilder.group({
            email: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].compose([
                    _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required,
                    _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')
                ])],
            password: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
        });
    }
    // convenience getter for easy access to form fields
    get f() { return this.loginForm.controls; }
    closePopup() {
        this.closeLoginPopup.emit(false);
    }
    onSubmit() {
        this.submitted = true;
        // stop here if form is invalid
        if (this.loginForm.invalid) {
            return;
        }
        this.loading = true;
        this.authenticationService.getLogin(this.f.email.value, this.f.password.value)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["first"])())
            .subscribe(data => {
            console.log(data);
            this.closeLoginPopup.emit(true);
        }, error => {
            this.loading = false;
        });
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)
], LoginComponent.prototype, "openLoginPopup", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"])
], LoginComponent.prototype, "closeLoginPopup", void 0);
LoginComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-login',
        template: __webpack_require__(/*! raw-loader!./login.component.html */ "./node_modules/raw-loader/index.js!./src/app/login/login.component.html"),
        styles: [__webpack_require__(/*! ./login.component.css */ "./src/app/login/login.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"],
        _hero_service__WEBPACK_IMPORTED_MODULE_5__["HeroService"]])
], LoginComponent);



/***/ }),

/***/ "./src/app/message.service.ts":
/*!************************************!*\
  !*** ./src/app/message.service.ts ***!
  \************************************/
/*! exports provided: MessageService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MessageService", function() { return MessageService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let MessageService = class MessageService {
    constructor() {
        this.messages = [];
    }
    add(message) {
        this.messages.push(message);
    }
    clear() {
        this.messages = [];
    }
};
MessageService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({ providedIn: 'root' })
], MessageService);



/***/ }),

/***/ "./src/app/messages/messages.component.css":
/*!*************************************************!*\
  !*** ./src/app/messages/messages.component.css ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/* MessagesComponent's private CSS styles */\nh2 {\n  color: red;\n  font-family: Arial, Helvetica, sans-serif;\n  font-weight: lighter;\n}\nbody {\n  margin: 2em;\n}\nbody, input[text], button {\n  color: crimson;\n  font-family: Cambria, Georgia;\n}\nbutton.clear {\n  font-family: Arial;\n  background-color: #eee;\n  border: none;\n  padding: 5px 10px;\n  border-radius: 4px;\n  cursor: pointer;\n  cursor: hand;\n}\nbutton:hover {\n  background-color: #cfd8dc;\n}\nbutton:disabled {\n  background-color: #eee;\n  color: #aaa;\n  cursor: auto;\n}\nbutton.clear {\n  color: #333;\n  margin-bottom: 12px;\n}\n\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbWVzc2FnZXMvbWVzc2FnZXMuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSwyQ0FBMkM7QUFDM0M7RUFDRSxVQUFVO0VBQ1YseUNBQXlDO0VBQ3pDLG9CQUFvQjtBQUN0QjtBQUNBO0VBQ0UsV0FBVztBQUNiO0FBQ0E7RUFDRSxjQUFjO0VBQ2QsNkJBQTZCO0FBQy9CO0FBRUE7RUFDRSxrQkFBa0I7RUFDbEIsc0JBQXNCO0VBQ3RCLFlBQVk7RUFDWixpQkFBaUI7RUFDakIsa0JBQWtCO0VBQ2xCLGVBQWU7RUFDZixZQUFZO0FBQ2Q7QUFDQTtFQUNFLHlCQUF5QjtBQUMzQjtBQUNBO0VBQ0Usc0JBQXNCO0VBQ3RCLFdBQVc7RUFDWCxZQUFZO0FBQ2Q7QUFDQTtFQUNFLFdBQVc7RUFDWCxtQkFBbUI7QUFDckIiLCJmaWxlIjoic3JjL2FwcC9tZXNzYWdlcy9tZXNzYWdlcy5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLyogTWVzc2FnZXNDb21wb25lbnQncyBwcml2YXRlIENTUyBzdHlsZXMgKi9cbmgyIHtcbiAgY29sb3I6IHJlZDtcbiAgZm9udC1mYW1pbHk6IEFyaWFsLCBIZWx2ZXRpY2EsIHNhbnMtc2VyaWY7XG4gIGZvbnQtd2VpZ2h0OiBsaWdodGVyO1xufVxuYm9keSB7XG4gIG1hcmdpbjogMmVtO1xufVxuYm9keSwgaW5wdXRbdGV4dF0sIGJ1dHRvbiB7XG4gIGNvbG9yOiBjcmltc29uO1xuICBmb250LWZhbWlseTogQ2FtYnJpYSwgR2VvcmdpYTtcbn1cblxuYnV0dG9uLmNsZWFyIHtcbiAgZm9udC1mYW1pbHk6IEFyaWFsO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVlO1xuICBib3JkZXI6IG5vbmU7XG4gIHBhZGRpbmc6IDVweCAxMHB4O1xuICBib3JkZXItcmFkaXVzOiA0cHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgY3Vyc29yOiBoYW5kO1xufVxuYnV0dG9uOmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2NmZDhkYztcbn1cbmJ1dHRvbjpkaXNhYmxlZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZWU7XG4gIGNvbG9yOiAjYWFhO1xuICBjdXJzb3I6IGF1dG87XG59XG5idXR0b24uY2xlYXIge1xuICBjb2xvcjogIzMzMztcbiAgbWFyZ2luLWJvdHRvbTogMTJweDtcbn1cbiJdfQ== */"

/***/ }),

/***/ "./src/app/messages/messages.component.ts":
/*!************************************************!*\
  !*** ./src/app/messages/messages.component.ts ***!
  \************************************************/
/*! exports provided: MessagesComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MessagesComponent", function() { return MessagesComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _message_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../message.service */ "./src/app/message.service.ts");



let MessagesComponent = class MessagesComponent {
    constructor(messageService) {
        this.messageService = messageService;
    }
    ngOnInit() {
    }
};
MessagesComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-messages',
        template: __webpack_require__(/*! raw-loader!./messages.component.html */ "./node_modules/raw-loader/index.js!./src/app/messages/messages.component.html"),
        styles: [__webpack_require__(/*! ./messages.component.css */ "./src/app/messages/messages.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_message_service__WEBPACK_IMPORTED_MODULE_2__["MessageService"]])
], MessagesComponent);



/***/ }),

/***/ "./src/app/privacy-policy/privacy-policy.component.css":
/*!*************************************************************!*\
  !*** ./src/app/privacy-policy/privacy-policy.component.css ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3ByaXZhY3ktcG9saWN5L3ByaXZhY3ktcG9saWN5LmNvbXBvbmVudC5jc3MifQ== */"

/***/ }),

/***/ "./src/app/privacy-policy/privacy-policy.component.ts":
/*!************************************************************!*\
  !*** ./src/app/privacy-policy/privacy-policy.component.ts ***!
  \************************************************************/
/*! exports provided: PrivacyPolicyComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PrivacyPolicyComponent", function() { return PrivacyPolicyComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let PrivacyPolicyComponent = class PrivacyPolicyComponent {
    constructor() { }
    ngOnInit() {
    }
};
PrivacyPolicyComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-privacy-policy',
        template: __webpack_require__(/*! raw-loader!./privacy-policy.component.html */ "./node_modules/raw-loader/index.js!./src/app/privacy-policy/privacy-policy.component.html"),
        styles: [__webpack_require__(/*! ./privacy-policy.component.css */ "./src/app/privacy-policy/privacy-policy.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], PrivacyPolicyComponent);



/***/ }),

/***/ "./src/app/sign-up/sign-up.component.css":
/*!***********************************************!*\
  !*** ./src/app/sign-up/sign-up.component.css ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3NpZ24tdXAvc2lnbi11cC5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/sign-up/sign-up.component.ts":
/*!**********************************************!*\
  !*** ./src/app/sign-up/sign-up.component.ts ***!
  \**********************************************/
/*! exports provided: SignUpComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "SignUpComponent", function() { return SignUpComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm2015/forms.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm2015/operators/index.js");







let SignUpComponent = class SignUpComponent {
    constructor(formBuilder, authenticationService, router, dataHelper) {
        this.formBuilder = formBuilder;
        this.authenticationService = authenticationService;
        this.router = router;
        this.dataHelper = dataHelper;
        this.loading = false;
        this.submitted = false;
        this.showloginPopup = false;
        this.stateInfo = [];
        this.countryInfo = [];
        this.cityInfo = [];
    }
    ngOnInit() {
        this.registerForm = this.formBuilder.group({
            first_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            last_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            password: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(6)]],
            confirmPassword: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            email: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].email]],
            occupation: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            company: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            mobileNumber: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(10), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(10)]],
            phoneNumber: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            country: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            state: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            city: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            pincode: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(6), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(6)]],
            address: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            iagree: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
        }, {
            validator: this.dataHelper.mustMatch('password', 'confirmPassword')
        });
        this.getCountries();
    }
    get f() { return this.registerForm.controls; }
    getCountries() {
        this.authenticationService.allCountries().
            subscribe(data2 => {
            //this.countryInfo=data2.Countries;
            this.countryInfo = data2;
            //console.log('Data:', this.countryInfo);
        }, err => console.log(err), () => console.log('complete'));
    }
    onChangeCountry(countryValue) {
        //  console.log(this.countryInfo[countryValue]);
        this.authenticationService.allstates(countryValue).
            subscribe(data2 => {
            //this.countryInfo=data2.Countries;
            this.stateInfo = data2;
            //console.log('Data:', this.countryInfo);
        }, err => console.log(err), () => console.log('complete'));
        // this.registerForm.controls['country'].setValue(this.countryInfo[countryValue].CountryName);
        // this.stateInfo=this.countryInfo[countryValue].States;
        // this.cityInfo=this.stateInfo[0].Cities;
        //  console.log(this.cityInfo);
    }
    onChangeState(stateValue) {
        // console.log(this.stateInfo[stateValue]);
        this.authenticationService.allCities(stateValue).
            subscribe(data2 => {
            //this.countryInfo=data2.Countries;
            this.cityInfo = data2;
            //console.log('Data:', this.countryInfo);
        }, err => console.log(err), () => console.log('complete'));
        // this.registerForm.controls['state'].setValue(this.stateInfo[stateValue].StateName);
        // this.cityInfo=this.stateInfo[stateValue].Cities;
        // console.log(this.cityInfo);j
    }
    onChangeCity(cityValue) {
        // console.log(this.cityInfo[cityValue]);
        // this.registerForm.controls['city'].setValue(this.cityInfo[cityValue]);
    }
    onSubmit() {
        this.submitted = true;
        // stop here if form is invalid
        if (this.registerForm.invalid) {
            // console.log('at invalid');      console.log(this.registerForm);
            return;
        }
        // console.log(this.registerForm.value);
        this.authenticationService.register(this.registerForm.value)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_6__["first"])())
            .subscribe(data2 => {
            alert("Sucessfully Registered");
            this.router.navigate(['/']);
            // console.log(data2);
            // console.log(data2.message);
            // console.log(data2["message"]);
            // if(data2.status=='1'){
            //   alert(data2.message);
            //   this.router.navigate(['/']);
            // }else{
            //   alert(data2.message);
            // }
        }, error => {
            this.loading = false;
        });
    }
    clickLoginPopup() {
        this.showloginPopup = true;
    }
    hideLoginPopup(event) {
        this.showloginPopup = false;
        if (event) {
            this.router.navigate(['/dashboard']);
        }
    }
};
SignUpComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-sign-up',
        template: __webpack_require__(/*! raw-loader!./sign-up.component.html */ "./node_modules/raw-loader/index.js!./src/app/sign-up/sign-up.component.html"),
        styles: [__webpack_require__(/*! ./sign-up.component.css */ "./src/app/sign-up/sign-up.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _hero_service__WEBPACK_IMPORTED_MODULE_5__["HeroService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"],
        _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__["imageFooterHelper"]])
], SignUpComponent);



/***/ }),

/***/ "./src/app/terms-and-conditions/terms-and-conditions.component.css":
/*!*************************************************************************!*\
  !*** ./src/app/terms-and-conditions/terms-and-conditions.component.css ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3Rlcm1zLWFuZC1jb25kaXRpb25zL3Rlcm1zLWFuZC1jb25kaXRpb25zLmNvbXBvbmVudC5jc3MifQ== */"

/***/ }),

/***/ "./src/app/terms-and-conditions/terms-and-conditions.component.ts":
/*!************************************************************************!*\
  !*** ./src/app/terms-and-conditions/terms-and-conditions.component.ts ***!
  \************************************************************************/
/*! exports provided: TermsAndConditionsComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TermsAndConditionsComponent", function() { return TermsAndConditionsComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let TermsAndConditionsComponent = class TermsAndConditionsComponent {
    constructor() { }
    ngOnInit() {
    }
};
TermsAndConditionsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-terms-and-conditions',
        template: __webpack_require__(/*! raw-loader!./terms-and-conditions.component.html */ "./node_modules/raw-loader/index.js!./src/app/terms-and-conditions/terms-and-conditions.component.html"),
        styles: [__webpack_require__(/*! ./terms-and-conditions.component.css */ "./src/app/terms-and-conditions/terms-and-conditions.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], TermsAndConditionsComponent);



/***/ }),

/***/ "./src/app/wishlist/wishlist.component.css":
/*!*************************************************!*\
  !*** ./src/app/wishlist/wishlist.component.css ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "body{ font-weight:normal; background: #f1f5f6;}\r\n #mainNav{background:#000;}\r\n hr {\r\n    border-top: 1px solid #ddd!important;\r\n}\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvd2lzaGxpc3Qvd2lzaGxpc3QuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxNQUFNLGtCQUFrQixFQUFFLG1CQUFtQixDQUFDO0NBQzdDLFNBQVMsZUFBZSxDQUFDO0NBQ3pCO0lBQ0csb0NBQW9DO0FBQ3hDIiwiZmlsZSI6InNyYy9hcHAvd2lzaGxpc3Qvd2lzaGxpc3QuY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbImJvZHl7IGZvbnQtd2VpZ2h0Om5vcm1hbDsgYmFja2dyb3VuZDogI2YxZjVmNjt9XHJcbiAjbWFpbk5hdntiYWNrZ3JvdW5kOiMwMDA7fVxyXG4gaHIge1xyXG4gICAgYm9yZGVyLXRvcDogMXB4IHNvbGlkICNkZGQhaW1wb3J0YW50O1xyXG59Il19 */"

/***/ }),

/***/ "./src/app/wishlist/wishlist.component.ts":
/*!************************************************!*\
  !*** ./src/app/wishlist/wishlist.component.ts ***!
  \************************************************/
/*! exports provided: WishlistComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "WishlistComponent", function() { return WishlistComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");




let WishlistComponent = class WishlistComponent {
    constructor(heroService, authenticationService, router) {
        this.heroService = heroService;
        this.authenticationService = authenticationService;
        this.router = router;
        this.wishListDataItems = [];
        this.priceArray = [];
    }
    ngOnInit() {
        // console.log(localStorage.getItem('checkoutAray'));
        this.authenticationService.getcartItemsData()
            .subscribe(data => {
            this.wishListDataItems = data;
            this.wishListDataItems.forEach(element => {
                this.priceArray.push(element["total"]);
            });
        }, error => {
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
                        .subscribe(data => {
                        this.wishListDataItems = data;
                        this.wishListDataItems.forEach(element => {
                            this.priceArray.push(element["total"]);
                        });
                    }, error => {
                    });
                }
                else {
                    alert(data["message"]);
                }
            });
            // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated
        }
        else {
            return false;
        }
    }
};
WishlistComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-wishlist',
        template: __webpack_require__(/*! raw-loader!./wishlist.component.html */ "./node_modules/raw-loader/index.js!./src/app/wishlist/wishlist.component.html"),
        styles: [__webpack_require__(/*! ./wishlist.component.css */ "./src/app/wishlist/wishlist.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
], WishlistComponent);



/***/ }),

/***/ "./src/environments/environment.ts":
/*!*****************************************!*\
  !*** ./src/environments/environment.ts ***!
  \*****************************************/
/*! exports provided: environment */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "environment", function() { return environment; });
// This file can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.
const environment = {
    production: false
};
/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/dist/zone-error';  // Included with Angular CLI.


/***/ }),

/***/ "./src/main.ts":
/*!*********************!*\
  !*** ./src/main.ts ***!
  \*********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_platform_browser_dynamic__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/platform-browser-dynamic */ "./node_modules/@angular/platform-browser-dynamic/fesm2015/platform-browser-dynamic.js");
/* harmony import */ var _app_app_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./app/app.module */ "./src/app/app.module.ts");
/* harmony import */ var _environments_environment__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./environments/environment */ "./src/environments/environment.ts");




if (_environments_environment__WEBPACK_IMPORTED_MODULE_3__["environment"].production) {
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["enableProdMode"])();
}
Object(_angular_platform_browser_dynamic__WEBPACK_IMPORTED_MODULE_1__["platformBrowserDynamic"])().bootstrapModule(_app_app_module__WEBPACK_IMPORTED_MODULE_2__["AppModule"]);


/***/ }),

/***/ 0:
/*!***************************!*\
  !*** multi ./src/main.ts ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\imagefootagenew\frontend\src\main.ts */"./src/main.ts");


/***/ })

},[[0,"runtime","vendor"]]]);
//# sourceMappingURL=main-es2015.js.map