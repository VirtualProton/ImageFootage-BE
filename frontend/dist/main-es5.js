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

module.exports = "<section class=\"banner-area relative\">\n        <div class=\"overlay overlay-bg\"></div>\n        <div class=\"banner-content text-center\">\n          <h1>About Image Footage</h1>\n          <p>We are a privately owned group offering a variety of services that include,\n            <br />\n             stock imagery,stock footage, photography\n          </p>\n        </div>\n      </section>\n    \n    <section class=\"pt-5\">\n    \n      <div class=\"container f-18\">\n      \n      <p class=\"\">We are a privately owned group offering a variety of services that include stock imagery,stock footage, photography, image rendering, computer graphics (CG), 3D, and print publishing.</p>\n  <p>\n  The companies within the group cater to the ever evolving visual content and technology demands of leading corporationscreative agencies, and media organisations in the Asia Pacific & Middle Eastern Regions.With our networking capabilities, complementary resources, and the collaborative power to penetrate new markets,\n  </p>\n  <p>\n  we add immense value to our affiliate businesses and clients. Our global creative network combines an array of industryprofessionals and supply of visual content to leading media and marketing enterprises across the Asia Pacific and the Middle East.</p>\n  <p>\n  \n  Speed and technology are critical to our operations as we make things happen for you as a creative partner.</p>\n      \n      </div>\n    </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/app.component.html":
/*!**************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/app.component.html ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!-- <h1>{{title}}</h1>\n<nav>\n  <a routerLink=\"/dashboard\">Dashboard</a>\n  <a routerLink=\"/heroes\">Heroes</a>\n</nav> -->\n\n\n\n <app-header></app-header> \n<router-outlet></router-outlet>\n<!-- <app-messages></app-messages>  -->\n<app-footer *ngIf=\"footerEle\"></app-footer>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/checkout/checkout.component.html":
/*!****************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/checkout/checkout.component.html ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<section class=\"mt-5\">\n  \n        <div class=\"container\"> \n    \n                            <div class=\"row\">\n                   <div class=\"col-lg-5 col-md-5 col-sm-6 bg-light\">\n                      <div class=\"card z-depth-0\">\n                     <form class=\"loignForm p-5\">\n                     <h3 class=\"f-20 mb-3\">BILLING ADDRESS</h3>\n                       <div class=\"row form-group\">\n                       <div class=\"col-lg-6 col-md-6 col-sm-6\">\n                         <label>First Name</label>\n                         <input type=\"text\" class=\"form-control rounded-0\">\n                       </div>\n                      \n                       <div class=\"col-lg-6 col-md-6 col-sm-6\">\n                         <label>Last Name</label>\n                         <input type=\"text\" class=\"form-control\">\n                       </div>\n                       \n                        </div>\n                        \n                     <div class=\"form-group\">\n                         <label>Street Address</label>\n                         <textarea  class=\"form-control rounded-0\" rows=\"2\" style=\"min-height:70px;\"></textarea>\n                       </div>\n                       \n                     <div class=\"form-group\">\n                         <label>City</label>\n                         <input type=\"text\" class=\"form-control rounded-0\">\n                       </div>\n                       \n                       <div class=\"form-group\">\n                         <label>Country</label>\n                         <select class=\"form-control\">\n                          <option value=\"\">India</option>\n                          <option value=\"\">Canada</option>\n                          <option value=\"\">USA</option>\n                          <option value=\"\">Aus</option>\n                         </select>\n                       </div>\n                       \n                       <div class=\"row form-group pt-4\">\n                       <div class=\"col-md-6 col-lg-6 col-sm-6\">\n                         <label>State/province</label>\n                         <select class=\"form-control\">\n                          <option value=\"\">India</option>\n                          <option value=\"\">Canada</option>\n                          <option value=\"\">USA</option>\n                          <option value=\"\">Aus</option>\n                         </select>\n                       </div>\n                       \n                       <div class=\"col-md-6 col-sm-6 col-lg-6\">\n                         <label>Zipcode</label>\n                         <input type=\"text\" class=\"form-control\">\n                       </div>\n                       </div>\n                       \n                       <div class=\"form-group pt-3\">\n                       \n                         <button type=\"button\" class=\"btn btn-success btn-block text-white p-3 text-uppercase\"><strong>Enter Address\n                         </strong></button>\n                         <div class=\"clearfix\"></div>\n                         <hr>\n                         <h3 class=\"f-20 mb-4 mt-5\">PAYMENT INFORMATION</h3>\n    \n                         <div class=\"row\">\n                           <div class=\"col-md-8 col-sm-8 col-lg-8 col-xs-8\">\n                             \n                             <div class=\"custom-control custom-radio\">\n        <input type=\"radio\" class=\"custom-control-input\" id=\"customRadio\" name=\"example1\" value=\"customEx\" checked=\"\">\n        <label class=\"custom-control-label\" for=\"customRadio\"><strong>Credit Card</strong></label>\n      </div>\n                           </div>\n    \n                           <div class=\"col-md-4 col-sm-4 col-lg-4 col-xs-4\">\n                             \n                             <span><img src=\"assets/images/visa.png\" class=\"border p-1\" height=\"24\"></span>\n                             <span><img src=\"assets/images/mastarcard.png\"  class=\"border p-1\"  height=\"24\"></span>\n                           </div>\n    \n                         </div>\n                          <div class=\"row form-group mt-4\">\n                       <div class=\"col-lg-12 col-md-12 col-sm-12\">\n                         <label>Credit Card Number</label>\n                         <input type=\"number\" class=\"form-control rounded-0\">\n                       </div>                  \n                        </div>\n    \n                       <div class=\"row form-group\">\n                      <div class=\"col-md-8 col-lg-8 col-sm-8\">\n                         <label>Expiry Date</label>\n                         <div class=\"row\">\n                          <div class=\"col-md-6 col-sm-6 col-lg-6\">\n                         <select class=\"form-control\">\n                          <option value=\"\">MM</option>\n                          <option value=\"\">01</option>\n                          <option value=\"\">02</option>\n                          <option value=\"\">03</option>\n                         </select>\n                       </div>\n                       <div class=\"col-md-6 col-sm-6 col-lg-6\">\n                         <select class=\"form-control\">\n                          <option value=\"\">YY</option>\n                          <option value=\"\">2019</option>\n                          <option value=\"\">2018</option>\n                          <option value=\"\">2017</option>\n                         </select>\n                       </div>\n                       </div>\n                       </div>\n                      \n                       <div class=\"col-lg-4 col-md-4 col-sm-4\">\n                         <label>Security Code</label>\n                         <input type=\"text\" class=\"form-control\" placeholder=\"CVV\">\n                       </div>\n                       \n                        </div>\n    \n                         <div class=\"row form-group\">\n                       <div class=\"col-lg-12 col-md-12 col-sm-12\">\n                         <label>Name on Card</label>\n                         <input type=\"text\" class=\"form-control rounded-0\">\n                       </div>                  \n                        </div>\n                        \n                       \n                       </div>\n                       \n                       \n                     </form>\n                   </div>\n                   \n                   \n                   </div>\n                   \n                   <div class=\"col-lg-7 col-md-7 col-sm-6\">\n                    <div class=\"card\">\n                    <div class=\"table-responsive\">\n                      <table class=\"table cart-table checkout-table\">\n                        <thead class=\"f-16\">\n                          <tr>\n                            <th colspan=\"2\"><h3 class=\"f-18\">CART</h3>\n                            <p class=\"mb-0\">2 Items</p></th>\n                            <th align=\"right\" class=\"text-right\"><button class=\"btn btn-default rounded-0\" (click)=\"goToWishList()\">Edit</button></th>                          \n                          </tr>\n                        </thead>\n                        <tbody>\n                          <tr *ngFor=\"let checkout of wishListDataItems;let i= index\">\n                            <td width=\"25%\" align=\"center\">\n                              <div class=\"product-info\">\n                                <img src=\"assets/images/{{checkout.imgPath}}\" alt=\"product-img\" height=\"100\">\n                              </div>                             \n                            </td>                            \n                            <td width=\"50%\">\n                               <p class=\"mb-1 text-black\"><strong>{{checkout.name}}</strong></p>\n                               <p class=\"mb-1\"><strong>Size:</strong>  {{checkout.size}}</p>                              \n                            </td>\n                             <td width=\"25%\" align=\"right\"><p class=\"f-16 text-black\"><strong>${{checkout.price}}.00 USD</strong></p>                            \n                             </td>\n                          </tr>\n                        </tbody>\n                        <tfoot class=\"text-black\">\n                          <tr class=\"f-20\">\n                          <td></td>\n                            <td align=\"right\"><strong>TOTAL</strong></td>\n                            <td align=\"right\"><strong>${{showTotalPrice()}}.00 USD</strong></td>\n                          </tr>\n                           <tr class=\"f-16\">\n                          <td></td>\n                            <td align=\"right\"><strong>BALANCE DUE</strong></td>\n                            <td align=\"right\"><strong>${{showTotalPrice()}}.00 USD</strong></td>\n                          </tr>\n                        </tfoot>\n                      </table>\n                    </div>\n                  </div>\n               </div>\n                \n            </div>\n        </div>\n      </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/contact-us/contact-us.component.html":
/*!********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/contact-us/contact-us.component.html ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<section class=\"banner-area relative\">\n    <div class=\"overlay overlay-bg\"></div>\n    <div class=\"banner-content text-center\">\n      <h1>Contact Us</h1>\n      <p>\n        Elementum libero hac leo integer. Risus hac parturient feugiat litora\n        <br />\n        cursus hendrerit bibendum per\n      </p>\n    </div>\n  </section>\n  <section class=\"contact-page-area section-gap\">\n    <div class=\"container\">\n      <div class=\"row\">\n       \n        <div class=\"col-lg-4 d-flex flex-column address-wrap\">\n          <div class=\"single-contact-address d-flex flex-row\">\n            <div class=\"icon f-22\"><span class=\"icon-home2 mr-1\"></span></div>\n            <div class=\"contact-details\">\n              <h5>Binghamton, New York</h5>\n              <p>4343 Hinkle Deegan Lake Road</p>\n            </div>\n          </div>\n          <div class=\"single-contact-address d-flex flex-row\">\n            <div class=\"icon f-22\">\n              <span class=\"icon-phone2 mr-1\"></span>\n            </div>\n            <div class=\"contact-details\">\n              <h5>00 (958) 9865 562</h5>\n              <p>Mon to Fri 9am to 6 pm</p>\n            </div>\n          </div>\n          <div class=\"single-contact-address d-flex flex-row\">\n            <div class=\"icon f-22\"><span class=\"icon-envelope-o mr-1\"></span></div>\n            <div class=\"contact-details\">\n              <h5>support@colorlib.com</h5>\n              <p>Send us your query anytime!</p>\n            </div>\n          </div>\n        </div>\n        <div class=\"col-lg-8\">\n          <form\n            class=\"form-area contact-form text-right\"\n            id=\"myForm\"\n            action=\"mail.php\"\n            method=\"post\"\n          >\n            <div class=\"row\">\n              <div class=\"col-lg-6 form-group\">\n                <input\n                  name=\"name\"\n                  placeholder=\"Enter your name\"\n                  onfocus=\"this.placeholder = ''\"\n                  onblur=\"this.placeholder = 'Enter your name'\"\n                  class=\"common-input mb-20 form-control\"\n                  required=\"\"\n                  type=\"text\"\n                />\n\n                <input\n                  name=\"email\"\n                  placeholder=\"Enter email address\"\n                  pattern=\"[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{1,63}$\"\n                  onfocus=\"this.placeholder = ''\"\n                  onblur=\"this.placeholder = 'Enter email address'\"\n                  class=\"common-input mb-20 form-control\"\n                  required=\"\"\n                  type=\"email\"\n                />\n\n                <input\n                  name=\"subject\"\n                  placeholder=\"Enter subject\"\n                  onfocus=\"this.placeholder = ''\"\n                  onblur=\"this.placeholder = 'Enter subject'\"\n                  class=\"common-input mb-20 form-control\"\n                  required=\"\"\n                  type=\"text\"\n                />\n              </div>\n              <div class=\"col-lg-6 form-group\">\n                <textarea\n                  class=\"common-textarea form-control\"\n                  name=\"message\"\n                  placeholder=\"Enter Messege\"\n                  onfocus=\"this.placeholder = ''\"\n                  onblur=\"this.placeholder = 'Enter Messege'\"\n                  required=\"\"\n                ></textarea>\n              </div>\n              <div class=\"col-lg-12\">\n                <div class=\"alert-msg\" style=\"text-align: left;\"></div>\n                <button\n                  class=\"primary-btn text-uppercase\"\n                  style=\"float: right;\"\n                >\n                  Send Message\n                </button>\n              </div>\n            </div>\n          </form>\n        </div>\n      </div>\n      \n       <div class=\"row pt-5\">\n       <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243647.31698201783!2d78.2679590430495!3d17.412299801300147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99daeaebd2c7%3A0xae93b78392bafbc2!2sHyderabad%2C%20Telangana!5e0!3m2!1sen!2sin!4v1570531072830!5m2!1sen!2sin\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>\n       </div>\n    </div>\n  </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/dashboard/dashboard.component.html":
/*!******************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/dashboard/dashboard.component.html ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n\n<header class=\"masthead\">\n    <div class=\"container\">\n      <div class=\"intro-text\">\n      \n        <div class=\"intro-lead-in text-warning\">Bring Your Vision to Life</div>\n        <div class=\"intro-heading text-uppercase\">Without Compromise</div>\n        <div class=\"col-md-9 col-sm-9 m-auto\">\n            <form class=\"search_m\">\n    <div class=\"input-group\">\n          <div class=\"input-group-btn\" ngbDropdown >\n            <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\n             <span *ngIf='searchBoxLabel == 3'>Photos + Videos</span>\n             <span *ngIf='searchBoxLabel == 1'>Photos Only</span>\n             <span *ngIf='searchBoxLabel == 2'>Videos Only</span>\n            </button>\n            <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('3')\" ngbDropdownItem>Photos + Videos</a>\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('1')\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('2')\" ngbDropdownItem>Videos Only</a>\n               </div>\n          </div>\n          <input type=\"text\" class=\"form-control\" #searchBoxEle  aria-label=\"Text input with dropdown button\">\n          <a href=\"javascript:void(0)\" class=\"iconSearch\" (click)=\"searchAosData(searchBoxEle.value)\"><span class=\"icon-search\"></span></a>\n        </div>\n  </form>\n        \n        </div>\n      </div>\n    </div>\n  </header>\n\n  <div class=\"site-wrap\">\n    <div class=\"container-fluid text-center my-5\">\n      <div class=\"row mx-auto my-auto\">\n          <div id=\"recipeCarousel\" class=\"carousel slide w-100\">\n              <div class=\"carousel-inner\" role=\"listbox\">              \n\n                <!-- <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \n                    <div class=\"carousel-item\">\n                        <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages;let i= index\">\n                          <div class=\"col-11 m-auto\">\n                              <div class=\"row\">\n                                    <div class=\"col-md-2 col-sm-2 col-4 text-center\" *ngFor=\"let images of carouseimges.categoryNames\">\n                                      <a href=\"javascript:void(0)\">{{images.name}}</a>\n                                    </div>                          \n                              </div>\n                          </div>\n                        </ng-template>\n                    </div>\n                </ngb-carousel> -->\n\n                \n              </div>\n\n            </div>\n        </div>\n      </div>\n      <main class=\"main-content mt-3\">\n          <div class=\"container-fluid photos\">\n            <div class=\"row align-items-stretch\">\n\n                <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\n                    <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\n                      <img *ngIf=\"aosimges.mimetype == 'image/jpeg'\" src=\"{{aosimges.preview}}\" alt=\"Image\" class=\"img-fluid\">\n                     <!-- <iframe  *ngIf=\"aosimges.mimetype != 'image/jpeg'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>  -->\n                      <div class=\"photo-text-more\">\n                      \n                        <div class=\"photo-text-more\">\n                        <h3 class=\"heading\">{{aosimges.title}}</h3>\n                        <span class=\"meta\">{{aosimges.description}}</span>\n                      </div>\n                      </div>\n                    </a>\n                </div>\n\n           </div>\n\n            \n\n            <div class=\"col-md-5 col-sm-6 col-12 m-auto\" *ngIf=\"aoslSliderImagesData.length !=0\"> \n                    <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \n            </div>\n\n          </div>\n      </main>\n          \n\n\n    </div>\n<!-- <app-hero-search></app-hero-search> -->\n"

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

module.exports = "<nav class=\"navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink\" id=\"mainNav\">\n    <div class=\"container\">\n      <a class=\"navbar-brand js-scroll-trigger\" routerLink=\"/dashboard\">Image Footage</a>\n      <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\n        Menu\n        <i class=\"fas fa-bars\"></i>\n      </button>\n      <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">\n        <ul class=\"navbar-nav text-uppercase ml-auto\">\n          <li class=\"nav-item\">\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/services\">Images</a>\n          </li>\n          <li class=\"nav-item\">\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/portfolio\">Footage</a>\n          </li>\n          <li class=\"nav-item\">\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/about\">Editorial</a>\n          </li>\n          <li class=\"nav-item\">\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/team\">Pricing</a>\n          </li>\n          \n          <li class=\"nav-item\">\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/wishlist\">Cart</a>\n          </li>\n          \n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"clickLoginPopup()\">Login</a>\n          </li>\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"logout()\">Logout</a>\n          </li>\n          <li class=\"nav-item\"  *ngIf=\"!currentUser\">\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/signUp\">Sign Up</a>\n          </li>\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\n              <a class=\"nav-link js-scroll-trigger\"  routerLink=\"/wishlist\">wishlist</a>\n            </li>\n        </ul>\n      </div>\n    </div>\n  </nav>\n\n\n<ng-container *ngIf=\"showloginPopup\">\n  <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\n</ng-container>\n  "

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/hero-detail/hero-detail.component.html":
/*!**********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/hero-detail/hero-detail.component.html ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"site-wrap mt-5 pt-5 bg-dark\">   \n  <main class=\"main-content p-0\">\n    <div class=\"container-fluid photos\">\n      <div class=\"row mr-2\">\n        <div class=\"col-md-8 col-sm-8 col-xl-8 col-lg-8\">\n          <div class=\"cartItem\" *ngIf=\"detailPageInfo\">\n            <div class=\"p-3\">          \n              <div data-aos=\"fade-up\">\n                  <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\n                      <img src=\"assets/images/{{detailPageInfo.impagePath}}\" alt=\"Image\" class=\"img-fluid\">\n                      <div class=\"photo-text-more\">            \n                        <div class=\"photo-text-more\">\n                          <h3 class=\"heading\">{{detailPageInfo.name}}</h3>\n                          <span class=\"meta\">{{detailPageInfo.photoCount}} Photos</span>\n                        </div>\n                      </div>\n                  </a>\n              </div>         \n              <p class=\"text-white f-18\">{{detailPageInfo.description}}</p>\n              <p>{{detailPageInfo.shortInfo}}</p>\n              <p class=\"text-warning\">Related Keywords</p>            \n              <div class=\"related_key\">\n                <ng-container *ngFor=\"let keyele of detailPageInfo?.keywords\">                  \n                    <a href=\"javascript:void(0)\"  class=\"btn btn-outline-light\" title=\"{{keyele.id}}\">{{keyele.name}}</a>\n                </ng-container>   \n                            \n              </div>\n            </div>\n              \n          </div>\n        </div>\n         \n        <div class=\"col-md-4 col-sm-4 col-xl-4 col-lg-4 pt-3 cart_right pl-3 mt-3\" *ngIf=\"detailPageInfo\">\n          <div  class=\"p-3\">\n            <ngb-tabset class=\"nav nav-tabs mytabs\">\n                <ngb-tab   class=\"nav-item\">\n                    <ng-template ngbTabTitle class=\"nav-link active\">Standard Licence</ng-template>\n                  <ng-template ngbTabContent >\n                      <div class=\"tab-content pt-3\">\n                          <div>\n                              <p class=\"text-white text-uppercase lsp-1 f-14 pt-3\">standard Royalty Free Licenses</p>\n                              <div class=\"btn-group btn-group-toggle mb-1\" data-toggle=\"buttons\">\n                                  <ng-container *ngFor=\"let cost of detailPageInfo.licenseCost;let i=index;let first=first;\">\n                                      <label class=\"btn btn-dark\" [ngClass]=\"first ? 'active' : ''\">\n                                          <input type=\"radio\" name=\"options\" id=\"option{{i}}\" autocomplete=\"off\" [class]=\"i==0 ? 'checked' : ''\">\n                                          <p class=\"mb-0\">{{cost.name}}</p>\n                                          <p class=\"f-30 mb-0\"> <i class=\"fa fa-dollar\"></i>{{cost.cost}}</p>\n                                      </label>\n                                  </ng-container>\n                              \n                              </div>\n                                <p><small><span class=\"text-warning\"> Small</span> 866x578px | 12.03x8.03\" 72dpi</small></p>\n                          </div>\n                      </div>\n                  </ng-template>\n                </ngb-tab>\n\n                <ngb-tab class=\"nav-item\">\n                  <ng-template ngbTabTitle class=\"nav-link\">Extended Licence</ng-template>\n                  <ng-template  ngbTabContent>\n                      <div class=\"tab-content pt-3\">\n                          <div>\n                              <p class=\"text-white lsp-1 f-14 text-uppercase pt-3\">Extended Licenses</p>\n                              <div class=\"btn-group btn-group-toggle mb-4  d-block\" data-toggle=\"buttons\">\n                                  <ng-container *ngFor=\"let license of detailPageInfo.extendedLicense;let j=index;let first=first;\">\n                                      <label class=\"btn btn-dark\" [ngClass]=\"first ? 'active' : ''\">\n                                          <input type=\"radio\" name=\"options\" id=\"option{{j}}\" autocomplete=\"off\" [class]=\"j==0 ? 'checked' : ''\">\n                                          <div class=\"row align-items-center\">\n                                              <div class=\"col-md-9 col-sm-9 col-lg-9\">\n                                                <p class=\"f-14\"> {{license.name}}</p>\n                                              </div>\n                                              <div class=\"col-md-3 col-sm-3 col-lg-3\">\n                                                  <p class=\"mb-0\"> <i class=\"fa fa-dollar\"></i>{{license.amount}}</p>\n                                              </div>\n                                          </div>\n                                      </label>\n                                  </ng-container>\n                                \n                              </div>\n                              \n                           </div>\n                      </div>\n                  </ng-template>\n                </ngb-tab>\n            </ngb-tabset>\n          </div>\n            <div class=\"row mt-5\">\n                <div class=\"col-4\">\n                    <p class=\"text-white\"><strong>Total</strong></p>\n                </div>\n                <div class=\"col-8 text-right\">\n                    <h2 class=\"text-warning f-24\"><strong>$100.00 USD</strong></h2>\n                </div>\n            </div>\n            <div class=\"row mt-2 mb-5\">\n              <div class=\"col-12\">\n                  <button type=\"button\" *ngIf=\"!addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" (click)=\"addToCheckoutItem(detailPageInfo.id)\">ADD TO CART</button>\n                  <button type=\"button\" *ngIf=\"addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" >ADDED TO CART</button>\n                  <p>This image is exclusive to Image Footage</p>\n              </div>\n            </div>\n            <p class=\"\">DETAILS</p>\n            <table class=\"f-12\">\n              <tbody>\n                <tr>\n                  <td width=\"20%\">Restrictions :</td>\n                  <td>Contact your local office for all commercial or promotional uses.</td>\n                </tr>\n                <tr>\n                  <td>Credit :</td>\n                  <td>Lintao Zhang / Staff</td>\n                </tr>\n                <tr>\n                  <td>Editorial # :</td>\n                  <td>142933329</td>\n                </tr>\n                <tr>\n                  <td>Collection :</td>\n                  <td>Getty Images News</td>\n                </tr>\n                <tr>\n                  <td>Date created :</td>\n                  <td>15 April, 2012</td>\n                </tr>\n                <tr>\n                  <td>Licence type :</td>\n                  <td>Rights-managed</td>\n                </tr>\n                <tr>\n                  <td>Release info :</td>\n                  <td>Not released. More information</td>\n                </tr>\n                <tr>\n                  <td>Source :</td>\n                  <td>Getty Images AsiaPac</td>\n                </tr>\n\n                <tr>\n                  <td>Object name :</td>\n                  <td>69338444</td>\n                </tr>\n\n                <tr>\n                  <td>Max file size :</td>\n                  <td>3000 x 2000 px (25.40 x 16.93 cm) - 300 dpi - 1.89 MB</td>\n                </tr>\n              </tbody>\n\n            </table>\n        </div> \n\n        \n      </div>\n \n    \n    \n      <div class=\"bg-black p-3\">\n        <div class=\"row align-items-stretch\">\n          <div class=\"row mx-auto my-auto mb-5\">\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\n                <div class=\"carousel-inner\" role=\"listbox\">                    \n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \n                        <div class=\"carousel-item\">\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\n                              <div class=\"row\">\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\n                                          <div class=\"photo-text-more\">\n                                              <div class=\"photo-text-more\">\n                                                <h3 class=\"heading\">{{images.name}}</h3>\n                                                <span class=\"meta\">{{images.count}} Photos</span>\n                                              </div>\n                                          </div>\n                                      </a>\n                                  </div>\n                              </div>   \n                            </ng-template>\n                        </div> \n                    </ngb-carousel>\n                     \n\n                </div>\n            </div>\n          </div>\n          <div class=\"row mx-auto my-auto mb-5\">\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\n                <div class=\"carousel-inner\" role=\"listbox\">                    \n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \n                        <div class=\"carousel-item\">\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\n                              <div class=\"row\">\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\n                                          <div class=\"photo-text-more\">\n                                              <div class=\"photo-text-more\">\n                                                <h3 class=\"heading\">{{images.name}}</h3>\n                                                <span class=\"meta\">{{images.count}} Photos</span>\n                                              </div>\n                                          </div>\n                                      </a>\n                                  </div>\n                              </div>   \n                            </ng-template>\n                        </div> \n                    </ngb-carousel>\n                     \n\n                </div>\n            </div>\n          </div>\n          <div class=\"row mx-auto my-auto mb-5\">\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\n                <div class=\"carousel-inner\" role=\"listbox\">                    \n                    <ngb-carousel  [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \n                        <div class=\"carousel-item\">\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\n                              <div class=\"row\">\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\n                                          <div class=\"photo-text-more\">\n                                              <div class=\"photo-text-more\">\n                                                <h3 class=\"heading\">{{images.name}}</h3>\n                                                <span class=\"meta\">{{images.count}} Photos</span>\n                                              </div>\n                                          </div>\n                                      </a>\n                                  </div>\n                              </div>   \n                            </ng-template>\n                        </div> \n                    </ngb-carousel>\n                     \n\n                </div>\n            </div>\n          </div>\n\n          <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\n            <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\n              <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\n              <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\n              <div class=\"photo-text-more\">\n              \n                <div class=\"photo-text-more\">\n                <h3 class=\"heading\">{{aosimges.name}}</h3>\n                <span class=\"meta\">{{aosimges.count}} Photos</span>\n              </div>\n              </div>\n            </a>\n          </div>\n\n          <div class=\"col-md-5 col-sm-6 col-12 m-auto\">\n\n                <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \n        </div>\n\n\n\n\n      \n      \n      \n\n\n   \n      \n        \n        \n\n      </div>\n      \n       \n      </div>\n    </div>\n  </main>\n\n</div> \n\n<ng-container *ngIf=\"showloginPopup\">\n    <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\n</ng-container>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/hero-search/hero-search.component.html":
/*!**********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/hero-search/hero-search.component.html ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"site-wrap\">\n  <div class=\"page-wrapper chiller-theme toggled\">\n    <a id=\"show-sidebar\" class=\"btn btn-sm btn-dark\" href=\"javascript:void(0)\">\n      <i class=\"fas fa-bars\"></i>\n    </a>\n    <nav id=\"sidebar\" class=\"sidebar-wrapper\">\n      <div class=\"sidebar-content\">\n          <div class=\"sidebar-brand\">\n              <a href=\"javascript:void(0)\">FILTERS</a>\n              <div id=\"close-sidebar\">\n                <i class=\"fas fa-times\"></i>\n              </div>\n          </div>\n          <div class=\"sidebar-header\"> \n                <div class=\"btn-group btn-group-toggle search-select\" data-toggle=\"buttons\">\n                  <label  [class]=\"searchData.productType == 1 ? 'btn btn-dark active' : 'btn btn-dark'\">\n                    <input type=\"radio\"  name=\"options\" [(ngModel)]=\"searchData.productType\" value=\"1\">\n                    <p class=\"mb-0\"> <i class=\"fa fa-camera\"></i> </p>\n                    <p class=\"mb-0\">PHOTOS</p> \n                  </label>\n                  <label  [class]=\"searchData.productType == 2 ? 'btn btn-dark active' : 'btn btn-dark'\">\n                    <input type=\"radio\" name=\"options\" [(ngModel)]=\"searchData.productType\" value=\"2\">\n                    <p class=\"mb-0\"> <i class=\"fa fa-video\"></i> </p>\n                    <p class=\"mb-0\">  VIDEOS </p>\n                  </label>  \n                </div>\n          </div>\n        <div class=\"sidebar-menu\">\n          <ul>           \n            <li class=\"sidebar-dropdown\">\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu1=!sidebarSubmenu1\">  \n                <i class=\"fa fa-tachometer-alt\"></i>\n                <span> People</span>              \n              </a>  \n               <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu1\">\n                <ul>\n                  <li>\n                    <a href=\"javascript:void(0)\">Male</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Female</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">One Person</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Two People</a>\n                  </li>  \n                  <li>\n                    <a href=\"javascript:void(0)\">Small Group</a>\n                  </li>  \n                  <li>\n                    <a href=\"javascript:void(0)\">A Crowd</a>\n                  </li>  \n                  <li>\n                    <a href=\"javascript:void(0)\">No People</a>\n                  </li>\n                </ul>\n              </div>\n            </li>\n            <li class=\"sidebar-dropdown\">\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu2=!sidebarSubmenu2\">\n                <i class=\"fa fa-shopping-cart\"></i>\n                <span>Age</span>\n              </a>\n              <div class=\"sidebar-submenu sidebar-submenu-btn\" *ngIf=\"sidebarSubmenu2\">\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\"> Baby</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Toddler</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Child</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Tween</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Teenager</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">18+</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">21+</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">20s</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">30s</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">40s</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">50s</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Senior</a>\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Only</a>\n              </div>\n            </li>\n            <li class=\"sidebar-dropdown\">\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu3=!sidebarSubmenu3\">\n                <i class=\"far fa-gem\"></i>\n                <span>Ethnicity</span>\n              </a>\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu3\">\n                <ul>\n                  <li>\n                    <a href=\"javascript:void(0)\">General</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Panels</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Tables</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Icons</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Forms</a>\n                  </li>\n                </ul>\n              </div>\n            </li>\n            <li class=\"sidebar-dropdown\">\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu4=!sidebarSubmenu4\">\n                <i class=\"fa fa-chart-line\"></i>\n                <span>Location</span>\n              </a>\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu4\">\n                <ul>\n                  <li>\n                    <a href=\"javascript:void(0)\">Pie chart</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Line chart</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Bar chart</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Histogram</a>\n                  </li>\n                </ul>\n              </div>\n            </li>\n            <li class=\"sidebar-dropdown\">\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu5=!sidebarSubmenu5\">\n                <i class=\"fa fa-globe\"></i>\n                <span>Color</span>\n              </a>\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu5\">\n                <ul>\n                  <li>\n                    <a href=\"javascript:void(0)\">Google maps</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Open street map</a>\n                  </li>\n                </ul>\n              </div>\n            </li>\n             <li class=\"sidebar-dropdown\">\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu6=!sidebarSubmenu6\">\n                <i class=\"fa fa-globe\"></i>\n                <span>Shot Details</span>\n              </a>\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu6\">\n                <ul>\n                  <li>\n                    <a href=\"javascript:void(0)\">Google maps</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Open street map</a>\n                  </li>\n                </ul>\n              </div>\n            </li>\n             <li class=\"sidebar-dropdown\">\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu7=!sidebarSubmenu7\">\n                <i class=\"fa fa-globe\"></i>\n                <span>Camera Type</span>\n              </a>\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu7\">\n                <ul>\n                  <li>\n                    <a href=\"javascript:void(0)\">Google maps</a>\n                  </li>\n                  <li>\n                    <a href=\"javascript:void(0)\">Open street map</a>\n                  </li>\n                </ul>\n              </div>\n            </li>\n           \n          </ul>\n        </div>\n        <!-- sidebar-menu  -->\n      </div>\n      <!-- sidebar-content  -->\n      <div class=\"sidebar-footer\">\n        <a href=\"javascript:void(0)\">\n          <i class=\"fa fa-bell\"></i>\n          <span class=\"badge badge-pill badge-warning notification\">3</span>\n        </a>\n        <a href=\"javascript:void(0)\">\n          <i class=\"fa fa-envelope\"></i>\n          <span class=\"badge badge-pill badge-success notification\">7</span>\n        </a>\n        <a href=\"javascript:void(0)\">\n          <i class=\"fa fa-cog\"></i>\n          <span class=\"badge-sonar\"></span>\n        </a>\n        <a href=\"javascript:void(0)\">\n          <i class=\"fa fa-power-off\"></i>\n        </a>\n      </div>\n    </nav>\n    <!-- sidebar-wrapper  -->\n    <main class=\"page-content\">\n      <main class=\"main-content\">\n          <div class=\"search_m header_serach mt-3 mb-3\">\n              <div class=\"input-group search-bar\">\n                  <div class=\"input-group-btn\" ngbDropdown >\n                      <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\n                        <span *ngIf='searchData.productType == 3'>Photos + Videos</span>\n                        <span *ngIf='searchData.productType == 1'>Photos Only</span>\n                        <span *ngIf='searchData.productType == 2'>Videos Only</span>\n                      </button>\n                      <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(3)\" ngbDropdownItem>Photos + Videos</a>\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(1)\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(2)\" ngbDropdownItem>Videos Only</a>\n                      </div>\n                  </div>\n                  <input type=\"text\" [(ngModel)]=\"searchData.search\" #ctrl=\"ngModel\" (keydown)=\"onKeydown($event)\" class=\"form-control\" aria-label=\"Text input with dropdown button\">\n                  <i class=\"fa fa-camera\"></i>\n              </div>\n          </div>\n          <div class=\"bg-dark search_menu_l\">\n            <ul class=\"search_menu search_menu col-md-6 m-auto col-sm-6\">\n              <li class=\"active\"><a href=\"javascript:void(0)\">CURATED</a></li>\n              <li><a href=\"javascript:void(0)\">LATEST</a></li>\n              <li><a href=\"javascript:void(0)\">EMERGING</a></li>\n              <li><a href=\"javascript:void(0)\">POPULAR</a></li>\n            </ul>\n          </div>\n          <div class=\"clearfix\"></div>\n          <div class=\"photos mt-5 pt-5\">\n            <div class=\"row align-items-stretch\">  \n                <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\n                    <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\n                      <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\n                      <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\n                      <div class=\"photo-text-more\">\n                      \n                        <div class=\"photo-text-more\">\n                        <h3 class=\"heading\">{{aosimges.name}}</h3>\n                        <span class=\"meta\">{{aosimges.count}} Photos</span>\n                      </div>\n                      </div>\n                    </a>\n                </div>\n            </div>\n        \n            <div class=\"col-md-5 col-sm-6 col-12 m-auto\" *ngIf=\"aoslSliderImagesData.length !=0\">\n              <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \n    \n            </div>        \n          </div>\n    </main>\n  \n    </main>\n    <!-- page-content\" -->\n  </div>\n  \n  </div> \n  "

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

module.exports = "\n        <div style=\"position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1050;outline: 0;\">    \n            <div class=\"modal-dialog modal-lg\">\n                <div class=\"modal-content rounded-0\">\n                    <div class=\"modal-header border-0\">\n                        <button type=\"button\" class=\"close f-36\" data-dismiss=\"modal\" (click)=\"closePopup()\">×</button>\n                    </div>\n                    <div class=\"modal-body\">\n                        <div class=\"col-lg-8 offset-lg-2 col-md-8 offset-md- col-sm-10 offset-sm-1\">\n                            <div class=\"pl-5 pr-5 pt-2 pb-2\">           \n                                <div class=\"login-sec\">\n                                    <h2 class=\"text-center f-20 text-black mb-3\"><strong>Sign in to Image Footage</strong></h2>\n                                    <form class=\"loignForm\" [formGroup]=\"loginForm\" (ngSubmit)=\"onSubmit()\">\n                                        <div class=\"text-center\">\n                                            <button type=\"button\" class=\"btn btn-outline-dark pt-2 pb-2 pl-5 pr-5 rounded-0\"><span class=\"icon-facebook text-primary\"></span> Facebook</button>\n                                            <button type=\"button\" class=\"btn btn-outline-dark pt-2 pb-2 pl-5 pr-5 rounded-0 ml-2\"><span class=\"icon-google text-danger\"></span> Google</button>\n                                            <p class=\"pt-3 f-12\">All your activity will remain private.</p>\n                                            <div class=\"orSec\"><span class=\"ortextNew\">or</span></div>\n                                        </div>\n                                        \n                                        <div class=\"form-group mt-5\">\n                                            <label class=\"text-uppercase f-14 text-black\">Email </label>\n                                            <input type=\"email\" class=\"form-control\" formControlName=\"email\" name=\"email\" [ngClass]=\"{ 'is-invalid': submitted && f.email?.errors }\">\n                                            <div *ngIf=\"submitted && f.email?.errors\" class=\"invalid-feedback\">\n                                              <div *ngIf=\"f.email?.errors.required\">Email is required</div>\n                                              <div *ngIf=\"f.email?.errors.pattern\">Invalid email format</div>\n                                            </div>\n                                          </div>\n                                        <div class=\"form-group mt-3\">\n                                            <label class=\"text-uppercase f-14 text-black\">Password</label>\n                                            <input type=\"password\" class=\"form-control\" formControlName=\"password\"  [ngClass]=\"{ 'is-invalid': submitted && f.password?.errors }\">\n                                            <div *ngIf=\"submitted && f.password?.errors\" class=\"invalid-feedback\">\n                                              <div *ngIf=\"f.password?.errors.required\">Password is required</div>\n                                          </div>\n                                        </div>\n                \n                                        <a href=\"#\" class=\"f-14 text-primary\">Forgot Password?</a>\n                \n                                        <div class=\"form-group mt-3\">                                \n                                            <button type=\"submit\" [disabled]=\"loading\" class=\"btn btn-dark w-100 d-block rounded-0 p-3 text-white shadow-lg mb-3\">Submit</button>\n                                            <p class=\"f-12 text-center\">Not a member as yet?<a routerLink=\"/signUp\" class=\"text-primary\"> Register Now</a></p>\n                                        </div>      \n                                    </form>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        \n            <!-- <div class=\"modal-footer\">\n              <button type=\"button\" class=\"btn btn-outline-dark\" (click)=\"modal.close('Save click')\">Save</button>\n            </div> -->\n        </div>\n"

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

module.exports = "<div class=\"site-wrap mt-5 pt-5\">\n    <main class=\"main-content mt-5 pt-5\">\n      <div class=\"container photos\">\n        <div class=\"row\">\n          \n          <div class=\"col-md-10 pt-3\"  data-aos=\"fade-up\">\n            <h2 class=\"text-white mb-4\">Create your Image Footage account</h2>\n            <p>Already have an account? <a (click)=\"clickLoginPopup()\">Login</a></p>\n  \n                    <form [formGroup]=\"registerForm\" (ngSubmit)=\"onSubmit()\"  class=\"mt-5 pt-5\">\n  \n                      <div class=\"row form-group mb-5\">\n                          <div class=\"col-md-4 col-sm-4 mb-3 mb-md-0\">\n                              <label class=\"text-white\">First Name</label>\n                              <input type=\"text\" formControlName=\"firstName\" [ngClass]=\"{ 'is-invalid': submitted && f.firstName.errors }\" class=\"form-control text-white\">\n                              <div *ngIf=\"submitted && f.firstName.errors\" class=\"invalid-feedback\">\n                                  <div *ngIf=\"f.firstName.errors.required\">First Name is required</div>\n                              </div>\n                          </div>\n                          <div class=\"col-md-4 col-sm-4 \">\n                              <label class=\"text-white\" >Last Name</label>\n                              <input type=\"text\" formControlName=\"lastName\" id=\"lname\" [ngClass]=\"{ 'is-invalid': submitted && f.lastName.errors }\"  class=\"form-control text-white\">\n                              <div *ngIf=\"submitted && f.lastName.errors\" class=\"invalid-feedback\">\n                                  <div *ngIf=\"f.lastName.errors.required\">Last Name is required</div>\n                              </div>\n                          </div>\n                          <div class=\"col-md-4 col-sm-4 \">\n                            <label class=\"text-white\">Email</label> \n                            <input type=\"text\" formControlName=\"email\" id=\"email\" class=\"form-control text-white\" [ngClass]=\"{ 'is-invalid': submitted && f.email.errors }\">\n                            <div *ngIf=\"submitted && f.email.errors\" class=\"invalid-feedback\">\n                                <div *ngIf=\"f.email.errors.required\">Email is required</div>\n                                <div *ngIf=\"f.email.errors.email\">Email must be a valid email address</div>\n                            </div>\n                          </div>\n                      </div>\n  \n                      <div class=\"row form-group mb-5\">                        \n                        <div class=\"col-md-4 col-sm-4\">\n                            <label class=\"text-white\" >Password</label> \n                            <input type=\"password\" formControlName=\"password\" [ngClass]=\"{ 'is-invalid': submitted && f.password.errors }\" id=\"pswrd\" class=\"form-control text-white\">\n                            <div *ngIf=\"submitted && f.password.errors\" class=\"invalid-feedback\">\n                                <div *ngIf=\"f.password.errors.required\">Password is required</div>\n                                <div *ngIf=\"f.password.errors.minlength\">Password must be at least 6 characters</div>\n                            </div>\n                        </div>\n                        <div class=\"col-md-4 col-sm-4\">\n                            <label class=\"text-white\">Confirm Password</label> \n                            <input type=\"password\" formControlName=\"confirmPassword\" id=\"cnfpswrd\" [ngClass]=\"{ 'is-invalid': submitted && f.confirmPassword.errors }\" class=\"form-control text-white\">\n                            <div *ngIf=\"submitted && f.confirmPassword.errors\" class=\"invalid-feedback\">\n                                <div *ngIf=\"f.confirmPassword.errors.required\">Confirm Password is required</div>\n                                <div *ngIf=\"f.confirmPassword.errors.mustMatch\">Passwords must match</div>\n                            </div>\n                        </div>\n                        \n                        <div class=\"col-md-4 col-sm-4\">\n                          <label class=\"text-white\">Job Title</label> \n                          <input type=\"text\" formControlName=\"jobTitle\" id=\"jobTitle\" [ngClass]=\"{ 'is-invalid': submitted && f.jobTitle.errors }\" class=\"form-control text-white\">\n                          <div *ngIf=\"submitted && f.jobTitle.errors\" class=\"invalid-feedback\">\n                            <div *ngIf=\"f.jobTitle.errors.required\">JobTitle is required</div>\n                          </div>\n                        </div>\n                      </div>\n                \n                      <div class=\"row form-group mb-5\">\n                        <div class=\"col-md-4 col-sm-4\">\n                          <label class=\"text-white\">Company</label> \n                          <input type=\"text\" id=\"companyName\" formControlName=\"company\" [ngClass]=\"{ 'is-invalid': submitted && f.company.errors }\" class=\"form-control\">\n                          <div *ngIf=\"submitted && f.company.errors\" class=\"invalid-feedback\">\n                            <div *ngIf=\"f.company.errors.required\">Company is required</div>\n                          </div>\n                        </div>\n                        <div class=\"col-md-4 col-sm-4\">\n                          <label class=\"text-white\">Phone</label> \n                          <input type=\"text\" id=\"phne\" formControlName=\"phoneNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.phoneNumber.errors }\" class=\"form-control\">\n                          <div *ngIf=\"submitted && f.phoneNumber.errors\" class=\"invalid-feedback\">\n                            <div *ngIf=\"f.phoneNumber.errors.required\">PhoneNumber is required</div>\n                          </div>\n                        </div>\n                        \n                        <div class=\"col-md-4 col-sm-4\">\n                          <label class=\"text-white\">Mobile Number</label> \n                          <input type=\"text\" id=\"mbnum\" formControlName=\"mobileNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.mobileNumber.errors }\" class=\"form-control\">\n                          <div *ngIf=\"submitted && f.mobileNumber.errors\" class=\"invalid-feedback\">\n                            <div *ngIf=\"f.mobileNumber.errors.required\">MobileNumber is required</div>\n                            <div *ngIf=\"f.mobileNumber.errors.minlength || f.mobileNumber.errors.maxlength\">Mobile number should be 10 digits</div>\n                          </div>\n                        </div>\n                      </div>\n                      \n                      <div class=\"row form-group mb-5\">\n                        <div class=\"col-md-4 col-sm-4\">\n                            <label class=\"text-white\" for=\"country\">Slect Country</label>                           \n                            <select class=\"form-control  text-white\" id=\"select-language1\" onchange=console.log(this.value)> <option value=php>India</option> <option value=javascript>Australia</option> <option value=python>Srilanka</option> <option value=java>Pakistan</option> </select> \n                        </div>\n                        <div class=\"col-md-4 col-sm-4\">\n                            <label class=\"text-white\" for=\"state\">Select State</label>                           \n                            <select class=\"form-control  text-white\" id=\"select-language2\" onchange=console.log(this.value)> <option value=php>India</option> <option value=javascript>Australia</option> <option value=python>Srilanka</option> <option value=java>Pakistan</option> </select> \n                        </div>                        \n                        <div class=\"col-md-4 col-sm-4\">\n                            <label class=\"text-white\" for=\"city\">Select City</label> \n                            <select class=\"form-control  text-white\" id=\"select-language3\" onchange=console.log(this.value)> <option value=php>India</option> <option value=javascript>Australia</option> <option value=python>Srilanka</option> <option value=java>Pakistan</option> </select> \n                        </div>\n                      </div>\n  \n                      <div class=\"row form-group mb-5\">\n                          <div class=\"col-md-4 col-sm-4\">\n                            <label class=\"text-white\" for=\"zipCode\">Zip Code</label> \n                            <input type=\"text\" id=\"zipCode\" class=\"form-control\">\n                          </div>\n                          \n                          <div class=\"col-md-8 col-sm-8\">\n                            <label class=\"text-white\" for=\"message\">Address</label> \n                            <textarea name=\"message\" id=\"message\" cols=\"5\" rows=\"1\" class=\"form-control\" placeholder=\"\"></textarea>\n                          </div>                        \n                      </div>\n                      \n                      <div class=\"row form-group mb-5\">\n                          <div class=\"custom-control custom-checkbox\">\n                              <input type=\"checkbox\" class=\"custom-control-input\" formControlName=\"iagree\" [ngClass]=\"{ 'is-invalid': submitted && f.iagree.errors }\" id=\"customCheck\">\n                              <label class=\"custom-control-label\" for=\"customCheck\"> Make me an Approved Client* with the ability to license and download images online without a credit card.</label>\n                              <div *ngIf=\"submitted && f.iagree.errors\" class=\"invalid-feedback\">\n                                  <div *ngIf=\"f.iagree.errors.required\">Please accept Terms & Conditions</div>\n                              </div>   \n                          </div>\n                      </div>\n                    \n                      <div class=\"row form-group text-center\">\n                        <div class=\"col-md-12\">\n                          <button [disabled]=\"loading\" type=\"submit\" class=\"btn btn-warning btn-md text-white\">Create Account</button>\n                        </div>\n                      </div>\n  \n          \n                    </form>\n                 \n          \n          </div>\n  \n        </div>\n  \n        \n      </div>\n    </main>\n  \n  </div>\n\n  <ng-container *ngIf=\"showloginPopup\">\n      <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\n  </ng-container>"

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

module.exports = "<section>\n  \n  <div class=\"container\">\n          <div class=\"card pb-3 shadow-sm\">            \n            <form method=\"#\">\n              <div class=\"table-responsive\">\n                <table class=\"table cart-table\">\n                  <tbody>\n                    <tr *ngFor=\"let wishList of wishListDataItems;let i= index\">\n                      <td width=\"25%\" align=\"center\">\n                          <div class=\"product-info\">\n                              <a href=\"javascript:void(0)\">\n                                <img src=\"assets/images/{{wishList.imgPath}}\" alt=\"product-img\">\n                              </a>\n                              <div class=\"pt-3 cart_option\">\n                                  <a href=\"javascript:void(0)\" class=\"f-22\"><i class=\"fa fa-plus-circle\"></i></a>\n                                  <a href=\"javascript:void(0)\" class=\"f-22 pl-1\"><i class=\"fa fa-times-circle\"></i></a>\n                              </div>\n                          </div>                       \n                      </td>                      \n                      <td width=\"50%\">\n                         <p class=\"mb-1 text-black f-18\"><strong>{{wishList.name}}</strong></p>\n                         <p class=\"mb-1 f-16\"><strong>Size:</strong>  {{wishList.size}}</p>\n                         <p class=\"mb-1\">{{wishList.info}}</p>                       \n                      </td>\n                       <td width=\"25%\" align=\"right\"><p class=\"f-18 text-black\"><strong>${{wishList.price}} USD</strong></p>                      \n                       </td>\n                    </tr>\n                  </tbody>\n                </table>\n              </div>\n\n              <hr>\n            \n                <div class=\"col-12\">\n                <div class=\"p-3 row\">\n                  <div class=\"col-md-4 col-sm-4 col-lg-4\">\n                  <a href=\"javascript:void()\" id=\"promocode\">Have a promo code ?</a>\n                  <div class=\" show-promocode\">\n                  <div class=\"row\">\n                    <div class=\"col-md-8 col-sm-8 col-lg-8\">                        \n                      <input type=\"text\" name=\"\" class=\"form-control\" placeholder=\"Coupon Code\">\n                    </div>\n                    <div class=\"col-md-4 col-sm-4 col-lg-4 pl-1\">                        \n                      <button class=\"btn btn-success\">Apply</button>\n                    </div>\n                  </div>\n                  </div>\n                </div>\n                 <div class=\"col-md-8 col-sm-8 col-lg-8\">\n                  <ul class=\"list-unstyled text-right text-black f-18 text-black\">\n                    <li class=\"pb-3 fw-6 \">Sub Total <span class=\"d-inline-block w-100px\">${{showTotalPrice()}}.00</span></li>\n                    <li class=\"pb-5 fw-6 \">UK Vat <span class=\"d-inline-block w-100px\">$10.00</span></li>\n                    <li class=\"pb-2 fw-8 f-22\">Grand Total <span class=\"d-inline-block w-100px\">${{showTotalPrice() + 10}}.00</span></li>\n                  </ul>\n                  </div>\n                  </div>\n                  <div class=\"my-3\">\n                   <hr>\n              <a href=\"javascript:void(0)\"  class=\"btn btn-success float-right pt-3 pb-3 pl-5 pr-5 f-20 text-uppercase\" (click)=\"redirectToCheckout()\"><strong>Checkout</strong></a>\n              </div>\n                </div>\n              \n             \n            </form>\n          </div>\n          \n  </div>\n</section>"

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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var imageFooterHelper = /** @class */ (function () {
    function imageFooterHelper() {
    }
    // custom validator to check that two fields match
    imageFooterHelper.prototype.mustMatch = function (controlName, matchingControlName) {
        return function (formGroup) {
            var control = formGroup.controls[controlName];
            var matchingControl = formGroup.controls[matchingControlName];
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
    };
    imageFooterHelper.prototype.shuffleArray = function (array) {
        var m = array.length, t, i;
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
    };
    imageFooterHelper = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({ providedIn: 'root' })
    ], imageFooterHelper);
    return imageFooterHelper;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var AboutUsComponent = /** @class */ (function () {
    function AboutUsComponent() {
    }
    AboutUsComponent.prototype.ngOnInit = function () {
    };
    AboutUsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-about-us',
            template: __webpack_require__(/*! raw-loader!./about-us.component.html */ "./node_modules/raw-loader/index.js!./src/app/about-us/about-us.component.html"),
            styles: [__webpack_require__(/*! ./about-us.component.css */ "./src/app/about-us/about-us.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
    ], AboutUsComponent);
    return AboutUsComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
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















var routes = [
    { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
    { path: 'dashboard', component: _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_3__["DashboardComponent"] },
    { path: 'detail/:id', component: _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_5__["HeroDetailComponent"] },
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
var AppRoutingModule = /** @class */ (function () {
    function AppRoutingModule() {
    }
    AppRoutingModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
            imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forRoot(routes)],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
        })
    ], AppRoutingModule);
    return AppRoutingModule;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");



var AppComponent = /** @class */ (function () {
    function AppComponent(router, actRoute) {
        this.router = router;
        this.actRoute = actRoute;
        this.title = 'Image Footage';
        this.footerEle = true;
    }
    AppComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.sub = this.router.events.subscribe(function (event) {
            if (event instanceof _angular_router__WEBPACK_IMPORTED_MODULE_2__["NavigationEnd"]) {
                if (event.url.includes("/search?")) {
                    _this.footerEle = false;
                }
                else {
                    _this.footerEle = true;
                }
            }
        });
    };
    AppComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-root',
            template: __webpack_require__(/*! raw-loader!./app.component.html */ "./node_modules/raw-loader/index.js!./src/app/app.component.html"),
            styles: [__webpack_require__(/*! ./app.component.css */ "./src/app/app.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"]])
    ], AppComponent);
    return AppComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/platform-browser */ "./node_modules/@angular/platform-browser/fesm5/platform-browser.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm5/http.js");
/* harmony import */ var _angular_http__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/http */ "./node_modules/@angular/http/fesm5/http.js");
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
/* harmony import */ var _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! @ng-bootstrap/ng-bootstrap */ "./node_modules/@ng-bootstrap/ng-bootstrap/fesm5/ng-bootstrap.js");
/* harmony import */ var _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./contact-us/contact-us.component */ "./src/app/contact-us/contact-us.component.ts");
/* harmony import */ var _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! ./terms-and-conditions/terms-and-conditions.component */ "./src/app/terms-and-conditions/terms-and-conditions.component.ts");
/* harmony import */ var _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ./privacy-policy/privacy-policy.component */ "./src/app/privacy-policy/privacy-policy.component.ts");
/* harmony import */ var _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ./licence-agreement/licence-agreement.component */ "./src/app/licence-agreement/licence-agreement.component.ts");
/* harmony import */ var _login_login_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ./login/login.component */ "./src/app/login/login.component.ts");
/* harmony import */ var _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ./checkout/checkout.component */ "./src/app/checkout/checkout.component.ts");

























var AppModule = /** @class */ (function () {
    function AppModule() {
    }
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
    return AppModule;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");




var CheckoutComponent = /** @class */ (function () {
    function CheckoutComponent(authenticationService, router) {
        this.authenticationService = authenticationService;
        this.router = router;
        this.wishListDataItems = [];
        this.priceArray = [];
    }
    CheckoutComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.authenticationService.getcartItemsData()
            .subscribe(function (data) {
            _this.wishListDataItems = data;
            _this.wishListDataItems.forEach(function (element) {
                _this.priceArray.push(element.price);
            });
        }, function (error) {
        });
    };
    CheckoutComponent.prototype.showTotalPrice = function () {
        return this.priceArray.reduce(function (acc, val) { return acc + val; }, 0);
    };
    CheckoutComponent.prototype.goToWishList = function () {
        this.router.navigate(['/wishlist']);
    };
    CheckoutComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-checkout',
            template: __webpack_require__(/*! raw-loader!./checkout.component.html */ "./node_modules/raw-loader/index.js!./src/app/checkout/checkout.component.html"),
            styles: [__webpack_require__(/*! ./checkout.component.css */ "./src/app/checkout/checkout.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
    ], CheckoutComponent);
    return CheckoutComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var ContactUsComponent = /** @class */ (function () {
    function ContactUsComponent() {
    }
    ContactUsComponent.prototype.ngOnInit = function () {
    };
    ContactUsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-contact-us',
            template: __webpack_require__(/*! raw-loader!./contact-us.component.html */ "./node_modules/raw-loader/index.js!./src/app/contact-us/contact-us.component.html"),
            styles: [__webpack_require__(/*! ./contact-us.component.css */ "./src/app/contact-us/contact-us.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
    ], ContactUsComponent);
    return ContactUsComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");





var DashboardComponent = /** @class */ (function () {
    function DashboardComponent(heroService, dataHelper, router) {
        this.heroService = heroService;
        this.dataHelper = dataHelper;
        this.router = router;
        this.heroes = [];
        this.carouselSliderImages = [];
        this.aoslSliderImages = [];
        this.aoslSliderImagesData = [];
        this.randomNumber = 0;
        this.searchBoxLabel = 3;
        this.page = 1;
        this.pageSize = 40;
        this.aosSliderSizes = [];
    }
    DashboardComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.heroService.getcarouselSliderImages()
            .subscribe(function (carouselSliderImages) {
            _this.carouselSliderImages = carouselSliderImages;
        });
        this.heroService.getAosSliderImages()
            .subscribe(function (aoslSliderImages) {
            _this.aoslSliderImages = aoslSliderImages.media;
            _this.aoslSliderImagesData = aoslSliderImages.media;
            _this.maintainAosSlider();
        });
    };
    DashboardComponent.prototype.getClassName = function (ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    };
    DashboardComponent.prototype.searchAosData = function (search) {
        // debounceTime(400),
        if (search.trim().length > 2) {
            this.router.navigate(['/search'], { queryParams: { type: this.searchBoxLabel, keyword: search.trim() } });
        }
    };
    DashboardComponent.prototype.maintainAosSlider = function () {
        var _this = this;
        var i = 4, j = 0;
        var randArr = [[6, 2, 3, 1], [5, 2, 3, 2], [4, 3, 2, 3], [3, 2, 3, 4], [3, 1, 6, 2], [4, 4, 2, 2], [5, 4, 2, 1], [6, 4, 1, 1], [4, 2, 4, 2], [3, 4, 3, 2]];
        var mathRandom = Math.floor(Math.random() * 10);
        this.aoslSliderImagesData.forEach(function (ele) {
            if (i > j) {
                // console.log(mathRandom)
                ele.eleClass = randArr[mathRandom][j];
                j = j + 1;
                if (j == i) {
                    _this.dataHelper.shuffleArray(randArr);
                    j = 0;
                    mathRandom = Math.floor(Math.random() * 10);
                }
            }
        });
    };
    DashboardComponent.prototype.searchDropDownClick = function (type) {
        this.searchBoxLabel = type;
    };
    DashboardComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-dashboard',
            template: __webpack_require__(/*! raw-loader!./dashboard.component.html */ "./node_modules/raw-loader/index.js!./src/app/dashboard/dashboard.component.html"),
            styles: [__webpack_require__(/*! ./dashboard.component.css */ "./src/app/dashboard/dashboard.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_3__["imageFooterHelper"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]])
    ], DashboardComponent);
    return DashboardComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var FooterComponent = /** @class */ (function () {
    function FooterComponent() {
    }
    FooterComponent.prototype.ngOnInit = function () {
    };
    FooterComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-footer',
            template: __webpack_require__(/*! raw-loader!./footer.component.html */ "./node_modules/raw-loader/index.js!./src/app/footer/footer.component.html"),
            styles: [__webpack_require__(/*! ./footer.component.css */ "./src/app/footer/footer.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
    ], FooterComponent);
    return FooterComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! aos */ "./node_modules/aos/dist/aos.js");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(aos__WEBPACK_IMPORTED_MODULE_4__);





var HeaderComponent = /** @class */ (function () {
    function HeaderComponent(router, authenticationService) {
        var _this = this;
        this.router = router;
        this.authenticationService = authenticationService;
        this.showloginPopup = false;
        this.authenticationService.currentUser.subscribe(function (x) {
            _this.currentUser = x;
        });
    }
    HeaderComponent.prototype.ngOnInit = function () {
        aos__WEBPACK_IMPORTED_MODULE_4__["init"]();
    };
    HeaderComponent.prototype.clickLoginPopup = function () {
        this.showloginPopup = true;
    };
    HeaderComponent.prototype.hideLoginPopup = function (event) {
        this.showloginPopup = false;
        this.router.navigate(['/']);
    };
    HeaderComponent.prototype.logout = function () {
        this.authenticationService.logout();
        this.router.navigate(['/dashboard']);
    };
    HeaderComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-header',
            template: __webpack_require__(/*! raw-loader!./header.component.html */ "./node_modules/raw-loader/index.js!./src/app/header/header.component.html"),
            styles: [__webpack_require__(/*! ./header.component.css */ "./src/app/header/header.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"]])
    ], HeaderComponent);
    return HeaderComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/fesm5/common.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");
/* harmony import */ var util__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! util */ "./node_modules/util/util.js");
/* harmony import */ var util__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(util__WEBPACK_IMPORTED_MODULE_6__);







var HeroDetailComponent = /** @class */ (function () {
    function HeroDetailComponent(route, heroService, location, dataHelper, authenticationService, router) {
        var _this = this;
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
        this.authenticationService.currentUser.subscribe(function (x) {
            _this.currentUser = x;
        });
    }
    HeroDetailComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.getcategoryCarouselImages();
        this.getDetailinfo();
        this.authenticationService.currentUser.subscribe(function (x) {
            _this.currentUser = x;
        });
        this.heroService.getMarketdeatils()
            .subscribe(function (data) {
            _this.marketDetails = data;
        });
        this.heroService.getAosSliderImages()
            .subscribe(function (aoslSliderImages) {
            _this.aoslSliderImagesData = aoslSliderImages;
            //let tempCarouselSlider= this.chunkArray(aoslSliderImages, 4);
            // this.aoslSliderImagesData = JSON.parse(JSON.stringify(aoslSliderImages));
            var randArr = [4, 3, 2, 3];
            var i = 4, j = 0;
            _this.aoslSliderImagesData.forEach(function (ele) {
                if (i > j) {
                    ele.eleClass = randArr[j];
                    j = j + 1;
                    if (j == i) {
                        _this.dataHelper.shuffleArray(randArr);
                        j = 0;
                    }
                }
            });
            // console.log(this.aoslSliderImagesData);
        });
    };
    HeroDetailComponent.prototype.getDetailinfo = function () {
        var _this = this;
        this.id = +this.route.snapshot.paramMap.get('id');
        this.heroService.getDetailPagedetails(this.id)
            .subscribe(function (data) {
            console.log(data);
            _this.detailPageInfo = data[0];
        });
    };
    HeroDetailComponent.prototype.getcategoryCarouselImages = function () {
        var _this = this;
        var id = +this.route.snapshot.paramMap.get('id');
        this.heroService.getcategoryCarouselImages(1)
            .subscribe(function (images) {
            if (!Object(util__WEBPACK_IMPORTED_MODULE_6__["isNullOrUndefined"])(images)) {
                _this.carouselSliderImages = images[0];
                var randArr_1 = [4, 3, 2, 3];
                var tempCarouselSlider = _this.chunkArray(_this.carouselSliderImages.categoryImages, 4);
                _this.carouselSliderImages.categoryImages = JSON.parse(JSON.stringify(tempCarouselSlider));
                for (var i = 0; i < _this.carouselSliderImages.categoryImages.length; i++) {
                    if (_this.carouselSliderImages.categoryImages[i].length < 4) {
                        var lessItem = 4 - _this.carouselSliderImages.categoryImages[i].length;
                        var newArray = tempCarouselSlider[0].splice(0, lessItem);
                        _this.carouselSliderImages.categoryImages[i] = _this.carouselSliderImages.categoryImages[i].concat(newArray);
                    }
                }
                _this.carouselSliderImages.categoryImages.forEach(function (element) {
                    var temp = 0;
                    _this.dataHelper.shuffleArray(randArr_1);
                    element.forEach(function (ele) {
                        ele.eleClass = randArr_1[temp];
                        temp = temp + 1;
                    });
                });
            }
        });
    };
    HeroDetailComponent.prototype.getClassName = function (ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    };
    HeroDetailComponent.prototype.addToCheckoutItem = function (id) {
        if (!this.currentUser) {
            this.showloginPopup = true;
        }
        else {
            this.addedCartItem = !this.addedCartItem;
            this.checkoutArray.push(id);
            // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated
            localStorage.setItem('checkoutAray', this.checkoutArray);
            this.router.navigate(['/wishlist']);
        }
    };
    /* showCartLabel(){
       let addCart = this.checkoutArray.find(ele=>ele == this.id);
       if(isNullOrUndefined(addCart))
             this.addedCartItem=false;
       else
         this.addedCartItem=true;
     }*/
    HeroDetailComponent.prototype.chunkArray = function (myArray, chunk_size) {
        var results = [];
        while (myArray.length) {
            results.push(myArray.splice(0, chunk_size));
        }
        return results;
    };
    HeroDetailComponent.prototype.hideLoginPopup = function (event) {
        this.showloginPopup = false;
        if (event) {
            this.addToCheckoutItem(this.id);
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
    return HeroDetailComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! rxjs */ "./node_modules/rxjs/_esm5/index.js");
/* harmony import */ var _hero__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../hero */ "./src/app/hero.ts");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");







var HeroSearchComponent = /** @class */ (function () {
    function HeroSearchComponent(heroService, route, dataHelper) {
        this.heroService = heroService;
        this.route = route;
        this.dataHelper = dataHelper;
        this.searchTerms = new rxjs__WEBPACK_IMPORTED_MODULE_2__["Subject"]();
        this.randomNumber = 0;
        this.searchBoxLabel = 'all';
        this.page = 1;
        this.pageSize = 12;
        this.sidebarSubmenu1 = false;
        this.sidebarSubmenu2 = false;
        this.sidebarSubmenu3 = false;
        this.sidebarSubmenu4 = false;
        this.sidebarSubmenu5 = false;
        this.sidebarSubmenu6 = false;
        this.sidebarSubmenu7 = false;
        this.name = '';
        this.carouselSliderImages = [];
        this.aoslSliderImages = [];
        this.aoslSliderImagesData = [];
        this.searchData = new _hero__WEBPACK_IMPORTED_MODULE_3__["Search"]();
    }
    // Push a search term into the observable stream.
    HeroSearchComponent.prototype.search = function (term) {
        this.searchTerms.next(term);
    };
    HeroSearchComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.sub = this.route
            .queryParams
            .subscribe(function (params) {
            console.log(params);
            _this.searchData.productType = params.type;
            _this.searchData.search = params.keyword;
            _this.heroService.getAosSliderSearchImages(_this.searchData)
                .subscribe(function (aoslSliderImages) {
                // console.log(aoslSliderImages);
                // console.log(aoslSliderImages.filter(ele=> ele.name.includes(this.name)));
                _this.aoslSliderImages = aoslSliderImages.media;
                _this.maintainSearchData(aoslSliderImages.media);
            });
        });
        this.heroService.getcarouselSliderImages()
            .subscribe(function (carouselSliderImages) {
            _this.carouselSliderImages = carouselSliderImages;
        });
    };
    HeroSearchComponent.prototype.searchDropDownClick = function (type) {
        this.searchData.productType = type;
    };
    HeroSearchComponent.prototype.getClassName = function (ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    };
    HeroSearchComponent.prototype.onKeydown = function (event) {
        if (event.key === "Enter") {
            // console.log(this.name);
            this.maintainSearchData(this.aoslSliderImages);
        }
    };
    HeroSearchComponent.prototype.maintainSearchData = function (aoslSliderImages) {
        var _this = this;
        this.aoslSliderImagesData = aoslSliderImages;
        if (this.searchData.productType == 1) {
            this.aoslSliderImagesData = this.aoslSliderImages.filter(function (ele) { return ele.mimetype == 'image/jpeg'; });
        }
        else if (this.searchData.productType == 2) {
            this.aoslSliderImagesData = this.aoslSliderImages.filter(function (ele) { return ele.mimetype != 'image/jpeg'; });
        }
        else {
            this.aoslSliderImagesData = this.aoslSliderImages;
        }
        if (this.searchData.search.length > 2) {
            this.aoslSliderImagesData = this.aoslSliderImagesData.filter(function (ele) { return ele.title.includes(_this.name.trim()); });
        }
        this.maintainAosSlider();
    };
    HeroSearchComponent.prototype.maintainAosSlider = function () {
        var _this = this;
        var i = 4, j = 0;
        var randArr = [[6, 2, 3, 1], [5, 2, 3, 2], [4, 3, 2, 3], [3, 2, 3, 4], [3, 1, 6, 2], [4, 4, 2, 2], [5, 4, 2, 1], [6, 4, 1, 1], [4, 2, 4, 2], [3, 4, 3, 2]];
        var mathRandom = Math.floor(Math.random() * 10);
        this.aoslSliderImagesData.forEach(function (ele) {
            if (i > j) {
                // console.log(mathRandom)
                ele.eleClass = randArr[mathRandom][j];
                j = j + 1;
                if (j == i) {
                    _this.dataHelper.shuffleArray(randArr);
                    j = 0;
                    mathRandom = Math.floor(Math.random() * 10);
                }
            }
        });
    };
    HeroSearchComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-hero-search',
            template: __webpack_require__(/*! raw-loader!./hero-search.component.html */ "./node_modules/raw-loader/index.js!./src/app/hero-search/hero-search.component.html"),
            styles: [__webpack_require__(/*! ./hero-search.component.css */ "./src/app/hero-search/hero-search.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_5__["ActivatedRoute"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_6__["imageFooterHelper"]])
    ], HeroSearchComponent);
    return HeroSearchComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm5/http.js");
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs */ "./node_modules/rxjs/_esm5/index.js");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm5/operators/index.js");
/* harmony import */ var _message_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./message.service */ "./src/app/message.service.ts");






var HeroService = /** @class */ (function () {
    function HeroService(http, messageService) {
        this.http = http;
        this.messageService = messageService;
        this.heroesUrl = 'http://ec2-18-218-154-217.us-east-2.compute.amazonaws.com/backend/api/'; // URL to web api
        this.carouselImagesUrl = 'api/carouselImages';
        this.aosImagesUrl = 'api/aosImages';
        this.httpOptions = {
            headers: new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({ 'Content-Type': 'application/json' })
        };
        this.currentUserSubject = new rxjs__WEBPACK_IMPORTED_MODULE_3__["BehaviorSubject"](JSON.parse(localStorage.getItem('currentUser')));
        this.currentUser = this.currentUserSubject.asObservable();
    }
    Object.defineProperty(HeroService.prototype, "currentUserValue", {
        get: function () {
            return this.currentUserSubject.value;
        },
        enumerable: true,
        configurable: true
    });
    /** GET Slider Images from the server */
    HeroService.prototype.getcarouselSliderImages = function () {
        var _this = this;
        var url = this.heroesUrl + "home";
        return this.http.get(this.carouselImagesUrl)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log('fetched carousel Images'); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getCarouselImages', [])));
    };
    /** GET Slider Images from the server */
    /** GET Slider Images from the server */
    HeroService.prototype.getAosSliderImages = function () {
        var url = this.heroesUrl + "home";
        return this.http.get(url)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (aosImagesUrl) {
            return aosImagesUrl.api.items;
            // return aosImagesUrl;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getCarouselImages', [])));
    };
    HeroService.prototype.getAosSliderSearchImages = function (searchData) {
        var url = this.heroesUrl + "search";
        return this.http.post(url, searchData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (searchResultSet) {
            return searchResultSet.api.items;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
    };
    HeroService.prototype.getLogin = function (email, password) {
        var _this = this;
        return this.http.post("api/userData", { email: email, password: password }, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (user) {
            console.log(user);
            localStorage.setItem('currentUser', JSON.stringify(user));
            _this.currentUserSubject.next(user);
            return user;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
    };
    HeroService.prototype.register = function (usrData) {
        return this.http.post("api/userData", usrData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (userInfo) {
            return true;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to register data")));
        ;
    };
    HeroService.prototype.logout = function () {
        localStorage.removeItem('currentUser');
        this.currentUserSubject.next(null);
    };
    HeroService.prototype.getcategoryCarouselImages = function (categoryId) {
        var _this = this;
        var url = "api/detailPageCarouselImages/?" + categoryId;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("fetched CarouselImages id=" + categoryId); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=" + categoryId)));
    };
    HeroService.prototype.getDetailPagedetails = function (id) {
        var _this = this;
        var url = "api/detailPageInfo/?" + id;
        //const url = `${this.heroesUrl}details/srima040/3/image`;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("fetched detail Page Info id=" + id); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=" + id)));
    };
    HeroService.prototype.getcartItemsData = function () {
        var _this = this;
        var params = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpParams"]();
        var url = "api/cartItemsData";
        params = params.append('actors', localStorage.getItem('checkoutAray'));
        // this.http.get(url, { params: params }) -- Modify when API integrated
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("fetched cart items data"); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id")));
    };
    HeroService.prototype.getMarketdeatils = function () {
        var _this = this;
        var url = "api/marketFreeze";
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("fetched market Info id"); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id")));
    };
    /** GET heroes from the server */
    HeroService.prototype.getHeroes = function () {
        var _this = this;
        return this.http.get(this.heroesUrl)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log('fetched heroes'); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getHeroes', [])));
    };
    /** GET hero by id. Return `undefined` when id not found */
    HeroService.prototype.getHeroNo404 = function (id) {
        var _this = this;
        var url = this.heroesUrl + "/?id=" + id;
        return this.http.get(url)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (heroes) { return heroes[0]; }), // returns a {0|1} element array
        Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (h) {
            var outcome = h ? "fetched" : "did not find";
            _this.log(outcome + " hero id=" + id);
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=" + id)));
    };
    /** GET hero by id. Will 404 if id not found */
    HeroService.prototype.getHero = function (id) {
        var _this = this;
        var url = this.heroesUrl + "/" + id;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("fetched hero id=" + id); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=" + id)));
    };
    /* GET heroes whose name contains search term */
    HeroService.prototype.searchHeroes = function (term) {
        var _this = this;
        if (!term.trim()) {
            // if not search term, return empty hero array.
            return Object(rxjs__WEBPACK_IMPORTED_MODULE_3__["of"])([]);
        }
        return this.http.get(this.heroesUrl + "/?name=" + term).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("found heroes matching \"" + term + "\""); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('searchHeroes', [])));
    };
    //////// Save methods //////////
    /** POST: add a new hero to the server */
    HeroService.prototype.addHero = function (hero) {
        var _this = this;
        return this.http.post(this.heroesUrl, hero, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (newHero) { return _this.log("added hero w/ id=" + newHero.id); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('addHero')));
    };
    /** DELETE: delete the hero from the server */
    HeroService.prototype.deleteHero = function (hero) {
        var _this = this;
        var id = typeof hero === 'number' ? hero : hero.id;
        var url = this.heroesUrl + "/" + id;
        return this.http.delete(url, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("deleted hero id=" + id); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('deleteHero')));
    };
    /** PUT: update the hero on the server */
    HeroService.prototype.updateHero = function (hero) {
        var _this = this;
        return this.http.put(this.heroesUrl, hero, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) { return _this.log("updated hero id=" + hero.id); }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('updateHero')));
    };
    /**
     * Handle Http operation that failed.
     * Let the app continue.
     * @param operation - name of the operation that failed
     * @param result - optional value to return as the observable result
     */
    HeroService.prototype.handleError = function (operation, result) {
        var _this = this;
        if (operation === void 0) { operation = 'operation'; }
        return function (error) {
            // TODO: send the error to remote logging infrastructure
            console.error(error); // log to console instead
            // TODO: better job of transforming error for user consumption
            _this.log(operation + " failed: " + error.message);
            // Let the app keep running by returning an empty result.
            return Object(rxjs__WEBPACK_IMPORTED_MODULE_3__["of"])(result);
        };
    };
    /** Log a HeroService message with the MessageService */
    HeroService.prototype.log = function (message) {
        this.messageService.add("HeroService: " + message);
    };
    HeroService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({ providedIn: 'root' }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"],
            _message_service__WEBPACK_IMPORTED_MODULE_5__["MessageService"]])
    ], HeroService);
    return HeroService;
}());



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
var Hero = /** @class */ (function () {
    function Hero() {
    }
    return Hero;
}());

var carouselSlider = /** @class */ (function () {
    function carouselSlider() {
    }
    return carouselSlider;
}());

var Category = /** @class */ (function () {
    function Category() {
    }
    return Category;
}());

var Search = /** @class */ (function () {
    function Search() {
    }
    return Search;
}());

var aosSlider = /** @class */ (function () {
    function aosSlider() {
    }
    return aosSlider;
}());

var userData = /** @class */ (function () {
    function userData() {
    }
    return userData;
}());

var carouselSliderImages = /** @class */ (function () {
    function carouselSliderImages() {
    }
    return carouselSliderImages;
}());

var detailPageInfo = /** @class */ (function () {
    function detailPageInfo() {
    }
    return detailPageInfo;
}());

var market = /** @class */ (function () {
    function market() {
    }
    return market;
}());

var cartItemData = /** @class */ (function () {
    function cartItemData() {
    }
    return cartItemData;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");



var HeroesComponent = /** @class */ (function () {
    function HeroesComponent(heroService) {
        this.heroService = heroService;
    }
    HeroesComponent.prototype.ngOnInit = function () {
        this.getHeroes();
    };
    HeroesComponent.prototype.getHeroes = function () {
        var _this = this;
        this.heroService.getHeroes()
            .subscribe(function (heroes) { return _this.heroes = heroes; });
    };
    HeroesComponent.prototype.add = function (name) {
        var _this = this;
        name = name.trim();
        if (!name) {
            return;
        }
        this.heroService.addHero({ name: name })
            .subscribe(function (hero) {
            _this.heroes.push(hero);
        });
    };
    HeroesComponent.prototype.delete = function (hero) {
        this.heroes = this.heroes.filter(function (h) { return h !== hero; });
        this.heroService.deleteHero(hero).subscribe();
    };
    HeroesComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-heroes',
            template: __webpack_require__(/*! raw-loader!./heroes.component.html */ "./node_modules/raw-loader/index.js!./src/app/heroes/heroes.component.html"),
            styles: [__webpack_require__(/*! ./heroes.component.css */ "./src/app/heroes/heroes.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]])
    ], HeroesComponent);
    return HeroesComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var LicenceAgreementComponent = /** @class */ (function () {
    function LicenceAgreementComponent() {
    }
    LicenceAgreementComponent.prototype.ngOnInit = function () {
    };
    LicenceAgreementComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-licence-agreement',
            template: __webpack_require__(/*! raw-loader!./licence-agreement.component.html */ "./node_modules/raw-loader/index.js!./src/app/licence-agreement/licence-agreement.component.html"),
            styles: [__webpack_require__(/*! ./licence-agreement.component.css */ "./src/app/licence-agreement/licence-agreement.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
    ], LicenceAgreementComponent);
    return LicenceAgreementComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm5/operators/index.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");






var LoginComponent = /** @class */ (function () {
    function LoginComponent(formBuilder, router, authenticationService) {
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
    LoginComponent.prototype.ngOnInit = function () {
        this.loginForm = this.formBuilder.group({
            email: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].compose([
                    _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required,
                    _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')
                ])],
            password: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
        });
    };
    Object.defineProperty(LoginComponent.prototype, "f", {
        // convenience getter for easy access to form fields
        get: function () { return this.loginForm.controls; },
        enumerable: true,
        configurable: true
    });
    LoginComponent.prototype.closePopup = function () {
        this.closeLoginPopup.emit(false);
    };
    LoginComponent.prototype.onSubmit = function () {
        var _this = this;
        this.submitted = true;
        // stop here if form is invalid
        if (this.loginForm.invalid) {
            return;
        }
        this.loading = true;
        this.authenticationService.getLogin(this.f.email.value, this.f.password.value)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["first"])())
            .subscribe(function (data) {
            console.log(data);
            _this.closeLoginPopup.emit(true);
        }, function (error) {
            _this.loading = false;
        });
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
    return LoginComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var MessageService = /** @class */ (function () {
    function MessageService() {
        this.messages = [];
    }
    MessageService.prototype.add = function (message) {
        this.messages.push(message);
    };
    MessageService.prototype.clear = function () {
        this.messages = [];
    };
    MessageService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({ providedIn: 'root' })
    ], MessageService);
    return MessageService;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _message_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../message.service */ "./src/app/message.service.ts");



var MessagesComponent = /** @class */ (function () {
    function MessagesComponent(messageService) {
        this.messageService = messageService;
    }
    MessagesComponent.prototype.ngOnInit = function () {
    };
    MessagesComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-messages',
            template: __webpack_require__(/*! raw-loader!./messages.component.html */ "./node_modules/raw-loader/index.js!./src/app/messages/messages.component.html"),
            styles: [__webpack_require__(/*! ./messages.component.css */ "./src/app/messages/messages.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_message_service__WEBPACK_IMPORTED_MODULE_2__["MessageService"]])
    ], MessagesComponent);
    return MessagesComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var PrivacyPolicyComponent = /** @class */ (function () {
    function PrivacyPolicyComponent() {
    }
    PrivacyPolicyComponent.prototype.ngOnInit = function () {
    };
    PrivacyPolicyComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-privacy-policy',
            template: __webpack_require__(/*! raw-loader!./privacy-policy.component.html */ "./node_modules/raw-loader/index.js!./src/app/privacy-policy/privacy-policy.component.html"),
            styles: [__webpack_require__(/*! ./privacy-policy.component.css */ "./src/app/privacy-policy/privacy-policy.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
    ], PrivacyPolicyComponent);
    return PrivacyPolicyComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm5/operators/index.js");







var SignUpComponent = /** @class */ (function () {
    function SignUpComponent(formBuilder, authenticationService, router, dataHelper) {
        this.formBuilder = formBuilder;
        this.authenticationService = authenticationService;
        this.router = router;
        this.dataHelper = dataHelper;
        this.loading = false;
        this.submitted = false;
        this.showloginPopup = false;
    }
    SignUpComponent.prototype.ngOnInit = function () {
        this.registerForm = this.formBuilder.group({
            firstName: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            lastName: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            password: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(6)]],
            confirmPassword: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            email: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].email]],
            jobTitle: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            company: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            mobileNumber: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(10), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(10)]],
            phoneNumber: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            iagree: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
        }, {
            validator: this.dataHelper.mustMatch('password', 'confirmPassword')
        });
    };
    Object.defineProperty(SignUpComponent.prototype, "f", {
        get: function () { return this.registerForm.controls; },
        enumerable: true,
        configurable: true
    });
    SignUpComponent.prototype.onSubmit = function () {
        var _this = this;
        this.submitted = true;
        // stop here if form is invalid
        if (this.registerForm.invalid) {
            return;
        }
        this.authenticationService.register(this.registerForm.value)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_6__["first"])())
            .subscribe(function (data) {
            _this.router.navigate(['/']);
        }, function (error) {
            _this.loading = false;
        });
    };
    SignUpComponent.prototype.clickLoginPopup = function () {
        this.showloginPopup = true;
    };
    SignUpComponent.prototype.hideLoginPopup = function (event) {
        this.showloginPopup = false;
        if (event) {
            this.router.navigate(['/dashboard']);
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
    return SignUpComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");


var TermsAndConditionsComponent = /** @class */ (function () {
    function TermsAndConditionsComponent() {
    }
    TermsAndConditionsComponent.prototype.ngOnInit = function () {
    };
    TermsAndConditionsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-terms-and-conditions',
            template: __webpack_require__(/*! raw-loader!./terms-and-conditions.component.html */ "./node_modules/raw-loader/index.js!./src/app/terms-and-conditions/terms-and-conditions.component.html"),
            styles: [__webpack_require__(/*! ./terms-and-conditions.component.css */ "./src/app/terms-and-conditions/terms-and-conditions.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
    ], TermsAndConditionsComponent);
    return TermsAndConditionsComponent;
}());



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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");




var WishlistComponent = /** @class */ (function () {
    function WishlistComponent(authenticationService, router) {
        this.authenticationService = authenticationService;
        this.router = router;
        this.wishListDataItems = [];
        this.priceArray = [];
    }
    WishlistComponent.prototype.ngOnInit = function () {
        var _this = this;
        // console.log(localStorage.getItem('checkoutAray'));
        this.authenticationService.getcartItemsData()
            .subscribe(function (data) {
            _this.wishListDataItems = data;
            _this.wishListDataItems.forEach(function (element) {
                _this.priceArray.push(element.price);
            });
        }, function (error) {
        });
    };
    WishlistComponent.prototype.showTotalPrice = function () {
        return this.priceArray.reduce(function (acc, val) { return acc + val; }, 0);
    };
    WishlistComponent.prototype.redirectToCheckout = function () {
        this.router.navigate(['/checkout']);
    };
    WishlistComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
            selector: 'app-wishlist',
            template: __webpack_require__(/*! raw-loader!./wishlist.component.html */ "./node_modules/raw-loader/index.js!./src/app/wishlist/wishlist.component.html"),
            styles: [__webpack_require__(/*! ./wishlist.component.css */ "./src/app/wishlist/wishlist.component.css")]
        }),
        tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
    ], WishlistComponent);
    return WishlistComponent;
}());



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
var environment = {
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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_platform_browser_dynamic__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/platform-browser-dynamic */ "./node_modules/@angular/platform-browser-dynamic/fesm5/platform-browser-dynamic.js");
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
//# sourceMappingURL=main-es5.js.map