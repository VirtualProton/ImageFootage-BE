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

module.exports = "<section class=\"mt-5\">\r\n  \r\n        <div class=\"container\"> \r\n    \r\n                            <div class=\"row\">\r\n                   <div class=\"col-lg-5 col-md-5 col-sm-6 bg-light\">\r\n                      <div class=\"card z-depth-0\">\r\n                     <form class=\"loignForm p-5\">\r\n                     <h3 class=\"f-20 mb-3\">BILLING ADDRESS</h3>\r\n                       <div class=\"row form-group\">\r\n                       <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                         <label>First Name</label>\r\n                         <input type=\"text\" class=\"form-control rounded-0\">\r\n                       </div>\r\n                      \r\n                       <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                         <label>Last Name</label>\r\n                         <input type=\"text\" class=\"form-control\">\r\n                       </div>\r\n                       \r\n                        </div>\r\n                        \r\n                     <div class=\"form-group\">\r\n                         <label>Street Address</label>\r\n                         <textarea  class=\"form-control rounded-0\" rows=\"2\" style=\"min-height:70px;\"></textarea>\r\n                       </div>\r\n                       \r\n                     <div class=\"form-group\">\r\n                         <label>City</label>\r\n                         <input type=\"text\" class=\"form-control rounded-0\">\r\n                       </div>\r\n                       \r\n                       <div class=\"form-group\">\r\n                         <label>Country</label>\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">India</option>\r\n                          <option value=\"\">Canada</option>\r\n                          <option value=\"\">USA</option>\r\n                          <option value=\"\">Aus</option>\r\n                         </select>\r\n                       </div>\r\n                       \r\n                       <div class=\"row form-group pt-4\">\r\n                       <div class=\"col-md-6 col-lg-6 col-sm-6\">\r\n                         <label>State/province</label>\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">India</option>\r\n                          <option value=\"\">Canada</option>\r\n                          <option value=\"\">USA</option>\r\n                          <option value=\"\">Aus</option>\r\n                         </select>\r\n                       </div>\r\n                       \r\n                       <div class=\"col-md-6 col-sm-6 col-lg-6\">\r\n                         <label>Zipcode</label>\r\n                         <input type=\"text\" class=\"form-control\">\r\n                       </div>\r\n                       </div>\r\n                       \r\n                       <div class=\"form-group pt-3\">\r\n                       \r\n                         <button type=\"button\" class=\"btn btn-success btn-block text-white p-3 text-uppercase\"><strong>Enter Address\r\n                         </strong></button>\r\n                         <div class=\"clearfix\"></div>\r\n                         <hr>\r\n                         <h3 class=\"f-20 mb-4 mt-5\">PAYMENT INFORMATION</h3>\r\n    \r\n                         <div class=\"row\">\r\n                           <div class=\"col-md-8 col-sm-8 col-lg-8 col-xs-8\">\r\n                             \r\n                             <div class=\"custom-control custom-radio\">\r\n        <input type=\"radio\" class=\"custom-control-input\" id=\"customRadio\" name=\"example1\" value=\"customEx\" checked=\"\">\r\n        <label class=\"custom-control-label\" for=\"customRadio\"><strong>Credit Card</strong></label>\r\n      </div>\r\n                           </div>\r\n    \r\n                           <div class=\"col-md-4 col-sm-4 col-lg-4 col-xs-4\">\r\n                             \r\n                             <span><img src=\"assets/images/visa.png\" class=\"border p-1\" height=\"24\"></span>\r\n                             <span><img src=\"assets/images/mastarcard.png\"  class=\"border p-1\"  height=\"24\"></span>\r\n                           </div>\r\n    \r\n                         </div>\r\n                          <div class=\"row form-group mt-4\">\r\n                       <div class=\"col-lg-12 col-md-12 col-sm-12\">\r\n                         <label>Credit Card Number</label>\r\n                         <input type=\"number\" class=\"form-control rounded-0\">\r\n                       </div>                  \r\n                        </div>\r\n    \r\n                       <div class=\"row form-group\">\r\n                      <div class=\"col-md-8 col-lg-8 col-sm-8\">\r\n                         <label>Expiry Date</label>\r\n                         <div class=\"row\">\r\n                          <div class=\"col-md-6 col-sm-6 col-lg-6\">\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">MM</option>\r\n                          <option value=\"\">01</option>\r\n                          <option value=\"\">02</option>\r\n                          <option value=\"\">03</option>\r\n                         </select>\r\n                       </div>\r\n                       <div class=\"col-md-6 col-sm-6 col-lg-6\">\r\n                         <select class=\"form-control\">\r\n                          <option value=\"\">YY</option>\r\n                          <option value=\"\">2019</option>\r\n                          <option value=\"\">2018</option>\r\n                          <option value=\"\">2017</option>\r\n                         </select>\r\n                       </div>\r\n                       </div>\r\n                       </div>\r\n                      \r\n                       <div class=\"col-lg-4 col-md-4 col-sm-4\">\r\n                         <label>Security Code</label>\r\n                         <input type=\"text\" class=\"form-control\" placeholder=\"CVV\">\r\n                       </div>\r\n                       \r\n                        </div>\r\n    \r\n                         <div class=\"row form-group\">\r\n                       <div class=\"col-lg-12 col-md-12 col-sm-12\">\r\n                         <label>Name on Card</label>\r\n                         <input type=\"text\" class=\"form-control rounded-0\">\r\n                       </div>                  \r\n                        </div>\r\n                        \r\n                       \r\n                       </div>\r\n                       \r\n                       \r\n                     </form>\r\n                   </div>\r\n                   \r\n                   \r\n                   </div>\r\n                   \r\n                   <div class=\"col-lg-7 col-md-7 col-sm-6\">\r\n                    <div class=\"card\">\r\n                    <div class=\"table-responsive\">\r\n                      <table class=\"table cart-table checkout-table\">\r\n                        <thead class=\"f-16\">\r\n                          <tr>\r\n                            <th colspan=\"2\"><h3 class=\"f-18\">CART</h3>\r\n                            <p class=\"mb-0\">2 Items</p></th>\r\n                            <th align=\"right\" class=\"text-right\"><button class=\"btn btn-default rounded-0\" (click)=\"goToWishList()\">Edit</button></th>                          \r\n                          </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                          <tr *ngFor=\"let checkout of wishListDataItems;let i= index\">\r\n                            <td width=\"25%\" align=\"center\">\r\n                              <div class=\"product-info\">\r\n                                <img src=\"assets/images/{{checkout.imgPath}}\" alt=\"product-img\" height=\"100\">\r\n                              </div>                             \r\n                            </td>                            \r\n                            <td width=\"50%\">\r\n                               <p class=\"mb-1 text-black\"><strong>{{checkout.name}}</strong></p>\r\n                               <p class=\"mb-1\"><strong>Size:</strong>  {{checkout.size}}</p>                              \r\n                            </td>\r\n                             <td width=\"25%\" align=\"right\"><p class=\"f-16 text-black\"><strong>${{checkout.price}}.00 USD</strong></p>                            \r\n                             </td>\r\n                          </tr>\r\n                        </tbody>\r\n                        <tfoot class=\"text-black\">\r\n                          <tr class=\"f-20\">\r\n                          <td></td>\r\n                            <td align=\"right\"><strong>TOTAL</strong></td>\r\n                            <td align=\"right\"><strong>${{showTotalPrice()}}.00 USD</strong></td>\r\n                          </tr>\r\n                           <tr class=\"f-16\">\r\n                          <td></td>\r\n                            <td align=\"right\"><strong>BALANCE DUE</strong></td>\r\n                            <td align=\"right\"><strong>${{showTotalPrice()}}.00 USD</strong></td>\r\n                          </tr>\r\n                        </tfoot>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n               </div>\r\n                \r\n            </div>\r\n        </div>\r\n      </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/contact-us/contact-us.component.html":
/*!********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/contact-us/contact-us.component.html ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<section class=\"banner-area relative\">\r\n    <div class=\"overlay overlay-bg\"></div>\r\n    <div class=\"banner-content text-center\">\r\n      <h1>Contact Us</h1>\r\n      <p>\r\n        Elementum libero hac leo integer. Risus hac parturient feugiat litora\r\n        <br />\r\n        cursus hendrerit bibendum per\r\n      </p>\r\n    </div>\r\n  </section>\r\n  <section class=\"contact-page-area section-gap\">\r\n    <div class=\"container\">\r\n      <div class=\"row\">\r\n       \r\n        <div class=\"col-lg-4 d-flex flex-column address-wrap\">\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\"><span class=\"icon-home2 mr-1\"></span></div>\r\n            <div class=\"contact-details\">\r\n              <h5>Binghamton, New York</h5>\r\n              <p>4343 Hinkle Deegan Lake Road</p>\r\n            </div>\r\n          </div>\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\">\r\n              <span class=\"icon-phone2 mr-1\"></span>\r\n            </div>\r\n            <div class=\"contact-details\">\r\n              <h5>00 (958) 9865 562</h5>\r\n              <p>Mon to Fri 9am to 6 pm</p>\r\n            </div>\r\n          </div>\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\"><span class=\"icon-envelope-o mr-1\"></span></div>\r\n            <div class=\"contact-details\">\r\n              <h5>support@colorlib.com</h5>\r\n              <p>Send us your query anytime!</p>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <div class=\"col-lg-8\">\r\n          <form\r\n            class=\"form-area contact-form text-right\"\r\n            id=\"myForm\"\r\n            action=\"mail.php\"\r\n            method=\"post\"\r\n          >\r\n            <div class=\"row\">\r\n              <div class=\"col-lg-6 form-group\">\r\n                <input\r\n                  name=\"name\"\r\n                  placeholder=\"Enter your name\"\r\n                  onfocus=\"this.placeholder = ''\"\r\n                  onblur=\"this.placeholder = 'Enter your name'\"\r\n                  class=\"common-input mb-20 form-control\"\r\n                  required=\"\"\r\n                  type=\"text\"\r\n                />\r\n\r\n                <input\r\n                  name=\"email\"\r\n                  placeholder=\"Enter email address\"\r\n                  pattern=\"[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{1,63}$\"\r\n                  onfocus=\"this.placeholder = ''\"\r\n                  onblur=\"this.placeholder = 'Enter email address'\"\r\n                  class=\"common-input mb-20 form-control\"\r\n                  required=\"\"\r\n                  type=\"email\"\r\n                />\r\n\r\n                <input\r\n                  name=\"subject\"\r\n                  placeholder=\"Enter subject\"\r\n                  onfocus=\"this.placeholder = ''\"\r\n                  onblur=\"this.placeholder = 'Enter subject'\"\r\n                  class=\"common-input mb-20 form-control\"\r\n                  required=\"\"\r\n                  type=\"text\"\r\n                />\r\n              </div>\r\n              <div class=\"col-lg-6 form-group\">\r\n                <textarea\r\n                  class=\"common-textarea form-control\"\r\n                  name=\"message\"\r\n                  placeholder=\"Enter Messege\"\r\n                  onfocus=\"this.placeholder = ''\"\r\n                  onblur=\"this.placeholder = 'Enter Messege'\"\r\n                  required=\"\"\r\n                ></textarea>\r\n              </div>\r\n              <div class=\"col-lg-12\">\r\n                <div class=\"alert-msg\" style=\"text-align: left;\"></div>\r\n                <button\r\n                  class=\"primary-btn text-uppercase\"\r\n                  style=\"float: right;\"\r\n                >\r\n                  Send Message\r\n                </button>\r\n              </div>\r\n            </div>\r\n          </form>\r\n        </div>\r\n      </div>\r\n      \r\n       <div class=\"row pt-5\">\r\n       <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243647.31698201783!2d78.2679590430495!3d17.412299801300147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99daeaebd2c7%3A0xae93b78392bafbc2!2sHyderabad%2C%20Telangana!5e0!3m2!1sen!2sin!4v1570531072830!5m2!1sen!2sin\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>\r\n       </div>\r\n    </div>\r\n  </section>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/dashboard/dashboard.component.html":
/*!******************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/dashboard/dashboard.component.html ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\r\n\r\n<!--<header class=\"masthead\">\r\n    <div class=\"container\">\r\n      <div class=\"intro-text\">\r\n  \r\n      \r\n        <div class=\"intro-lead-in text-warning\">Bring Your Vision to Life</div>\r\n        <div class=\"intro-heading text-uppercase\">Without Compromise</div>\r\n        <div class=\"col-md-9 col-sm-9 m-auto\">\r\n            <form class=\"search_m\">\r\n    <div class=\"input-group\">\r\n          <div class=\"input-group-btn\" ngbDropdown >\r\n            <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n             <span *ngIf='searchBoxLabel == \"all\"'>Photos + Videos</span>\r\n             <span *ngIf='searchBoxLabel == \"photo\"'>Photos Only</span>\r\n             <span *ngIf='searchBoxLabel == \"video\"'>Videos Only</span>\r\n            </button>\r\n            <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('all')\" ngbDropdownItem>Photos + Videos</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('photo')\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('video')\" ngbDropdownItem>Videos Only</a>\r\n               </div>\r\n          </div>\r\n          <input type=\"text\" class=\"form-control\" #searchBoxEle  aria-label=\"Text input with dropdown button\">\r\n          <a href=\"javascript:void(0)\" class=\"iconSearch\" (click)=\"searchAosData(searchBoxEle.value)\"><span class=\"icon-search\"></span></a>\r\n        </div>\r\n  </form>\r\n        \r\n        </div>\r\n      </div>\r\n    </div>\r\n  </header>-->\r\n  <div class=\"video-background-holder\">\r\n  <div class=\"video-background-overlay\"></div>\r\n  <video playsinline=\"playsinline\" autoplay muted=\"muted\" loop>\r\n        <source src=\"https://imagefootage.com/video/VIDEO_2_25MB_home.mp4\" type=\"video/mp4\">\r\n    </video>\r\n  <div class=\"video-background-content container h-100\">\r\n    <div class=\"d-flex h-100 text-center align-items-center\">\r\n      <div class=\"col-md-10 col-sm-10 col-lg-10 m-auto\">\r\n      <div class=\"w-100 text-white vedio_text\">\r\n        <h1 class=\"display-4\"><strong>Bring Your Vision to Life Without Compromise</strong></h1>\r\n           <form class=\"search_m\">\r\n    <div class=\"input-group\">\r\n          <div class=\"input-group-btn\" ngbDropdown >\r\n            <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n             <span *ngIf='searchBoxLabel == \"all\"'>Photos + Videos</span>\r\n             <span *ngIf='searchBoxLabel == \"photo\"'>Photos Only</span>\r\n             <span *ngIf='searchBoxLabel == \"video\"'>Videos Only</span>\r\n            </button>\r\n            <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('all')\" ngbDropdownItem>Photos + Videos</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('photo')\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('video')\" ngbDropdownItem>Videos Only</a>\r\n               </div>\r\n          </div>\r\n          <input type=\"text\" class=\"form-control\" #searchBoxEle  aria-label=\"Text input with dropdown button\">\r\n          <a href=\"javascript:void(0)\" class=\"iconSearch\" (click)=\"searchAosData(searchBoxEle.value)\"><span class=\"fa fa-camera text-gray\"></span></a>\r\n        </div>\r\n  </form>\r\n          <!--<form class=\"search_m mt-5\">\r\n          <div class=\"input-group search-bar\">\r\n          <div class=\"input-group-btn\">\r\n            <button type=\"button\" class=\"btn btn-secondary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\r\n             Photos + Videos\r\n            </button>\r\n            <div class=\"dropdown-menu\">\r\n              <a class=\"dropdown-item\" href=\"javascript:void()\">Photos + Videos</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void()\"><i class=\"\"></i> Photos Only</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void()\">Videos Only</a>\r\n               </div>\r\n          </div>\r\n          <input type=\"text\" class=\"form-control\" aria-label=\"Text input with dropdown button\">\r\n          <i class=\"fa fa-camera text-gray\"></i>\r\n        </div>\r\n       </form>     -->\r\n      </div>\r\n    </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n  <div class=\"site-wrap\">\r\n    <div class=\"container-fluid text-center my-5\">\r\n      <div class=\"row mx-auto my-auto\">\r\n          <div id=\"recipeCarousel\" class=\"carousel slide w-100\">\r\n              <div class=\"carousel-inner\" role=\"listbox\">              \r\n\r\n                <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \r\n                    <div class=\"carousel-item \">\r\n                        <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages;let i= index\">\r\n                          <div class=\"col-11 m-auto\">\r\n                              <div class=\"row\">\r\n                                    <div class=\"col-md-2 col-sm-2 col-4 text-center\" *ngFor=\"let images of carouseimges.categoryNames\">\r\n                                      <a href=\"javascript:void(0)\">{{images.name}}</a>\r\n                                    </div>                          \r\n                              </div>\r\n                          </div>\r\n                        </ng-template>\r\n                    </div>\r\n                </ngb-carousel>\r\n\r\n                \r\n              </div>\r\n            <!--  <a class=\"carousel-control-prev\" href=\"javascript:void(0)\" role=\"button\" data-slide=\"prev\">\r\n                  <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>\r\n                  <span class=\"sr-only\">Previous</span>\r\n              </a>\r\n              <a class=\"carousel-control-next\" href=\"javascript:void(0)\" role=\"button\" data-slide=\"next\">\r\n                  <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>\r\n                  <span class=\"sr-only\">Next</span>\r\n              </a>--> \r\n            </div>\r\n        </div>\r\n      </div>\r\n      <main class=\"main-content mt-3\">\r\n          <div class=\"container-fluid photos\">\r\n            <div class=\"row align-items-stretch\">\r\n\r\n                <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n                    <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\r\n                      <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                      <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                      <div class=\"photo-text-more\">\r\n                      \r\n                        <div class=\"photo-text-more\">\r\n                        <h3 class=\"heading\">{{aosimges.name}}</h3>\r\n                        <span class=\"meta\">{{aosimges.count}} Photos</span>\r\n                      </div>\r\n                      </div>\r\n                    </a>\r\n                </div>\r\n\r\n           </div>\r\n\r\n            \r\n\r\n            <div class=\"col-md-5 col-sm-6 col-12 m-auto\" *ngIf=\"aoslSliderImagesData.length !=0\"> \r\n                    <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \r\n            </div>\r\n\r\n          </div>\r\n      </main>\r\n          \r\n\r\n\r\n    </div>\r\n<!-- <app-hero-search></app-hero-search> -->\r\n"

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

module.exports = "<nav class=\"navbar navbar-expand-lg navbar-dark fixed-top\" id=\"mainNav\">\r\n    <div class=\"container-fluid\">\r\n      <a class=\"navbar-brand js-scroll-trigger\" routerLink=\"/\">Image Footage</a>\r\n      <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\r\n        Menu\r\n        <i class=\"fas fa-bars\"></i>\r\n      </button>\r\n      <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">\r\n        <ul class=\"navbar-nav text-uppercase ml-auto\">\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/services\">Images</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/portfolio\">Footage</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/about\">Others</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/team\">Pricing</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/wishlist\">Cart</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"clickLoginPopup()\">Login</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"logout()\">Logout</a>\r\n          </li>\r\n          <li class=\"nav-item\"  *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/signUp\">Sign Up</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n              <a class=\"nav-link js-scroll-trigger\"  routerLink=\"/wishlist\">wishlist</a>\r\n            </li>\r\n        </ul>\r\n      </div>\r\n    </div>\r\n  </nav>\r\n\r\n\r\n<ng-container *ngIf=\"showloginPopup\">\r\n  <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n</ng-container>\r\n  "

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/hero-detail/hero-detail.component.html":
/*!**********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/hero-detail/hero-detail.component.html ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"site-wrap mt-5 pt-5 bg-dark\">   \r\n  <main class=\"main-content\">\r\n    <div class=\"container-fluid photos\">\r\n      <div class=\"row\">\r\n        <div class=\"col-md-8 col-sm-8 col-xl-8 col-lg-8 pl-0\">\r\n          <div class=\"cartItem\" *ngIf=\"detailPageInfo\">\r\n            <div class=\"p-3\">          \r\n              <div data-aos=\"fade-up\">\r\n                  <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                      <img src=\"assets/images/{{detailPageInfo.impagePath}}\" alt=\"Image\" class=\"img-fluid\">\r\n                      <div class=\"photo-text-more\">            \r\n                        <div class=\"photo-text-more\">\r\n                          <h3 class=\"heading\">{{detailPageInfo.name}}</h3>\r\n                          <span class=\"meta\">{{detailPageInfo.photoCount}} Photos</span>\r\n                        </div>\r\n                      </div>\r\n                  </a>\r\n              </div>         \r\n              <p class=\"text-white f-18\">{{detailPageInfo.description}}</p>\r\n              <p>{{detailPageInfo.shortInfo}}</p>\r\n              <p class=\"text-warning\">Related Keywords</p>            \r\n              <div class=\"related_key\">\r\n                <ng-container *ngFor=\"let keyele of detailPageInfo?.keywords\">                  \r\n                    <a href=\"javascript:void(0)\"  class=\"btn btn-outline-light\" title=\"{{keyele.id}}\">{{keyele.name}}</a>\r\n                </ng-container>   \r\n                            \r\n              </div>\r\n            </div>\r\n              \r\n          </div>\r\n        </div>\r\n         \r\n        <div class=\"col-md-4 col-sm-4 col-xl-4 col-lg-4 pt-3 cart_right\" *ngIf=\"detailPageInfo\">\r\n            <div class=\"btn-group mb-4\" role=\"group\" aria-label=\"Basic example\">\r\n                <button type=\"button\" class=\"btn btn-dark p-2 text-center rounded-0 z-depth-1 border-right-1\">Add to Gallery</button>\r\n                <button type=\"button\" class=\"btn btn-dark p-2 text-center rounded-0 z-depth-1\">Like (20)</button>\r\n            </div>\r\n            <p class=\"text-white\">standard Royalty Free Licenses</p>          \r\n            <div class=\"btn-group btn-group-toggle mb-4\" data-toggle=\"buttons\">\r\n                <ng-container *ngFor=\"let cost of detailPageInfo.licenseCost;let i:index\">\r\n                    <label [class]=\"i==0 ? 'btn btn-dark active' : 'btn btn-dark'\">\r\n                        <input type=\"radio\" name=\"options\" id=\"option{{i}}\" autocomplete=\"off\" [class]=\"i==0 ? 'checked' : ''\">\r\n                        <h3><strong> ${{cost.cost}}</strong></h3><p class=\"mb-0\">{{cost.name}}</p>\r\n                    </label>\r\n                </ng-container>\r\n            </div>\r\n            <p class=\"text-white\">Extended Licenses</p>\r\n            <div class=\"btn-group btn-group-toggle  mb-4\" data-toggle=\"buttons\">\r\n                <ng-container *ngFor=\"let license of detailPageInfo.extendedLicense;let j:index\">\r\n                    <label class=\"btn btn-dark\">\r\n                        <input type=\"radio\" name=\"options\" id=\"option{{j}}\" autocomplete=\"off\" [class]=\"j==0 ? 'checked' : ''\">\r\n                        <p class=\"f-14\"> {{license.name}}</p><p class=\"mb-0\">${{license.amount}}</p>\r\n                    </label>\r\n                </ng-container>\r\n            </div>\r\n            <p class=\"text-white\">Use This Image Exclusively</p>\r\n            <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\" ngbDropdown>\r\n              <button type=\"button\" class=\"btn btn-dark\">Market Freeze</button>\r\n              <button type=\"button\" class=\"btn btn-dark dropdown-toggle exclus\"  id=\"dropdownDetailPage\" ngbDropdownToggle>Select a Duration</button>\r\n              <ul class=\"dropdown-menu selctDura\" ngbDropdownMenu aria-labelledby=\"dropdownDetailPage\">\r\n                  <li class=\"dropdown-item\"><a href=\"javascript:void(0)\" ngbDropdownItem>Item I</a></li>\r\n                  <li class=\"dropdown-item\"><a href=\"javascript:void(0)\" ngbDropdownItem>Item II</a></li>\r\n                  <li class=\"dropdown-item\"><a href=\"javascript:void(0)\" ngbDropdownItem>Item III</a></li>\r\n                  <li class=\"dropdown-item\"><a href=\"javascript:void(0)\" ngbDropdownItem>Item IV</a></li>\r\n                  <li class=\"dropdown-item\"><a href=\"javascript:void(0)\" ngbDropdownItem>Item V</a></li>\r\n                  <li class=\"dropdown-item\"><a href=\"javascript:void(0)\" ngbDropdownItem>Other</a></li>\r\n                </ul>\r\n            </div>\r\n            <div class=\"row mt-5\">\r\n                <div class=\"col-4\">\r\n                    <p class=\"text-white\"><strong>Total</strong></p>\r\n                </div>\r\n                <div class=\"col-8 text-right\">\r\n                    <h2 class=\"text-warning f-24\"><strong>$100.00 USD</strong></h2>\r\n                </div>\r\n            </div>\r\n            <div class=\"row mt-2 mb-5\">\r\n              <div class=\"col-12\">\r\n                  <button type=\"button\" *ngIf=\"!addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" (click)=\"addToCheckoutItem(detailPageInfo.id)\">ADD TO CART</button>\r\n                  <button type=\"button\" *ngIf=\"addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" >ADDED TO CART</button>\r\n                  <p>This image is exclusive to Image Footage</p>\r\n              </div>\r\n            </div>\r\n        </div>\r\n      </div>\r\n \r\n    \r\n    \r\n      <div class=\"bg-black p-3\">\r\n        <div class=\"row align-items-stretch\">\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">                    \r\n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>   \r\n                            </ng-template>\r\n                        </div> \r\n                    </ngb-carousel>\r\n                     \r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">                    \r\n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>   \r\n                            </ng-template>\r\n                        </div> \r\n                    </ngb-carousel>\r\n                     \r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">                    \r\n                    <ngb-carousel  [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\"> \r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>   \r\n                            </ng-template>\r\n                        </div> \r\n                    </ngb-carousel>\r\n                     \r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n\r\n          <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n            <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\r\n              <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n              <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n              <div class=\"photo-text-more\">\r\n              \r\n                <div class=\"photo-text-more\">\r\n                <h3 class=\"heading\">{{aosimges.name}}</h3>\r\n                <span class=\"meta\">{{aosimges.count}} Photos</span>\r\n              </div>\r\n              </div>\r\n            </a>\r\n          </div>\r\n\r\n          <div class=\"col-md-5 col-sm-6 col-12 m-auto\">\r\n\r\n                <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \r\n        </div>\r\n\r\n\r\n\r\n\r\n      \r\n      \r\n      \r\n\r\n\r\n   \r\n      \r\n        \r\n        \r\n\r\n      </div>\r\n      \r\n       \r\n      </div>\r\n    </div>\r\n  </main>\r\n\r\n</div> \r\n\r\n<ng-container *ngIf=\"showloginPopup\">\r\n    <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n</ng-container>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/hero-search/hero-search.component.html":
/*!**********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/hero-search/hero-search.component.html ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"site-wrap\">\r\n  <div class=\"page-wrapper chiller-theme toggled\">\r\n    <a id=\"show-sidebar\" class=\"btn btn-sm btn-dark\" href=\"javascript:void(0)\">\r\n      <i class=\"fas fa-bars\"></i>\r\n    </a>\r\n    <nav id=\"sidebar\" class=\"sidebar-wrapper\">\r\n      <div class=\"sidebar-content\">\r\n          <div class=\"sidebar-brand\">\r\n              <a href=\"javascript:void(0)\">FILTERS</a>\r\n              <div id=\"close-sidebar\">\r\n                <i class=\"fas fa-times\"></i>\r\n              </div>\r\n          </div>\r\n          <div class=\"sidebar-header\"> \r\n                <div class=\"btn-group btn-group-toggle search-select\" data-toggle=\"buttons\">\r\n                  <label  [class]=\"searchBoxLabel == 'photo' ? 'btn btn-dark active' : 'btn btn-dark'\">\r\n                    <input type=\"radio\"  name=\"options\" [(ngModel)]=\"searchBoxLabel\" value=\"photo\">\r\n                    <p class=\"mb-0\"> <i class=\"fa fa-camera\"></i> </p>\r\n                    <p class=\"mb-0\">PHOTOS</p> \r\n                  </label>\r\n                  <label  [class]=\"searchBoxLabel == 'video' ? 'btn btn-dark active' : 'btn btn-dark'\">\r\n                    <input type=\"radio\" name=\"options\" [(ngModel)]=\"searchBoxLabel\" value=\"video\">\r\n                    <p class=\"mb-0\"> <i class=\"fa fa-video\"></i> </p>\r\n                    <p class=\"mb-0\">  VIDEOS </p>\r\n                  </label>  \r\n                </div>\r\n          </div>\r\n        <div class=\"sidebar-menu\">\r\n          <ul>           \r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu1=!sidebarSubmenu1\">  \r\n                <i class=\"fa fa-tachometer-alt\"></i>\r\n                <span> People</span>              \r\n              </a>  \r\n               <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu1\">\r\n                <ul>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Male</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Female</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">One Person</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Two People</a>\r\n                  </li>  \r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Small Group</a>\r\n                  </li>  \r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">A Crowd</a>\r\n                  </li>  \r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">No People</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu2=!sidebarSubmenu2\">\r\n                <i class=\"fa fa-shopping-cart\"></i>\r\n                <span>Age</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu sidebar-submenu-btn\" *ngIf=\"sidebarSubmenu2\">\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\"> Baby</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Toddler</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Child</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Tween</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Teenager</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">18+</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">21+</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">20s</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">30s</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">40s</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">50s</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Senior</a>\r\n                <a href=\"javascript:void(0)\" class=\"btn btn-dark\">Only</a>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu3=!sidebarSubmenu3\">\r\n                <i class=\"far fa-gem\"></i>\r\n                <span>Ethnicity</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu3\">\r\n                <ul>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">General</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Panels</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Tables</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Icons</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Forms</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu4=!sidebarSubmenu4\">\r\n                <i class=\"fa fa-chart-line\"></i>\r\n                <span>Location</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu4\">\r\n                <ul>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Pie chart</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Line chart</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Bar chart</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Histogram</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n            <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu5=!sidebarSubmenu5\">\r\n                <i class=\"fa fa-globe\"></i>\r\n                <span>Color</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu5\">\r\n                <ul>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Google maps</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Open street map</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n             <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu6=!sidebarSubmenu6\">\r\n                <i class=\"fa fa-globe\"></i>\r\n                <span>Shot Details</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu6\">\r\n                <ul>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Google maps</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Open street map</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n             <li class=\"sidebar-dropdown\">\r\n              <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu7=!sidebarSubmenu7\">\r\n                <i class=\"fa fa-globe\"></i>\r\n                <span>Camera Type</span>\r\n              </a>\r\n              <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu7\">\r\n                <ul>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Google maps</a>\r\n                  </li>\r\n                  <li>\r\n                    <a href=\"javascript:void(0)\">Open street map</a>\r\n                  </li>\r\n                </ul>\r\n              </div>\r\n            </li>\r\n           \r\n          </ul>\r\n        </div>\r\n        <!-- sidebar-menu  -->\r\n      </div>\r\n      <!-- sidebar-content  -->\r\n      <div class=\"sidebar-footer\">\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-bell\"></i>\r\n          <span class=\"badge badge-pill badge-warning notification\">3</span>\r\n        </a>\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-envelope\"></i>\r\n          <span class=\"badge badge-pill badge-success notification\">7</span>\r\n        </a>\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-cog\"></i>\r\n          <span class=\"badge-sonar\"></span>\r\n        </a>\r\n        <a href=\"javascript:void(0)\">\r\n          <i class=\"fa fa-power-off\"></i>\r\n        </a>\r\n      </div>\r\n    </nav>\r\n    <!-- sidebar-wrapper  -->\r\n    <main class=\"page-content\">\r\n      <main class=\"main-content\">\r\n          <div class=\"search_m header_serach mt-3 mb-3\">\r\n              <div class=\"input-group search-bar\">\r\n                  <div class=\"input-group-btn\" ngbDropdown >\r\n                      <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n                        <span *ngIf='searchBoxLabel == \"all\"'>Photos + Videos</span>\r\n                        <span *ngIf='searchBoxLabel == \"photo\"'>Photos Only</span>\r\n                        <span *ngIf='searchBoxLabel == \"video\"'>Videos Only</span>\r\n                      </button>\r\n                      <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('all')\" ngbDropdownItem>Photos + Videos</a>\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('photo')\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('video')\" ngbDropdownItem>Videos Only</a>\r\n                      </div>\r\n                  </div>\r\n                  <input type=\"text\" [(ngModel)]=\"name\" #ctrl=\"ngModel\" (keydown)=\"onKeydown($event)\" class=\"form-control\" aria-label=\"Text input with dropdown button\">\r\n                  <i class=\"fa fa-camera\"></i>\r\n              </div>\r\n          </div>\r\n          <div class=\"bg-dark search_menu_l\">\r\n            <ul class=\"search_menu search_menu col-md-6 m-auto col-sm-6\">\r\n              <li class=\"active\"><a href=\"javascript:void(0)\">CURATED</a></li>\r\n              <li><a href=\"javascript:void(0)\">LATEST</a></li>\r\n              <li><a href=\"javascript:void(0)\">EMERGING</a></li>\r\n              <li><a href=\"javascript:void(0)\">POPULAR</a></li>\r\n            </ul>\r\n          </div>\r\n          <div class=\"clearfix\"></div>\r\n          <div class=\"photos mt-5 pt-5\">\r\n            <div class=\"row align-items-stretch\">  \r\n                <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n                    <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\r\n                      <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                      <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                      <div class=\"photo-text-more\">\r\n                      \r\n                        <div class=\"photo-text-more\">\r\n                        <h3 class=\"heading\">{{aosimges.name}}</h3>\r\n                        <span class=\"meta\">{{aosimges.count}} Photos</span>\r\n                      </div>\r\n                      </div>\r\n                    </a>\r\n                </div>\r\n            </div>\r\n        \r\n            <div class=\"col-md-5 col-sm-6 col-12 m-auto\" *ngIf=\"aoslSliderImagesData.length !=0\">\r\n              <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>     \r\n    \r\n            </div>        \r\n          </div>\r\n    </main>\r\n  \r\n    </main>\r\n    <!-- page-content\" -->\r\n  </div>\r\n  \r\n  </div> \r\n  "

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

module.exports = "<div class=\"site-wrap mt-5 pt-5\">\r\n    <main class=\"main-content mt-5 pt-5\">\r\n      <div class=\"container photos\">\r\n        <div class=\"row\">\r\n          \r\n          <div class=\"col-md-10 pt-3\"  data-aos=\"fade-up\">\r\n            <h2 class=\"text-white mb-4\">Create your Image Footage account</h2>\r\n            <p>Already have an account? <a (click)=\"clickLoginPopup()\">Login</a></p>\r\n  \r\n                    <form [formGroup]=\"registerForm\" (ngSubmit)=\"onSubmit()\"  class=\"mt-5 pt-5\">\r\n  \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"col-md-4 col-sm-4 mb-3 mb-md-0\">\r\n                              <label class=\"text-white\">First Name</label>\r\n                              <input type=\"text\" formControlName=\"firstName\" [ngClass]=\"{ 'is-invalid': submitted && f.firstName.errors }\" class=\"form-control text-white\">\r\n                              <div *ngIf=\"submitted && f.firstName.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.firstName.errors.required\">First Name is required</div>\r\n                              </div>\r\n                          </div>\r\n                          <div class=\"col-md-4 col-sm-4 \">\r\n                              <label class=\"text-white\" >Last Name</label>\r\n                              <input type=\"text\" formControlName=\"lastName\" id=\"lname\" [ngClass]=\"{ 'is-invalid': submitted && f.lastName.errors }\"  class=\"form-control text-white\">\r\n                              <div *ngIf=\"submitted && f.lastName.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.lastName.errors.required\">Last Name is required</div>\r\n                              </div>\r\n                          </div>\r\n                          <div class=\"col-md-4 col-sm-4 \">\r\n                            <label class=\"text-white\">Email</label> \r\n                            <input type=\"text\" formControlName=\"email\" id=\"email\" class=\"form-control text-white\" [ngClass]=\"{ 'is-invalid': submitted && f.email.errors }\">\r\n                            <div *ngIf=\"submitted && f.email.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.email.errors.required\">Email is required</div>\r\n                                <div *ngIf=\"f.email.errors.email\">Email must be a valid email address</div>\r\n                            </div>\r\n                          </div>\r\n                      </div>\r\n  \r\n                      <div class=\"row form-group mb-5\">                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Password</label> \r\n                            <input type=\"password\" formControlName=\"password\" [ngClass]=\"{ 'is-invalid': submitted && f.password.errors }\" id=\"pswrd\" class=\"form-control text-white\">\r\n                            <div *ngIf=\"submitted && f.password.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.password.errors.required\">Password is required</div>\r\n                                <div *ngIf=\"f.password.errors.minlength\">Password must be at least 6 characters</div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\">Confirm Password</label> \r\n                            <input type=\"password\" formControlName=\"confirmPassword\" id=\"cnfpswrd\" [ngClass]=\"{ 'is-invalid': submitted && f.confirmPassword.errors }\" class=\"form-control text-white\">\r\n                            <div *ngIf=\"submitted && f.confirmPassword.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.confirmPassword.errors.required\">Confirm Password is required</div>\r\n                                <div *ngIf=\"f.confirmPassword.errors.mustMatch\">Passwords must match</div>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Job Title</label> \r\n                          <input type=\"text\" formControlName=\"jobTitle\" id=\"jobTitle\" [ngClass]=\"{ 'is-invalid': submitted && f.jobTitle.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.jobTitle.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.jobTitle.errors.required\">JobTitle is required</div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                \r\n                      <div class=\"row form-group mb-5\">\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Company</label> \r\n                          <input type=\"text\" id=\"companyName\" formControlName=\"company\" [ngClass]=\"{ 'is-invalid': submitted && f.company.errors }\" class=\"form-control\">\r\n                          <div *ngIf=\"submitted && f.company.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.company.errors.required\">Company is required</div>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Phone</label> \r\n                          <input type=\"text\" id=\"phne\" formControlName=\"phoneNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.phoneNumber.errors }\" class=\"form-control\">\r\n                          <div *ngIf=\"submitted && f.phoneNumber.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.phoneNumber.errors.required\">PhoneNumber is required</div>\r\n                          </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Mobile Number</label> \r\n                          <input type=\"text\" id=\"mbnum\" formControlName=\"mobileNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.mobileNumber.errors }\" class=\"form-control\">\r\n                          <div *ngIf=\"submitted && f.mobileNumber.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.mobileNumber.errors.required\">MobileNumber is required</div>\r\n                            <div *ngIf=\"f.mobileNumber.errors.minlength || f.mobileNumber.errors.maxlength\">Mobile number should be 10 digits</div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                      \r\n                      <div class=\"row form-group mb-5\">\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" for=\"country\">Slect Country</label>                           \r\n                            <select class=\"form-control  text-white\" id=\"select-language1\" onchange=console.log(this.value)> <option value=php>India</option> <option value=javascript>Australia</option> <option value=python>Srilanka</option> <option value=java>Pakistan</option> </select> \r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" for=\"state\">Select State</label>                           \r\n                            <select class=\"form-control  text-white\" id=\"select-language2\" onchange=console.log(this.value)> <option value=php>India</option> <option value=javascript>Australia</option> <option value=python>Srilanka</option> <option value=java>Pakistan</option> </select> \r\n                        </div>                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" for=\"city\">Select City</label> \r\n                            <select class=\"form-control  text-white\" id=\"select-language3\" onchange=console.log(this.value)> <option value=php>India</option> <option value=javascript>Australia</option> <option value=python>Srilanka</option> <option value=java>Pakistan</option> </select> \r\n                        </div>\r\n                      </div>\r\n  \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" for=\"zipCode\">Zip Code</label> \r\n                            <input type=\"text\" id=\"zipCode\" class=\"form-control\">\r\n                          </div>\r\n                          \r\n                          <div class=\"col-md-8 col-sm-8\">\r\n                            <label class=\"text-white\" for=\"message\">Address</label> \r\n                            <textarea name=\"message\" id=\"message\" cols=\"5\" rows=\"1\" class=\"form-control\" placeholder=\"\"></textarea>\r\n                          </div>                        \r\n                      </div>\r\n                      \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"custom-control custom-checkbox\">\r\n                              <input type=\"checkbox\" class=\"custom-control-input\" formControlName=\"iagree\" [ngClass]=\"{ 'is-invalid': submitted && f.iagree.errors }\" id=\"customCheck\">\r\n                              <label class=\"custom-control-label\" for=\"customCheck\"> Make me an Approved Client* with the ability to license and download images online without a credit card.</label>\r\n                              <div *ngIf=\"submitted && f.iagree.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.iagree.errors.required\">Please accept Terms & Conditions</div>\r\n                              </div>   \r\n                          </div>\r\n                      </div>\r\n                    \r\n                      <div class=\"row form-group text-center\">\r\n                        <div class=\"col-md-12\">\r\n                          <button [disabled]=\"loading\" type=\"submit\" class=\"btn btn-warning btn-md text-white\">Create Account</button>\r\n                        </div>\r\n                      </div>\r\n  \r\n          \r\n                    </form>\r\n                 \r\n          \r\n          </div>\r\n  \r\n        </div>\r\n  \r\n        \r\n      </div>\r\n    </main>\r\n  \r\n  </div>\r\n\r\n  <ng-container *ngIf=\"showloginPopup\">\r\n      <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n  </ng-container>"

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

module.exports = "<section>\r\n  \r\n  <div class=\"container\">\r\n          <div class=\"card pb-3 shadow-sm\">            \r\n            <form method=\"#\">\r\n              <div class=\"table-responsive\">\r\n                <table class=\"table cart-table\">\r\n                  <tbody>\r\n                    <tr *ngFor=\"let wishList of wishListDataItems;let i= index\">\r\n                      <td width=\"25%\" align=\"center\">\r\n                          <div class=\"product-info\">\r\n                              <a href=\"javascript:void(0)\">\r\n                                <img src=\"assets/images/{{wishList.imgPath}}\" alt=\"product-img\">\r\n                              </a>\r\n                              <div class=\"pt-3 cart_option\">\r\n                                  <a href=\"javascript:void(0)\" class=\"f-22\"><i class=\"fa fa-plus-circle\"></i></a>\r\n                                  <a href=\"javascript:void(0)\" class=\"f-22 pl-1\"><i class=\"fa fa-times-circle\"></i></a>\r\n                              </div>\r\n                          </div>                       \r\n                      </td>                      \r\n                      <td width=\"50%\">\r\n                         <p class=\"mb-1 text-black f-18\"><strong>{{wishList.name}}</strong></p>\r\n                         <p class=\"mb-1 f-16\"><strong>Size:</strong>  {{wishList.size}}</p>\r\n                         <p class=\"mb-1\">{{wishList.info}}</p>                       \r\n                      </td>\r\n                       <td width=\"25%\" align=\"right\"><p class=\"f-18 text-black\"><strong>${{wishList.price}} USD</strong></p>                      \r\n                       </td>\r\n                    </tr>\r\n                  </tbody>\r\n                </table>\r\n              </div>\r\n\r\n              <hr>\r\n            \r\n                <div class=\"col-12\">\r\n                <div class=\"p-3 row\">\r\n                  <div class=\"col-md-4 col-sm-4 col-lg-4\">\r\n                  <a href=\"javascript:void()\" id=\"promocode\">Have a promo code ?</a>\r\n                  <div class=\" show-promocode\">\r\n                  <div class=\"row\">\r\n                    <div class=\"col-md-8 col-sm-8 col-lg-8\">                        \r\n                      <input type=\"text\" name=\"\" class=\"form-control\" placeholder=\"Coupon Code\">\r\n                    </div>\r\n                    <div class=\"col-md-4 col-sm-4 col-lg-4 pl-1\">                        \r\n                      <button class=\"btn btn-success\">Apply</button>\r\n                    </div>\r\n                  </div>\r\n                  </div>\r\n                </div>\r\n                 <div class=\"col-md-8 col-sm-8 col-lg-8\">\r\n                  <ul class=\"list-unstyled text-right text-black f-18 text-black\">\r\n                    <li class=\"pb-3 fw-6 \">Sub Total <span class=\"d-inline-block w-100px\">${{showTotalPrice()}}.00</span></li>\r\n                    <li class=\"pb-5 fw-6 \">UK Vat <span class=\"d-inline-block w-100px\">$10.00</span></li>\r\n                    <li class=\"pb-2 fw-8 f-22\">Grand Total <span class=\"d-inline-block w-100px\">${{showTotalPrice() + 10}}.00</span></li>\r\n                  </ul>\r\n                  </div>\r\n                  </div>\r\n                  <div class=\"my-3\">\r\n                   <hr>\r\n              <a href=\"javascript:void(0)\"  class=\"btn btn-success float-right pt-3 pb-3 pl-5 pr-5 f-20 text-uppercase\" (click)=\"redirectToCheckout()\"><strong>Checkout</strong></a>\r\n              </div>\r\n                </div>\r\n              \r\n             \r\n            </form>\r\n          </div>\r\n          \r\n  </div>\r\n</section>"

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
    { path: '', redirectTo: '/', pathMatch: 'full' },
    { path: '', component: _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_3__["DashboardComponent"] },
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
/* harmony import */ var angular_in_memory_web_api__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! angular-in-memory-web-api */ "./node_modules/angular-in-memory-web-api/index.js");
/* harmony import */ var _in_memory_data_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./in-memory-data.service */ "./src/app/in-memory-data.service.ts");
/* harmony import */ var _app_routing_module__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./app-routing.module */ "./src/app/app-routing.module.ts");
/* harmony import */ var _app_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./app.component */ "./src/app/app.component.ts");
/* harmony import */ var _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./dashboard/dashboard.component */ "./src/app/dashboard/dashboard.component.ts");
/* harmony import */ var _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./hero-detail/hero-detail.component */ "./src/app/hero-detail/hero-detail.component.ts");
/* harmony import */ var _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./heroes/heroes.component */ "./src/app/heroes/heroes.component.ts");
/* harmony import */ var _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./hero-search/hero-search.component */ "./src/app/hero-search/hero-search.component.ts");
/* harmony import */ var _messages_messages_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./messages/messages.component */ "./src/app/messages/messages.component.ts");
/* harmony import */ var _footer_footer_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./footer/footer.component */ "./src/app/footer/footer.component.ts");
/* harmony import */ var _header_header_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./header/header.component */ "./src/app/header/header.component.ts");
/* harmony import */ var _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./about-us/about-us.component */ "./src/app/about-us/about-us.component.ts");
/* harmony import */ var _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./sign-up/sign-up.component */ "./src/app/sign-up/sign-up.component.ts");
/* harmony import */ var _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./wishlist/wishlist.component */ "./src/app/wishlist/wishlist.component.ts");
/* harmony import */ var _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! @ng-bootstrap/ng-bootstrap */ "./node_modules/@ng-bootstrap/ng-bootstrap/fesm2015/ng-bootstrap.js");
/* harmony import */ var _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ./contact-us/contact-us.component */ "./src/app/contact-us/contact-us.component.ts");
/* harmony import */ var _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ./terms-and-conditions/terms-and-conditions.component */ "./src/app/terms-and-conditions/terms-and-conditions.component.ts");
/* harmony import */ var _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ./privacy-policy/privacy-policy.component */ "./src/app/privacy-policy/privacy-policy.component.ts");
/* harmony import */ var _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ./licence-agreement/licence-agreement.component */ "./src/app/licence-agreement/licence-agreement.component.ts");
/* harmony import */ var _login_login_component__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! ./login/login.component */ "./src/app/login/login.component.ts");
/* harmony import */ var _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! ./checkout/checkout.component */ "./src/app/checkout/checkout.component.ts");



























let AppModule = class AppModule {
};
AppModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [
            _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__["BrowserModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormsModule"],
            _app_routing_module__WEBPACK_IMPORTED_MODULE_8__["AppRoutingModule"],
            _angular_common_http__WEBPACK_IMPORTED_MODULE_4__["HttpClientModule"],
            _angular_http__WEBPACK_IMPORTED_MODULE_5__["HttpModule"],
            _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_20__["NgbModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_3__["ReactiveFormsModule"],
            // The HttpClientInMemoryWebApiModule module intercepts HTTP requests
            // and returns simulated server responses.
            // Remove it when a real server is ready to receive requests.
            angular_in_memory_web_api__WEBPACK_IMPORTED_MODULE_6__["HttpClientInMemoryWebApiModule"].forRoot(_in_memory_data_service__WEBPACK_IMPORTED_MODULE_7__["InMemoryDataService"], { dataEncapsulation: false })
        ],
        declarations: [
            _app_component__WEBPACK_IMPORTED_MODULE_9__["AppComponent"],
            _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_10__["DashboardComponent"],
            _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_12__["HeroesComponent"],
            _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_11__["HeroDetailComponent"],
            _messages_messages_component__WEBPACK_IMPORTED_MODULE_14__["MessagesComponent"],
            _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_13__["HeroSearchComponent"],
            _footer_footer_component__WEBPACK_IMPORTED_MODULE_15__["FooterComponent"],
            _header_header_component__WEBPACK_IMPORTED_MODULE_16__["HeaderComponent"],
            _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_17__["AboutUsComponent"],
            _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_18__["SignUpComponent"],
            _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_19__["WishlistComponent"],
            _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_21__["ContactUsComponent"],
            _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_22__["TermsAndConditionsComponent"],
            _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_23__["PrivacyPolicyComponent"],
            _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_24__["LicenceAgreementComponent"],
            _login_login_component__WEBPACK_IMPORTED_MODULE_25__["LoginComponent"],
            _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_26__["CheckoutComponent"]
        ],
        exports: [_login_login_component__WEBPACK_IMPORTED_MODULE_25__["LoginComponent"]],
        bootstrap: [_app_component__WEBPACK_IMPORTED_MODULE_9__["AppComponent"]]
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
                this.priceArray.push(element.price);
            });
        }, error => {
        });
    }
    showTotalPrice() {
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


let ContactUsComponent = class ContactUsComponent {
    constructor() { }
    ngOnInit() {
    }
};
ContactUsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-contact-us',
        template: __webpack_require__(/*! raw-loader!./contact-us.component.html */ "./node_modules/raw-loader/index.js!./src/app/contact-us/contact-us.component.html"),
        styles: [__webpack_require__(/*! ./contact-us.component.css */ "./src/app/contact-us/contact-us.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
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
        this.searchBoxLabel = 'all';
        this.page = 1;
        this.pageSize = 12;
        this.aosSliderSizes = [];
    }
    ngOnInit() {
        this.heroService.getcarouselSliderImages()
            .subscribe(carouselSliderImages => {
            this.carouselSliderImages = carouselSliderImages;
        });
        this.heroService.getAosSliderImages()
            .subscribe(aoslSliderImages => {
            this.aoslSliderImages = aoslSliderImages;
            this.aoslSliderImagesData = aoslSliderImages;
            let i = 4, j = 0;
            let randArr = [4, 3, 2, 3];
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
        });
    }
    getClassName(ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    }
    searchAosData(search) {
        // debounceTime(400),
        /*if(this.searchBoxLabel == 'all'){
          this.aoslSliderImagesData = this.aoslSliderImages;
        }else{
          this.aoslSliderImagesData = this.aoslSliderImages.filter(ele=> ele.type == this.searchBoxLabel);
        }
    
        if(search.trim().length > 2){
          this.aoslSliderImagesData =  this.aoslSliderImagesData.filter(ele=> ele.name == search.trim());
        }*/
        if (search.trim().length > 2) {
            this.router.navigate(['/search'], { queryParams: { type: this.searchBoxLabel, keyword: search.trim() } });
        }
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
        this.authenticationService.currentUser.subscribe(x => {
            this.currentUser = x;
        });
    }
    ngOnInit() {
        this.getcategoryCarouselImages();
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
        this.heroService.getDetailPagedetails(this.id)
            .subscribe(data => {
            console.log(data);
            this.detailPageInfo = data[0];
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
    addToCheckoutItem(id) {
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
            this.addToCheckoutItem(this.id);
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
/* harmony import */ var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../hero.service */ "./src/app/hero.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../_helpers/image-footer-helper */ "./src/app/_helpers/image-footer-helper.ts");






let HeroSearchComponent = class HeroSearchComponent {
    constructor(heroService, route, dataHelper) {
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
    }
    // Push a search term into the observable stream.
    search(term) {
        this.searchTerms.next(term);
    }
    ngOnInit() {
        this.sub = this.route
            .queryParams
            .subscribe(params => {
            this.searchBoxLabel = params.type;
            this.name = params.keyword;
            this.heroService.getAosSliderImages()
                .subscribe(aoslSliderImages => {
                // console.log(aoslSliderImages);
                // console.log(aoslSliderImages.filter(ele=> ele.name.includes(this.name)));
                this.aoslSliderImages = aoslSliderImages;
                this.maintainSearchData(aoslSliderImages);
            });
        });
        this.heroService.getcarouselSliderImages()
            .subscribe(carouselSliderImages => {
            this.carouselSliderImages = carouselSliderImages;
        });
    }
    searchDropDownClick(type) {
        this.searchBoxLabel = type;
    }
    getClassName(ele) {
        return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
    }
    onKeydown(event) {
        if (event.key === "Enter") {
            // console.log(this.name);
            this.maintainSearchData(this.aoslSliderImages);
        }
    }
    maintainSearchData(aoslSliderImages) {
        this.aoslSliderImagesData = aoslSliderImages;
        if (this.searchBoxLabel == 'all') {
            this.aoslSliderImagesData = this.aoslSliderImages;
        }
        else {
            this.aoslSliderImagesData = this.aoslSliderImages.filter(ele => ele.type == this.searchBoxLabel);
        }
        if (this.name.length > 2) {
            this.aoslSliderImagesData = this.aoslSliderImagesData.filter(ele => ele.name.includes(this.name.trim()));
        }
        this.maintainAosSlider();
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
};
HeroSearchComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-hero-search',
        template: __webpack_require__(/*! raw-loader!./hero-search.component.html */ "./node_modules/raw-loader/index.js!./src/app/hero-search/hero-search.component.html"),
        styles: [__webpack_require__(/*! ./hero-search.component.css */ "./src/app/hero-search/hero-search.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"]])
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
/* harmony import */ var _message_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./message.service */ "./src/app/message.service.ts");






let HeroService = class HeroService {
    constructor(http, messageService) {
        this.http = http;
        this.messageService = messageService;
        this.heroesUrl = 'api/heroes'; // URL to web api
        this.carouselImagesUrl = 'api/carouselImages';
        this.aosImagesUrl = 'api/aosImages';
        this.httpOptions = {
            headers: new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({ 'Content-Type': 'application/json' })
        };
        this.currentUserSubject = new rxjs__WEBPACK_IMPORTED_MODULE_3__["BehaviorSubject"](JSON.parse(localStorage.getItem('currentUser')));
        this.currentUser = this.currentUserSubject.asObservable();
    }
    get currentUserValue() {
        return this.currentUserSubject.value;
    }
    /** GET Slider Images from the server */
    getcarouselSliderImages() {
        return this.http.get(this.carouselImagesUrl)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log('fetched carousel Images')), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getCarouselImages', [])));
    }
    /** GET Slider Images from the server */
    /** GET Slider Images from the server */
    getAosSliderImages() {
        return this.http.get(this.aosImagesUrl)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log('fetched carousel Images')), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getCarouselImages', [])));
    }
    getLogin(email, password) {
        return this.http.post(`api/userData`, { email, password }, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(user => {
            console.log(user);
            localStorage.setItem('currentUser', JSON.stringify(user));
            this.currentUserSubject.next(user);
            return user;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to get data`)));
    }
    register(usrData) {
        return this.http.post(`api/userData`, usrData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(userInfo => {
            return true;
        }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`unable to register data`)));
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
    getDetailPagedetails(id) {
        const url = `api/detailPageInfo/?${id}`;
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`fetched detail Page Info id=${id}`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`getHero id=${id}`)));
    }
    getcartItemsData() {
        let params = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpParams"]();
        const url = `api/cartItemsData`;
        params = params.append('actors', localStorage.getItem('checkoutAray'));
        // this.http.get(url, { params: params }) -- Modify when API integrated
        return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(_ => this.log(`fetched cart items data`)), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError(`getHero id`)));
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
        _message_service__WEBPACK_IMPORTED_MODULE_5__["MessageService"]])
], HeroService);



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

/***/ "./src/app/in-memory-data.service.ts":
/*!*******************************************!*\
  !*** ./src/app/in-memory-data.service.ts ***!
  \*******************************************/
/*! exports provided: InMemoryDataService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "InMemoryDataService", function() { return InMemoryDataService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let InMemoryDataService = class InMemoryDataService {
    createDb() {
        const heroes = [
            { id: 11, name: 'Dr Nice' },
            { id: 12, name: 'Narco' },
            { id: 13, name: 'Bombasto' },
            { id: 14, name: 'Celeritas' },
            { id: 15, name: 'Magneta' },
            { id: 16, name: 'RubberMan' },
            { id: 17, name: 'Dynama' },
            { id: 18, name: 'Dr IQ' },
            { id: 19, name: 'Magma' },
            { id: 20, name: 'Tornado' }
        ];
        const carouselImages = [
            { id: 1, categoryNames: [
                    { id: 11, name: 'Skin Care' },
                    { id: 12, name: 'Cannabis' },
                    { id: 13, name: 'Business' },
                    { id: 14, name: 'Curated' },
                    { id: 15, name: 'Video' },
                    { id: 16, name: 'Autumn' },
                ]
            },
            { id: 2, categoryNames: [
                    { id: 21, name: 'Family' },
                    { id: 22, name: 'Halloween' },
                    { id: 23, name: 'Seniors' },
                    { id: 24, name: 'Cats & Dogs' },
                    { id: 25, name: 'Time to Party' },
                    { id: 26, name: 'Food' }
                ]
            },
            { id: 3, categoryNames: [
                    { id: 31, name: 'The Digital Frontier' },
                    { id: 32, name: 'Christmas' },
                    { id: 33, name: 'Real People & Places' },
                    { id: 34, name: 'Art & Concept' }
                ]
            }
        ];
        const aosImages = [
            { id: 1, name: 'test1', imageName: "img_4.jpg", type: 'photo', count: 42 },
            { id: 2, name: 'test2', imageName: "img_1.jpg", type: 'photo', count: 42 },
            { id: 3, name: 'test3', imageName: "img_2.jpg", type: 'photo', count: 42 },
            { id: 4, name: 'test4', imageName: "img_3.jpg", type: 'photo', count: 42 },
            { id: 5, name: 'test5', imageName: "xcJtL7QggTI", type: 'video', count: 42 },
            { id: 6, name: 'test6', imageName: "img_5.jpg", type: 'photo', count: 42 },
            { id: 7, name: 'test7', imageName: "img_6.jpg", type: 'photo', count: 42 },
            { id: 8, name: 'test8', imageName: "img_7.jpg", type: 'photo', count: 42 },
            { id: 9, name: 'test9', imageName: "img_8.jpg", type: 'photo', count: 42 },
            { id: 10, name: 'test10', imageName: "img_9.jpg", type: 'photo', count: 42 },
            { id: 11, name: 'test11', imageName: "img_10.jpg", type: 'photo', count: 42 },
            { id: 12, name: 'test12', imageName: "img_1.jpg", type: 'photo', count: 42 },
            { id: 13, name: 'test13', imageName: "img_2.jpg", type: 'photo', count: 42 },
            { id: 14, name: 'test14', imageName: "img_3.jpg", type: 'photo', count: 42 },
            { id: 15, name: 'test15', imageName: "img_4.jpg", type: 'photo', count: 42 },
            { id: 16, name: 'test16', imageName: "img_5.jpg", type: 'photo', count: 42 },
            { id: 17, name: 'test17', imageName: "img_6.jpg", type: 'photo', count: 42 },
            { id: 18, name: 'test18', imageName: "img_7.jpg", type: 'photo', count: 42 },
            { id: 19, name: 'test19', imageName: "img_8.jpg", type: 'photo', count: 42 },
            { id: 20, name: 'Amar', imageName: "img_9.jpg", type: 'photo', count: 42 },
        ];
        const userData = [
            { id: 1, firstName: 'test', lastName: 'user1', email: 'test1@user.com', password: 'test1' },
            { id: 2, firstName: 'test', lastName: 'user2', email: 'test2@user.com', password: 'test2' },
            { id: 3, firstName: 'test', lastName: 'user3', email: 'test3@user.com', password: 'test3' },
            { id: 4, firstName: 'test', lastName: 'user4', email: 'test4@user.com', password: 'test4' },
            { id: 5, firstName: 'test', lastName: 'user5', email: 'test5@user.com', password: 'test5' },
            { id: 6, firstName: 'test', lastName: 'user6', email: 'test6@user.com', password: 'test6' },
            { id: 7, firstName: 'test', lastName: 'user7', email: 'test7@user.com', password: 'test7' }
        ];
        const cartItemsData = [
            { id: 1, name: 'IMAGE #2750011', size: 'X-Large (6720 X 4480PX)', info: "A royalty free license for advertising, promotional and editorial use for one user. Print copies are limited to 500,000 and web use is unlimited.", price: 200, imgPath: 'cart-1.jpg' },
            { id: 2, name: 'IMAGE #2750011', size: 'Small (200 X 450PX)', info: "A royalty free license for advertising, promotional and editorial use for one user. Print copies are limited to 500,000 and web use is unlimited.", price: 200, imgPath: 'cart-2.jpg' },
            { id: 1, name: 'IMAGE #2750011', size: 'X-Large (6720 X 4480PX)', info: "A royalty free license for advertising, promotional and editorial use for one user. Print copies are limited to 500,000 and web use is unlimited.", price: 200, imgPath: 'cart-3.jpg' }
        ];
        const detailPageInfo = [{
                id: 1,
                name: 'Photos Title Here',
                impagePath: 'wallpaper.jpg',
                photoCount: 42,
                description: 'Silhouetted Girls In Dark Light During Snow Fall',
                shortInfo: 'silhouetted girls in dark light during snowfall (note: visible grain from high ISO)',
                keywords: [
                    { id: 1, name: 'underwater' },
                    { id: 2, name: 'backlit' },
                    { id: 3, name: 'light' },
                    { id: 4, name: 'water' },
                    { id: 5, name: 'dark' },
                    { id: 6, name: 'shadow' },
                    { id: 7, name: 'clothing' },
                    { id: 8, name: 'nature' },
                    { id: 9, name: 'wear' }
                ],
                licenseCost: [
                    { id: 1, cost: 15, name: 'small' },
                    { id: 2, cost: 30, name: 'Medium' },
                    { id: 3, cost: 75, name: 'Large' },
                    { id: 4, cost: 125, name: 'x-Large' }
                ],
                extendedLicense: [
                    { id: 1, name: 'Unlimited Print', amount: 300 },
                    { id: 2, name: 'Products Fir Resale', amount: 500 },
                    { id: 3, name: 'Multi-Seat (Unlimited)', amount: 100 }
                ],
                duration: '',
                likesCount: 20
            }];
        const marketFreeze = [
            { id: 1, name: 'Item I', value: 'Item I' },
            { id: 2, name: 'Item II', value: 'Item II' },
            { id: 3, name: 'Item III', value: 'Item III' },
            { id: 4, name: 'Item IV', value: 'Item IV' },
            { id: 5, name: 'Item V', value: 'Item V' },
            { id: 6, name: 'other', value: 'other' }
        ];
        const detailPageCarouselImages = [
            { id: 1, categoryLabel: 'The Digital Frontier', categoryImages: [
                    { categoryId: 1, name: 'Skin Care', imageName: "img_4.jpg", type: 'photo', count: 42 },
                    { categoryId: 2, name: 'Cannabis', imageName: "img_1.jpg", type: 'photo', count: 42 },
                    { categoryId: 3, name: 'Business', imageName: "img_2.jpg", type: 'photo', count: 42 },
                    { categoryId: 4, name: 'Curated', imageName: "img_3.jpg", type: 'photo', count: 42 },
                    { categoryId: 5, name: 'Video', imageName: "xcJtL7QggTI", type: 'video', count: 42 },
                    { categoryId: 6, name: 'Autumn', imageName: "img_5.jpg", type: 'photo', count: 42 },
                    { categoryId: 7, name: 'Family', imageName: "img_6.jpg", type: 'photo', count: 42 },
                    { categoryId: 8, name: 'Halloween', imageName: "img_7.jpg", type: 'photo', count: 42 },
                    { categoryId: 9, name: 'Seniors', imageName: "img_8.jpg", type: 'photo', count: 42 },
                    { categoryId: 10, name: 'Cats & Dogs', imageName: "img_9.jpg", type: 'photo', count: 42 },
                    { categoryId: 11, name: 'Time to Party', imageName: "img_10.jpg", type: 'photo', count: 42 },
                    { categoryId: 12, name: 'Food', imageName: "xcJtL7QggTI", type: 'video', count: 42 },
                    { categoryId: 13, name: 'Cannabis', imageName: "img_1.jpg", type: 'photo', count: 42 },
                    { categoryId: 14, name: 'Business', imageName: "img_2.jpg", type: 'photo', count: 42 }
                ]
            }
        ];
        return { heroes, carouselImages, aosImages, userData, detailPageCarouselImages, detailPageInfo, marketFreeze, cartItemsData };
    }
    // Overrides the genId method to ensure that a hero always has an id.
    // If the heroes array is empty,
    // the method below returns the initial number (11).
    // if the heroes array is not empty, the method below returns the highest
    // hero id + 1.
    genId(heroes) {
        return heroes.length > 0 ? Math.max(...heroes.map(hero => hero.id)) + 1 : 11;
    }
};
InMemoryDataService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
        providedIn: 'root',
    })
], InMemoryDataService);



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
    }
    ngOnInit() {
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
    }
    get f() { return this.registerForm.controls; }
    onSubmit() {
        this.submitted = true;
        // stop here if form is invalid
        if (this.registerForm.invalid) {
            return;
        }
        this.authenticationService.register(this.registerForm.value)
            .pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_6__["first"])())
            .subscribe(data => {
            this.router.navigate(['/']);
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
    constructor(authenticationService, router) {
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
                this.priceArray.push(element.price);
            });
        }, error => {
        });
    }
    showTotalPrice() {
        return this.priceArray.reduce(function (acc, val) { return acc + val; }, 0);
    }
    redirectToCheckout() {
        this.router.navigate(['/checkout']);
    }
};
WishlistComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-wishlist',
        template: __webpack_require__(/*! raw-loader!./wishlist.component.html */ "./node_modules/raw-loader/index.js!./src/app/wishlist/wishlist.component.html"),
        styles: [__webpack_require__(/*! ./wishlist.component.css */ "./src/app/wishlist/wishlist.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
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

module.exports = __webpack_require__(/*! c:\xampp\htdocs\imagefootagenew\frontend\src\main.ts */"./src/main.ts");


/***/ })

},[[0,"runtime","vendor"]]]);
//# sourceMappingURL=main-es2015.js.map