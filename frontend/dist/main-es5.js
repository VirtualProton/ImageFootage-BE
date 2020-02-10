function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["main"], {
  /***/
  "./$$_lazy_route_resource lazy recursive":
  /*!******************************************************!*\
    !*** ./$$_lazy_route_resource lazy namespace object ***!
    \******************************************************/

  /*! no static exports found */

  /***/
  function $$_lazy_route_resourceLazyRecursive(module, exports) {
    function webpackEmptyAsyncContext(req) {
      // Here Promise.resolve().then() is used instead of new Promise() to prevent
      // uncaught exception popping up in devtools
      return Promise.resolve().then(function () {
        var e = new Error("Cannot find module '" + req + "'");
        e.code = 'MODULE_NOT_FOUND';
        throw e;
      });
    }

    webpackEmptyAsyncContext.keys = function () {
      return [];
    };

    webpackEmptyAsyncContext.resolve = webpackEmptyAsyncContext;
    module.exports = webpackEmptyAsyncContext;
    webpackEmptyAsyncContext.id = "./$$_lazy_route_resource lazy recursive";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/about-us/about-us.component.html":
  /*!****************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/about-us/about-us.component.html ***!
    \****************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppAboutUsAboutUsComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\r\n<section class=\"banner-area relative\">\r\n    <div class=\"overlay overlay-bg\"></div>\r\n    <div class=\"banner-content text-center\">\r\n      <h1>About Image Footage</h1>\r\n      <p>We are a privately owned group offering a variety of services that include,\r\n        <br />\r\n         stock imagery,stock footage, photography\r\n      </p>\r\n    </div>\r\n  </section>\r\n  <section class=\"pt-5 f-3 l-space  f-16 text-black bg-white\">\r\n  \r\n      <div class=\"container\">\r\n      <p>We are a privately owned diversified and deeply leveraged group, offering a variety of creative stock imagery & stock footage content.</p>\r\n      <p>The companies within the group cater for the ever evolving and exacting visual content and technology demands of leading corporates, creative agencies, and media organisations in the Asia Pacific & the Middle Eastern. With our networking capabilities, complementary resources, and the collaborative power to penetrate new markets, we add immense value to our affiliate businesses and clients. Our global creative network brings to the board an array of industry professionals and visual content to leading media and marketing enterprises across the Asia Pacific and the Middle East.</p>\r\n      <p>Speed and technology are critical to our operations as we strive to work behind the scenes for you as a frontline creative partner.</p>\r\n      <!--<p class=\"\">We are a privately owned group offering a variety of services that include stock imagery,stock footage, photography, image rendering, computer graphics (CG), 3D, and print publishing.</p>\r\n  <p>\r\n  The companies within the group cater to the ever evolving visual content and technology demands of leading corporationscreative agencies, and media organisations in the Asia Pacific & Middle Eastern Regions.With our networking capabilities, complementary resources, and the collaborative power to penetrate new markets,\r\n  </p>\r\n  <p>\r\n  we add immense value to our affiliate businesses and clients. Our global creative network combines an array of industryprofessionals and supply of visual content to leading media and marketing enterprises across the Asia Pacific and the Middle East.</p>\r\n  <p>\r\n  \r\n  Speed and technology are critical to our operations as we make things happen for you as a creative partner.</p>-->\r\n      \r\n      </div>\r\n    </section>\r\n    \r\n      ";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/app.component.html":
  /*!**************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/app.component.html ***!
    \**************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppAppComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<!-- <h1>{{title}}</h1>\r\n<nav>\r\n  <a routerLink=\"/dashboard\">Dashboard</a>\r\n  <a routerLink=\"/heroes\">Heroes</a>\r\n</nav> -->\r\n\r\n\r\n\r\n<app-header [dashboardCssEle]=\"dashboardEle\" [scrollEle]=\"minWidth()\" [footerCssEle]=\"footerEle\"></app-header>\r\n<ngx-spinner\r\n        bdOpacity = 0.9\r\n        bdColor = \"#333\"\r\n        size = \"medium\"\r\n        color = \"#fff\"\r\n        type = \"ball-running-dots\"\r\n        [fullScreen] = \"true\"\r\n>\r\n <p style=\"color: white\" > Loading... </p>\r\n</ngx-spinner>\r\n<router-outlet></router-outlet>\r\n<!-- <app-messages></app-messages>  -->\r\n<app-footer *ngIf=\"footerEle\"></app-footer>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/checkout/checkout.component.html":
  /*!****************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/checkout/checkout.component.html ***!
    \****************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppCheckoutCheckoutComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\r\n    <div class=\"loader\">\r\n        Loading\r\n        <span></span>\r\n    </div>\r\n</div>\r\n\r\n\r\n<section class=\"pt-50 mt-50\">\r\n\r\n    <div class=\"container\">\r\n\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-5 col-md-5 col-sm-6\">\r\n                <div class=\"card shadow\">\r\n                    <form class=\"loignForm p-5\" [formGroup]=\"checkoutForm\" (ngSubmit)=\"onSubmit()\">\r\n                        <h3 class=\"f-20 mb-3\">BILLING ADDRESS</h3>\r\n                        <div class=\"row form-group\">\r\n                            <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                <label>First Name</label>\r\n                                <input type=\"text\" formControlName=\"first_name\" [ngClass]=\"{ 'is-invalid': submitted && f.first_name.errors }\" class=\"form-control rounded-0\">\r\n                                <div *ngIf=\"submitted && f.first_name.errors\" class=\"invalid-feedback\">\r\n                                    <div *ngIf=\"f.first_name.errors.required\">First Name is required</div>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                <label>Last Name</label>\r\n                                <input type=\"text\" formControlName=\"last_name\" id=\"lname\" [ngClass]=\"{ 'is-invalid': submitted && f.last_name.errors }\" class=\"form-control\">\r\n                                <div *ngIf=\"submitted && f.last_name.errors\" class=\"invalid-feedback\">\r\n                                    <div *ngIf=\"f.last_name.errors.required\">Last Name is required</div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"form-group\">\r\n                            <label>Street Address</label>\r\n                            <textarea  class=\"form-control rounded-0\" rows=\"2\" style=\"min-height:70px;\" [ngClass]=\"{ 'is-invalid': submitted && f.address.errors }\" formControlName=\"address\"></textarea>\r\n                            <div *ngIf=\"submitted && f.address.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.address.errors.required\">Address is required</div>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"form-group\">\r\n                            <label>Country</label>\r\n                            <select class=\"form-control\" [ngClass]=\"{ 'is-invalid': submitted && f.country.errors }\"  formControlName=\"country\" (change)=\"onChangeCountry($event.target.value)\">\r\n                                <option value=\"\">Select</option>\r\n                                <option *ngFor=\"let country of countryInfo; let i = index\"  value=\"{{country.id}}\">{{country.name}}</option>\r\n                            </select>\r\n                            <div *ngIf=\"submitted && f.country.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.country.errors.required\">Country is required</div>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"form-group\">\r\n                            <label>State/province</label>\r\n                                <select class=\"form-control\" formControlName=\"state\" [ngClass]=\"{ 'is-invalid': submitted && f.state.errors }\" (change)=\"onChangeState($event.target.value)\">\r\n                                    <option *ngIf=\"stateInfo == ''\" value=\"-1\">--Select State--</option>\r\n                                    <option *ngFor=\"let state of stateInfo; let j = index\"  value=\"{{state.id}}\">{{state.state}}</option>\r\n                                </select>\r\n                            <div *ngIf=\"submitted && f.state.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.state.errors.required\">State is required</div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"form-group\">\r\n                            <label>City</label>\r\n                            <select class=\"form-control\" formControlName=\"city\" [ngClass]=\"{ 'is-invalid': submitted && f.city.errors }\" (change)=\"onChangeCity($event.target.value)\">\r\n                                <option *ngIf=\"cityInfo == ''\" value=\"-1\">--Select CIty--</option>\r\n                                <option *ngFor=\"let city of cityInfo; let k = index\"  value=\"{{city.id}}\">{{city.name}}</option>\r\n                            </select>\r\n                            <div *ngIf=\"submitted && f.city.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.city.errors.required\">City is required</div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"form-group\">\r\n                            <label>Zipcode</label>\r\n                                <input type=\"text\" class=\"form-control\" formControlName=\"pincode\"  [ngClass]=\"{ 'is-invalid': submitted && f.pincode.errors }\">\r\n                            <div *ngIf=\"submitted && f.pincode.errors\" class=\"invalid-feedback\" >\r\n                                <div *ngIf=\"f.pincode.errors.required\">ZipCode is required</div>\r\n                                <div *ngIf=\"f.pincode.errors.minlength || f.pincode.errors.maxlength\">ZipCode number should be 6 digits</div>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"form-group pt-3\">\r\n                            <button type=\"submit\" [disabled]=\"loading\"  class=\"btn btn-success btn-block text-white p-3 text-uppercase\"><strong>Enter Address\r\n                            </strong></button>\r\n                        </div>\r\n                    </form>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"col-lg-7 col-md-7 col-sm-6\">\r\n                <div class=\"card\">\r\n                    <div class=\"table-responsive\">\r\n                        <table class=\"table cart-table checkout-table\">\r\n                            <thead class=\"f-16\">\r\n                            <tr>\r\n                                <th colspan=\"3\"><h3 class=\"f-18\">CART</h3>\r\n                                    <p class=\"mb-0\">{{wishListDataItems.length}} Items</p></th>\r\n                                <th align=\"right\" class=\"text-right\"><button class=\"btn btn-default rounded-0\" (click)=\"goToWishList()\">Edit</button></th>\r\n\r\n                            </tr>\r\n                            </thead>\r\n                            <tbody>\r\n                            <tr *ngFor=\"let checkout of wishListDataItems;let i= index\">\r\n\r\n                                <td width=\"25%\" align=\"center\" *ngIf=\"checkout.product_web=='2'\">\r\n                                    <div class=\"product-info\">\r\n                                        <img src=\"{{checkout.product_thumb}}\" alt=\"product-img\" height=\"100\">\r\n                                    </div>\r\n                                </td>\r\n                                <td width=\"25%\" align=\"center\" *ngIf=\"checkout.product_web=='3'\">\r\n                                    <div class=\"product-info\">\r\n                                        <video  width=\"200\" height=\"150\" [poster]=\"'https://p5iconsp.s3-accelerate.amazonaws.com/'+checkout.product_main_footage\" controls controlsList=\"nodownload\"  onmouseover=\"this.play()\" onmouseout=\"this.load()\">\r\n                                            <source src=\"{{checkout.product_thumb}}\" type=\"video/mp4\">\r\n                                            Your browser does not support the video tag.\r\n                                        </video>\r\n                                    </div>\r\n                                </td>\r\n\r\n\r\n                                <td width=\"50%\">\r\n                                    <p class=\"mb-1 text-black\" style=\"display: inline-block;\"><strong>{{checkout.product_name}} #{{checkout.cart_product_id}}</strong>\r\n\r\n<!--                                        <a href=\"javascript:void()\" data-toggle=\"popover\"  data-html=\"true\" title=\"Image 2916217 - Large (2592 X 3872px)$75.00-->\r\n<!--\" data-placement=\"right\" data-content='-->\r\n<!-- <p class=\"mb-0 f-12\"><b>Size: X-Large (6720 X 4480PX)</b></p>-->\r\n<!--<p class=\"mb-0  f-12\">By <b>Thomas Pickard</b></p>-->\r\n<!--                           <p class=\"f-12\">A royalty free license for advertising, promotional and editorial use for one user. Print copies are limited to 500,000 and web use is unlimited.</p>'><i class=\"fa fa-exclamation-circle\"></i></a>-->\r\n\r\n<!--                                    </p>-->\r\n                                    <p class=\"mb-1\"><strong>Size:</strong>{{checkout.standard_type}}  {{checkout.standard_size}}</p>\r\n\r\n\r\n                                    <!-- <div class=\"clearfix\"></div>\r\n                                    <div class=\"mt-2\">\r\n\r\n                                    <a href=\"#\" class=\"btn btn-danger btn-sm f-12\"><i class=\"fa fa-times-circle\"></i> Remove</a>\r\n                                     <a href=\"#\" class=\"btn btn-success btn-sm f-12 text-white\"><i class=\"fa fa-heart\"></i> Wishlist</a>\r\n                                   </div> -->\r\n                                </td>\r\n                                <td width=\"25%\" align=\"right\"><p class=\"f-16 text-black\"><strong>{{checkout.total}} INR</strong></p>\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                            <tfoot class=\"text-black\">\r\n                            <tr class=\"f-20\">\r\n                                <td colspan=\"2\"></td>\r\n                                <td align=\"right\"><strong>TOTAL</strong></td>\r\n                                <td align=\"right\"><strong>{{showTotalPrice()}} INR</strong></td>\r\n                            </tr>\r\n                            <tr class=\"f-20\">\r\n                                <td colspan=\"2\"></td>\r\n                                <td align=\"right\"><strong>Taxes</strong></td>\r\n                                <td align=\"right\"><strong>10.00 INR</strong></td>\r\n                            </tr>\r\n                            <tr class=\"f-16\">\r\n                                <td colspan=\"2\"></td>\r\n                                <td align=\"right\"><strong>BALANCE DUE</strong></td>\r\n                                <td align=\"right\"><strong>{{showTotalPrice() + 10 }} INR</strong></td>\r\n                            </tr>\r\n                            </tfoot>\r\n                        </table>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"clearfix\"></div>\r\n\r\n\r\n                <h3 class=\"f-20 mb-4 mt-35\" *ngIf=\"paymentShow\">PAYMENT INFORMATION</h3>\r\n<!--                <form  [formGroup]=\"checkoutForm\">-->\r\n                <div class=\"row\" *ngIf=\"paymentShow\">\r\n\r\n                    <div class=\"col-xl-4 col-lg-4 col-md-4\">\r\n                        <div class=\"card shadow-sm text-center p-2\" (click)=\"onSubmitPayment('atom')\">\r\n                            <label class=\"mb-0\">\r\n<!--                                <input type=\"radio\" formControlName=\"paymentGatway\"  name=\"paymentGatway\" value=\"atom\" checked=\"checked\">-->\r\n                                <img src=\"/assets/images/atom.png\" alt=\"atom\">\r\n                            </label>\r\n                        </div>\r\n                    </div>\r\n\r\n                    <div class=\"col-xl-4 col-lg-4 col-md-4\">\r\n                        <div class=\"card shadow-sm text-center p-2\" (click)=\"onSubmitPayment('payu')\">\r\n                            <label class=\"mb-0\">\r\n<!--                                <input type=\"radio\"    name=\"paymentGatway\" value=\"payu\" >-->\r\n                                <img src=\"/assets/images/payu.png\" alt=\"payumoney\">\r\n                            </label>\r\n                        </div>\r\n\r\n<!--                        <div [innerHTML]=\"payuData\"></div>-->\r\n                   </div>\r\n\r\n                    <div class=\"col-xl-4 col-lg-4 col-md-4\">\r\n                        <div class=\"card shadow-sm text-center p-2\" (click)=\"onSubmitPayment('rozerpay')\">\r\n                            <label class=\"mb-0\">\r\n<!--                                <input type=\"radio\" formControlName=\"paymentGatway\"  id=\"customRadio2\" name=\"paymentGatway\" value=\"rozerpay\">-->\r\n                                <img src=\"/assets/images/rozorpay.png\" alt=\"Rozorpay\">\r\n                            </label>\r\n                        </div>\r\n                    </div>\r\n\r\n                </div>\r\n<!--                </form>-->\r\n\r\n\r\n\r\n\r\n            </div>\r\n\r\n        </div>\r\n\r\n\r\n\r\n    </div>\r\n</section>\r\n<!--<section class=\"mt-5\">-->\r\n<!--  -->\r\n<!--        <div class=\"container\"> -->\r\n<!--            <div class=\"row\">-->\r\n<!--                   <div class=\"col-lg-5 col-md-5 col-sm-6 bg-light\">-->\r\n<!--                      <div class=\"card z-depth-0\">-->\r\n<!--                     <form [formGroup]=\"checkoutForm\" (ngSubmit)=\"onSubmit()\" class=\"loignForm p-5\">-->\r\n<!--                     <h3 class=\"f-20 mb-3\">BILLING ADDRESS</h3>-->\r\n<!--                       <div class=\"row form-group\">-->\r\n<!--                       <div class=\"col-lg-6 col-md-6 col-sm-6\">-->\r\n<!--                         <label>First Name</label>-->\r\n<!--                           <input type=\"text\" formControlName=\"first_name\" [ngClass]=\"{ 'is-invalid': submitted && f.first_name.errors }\" class=\"form-control rounded-0\">-->\r\n<!--                           <div *ngIf=\"submitted && f.first_name.errors\" class=\"invalid-feedback\">-->\r\n<!--                               <div *ngIf=\"f.first_name.errors.required\">First Name is required</div>-->\r\n<!--                           </div>-->\r\n<!--                       </div>-->\r\n<!--                      -->\r\n<!--                       <div class=\"col-lg-6 col-md-6 col-sm-6\">-->\r\n<!--                         <label>Last Name</label>-->\r\n<!--                           <input type=\"text\" formControlName=\"last_name\" id=\"lname\" [ngClass]=\"{ 'is-invalid': submitted && f.last_name.errors }\"  class=\"form-control\">-->\r\n<!--                           <div *ngIf=\"submitted && f.last_name.errors\" class=\"invalid-feedback\">-->\r\n<!--                               <div *ngIf=\"f.last_name.errors.required\">Last Name is required</div>-->\r\n<!--                           </div>-->\r\n<!--                       </div>-->\r\n<!--                       -->\r\n<!--                        </div>-->\r\n<!--                        -->\r\n<!--                     <div class=\"form-group\">-->\r\n<!--                         <label>Street Address</label>-->\r\n<!--                         <textarea name=\"address\" id=\"address\" cols=\"5\" rows=\"1\" class=\"form-control\" placeholder=\"\" [ngClass]=\"{ 'is-invalid': submitted && f.address.errors }\" formControlName=\"address\"></textarea>-->\r\n<!--                         <div *ngIf=\"submitted && f.address.errors\" class=\"invalid-feedback\">-->\r\n<!--                             <div *ngIf=\"f.address.errors.required\">Address is required</div>-->\r\n<!--                         </div>-->\r\n<!--                       </div>-->\r\n<!--                       <div class=\"form-group\">-->\r\n<!--                             <label>Country</label>-->\r\n<!--                             <select class=\"form-control\" id=\"select-language1\" [ngClass]=\"{ 'is-invalid': submitted && f.country.errors }\"  formControlName=\"country\" (change)=\"onChangeCountry($event.target.value)\">-->\r\n<!--                                 <option *ngFor=\"let country of countryInfo; let i = index\"  value=\"{{country.id}}\">{{country.name}}</option>-->\r\n<!--                             </select>-->\r\n<!--                             <div *ngIf=\"submitted && f.country.errors\" class=\"invalid-feedback\">-->\r\n<!--                                 <div *ngIf=\"f.country.errors.required\">Country is required</div>-->\r\n<!--                             </div>-->\r\n<!--                         </div>-->\r\n<!--                       -->\r\n<!--                       <div class=\"row form-group pt-4\">-->\r\n<!--                       <div class=\"col-md-6 col-lg-6 col-sm-6\">-->\r\n<!--                         <label>State/province</label>-->\r\n<!--                           <select class=\"form-control\" id=\"select-language2\" formControlName=\"state\" [ngClass]=\"{ 'is-invalid': submitted && f.state.errors }\" (change)=\"onChangeState($event.target.value)\">-->\r\n<!--                               <option *ngIf=\"stateInfo == ''\" value=\"-1\">&#45;&#45;Select State&#45;&#45;</option>-->\r\n<!--                               <option *ngFor=\"let state of stateInfo; let j = index\"  value=\"{{state.id}}\">{{state.state}}</option>-->\r\n<!--                           </select>-->\r\n<!--                           <div *ngIf=\"submitted && f.state.errors\" class=\"invalid-feedback\">-->\r\n<!--                               <div *ngIf=\"f.state.errors.required\">State is required</div>-->\r\n<!--                           </div>-->\r\n<!--                       </div>-->\r\n<!--                           <div class=\"form-group\">-->\r\n<!--                               <label>City</label>-->\r\n<!--                               <select class=\"form-control\" id=\"select-language3\" formControlName=\"city\" [ngClass]=\"{ 'is-invalid': submitted && f.city.errors }\" (change)=\"onChangeCity($event.target.value)\">-->\r\n<!--                                   <option *ngIf=\"cityInfo == ''\" value=\"-1\">&#45;&#45;Select CIty&#45;&#45;</option>-->\r\n<!--                                   <option *ngFor=\"let city of cityInfo; let k = index\"  value=\"{{city.id}}\">{{city.name}}</option>-->\r\n<!--                               </select>-->\r\n<!--                               <div *ngIf=\"submitted && f.city.errors\" class=\"invalid-feedback\">-->\r\n<!--                                   <div *ngIf=\"f.city.errors.required\">City is required</div>-->\r\n<!--                               </div>-->\r\n<!--                           </div>-->\r\n<!--                           <div class=\"col-md-6 col-sm-6 col-lg-6\">-->\r\n<!--                         <label>Zipcode</label>-->\r\n<!--                               <input type=\"text\" id=\"pincode\" class=\"form-control\" formControlName=\"pincode\"  [ngClass]=\"{ 'is-invalid': submitted && f.pincode.errors }\">-->\r\n<!--                               <div *ngIf=\"submitted && f.pincode.errors\" class=\"invalid-feedback\" >-->\r\n<!--                                   <div *ngIf=\"f.pincode.errors.required\">ZipCode is required</div>-->\r\n<!--                                   <div *ngIf=\"f.pincode.errors.minlength || f.pincode.errors.maxlength\">ZipCode number should be 6 digits</div>-->\r\n<!--                               </div>-->\r\n<!--                       </div>-->\r\n<!--                       </div>-->\r\n<!--                       -->\r\n<!--                       <div class=\"form-group pt-3\">-->\r\n<!--                       -->\r\n\r\n<!--                         <div class=\"clearfix\"></div>-->\r\n<!--                         <hr>-->\r\n<!--                         <h3 class=\"f-20 mb-4 mt-5\">PAYMENT INFORMATION</h3>-->\r\n<!--    -->\r\n<!--                           <div class=\"row\">-->\r\n<!--                           <div class=\"col-md-8 col-sm-8 col-lg-8 col-xs-8\">-->\r\n<!--                             -->\r\n<!--                             <div class=\"custom-control custom-radio\">-->\r\n<!--        <input type=\"radio\" class=\"custom-control-input\" id=\"customRadio\" formControlName=\"paymentGatway\"  name=\"paymentGatway\" value=\"atom\" checked=\"\">-->\r\n<!--        <label class=\"custom-control-label\" for=\"customRadio\"><strong>Atom Payment Gateway</strong></label>-->\r\n<!--      </div>-->\r\n<!--                           </div>-->\r\n<!--    -->\r\n<!--                           <div class=\"col-md-4 col-sm-4 col-lg-4 col-xs-4\">-->\r\n<!--&lt;!&ndash;                             &ndash;&gt;-->\r\n<!--&lt;!&ndash;                             <span><img src=\"assets/images/visa.png\" class=\"border p-1\" height=\"24\"></span>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                             <span><img src=\"assets/images/mastarcard.png\"  class=\"border p-1\"  height=\"24\"></span>&ndash;&gt;-->\r\n<!--                           </div>-->\r\n<!--    -->\r\n<!--                         </div>-->\r\n<!--                           <div class=\"clearfix\"></div>-->\r\n<!--                           <div class=\"row\">-->\r\n<!--                               <div class=\"clearfix\"></div>-->\r\n<!--                               <div class=\"col-md-8 col-sm-8 col-lg-8 col-xs-8\">-->\r\n\r\n<!--                                   <div class=\"custom-control custom-radio\">-->\r\n<!--                                       <input type=\"radio\" class=\"custom-control-input\" formControlName=\"paymentGatway\"  id=\"customRadio1\" name=\"paymentGatway\" value=\"payu\">-->\r\n<!--                                       <label class=\"custom-control-label\" for=\"customRadio1\"><strong>PayUmoney Payment Gateway</strong></label>-->\r\n<!--                                   </div>-->\r\n<!--                               </div>-->\r\n\r\n<!--                               <div class=\"col-md-4 col-sm-4 col-lg-4 col-xs-4\">-->\r\n\r\n<!--&lt;!&ndash;                                   <span><img src=\"assets/images/visa.png\" class=\"border p-1\" height=\"24\"></span>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                                   <span><img src=\"assets/images/mastarcard.png\"  class=\"border p-1\"  height=\"24\"></span>&ndash;&gt;-->\r\n<!--                               </div>-->\r\n\r\n<!--                           </div>-->\r\n<!--                           <div class=\"clearfix\"></div>-->\r\n<!--                           <div class=\"clearfix\"></div>-->\r\n<!--                           <div class=\"row\">-->\r\n<!--                               <div class=\"col-md-8 col-sm-8 col-lg-8 col-xs-8\">-->\r\n\r\n<!--                                   <div class=\"custom-control custom-radio\">-->\r\n<!--                                       <input type=\"radio\" class=\"custom-control-input\" formControlName=\"paymentGatway\"  id=\"customRadio2\" name=\"paymentGatway\" value=\"rozerpay\">-->\r\n<!--                                       <label class=\"custom-control-label\" for=\"customRadio2\"><strong>Rozerpay Payment Gateway</strong></label>-->\r\n<!--                                   </div>-->\r\n<!--                               </div>-->\r\n\r\n<!--                               <div class=\"col-md-4 col-sm-4 col-lg-4 col-xs-4\">-->\r\n\r\n<!--&lt;!&ndash;                                   <span><img src=\"assets/images/visa.png\" class=\"border p-1\" height=\"24\"></span>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                                   <span><img src=\"assets/images/mastarcard.png\"  class=\"border p-1\"  height=\"24\"></span>&ndash;&gt;-->\r\n<!--                               </div>-->\r\n\r\n<!--                           </div>-->\r\n<!--                           <div class=\"clearfix\"></div>-->\r\n<!--                           <div class=\"clearfix\"></div>-->\r\n<!--&lt;!&ndash;                          <div class=\"row form-group mt-4\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       <div class=\"col-lg-12 col-md-12 col-sm-12\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <label>Credit Card Number</label>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <input type=\"number\" class=\"form-control rounded-0\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       </div>                  &ndash;&gt;-->\r\n<!--&lt;!&ndash;                        </div>&ndash;&gt;-->\r\n<!--    -->\r\n<!--&lt;!&ndash;                       <div class=\"row form-group\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                      <div class=\"col-md-8 col-lg-8 col-sm-8\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <label>Expiry Date</label>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <div class=\"row\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <div class=\"col-md-6 col-sm-6 col-lg-6\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <select class=\"form-control\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">MM</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">01</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">02</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">03</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         </select>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       </div>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       <div class=\"col-md-6 col-sm-6 col-lg-6\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <select class=\"form-control\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">YY</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">2019</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">2018</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                          <option value=\"\">2017</option>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         </select>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       </div>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       </div>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       </div>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                      &ndash;&gt;-->\r\n<!--&lt;!&ndash;&lt;!&ndash;                       <div class=\"col-lg-4 col-md-4 col-sm-4\">&ndash;&gt;&ndash;&gt;-->\r\n<!--&lt;!&ndash;&lt;!&ndash;                         <label>Security Code</label>&ndash;&gt;&ndash;&gt;-->\r\n<!--&lt;!&ndash;&lt;!&ndash;                         <input type=\"text\" class=\"form-control\" placeholder=\"CVV\">&ndash;&gt;&ndash;&gt;-->\r\n<!--&lt;!&ndash;&lt;!&ndash;                       </div>&ndash;&gt;&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       &ndash;&gt;-->\r\n<!--&lt;!&ndash;                        </div>&ndash;&gt;-->\r\n<!--    -->\r\n<!--&lt;!&ndash;                         <div class=\"row form-group\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       <div class=\"col-lg-12 col-md-12 col-sm-12\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <label>Name on Card</label>&ndash;&gt;-->\r\n<!--&lt;!&ndash;                         <input type=\"text\" class=\"form-control rounded-0\">&ndash;&gt;-->\r\n<!--&lt;!&ndash;                       </div>                  &ndash;&gt;-->\r\n<!--&lt;!&ndash;                        </div>&ndash;&gt;-->\r\n<!--                           <div class=\"row form-group\">-->\r\n<!--                               <button type=\"submit\" [disabled]=\"loading\"  class=\"btn btn-success btn-block text-white p-3 text-uppercase\"><strong>Make Payment-->\r\n<!--                           </strong>-->\r\n<!--                               </button>-->\r\n<!--                           </div>-->\r\n<!--                        -->\r\n<!--                       -->\r\n<!--                       </div>-->\r\n<!--                       -->\r\n<!--                       -->\r\n<!--                     </form>-->\r\n<!--                   </div>-->\r\n<!--                   -->\r\n<!--                   -->\r\n<!--                   </div>-->\r\n<!--                   -->\r\n<!--                   <div class=\"col-lg-7 col-md-7 col-sm-6\">-->\r\n<!--                    <div class=\"card\">-->\r\n<!--                    <div class=\"table-responsive\">-->\r\n<!--                      <table class=\"table cart-table checkout-table\">-->\r\n<!--                        <thead class=\"f-16\">-->\r\n<!--                          <tr>-->\r\n<!--                            <th colspan=\"2\"><h3 class=\"f-18\">CART</h3>-->\r\n<!--                            <p class=\"mb-0\">{{wishListDataItems.length}} Items</p></th>-->\r\n<!--                            <th align=\"right\" class=\"text-right\"><button class=\"btn btn-default rounded-0\" (click)=\"goToWishList()\">Edit</button></th>                          -->\r\n<!--                          </tr>-->\r\n<!--                        </thead>-->\r\n<!--                        <tbody>-->\r\n<!--                          <tr *ngFor=\"let checkout of wishListDataItems;let i= index\">-->\r\n<!--                            <td width=\"25%\" align=\"center\" *ngIf=\"checkout.product_web=='2'\">-->\r\n<!--                              <div class=\"product-info\">-->\r\n<!--                                <img src=\"{{checkout.product_thumb}}\" alt=\"product-img\" height=\"100\">-->\r\n<!--                              </div>-->\r\n<!--                            </td>-->\r\n<!--                              <td width=\"25%\" align=\"center\" *ngIf=\"checkout.product_web=='3'\">-->\r\n<!--                                  <div class=\"product-info\">-->\r\n<!--                                      <video  width=\"200\" height=\"150\" controls onmouseover=\"this.play()\" onmouseout=\"this.pause()\">-->\r\n<!--                                          <source src=\"{{checkout.product_thumb}}\" type=\"video/mp4\">-->\r\n<!--                                          Your browser does not support the video tag.-->\r\n<!--                                      </video>-->\r\n<!--                                  </div>-->\r\n<!--                            </td>-->\r\n<!--                            <td width=\"50%\">-->\r\n<!--                               <p class=\"mb-1 text-black\"><strong>{{checkout.product_name}}</strong></p>-->\r\n<!--                               <p class=\"mb-1\"><strong>Size:</strong>  {{checkout.standard_size}}</p>-->\r\n<!--                            </td>-->\r\n<!--                             <td width=\"25%\" align=\"right\"><p class=\"f-16 text-black\"><strong>{{checkout.total}} INR</strong></p>-->\r\n<!--                             </td>-->\r\n<!--                          </tr>-->\r\n<!--                        </tbody>-->\r\n<!--                        <tfoot class=\"text-black\">-->\r\n<!--                          <tr class=\"f-20\">-->\r\n<!--                          <td></td>-->\r\n<!--                            <td align=\"right\"><strong>TOTAL</strong></td>-->\r\n<!--                            <td align=\"right\"><strong>{{showTotalPrice()}} INR</strong></td>-->\r\n<!--                          </tr>-->\r\n<!--                          <tr class=\"f-20\">-->\r\n<!--                              <td></td>-->\r\n<!--                              <td align=\"right\"><strong>Taxes</strong></td>-->\r\n<!--                              <td align=\"right\"><strong>10.00 INR</strong></td>-->\r\n<!--                          </tr>-->\r\n<!--                          <tr class=\"f-16\">-->\r\n<!--                          <td></td>-->\r\n<!--                            <td align=\"right\"><strong>BALANCE DUE</strong></td>-->\r\n<!--                            <td align=\"right\"><strong>{{showTotalPrice() + 10 }} INR</strong></td>-->\r\n<!--                          </tr>-->\r\n<!--                        </tfoot>-->\r\n<!--                      </table>-->\r\n<!--                    </div>-->\r\n<!--                  </div>-->\r\n<!--               </div>-->\r\n<!--                -->\r\n<!--            </div>-->\r\n<!--        </div>-->\r\n<!--      </section>-->\r\n\r\n\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/contact-us/contact-us.component.html":
  /*!********************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/contact-us/contact-us.component.html ***!
    \********************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppContactUsContactUsComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<style>\r\n  body{background-color: #fff !important;}\r\n  .text-black{color:#000 !important;}\r\n  </style>\r\n  \r\n<section class=\"banner-area relative\">\r\n    <div class=\"overlay overlay-bg\"></div>\r\n    <div class=\"banner-content text-center\">\r\n      <h1>Contact Us</h1>\r\n      <p>\r\n        Elementum libero hac leo integer. Risus hac parturient feugiat litora\r\n        <br />\r\n        cursus hendrerit bibendum per\r\n      </p>\r\n    </div>\r\n  </section>\r\n  <section class=\"contact-page-area section-gap bg-white\">\r\n    <div class=\"container\">\r\n      <div class=\"row\">\r\n       \r\n        <div class=\"col-lg-4 col-md-4 d-flex flex-column address-wrap text-black f-3\">\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\"><span class=\"icon-home2 mr-1\"></span></div>\r\n            <div class=\"contact-details\">\r\n                <h5> PO Box 390667 Dubai - UAE</h5>\r\n                <!--<p>Hyderabad , Telangana,India,Zip Code: 5000029</p>-->\r\n            </div>\r\n          </div>\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\">\r\n              <span class=\"icon-phone2 mr-1\"></span>\r\n            </div>\r\n            <div class=\"contact-details\">\r\n              <h5>18004198123</h5>\r\n              <p>Mon to Fri 10am to 6 pm</p>\r\n            </div>\r\n          </div>\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n            <div class=\"icon f-22\"><span class=\"icon-envelope-o mr-1\"></span></div>\r\n            <div class=\"contact-details\">\r\n              <h5>info@imagefootage.com</h5>\r\n              <p>Send us your query anytime!</p>\r\n            </div>\r\n          </div>\r\n          <div class=\"single-contact-address d-flex flex-row\">\r\n           \r\n            <div class=\"contact-details\">\r\n              <p>Contributors are invited to email content to info@imagefootage.com until such time our uploading feature becomes functional soon. </p>\r\n            </div>\r\n          </div>\r\n          \r\n        </div>\r\n        <div class=\"col-lg-8\">\r\n          <form class=\"form-area contact-form text-right\"  id=\"myForm\" [formGroup]=\"contactForm\" (ngSubmit)=\"onContactSubmit()\">\r\n            <div class=\"row\">\r\n              <div class=\"col-lg-6 form-group\">\r\n                <input name=\"name\" formControlName=\"user_name\" [ngClass]=\"{ 'is-invalid': submitted && f.user_name.errors }\"   placeholder=\"Enter your name\"  class=\"common-input mb-20 form-control\"   type=\"text\" />\r\n                <div *ngIf=\"submitted && f.user_name.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_name.errors.required\">Name is required</div>\r\n                </div>\r\n                <input name=\"email\" type=\"text\" placeholder=\"Enter email address\" class=\"common-input mb-20 form-control\" formControlName=\"user_email\" [ngClass]=\"{ 'is-invalid': submitted && f.user_email.errors }\"/>\r\n                <div *ngIf=\"submitted && f.user_email.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_email.errors.required\">Email is required</div>\r\n                    <div *ngIf=\"f.user_email.errors.email\">Email must be a valid email address</div>\r\n                </div>\r\n                <input  name=\"subject\" placeholder=\"Enter subject\"  class=\"common-input mb-20 form-control\" type=\"text\"  formControlName=\"user_subject\" [ngClass]=\"{ 'is-invalid': submitted && f.user_subject.errors }\"/>\r\n                <div *ngIf=\"submitted && f.user_subject.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_subject.errors.required\">Subject is required</div>\r\n                </div>\r\n                <input placeholder=\"Enter mobile number\"  class=\"common-input mb-20 form-control\" pattern=\"[0-9]*\"  type=\"text\" id=\"mbnum\" formControlName=\"mobile_number\" [ngClass]=\"{ 'is-invalid': submitted && f.mobile_number.errors }\" class=\"form-control text-white\">\r\n                <div *ngIf=\"submitted && f.mobile_number.errors\" class=\"invalid-feedback\">\r\n                  <div *ngIf=\"f.mobile_number.errors.required\">Mobile Number is required</div>\r\n                  <div *ngIf=\"f.mobile_number.errors.minlength || f.mobile_number.errors.maxlength\">Mobile number should be 10 digits</div>\r\n                  <div *ngIf=\"f.mobile_number.errors.pattern\">Mobile numberr should be only numbers</div>\r\n                </div>\r\n              </div>\r\n              <div class=\"col-lg-6 form-group\">\r\n                <textarea  class=\"common-textarea form-control\"  name=\"message\" formControlName=\"user_message\" [ngClass]=\"{ 'is-invalid': submitted && f.user_message.errors }\" placeholder=\"Enter Messege\"  ></textarea>\r\n                <div *ngIf=\"submitted && f.user_message.errors\" class=\"invalid-feedback\">\r\n                    <div *ngIf=\"f.user_message.errors.required\">Message is required</div>\r\n                </div>\r\n              </div>\r\n              <div class=\"col-lg-12\">\r\n                <div class=\"alert-msg\" style=\"text-align: left;\"></div>\r\n                <button  [disabled]=\"loading\" type=\"submit\" class=\"primary-btn text-uppercase\"   style=\"float: right;\">Send Message </button>\r\n              </div>\r\n            </div>\r\n          </form>\r\n        </div>\r\n      </div>\r\n      \r\n       <!--<div class=\"row pt-5\">\r\n       <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.6762131588266!2d55.116284314478484!3d24.90902374944515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f0c9e12ebbfeb%3A0xf712e81682699f46!2sDubai%20South%20Business%20Centre!5e0!3m2!1sen!2sin!4v1580188294475!5m2!1sen!2sin\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>\r\n       </div>-->\r\n    </div>\r\n  </section>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/contributor-sign-up/contributor-sign-up.component.html":
  /*!**************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/contributor-sign-up/contributor-sign-up.component.html ***!
    \**************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppContributorSignUpContributorSignUpComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\r\n    <div class=\"loader\">\r\n        Loading\r\n        <span></span>\r\n    </div>\r\n</div>\r\n<section class=\"mt-0\">\r\n    <div class=\"container\"> \r\n        <div class=\"col-md-11 col-xl-11 col-lg-11 col-sm-11 m-auto\">    \r\n            <div class=\"card shadow\">\r\n                <div class=\"row\">\r\n                   <div class=\"col-lg-5 col-md-5 col-sm-6 con-bg\">\r\n                        <div class=\"layer\">\r\n                            <div class=\"p-5\">\r\n                                <div class=\"col-12\">\r\n                                    <p class=\"text-white f-24 mb-0\"><i class=\"flaticon-user f-30\"></i> Register</p>\r\n                                    <p class=\"text-light\">Sign up for a Contributor account.</p>\r\n                                </div> \r\n                                <div class=\"col-12 pt-5 pb-5\">\r\n                                    <p class=\"text-white f-24 mb-0\"><i class=\"flaticon-upload f-30\"></i> Upload</p>\r\n                                    <p class=\"text-light\">Upload your original photos, vector illustrations or video footage.</p>\r\n                                </div>      \r\n                                <div class=\"col-12\">\r\n                                    <p class=\"text-white f-24 mb-0\"><i class=\"flaticon-money f-30\"></i> Earn!</p>\r\n                                    <p class=\"text-light\">Whenever a Buyer downloads your content, you earn!\r\n                                    <a href=\"#\" class=\"text-warning\">*Earn up to 60% commissions.</a></p>\r\n                                </div>\r\n                            </div>\r\n                        </div>                     \r\n                   </div>\r\n                   <div class=\"col-lg-7 col-md-7 col-sm-6\">\r\n                        <form [formGroup]=\"contributorForm\" (ngSubmit)=\"onSubmit()\"   class=\"loignForm pt-3 pb-3 pl-5 pr-5\" *ngIf=\"otp==false\">\r\n                            <p class=\"text-right\">Already a member? <a href=\"javascript:void()\" (click)=\"clickLoginPopup()\" > Sign in Here</a></p>\r\n                            <h3 class=\"f-26 mb-3 font-normal text-center\">Sign Up As A Image Footage Content Contributor</h3>\r\n                            <div class=\"success\" *ngIf=\"success_message!=null\" style=\"color:green;\">{{success_message}}</div>\r\n                            <div class=\"error\" *ngIf=\"error_message!=null\" style=\"color:red;\">{{error_message}}</div>\r\n                            <div class=\"row form-group mt-4\">\r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6 pl-2\">\r\n                                    <label>First Name</label>\r\n                                    <input type=\"text\" formControlName=\"contributor_fname\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_fname.errors }\" class=\"form-control rounded-0\">\r\n                                    <div *ngIf=\"submitted && f.contributor_fname.errors\" class=\"invalid-feedback\">\r\n                                        <div *ngIf=\"f.contributor_fname.errors.required\">First Name is required</div>\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6 pr-2\">\r\n                                    <label>Last Name</label>\r\n                                    <input type=\"text\"  formControlName=\"contributor_lname\" class=\"form-control\"  [ngClass]=\"{ 'is-invalid': submitted && f.contributor_lname.errors }\">\r\n                                    <div *ngIf=\"submitted && f.contributor_lname.errors\" class=\"invalid-feedback\">\r\n                                        <div *ngIf=\"f.contributor_lname.errors.required\">Last Name is required</div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"row form-group mt-4\">\r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6 pl-2\">\r\n                                    <label>User Name</label>\r\n                                    <input type=\"text\" formControlName=\"contributor_name\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_name.errors }\" class=\"form-control rounded-0\">\r\n                                    <div *ngIf=\"submitted && f.contributor_name.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.contributor_name.errors.required\">User Name is required</div>\r\n                                    </div>\r\n                                </div>                      \r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6 pr-2\">\r\n                                    <label>Email Name</label>\r\n                                    <input type=\"email\"  formControlName=\"contributor_email\" class=\"form-control\"  [ngClass]=\"{ 'is-invalid': submitted && f.contributor_email.errors }\">\r\n                                    <div *ngIf=\"submitted && f.contributor_email.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.contributor_email.errors.required\">Email is required</div>\r\n                                            <div *ngIf=\"f.contributor_email.errors.email\">Email must be a valid email address</div>\r\n                                    </div>\r\n                                </div>                       \r\n                            </div> \r\n                            <div class=\"row form-group mt-4 pos-rel\">\r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6 pl-2\">\r\n                                    <label>Password</label>\r\n                                    <input type=\"password\" formControlName=\"contributor_password\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_password.errors }\" class=\"form-control rounded-0\">\r\n                                    <a href=\"#\" class=\"icon_view\"><i class=\"flaticon-view\"></i></a>\r\n                                    <div *ngIf=\"submitted && f.contributor_password.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.contributor_password.errors.required\">Password is required</div>\r\n                                            <div *ngIf=\"f.contributor_password.errors.minlength\">Password must be at least 6 characters</div>\r\n                                    </div>\r\n                                </div>                      \r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6 pr-2\">\r\n                                    <label>Phone No</label>\r\n                                    <input type=\"tel\" formControlName=\"contributor_mobile\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_mobile.errors }\"   class=\"form-control\">\r\n                                    <div *ngIf=\"submitted && f.contributor_mobile.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.contributor_mobile.errors.required\">PhoneNumber is required</div>\r\n                                            <div *ngIf=\"f.contributor_mobile.errors.pattern\">PhoneNumber should be 10 number digits</div>\r\n                                    </div>\r\n                                </div>                       \r\n                            </div>    \r\n                            <div class=\"row form-group\">\r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                    <label>Contributor Type</label>\r\n<!--                                    <input type=\"text\" formControlName=\"contributor_type\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_type.errors }\" class=\"form-control rounded-0\">-->\r\n                                    <select formControlName=\"contributor_type\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_type.errors }\" class=\"form-control\">\r\n                                        <option value=\"\">Select</option>\r\n                                        <option value=\"sale\">Sale</option>\r\n                                        <option value=\"doner\">Doner</option>\r\n                                    </select>\r\n                                    <div *ngIf=\"submitted && f.contributor_type.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.contributor_type.errors.required\">Contributor Type is required</div>\r\n                                    </div>\r\n                                </div>                      \r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                    <label>Id proof (Aadhar/Voter ID/Pan Card/Passport) Any</label>\r\n<!--                                    <input type=\"text\"  formControlName=\"contributor_idproof\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_idproof.errors }\" class=\"form-control\">-->\r\n                                    <input type=\"file\" formControlName=\"contributor_idproof\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_idproof.errors }\" class=\"form-control\" id=\"file\" (change)=\"handleFileInput($event.target.files)\">\r\n                                    <div *ngIf=\"submitted && f.contributor_idproof.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.contributor_idproof.errors.required\">Id proof is required</div>\r\n                                    </div>\r\n                                </div>                       \r\n                            </div>       \r\n                            <div class=\"row form-group\">\r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                    <label>Bank Holder Name</label>\r\n                                    <input type=\"text\"  formControlName=\"bank_holder_name\" [ngClass]=\"{ 'is-invalid': submitted && f.bank_holder_name.errors }\"  class=\"form-control rounded-0\">\r\n                                    <div *ngIf=\"submitted && f.bank_holder_name.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.bank_holder_name.errors.required\">Bank holder name is required</div>\r\n                                    </div>\r\n                                </div>                      \r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                    <label>Bank Name</label>\r\n                                    <input type=\"text\"   formControlName=\"bank_name\" [ngClass]=\"{ 'is-invalid': submitted && f.bank_name.errors }\" class=\"form-control\">\r\n                                    <div *ngIf=\"submitted && f.bank_name.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.bank_name.errors.required\">Bank name is required</div>\r\n                                    </div>\r\n                                </div>                   \r\n                            </div>     \r\n                           <div class=\"row form-group\">\r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                    <label>Bank Account Number</label>\r\n                                    <input type=\"text\" formControlName=\"bank_account_number\" [ngClass]=\"{ 'is-invalid': submitted && f.bank_account_number.errors }\" class=\"form-control rounded-0\">\r\n                                    <div *ngIf=\"submitted && f.bank_account_number.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.bank_account_number.errors.required\">Bank account number is required</div>\r\n                                            <div *ngIf=\"f.bank_account_number.errors.pattern\">Invalid Bank Number</div>\r\n\r\n                                    </div>\r\n                                </div>                      \r\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\r\n                                    <label>IFSC Number</label>\r\n                                    <input type=\"text\" formControlName=\"ifsc_number\" [ngClass]=\"{ 'is-invalid': submitted && f.ifsc_number.errors }\" class=\"form-control\">\r\n                                    <div *ngIf=\"submitted && f.ifsc_number.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.ifsc_number.errors.required\">IFSC number is required</div>\r\n                                    </div>\r\n                                </div>                       \r\n                            </div>    \r\n                        \r\n                            <div class=\"form-group\">                         \r\n                                <div class=\"custom-control custom-checkbox\">\r\n                                    <input type=\"checkbox\" class=\"custom-control-input\" formControlName=\"contributor_acceptTerms\" [ngClass]=\"{ 'is-invalid': submitted && f.contributor_acceptTerms.errors }\"  id=\"customCheck\">\r\n                                    <label class=\"custom-control-label\" for=\"customCheck\">Include my portfolio under the <a href=\"javascript:void()\" target=\"_blank\">Extended License</a> sale terms</label>\r\n                                    <div *ngIf=\"submitted && f.contributor_acceptTerms.errors\" class=\"invalid-feedback\">\r\n                                            <div *ngIf=\"f.contributor_acceptTerms.errors.required\">Please accept Terms & Conditions</div>\r\n                                    </div>  \r\n                                </div>\r\n                            </div>                                         \r\n                            <div class=\"form-group pt-3\">                            \r\n                                <button type=\"button\" [disabled]=\"loading\" type=\"submit\" class=\"btn btn-success btn-block text-white p-3 text-uppercase\"><strong>Sign Up\r\n                                </strong></button>                                \r\n                            </div>                     \r\n                        </form>\r\n                        <form [formGroup]=\"contributorotpForm\" (ngSubmit)=\"onSubmitotp()\"   class=\"loignForm pt-3 pb-3 pl-5 pr-5\" *ngIf=\"otp==true\">\r\n\r\n                           <h3 class=\"f-26 mb-3 font-normal text-center\">Sign Up As A Image Footage Content Contributor</h3>\r\n                            <div class=\"success\" *ngIf=\"success_message!=null\" style=\"color:green;\">{{success_message}}</div>\r\n                            <div class=\"error\" *ngIf=\"error_message!=null\" style=\"color:red;\">{{error_message}}</div>\r\n                           <div class=\"row form-group mt-4\" *ngIf=\"completflag==false\" >\r\n                               <div class=\"col-lg-6 col-md-6 col-sm-6 pl-2\">\r\n                                   <label>Enter OTP</label>\r\n                                   <input type=\"text\" formControlName=\"otp\" [ngClass]=\"{ 'is-invalid': submitted && o.otp.errors }\" class=\"form-control rounded-0\">\r\n                                   <div *ngIf=\"submitted && o.otp.errors\" class=\"invalid-feedback\">\r\n                                       <div *ngIf=\"o.otp.errors.required\">OTP is Required</div>\r\n                                   </div>\r\n                               </div>\r\n                               <div class=\"col-lg-6 col-md-6 col-sm-6 pr-2\">\r\n                                        <input type=\"button\" class=\"btn btn-success btn-block text-white p-1 text-uppercase\" value=\"Resend OTP\" (click)=\"resend_otp()\" />\r\n                               </div>\r\n                           </div>\r\n                           <div class=\"form-group pt-3\" *ngIf=\"completflag==false\">\r\n                               <button type=\"button\"[disabled]=\"loading\" type=\"submit\" class=\"btn btn-success btn-block text-white p-3 text-uppercase\"><strong>Verify OTP\r\n                               </strong></button>\r\n                           </div>\r\n                       </form>\r\n\r\n                   </div>\r\n                </div>                \r\n            </div>\r\n        </div>                 \r\n    </div>\r\n</section>\r\n\r\n<ng-container *ngIf=\"showloginPopup\">\r\n    <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n</ng-container>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/dashboard/dashboard.component.html":
  /*!******************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/dashboard/dashboard.component.html ***!
    \******************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppDashboardDashboardComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"video-background-holder\">\r\n  <div class=\"video-background-overlay\"></div>\r\n  <video playsinline=\"playsinline\" autoplay  loop [muted]=\"'muted'\" poster=\"https://imagefootage.com/video/Screenshot.png\" >\r\n        <source src=\"https://imagefootage.com/video/cpw-converted and-taken 27 sec.mp4\" type=\"video/mp4\" >\r\n  </video>\r\n  <div class=\"video-background-content container h-100\">\r\n    <div class=\"d-flex h-100 text-center align-items-center\">\r\n      <div class=\"col-md-10 col-sm-10 col-lg-10 m-auto\">\r\n      <div class=\"w-100 text-white vedio_text\">\r\n        <h1 class=\"display-4\" style=\"font-size: 2rem\"><strong>As Real as it Gets…<br>Bring to Life Your Vision.</strong></h1>\r\n           \r\n          <form class=\"search_m\">\r\n    <div class=\"input-group search-bar\">\r\n          <div class=\"input-group-btn\" ngbDropdown >\r\n            <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle >\r\n             <span *ngIf='searchBoxLabel == 1'>Photos Only</span>\r\n             <span *ngIf='searchBoxLabel == 2'>Videos Only</span>\r\n             <!--<span *ngIf='searchBoxLabel == 3'>Photos + Videos</span>-->\r\n\r\n\r\n            </button>\r\n            <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\" style=\"top:-162px !important;min-width: 200px;\">\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('1')\" ngbDropdownItem style=\"padding: 15px 10px;\"><i class=\"\"></i> Photos Only</a>\r\n              <!--<a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('3')\" ngbDropdownItem style=\"padding: 15px 10px;\">Photos + Videos</a>-->\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('2')\" ngbDropdownItem style=\"padding: 15px 10px;\">Videos Only</a>\r\n               </div>\r\n          </div>\r\n          <input type=\"text\" class=\"form-control\" #searchBoxEle  aria-label=\"Text input with dropdown button\" (keyup.enter)=\"searchAosData(searchBoxEle.value)\">\r\n          <a href=\"javascript:void(0)\" class=\"iconSearch\" (click)=\"searchAosData(searchBoxEle.value)\"><span class=\"fa fa-search text-gray\"></span></a>\r\n        </div>\r\n  </form>\r\n      </div>\r\n    </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<!--<header class=\"masthead\">\r\n    <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n            <video id=\"theVideo\" autoplay=\"autoplay\" loop=\"loop\" controls=\"controls\" muted=\"muted\" style=\"position: absolute;\r\n    display: block;\r\n    z-index: -1;\r\n    top: 0;\r\n    left: 0;\r\n    object-fit: cover;\r\n    height: 100%;\r\n    min-width: 100%;\" poster=\"https://imagefootage.com/img/bg.png\"><source src=\"https://imagefootage.com/video/VIDEO_2_25MB_home.mp4\" type=\"video/mp4\"></video>\r\n        </div>\r\n      <div class=\"intro-text\">\r\n      \r\n        <div class=\"intro-lead-in text-warning\">Bring Your Vision to Life</div>\r\n        <div class=\"intro-heading text-uppercase\">Without Compromise</div>\r\n        <div class=\"col-md-9 col-sm-9 m-auto\">\r\n            <form class=\"search_m\">\r\n    <div class=\"input-group\">\r\n          <div class=\"input-group-btn\" ngbDropdown >\r\n            <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n             <span *ngIf='searchBoxLabel == 1'>Photos Only</span>\r\n             <span *ngIf='searchBoxLabel == 2'>Videos Only</span>\r\n             <span *ngIf='searchBoxLabel == 3'>Photos + Videos</span>\r\n\r\n\r\n            </button>\r\n            <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('1')\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('3')\" ngbDropdownItem>Photos + Videos</a>\r\n              <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick('2')\" ngbDropdownItem>Videos Only</a>\r\n               </div>\r\n          </div>\r\n          <input type=\"text\" class=\"form-control\" #searchBoxEle  aria-label=\"Text input with dropdown button\">\r\n          <a href=\"javascript:void(0)\" class=\"iconSearch\" (click)=\"searchAosData(searchBoxEle.value)\"><span class=\"icon-search\"></span></a>\r\n        </div>\r\n  </form>\r\n        \r\n        </div>\r\n      </div>\r\n    </div>\r\n  </header>-->\r\n\r\n  <div class=\"site-wrap\">\r\n    <div class=\"container-fluid text-center my-5\">\r\n      <div class=\"row mx-auto my-auto\">\r\n          <div id=\"recipeCarousel\" class=\"carousel slide w-100\">\r\n              <div class=\"carousel-inner\" role=\"listbox\">\r\n               <ngb-carousel [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"0\" [pauseOnHover]=\"true\">\r\n                    <div class=\"carousel-item\">\r\n                        <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages;let i= index\">\r\n                          <div class=\"col-11 m-auto\">\r\n                              <div class=\"row\">\r\n                                    <div class=\"col-md-2 col-sm-2 col-4 text-center\" *ngFor=\"let images of carouseimges.categoryNames\">\r\n                                      <a href=\"javascript:void(0)\" [routerLink]=\"['/search']\" [queryParams]=\"{type:1,keyword:images.category_name}\">{{images.category_name}}</a>\r\n                                    </div>\r\n                              </div>\r\n                          </div>\r\n                        </ng-template>\r\n                    </div>\r\n                </ngb-carousel>\r\n\r\n                \r\n              </div>\r\n\r\n            </div>\r\n        </div>\r\n      </div>\r\n      <main class=\"main-content mt-3\">\r\n          <div class=\"container-fluid photos\">\r\n            <div class=\"row align-items-stretch\">\r\n\r\n                <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n                    <a *ngIf=\"aosimges.product_web == '2' || aosimges.product_web == '1'\" routerLink=\"/detail/{{aosimges.api_product_id}}/{{aosimges.product_web}}/{{aosimges.product_main_type}}\" class=\"d-block photo-item\">\r\n\r\n                      <img  src=\"{{aosimges.product_thumbnail}}\" alt=\"Image\" class=\"img-fluid\">\r\n\r\n                        <!-- <iframe  *ngIf=\"aosimges.mimetype != 'image/jpeg'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe> (mouseover)=\"returnonposter(htmlVideoElement)\" -->\r\n                      <div class=\"photo-text-more\">\r\n                      \r\n                        <div class=\"photo-text-more\">\r\n                        <h3 class=\"heading\">{{aosimges.product_title}}</h3>\r\n                        <span class=\"meta\">{{aosimges.product_description}}</span>\r\n                        <p class=\"icons_thum\">\r\n                            <span><i class=\"fa fa-image\"></i></span>\r\n                            <span><i class=\"fa fa-heart\"></i></span>\r\n                            <span><i class=\"fa fa-plus\"></i></span>\r\n                        </p>\r\n                      </div>\r\n                      </div>\r\n                    </a>\r\n                    <a  *ngIf=\"aosimges.product_web == '3'\" routerLink=\"/detail/{{aosimges.api_product_id}}/{{aosimges.product_web}}/{{aosimges.product_main_type}}\" class=\"d-block \">\r\n                    <span style=\"position:absolute;margin-left:10px;margin-top:5px;\"><i class=\"fa fa-video-camera\" aria-hidden=\"true\"></i></span>\r\n                         <video   width=\"400\" height=\"300\" [muted]=\"'muted'\" [poster]=\"aosimges.product_thumbnail\" #htmlVideoElement onmouseover=\"this.play()\"   onmouseout=\"this.load()\"  style=\"width: 100% !important;background: #7d494957; object-fit: cover;\">\r\n                            <source src=\"{{aosimges.product_main_image}}\" type=\"video/mp4\" >\r\n                            Your browser does not support the video tag.\r\n                        </video>\r\n                        <!-- <iframe  *ngIf=\"aosimges.mimetype != 'image/jpeg'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>  -->\r\n                        <div class=\"photo-text-more\">\r\n                      \r\n                        <!--<div class=\"photo-text-more\">\r\n                        <h3 class=\"heading\">{{aosimges.product_title}}</h3>\r\n                        <span class=\"meta\">{{aosimges.product_description}}</span>\r\n                        <br />\r\n                        <p class=\"icons_thum\" >\r\n                        \t\r\n                            <span><i class=\"fa fa-image\"></i></span>\r\n                            <span><i class=\"fa fa-heart\"></i></span>\r\n                            <span><i class=\"fa fa-plus\"></i></span>\r\n                        </p>\r\n                      </div>-->\r\n                      </div>\r\n                 </a>\r\n                </div>\r\n\r\n           </div>\r\n\r\n            \r\n\r\n            <!--<div class=\"col-md-5 col-sm-6 col-12 m-auto pagination_d \" *ngIf=\"aoslSliderImagesData.length !=0\"> \r\n                    <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\"\r\n                     [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\"\r\n                     (pageChange)=\"onPageChange($event)\" [boundaryLinks]=\"true\"></ngb-pagination>\r\n            </div>-->\r\n\r\n          </div>\r\n      </main>\r\n          \r\n\r\n\r\n    </div>\r\n<!-- <app-hero-search></app-hero-search> -->\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/footer/footer.component.html":
  /*!************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/footer/footer.component.html ***!
    \************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppFooterFooterComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<footer>\r\n\r\n    <div class=\"container\">\r\n      \r\n      \r\n        <div class=\"row\">\r\n           <div class=\"col-md-4 col-sm-4\">\r\n              <h3>About Image Footage</h3>\r\n              <p>We are a privately owned diversified and deeply leveraged group, offering a variety of creative stock imagery & stock footage content.</p>\r\n           \r\n           </div>\r\n           \r\n           <div class=\"col-md-3 col-sm-3 offset-md-1 offset-sm-1\">\r\n              <h3>Quick Links</h3>\r\n             <ul>\r\n               <li><a routerLink=\"/aboutUs\">About Us</a></li>\r\n                <li><a routerLink=\"/contactUs\">Contact Us</a></li>\r\n                 <li><a routerLink=\"/license\">License Agreement</a></li>\r\n                  <li><a routerLink=\"/terms\">Terms & Conditions</a></li>\r\n                   <li><a routerLink=\"/privacy\">Privacy Policy</a></li>\r\n                    <!--<li><a routerLink=\"/tagging\">Tagging tutorial</a></li>-->\r\n                     \r\n             </ul>\r\n           \r\n           </div>\r\n           \r\n           <div class=\"col-md-4 col-sm-4\">\r\n              <h3>Contact Info</h3>\r\n              \r\n              <p class=\"tollfree\">  Toll free: 1800 419 8123</p>\r\n              <p><a href=\"#\" class=\"text-white\">info@imagefootage.com</a></p>\r\n              <p><a href=\"#\"  class=\"text-white\">admin@imagefootage.com</a></p>\r\n             \r\n           \r\n           </div>\r\n        \r\n        </div>  \r\n       \r\n       <div class=\"clearfix\"></div>\r\n       <hr>\r\n       <div class=\"row justify-content-center\">\r\n          <div class=\"col-md-12 text-center py-3\">\r\n            <p>\r\n         Copyright @ 2020 Image Footage. All Rights Reserved.\r\n        </p>\r\n          </div>\r\n        </div>\r\n    \r\n    </div>\r\n  \r\n  \r\n  </footer>\r\n  ";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/header/header.component.html":
  /*!************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/header/header.component.html ***!
    \************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppHeaderHeaderComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<nav class=\"navbar navbar-expand-lg navbar-dark fixed-top\" [ngClass]=\"{ 'navbar-shrink': scrollEle }\" id=\"mainNav\">\r\n  <div class=\"container-fluid\">\r\n   \r\n    <a class=\"navbar-brand js-scroll-trigger\" href=\"#page-top\">Image Footage</a>\r\n   \r\n    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" \r\n    (click)=\"isCollapsed = !isCollapsed\" [attr.aria-expanded]=\"!isCollapsed\" \r\n    data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\r\n      Menu\r\n      <i class=\"fas fa-bars\"></i>\r\n    </button>\r\n    \r\n    <!--<div class=\"col-md-4 col-sm-4 col-lg-4 col-xl-4\" *ngIf=\"!footerCssEle\">\r\n      <form class=\"search_m header_serach mt-3 mb-3\">\r\n          <div class=\"input-group search-bar\">\r\n              <div class=\"input-group-btn\" ngbDropdown >\r\n                  <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle>\r\n                    <span *ngIf='productType == 3'>Photos + Videos</span>\r\n                    <span *ngIf='productType == 1'>Photos Only</span>\r\n                    <span *ngIf='productType == 2'>Videos Only</span>\r\n                  </button>\r\n                  <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\">\r\n                    <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(3)\" ngbDropdownItem>Photos + Videos</a>\r\n                    <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(1)\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n                    <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(2)\" ngbDropdownItem>Videos Only</a>\r\n                  </div>\r\n              </div>\r\n              \r\n              <input type=\"text\" [(ngModel)]=\"keywordEle\" [ngModelOptions]=\"{standalone: true}\" #ctrl=\"ngModel\" (keydown)=\"onKeydown($event)\"  class=\"form-control\" aria-label=\"Text input with dropdown button\">\r\n              <i class=\"fa fa-search\"></i>\r\n        </div>\r\n      </form>\r\n    </div>-->\r\n\r\n\r\n\r\n    <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\" [ngbCollapse]=\"isCollapsed\">\r\n      <ul class=\"navbar-nav text-uppercase ml-auto\">\r\n        <li class=\"nav-item\">\r\n          <a class=\"nav-link js-scroll-trigger\" [routerLink]=\"['/search']\" [queryParams]=\"{type:1,keyword:'',sideBar:false}\">Images</a>\r\n        </li>\r\n        <li class=\"nav-item\">\r\n          <a class=\"nav-link js-scroll-trigger\" [routerLink]=\"['/search']\" [queryParams]=\"{type:2,keyword:'',sideBar:false}\">Footage</a>\r\n        </li>\r\n        <li class=\"nav-item\">\r\n          <a class=\"nav-link js-scroll-trigger\" [routerLink]=\"['/search']\" [queryParams]=\"{type:1,keyword:''}\">Editorial</a>\r\n        </li>\r\n\r\n        <li class=\"nav-item\">\r\n          <a class=\"nav-link js-scroll-trigger\" routerLink=\"/pricing\">Pricing<!--<img src=\"../assets/images/arrow icon.png\" style='width:70px;margin-top:-12px;' />--></a>\r\n        </li>\r\n\r\n        <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n          <a class=\"nav-link js-scroll-trigger\" routerLink=\"/cart\"><i class=\"fa fa-shopping-cart\"></i></a>\r\n        </li>\r\n        <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n          <a class=\"nav-link js-scroll-trigger\" (click)=\"clickLoginPopup()\"><i class=\"fa fa-shopping-cart\"></i></a>\r\n        </li>\r\n\r\n<!--        <li class=\"nav-item\">-->\r\n<!--          <a class=\"nav-link js-scroll-trigger\" href=\"#team\"><i class=\"fa fa-heart\"></i> wishlist</a>-->\r\n<!--        </li>-->\r\n\r\n\r\n        <!--<li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n       <a class=\"nav-link js-scroll-trigger\" (click)=\"clickLoginPopup()\"><img src=\"../assets/images/log in icon.png\" style='width:70px;margin-top:-15px;' />       Login</a>\r\n        </li>-->\r\n\r\n        <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n          <a class=\"nav-link js-scroll-trigger\" [routerLink]=\"['/user-profile']\"><i class=\"fa fa-user-circle-o\"></i></a>\r\n        </li>\r\n        <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n          <a class=\"nav-link js-scroll-trigger\" (click)=\"logout()\">Logout</a>\r\n        </li>\r\n        <!--<li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n          <a class=\"nav-link js-scroll-trigger btn btn-outline-white rounded-0 \" [ngClass]=\"{ 'btn btn-outline-white rounded-0': dashboardCssEle }\" routerLink=\"/signUp\"><i class=\"fa fa-user\"></i> User</a>\r\n        </li>-->        \r\n        <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n        <!--btn-outline-white-->\r\n          <a class=\"nav-link js-scroll-trigger btn  rounded-0 \" [ngClass]=\"{ 'btn btn-outline-white rounded-0': dashboardCssEle }\" \r\n          (click)=\"clickLoginPopup()\"><i class=\"fa fa-user\"></i> User</a>\r\n        </li>\r\n\t\t<!-- btn-outline-white -->\r\n        <!--<li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n        \r\n          <a class=\"nav-link js-scroll-trigger btn  rounded-0 \" [ngClass]=\"{ 'btn btn-outline-white rounded-0': dashboardCssEle }\" routerLink=\"/contributor-sign-up\" style=\"margin-left: 10px;\"><i class=\"fa fa-user\"></i> Contributor</a>\r\n        </li>-->\r\n\r\n\r\n\r\n        <!--        <li class=\"nav-item\">-->\r\n<!--          <a class=\"nav-link js-scroll-trigger\" routerLink=\"/pricing\">Pricing</a>-->\r\n<!--        </li>-->\r\n<!--        -->\r\n<!--        <li class=\"nav-item\" *ngIf=\"currentUser\">-->\r\n<!--          <a class=\"nav-link js-scroll-trigger\" routerLink=\"/wishlist\">Cart</a>-->\r\n<!--        </li>-->\r\n<!--        <li class=\"nav-item\" *ngIf=\"!currentUser\">-->\r\n<!--          <a class=\"nav-link js-scroll-trigger\" (click)=\"clickLoginPopup()\">Cart</a>-->\r\n<!--        </li>-->\r\n<!--        -->\r\n<!--        <li class=\"nav-item\" *ngIf=\"!currentUser\">-->\r\n<!--          <a class=\"nav-link js-scroll-trigger\"  (click)=\"clickLoginPopup()\">Login</a>-->\r\n<!--        </li>-->\r\n<!--        <li class=\"nav-item\" *ngIf=\"currentUser\">-->\r\n<!--          <a class=\"nav-link js-scroll-trigger\"  (click)=\"logout()\">Logout</a>-->\r\n<!--        </li>-->\r\n<!--        <li class=\"nav-item\"  *ngIf=\"!currentUser\">-->\r\n<!--          <a class=\"nav-link js-scroll-trigger\" [ngClass]=\"{ 'btn btn-outline-white rounded-0': dashboardCssEle }\" routerLink=\"/signUp\">Sign Up</a>-->\r\n<!--        </li>-->\r\n<!--        <li class=\"nav-item\" *ngIf=\"currentUser\">-->\r\n<!--            <a class=\"nav-link js-scroll-trigger\"  routerLink=\"/wishlist\">wishlist</a>-->\r\n<!--        </li>     -->\r\n      </ul>\r\n    </div>\r\n  </div>\r\n</nav>\r\n\r\n  \r\n  <!-- Navigation \r\n  <nav class=\"navbar navbar-expand-lg navbar-dark fixed-top\" id=\"mainNav\">\r\n    <div class=\"container-fluid\">\r\n      <a class=\"navbar-brand js-scroll-trigger\" href=\"#page-top\">Image Footage</a>\r\n      <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\r\n        Menu\r\n        <i class=\"fas fa-bars\"></i>\r\n      </button>\r\n      <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">\r\n        <ul class=\"navbar-nav text-uppercase ml-auto\">\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" [routerLink]=\"['/search']\" [queryParams]=\"{type:1,keyword:''}\">Images</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\"  [routerLink]=\"['/search']\" [queryParams]=\"{type:2,keyword:''}\">Footage</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/about\">Editorial</a>\r\n          </li>\r\n          <li class=\"nav-item\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/team\">Pricing</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/wishlist\">Cart</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" (click)=\"clickLoginPopup()\">Cart</a>\r\n          </li>\r\n          \r\n          <li class=\"nav-item\" *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"clickLoginPopup()\">Login</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\"  (click)=\"logout()\">Logout</a>\r\n          </li>\r\n          <li class=\"nav-item\"  *ngIf=\"!currentUser\">\r\n            <a class=\"nav-link js-scroll-trigger\" routerLink=\"/signUp\">Sign Up</a>\r\n          </li>\r\n          <li class=\"nav-item\" *ngIf=\"currentUser\">\r\n              <a class=\"nav-link js-scroll-trigger\"  routerLink=\"/wishlist\">wishlist</a>\r\n            </li>\r\n        </ul>\r\n      </div>\r\n    </div>\r\n  </nav>\r\n  -->\r\n\r\n\r\n<ng-container *ngIf=\"showloginPopup\">\r\n  <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n</ng-container>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/hero-detail/hero-detail.component.html":
  /*!**********************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/hero-detail/hero-detail.component.html ***!
    \**********************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppHeroDetailHeroDetailComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\r\n    <div class=\"loader\">\r\n        Loading\r\n        <span></span>\r\n    </div>\r\n</div>\r\n<div class=\"site-wrap mt-5 pt-5 bg-dark\" *ngIf=\"webtype=='2'\">\r\n    <main class=\"main-content p-0\">\r\n        <div class=\"container-fluid photos\">\r\n            <div class=\"row mr-2\">\r\n\r\n                <div class=\"col-md-8 col-sm-8 col-xl-8 col-lg-8\">\r\n                    <div class=\"cartItem\" *ngIf=\"detailPageInfo\">\r\n\r\n                        <div class=\"p-3\">\r\n                            <p class=\"text-white f-20 mb-0 pt-3\">{{detailPageInfo.metadata.title}}</p>\r\n                            <p>{{detailPageInfo.metadata.description}}</p>\r\n\r\n                            <div data-aos=\"fade-up\">\r\n                                <a  class=\"d-block photo-item\">\r\n                                    <img src=\"{{detailPageInfo.media.preview_url_no_wm}}\" #element alt=\"Image\" class=\"img-fluid\">\r\n                                    <div class=\"photo-text-more\">\r\n                                        <div class=\"photo-text-more\">\r\n                                            <h3 class=\"heading\">{{detailPageInfo.metadata.title}}</h3>\r\n                                            <span class=\"meta\">{{detailPageInfo.photoCount}}</span>\r\n                                        </div>\r\n                                    </div>\r\n                                </a>\r\n                            </div>\r\n\r\n                            <div class=\"p-3\">\r\n                                <div style=\"float: right;\">\r\n                                 <a href=\"{{filePreview}}\" download=\"{{imagefootId+'.jpg'}}\"><i class=\"fas fa-download\"></i></a> &nbsp;&nbsp;\r\n                                 <a (click)=\"addtolightbox(imagefootId)\"><i class=\"fas fa-heart\"></i></a>\r\n                                </div>\r\n                                <p class=\"text-white text-uppercase\"><strong>Related Keywords</strong></p>\r\n                                <div class=\"related_key\">\r\n                                    <a href=\"/search?type=1&keyword={{keys}}\" class=\"btn btn-outline-light btn-sm f-12\" title=\"underwater\" *ngFor=\"let keys of keyword\">{{keys}}</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-md-4 col-sm-4 col-xl-4 col-lg-4 pt-3 cart_right pl-3 mt-3\" *ngIf=\"detailPageInfo\">\r\n\r\n                    <div class=\"p-3\">\r\n                        <ul class=\"nav nav-tabs mytabs\">\r\n                            <li class=\"nav-item\">\r\n                             <a class=\"nav-link \"  [ngClass]=\"[ standardTab ? 'active' : '']\" data-toggle=\"tab\"  (click)=\"tabshow('1')\">Standard Licence</a>\r\n                            </li>\r\n                            <li class=\"nav-item\">\r\n                                <a class=\"nav-link\" [ngClass]=\"[ extendedTab ? 'active' : '']\" data-toggle=\"tab\"  (click)=\"tabshow('2')\">Extended Licence</a>\r\n                            </li>\r\n\r\n                        </ul>\r\n\r\n                        <!-- Tab panes -->\r\n                        <div class=\"tab-content pt-3\" >\r\n                            <div id=\"stalic\" *ngIf=\"standardTab\" class=\"tab-pane active\">\r\n                                <p class=\"text-white text-uppercase lsp-1 f-14 pt-3\">standard Royalty Free Licenses</p>\r\n\r\n                                <div class=\"btn-group btn-group-toggle mb-1 col-md-12\" data-toggle=\"buttons\">\r\n                                \t<div class=\"row\">\r\n                                    \t<label class=\"btn btn-dark col-md-3\" *ngFor=\"let cost of detailPageInfo.articles.singlebuy_list.singlebuy[0].sizes.article;let i=index;let first=first;\">\r\n                                        <input type=\"radio\" name=\"options\" id=\"option{{i}}\" autocomplete=\"off\" [class]=\"i==0 ? 'checked' : ''\" (click)=\"checkPriceTotal(cost)\" style=\"display:none;\">\r\n                                        <p class=\"f-12\">{{cost.description}}</p>\r\n                                        <p class=\"f-15 mb-0\"> <i class=\"fa fa-inr\"></i> {{cost.price*80}}</p>\r\n                                    </label>\r\n                                    </div>\r\n                                </div>\r\n<!--                                <p><small><span class=\"text-warning\"> Small</span> 866x578px | 12.03x8.03\" 72dpi</small></p>-->\r\n                            </div>\r\n                            <div id=\"extlic\" *ngIf=\"extendedTab\" class=\"tab-pane active\">\r\n\r\n                                <p class=\"text-white lsp-1 f-14 text-uppercase pt-3\">Extended Licenses</p>\r\n                                <div class=\"btn-group btn-group-toggle mb-4  d-block\" data-toggle=\"buttons\">\r\n                                    <label class=\"btn btn-dark text-left border-0\" *ngFor=\"let license of detailPageInfo.articles.singlebuy_list.singlebuy[0].extended_rights.article;let j=index;let first=first;\">\r\n                                        <input type=\"radio\" name=\"options\" id=\"option{{j}}\" autocomplete=\"off\" [class]=\"j==0 ? 'checked' : ''\" (click)=\"addExtendedPriceTotal(license)\">\r\n                                        <div class=\"row align-items-center\">\r\n                                            <div class=\"col-md-9 col-sm-9 col-lg-9\" >\r\n                                                <p class=\"f-14  fw-6 pt-2\" >{{license.name}}</p>\r\n                                            </div>\r\n                                            <div class=\"col-md-3 col-sm-3 col-lg-3\">\r\n                                                <p class=\"mb-0\"><strong><i class=\"fa fa-inr\"></i>{{license.price*80}}</strong></p>\r\n                                            </div>\r\n                                        </div>\r\n\r\n                                    </label>\r\n                                 </div>\r\n\r\n                            </div>\r\n\r\n                        </div>\r\n\r\n\r\n\r\n\r\n\r\n                        <!-- <p class=\"text-white\">Use This Image Exclusively</p>\r\n                        <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">\r\n                          <button type=\"button\" class=\"btn btn-dark\">Market Freeze</button>\r\n                          <button type=\"button\" class=\"btn btn-dark dropdown-toggle exclus\" data-toggle=\"dropdown\">Select a Duration</button>\r\n                          <ul class=\"dropdown-menu selctDura\">\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item I</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item II</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item III</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item IV</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item V</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Other</a></li>\r\n                            </ul>\r\n                        </div> -->\r\n\r\n                        <div class=\"row mt-5\" *ngIf=\"total>0\">\r\n                            <div class=\"col-12\">\r\n                               <p class=\"text-white\" *ngIf=\"currunt_selected_price>0\">Selected Price:-  {{currunt_selected_price}} </p>\r\n                               <p class=\"text-white\" *ngIf=\"extended_price>0\">Selected Extended Price :-  {{extended_price}}</p>\r\n                             </div>\r\n                            <div class=\"col-4\">\r\n                                <p class=\"text-white\"><strong>TOTAL</strong></p>\r\n                            </div>\r\n                            <div class=\"col-8 text-right\">\r\n                                <h2 class=\"text-warning f-24 fw-6\">{{total}} INR</h2>\r\n                            </div>\r\n                        </div>\r\n<!--                        <div class=\"row mt-5\">-->\r\n<!--                            <div class=\"col-4\">-->\r\n<!--                                <p class=\"text-white\"><strong>TOTAL</strong></p>-->\r\n<!--                            </div>-->\r\n<!--                            <div class=\"col-8 text-right\">-->\r\n<!--                                <h2 class=\"text-warning f-24 fw-6\">$100.00 USD</h2>-->\r\n<!--                            </div>-->\r\n<!--                        </div>-->\r\n\r\n                        <div class=\"row mt-2 mb-5\">\r\n                            <div class=\"col-12\">\r\n                                <button type=\"button\" *ngIf=\"!addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" (click)=\"addToCheckoutItem(detailPageInfo,standard,total,extended,'2')\">ADD TO CART</button>\r\n                                <button type=\"button\" *ngIf=\"addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" (click)=\"checkout()\">Checkout</button>\r\n                                <!--<p>This image is exclusive to Image Footage</p>-->\r\n                            </div>\r\n                        </div>\r\n<!--\r\n                        <p class=\"\">DETAILS</p>\r\n                        <table class=\"f-12\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td width=\"20%\">Restrictions :</td>\r\n                                <td>Contact your local office for all commercial or promotional uses.</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Credit :</td>\r\n                                <td>{{detailPageInfo.metadata.author_realname}}</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Product ID :</td>\r\n                                <td>{{imagefootId}}</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Editorial # :</td>\r\n                                <td>{{detailPageInfo.metadata.editorial}}</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Collection :</td>\r\n                                <td>Getty Images News</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Date created :</td>\r\n                                <td>{{detailPageInfo.metadata.date}}</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Licence type :</td>\r\n                                <td *ngIf=\"detailPageInfo.options.extended=='yes'\">Extended</td>\r\n                                <td *ngIf=\"detailPageInfo.options.rights_managed=='yes'\">Right Managed</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Release info :</td>\r\n                                <td>Not released. More information</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Source :</td>\r\n                                <td>Getty Images AsiaPac</td>\r\n                            </tr>\r\n\r\n\r\n\r\n                            <tr>\r\n                                <td>Max file size :</td>\r\n                                <td>{{detailPageInfo.media.width}} x {{detailPageInfo.media.height}}</td>\r\n                            </tr>\r\n                            </tbody>\r\n\r\n                        </table>\r\n                        \r\n                        \r\n                        \r\n                        -->\r\n                        \r\n                        <h6 class=\"text-center\" style=\"color:#ffffffa8;\">DETAILS</h6>\r\n                        <br />\r\n                       \r\n                        <div class=\"col-md-12\">\r\n<!--                            <div class=\"row\">-->\r\n<!--                                <div class=\"col-md-4\">Restrictions</div>-->\r\n<!--                                <div class=\"col-md-1\">:</div>-->\r\n<!--                                <div class=\"col-md-7\">Contact your local office for all commercial or promotional uses.</div>-->\r\n<!--                            </div>-->\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Credit</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo.metadata.author_realname}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Product ID</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{imagefootId}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Editorial #</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo.metadata.editorial}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Date created</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo.metadata.date}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Licence type</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\"><p *ngIf=\"detailPageInfo.options.extended=='yes'\">Extended</p>\r\n                                <p *ngIf=\"detailPageInfo.options.rights_managed=='yes'\">Right Managed</p></div>\r\n                            </div>\r\n                            <!--<div class=\"row\">\r\n                                <div class=\"col-md-3\">Release info :</div>\r\n                                <div class=\"col-md-9\">Not released. More information</div>\r\n                            </div>-->\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Max file size</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo.media.width}} x {{detailPageInfo.media.height}}</div>\r\n                            </div>\r\n                        </div>\r\n                     </div>\r\n                </div>\r\n            </div>\r\n\r\n    <div class=\"bg-black p-3\">\r\n        <div class=\"row align-items-stretch\">\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">\r\n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\">\r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>\r\n                            </ng-template>\r\n                        </div>\r\n                    </ngb-carousel>\r\n\r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">\r\n                    <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\">\r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>\r\n                            </ng-template>\r\n                        </div>\r\n                    </ngb-carousel>\r\n\r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"row mx-auto my-auto mb-5\">\r\n            <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                <div class=\"carousel-inner\" role=\"listbox\">\r\n                    <ngb-carousel  [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\">\r\n                        <div class=\"carousel-item\">\r\n                            <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                              <div class=\"row\">\r\n                                  <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                      <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                          <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                          <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                          <div class=\"photo-text-more\">\r\n                                              <div class=\"photo-text-more\">\r\n                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                              </div>\r\n                                          </div>\r\n                                      </a>\r\n                                  </div>\r\n                              </div>\r\n                            </ng-template>\r\n                        </div>\r\n                    </ngb-carousel>\r\n\r\n\r\n                </div>\r\n            </div>\r\n          </div>\r\n\r\n          <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n            <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\r\n              <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n              <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n              <div class=\"photo-text-more\">\r\n\r\n                <div class=\"photo-text-more\">\r\n                <h3 class=\"heading\">{{aosimges.name}}</h3>\r\n                <span class=\"meta\">{{aosimges.count}} Photos</span>\r\n              </div>\r\n              </div>\r\n            </a>\r\n          </div>\r\n        </div>\r\n            </div>\r\n         <!--<div class=\"col-md-5 col-sm-6 col-12 m-auto\">\r\n\r\n               <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>\r\n      </div>-->\r\n\r\n        </div>\r\n    </main>\r\n\r\n            </div>\r\n\r\n<div class=\"site-wrap mt-5 pt-5 bg-dark\" *ngIf=\"webtype=='3'\">\r\n\r\n    <main class=\"main-content p-0\">\r\n        <div class=\"container-fluid photos\">\r\n            <div class=\"row mr-2\">\r\n\r\n                <div class=\"col-md-8 col-sm-8 col-xl-8 col-lg-8\">\r\n                    <div class=\"cartItem\" *ngIf=\"detailPageInfo\">\r\n\r\n                        <div class=\"p-3\">\r\n                            <p class=\"text-white f-20 mb-0 pt-3\">{{detailPageInfo[0].items[0].n}}</p>\r\n                            <p>{{detailPageInfo[0].items[0].desc}}</p>\r\n\r\n                            <div data-aos=\"fade-up\">\r\n                                <a  class=\"d-block\">\r\n                                    <div class=\"embed-responsive embed-responsive-16by9\">\r\n                                    <video controls [poster]=\"'https://p5iconsp.s3-accelerate.amazonaws.com/'+detailPageInfo[2]\" controlsList=\"nodownload\"  onmouseover=\"this.play()\" onmouseout=\"this.load()\" >\r\n                                        <source src=\"{{detailPageInfo[0].flv_base+detailPageInfo[1]}}\" type=\"video/mp4\">\r\n                                        Your browser does not support the video tag.\r\n                                    </video>\r\n                                    </div>\r\n                                </a>\r\n<!--                                    <div class=\"photo-text-more\">-->\r\n<!--                                        <div class=\"photo-text-more\">-->\r\n<!--                                            <h3 class=\"heading\">{{detailPageInfo[0].items[0].pf}}</h3>-->\r\n<!--&lt;!&ndash;                                            <span class=\"meta\">{{detailPageInfo.photoCount}}</span>&ndash;&gt;-->\r\n<!--                                        </div>-->\r\n<!--                                    </div>-->\r\n\r\n                            </div>\r\n\r\n                            <div class=\"p-3\">\r\n                                <div style=\"float: right;\">\r\n                                    <a href=\"{{detailPageInfo[4]}}\" download=\"{{detailPageInfo[3]+'.mp4'}}\"><i class=\"fas fa-download\"></i></a> &nbsp;&nbsp;\r\n                                    <a (click)=\"addtolightbox(detailPageInfo[3])\"><i class=\"fas fa-heart\"></i></a>\r\n                                </div>\r\n                                <p class=\"text-white text-uppercase\"><strong>Related Keywords</strong></p>\r\n                                <div class=\"related_key\">\r\n                                    <a href=\"/search?type=2&keyword={{keys}}\" class=\"btn btn-outline-light btn-sm f-12\" title=\"underwater\" *ngFor=\"let keys of keyword\">{{keys}}</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-md-4 col-sm-4 col-xl-4 col-lg-4 pt-3 cart_right pl-3 mt-3\" *ngIf=\"detailPageInfo\">\r\n\r\n                    <div class=\"p-3\">\r\n                        <ul class=\"nav nav-tabs mytabs\">\r\n                            <li class=\"nav-item\">\r\n                                <a class=\"nav-link \" [ngClass]=\"[ standardTab ? 'active' : '']\" data-toggle=\"tab\"  (click)=\"tabshow('1')\">Standard Licence</a>\r\n                            </li>\r\n                        </ul>\r\n\r\n                        <!-- Tab panes -->\r\n                        <div class=\"tab-content pt-3\" >\r\n                            <div id=\"stalic\" *ngIf=\"standardTab\" class=\"tab-pane active\">\r\n                                <p class=\"text-white text-uppercase lsp-1 f-14 pt-3\">standard Royalty Free Licenses</p>\r\n\r\n                                <div class=\"btn-group btn-group-toggle mb-1\" data-toggle=\"buttons\">\r\n                                    <label class=\"btn btn-dark\" *ngFor=\"let cost of detailPageInfo[0].items[0].versions;let i=index;let first=first;\">\r\n                                        <input type=\"radio\" name=\"options\" id=\"option{{i}}\" autocomplete=\"off\" [class]=\"i==0 ? 'checked' : ''\" (click)=\"checkPriceTotalFootage(cost)\">\r\n                                        <p class=\"f-12\">{{cost.size}}</p>\r\n                                        <p class=\"f-30 mb-0\"> <i class=\"fa fa-inr\"></i>{{cost.pr*80}}</p>\r\n                                    </label>\r\n                                </div>\r\n                                <!--                                <p><small><span class=\"text-warning\"> Small</span> 866x578px | 12.03x8.03\" 72dpi</small></p>-->\r\n                            </div>\r\n                        </div>\r\n\r\n\r\n\r\n\r\n\r\n                        <!-- <p class=\"text-white\">Use This Image Exclusively</p>\r\n                        <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">\r\n                          <button type=\"button\" class=\"btn btn-dark\">Market Freeze</button>\r\n                          <button type=\"button\" class=\"btn btn-dark dropdown-toggle exclus\" data-toggle=\"dropdown\">Select a Duration</button>\r\n                          <ul class=\"dropdown-menu selctDura\">\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item I</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item II</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item III</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item IV</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Item V</a></li>\r\n                              <li class=\"dropdown-item\"><a href=\"#\">Other</a></li>\r\n                            </ul>\r\n                        </div> -->\r\n\r\n                        <div class=\"row mt-5\" *ngIf=\"total>0\">\r\n                            <div class=\"col-12\">\r\n                                <p class=\"text-white\" *ngIf=\"currunt_selected_price>0\">Selected Price:-  {{currunt_selected_price}} </p>\r\n                                <p class=\"text-white\" *ngIf=\"extended_price>0\">Selected Extended Price :-  {{extended_price}}</p>\r\n                            </div>\r\n                            <div class=\"col-4\">\r\n                                <p class=\"text-white\"><strong>TOTAL</strong></p>\r\n                            </div>\r\n                            <div class=\"col-8 text-right\">\r\n                                <h2 class=\"text-warning f-24 fw-6\">{{total}} INR</h2>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"row mt-2 mb-5\">\r\n                            <div class=\"col-12\">\r\n                                <button type=\"button\" *ngIf=\"!addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" (click)=\"addToCheckoutItem(detailPageInfo,standard,total,extended,'3')\">ADD TO CART</button>\r\n                                <button type=\"button\" *ngIf=\"addedCartItem\" class=\"btn btn-warning rounded-0 p-3 shadow text-white d-block  w-100\" (click)=\"checkout()\">Checkout</button>\r\n                               <!-- <p>This image is exclusive to Image Footage</p>-->\r\n                            </div>\r\n                        </div>\r\n\r\n                        <h6 class=\"text-center\" style=\"color:#ffffffa8;\">DETAILS</h6>\r\n                        <br />\r\n                        <!--<table class=\"f-12\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td width=\"20%\">Restrictions :</td>\r\n                                <td>Contact your local office for all commercial or promotional uses.</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Credit :</td>\r\n                                <td>{{detailPageInfo[0].items[0].artistname}}</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Product ID :</td>\r\n                                <td>{{detailPageInfo[3]}}</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Duration # :</td>\r\n                                <td>{{detailPageInfo[0].items[0].dur}}</td>\r\n                            </tr>\r\n                                                        <tr>\r\n                                                            <td>Collection :</td>\r\n                                                            <td>Getty Images News</td>\r\n                                                        </tr>\r\n                            <tr>\r\n                                <td>Date created :</td>\r\n                                <td>{{detailPageInfo[0].items[0].date}}</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Licence type :</td>\r\n                                <td>Standard</td>\r\n\r\n                            </tr>\r\n                            <tr>\r\n                                <td>Release info :</td>\r\n                                <td>Not released. More information</td>\r\n                            </tr>\r\n                                                        <tr>\r\n                                                            <td>Source :</td>\r\n                                                            <td>Getty Images AsiaPac</td>\r\n                                                        </tr>\r\n\r\n\r\n\r\n                            <tr>\r\n                                <td>Max file size :</td>\r\n                                <td>{{detailPageInfo[0].items[0].filesize}}</td>\r\n                            </tr>\r\n                            </tbody>\r\n\r\n                        </table>-->\r\n                        <div class=\"col-md-12\">\r\n<!--                            <div class=\"row\">-->\r\n<!--                                <div class=\"col-md-4\">Restrictions</div>-->\r\n<!--                                <div class=\"col-md-1\">:</div>-->\r\n<!--                                <div class=\"col-md-7\">Contact your local office for all commercial or promotional uses.</div>-->\r\n<!--                            </div>-->\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Credit</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo[0].items[0].artistname}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Product ID</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo[3]}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Duration #</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo[0].items[0].dur}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Date created</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo[0].items[0].date}}</div>\r\n                            </div>\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Licence type</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">Standard</div>\r\n                            </div>\r\n                            <!--<div class=\"row\">\r\n                                <div class=\"col-md-3\">Release info :</div>\r\n                                <div class=\"col-md-9\">Not released. More information</div>\r\n                            </div>-->\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-4\">Max file size</div>\r\n                                <div class=\"col-md-1\">:</div>\r\n                                <div class=\"col-md-7\">{{detailPageInfo[0].items[0].filesize}}</div>\r\n                            </div>\r\n                        </div>\r\n\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n\r\n            <div class=\"bg-black p-3\">\r\n                <div class=\"row align-items-stretch\">\r\n                    <div class=\"row mx-auto my-auto mb-5\">\r\n                        <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                            <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                            <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                            <div class=\"carousel-inner\" role=\"listbox\">\r\n                                <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\">\r\n                                    <div class=\"carousel-item\">\r\n                                        <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                                            <div class=\"row\">\r\n                                                <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                                    <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                                        <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                                        <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                                        <div class=\"photo-text-more\">\r\n                                                            <div class=\"photo-text-more\">\r\n                                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </a>\r\n                                                </div>\r\n                                            </div>\r\n                                        </ng-template>\r\n                                    </div>\r\n                                </ngb-carousel>\r\n\r\n\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"row mx-auto my-auto mb-5\">\r\n                        <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                            <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                            <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                            <div class=\"carousel-inner\" role=\"listbox\">\r\n                                <ngb-carousel *ngIf=\"carouselSliderImages\" [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\">\r\n                                    <div class=\"carousel-item\">\r\n                                        <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                                            <div class=\"row\">\r\n                                                <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                                    <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                                        <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                                        <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                                        <div class=\"photo-text-more\">\r\n                                                            <div class=\"photo-text-more\">\r\n                                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </a>\r\n                                                </div>\r\n                                            </div>\r\n                                        </ng-template>\r\n                                    </div>\r\n                                </ngb-carousel>\r\n\r\n\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"row mx-auto my-auto mb-5\">\r\n                        <div id=\"recipeCarousel\" class=\"carousel slide w-100 related_slider\" *ngIf=\"carouselSliderImages\">\r\n                            <h3 class=\"text-white f-18 mb-3 float-left\">{{carouselSliderImages.categoryLabel}}</h3>\r\n                            <a href=\"javascript:void(0)\" class=\"text-warning float-right\"><strong>See All</strong></a>\r\n                            <div class=\"carousel-inner\" role=\"listbox\">\r\n                                <ngb-carousel  [showNavigationArrows]=\"true\" [showNavigationIndicators]=\"false\" [interval]=\"1000\" [pauseOnHover]=\"true\">\r\n                                    <div class=\"carousel-item\">\r\n                                        <ng-template ngbSlide *ngFor=\"let carouseimges of carouselSliderImages.categoryImages;let i= index\">\r\n                                            <div class=\"row\">\r\n                                                <div [ngClass]=\"getClassName(images)\" *ngFor=\"let images of carouseimges\">\r\n                                                    <a href=\"javascript:void(0)\" class=\"d-block photo-item\">\r\n                                                        <img *ngIf=\"images.type == 'photo'\" src=\"assets/images/{{images.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                                                        <iframe  *ngIf=\"images.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                                                        <div class=\"photo-text-more\">\r\n                                                            <div class=\"photo-text-more\">\r\n                                                                <h3 class=\"heading\">{{images.name}}</h3>\r\n                                                                <span class=\"meta\">{{images.count}} Photos</span>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </a>\r\n                                                </div>\r\n                                            </div>\r\n                                        </ng-template>\r\n                                    </div>\r\n                                </ngb-carousel>\r\n\r\n\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n\r\n                    <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImagesData | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n                        <a routerLink=\"/detail/{{aosimges.id}}\" class=\"d-block photo-item\">\r\n                            <img *ngIf=\"aosimges.type == 'photo'\" src=\"assets/images/{{aosimges.imageName}}\" alt=\"Image\" class=\"img-fluid\">\r\n                            <iframe  *ngIf=\"aosimges.type == 'video'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>\r\n                            <div class=\"photo-text-more\">\r\n\r\n                                <div class=\"photo-text-more\">\r\n                                    <h3 class=\"heading\">{{aosimges.name}}</h3>\r\n                                    <span class=\"meta\">{{aosimges.count}} Photos</span>\r\n                                </div>\r\n                            </div>\r\n                        </a>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-md-5 col-sm-6 col-12 m-auto\">\r\n\r\n                <ngb-pagination [collectionSize]=\"aoslSliderImagesData.length\"  [pageSize]=\"pageSize\" [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" [boundaryLinks]=\"true\"></ngb-pagination>\r\n            </div>\r\n\r\n        </div>\r\n    </main>\r\n\r\n</div>\r\n\r\n<ng-container *ngIf=\"showloginPopup\">\r\n    <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n</ng-container>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/hero-search/hero-search.component.html":
  /*!**********************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/hero-search/hero-search.component.html ***!
    \**********************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppHeroSearchHeroSearchComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\r\n    <div class=\"loader\">\r\n        Loading\r\n        <span></span>\r\n    </div>\r\n</div>\r\n<div class=\"bg-dark search_menu_l\"  style=\"/*background: #151414*/background:#60048b !important; !important; position: fixed; width: 100%;z-index:1;margin-top: -17px;\">\r\n\r\n\r\n    <ul class=\"search_menu search_menu col-md-6 m-auto col-sm-6\" style=\"width:390px\">\r\n        <li [class]=\"searchData.curated == 1 ? 'active' : ' '\"><a href=\"javascript:void(0)\" (click)=\"onTabClick(2)\">RELEVENCE</a></li>\r\n       <li [class]=\"searchData.letest == 1 ? 'active' : ' '\"><a href=\"javascript:void(0)\" (click)=\"onTabClick(1)\">LATEST</a></li>\r\n       <li [class]=\"searchData.populer == 1 ? 'active' : ' '\"><a href=\"javascript:void(0)\" (click)=\"onTabClick(3)\">POPULAR</a></li>\r\n    </ul>\r\n    \r\n    \r\n    \r\n</div>\r\n\r\n<div class=\"site-wrap\" >\r\n  <div  [ngClass]=\"show == true ? 'page-wrapper chiller-theme toggled' : 'page-wrapper chiller-theme'\">\r\n  <a id=\"show-sidebar\" class=\"btn btn-sm btn-dark\" href=\"javascript:void(0)\" (click)=\"show=!show\" style=\"font-size: 17px;color:#fff;\">\r\n      <i class=\"fa fa-chevron-circle-right\" aria-hidden=\"true\"></i>\r\n    </a>\r\n \r\n        <!-- Sidebar -->\r\n \r\n        <nav id=\"sidebar\" class=\"sidebar\" *ngIf=\"show\">\r\n        \r\n        \r\n  <div class=\"sidebar-content\">\r\n    <perfect-scrollbar>\r\n      <div class=\"sidebar-header\">\r\n      <div class=\"col-md-12\">\r\n      <div class=\"row\">\r\n      <div class=\"col-md-10\"><a>FILTERS</a></div>\r\n        <div class=\"col-md-2\"><a (click)=\"toggle()\" class=\"\" style=\"cursor:pointer;color:#fff;font-size: 17px;\"><i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i></a></div>\r\n        </div>\r\n        </div>\r\n      </div>\r\n     <div class=\"sidebar-profile\" >\r\n       <a id=\"show-sidebar\" class=\"btn btn-sm btn-dark\" href=\"javascript:void(0)\" >\r\n      <i class=\"fas fa-bars\"></i>\r\n    </a>\r\n       <!-- <div class=\"user-pic\">\r\n          <img class=\"img-responsive img-rounded\" src=\"assets/img/user.jpg\" alt=\"User picture\">\r\n        </div>-->\r\n        <div class=\"user-info\" *ngIf=\"currentUser\">\r\n         <!-- <span class=\"user-name\">Jhon\r\n            <strong>Smith</strong>\r\n          </span>\r\n          <span class=\"user-role\">Administrator</span>\r\n          <span class=\"user-status\">\r\n            <i class=\"fa fa-circle\"></i>\r\n            <span>Online</span>\r\n          </span>-->\r\n        </div>\r\n      </div>\r\n      <div class=\"col-md-12 col-sm-12 col-lg-12 col-xl-12\" *ngIf=\"!footerCssEle\">\r\n      \t\t<form class=\"search_m header_serach mt-3 mb-3\">\r\n              <div class=\"input-group search-bar\">\r\n                  <div class=\"input-group-btn\" ngbDropdown >\r\n                      <button type=\"button\" class=\"btn btn-secondary\" id=\"dropdownBasic1\" ngbDropdownToggle >\r\n    <!--                    <span *ngIf='productType == 3'>Photos + Videos</span>-->\r\n                        <span *ngIf='productType == 1'>Photos Only</span>\r\n                        <span *ngIf='productType == 2'>Videos Only</span>\r\n                      </button>\r\n                      <div ngbDropdownMenu aria-labelledby=\"dropdownBasic1\" class=\"dropdown-menu\" style=\"margin-top:100px;\">\r\n    <!--                    <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(3)\" ngbDropdownItem>Photos + Videos</a>-->\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(1)\" ngbDropdownItem><i class=\"\"></i> Photos Only</a>\r\n                        <a class=\"dropdown-item\" href=\"javascript:void(0)\" (click)=\"searchDropDownClick(2)\" ngbDropdownItem>Videos Only</a>\r\n                      </div>\r\n                  </div>\r\n                  \r\n                  <input type=\"text\" [(ngModel)]=\"keywordEle\" [ngModelOptions]=\"{standalone: true}\" #ctrl=\"ngModel\" (keydown)=\"onKeydown($event)\"  class=\"form-control\" aria-label=\"Text input with dropdown button\">\r\n                  <i class=\"fa fa-search\" (click)=\"onKeydown($event)\"  style=\"cursor:pointer;\"></i>\r\n            </div>\r\n      \t\t</form>\r\n    </div>\r\n      \r\n      <div class=\"sidebar-menu\">\r\n      <div class=\"sidebar-header\"> \r\n            <div class=\"btn-group btn-group-toggle search-select\" data-toggle=\"buttons\">\r\n                <label  [class]=\"searchData.productType == 1 ? 'btn btn-dark active' : 'btn btn-dark'\" (click)=\"searchDropDownClick(1)\">\r\n                    <input type=\"radio\"  name=\"options\" [(ngModel)]=\"searchData.productType\" value=\"1\">\r\n                    <p class=\"mb-0\"> <i class=\"fa fa-camera\"></i> </p>\r\n                    <p class=\"mb-0\">PHOTOS</p> \r\n                  </label>\r\n                  <label  [class]=\"searchData.productType == 2 ? 'btn btn-dark active' : 'btn btn-dark'\" (click)=\"searchDropDownClick(2)\">\r\n                    <input type=\"radio\" name=\"options\" [(ngModel)]=\"searchData.productType\" value=\"2\">\r\n                    <p class=\"mb-0\"> <i class=\"fa fa-video\"></i> </p>\r\n                    <p class=\"mb-0\">  VIDEOS </p>\r\n                  </label>  \r\n            </div>\r\n        </div>\r\n          <ul>\r\n              <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu1=!sidebarSubmenu1\">  \r\n                    <i class=\"fa fa-user-circle-o\" aria-hidden=\"true\"></i>\r\n                    <span> People</span>              \r\n                  </a>  \r\n                   <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu1\">\r\n                    <ul>\r\n                      <li *ngFor=\"let peoples of leftsideData.product_peoples\">\r\n                        <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('people',peoples.people_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('people',peoples.people_id)\">{{peoples.people_name}}</a>\r\n                      </li>\r\n                    </ul>\r\n                  </div>\r\n                </li>\r\n                <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu2=!sidebarSubmenu2\">\r\n                    <i class=\"fa fa-shopping-cart\"></i>\r\n                    <span>Gender</span>\r\n                  </a>\r\n                  <div class=\"sidebar-submenu sidebar-submenu-btn\" *ngIf=\"sidebarSubmenu2\">\r\n                    <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('gender',gender.gender_id) ? 'btn btn-dark active' : 'btn btn-dark'\"  *ngFor=\"let gender of leftsideData.product_gender\" (click)=\"onSideMenuClick('gender',gender.gender_id)\"> \r\n                      {{gender.gender_name}}</a>\r\n                  </div>\r\n                </li>\r\n                <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu3=!sidebarSubmenu3\">\r\n                    <i class=\"far fa-gem\"></i>\r\n                    <span>Ethnicity</span>\r\n                  </a>\r\n                  <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu3\">\r\n                    <ul>\r\n                      <li *ngFor=\"let ethinicities of leftsideData.product_ethinicities\">\r\n                        <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('ethinicity',ethinicities.ethinicity_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('ethinicity',ethinicities.ethinicity_id)\">{{ethinicities.ethinicity_name}}</a>\r\n                      </li>\r\n                    </ul>\r\n                  </div>\r\n                </li>\r\n              <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu6=!sidebarSubmenu6\">\r\n                      <i class=\"fa fa-globe\"></i>\r\n                      <span>Orientations</span>\r\n                  </a>\r\n                  <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu6\">\r\n                      <ul>\r\n                          <li *ngFor=\"let orientation of leftsideData.product_orientations\">\r\n                              <a href=\"javascript:void(0)\"  [ngClass]=\"getSideBarClassName('orientation',orientation.orientation_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('orientation',orientation.orientation_id)\">{{orientation.orientation_name}}</a>\r\n                          </li>\r\n                      </ul>\r\n                  </div>\r\n              </li>\r\n                <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu4=!sidebarSubmenu4\">\r\n                    <i class=\"fa fa-chart-line\"></i>\r\n                    <span>Location</span>\r\n                  </a>\r\n                  <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu4\">\r\n                    <ul>\r\n                      <li  *ngFor=\"let locations of leftsideData.product_locations\">\r\n                        <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('locations',locations.location_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('locations',locations.location_id)\">{{locations.location_name}}</a>\r\n                     </li>\r\n                    </ul>\r\n                  </div>\r\n                </li>\r\n                <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\" (click)=\"sidebarSubmenu5=!sidebarSubmenu5\">\r\n                    <i class=\"fa fa-globe\"></i>\r\n                    <span>Color</span>\r\n                  </a>\r\n                  <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu5\">\r\n                    <ul>\r\n                      <li  *ngFor=\"let colors of leftsideData.product_colors\">\r\n                        <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('colors',colors.pcolor_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('colors',colors.pcolor_id)\">{{colors.pcolor_name}}</a>\r\n                      </li>\r\n                     \r\n                    </ul>\r\n                  </div>\r\n                </li>\r\n\r\n                 <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu7=!sidebarSubmenu7\">\r\n                    <i class=\"fa fa-globe\"></i>\r\n                    <span>Image Types</span>\r\n                  </a>\r\n                  <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu7\">\r\n                    <ul>\r\n                      <li *ngFor=\"let imageTypes of leftsideData.product_imagetypes\">\r\n                        <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('imageTypes',imageTypes.imagetype_id) ? 'active' : ' '\"    (click)=\"onSideMenuClick('imageTypes',imageTypes.imagetype_id)\">{{imageTypes.imagetype_name}}</a>\r\n                      </li>\r\n                    </ul>\r\n                  </div>\r\n                </li>\r\n                <li class=\"sidebar-dropdown\">\r\n                  <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu8=!sidebarSubmenu8\">\r\n                    <i class=\"fa fa-globe\"></i>\r\n                    <span>Image Sizes</span>\r\n                  </a>\r\n                  <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu8\">\r\n                    <ul>\r\n                      <li *ngFor=\"let imagesizes of leftsideData.product_imagesizes\">\r\n                        <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('imagesizes',imagesizes.imagesize_id) ? 'active' : ' '\"  (click)=\"onSideMenuClick('imagesizes',imagesizes.imagesize_id)\">{{imagesizes.imagesize_name}}</a>\r\n                      </li>\r\n                    </ul>\r\n                  </div>\r\n                </li>\r\n                <li class=\"sidebar-dropdown\">\r\n                    <a href=\"javascript:void(0)\" class=\"text-white fw-6\"  (click)=\"sidebarSubmenu9=!sidebarSubmenu9\">\r\n                      <i class=\"fa fa-globe\"></i>\r\n                      <span>Sort Types</span>\r\n                    </a>\r\n                    <div class=\"sidebar-submenu\" *ngIf=\"sidebarSubmenu9\">\r\n                      <ul>\r\n                        <li *ngFor=\"let sorttype of leftsideData.product_sorttype\">\r\n                          <a href=\"javascript:void(0)\" [ngClass]=\"getSideBarClassName('sorttype',sorttype.sorttype_id) ? 'active' : ' '\" (click)=\"onSideMenuClick('sorttype',sorttype.sorttype_id)\">{{sorttype.sorttype_name}}</a>\r\n                        </li>\r\n                      </ul>\r\n                    </div>\r\n                </li>\r\n          </ul>\r\n        </div>\r\n    </perfect-scrollbar>\r\n  </div>\r\n  <!--<div class=\"sidebar-footer\">\r\n    <div class=\"dropdown\" dropdown>\r\n\r\n      <a href=\"#\" dropdownToggle>\r\n        <i class=\"fa fa-bell\"></i>\r\n        <span class=\"badge badge-pill badge-warning notification\">5</span>\r\n      </a>\r\n      <div class=\"dropdown-menu notifications\" *dropdownMenu>\r\n        <div class=\"notifications-header\">\r\n          <i class=\"fa fa-bell\"></i>\r\n          Notifications\r\n        </div>\r\n        <div class=\"dropdown-divider\"></div>\r\n        <a class=\"dropdown-item\" href=\"#\">\r\n          <div class=\"notification-content\">\r\n            <div class=\"icon\">\r\n              <i class=\"fas fa-check text-success border border-success\"></i>\r\n            </div>\r\n            <div class=\"content\">\r\n              <div class=\"notification-detail\">Lorem ipsum dolor sit amet consectetur adipisicing\r\n                elit. In totam explicabo</div>\r\n              <div class=\"notification-time\">\r\n                6 minutes ago\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </a>\r\n        <a class=\"dropdown-item\" href=\"#\">\r\n          <div class=\"notification-content\">\r\n            <div class=\"icon\">\r\n              <i class=\"fas fa-exclamation text-info border border-info\"></i>\r\n            </div>\r\n            <div class=\"content\">\r\n              <div class=\"notification-detail\">Lorem ipsum dolor sit amet consectetur adipisicing\r\n                elit. In totam explicabo</div>\r\n              <div class=\"notification-time\">\r\n                Today\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </a>\r\n        <a class=\"dropdown-item\" href=\"#\">\r\n          <div class=\"notification-content\">\r\n            <div class=\"icon\">\r\n              <i class=\"fas fa-exclamation-triangle text-warning border border-warning\"></i>\r\n\r\n            </div>\r\n            <div class=\"content\">\r\n              <div class=\"notification-detail\">Lorem ipsum dolor sit amet consectetur adipisicing\r\n                elit. In totam explicabo</div>\r\n              <div class=\"notification-time\">\r\n                Yesterday\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </a>\r\n        <div class=\"dropdown-divider\"></div>\r\n        <a class=\"dropdown-item text-center\" href=\"#\">View all notifications</a>\r\n      </div>\r\n    </div>\r\n    <div class=\"dropdown\" dropdown>\r\n      <a href=\"#\" dropdownToggle>\r\n        <i class=\"fa fa-envelope\"></i>\r\n        <span class=\"badge badge-pill badge-success notification\">7</span>\r\n      </a>\r\n      <div class=\"dropdown-menu messages\" *dropdownMenu>\r\n        <div class=\"messages-header\">\r\n          <i class=\"fa fa-envelope\"></i>\r\n          Messages\r\n        </div>\r\n        <div class=\"dropdown-divider\"></div>\r\n        <a class=\"dropdown-item\" href=\"#\">\r\n          <div class=\"message-content\">\r\n            <div class=\"pic\">\r\n              <img src=\"assets/img/user.jpg\" alt=\"\">\r\n            </div>\r\n            <div class=\"content\">\r\n              <div class=\"message-title\">\r\n                <strong> Jhon doe</strong>\r\n              </div>\r\n              <div class=\"message-detail\">Lorem ipsum dolor sit amet consectetur adipisicing\r\n                elit. In totam explicabo</div>\r\n            </div>\r\n          </div>\r\n\r\n        </a>\r\n        <a class=\"dropdown-item\" href=\"#\">\r\n          <div class=\"message-content\">\r\n            <div class=\"pic\">\r\n              <img src=\"assets/img/user.jpg\" alt=\"\">\r\n            </div>\r\n            <div class=\"content\">\r\n              <div class=\"message-title\">\r\n                <strong> Jhon doe</strong>\r\n              </div>\r\n              <div class=\"message-detail\">Lorem ipsum dolor sit amet consectetur adipisicing\r\n                elit. In totam explicabo</div>\r\n            </div>\r\n          </div>\r\n\r\n        </a>\r\n        <a class=\"dropdown-item\" href=\"#\">\r\n          <div class=\"message-content\">\r\n            <div class=\"pic\">\r\n              <img src=\"assets/img/user.jpg\" alt=\"\">\r\n            </div>\r\n            <div class=\"content\">\r\n              <div class=\"message-title\">\r\n                <strong> Jhon doe</strong>\r\n              </div>\r\n              <div class=\"message-detail\">Lorem ipsum dolor sit amet consectetur adipisicing\r\n                elit. In totam explicabo</div>\r\n            </div>\r\n          </div>\r\n        </a>\r\n        <div class=\"dropdown-divider\"></div>\r\n        <a class=\"dropdown-item text-center\" href=\"#\">View all messages</a>\r\n\r\n      </div>\r\n    </div>\r\n    <div class=\"dropdown\" dropdown>\r\n      <a href=\"#\" dropdownToggle>\r\n        <i class=\"fa fa-cog\"></i>\r\n        <span class=\"badge-sonar\"></span>\r\n      </a>\r\n      <div class=\"dropdown-menu\" *dropdownMenu>\r\n        <a class=\"dropdown-item\" href=\"#\">My profile</a>\r\n        <a class=\"dropdown-item\" href=\"#\">Help</a>\r\n        <a class=\"dropdown-item\" href=\"#\">Setting</a>\r\n      </div>\r\n    </div>\r\n    <div>\r\n      <a href=\"#\">\r\n        <i class=\"fa fa-power-off\"></i>\r\n      </a>\r\n    </div>\r\n  </div>-->\r\n</nav>\r\n\r\n \r\n        <!-- /#sidebar-wrapper -->\r\n    \r\n    \r\n    \r\n    \r\n    \r\n    \r\n<!-- mt-5 -->\r\n    <main class=\"page-content mt-3\">\r\n       \r\n        <main class=\"main-content\">\r\n          <div style=\"width: 100%; z-index: 9999; background: #000; top:132px;left:19%;padding: 10px;\">\r\n            <p><small>290154 Exclusive Royalty-Free stock photos and videos for beauty</small></p>     \r\n            <span class=\"f-12\">Related:</span> \r\n            <span class=\"related_key mt-10\">\r\n             <a href=\"/search?type={{searchData.productType}}&keyword={{keys}}\" class=\"btn btn-outline-light btn-sm f-12\" title=\"underwater\" *ngFor=\"let keys of keyword\">{{keys}}</a>\r\n            </span>\r\n          </div> \r\n          <div class=\"clearfix\"></div>\r\n\r\n          <div class=\"photos\"><!-- pt-5 mt-5 -->\r\n              <div class=\"row align-items-stretch\">\r\n                  <div [ngClass]=\"getClassName(aosimges)\" data-aos=\"fade-up\" data-aos-delay=\"200\"  *ngFor=\"let aosimges of aoslSliderImages | slice: (page-1) * pageSize : (page-1) * pageSize + pageSize;let i= index\">\r\n                      <a routerLink=\"/detail/{{aosimges.api_product_id}}/{{aosimges.product_web}}/{{aosimges.product_main_type}}\" class=\"d-block photo-item\">\r\n                        <div class=\"\">\r\n                            <img *ngIf=\"aosimges.product_main_type == 'Image'\" src=\"{{aosimges.product_thumbnail}}\" alt=\"Image\" class=\"img-fluid\">\r\n\r\n                            <div class=\"photo-text-more\">\r\n                          <h3 class=\"heading\">{{aosimges.product_title}}</h3>\r\n                          <span class=\"meta\">{{aosimges.description}} Photos</span>\r\n                          <p class=\"icons_thum\">\r\n                            <span><i class=\"fa fa-image\"></i></span>\r\n                            <span><i class=\"fa fa-heart\"></i></span>\r\n                            <span><i class=\"fa fa-plus\"></i></span>\r\n                        </p>\r\n                        </div>\r\n                        </div>\r\n                      </a>\r\n                      <a  *ngIf=\"aosimges.product_main_type != 'Image'\" routerLink=\"/detail/{{aosimges.api_product_id}}/{{aosimges.product_web}}/{{aosimges.product_main_type}}\" class=\"d-block \">\r\n                          <video  width=\"400\" height=\"300\" [muted]=\"'muted'\" [poster]=\"aosimges.product_thumbnail\" #htmlVideoElement controls controlsList=\"nodownload\"  onmouseover=\"this.play()\"\r\n                                  onmouseout=\"this.load()\" style=\"width: 100% !important;background: #7d494957;object-fit: cover;\">\r\n                              <source src=\"{{aosimges.product_main_image}}\" type=\"video/mp4\">\r\n                              Your browser does not support the video tag.\r\n                          </video>\r\n                          <!-- <iframe  *ngIf=\"aosimges.mimetype != 'image/jpeg'\" src=\"https://www.youtube.com/embed/xcJtL7QggTI?rel=0&amp;autoplay=0&mute=1\" webkitallowfullscreen mozallowfullscreen allowfullscreen height=\"300\" width=\"100%\"></iframe>  -->\r\n                      </a>\r\n                  </div>\r\n              </div>\r\n              <div class=\"col-md-5 col-sm-6 col-12 m-auto pagination_d\" *ngIf=\"aoslSliderImages.length !=0\">\r\n                  <ngb-pagination [collectionSize]=\"aoslSliderImages.length\"  [pageSize]=\"pageSize\"\r\n                  [(page)]=\"page\" [maxSize]=\"5\" [rotate]=\"true\" [ellipses]=\"false\" (pageChange)=\"onPageChange($event)\"\r\n                  [boundaryLinks]=\"true\"></ngb-pagination>\r\n                  \r\n                  \r\n\r\n              </div>\r\n          </div>\r\n        </main>\r\n    </main>\r\n\r\n  </div>\r\n</div>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/heroes/heroes.component.html":
  /*!************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/heroes/heroes.component.html ***!
    \************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppHeroesHeroesComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<h2>My Heroes</h2>\n\n<div>\n  <label>Hero name:\n    <input #heroName />\n  </label>\n  <!-- (click) passes input value to add() and then clears the input -->\n  <button (click)=\"add(heroName.value); heroName.value=''\">\n    add\n  </button>\n</div>\n\n<ul class=\"heroes\">\n  <li *ngFor=\"let hero of heroes\">\n    <a routerLink=\"/detail/{{hero.id}}\">\n      <span class=\"badge\">{{hero.id}}</span> {{hero.name}}\n    </a>\n    <button class=\"delete\" title=\"delete hero\"\n      (click)=\"delete(hero)\">x</button>\n  </li>\n</ul>\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/licence-agreement/licence-agreement.component.html":
  /*!**********************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/licence-agreement/licence-agreement.component.html ***!
    \**********************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppLicenceAgreementLicenceAgreementComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<section class=\"banner-area relative\">\r\n        <div class=\"overlay overlay-bg\"></div>\r\n        <div class=\"banner-content text-center\">\r\n          <h1>IMAGE CONTENT LICENSE AGREEMENT</h1>\r\n          <!--<p>We are a privately owned group offering a variety of services that include,\r\n            <br />\r\n             stock imagery,stock footage, photography\r\n          </p>-->\r\n        </div>\r\n      </section>\r\n    \r\n    <section class=\"pt-5 bg-white text-black f-3 l-space\">\r\n    \r\n      <div class=\"container\">\r\n  \r\n    <div class=\"static-wrapper\">\r\n  <div class=\"section-title text-left pb-2\">\r\n  <p style=\"float:right;\">Effective Date____________ 2019</p>\r\n  <h3  class=\"f-18 pt-3 pb-3\">1. INTRODUCTION</h3>\r\n  <!--<p>Last Updated: November 2016</p>-->\r\n  </div>\r\n  <p>A. You (“User” or “you”) agree to abide by and be bound by the terms described in this Image Content License Agreement (“Agreement”) herein and by all the Terms, policies, and guidelines incorporated by reference as well as any additional Terms and restrictions presented in relation to specific content (“Terms”), before you use the applications, websites or any content available through the website including, but not limited to, text, graphics, data, photographic images, moving images, sound, illustrations, software and the selection and arrangement thereof (“Content”)made available to you by --insert name of website--(hereinafter referred to as “Site” or “we” or “our” or “us”).</p>\r\n  <p>B.Unless otherwise indicated, all Content on the Website is owned by us, our licensors or our third-party image partners. All elements of the Site, including the Content, are protected by copyright, trade mark, moral rights and other laws relating to the protection of intellectual property.</p>\r\n  <p>C.These Terms are effective upon acceptance and governs the relationship between the User and Conceptual Pictures Worldwide Private Limited,  and includes its affiliates and subsidiaries, jointly and severally)(“Company”) and explains the use of the Content. If the Terms conflict with any other document, the Terms will prevail for the purposes of usage of the Content. By downloading Content from ____________ (“Website”), you accept the terms of this Agreement.</p>\r\n  <b>PLEASE READ THE TERMS AND CONDITIONS OF THIS AGREEMENT CAREFULLY. BY ACCESSING OR USING THE WEBSITE YOU AGREE TO ABIDE BY AND BE BOUND BY THE TERMS DESCRIBED HEREIN. IF YOU DO NOT AGREE TO ANY OR ALL OF THESE TERMS, DO NOT USE THE SITE.</b>\r\n  <h3 class=\"f-18 pt-3 pb-3\">2. DEFINITIONS</h3>\r\n  <p>In this Agreement unless the context otherwise requires, the following expres¬sions shall have the following meanings:</p>\r\n  <p>(a)\t“Collection Societies\" shallmean any performing, mechanical or other rights society that collects and administers royalty payments or similar remuneration on behalf of music publishers, writers and performers;</p>\r\n  <p>(b)\t“Intellectual Property” in relation to a Party shall mean all patents, permits, trade secrets, proprietary information and knowledge, processes, formulations, technology, software programmes, materials, notes, records, drawings, inventions, Improvements, developments, discoveries, databases, copyrights, licences, franchises, formulae, designs, rights of confidential information and any other industrial property that is either proprietary to such Party and / or that has been licensed by such Party from any other party or person. “IntellectualPropertyRights” mean all rights, benefits, title or interest in or to any Intellectual Property, anywhere in the world (whether registered or not and including all applications for the same);</p>\r\n  <p>(c)\t“Company Logos” shall mean trademarks, trade names, service marks, logotypes, or brand identifiers of Company and content provider;</p>\r\n  <p>(d)\t“Fee” shall be as defined in Clause 4.1 of this Agreement.</p>\r\n  <p>(e)\t\"Use\" shall mean, with respect to the Content, to copy, reproduce, all modifications and changes made, synchronise, perform, display, broadcast, publish, or otherwise make use of after the date hereof and during the entire term of this Agreement;</p>\r\n  <p>(f)\t“Perpetual”, shall mean that there is no expiry or end date on the rights to use the Content;</p>\r\n  <p>(g)\t“Worldwide” shall mean that the Content can be used in any geographic territory;</p>\r\n  <p>(h)\t“Unlimited” shall mean that the Content can be used for unlimited number of times;</p>\r\n  <p>(i)\t“Media” shall mean unless otherwise stated in the Rights and Restrictions, any and all media, now known or hereafter devised;</p>\r\n  <p>(j)\t“Piracy” shall mean the unauthorized use or illegal reproduction,plagiarism, illegal copying, copyright infringement, bootlegging, stealing of the Content, or the Company’s data or Confidential Information through any media ;</p>\r\n  <p>(k)\t\"Rights and Restrictions\" shall mean the information available to the User at the time of the Licensed Material selection, either: (i) accompanying the Licensed Material on any website where the Licensed Material is offered for licensing (including all areas of the purchase process); (ii) in any invoice or order receipt; and (iii) in any other written communication accompanying the Licensed Material. Such Rights and Restrictions may include, without limitation, a description of the Licensed Material, the permitted scope of use, any territory or other use restrictions applicable to the Licensed Material selected and the corresponding price for the license of such Licensed Material.</p>\r\n  <p>(l)\t“Licensed Material\" means the images, photographs, films and other visual media offered for licensing by Us and selected for use by the User. Any reference in this Agreement to the Licensed Material shall be to each part of the Licensed Material and also to the Licensed Material as a whole.</p>\r\n  <p>(m)\t“Territory” means the Union of Indiaand such other countries, for which the Content has been licensed to the User;</p>\r\n  <p>(n)\t“License” shall be as defined in Clause 3 of this Agreement.</p>\r\n  \r\n  \r\n  <h3  class=\"f-18 pt-3 pb-3\">LICENSE</h3>\r\n  <p>Subject to the further provisions of this Agreement, the Company may grant any of the followinglicenses to the User (“License”)as follows:</p>\r\n  <p>(i) Royalty – Free: Royalty-free means that the Content shall be available for unlimited, perpetual worldwide, non-exclusive use upon payment of a one-time Fee. This type of License does not incur any additional royalty. This type of Content may be used on all types of Media, print, digital or in any other medium or format. If the User wishes for an exclusive License for the Content, he/she may discuss a buy-out option.The Fee for such License is to be calculated based on size of the file.</p>\r\n  <p>(ii) Rights -Ready and Rights- Managed:  Rights-managed and rights-ready Content is licensed for specific use on a non-exclusive basis. These types of Licenses carry restrictions ondefinite use,medium, period of time, print run, placement, size of Content and territory selected, and any other restrictions that accompany the Content. The Company shall state all such restrictions on its order confirmation or invoice. If the Userchooses to avail an exclusive License for the Content under the Rights-Managed License, the User shall be liable to pay an additional license Fee. The Fee for such License shall be calculated based on the size of the file, placement, duration of use, and geographic distribution.</p>\r\n <p>(iii) CompositeLicense:The Company offers this type for License on its website or mobile application or any other platform as a Complimentary download, for a period of up to 30 (Thirty) days. This type of License is for the User to familiarize itself with the Content and such Content shall not be used on any publicitymedia platform. </p> \r\n\r\n<h3  class=\"f-18 pt-3 pb-3\">4.CONSIDERATION</h3>\r\n<p>4.1.\tIn consideration for granting the license rights of the Contentto the User, theUser hereby agreed to pay the Company the following amounts (“Fee”):</p>\r\n  <p>[Note: To include the Fee structure]</p>\r\n  <p>4.2.\tAll amounts payable shall be due to be paid within 30(thirty) days from the dateof receipt of the invoice. The User is responsible for paying any and all applicable taxes, including GST, customs and duties imposed by any jurisdiction as a result of the Agreement and /or use of the Content.</p>\r\n  <p>4.3.\tThe User shall incur a service charge of ____ % on the Fee or on the unpaid Fee amount until the entire Fee invoice is paid by the User.</p>\r\n  \r\n  <h3  class=\"f-18 pt-3 pb-3\">5.OBLIGATIONS OF PARTIES:</h3>\r\n  <p>5.1.\tThe User agrees not to use any of the Contentin any manner or for any purpose in violation of the terms of this Agreement.</p>\r\n  <p>5.2.\tThe User agrees not to sublicense, assign, transfer, pledge, offer as security, or otherwise encumber the Content or any of the rights granted in this Agreement in any way other than as expressly provided in the Agreement.</p>\r\n  <p>5.3\tThe User may not use the Content in pornographic, defamatory or any other unlawful manner, or in violation of any applicable regulations.</p>\r\n  <p>5.4.\tThe User, unless granted with additional rights specified on the invoice or sales order, or under separate license agreement, may not use Content marked “Editorial” for any commercial, promotional, advertorial, endorsement, advertising or merchandising purpose. This type of Content may be used only in connection with events or topics that are extraordinary, important or of general public interest. </p>\r\n  <p>5.5.\tFurther, Content marked “Editorial” may be cropped or edited for technical quality, provided that the editorial integrity of the Content is not compromised and may not alter the Content otherwise.</p>\r\n  <p>5.6.\tThe User shall not make available, or sell, license or distribute the Content, in a way that is intended to allow or invite a third party to download, extract, redistribute or access the Content as a standalone file, include the Content in an electronic template intended to be copied by third parties, including, without limitation, in a product or service that enables an end user to create soundtracks, in a system that resells products that include the Content, or in any \"build-it-yourself\" media tools. The User shall not use or display the Content on websites or in any other medium designed to induce or involving the sale, license or other distribution of \"on-demand\" products (e.g., products in which Content is selected by a third party for customization of such product on a made-to-order basis), including, without limitation, electronic greeting cards, voicemail greetings, ring tones, multi-media albums or presentations, or similar items. </p>\r\n  <p>5.7.\tThe User shall not use the Content that features models or property in connection with a subject that would be unflattering or unduly controversial to a reasonable person (for example, sexually transmitted diseases). The User must indicate: (a) that the Content is being used for illustrative purposes only, and (b) any person depicted in the Content is a model. For example, “Stock photo. Posed by model.” No disclaimer is required for Content marked “Editorial” that is used in a non-misleading editorial manner.</p>\r\n  <p>5.7.\tThe User may not falsely represent that he/she is the original creator of a work that is made up largely of licensed Content.</p>\r\n  <p>5.8.\tThe Useris prohibited from using Content in connection with \"on demand\" products,  in which a licensed image is selected by a third party, Content in electronic or digital templates intended for resale or other distribution (for example, website templates, business card templates, electronic greeting card templates, and brochure design templates) and not use Content as part of a trademark, design mark, tradename, business name, service mark, or logo without prior consent in writing and payment of the additional license Fee.</p>\r\n  <p>5.9.\tThe Rights granted to the Userare non-transferable and may not be sub-licensed, except under the circumstances as follows:</p>\r\n  <p>(i)\tIf the User purchased the License on behalf of his/her employer or client. In such situations, the employer or client may use the Content. Further, User is required to represent and warrant that he/she has complete legal authority to bind his/her employer or client to the terms of this Agreement. If the User does not possess such authority, then the employer or client may not use the Content. Lastly, Content rights Licensed may belong to the User, employer or client, alone depending on who is named as the “Licensee” at the time of purchase. </p>\r\n  <p>(ii)\tAdditionally, the User may store licensed royalty-free Content in a digital library, network configuration or similar arrangement for the Content to be viewed by his/her employees and clients, as long as there are no more than a maximum of 10 (Ten) users at any given time. If there are more than 10 (Ten) users, the User is required to purchase additional viewerlicenses.</p>\r\n  <p>(iii)\tThe Usermay allow subcontractors or distributors to use the Content in any production or distribution process related to the end use. These subcontractors and distributors must agree to be bound by the terms of this Agreement and may not use the Content for any other purpose.</p>\r\n  <p>5.10.\tThe User agrees and undertakes that, he/she shall be responsible for tracking all activity for his/her user account. The User shall notify the Company immediately of any unauthorized use or other breach of securityand accept all responsibility for activity that occurs under theuser account. Further, the Company reserves the right to monitor downloads and user activity to ensure compliance with the terms of this Agreement. In the event of any breach of this Clause or any other term of this Agreement, the Companyshall suspend access to the UserAccount without any prior notice or acknowledgement and shall also be able to seek legal remedies.</p>\r\n  <p>5.11.\tThe Company shall deliver the Content to User in accordance with the Delivery Specifications set forth in Clause 4.1. Licensor shall also provide the User with reasonable prior notice of any significant enhancements that generally affect the appearance, updating, delivery or other elements of the Content, and shall make such enhancements available to the User upon commercially reasonable terms.</p>\r\n  <p>5.12.\tThe Company shall provide reasonable on-going assistance to the User with regard to technical, administrative and service-oriented issues relating to the utilization, encoding, transmission and maintenance of the Content, as User may reasonably request. The Company will use its best efforts to ensure that the Content is timely, accurate, comprehensive and updated regularly as set forth in this Agreement.</p>\r\n  <p>5.13.\tThe User understands and agrees that the Company has made reasonable efforts to correctly categorize, keyword, caption and title the Content. However, the Company does not warrant the accuracy of such information, or any of the metadata provided with the Content.</p>\r\n  <p>5.14. \tThe User comprehends that except when the Content is provided “as is” without representation, warranty or condition of any kind, either express or implied, including, but not limited to, implied representations, warranties or conditions of merchantability, or fitness for a particular purpose,the Company does not represent or warrant that the Content or its websites shall meet the User’s requirements or that use of the Content or websites will be uninterrupted or error free.</p>\r\n\r\n  <h3  class=\"f-18 pt-3 pb-3\">6.INTELLECTUAL PROPERTY RIGHTS:</h3>\r\n  <p>6.1.\tThe User understands and agrees that all the Licensed Content is owned by either Company or its original content providers. Any and all rights not expressly granted under this Agreement are reserved by theCompany and the content provider. The Usermay not assert any right to revenue from a collecting society in respect of photocopying, digital copying or other secondary uses of the Licensed Content.The User may not use the Company’s or its content provider names, logos or trademarks without prior written approval.</p>\r\n  <p>6.2.\tThe User understand and agrees that he/shedoes need to include a photo credit for commercial use, but must include the following credit for editorial purposes as follows:</p>\r\n  <p>(a)\tImages: Adjacent to the Content or in production credits: “[Photographer Name]/[Collection Name]/Company’s Name”</p>\r\n  <p>(b)\tAudio and Video:When the Content is used in an audio/visual production where credits are accorded to other providers of Licensed material, User must include the following credit in comparable size and placement: “[Video] [Imagery] supplied by [Artist Name]/[Collection Name]/Company’s Name.</p>\r\n  \r\n  <h3  class=\"f-18 pt-3 pb-3\">7. UNAUTHORISED USE:</h3>\r\n  <p>Any Piracy constitutes copyright infringement, entitling the Company to exercise all rights and remedies available under copyright laws around the world. In addition, and without prejudice to the Company’s other remedies under this Agreement, the Company reserves the right to charge and the User agrees to pay a fee equal to up to _____ (___) times the Company’s standard licence fee for the Piracy of the Content. The  Company reserves the right to terminate this Agreement in the event the User: (i) enters the Agreement after having received notice of Piracy from the Company relating to the Content; (ii) provides inaccurate information regarding its proposed use of the Content at the time of entering the Agreement; (iii) fails to pay the Fee on the due date; or (iv) otherwise breaches the terms of this Agreement. Upon termination, the User must immediately (a) stop using the Content; and (b) destroy or, upon the request of the Company, return to the Company the Content and, in the case of termination by the Company for cause, the Content in the possession or control of the User.</p>\r\n  \r\n  <h3  class=\"f-18 pt-3 pb-3\">8. REPRESENTATIONS AND WARRANTIES:</h3>\r\n  <p>8.1\tEach party represents and warrants to the other party that:</p>\r\n  <p>(a)\tit is duly organized, validly existing and in good standing as a corporation or other entity under the laws and regulations of its jurisdiction of incorporation, organization or chartering;</p>\r\n  <p>(b)\tit has the full right, power and authority to enter into this Agreement, to grant the rights and licenses granted hereunder and to perform its obligations hereunder;</p>\r\n  <p>(c)\tthe execution of this Agreement by its representative whose signature is set forth at the end hereof has been duly authorized by all necessary corporate action of the party; and</p>\r\n  <p>(d)\twhen executed and delivered by such party, this Agreement will constitute the legal, valid and binding obligation of such party, enforceable against such party.</p>\r\n  \r\n  <p>8.2.\tThe User warrants and represents to the Companythat:</p>\r\n  <p>(a)\tshall perform its obligations and duties under this Agreement accurately and in accordance with instructions, specifications, guidelines, timeframe, if any, as are issued from time to time, by the Company and to the satisfaction of the Company;</p>\r\n  <p>(b)\tthe execution and delivery of the Agreement by it and performance by it of its duties and obligations hereunder do not and shall not result in any breach or conflict or violate any provision of law, rule, judgment, order or any other contract applicable to such party.</p>\r\n  <p>(c)\thas no outstanding commitments, liabilities or obligations, contractual or otherwise that would in any respect be in conflict with or impede its ability and right to enter into this Agreement or fulfill any and all of its obligations hereunder, or to conduct the business contemplated hereby.</p>\r\n  <p>(d)\tis not currently and has not ever been subject to existing, pending or threatened litigation, expulsion, bar, suspended or other disciplinary proceeding or action from or by any statutory or regulatory authority that would adversely affect the ability tofulfil its undertakings and obligations underthis Agreement.</p>\r\n  <p>(e)\tshall be responsible for all its taxes, and shall indemnify and hold harmless the Company for any liability in this connection;</p>\r\n  <p>(f)\tshall not adversely affect the reputation and goodwill of the Company or its business associates during the performance of this Agreement;</p>\r\n  <p>(g)\tshall not use or disclose, other than for the sole purpose of performance under this Agreement, any secret and Confidential Information relating to the Company or to any of its affiliates or associates, disclosed to User by the Company or which the Service Providermay otherwise acquire; and</p>\r\n  <p>(h)\tshall ensure that it has adequate financing to enable it to perform the obligations contained in this Agreement;</p>\r\n  <p>(i)\tshall not grant or purport to grant any sub-license or transfer of the rights and / or obligations granted under this Agreement to any other third party;</p>\r\n  <p>8.3\tThe Company warrants and represents to the User that:</p>\r\n  <p>(a)\twarrants thatfor all the Licensed Content (excluding content marked “access only”),  use of such content  by the Userin accordance with this Agreement and in the form delivered by Company (excluding any modifications, overlays or refocusing undertaken by the User) will not infringe on any copyrights or moral rights of the content owner/creator.</p>\r\n  <p>(a)\twarrants thatfor all the Licensed Content (excluding content marked “access only”),  use of such content  by the Userin accordance with this Agreement and in the form delivered by Company (excluding any modifications, overlays or refocusing undertaken by the User) will not infringe on any copyrights or moral rights of the content owner/creator.</p>\r\n  <p>8.4\tUnless specifically warranted above, the Company does not grant any right or make any warranty with regard to the use of names, people, trademarks, trade dress, logos, registered, unregistered or copyrighted audio, designs, works of art or architecture depicted or contained in the content. In such cases, the User is solely responsible for determining whether release(s) is/are required in connection with the User’s proposed use of the Content, and the User is solely responsible for obtaining such release(s). The User acknowledges that no releases are generally obtained for content identified as “editorial,” and that some jurisdictions provide legal protection against a person’s image, likeness or property being used for commercial purposes when they have not provided a release. The User is also solely responsible for payment of any amounts that may be due under, and compliance with any other terms of, any applicable collective bargaining agreements as a result of the User’s use of the licensed content.</p>\r\n  \r\n<h3  class=\"f-18 pt-3 pb-3\">9.\tTERM AND TERMINATION:</h3>\r\n  <p>9.1\tThis Agreement will be effective for a term following the first date of public availability of the Content to the Userand as may specified in the invoice (“Term”).</p>\r\n  <p>9.2\tThis Agreement may be terminated by either party immediately upon notice if the other party: (a) becomes insolvent; (b) files a petition in bankruptcy; (c) makes an assignment for the benefit of its creditors; or (d) breach any of its obligations under this Agreement in any material respect, which breach is not remedied within thirty days following written notice to such party.</p>\r\n  <p>9.3.\tRefunds/Cancellation: All requests for refunds/cancellations must be made in writing or using the cancellation function on the Company’s website within 7 days of purchase and the licensed content must have been unused. The Company may cancel the relevant order and issue a full refund to the User’s account or credit card. No credits or refunds are available for cancellation requests received more than 7 days from your receipt of Content and non-refundable Content and services such as for research, lab, service or subscription fees. </p>\r\n  <p>9.4.\tUpon termination and Cancellation, the User must immediately cease using the Content. User shall delete or destroy any copies and confirm the same to the Company in writing.</p>\r\n  <p>9.5.\t Any termination shall be without any liability or obligation of the terminating party, other than with respect to any breach of this Agreement prior to termination. The provisions relating to Content rights and confidentiality shall survive any termination or expiration of this Agreement.</p>\r\n   \r\n  <h3  class=\"f-18 pt-3 pb-3\">10.\tCONFIDENTIALITY: </h3>\r\n  <p>The parties acknowledge that each of them may have access to confidential and proprietary information, which relates to the other party's business (the \"Confidential Information\"). Such information shall be identified as confidential at the time of disclosure. Each party agrees to preserve and protect the confidentiality of the Confidential Information and not to disclose or use any applicable Confidential Information without the prior written consent of the other party.</p>\r\n  <p>Any party may disclose to any other party or use any information which is:</p>\r\n  <p>(i)\talready publicly known;</p>\r\n  <p>(ii) discovered or created independently of any involvement with such party;</p>\r\n  <p>(iii) otherwise learned through legitimate means other than from such party; or</p>\r\n  <p>(iv) independently created by the receiving party without reference to the other party's confidential information.Moreover, any party may disclose any Confidential Information to such party's agents, attorneys and other representatives or any court or competent jurisdiction or any other party empowered hereunder as reasonably required to resolve any dispute between the parties hereto. Both parties agree all aspects of this contract are confidential and shall not be disclosed to any third party.</p>\r\n  \r\n\r\n  <h3  class=\"f-18 pt-3 pb-3\">11.\tINDEMNITY: </h3>\r\n  <p>11.1.\tThe User shall defend, indemnify and hold harmless the Company , its subsidiaries, affiliates and Content Providers and each of their respective officers, directors and employees from all damages, liabilities and expenses (including reasonable legal fees) arising out of or in connection with (i) his/her use of any Content outside the scope of this Agreement; (ii) any breach or alleged breach by the User(or anyone acting on his/her behalf) of any of the terms of this or any other Agreement with the Company; and (iii) User’s failure to obtain any required release for use of Content.</p>\r\n  <p>11.2.\tIn no event shall the Company be liable to the User or any other person or entity under any contract, strict liability, negligence or other legal or equitable theory, for any special, consequential, incidental, punitive, exemplary or indirect damages or lost profits, however caused, in connection with the subject matter of this Agreement, whether or not the Company has been advised of the possibility of such damage. </p>\r\n  <p>11.3\tUser shall examine all Content for possible defects (whether digital or otherwise) before sending any Content for copying. Without prejudice to Section 7.2 above, the Company shall not be liable for any loss or damage suffered by the User or any third party, whether directly or indirectly, arising from any alleged or actual defect in any Content or its caption or in any way from its copying.</p>\r\n  <p>11.4\tIn any event and under all circumstances, whether contract, tort, or otherwise and not withstanding anything to the contrary herein, the liability of the Company shall be limited to the amounts paid to the Userunder this Agreement.</p>\r\n  \r\n  \r\n  <h3  class=\"f-18 pt-3 pb-3\">GENERAL/MISCELLANEOUS:</h3>\r\n  <p>(a)\tEntire Agreement. This Agreement together with any documents referred to in it constitutes the entire agreement (and supersedes any previous written or oral agreement) between the Parties relating to the subject matter of this Agreement.</p>\r\n  <p>(b)\tNotices: Unless otherwise stated in relation to a particular notice: (i) any notice or other communication given under this Agreement must be in writing, in English and served on a Party at its address or fax number as specified at the commencement of this Agreement (or any other address it has notified to the other Party in accordance with this clause) by hand, by registered post or by fax, and (ii) notices may not be sent by email.</p>\r\n  <p>(c)\tHeadings. The headings in this Agreement will not affect the interpretation of this Agreement.</p>\r\n  <p>(d)\tContent Withdrawal:The Company maydiscontinue licensing any item of Content at any time in its sole discretion. On notice from the Company to User, or upon his/her knowledge, that such content may be subject to a claim of infringement of a third party’s right for which the Company may be liable. The Company may require the User immediately, at his/her own expense cease to use the Content, delete or destroy all copies and ensure that his/her clients, distributors and/or employer commit the same. The Company shall work to provide the User with replacement Content within reasonable commercial judgment) free of charge, subject to the other terms of this Agreement.</p>\r\n  <p>(e)\tElectronic storage: The User agree to retain the copyright symbol, the name of the Company, the Content’s identification number and any other information or metadata that may be embedded in the electronic file containing the original Content, and to maintain appropriate security to protect the Content from unauthorized use by third parties. The User may make one (1) copy of the content as back-up.</p>\r\n  <p>(f)\tEquitable and injunctive relief: Each Party acknowledges that any breach of its obligations under this Agreement will cause that other Party irreparable injury for which there are inadequate remedies at law, and therefore that other Party will be entitled to injunctive and/or equitable relief in addition to all other remedies provided by this Agreement or available at law.  The rights and remedies of the Parties provided in this Agreement shall not be exclusive and are in addition to any other rights and remedies provided by law or equity.</p>\r\n  <p>(g)\tVariation. No variation of this Agreement will be valid unless it is in writing and signed by or on behalf of each Party.</p>\r\n  <p>(h)\tSeverability. If any provision of this Agreement is held illegal, invalid or unenforceable such illegality, invalidity or unenforceability will not affect the other provisions of this Agreement which will remain in full force and effect.</p>\r\n  <p>(i)\tWaiver. A failure to exercise or delay in exercising a right or remedy provided by this Agreement or by law does not constitute a waiver of the right or remedy or a waiver of other rights or remedies. No single or partial exercise of a right or remedy provided by this Agreement or by law prevents further exercise of the right or remedy or the exercise of another right or remedy.</p>\r\n  <p>(j)\tCounterparts. This Agreement may be executed in separate counterparts (and signature pages may be delivered by facsimile or email) all of which together evidence the same agreement.</p>\r\n  <p>(k)\tGoverning Law and Dispute Resolution. This Agreement is governed by the laws of India. In the event a dispute arises between the parties under this Agreement, the parties shall attempt to amicably resolve the dispute through mutual discussions. Where the dispute is not resolved for a period of 30 (Thirty) days from the date of the dispute, either party can, upon giving a written notice to the other party, declare its intention to initiate arbitration proceedings. The arbitration shall be conducted by a sole arbitrator to be mutually agreed by the parties. The arbitration will be conducted in English in accordance with the rules prescribed under the Arbitration and Conciliation Act,1996 and any amendments thereto. The venue for the arbitration shall be in Hyderabad, Telangana. The award of the arbitrator shall be final and binding on the parties. Each party shall bear its own cost of arbitration.</p>\r\n  <p>(l)\tAll Disputes or claims arising out of or relating to this Agreement shall be subject to the exclusive jurisdiction of the courts at Hyderabad, Telangana to which the Parties irrevocably submit. In any suit or action to enforce any right or remedy under this Agreement or to interpret any provision of this Agreement, the prevailing Party will be entitled to recover its costs, including reasonable attorneys' fees. </p>\r\n  <p>(m)\tOther Remedies: The Parties acknowledge that in the event of a breach of the provisions of this Agreement, damages alone may not be a sufficient remedy and, therefore, each Party shall be entitled to seek all equitable remedies, including injunctive relief and specific performance of this Agreement. </p>\r\n  <p><strong>IN WITNESS WHEREOF THE PARTIES HERETO HAVE SET AND SUBSCRIBED THEIR RESPECTIVE HANDS TO THIS PRESENTS AT _____________ON THE DAY MONTH AND YEAR FIRST HERETO ABOVE WRITTEN.</strong></p>\r\n  <div class=\"col-md-12\">\r\n      <div class=\"row\">\r\n      \t<div class=\"col-md-6\">\r\n        \tSIGNED FOR AND ON BEHALF OF THE COMPANY <br />\r\n\r\n\t\t\t________________________________<br />\r\n\t\t\t Signature<br />\r\n\r\n\t\t\t Name:<br />\r\n\t\t\t Designation:<br />\r\n\t\t\t Date:<br />\t\t\r\n        </div>\r\n        <div class=\"col-md-6\">\r\n        \tSIGNED FOR AND ON BEHALF OF THE USER <br />\r\n\r\n\t\t\t_________________________________<br />\r\n\t\t\tSignature<br />\r\n\r\n\t\t\tName:<br />\r\n\t\t\tDesignation:<br />\r\n\t\t\tDate:<br />\r\n\r\n        </div>\r\n      </div>\r\n  </div>\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  </div>\r\n      </div>\r\n    </section>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/lightbox/lightbox.component.html":
  /*!****************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/lightbox/lightbox.component.html ***!
    \****************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppLightboxLightboxComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\n    <div class=\"loader\">\n        Loading\n        <span></span>\n    </div>\n</div>\n<section>\n    <div class=\"container\">\n        <div class=\"card pb-3 shadow-sm\" *ngIf=\"lightBoxListDataItems\">\n            <form method=\"#\">\n                <div class=\"table-responsive\">\n                    <table class=\"table cart-table\">\n                        <tbody>\n                        <tr *ngFor=\"let wishList of lightBoxListDataItems;let i= index\">\n                            <td width=\"3%\"> <div class=\"custom-control custom-checkbox\">\n                                <!--                          <input type=\"checkbox\" class=\"custom-control-input\" id=$index name=\"'example'+i\">-->\n                                <!--                          <label class=\"custom-control-label\" for=$index></label>-->\n                            </div>\n                            </td>\n                            <td width=\"25%\" align=\"center\">\n                                <div class=\"product-info\">\n                                    <a href=\"javascript:void(0)\" *ngIf=\"wishList.product_web=='2'\" >\n                                        <img src=\"{{wishList.product_thumbnail}}\" alt=\"product-img\"  style=\"width:200px;height: 200px;\" />\n                                    </a>\n                                    <a href=\"javascript:void(0)\" *ngIf=\"wishList.product_web=='3'\" >\n                                        <video  width=\"200\" height=\"150\" [poster]=\"wishList.product_thumbnail\" controls controlsList=\"nodownload\"  onmouseover=\"this.play()\" onmouseout=\"this.load()\">\n                                            <source src=\"{{wishList.product_main_image}}\" type=\"video/mp4\">\n                                            Your browser does not support the video tag.\n                                        </video>\n                                    </a>\n\n                                </div>\n\n                            </td>\n\n                            <td width=\"50%\">\n                                <p class=\"mb-1 text-black f-18\"><strong>{{wishList.product_title}}</strong></p>\n                                <p class=\"mb-1 f-16\"><strong></strong>  {{wishList.product_description}}</p>\n                                <div class=\"clearfix\"></div>\n                                <div class=\"mt-2\">\n                                    <a  class=\"btn btn-danger btn-sm f-12\" (click)=\"removeProductFromWishlist(wishList)\"><i class=\"fa fa-times-circle\"></i> Remove</a>\n                                    <a  class=\"btn btn-success btn-sm f-12 text-white ml-1\" routerLink=\"/detail/{{wishList.api_product_id}}/{{wishList.product_web}}/{{wishList.product_main_type}}\"><i class=\"fa fa-heart\"></i> Buy</a>\n                                </div>\n\n                            </td>\n\n                        </tr>\n\n                        </tbody>\n                    </table>\n                </div>\n\n                <hr>\n\n                <div class=\"col-12\">\n                </div>\n\n            </form>\n        </div>\n        <div class=\"card pb-3 shadow-sm\" *ngIf=\"!lightBoxListDataItems\">\n            Your Wishlist is Empty.\n        </div>\n    </div>\n</section>\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/login/login.component.html":
  /*!**********************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/login/login.component.html ***!
    \**********************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppLoginLoginComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\r\n        <div style=\"position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1050;outline: 0;\">\r\n            <div class=\"modal-dialog modal-lg\">\r\n                <div class=\"modal-content rounded-0\">\r\n                    <div class=\"modal-header border-0\">\r\n                        <button type=\"button\" class=\"close f-36\" data-dismiss=\"modal\" (click)=\"closePopup()\">×</button>\r\n                    </div>\r\n                    <div class=\"modal-body\">\r\n                        <div class=\"col-lg-8 offset-lg-2 col-md-8 offset-md- col-sm-10 offset-sm-1\">\r\n                            <div class=\"pl-5 pr-5 pt-2 pb-2\">\r\n                                <div class=\"login-sec\">\r\n                                    <h2 class=\"text-center f-20 text-black mb-3\"><strong>Sign in to Image Footage</strong></h2>\r\n                                    <form class=\"loignForm\" [formGroup]=\"loginForm\" (ngSubmit)=\"onSubmit()\">\r\n                                        <div class=\"text-center\">\r\n                                            <button type=\"button\" class=\"btn btn-outline-dark pt-2 pb-2 pl-5 pr-5 rounded-0\" (click)=\"socialSignIn('facebook')\"><span class=\"icon-facebook text-primary\"></span> Facebook</button>\r\n                                            <button type=\"button\" class=\"btn btn-outline-dark pt-2 pb-2 pl-5 pr-5 rounded-0 ml-2\" (click)=\"socialSignIn('google')\"><span class=\"icon-google text-danger\"></span> Google</button>\r\n                                            <p class=\"pt-3 f-12\">All your activity will remain private.</p>\r\n                                            <div class=\"orSec\"><span class=\"ortextNew\">or</span></div>\r\n                                        </div>\r\n\r\n                                        <div class=\"form-group mt-5\">\r\n                                            <label class=\"text-uppercase f-14 text-black\">Email </label>\r\n                                            <input type=\"email\" class=\"form-control\" formControlName=\"email\" name=\"email\" [ngClass]=\"{ 'is-invalid': submitted && f.email?.errors }\">\r\n                                            <div *ngIf=\"submitted && f.email?.errors\" class=\"invalid-feedback\">\r\n                                              <div *ngIf=\"f.email?.errors.required\">Email is required</div>\r\n                                              <div *ngIf=\"f.email?.errors.pattern\">Invalid email format</div>\r\n                                            </div>\r\n                                          </div>\r\n                                        <div class=\"form-group mt-3\">\r\n                                            <label class=\"text-uppercase f-14 text-black\">Password</label>\r\n                                            <input type=\"password\" class=\"form-control\" formControlName=\"password\"  [ngClass]=\"{ 'is-invalid': submitted && f.password?.errors }\" (keyup.enter)=\"onSubmit()\">\r\n                                            <div *ngIf=\"submitted && f.password?.errors\" class=\"invalid-feedback\">\r\n                                              <div *ngIf=\"f.password?.errors.required\">Password is required</div>\r\n                                          </div>\r\n                                        </div>\r\n\r\n                                        <a class=\"f-14 text-primary\" (click)=\"resetPassword()\">Forgot Password?</a>\r\n\r\n                                        <div class=\"form-group mt-3\">\r\n                                            <button type=\"submit\" [disabled]=\"loading\" class=\"btn btn-dark w-100 d-block rounded-0 p-3 text-white shadow-lg mb-3\">Submit</button>\r\n                                            <p class=\"f-12 text-center\">Not a member as yet?<a routerLink=\"/signUp\" class=\"text-primary\" (click)=\"closeLoginPopupForReg()\"> Register Now</a></p>\r\n                                        </div>\r\n                                    </form>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <!-- <div class=\"modal-footer\">\r\n              <button type=\"button\" class=\"btn btn-outline-dark\" (click)=\"modal.close('Save click')\">Save</button>\r\n            </div> -->\r\n        </div>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/messages/messages.component.html":
  /*!****************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/messages/messages.component.html ***!
    \****************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppMessagesMessagesComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div *ngIf=\"messageService.messages.length\">\n\n  <h2>Messages</h2>\n  <button class=\"clear\"\n          (click)=\"messageService.clear()\">clear</button>\n  <div *ngFor='let message of messageService.messages'> {{message}} </div>\n\n</div>\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/order-confirmation/order-confirmation.component.html":
  /*!************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/order-confirmation/order-confirmation.component.html ***!
    \************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppOrderConfirmationOrderConfirmationComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\n    <div class=\"loader\">\n        Loading\n        <span></span>\n    </div>\n</div>\n<section class=\"mt-5\">\n\n    <div class=\"container\">\n\n        <div class=\"col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1\">\n\n            <div class=\"card z-depth-0\">\n                <div class=\"row\">\n                    <div class=\"col-lg-6 col-md-6 col-sm-6\">\n                        <div class=\"p-5 text-center\">\n                            <i class=\"fa fa-chek-circle-o text-success\" aria-hidden=\"true\"></i>\n                            <img src=\"assets/images/check.png\">\n                            <div class=\"clearfix\"></div>\n                            <h3 class=\"f-20 mb-3 text-success\">ORDER CONFIRMED</h3>\n                            <p>Thank you,your confirmation has been successful and your booking is now confirmed.</p>\n\n                            <div class=\"mt-5 pt-5\">\n                                <button type=\"button\" class=\"btn btn-success btn-block text-white  p-3 text-uppercase\"><strong>Go to your Order\n                                </strong></button>\n                            </div>\n                        </div>\n                    </div>\n\n\n                    <div class=\"col-lg-6 col-md-6 col-sm-6\">\n                        <div class=\"bg-light\">\n                            <div class=\"p-3\">\n\n<!--                                <p class=\"f-20 mb-0\"><b>Illustration in Sketch or AI</b></p>-->\n<!--                                <p><small>Includes: Sketch,PSD,PNG,PDF,SVG,AI</small></p>-->\n\n                                <ul class=\"pt-3\">\n                                    <li class=\"mb-3\">Order ID : IMG-0000{{OrderDetailData.id}}</li>\n                                    <li class=\"mb-3\">Transaction ID : {{OrderDetailData.txn_id}}</li>\n                                </ul>\n                            </div>\n\n                            <table class=\"table mb-0\">\n\n                                <tbody>\n<!--                                <tr>-->\n<!--                                    <td>-->\n<!--                                        <button class=\"btn btn-default pl-5 pr-5\">Subtotal</button>-->\n<!--                                    </td>-->\n<!--                                    <td>$36.00</td>-->\n<!--                                </tr>-->\n                                <tr>\n                                    <td>\n                                        <p><b>Sub Total</b></p>\n                                    </td>\n                                    <td><b>{{OrderDetailData.order_total - OrderDetailData.tax}} INR</b></td>\n                                </tr>\n\n                                <tr>\n                                    <td>\n                                        <p><b>Charges</b></p>\n                                    </td>\n                                    <td><b>{{OrderDetailData.tax}} INR</b></td>\n                                </tr>\n                                <tr>\n                                    <td>\n                                        <h4><b>Total</b></h4>\n                                    </td>\n                                    <td><h4><b>{{OrderDetailData.order_total}}</b></h4></td>\n                                </tr>\n                                </tbody>\n                            </table>\n\n                        </div>\n                    </div>\n\n\n                </div>\n\n\n            </div>\n\n\n\n\n            <div class=\"card z-depth-0 mt-3\">\n                <div class=\"row\">\n                    <div class=\"col-lg-12 col-md-12 col-sm-12\">\n                        <div class=\"p-5\">\n\n                            <h3 class=\"f-20 mb-3 text-success\"><img src=\"assets/images/check.png\"> ORDER CONFIRMED</h3>\n                            <p class=\"text-success\">Thank you,your confirmation has been successful and your booking is now confirmed.A confirmation email has been sent to <b class=\"text-success\">{{OrderDetailData.order_email}}</b></p>\n\n\n                            <p class=\"f-20\"><b>Order Details</b> </p>\n\n                            <div class=\"thumbnail border-1\">\n\n                                <table class=\"table mb-0 border-0\" *ngFor=\"let itemdata of OrderDetailData.items;let i= index\">\n\n                                    <tbody>\n                                    <tr>\n                                        <td class=\"text-right\">\n                                            <span class=\"text-success\">Product  :</span>\n                                        </td>\n                                        <td>{{itemdata.product_name}}</td>\n                                    </tr>\n                                    <tr>\n                                        <td class=\"text-right\">\n                                            <span class=\"text-success\">Product ID :</span>\n                                        </td>\n                                        <td>{{itemdata.product_id}}</td>\n                                    </tr>\n                                    <tr>\n                                        <td class=\"text-right\">\n                                            <span class=\"text-success\">Product Size:</span>\n                                        </td>\n                                        <td>{{itemdata.standard_type}} {{itemdata.standard_size}}</td>\n                                    </tr>\n                                    <tr>\n                                        <td class=\"text-right\">\n                                            <span class=\"text-success\">Quantity :</span>\n                                        </td>\n                                        <td>1</td>\n                                    </tr>\n                                    <tr>\n                                        <td class=\"text-right\">\n                                            <span class=\"text-success\">Product Price :</span>\n                                        </td>\n                                        <td>{{itemdata.standard_price}} INR</td>\n                                    </tr>\n                                 </tbody>\n                                </table>\n\n                            </div>\n\n                        </div>\n                    </div>\n\n\n\n                </div>\n\n\n            </div>\n\n\n\n\n\n\n        </div>\n\n        <div class=\"clearfix\"></div>\n\n\n\n\n    </div>\n</section>\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/pricing/pricing.component.html":
  /*!**************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/pricing/pricing.component.html ***!
    \**************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppPricingPricingComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<section class=\"banner-area relative\">\r\n        <div class=\"overlay overlay-bg\"></div>\r\n        <div class=\"banner-content text-center\">\r\n          <h1>Pricing, made simple.</h1>\r\n          <p>We are a privately owned group offering a variety of services that include,\r\n            <br />\r\n             stock imagery,stock footage, photography\r\n          </p>\r\n        </div>\r\n      </section>\r\n    \r\n    <section class=\"pt-5 pb-0\">\r\n      <div class=\"container\">\r\n        <div class=\"btn-group  nav nav-tabs justify-content-center border-0\">  \r\n            <a href=\"#imagesTab\" data-toggle=\"tab\" class=\"btn btn-secondary btn-rounded active pt-2 pb-2 pl-4 pr-4\"><i class=\"icon-image\"></i> Images\r\n            </a>\r\n           <a href=\"#videoTab\" data-toggle=\"tab\" class=\"btn btn-secondary btn-rounded pt-2 pb-2 pl-4 pr-4\"><i class=\"icon-camera\"></i> Videos\r\n          </a>  \r\n      </div>  \r\n  </div>\r\n  \r\n  \r\n    <div class=\"pricing1\">\r\n      <div class=\"tab-content\">\r\n        <div class=\"tab-pane active\" id=\"imagesTab\">\r\n                      <div class=\"container\">\r\n                          <div class=\"row mt-40\">\r\n                              <!-- Column -->\r\n                              <div class=\"col-lg-3 col-md-6 pl-1 pr-1\">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">BASIC</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">28</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                         \r\n                                          <p class=\"mb-0 pt-5\"> <strong>0.5MP</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                             <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <!-- Column -->\r\n                               <div class=\"col-lg-3 col-md-6 pl-1 pr-1\">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">MEDIUM</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">50</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                            <p class=\"mb-0 pt-5\"> <strong>0.5MP</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                              <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <!-- Column -->\r\n                              <div class=\"col-lg-3 col-md-6 pl-1 pr-1\">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">LARGE</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">85</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                            <p class=\"mb-0 pt-5\"> <strong>5.7MP</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                              <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <!-- Column -->\r\n                               <div class=\"col-lg-3 col-md-6 pl-1 pr-1\">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">X-LARGE</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">120</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                            <p class=\"mb-0 pt-5\"> <strong>12MP+</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                              <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                          </div>\r\n  \r\n                          <div class=\"pt-5 pb-5\">\r\n                            \r\n                            <h2 class=\"pb-4\">Image Licenses at Imagefootage</h2>\r\n                              <p class=\"f-16\">All of our images fall under the Standard Royalty-Free License. The license covers commercial use including:</p>\r\n                              <ul class=\"f-16\">\r\n                                <li><i class=\"icon-check\"> </i> Advertising, blog posts, inclusion in websites, annual reports, editorial, design elements, book covers, product packaging, etc.</li>\r\n                              <li><i class=\"icon-check\"> </i> Up to 500,000 copies in print</li>\r\n                              <li><i class=\"icon-check\"> </i> Unlimited electronic impressions (web, ebook, etc.)</li>\r\n                              <li><i class=\"icon-check\"> </i> Worldwide, all media, unlimited time</li>\r\n                              </ul>\r\n                          </div>\r\n                      </div>\r\n                    </div>\r\n  \r\n                     <div class=\"tab-pane\" id=\"videoTab\">\r\n                      <div class=\"columnFive\">\r\n                          <div class=\"row mt-40\">\r\n                              <!-- Column -->\r\n                              <div class=\"col-lg-2 col-md-6 col-half-offset pl-1 pr-1\">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">720P H.264</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">28</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                         \r\n                                          <p class=\"mb-0 pt-5\"> <strong>0.5MP</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                             <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <!-- Column -->\r\n                               <div class=\"col-lg-2 col-md-6 pl-1 pr-1 col-half-offset \">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">1080P H.264</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">50</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                            <p class=\"mb-0 pt-5\"> <strong>0.5MP</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                              <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <!-- Column -->\r\n                              <div class=\"col-lg-2 col-md-6 pl-1 pr-1 col-half-offset \">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">1080P UNGRADED</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">85</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                            <p class=\"mb-0 pt-5\"> <strong>5.7MP</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                              <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <!-- Column -->\r\n                               <div class=\"col-lg-2 col-md-6 pl-1 pr-1 col-half-offset \">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">4K H.264</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">120</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                            <p class=\"mb-0 pt-5\"> <strong>12MP+</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                              <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n  \r\n                              <div class=\"col-lg-2 col-md-6 pl-1 pr-1 col-half-offset \">\r\n                                  <div class=\"card text-center card-shadow\">\r\n                                      <div class=\"card-body font-14\">\r\n                                          <h5 class=\"title\">4K UNGRADED</h5>\r\n                                          <h6 class=\"subtitle\">For Team of 3-5 Members</h6>\r\n                                          <div class=\"pricing\">\r\n                                              <sup>$</sup>\r\n                                              <span class=\"monthly display-5\">120</span>                                         \r\n                                              <small class=\"monthly\">USD</small>\r\n                                            <div class=\"clearfix\"></div>\r\n                                              \r\n                                          </div>\r\n                                          <ul class=\"list-inline\">\r\n                                              <li>Ideal for basic web use such as blogs, articles, or brochure sites.</li>\r\n                                              <li>Unlimited Invoices</li>\r\n                                              <li>Project Management</li>\r\n                                              \r\n                                          </ul>\r\n                                            <p class=\"mb-0 pt-5\"> <strong>12MP+</strong></p>\r\n                                           <p>815 x 614px | 11.3 x 8.5\" @ 72dpi</p>\r\n                                          <div class=\"bottom-btn\">\r\n                                              <a class=\"btn btn-success-gradiant btn-md btn-arrow btn-block text-white\" data-toggle=\"collapse\" href=\"#f1\">Choose Plan</a>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                          </div>\r\n  \r\n                          <div class=\"pt-5 pb-5\">\r\n                            \r\n                            <h2 class=\"pb-4\">Video Licenses at Imagefootage</h2>\r\n                              <p class=\"f-16\">All of our images fall under the Standard Royalty-Free License. The license covers commercial use including:</p>\r\n                              <ul class=\"f-16\">\r\n                                <li><i class=\"icon-check\"> </i> Advertising, blog posts, inclusion in websites, annual reports, editorial, design elements, book covers, product packaging, etc.</li>\r\n                              <li><i class=\"icon-check\"> </i> Up to 500,000 copies in print</li>\r\n                              <li><i class=\"icon-check\"> </i> Unlimited electronic impressions (web, ebook, etc.)</li>\r\n                              <li><i class=\"icon-check\"> </i> Worldwide, all media, unlimited time</li>\r\n                              </ul>\r\n                          </div>\r\n                      </div>\r\n                    </div>\r\n  \r\n                  </div>\r\n                   </div>\r\n  \r\n  \r\n  </section>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/privacy-policy/privacy-policy.component.html":
  /*!****************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/privacy-policy/privacy-policy.component.html ***!
    \****************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppPrivacyPolicyPrivacyPolicyComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<section class=\"banner-area relative\">\r\n        <div class=\"overlay overlay-bg\"></div>\r\n        <div class=\"banner-content text-center\">\r\n          <h1>Privacy Policy</h1>\r\n          \r\n        </div>\r\n      </section>\r\n    \r\n    <section class=\"pt-5 bg-white text-black f-3 l-space\">\r\n    \r\n      <div class=\"container\">\r\n  \r\n    <div class=\"static-wrapper\">\r\n  <div class=\"section-title text-left pb-2\">\r\n  <span style='float: right;'>Effective Date:_____2018</span>\r\n  <h3  class=\"f-18 pt-3 pb-3\">1. INTRODUCTION</h3>\r\n  <!--<p>Last Updated: November 2016</p>-->\r\n  </div>\r\n  <p>A.\tYou (\"you\") are required to read and accept all of the terms and conditions laid down in this Privacy Policy Statement (“Policy”) and the linked Terms and Conditions, before you use the website and content (“Content”)made available to you by _____________________ (hereinafter referred to as “we” or “our”). </p>\r\n<p>B.\tWe are committed to maintaining your privacy. Our privacy policy statement is given below.  If we make changes to this Policy, we will notify you by updating this Policy statement on our Website (“Website”). This Policy outlines the manner your data is collected and used by us. You are advised to please read the Policy carefully. By accessing the Content provided by the Site, you agree to the collection and use of your data by us in the manner provided in this Policy. </p>  \r\n<p>C.\tThe Policy does not apply to the procedures and practices followed by entities that are not managed, owned or controlled by us or to the people that are not engaged, employed or managed by us. Through this document, we wish to make you:</p>\r\n<p>\r\n(i)\t    Feel at ease while using our Website;</p>\r\n<p>(ii)\tFeel confident while sharing information with us;</p>\r\n<p>(iii)\tAware that you may contact us with your questions or concerns about privacy on our Website;</p>\r\n<p>(iv)\tAware that by using our website you are agreeing to the collection of certain data.</p>\r\n<p>D. For purposes of this Policy:</p>\r\n<p>(i)\t“Business partners” means all Owner - Licensors, subcontractors, vendors or other entities with which we have a relationship for constant commercial supplies, Content or information;</p>\r\n<p>(ii)\t“Information” shall include data, message, text, images, sound, voice, codes, computer programmes, software and data bases.</p>\r\n<p>(iii)\t“Personal Information” means any information which is capable of identifying you (either directly or indirectly, in combination with other information available or likely to be available with us), such as your name, phone number and email address;</p>\r\n<p>(iv)\t“Privacy Rules” means Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Data or Information) Rules, 2011 updated from time to time;</p>\r\n<p>(v)\t“Sensitive Personal Data or Information” shall have the meaning ascribed to such term under the Privacy Rules.</p>\r\n<p>2.\tINFORMATION COLLECTED</p>\r\n<p>(i)\tWe collect the details provided by you together with information we learn about you from your use of our Content and your visits to our Website and other websites accessible from them.</p>\r\n<p>(ii)\tWe may collect additional information in connection with your participation in any promotions or contests offered by us and information you provide when giving us feedback or completing profile forms. We also monitor customer traffic patterns and website use, which enables us to improve the service we provide. We will collect only such information as is necessary and relevant to us to provide you with the Content available on the Website.</p>\r\n<p>(iii)\tWhile you use our website, we may have automatic access to (receive and collect) certain anonymous information in standard usage logs through our web server, obtained from “cookies” sent to your browser from web server cookies stored on your hard drive, including but not limited to:</p>\r\n<p>(a)\tComputer-identification information;</p>\r\n<p>(b)\tIP address, assigned to the computer/mobile phone which you use;</p>\r\n<p>(c)\tThe domain server through which you access our service;</p>\r\n<p>(d)\tThe type of mobile phone/computer you're using;</p>\r\n<p>(e)\tThe type of web/mobile browser you're using.</p>\r\n<p>(v)\tWe may also collect the following information about:</p>\r\n<p>(a)\tThe pages you visit/access;</p>\r\n<p>(b)\tThe links you click on our website;</p>\r\n<p>(c)\tThe number of times you access the page/app mobile screen;</p>\r\n<p>(d)\tThings you view, add to bag, add to wish list;</p>\r\n<p>(e)\tOther websites you open simultaneously while browsing on ours.</p>\r\n\r\n <p>3.\tWHEN / HOW WE COLLECT THE INFORMATION</p>\r\n <p>(i)\tWe may collect anonymous traffic information from you when you visit our Website.</p>\r\n\r\n<p>(ii)\tWe collect the Personal Information from you when you register with us or you transact as a guest. During registration you are required to give us your contact information (such as name, email address, date of birth, gender, address, pin code, mobile number etc.) Upon registration you may receive communications from us (e.g. emails, newsletters, updates). Even when you transact as a guest we collect identifiable information (such as name, email address, date of birth, gender, billing address, delivery address, pin code, mobile number etc.).</p>\r\n\r\n<p>(iii)\tAny Information including Sensitive Personal Data or Information collected by us from you may be stored and processed in India or any other country in which we or our corporate affiliates, subsidiaries or agents maintain facilities that ensure the same level of data protection that is adhered to by us. You shall be deemed to have consented for transfer of your Information including Sensitive Personal Data or Information outside your country if you provide us your consent for collection and use of your Sensitive Personal Data of Information by us in the manner as specified in this Privacy Statement.</p>\r\n\r\n<p>(iv)\tWe assure you that any Sensitive Personal Data or Information provided by you is collected when the collection of such information is necessary and used by us for a lawful purpose connected with our function or activity. </p>\r\n\r\n<p>(v)\tWe shall be permitted to use this information to contact you about the Content you are using on our Website and Content in which you have expressed interest.</p>\r\n\r\n<p>(vi)\tWe are the sole owners of your information collected by us at different points on our Website/.</p>\r\n\r\n<p>(xii)   We will collect Personal Information about you only as part of on-line survey, or contest or any combination thereof.</p>\r\n\r\n<p>(vii)\tThe Website contains links to other websites. We are not responsible for the privacy practices of such websites which we do not own, manage or control.</p>\r\n\r\n<p>(viii)\tWe may at certain times make chat rooms, forums, instant messenger and message boards and other Content available to you. Please understand that any information that is disclosed in these areas becomes public information. We have no control over its use and you should exercise caution when disclosing your personal information to anyone.</p>\r\n\r\n<p>(ix)\tIf you use a bulletin board or chat room on our Websites, you should be aware that any Personal Information you submit there can be read, collected, or used by other users of these forums, and could be used to send you unsolicited messages. We are not responsible for the Personal Information you choose to submit in these forums.</p>\r\n  \r\n  <p>4.\tDISCLOSING PERSONAL INFORMATION</p>\r\n  <p>You agree that we may share or disclose your Information including Sensitive Personal Data or Information with corporate affiliates and business partners (a) to carry out transactions you request or to make our business or that of our corporate affiliates more responsive to your needs; (b) if we reasonably consider it necessary to protect ourselves, its customers, or the public; (c) who help us to perform transactions you request or who help us to customize, evaluate, process, analyse, and/or improve our communication or relationship with you. We impose an obligation on our corporate affiliates and business partners who receive your Sensitive Personal Data or Information to keep such information secure in accordance with the Privacy Rules and to not disclose it further to third parties. You shall be deemed to have consented to sharing and disclosure of your Information including Sensitive Personal Data or Information by us with our corporate affiliates and business partners if you give your consent to provide us with your Sensitive Personal Data of Information in the manner as specified in this Policy. We may also disclose any Information provided by you (which may include your Personal Information and Sensitive Personal Data or Information) (a) in connection with law enforcement, fraud prevention, or other legal actions or legal obligations; or (b) if required to do so under applicable law or regulation in your country or by an order under the law for the time being in force; or (c) to government agencies mandated under the law of your country to obtain such information for the purpose of verification of identity, or for prevention, detection, investigation including any real or suspected adverse event in relation to cyber security that violates any applicable security policy. No consent will be required to be obtained by us from you for any of the aforesaid disclosures. In addition, you agree that we may share your Information with business partners that help us carry out transactions you request or that help us to customize, process, evaluate, analyse, and/or improve our communication or relationship with you, and who share our commitment to protecting your Information. Except as described above, we will not disclose your Personal Information including your Sensitive Personal Data or Information to third parties for their own marketing purposes, unless you consent for the same.</p>\r\n  <p>5.\tHOW IS THE INFORMATION USED?</p>\r\n  <p>We shall use your contact information to send you Special offers; Changes in the policies or terms of use; or event based communications such as invites, reminders etc. We use your personal information to improve personalized features on our Website; or to preserve social history as governed by existing law or policy. We use anonymous traffic information to recognize your usage privileges to our Website; or track your session and activities so that we can understand better how people use our Website. </p>\r\n  <p>6.\tWHO DO WE SHARE YOUR INFORMATION WITH?</p>\r\n  <p>(i)\tWe do not share or rent your information with third parties.</p>\r\n  <p>(ii)\tWe do not rent, sell or share your Personal Information or Sensitive Personal Information and we will not disclose any of your Personal Information to any other third parties unless: </p>\r\n  <p>(a)\tRequired by special circumstances such as compliance with subpoenas, court orders, requests/order from legal authorities or law enforcement agencies requiring such disclosure; </p>\r\n  <p>(b)\tTo help investigate, prevent or take action regarding unlawful and illegal activities, suspected fraud, potential threat to the safety or security of any person, violations of terms of use or to defend against legal claims; </p>\r\n  <p>(c)\tWe have your permission; or</p>\r\n  <p>(d)\tTo provide Content requested by you.</p>\r\n  <p>(iv)\tWe reserve the right to disclose your Personal Information or Sensitive Personal Information and email address information as required by law and when we believe that disclosure is necessary to protect our rights and/or comply with a judicial proceeding, court order, or legal process served on our Website.</p>\r\n  <p>(v)\tIf we do share your information with advertisers it will strictly be on an aggregate basis only.</p>\r\n  <p>(vi)\tThe security of your personal information and email address is important to us. When you enter sensitive information (such as credit / debit card number) on our acquiring bank’s system or order forms, they encrypt that information using secure socket layer technology (SSL). To learn more about SSL, follow this link http://www.verisign.com/.  </p>\r\n  <p>(vi)\tThe security of your personal information and email address is important to us. When you enter sensitive information (such as credit / debit card number) on our acquiring bank’s system or order forms, they encrypt that information using secure socket layer technology (SSL). To learn more about SSL, follow this link http://www.verisign.com/.  </p>\r\n  <p>(vii)\tWe follow generally accepted industry standards to protect the personal information and email address submitted to us, both during transmission and once we receive it. No method of transmission over the Internet, or method of electronic storage, is 100% secure, however. Therefore, while we strive to use commercially acceptable means to protect your Personal Information and email address, we cannot guarantee its absolute security.</p>\r\n  <p>(viii)\tIf you have any questions about security on our Website you can email us at: ____________________.</p>\r\n  <p>7.\tHOW YOU CAN ACCESS YOUR INFORMATION</p>\r\n  <p>We want to maintain the Information including Personal Information and Sensitive Personal Data or Information provided by you accurately.</p>\r\n  <p><b>WE SHALL NOT BE RESPONSIBLE FOR THE AUTHENTICITY OF THE INFORMATION OR SENSITIVE PERSONAL DATA OR INFORMATION SUPPLIED BY YOU AND ALL LIABILITIES IN RESPECT OF THE LOSSES WHICH MAY OCCUR DUE TO SUCH INCORRECT PERSONAL INFORMATION OR SENSITIVE PERSONAL DATA OR INFORMATION WILL BE SOLELY ATTRIBUTABLE TO YOU.</b></p>\r\n  <p>8.\tSELECTING YOUR COMMUNICATION PREFERENCES</p>\r\n  <p>(i)\tYou may choose to receive or not receive marketing communications from us by indicating your preferences through an email at _______________________for the website. All marketing by us or any third party on behalf of us, will be conducted in accordance with applicable laws of your country.</p>\r\n  <p>(ii)\tPlease allow up to 10 business days for your email preferences to become effective.</p>\r\n  <p>(iii)\tAs some promotions, such as direct catalogues, are developed in advance, you may receive marketing communication after receiving your request preference.</p>\r\n  <p>9.\tHOW WE SECURE YOUR INFORMATION </p>\r\n  <p>We are committed to protecting the security of your Information including Personal Information and Sensitive Personal Data or Information. We use a variety of security technologies and procedures to help protect your Information, Personal Information and Sensitive Personal Data or Information from unauthorized access, usage and disclosure, such as encryption, passwords, physical security, etc. While we strive to protect such information, we cannot ensure or warrant or guarantee that your Information or private communications you transmit to us will always remain private or confidential, and you do so at your own risk. </p>\r\n  <p>10.\tCOLLECTION AND USE OF CHILDREN'S INFORMATION</p>\r\n  <p>We seriously consider the privacy of children. If you are under 18 years of age, please do not submit any Personal Information and Sensitive Personal Data or Information through our websites without the consent and / or participation of a parent or guardian. We cannot ensure, warrant or guarantee that your Information or private communications or information directly transmitted/ submitted by a child under 18 years of age, will always remain private or confidential, and you do so at your own risk. </p>\r\n  <p>11.\tCHOICES AVAILABLE REGARDING COLLECTION, USE AND DISTRIBUTION OF INFORMATION</p>\r\n  <p>(i)\tYou can accept or decline the cookies. All websites that are customizable require that you accept cookies. For information on how to set your browser to alert you to cookies, or to reject cookies, go to http://www.cookiecentral.com/</p>\r\n  <p>(ii)\tCookies: A cookie is a small text file that is stored on a user's computer for record-keeping purposes. We use cookies on this Website. We do link the information we store in cookies to any Personal Information you submit while on our Website.</p>\r\n  <p>(iii)\tWe use both session ID cookies and persistent cookies. We use session cookies to make it easier and secure for you to navigate our Website. A session ID cookie expires when you close your browser. A persistent cookie remains on your hard drive for an extended period of time. You can remove persistent cookies by following directions provided in your Internet browsers “help” file. Reference for cookies can be found at http://www.cookiecentral.com/</p>\r\n  <p>(iv)\tWe use session cookies to store the secure session and browsing preferences of the user. We set a persistent cookie to store your username and interests so you don't have to enter it more than once. Persistent cookies also enable us to track and target the interests of our users to enhance the experience on our Website.</p>\r\n  <p>(v)\tIf you reject cookies, you may still use our website, but your ability to use some areas of our website, will be limited. </p>\r\n  <p>(vi)\tUnless you voluntarily identify yourself (through registration or social sign-up, for example), we will have no way of knowing who you are, even if we assign a cookie to your computer. The only personal information a cookie can contain is information you supply. A cookie cannot read data off your hard drive.</p>\r\n  <p> (vii)\tSome of our business partners (e.g., advertisers) set cookies while delivering banners on our Website. We have no access to or control over these cookies. .</p>\r\n  <p>(vii)\tWe do use cookies on point of collection pages of email address but we do not use them in emails.</p>\r\n  <p>(viii)\tOur web servers automatically collect limited information about your computer's/mobile phone’s connection to the Internet, including your IP address/Android or iOS token , when you visit or use our Website. (Your IP address is a number that lets computers attached to the Internet know where to send you data such as the web pages you view.) Your IP address does not identify you personally. We use this information to deliver our web pages to you upon request, to tailor our Website to the interests of our customers, to measure traffic within our website and let advertisers know the geographic locations from where our visitors come.</p>\r\n  <p>(ix)\tOur Website may include links to other websites. Such websites are governed by their respective privacy policies, which are beyond our control. Once you leave our servers (you can know where you are by checking the URL in the location bar on your browser), use of any information you provide is governed by the privacy policy of the operator of the website you are visiting. That policy may differ from ours. If you can't find the privacy policy of any of these websites via a link from the website's homepage, you should contact the website directly for more information.</p>\r\n  <p>12.\tVOLUNTARY DISCLOSURE OF INFORMATION</p>\r\n  <p>(i)\tProviding us with Personal Information is entirely voluntary. </p>\r\n  <p>(ii)\tYou may change your interests at any time and may opt-in or opt-out of any marketing / promotional / newsletters mailings. </p>\r\n  <p>(iii)\tUpon request, we will remove / block your Personal Information from our database, thereby cancelling your registration. However, your Information may remain stored in archive on our servers even after the deletion or the termination of your account.</p>\r\n  <p>(v)\tIf we plan to use your Personal Information for any commercial purposes, we will notify you at the time we collect that information and allow you to opt-out of having your information used for those purposes. </p>\r\n  <p>13.\tSECURITY PROCEDURES TO PROTECT INFORMATION FROM LOSS, MISUSE OR ALTERATION</p>\r\n  <p>(i)\tTo protect your privacy and security, we will verify your identity, to the best of our abilities, beforegranting access or making changes to your Personal Information. </p>\r\n  <p>(ii)\tTo protect against the loss, misuse and alteration of the information under our control, we have in place appropriate physical, electronic and managerial procedures. For example, our servers are accessible only to authorized personnel and your information is shared with respective personnel on need to know basis to complete the transaction and to provide the Content requested by you. </p>\r\n  <p>(iii)\tAlthough we will endeavour to safeguard the confidentiality of your Personal Information, transmissions made by means of the Internet cannot be made absolutely secure. By using our  Website, you agree that we will have no liability for disclosure of your information due to errors in transmission or unauthorized acts of third parties.</p>\r\n  <p>(iv)\tWe follow generally accepted industry standards to protect the Personal Information and email addresses submitted to us, both during transmission and once we receive it. No method of transmission over the Internet, or method of electronic storage, is 100% secure, however. Therefore, while we strive to use commercially acceptable means to protect your personal information and email address, we cannot guarantee its absolute security.</p>\r\n  <p>(v)\tIf you have any questions about security on our Website, you can send email us at _____________________.</p>\r\n  <p>(vi)\tAll information gathered on the Site is securely stored within a controlled database. The database is stored on servers secured behind a firewall; access to the servers is password-protected and is strictly limited. However, as effective as our security measures are, no security system is impenetrable. We cannot guarantee the security of our database, nor can we guarantee that information you supply will not be intercepted while being transmitted to us over the Internet and, of course, any information you include in a posting to the discussion areas is available to anyone with internet access.</p>\r\n  <p>(vii)\tHowever, the internet is an ever evolving medium. We may revise our Policy from time to time to incorporate necessary changes. Of course, our use of any information we gather will always be consistent with the policy under which the information was collected, regardless of what the new policy may be.  </p>\r\n  <p>(viii)\tWe use third-party advertising companies to serve ads when you visit our website. These companies may use information (not including your name, address, email address or telephone number) about your visits to this and other websites in order to provide advertisements about goods and Content of interest to you.</p>\r\n  <p>14.\tTHIRD-PARTY WEBSITES AND CONTENT</p>\r\n  <p>Be aware that other websites that can be accessed through our website may collect your Information, Personal Information and Sensitive Personal Data or Information. The information practices of those third-party websites are not covered by this Privacy Statement. We will not be responsible for any breach of your privacy or any other loss arising to you as a result of collection of you Information, Personal Information and Sensitive Personal Data or Information by such websites. </p>\r\n  <p>Please be aware that, in providing Content on our behalf, our business partners may collect information about you to provide Content on behalf of us.</p>\r\n  <p>15.\tPOLICY UPDATES</p>\r\n  <p>(i)\tWe reserve the right to change or update this Policy at any time by placing a prominent notice on our website. Such changes shall be effective immediately upon posting to this website. </p>\r\n  <p>(ii)\tIf we make changes to this Privacy Statement or we make any material changes to the way we will use your Information including Personal Information and Sensitive Personal Data or Information, we will review the Privacy Statement to reflect such changes and also the effective date of the declaration, included at the end of this section. We reserve the right to modify this privacy statement at any time, so please review it frequently. If we make material changes to this policy, we will notify you on our homepage. </p>\r\n  <p>If we decide to make changes in our email practices, we will post those changes to this privacy policy, the homepage, and other places we deem appropriate so that you are aware of what information we collect, how we use it, and under what circumstances, if any, we disclose it.</p>\r\n  <p>We encourage you to periodically review this Privacy Statement to stay informed about how we are protecting your Information including Personal Information and Sensitive Personal Data or Information.</p>\r\n  <p>16.\tCONTACT INFORMATION</p>\r\n  <p>If you have any questions about this Site or our privacy policies, visit the front page of our website, scroll to the bottom, click 'contact us' and send an email.</p>\r\n \r\n \r\n \r\n \r\n  \r\n  \r\n  </div>\r\n      </div>\r\n    </section>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/reset-password/reset-password.component.html":
  /*!****************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/reset-password/reset-password.component.html ***!
    \****************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppResetPasswordResetPasswordComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\n    <div class=\"loader\">\n        Loading\n        <span></span>\n    </div>\n</div>\n<section class=\"mt-1\">\n\n    <div class=\"container\">\n\n        <div class=\"col-lg-8 col-md-8 col-sm-10 m-auto\">\n\n            <div class=\"card z-depth-0\">\n                <div class=\"row\">\n                    <div class=\"col-lg-6 col-md-6 col-sm-6 hidden-xs\" style=\"background: #ffcac6\">\n                        <!--  <div class=\"layer\">  </div>   -->\n\n\n                        <img src=\"/assets/images/resetpassword.png\" class=\"img-fluid\">\n\n                    </div>\n\n                    <div class=\"col-lg-6 col-md-6 col-sm-6\">\n                        <div class=\"bg-white p-5\">\n                            <div class=\"p-3\">\n\n                                <p class=\"f-20 mb-0\"><b>Reset Password</b></p>\n                                <p><small>Enter the email associated with your account and we'll send an email with instructions to reaet your passowrd.</small></p>\n                                <form class=\"loignForm\" [formGroup]=\"resetpasswordForm\" (ngSubmit)=\"onSubmit()\">\n                                <div class=\"form-group mt-5\">\n                                        <label class=\"text-uppercase f-12 text-black\">Email </label>\n\n                                    <input type=\"email\"  formControlName=\"user_email\" class=\"form-control\"  [ngClass]=\"{ 'is-invalid': submitted && f.user_email.errors }\">\n                                    <div *ngIf=\"submitted && f.user_email.errors\" class=\"invalid-feedback\">\n                                        <div *ngIf=\"f.user_email.errors.required\">Email is required</div>\n                                        <div *ngIf=\"f.user_email.errors.email\">Email must be a valid email address</div>\n                                    </div>\n                                    </div>\n<!--                                    <div class=\"form-group mt-4\">-->\n<!--                                        <label class=\"text-uppercase f-12 text-black\">Password</label>-->\n<!--                                        <input type=\"Password\" class=\"form-control\" placeholder=\"\">-->\n<!--                                    </div>-->\n\n\n<!--                                    <div class=\"form-group mt-4\">-->\n<!--                                        <label class=\"text-uppercase f-12 text-black\">Confirm Password</label>-->\n<!--                                        <input type=\"Password\" class=\"form-control\" placeholder=\"\">-->\n<!--                                    </div>-->\n\n\n\n                                    <div class=\"form-group mt-5\">\n\n                                        <button type=\"submit\" [disabled]=\"loading\" class=\"btn btn-success btn-block text-white  p-3 text-uppercase\">SUBMIT</button>\n\n                                    </div>\n\n                                </form>\n                            </div>\n\n\n                        </div>\n                    </div>\n\n\n                </div>\n\n\n            </div>\n\n\n\n\n\n        </div>\n\n\n    </div>\n\n</section>\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/sign-up/sign-up.component.html":
  /*!**************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/sign-up/sign-up.component.html ***!
    \**************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppSignUpSignUpComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\r\n    <div class=\"loader\">\r\n        Loading\r\n        <span></span>\r\n    </div>\r\n</div>\r\n<div class=\"site-wrap mt-5 pt-5\">\r\n    <main class=\"main-content mt-5 pt-5\">\r\n      <div class=\"container photos\">\r\n        <div class=\"row\">\r\n          \r\n          <div class=\"col-md-10 pt-3\"  data-aos=\"fade-up\">\r\n            <h2 class=\"text-white mb-4\">Create your Image Footage account</h2>\r\n            <p>Already have an account? <a (click)=\"clickLoginPopup()\">Login</a></p>\r\n  \r\n                    <form [formGroup]=\"registerForm\" (ngSubmit)=\"onSubmit()\"  class=\"mt-5 pt-5\">\r\n  \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"col-md-4 col-sm-4 mb-3 mb-md-0\">\r\n                              <label class=\"text-white\">First Name</label>\r\n                              <input type=\"text\" formControlName=\"first_name\" [ngClass]=\"{ 'is-invalid': submitted && f.first_name.errors }\" class=\"form-control text-white\">\r\n                              <div *ngIf=\"submitted && f.first_name.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.first_name.errors.required\">First Name is required</div>\r\n                              </div>\r\n                          </div>\r\n                          <div class=\"col-md-4 col-sm-4 \">\r\n                              <label class=\"text-white\" >Last Name</label>\r\n                              <input type=\"text\" formControlName=\"last_name\" id=\"lname\" [ngClass]=\"{ 'is-invalid': submitted && f.last_name.errors }\"  class=\"form-control text-white\">\r\n                              <div *ngIf=\"submitted && f.last_name.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.last_name.errors.required\">Last Name is required</div>\r\n                              </div>\r\n                          </div>\r\n                          <div class=\"col-md-4 col-sm-4 \">\r\n                            <label class=\"text-white\">Email</label> \r\n                            <input type=\"text\" formControlName=\"email\" id=\"email\" class=\"form-control text-white\" [ngClass]=\"{ 'is-invalid': submitted && f.email.errors }\">\r\n                            <div *ngIf=\"submitted && f.email.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.email.errors.required\">Email is required</div>\r\n                                <div *ngIf=\"f.email.errors.email\">Email must be a valid email address</div>\r\n                            </div>\r\n                          </div>\r\n                      </div>\r\n  \r\n                      <div class=\"row form-group mb-5\">                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Password</label> \r\n                            <input type=\"password\" formControlName=\"password\" [ngClass]=\"{ 'is-invalid': submitted && f.password.errors }\" id=\"pswrd\" class=\"form-control text-white\">\r\n                            <div *ngIf=\"submitted && f.password.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.password.errors.required\">Password is required</div>\r\n                                <div *ngIf=\"f.password.errors.minlength\">Password must be at least 6 characters</div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\">Confirm Password</label> \r\n                            <input type=\"password\" formControlName=\"confirmPassword\" id=\"cnfpswrd\" [ngClass]=\"{ 'is-invalid': submitted && f.confirmPassword.errors }\" class=\"form-control text-white\">\r\n                            <div *ngIf=\"submitted && f.confirmPassword.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.confirmPassword.errors.required\">Confirm Password is required</div>\r\n                                <div *ngIf=\"f.confirmPassword.errors.mustMatch\">Passwords must match</div>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Job Title</label> \r\n                          <input type=\"text\" formControlName=\"occupation\" id=\"jobTitle\" [ngClass]=\"{ 'is-invalid': submitted && f.occupation.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.occupation.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.occupation.errors.required\">JobTitle is required</div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                \r\n                      <div class=\"row form-group mb-5\">\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Company</label> \r\n                          <input type=\"text\" id=\"companyName\" formControlName=\"company\" [ngClass]=\"{ 'is-invalid': submitted && f.company.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.company.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.company.errors.required\">Company is required</div>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Phone</label> \r\n                          <input type=\"text\" id=\"phne\" formControlName=\"phoneNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.phoneNumber.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.phoneNumber.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.phoneNumber.errors.required\">PhoneNumber is required</div>\r\n                          </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                          <label class=\"text-white\">Mobile Number</label> \r\n                          <input type=\"text\" id=\"mbnum\" formControlName=\"mobileNumber\" [ngClass]=\"{ 'is-invalid': submitted && f.mobileNumber.errors }\" class=\"form-control text-white\">\r\n                          <div *ngIf=\"submitted && f.mobileNumber.errors\" class=\"invalid-feedback\">\r\n                            <div *ngIf=\"f.mobileNumber.errors.required\">MobileNumber is required</div>\r\n                            <div *ngIf=\"f.mobileNumber.errors.pattern\">Mobile number should be 10 number digits</div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                      \r\n                      <div class=\"row form-group mb-5\">\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Select Country</label>\r\n                            <select class=\"form-control\" id=\"select-language1\" [ngClass]=\"{ 'is-invalid': submitted && f.country.errors }\"  formControlName=\"country\" (change)=\"onChangeCountry($event.target.value)\">\r\n                                <option *ngFor=\"let country of countryInfo; let i = index\"  value=\"{{country.id}}\">{{country.name}}</option>\r\n                            </select> \r\n                            <div *ngIf=\"submitted && f.country.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.country.errors.required\">Country is required</div>\r\n                             </div>\r\n                        </div>\r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Select State</label>                           \r\n                            <select class=\"form-control\" id=\"select-language2\" formControlName=\"state\" [ngClass]=\"{ 'is-invalid': submitted && f.state.errors }\" (change)=\"onChangeState($event.target.value)\">\r\n                                <option *ngIf=\"stateInfo == ''\" value=\"-1\">--Select State--</option>\r\n                                <option *ngFor=\"let state of stateInfo; let j = index\"  value=\"{{state.id}}\">{{state.state}}</option>\r\n                            </select> \r\n                            <div *ngIf=\"submitted && f.state.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.state.errors.required\">State is required</div>\r\n                             </div>\r\n                        </div>                        \r\n                        <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\">Select City</label> \r\n                            <select class=\"form-control  text-white\" id=\"select-language3\" formControlName=\"city\" [ngClass]=\"{ 'is-invalid': submitted && f.city.errors }\" (change)=\"onChangeCity($event.target.value)\">\r\n                                <option *ngIf=\"cityInfo == ''\" value=\"-1\">--Select CIty--</option>\r\n                                <option *ngFor=\"let city of cityInfo; let k = index\"  value=\"{{city.id}}\">{{city.name}}</option>\r\n                            </select> \r\n                            <div *ngIf=\"submitted && f.city.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.city.errors.required\">City is required</div>\r\n                             </div>\r\n                        </div>\r\n                      </div>\r\n  \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"col-md-4 col-sm-4\">\r\n                            <label class=\"text-white\" >Zip Code</label> \r\n                            <input type=\"text\" id=\"pincode\" class=\"form-control\" formControlName=\"pincode\"  [ngClass]=\"{ 'is-invalid': submitted && f.pincode.errors }\">\r\n                            <div *ngIf=\"submitted && f.pincode.errors\" class=\"invalid-feedback\" >\r\n                                <div *ngIf=\"f.pincode.errors.required\">ZipCode is required</div>\r\n                                <div *ngIf=\"f.pincode.errors.minlength || f.pincode.errors.maxlength\">ZipCode number should be 6 digits</div>\r\n                              </div>\r\n                          </div>\r\n                          \r\n                          <div class=\"col-md-8 col-sm-8\">\r\n                            <label class=\"text-white\">Address</label> \r\n                            <textarea name=\"address\" id=\"address\" cols=\"5\" rows=\"1\" class=\"form-control\" placeholder=\"\" [ngClass]=\"{ 'is-invalid': submitted && f.address.errors }\" formControlName=\"address\"></textarea>\r\n                            <div *ngIf=\"submitted && f.address.errors\" class=\"invalid-feedback\">\r\n                                <div *ngIf=\"f.address.errors.required\">Address is required</div>\r\n                            </div>\r\n                          </div>                        \r\n                      </div>\r\n                      \r\n                      <div class=\"row form-group mb-5\">\r\n                          <div class=\"custom-control custom-checkbox\">\r\n                              <input type=\"checkbox\" class=\"custom-control-input\" formControlName=\"iagree\" [ngClass]=\"{ 'is-invalid': submitted && f.iagree.errors }\" id=\"customCheck\">\r\n                              <label class=\"custom-control-label\" for=\"customCheck\"> Make me an Approved Client* with the ability to license and download images online without a credit card.</label>\r\n                              <div *ngIf=\"submitted && f.iagree.errors\" class=\"invalid-feedback\">\r\n                                  <div *ngIf=\"f.iagree.errors.required\">Please accept Terms & Conditions</div>\r\n                              </div>   \r\n                          </div>\r\n                      </div>\r\n                    \r\n                      <div class=\"row form-group text-center\">\r\n                        <div class=\"col-md-12\">\r\n                          <button [disabled]=\"loading\" type=\"submit\" class=\"btn btn-warning btn-md text-white\">Create Account</button>\r\n                        </div>\r\n                      </div>\r\n  \r\n          \r\n                    </form>\r\n                 \r\n          \r\n          </div>\r\n  \r\n        </div>\r\n  \r\n        \r\n      </div>\r\n    </main>\r\n  \r\n  </div>\r\n\r\n  <ng-container *ngIf=\"showloginPopup\">\r\n      <app-login [openLoginPopup]=\"showloginPopup\" (closeLoginPopup)=\"hideLoginPopup($event)\"></app-login>\r\n  </ng-container>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/terms-and-conditions/terms-and-conditions.component.html":
  /*!****************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/terms-and-conditions/terms-and-conditions.component.html ***!
    \****************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppTermsAndConditionsTermsAndConditionsComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<section class=\"banner-area relative\">\r\n        <div class=\"overlay overlay-bg\"></div>\r\n        <div class=\"banner-content text-center\">\r\n          <h1>TERMS AND CONDITIONS</h1>\r\n          <!--<p>We are a privately owned group offering a variety of services that include,\r\n            <br />\r\n             stock imagery,stock footage, photography\r\n          </p>-->\r\n        </div>\r\n      </section>\r\n    \r\n    <section class=\"pt-5 bg-white text-black f-3 l-space\">\r\n    \r\n      <div class=\"container\">\r\n  \r\n    <div class=\"static-wrapper\">\r\n  <div class=\"section-title text-left pb-2\">\r\n  <span style=\"float:right;\">Effective Date____________ 2018</span>\r\n  <h3 class=\"pt-3 pb-2  f-18\">I. Introduction</h3>\r\n  <!--<p>Last Updated: November 2016</p>-->\r\n  </div>\r\n  <p>A.\tYou (“User” or “you”) agree to abide by and be bound by the Terms described herein and by all the Terms, policies, and guidelines incorporated by reference as well as any additional Terms and restrictions presented in relation to specific content or a specific product, service or feature (“Terms”) and the linked Privacy Policy, before you use the applications, websites or any content, product, service, or feature available through the website including the embedded viewerand all of the content featured or displayed on the Site, including, but not limited to, text, graphics, data, photographic images, moving images, sound, illustrations, software and the selection and arrangement thereof (“Content”)made available to you by << insert name of website >> (hereinafter referred to as “Site” or “we” or “our” or “us”). </p>\r\n<p><strong>PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY. BY ACCESSING OR USING THE WEBSITE YOU AGREE TO ABIDE BY AND BE BOUND BY THE TERMS DESCRIBED HEREIN. IF YOU DO NOT AGREE TO ANY OR ALL OF THESE TERMS, DO NOT USE THE SITE.</strong></p>  \r\n <p>B.\tUnless otherwise indicated, all Content on the Website is owned by us, our licensors or our third-party image partners. All elements of the Site, including the Content, are protected by copyright, trade dress, moral rights, trademark and other laws relating to the protection of intellectual property.</p>\r\n <p>C.\tWe provide the Content to the User subject to the Terms. </p>\r\n <p>D.\tAll information accessed or viewed by the User is considered confidential and is for only the authorized personal or business purposes.</p>\r\n <p>E.\tThese Terms are effective upon acceptance and governs the relationship between the User and ____________________ (“Company”) and includes its affiliates and subsidiaries, jointly and severally) and also the use of the website including wireless Content or systems (“Website” or “Site”). If the Terms conflict with any other document, the Terms will prevail for the purposes of usage of the Site. </p>\r\n <p>II.\tAcceptance of Terms</p>\r\n <p>A.\tThe Website is the property of the Company and /or its subsidiaries.By browsing, linking, referencing, using or accessing the Website, the User agrees to these Terms, including agreeing to indemnify and hold harmless the Company from all claims of any nature arising from the access and use of these application/websites by the User. These Terms may be changed at any time at the sole discretion of the Company. These Terms pertain to all Websites of the Company, including websites owned, operated or sponsored by any of the subsidiaries or affiliates of the Company.</p>\r\n <p>B.\tPlease read these Terms carefully. These Terms, as modified or amended from time to time, are a binding contract between the Company and the User. If the User visits, uses, or operates at the Site (or any future site operated by the Company), the User accepts these Terms. In addition, when the User uses any current or future Content of the Company or visits or uses any of the Content affiliated with the Company, the User will also be subject to the guidelines and conditions applicable to such Service.   </p>\r\n <p>C. The Site takes no responsibility for the Content that are provided by any third-party vendors. </p>\r\n <p>D.\tThis document is published in accordance with the provisions of Rule 3 (1) of the Information Technology (Intermediaries guidelines) Rules, 2011 that require publishing the rules and regulations, privacy policy and Terms of Use for access or usage of the Website.</p>\r\n <p>E.\tThe information provided on this Website includes, but is not limited to, the services provided by the Company and does not render any advice, certifications, guarantees or warranties on the Content (as defined below) relating to the services, which the Company makes available on this Website.</p>\r\n <p>F.\tThe Company reserves the right to make any changes to the Terms and/or our Privacy Policy as may be deemed necessary or desirable without prior notification to the User. If the Company makes changes to the Terms and Privacy Policy and the User continues to use the Site, the User is impliedly agreeing to the revised Terms and Privacy Policy expressed herein. <br />\r\nTo read the complete Terms, please see below. \r\n</p>\r\n<p>1.\tRIGHTS/RESTRICTIONS RELATING TO SITE CONTENT</p>\r\n<p>1.1.\tLimitations on Linking and Framing. You are free to establish a hypertext link to our Site so long as the link does not state or imply any sponsorship of your website or service by us or by our Site. However, you shall not, without our prior written permission, frame or inline link any of the content of our Site, or incorporate into another website or other service any of our material, content or intellectual property.</p>\r\n<p>1.2.\tOur Right to Use Materials You Submit or Post. When you submit or post any material via the Site, you grant us, and anyone authorized by us, a royalty-free, perpetual, irrevocable, non-exclusive, unrestricted, worldwide license to use, copy, modify, transmit, sell, exploit, create derivative works from, distribute, and/or publicly perform or display such material, in whole or in part, in any manner or medium (whether now known or hereafter developed), for any purpose that we choose. The foregoing grant includes the right to exploit any proprietary rights in such posting or submission, including, but not limited to, rights under copyright, trademark or patent laws that exist in any relevant jurisdiction. Also, in connection with the exercise of these rights, you grant us, and anyone authorized by us, the right to identify you as the author of any of your postings or submissions by name, email address or screen name, as we deem appropriate. You understand that the technical processing and transmission of the Site, including content submitted by you, may involve transmissions over various networks, and may involve changes to the content to conform and adapt it to technical requirements of connecting networks or devices. You will not receive any compensation of any kind for the use of any materials submitted by you.</p>\r\n<p>1.3.\tYour Limited Right to Use Site Materials. Unless otherwise indicated, all of the Content featured or displayed on the Site, including, but not limited to, text, graphics, data, photographic images, moving images, sound, illustrations, software and the selection and arrangement thereof is owned by the Company, its licensors or its third-party image partners. The Site is provided solely for your browsing and only for the use it was licensed to you by the Company. You are specifically prohibited from: (a) downloading, copying or re-transmitting any or stealing all of the Site or the Content without, or in violation of, a written licence, permission or agreement with Company; (b) using any data mining, robots or similar data gathering or extraction methods; (c) manipulating or otherwise displaying the Site or the Content by using framing or similar navigational technology; (d) registering, subscribing, unsubscribing or attempting to register, subscribe or unsubscribe any party for any product or service if you are not expressly authorised by such party to do so; (e) circumventing, disabling or otherwise interfering with security-related features of the Site or any system resources, services or networks connected to or accessible through the Site; (f) selling, licensing, leasing or in any way commercialising the Site or the Content without specific written authorisation from the Company; and (g) using the Site or the Content other than for its intended purpose. Such unauthorised use may also violate applicable laws including without limitation copyright and trademark laws, the laws of privacy and publicity, and applicable communications regulations and statutes. </p>\r\n<p>1.4.\tWhere enabled, you may embed the Content on a website, blog or social media platform using the embedded viewer (the “Embedded Viewer”). Not all of the Content will be available for embedded use, and availability may change without notice. The Company reserves the right in its sole discretion to remove its Content from the Embedded Viewer. Upon request, you agree to take prompt action to stop using the Embedded Viewer and/or the Content. You may only use embedded Content for editorial purposes (meaning relating to events that are newsworthy or of public interest). Embedded Content may not be used: </p>\r\n<p>(a) for any commercial purpose (for example, in advertising, promotions or merchandising) or to suggest endorsement or sponsorship; (b) in violation of any stated restriction; (c) in a defamatory, pornographic or otherwise unlawful manner; or (d) outside of the context of the Embedded Viewer. The Company (or third parties acting on its behalf) may collect data related to use of the Embedded Viewer and embedded Content, and reserves the right to place advertisements in the Embedded Viewer or otherwise monetise its use without any compensation to you.</p>\r\n<p>2.\tACCESS TO CERTAIN FEATURES OF OUR SITE</p>\r\n<p>To access certain features of our Site, we may ask you to provide certain demographic information including your gender, year of birth, pin code, state and country. In addition, if you elect to sign-up for a particular feature of the Site, such as programmes, discussion forums, blogs, photo- and video-sharing pages or social networking features, you may also be asked to register with us on the form provided and such registration may require you to provide information such as your name and email address. You agree to provide true, accurate, current and complete information about yourself as prompted by the Site's registration form. If we have reasonable grounds to suspect that such information is untrue, inaccurate, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Site (or any portion thereof). Our use of any information you provide to us as part of the registration process is governed by the terms of our Privacy Policy.</p>\r\n<p>3.\tRESPONSIBILITY FOR USER-PROVIDED CONTENT</p>\r\n<p>3.1.\tThis Site may include a variety of features, such as discussion forums, blogs, photo and video-sharing pages, email services and social networking features that allow feedback to us and allow users to interact with each other on the Site and post content and materials for display on the Site. This Site may also include other features, such as personalized home pages and email services, that allow users to communicate with third parties. By accessing and using any such features, you represent and agree: (i) that you have read and agree to abide by our Rules; (ii) that you are the owner of any material you post or submit, or are making your posting or submission with the express consent of the owner of the material; (iii) that you are making your posting or submission with the express consent of anyone pictured in any material you post or submit, (iv) that you are 18 years of age or older; (v) that the materials will not violate the rights of, or cause injury to, any person or entity; and (vi) that you will indemnify and hold harmless us, our affiliates, and each of our and their respective directors, officers, managers, employees, shareholders, agents, representatives and licensors, from and against any liability of any nature arising out of related to any content or materials displayed on or submitted via the Site by you or by others using your username and password. </p>\r\n<p>3.2.\tYou acknowledge and agree that we may preserve content and materials submitted by you, and may also disclose such content and materials if required to do so by law or if, in our business judgment, such preservation or disclosure is reasonably necessary to: (a) comply with legal process; (b) enforce these Terms; (c) respond to claims that any content or materials submitted by you violate the rights of third parties; or (d) protect the rights, property, or personal safety of our Site, us, our affiliates, our officers, directors, employees, representatives, our licensors, other users, and/or the public.\r\n\r\n</p>\r\n<p>3.3.\tResponsibility for what is posted on discussion forums, blogs, photo- and video-sharing pages, and other areas on the Site through which users can supply information or material, or sent via any email services that are made available via the Site, lies with each user – you alone are responsible for the material you post or send. We are not responsible for the speech, content, messages, information or files that you or others may transmit, post or otherwise provide on or through the Site.\r\n\r\n</p>\r\n<p>3.4.\tYou understand that we have no obligation to monitor any discussion forums, blogs, photo- or video-sharing pages, or other areas of the Site through which users can supply information or material. However, we reserve the right at all times, in our sole discretion, to screen content submitted by users and to edit, move, delete, and/or refuse to accept any content that in our judgment violates these Terms or is otherwise unacceptable or inappropriate, whether for legal or any other reasons.</p>\r\n<p>4.\tMODIFIED TERMS</p>\r\n<p>The Company reserves the right at all times to discontinue or modify any of its Terms and/or the Privacy Policy as may be deemed necessary or desirable without prior notification to the User. Further, if the Company makes any changes to the Terms and Privacy Policy and the User continues to use the Site, the User is impliedly agreeing to the Terms and Privacy Policy expressed therein. Any such changes, deletions or modifications shall be effective immediately upon the Company’s posting thereof. Any use of the Site by the User after such notice shall be deemed to constitute acceptance by the User of such modifications. </p>\r\n<p>5. DISCLAIMERS AND WARRANTIES</p>\r\n<p>5.1.\tOn our Site, we may provide links and pointers to Internet sites maintained by third parties. Our linking to such third-party sites does not imply an endorsement or sponsorship of such sites, or the information, products or services offered on or through the sites. In addition, neither we nor our parent or subsidiary companies nor any of our respective affiliates operate or control in any respect any information, products or services that third parties may provide on or through the Site or on websites linked to by us on the Site.</p>\r\n<p>5.2.\tTHE INFORMATION, PRODUCTS AND SERVICES OFFERED ON OR THROUGH THE WEBSITE AND ANY THIRD-PARTY SITES ARE PROVIDED \"AS IS\" AND WITHOUT WARRANTIES OF ANY KIND EITHER EXPRESS OR IMPLIED. TO THE FULLEST EXTENT PERMISSIBLE PURSUANT TO APPLICABLE LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. WE DO NOT WARRANT THAT THE SITE OR ANY OF ITS FUNCTIONS WILL BE UNINTERRUPTED OR ERROR-FREE, THAT DEFECTS WILL BE CORRECTED, OR THAT ANY PART OF THIS SITE, INCLUDING BULLETIN BOARDS, OR THE SERVERS THAT MAKE IT AVAILABLE, ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. YOU ACKNOWLEDGE THAT ACCESS TO DATA STORED BY YOU OR OTHERS ON THE WEBSITE IS NOT GUARANTEED AND THAT WE SHALL NOT BE RESPONSIBLE TO YOU FOR ANY LOSS OF DATA CAUSED BY YOUR USAGE OR ACCESS TO THE WEBSITEOR ITS UNAVAILABILITY.</p>\r\n<p>5.3.\tWE DO NOT WARRANT OR MAKE ANY REPRESENTATIONS REGARDING THE USE OR THE RESULTS OF THE USE OF THE SITE OR MATERIALS ON THIS SITE OR ON THIRD-PARTY SITES IN TERMS OF THEIR CORRECTNESS, ACCURACY, TIMELINESS, RELIABILITY OR OTHERWISE. </p>\r\n<p>5.4.\tYOU ACKNOWLEDGE THAT THE PROVISIONS OF THIS SECTION ARE A MATERIAL INDUCEMENT AND CONSIDERATION TO US IS ONLY LIMITED TO GRANT THE LICENSE CONTAINED IN THESETERMS AND TO PROVIDE YOU WITH ACCESS TO THE SITE AND THE MATERIALS ON THIS SITE. </p>\r\n<p>5.5.\tYou must provide and are solely responsible for all hardware and/or software necessary to access the Site. You assume the entire cost of and responsibility for any damage to, and all necessary maintenance, repair or correction of, that hardware and/or software.</p>\r\n<p>5.6.\tYou acknowledge that by using the Site, you may incur charges from your wireless carrier, internet service provider or other method of internet or data access, and that payment of any such charges will be your sole responsibility. You agree that your use of the Site will be in accordance with all requirements of your wireless carrier, internet service provider and other method of internet or data access. We do not control network access. Your use of these networks may not be secure and may expose your personal information sent over such networks.</p>\r\n<p>5.7.\tThe Site is provided for informational purposes only and is not intended for trading or investing purposes. The Site should not be used in any high risk activities where damage or injury to persons, property, environment, finances or business may result if an error occurs. You expressly assume all risk for any such use.</p>\r\n<p>5.8.\tYour interactions with companies, organizations and/or individuals found on or through our Site, including any purchases, transactions, or other dealings, and any terms, conditions, warranties or representations associated with such dealings, are solely between you and such companies, organizations and/or individuals and third parties. You agree that we will not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings. You also agree that, if there is a dispute between users of this Site, or between a user and any third party, we are under no obligation to become involved, and you agree to release us and/or our affiliates from any claims, demands and damages of every kind or nature, known or unknown, suspected and unsuspected, disclosed and undisclosed, arising out of or in any way related to such dispute and/or our Site.</p>\r\n<p>6. LIMITATION OF LIABILITY</p>\r\n<p>UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, WILL WE OR OUR SUBSIDIARIES, PARENT COMPANIES OR AFFILIATES BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, THIS SITE, INCLUDING ITS MATERIALS, PRODUCTS, OR SERVICES, OR THIRD-PARTY MATERIALS, PRODUCTS, OR SERVICES MADE AVAILABLE THROUGH THIS SITE, EVEN IF WE ARE ADVISED BEFOREHAND OF THE POSSIBILITY OF SUCH DAMAGES. YOU SPECIFICALLY ACKNOWLEDGE AND AGREE THAT WE ARE NOT LIABLE FOR ANY DEFAMATORY, OFFENSIVE OR ILLEGAL CONDUCT OF ANY USER. IF YOU ARE DISSATISFIED WITH THE SITE, OR ANY MATERIALS, PRODUCTS, OR SERVICES ON THE SITE, OR WITH ANY OF THE SITE'S TERMS AND CONDITIONS, YOUR SOLE AND EXCLUSIVE REMEDY IS TO DISCONTINUE USING THE SITE.</p>\r\n<p>7.\tINDEMNIFICATION</p>\r\n<p>You agree to indemnify and hold harmless us, our affiliates, and each of our and their respective directors, officers, managers, employees, shareholders, agents, representatives and licensors, from and against any and all losses, expenses, damages and costs, including reasonable attorneys' fees, that arise out of your use of the Site, violation of these Terms by you or any other person using your account, or your violation of any rights of another. We reserve the right to take over the exclusive defense of any claim for which we are entitled to indemnification under this section. In such event, you agree to provide us with such cooperation as is reasonably requested by us.</p>\r\n<p>8. \tRESTRICTIONS</p>\r\n<p>The User shall not be permitted or allowed to perform the following activities:</p>\r\n<p>(i)\tremove any copyright, trademark or other proprietary notices from any portion of the Content; </p>\r\n<p>(ii)\treproduce, modify, prepare derivative works based upon, distribute, license, lease, sell, resell, transfer, publicly display, publicly perform, transmit, stream, broadcast or otherwise exploit the Content except as expressly permitted by the Company; </p>\r\n<p>(iii)\tdecompile, reverse engineer or disassemble the Content except as may be permitted by applicable law; </p>\r\n<p>(iv)\tlink to, mirror or frame any portion of the Content; </p>\r\n<p>(v)\tcause or launch any programs or scripts for the purpose of scraping, indexing, surveying, or otherwise data mining any portion of the Content or unduly burdening or hindering the operation and/or functionality of any aspect of the Content; or </p>\r\n<p>(vi)\tattempt to gain unauthorized access to or impair any aspect of the Content or its related systems or networks.</p>\r\n<p>9.\tINTELLECTUAL PROPERTY RIGHTS</p>\r\n<p>9.1. The Company is the sole owner or lawful licensee of all the rights to the Website and its content. Website content shall include but not be limited to, its design, layout, text, images, graphics, sound, video etc. The website content embodies trade secrets and intellectual property rights protected under worldwide copyright and other laws. All title, ownership and intellectual property rights in the Website and its content shall remain with the Company, its affiliates or licensors of the Company's content, as the case may be.</p>\r\n<p>9.2.\tAll rights, not otherwise claimed under these Terms are hereby reserved. The information contained in this Site is intended, solely to provide general information for the personal use of the User, who accepts full responsibility for its use. The Company does not represent or endorse the accuracy or reliability of any information, or advertisements or Content contained on, distributed through, or linked, downloaded or accessed from any of the Content contained on this Website, or the quality of any products, information or other materials displayed, or obtained by you as a result of an advertisement or any other information or offer in or in connection with the Content.</p>\r\n<p>9.3.\tThe User shall not upload post or otherwise make available on the Site any material protected by copyright, trademark, patent, proprietary rights or any other intellectual property rights, without the express permission of the owner of the copyright, trademark, proprietary right or other intellectual property rights. </p>\r\n<p>9.4.\tThe Company does not have any express burden or responsibility to provide the User with indications, markings or anything else that may aid the User in determining whether the material in question is copyrighted or trademarked. </p>\r\n<p>9.5.\tThe User shall be solely liable for any damage resulting from any infringement of copyrights, trademarks, proprietary rights or any other harm resulting from such a submission.</p>\r\n<p>9.6.\tBy submitting material to any public area of the Site, the User warrants that the owner of such material has expressly granted the Company the royalty-free, perpetual, irrevocable, non-exclusive right and license to use, reproduce, modify, adapt, publish, translate and distribute such material (in whole or in part) worldwide and/or to incorporate it in other works in any form, media or technology now known or hereafter developed for the full term of any copyright that may exist in such material. </p>\r\n<p>9.7.\tThe User hereby grants the Company, the right to edit, copy, publish and distribute any material made available on the Site by the User. </p>\r\n<p>10.\tTRADEMARK</p>\r\n<p>10.1.\tAll related icons and logos are registered trademarks or trademarks or service marks of the Company in various jurisdictions and are protected under applicable copyright, Trademark and other proprietary rights laws. The unauthorized copying, modification, use or publication of these marks is strictly prohibited.</p>\r\n<p>10.2.\tThe trademarks, logos and service marks (\"Marks\") displayed on the Site are the property of the Company and other respective persons. The User is prohibited from using any Marks for any purpose including, but not limited to use as metatags on other pages or sites on the World Wide Web without the written permission of the Company or such third party which may own the Marks. </p>\r\n<p>10.3.\tTrademarks that are located within or on the Site or a website otherwise owned or operated in conjunction with the Company shall not be deemed to be in the public domain but rather the exclusive property of the Company, unless such site is under license from the trademark owner thereof, in which case such license is for the exclusive benefit and use of the Company, unless otherwise stated.</p>\r\n<p>10. \tMISCELLANEOUS</p>\r\n<p>10.1.\tCompliance: Failure to comply with these Terms and to any updated version will result in Legal actions taken for violations of applicable regulations like the information security laws and copyright regulations (including but not limited to Information Technology Act, 2000 and Information Technology (Reasonable security practices and procedures and sensitive personal data or information) Rules, 2011 and the Copy Right Act, 1957) and other applicable laws and regulations.</p>\r\n<p>10.2.\tIf any of these conditions are deemed invalid, void, or for any reason unenforceable, the parties agree that the court should endeavour to give effect to the parties’ intentions as reflected in the provision, and the unenforceable condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition. </p>\r\n<p>10.3.\tThe Terms and the relationship between the User and the Company will be governed by the laws as applicable in India. </p>\r\n<p>10.4.\tAny disputes will be handled in the competent courts of Hyderabad, Telangana, India. </p>\r\n<p>10.5.\tThe failure of the Company to act with respect to a breach by the User or others does not waive its right to act with respect to subsequent or similar breaches. </p>\r\n<p>10.6.\tExcept as otherwise, expressly provided in these Terms, there shall be no third-party beneficiaries to the same. These Terms constitute the entire agreement between the User and the Company and governs the User’s use of the Site, superseding any prior agreements between the User and the Company with respect to the Site. </p>\r\n   \r\n  </div>\r\n      </div>\r\n    </section>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/user-profile/user-profile.component.html":
  /*!************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/user-profile/user-profile.component.html ***!
    \************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppUserProfileUserProfileComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\r\n    <div class=\"loader\">\r\n        Loading\r\n        <span></span>\r\n    </div>\r\n</div>\r\n<section>\r\n<div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-3 col-sm-3 col-md-3\">\r\n                <div class=\"card shadow p-3\">\r\n                    <p class=\"f-18\"><b>My Account</b></p>\r\n                    <div class=\"account-list nav nav-pills faq-nav border-0 z-depth-0\" id=\"faq-tabs\" role=\"tablist\" aria-orientation=\"vertical\">\r\n                        <li class=\"nav-item active\"><i class=\"flaticon-user-1 f-24\"></i><a  [ngClass]=\"[profileTab ? 'active' : '']\"   (click)=\"tabshow('profile')\" data-toggle=\"pill\" role=\"tab\" aria-controls=\"tab1\" aria-selected=\"true\">\r\n                            <i class=\"mdi mdi-help-circle\"></i> Profile\r\n                        </a></li>\r\n<!--                        <li class=\"nav-item\"><i class=\"flaticon-review f-24\"></i>  <a  [ngClass]=\"[plansTab ? 'active' : '']\"   (click)=\"tabshow('plans')\"  data-toggle=\"pill\" role=\"tab\" aria-controls=\"tab2\" aria-selected=\"false\">-->\r\n<!--                            <i class=\"mdi mdi-account\"></i>  Plans-->\r\n<!--                        </a></li>-->\r\n\r\n<!--                        <li class=\"nav-item\"><i class=\"flaticon-wallet-1 f-24\"></i> <a  [ngClass]=\"[billingTab ? 'active' : '']\"   (click)=\"tabshow('billing')\" data-toggle=\"pill\" role=\"tab\" aria-controls=\"tab3\" aria-selected=\"false\">-->\r\n<!--                            <i class=\"mdi mdi-account-settings\"></i> Billing-->\r\n<!--                        </a> </li>-->\r\n                        <li class=\"nav-item\"><i class=\"flaticon-checklist f-24\"></i> <a  [ngClass]=\"[purchaseTab ? 'active' : '']\"   (click)=\"tabshow('purchase')\" data-toggle=\"pill\" role=\"tab\" aria-controls=\"tab3\" aria-selected=\"false\">\r\n                            <i class=\"mdi mdi-account-settings\"></i> Purchase History\r\n                        </a></li>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-9 col-md-9 col-sm-9\">\r\n                <div class=\"tab-content faq_tab-content\" id=\"faq-tab-content\">\r\n                    <div  [ngClass]=\"[profileTab ? 'tab-pane show active' : '']\" *ngIf=\"profileTab && profileData\" id=\"profile\" role=\"tabpanel\" aria-labelledby=\"tab1\">\r\n\r\n                        <div class=\"card shadow\">\r\n                            <div class=\"pt-3 pb-3 pl-5 pr-5\">\r\n                                <p class=\"f-18\"><b>User details</b> <a href=\"#\" class=\"text-primary f-20 pl-3\"><i class=\"flaticon-edit\"></i></a></p>\r\n                                <div class=\"p-3\">\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">Name </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n                                            <p class=\"text-black fw-6\">{{profileData.first_name}} {{profileData.last_name}}</p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">User ID </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.user_name}}</p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                        <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">E-mail  </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.email}}</p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">Phone No  </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.mobile}}</p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">Address </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.address}}</p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">City </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.city.name}}</p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">City </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.state.state}}</p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">Country </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.country.name}} {{profileData.postal_code}}  </p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-3 col-sm-3 col-xl-3\">\r\n                                            <p class=\"text-muted\">Postal Code </p>\r\n                                        </div>\r\n                                        <div class=\"col-md-9 col-sm-9 col-xl-9\">\r\n\r\n                                            <p class=\"text-black fw-6\">{{profileData.postal_code}}  </p>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"card shadow mt-2\">\r\n                            <div class=\"pt-3 pb-3 pl-0 pr-0\">\r\n                                <p class=\"f-18 pl-5 pr-5\"><b>Preferences</b></p>\r\n                                <hr>\r\n                                <div class=\"pl-5 pr-5\">\r\n\r\n                                    <p class=\"text-black fw-6\"><b>Email Preferences</b></p>\r\n                                    <p>What types of communication would you like to receive from Image Footage?</p>\r\n                                    <hr>\r\n                                    <div class=\"custom-control custom-checkbox fw-6\">\r\n                                        <input type=\"checkbox\" class=\"custom-control-input\" id=\"customCheck\">\r\n                                        <label class=\"custom-control-label\" for=\"customCheck\">Design inspiration, tutorials, and professionally curated content.</label>\r\n                                    </div>\r\n                                    <div class=\"custom-control custom-checkbox fw-6 pt-3\">\r\n                                        <input type=\"checkbox\" class=\"custom-control-input\" id=\"customCheck1\">\r\n                                        <label class=\"custom-control-label\" for=\"customCheck1\">Special offers and amazing deals.\r\n                                        </label>\r\n                                    </div>\r\n\r\n                                    <div class=\"custom-control custom-checkbox fw-6 pt-3\">\r\n                                        <input type=\"checkbox\" class=\"custom-control-input\" id=\"customCheck2\">\r\n                                        <label class=\"custom-control-label\" for=\"customCheck2\">Product education and updates.</label>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n\r\n                        <div class=\"card shadow mt-2\">\r\n                            <div class=\"pt-3 pb-3 pl-0 pr-0\">\r\n                                <div class=\"pl-5 pr-5\">\r\n                                    <p class=\"text-black fw-6\"><b>Language Preference</b></p>\r\n                                    <p>Select your language. This language will be used for e-mails you receive from us and browsing our site\r\n                                    </p>\r\n\r\n                                    <div class=\"col-md-6 col-lg-6 col-sm-6\">\r\n                                        <label>Select Language</label>\r\n                                        <select class=\"form-control\">\r\n                                            <option value=\"\">English</option>\r\n                                            <option value=\"\">Hindi</option>\r\n                                            <option value=\"\">USA</option>\r\n                                            <option value=\"\">Aus</option>\r\n                                        </select>\r\n                                    </div>\r\n\r\n\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n\r\n                        <div class=\"card shadow mt-2\">\r\n                            <div class=\"pt-3 pb-3 pl-0 pr-0\">\r\n                                <div class=\"pl-5 pr-5\">\r\n                                    <p class=\"text-black fw-6\"><b>Display Preferences</b></p>\r\n                                    <p>Select the units for image size measurements</p>\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-lg-4 col-sm-4 col-md-4\">\r\n                                            <div class=\"custom-control custom-radio\">\r\n                                                <input type=\"radio\" class=\"custom-control-input\" id=\"customRadio\" name=\"example1\" value=\"customEx\" checked=\"\">\r\n                                                <label class=\"custom-control-label\" for=\"customRadio\"><strong>Centimeters</strong></label>\r\n                                            </div>\r\n                                        </div>\r\n                                        <div class=\"col-lg-4 col-sm-4 col-md-4\">\r\n                                            <div class=\"custom-control custom-radio\">\r\n                                                <input type=\"radio\" class=\"custom-control-input\" id=\"customRadio1\" name=\"example1\" value=\"customEx\">\r\n                                                <label class=\"custom-control-label\" for=\"customRadio1\"><strong>Inches</strong></label>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n\r\n\r\n                        </div>\r\n\r\n\r\n                        <div class=\"card shadow mt-2\">\r\n                            <div class=\"pt-3 pb-3 pl-0 pr-0\">\r\n                                <div class=\"pl-5 pr-5\">\r\n                                    <p class=\"text-black fw-6\"><b>Delete account</b></p>\r\n                                    <p>This will remove all of your personal data forever.</p>\r\n                                    <a href=\"#\" class=\"btn btn-danger\">Delete my account</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div  [ngClass]=\"[plansTab ? 'tab-pane show active' : '']\" id=\"plans\" *ngIf=\"plansTab\" role=\"tabpanel\" aria-labelledby=\"tab2\">\r\n                        <div class=\"card shadow mt-2\">\r\n                            <div class=\"pt-3 pb-3 pl-0 pr-0\">\r\n                                <p class=\"f-18 pl-5 pr-5\"><b>My Plans</b></p>\r\n                                <hr>\r\n                                <div class=\"pl-5 pr-5\">\r\n                                    <div class=\"row\">\r\n                                        <div class=\"col-md-5 col-sm-5 col-lg-5\">\r\n                                            <span class=\"text-black fw-6 pull-left\"><b>On Demand</b></span>\r\n                                            <span class=\"text-black fw-6 pull-right f-12\"><a href=\"#\"> Add Credits</a></span>\r\n                                            <div class=\"clearfix\"></div>\r\n                                            <hr>\r\n                                            <table class=\"table border-0\">\r\n                                                <tbody>\r\n                                                <tr>\r\n                                                    <td><span class=\"text-muted\"> Credits Remaining :</span> </td>\r\n                                                    <td><span class=\"text-black\"><b> 0</b></span></td>\r\n                                                </tr>\r\n\r\n                                                <tr>\r\n                                                    <td><span class=\"text-muted\"> Last Purchased On : </span> </td>\r\n                                                    <td><span class=\"text-black\"> </span></td>\r\n                                                </tr>\r\n                                                </tbody>\r\n                                            </table>\r\n                                        </div>\r\n\r\n                                        <div class=\"col-md-5 col-sm-5 col-lg-5 offset-md-1 offset-sm-1 offset-lg-1\">\r\n             <span class=\"text-black fw-6 pull-left\"><b>Subscription Plan\r\n</b></span>\r\n                                            <span class=\"text-black fw-6 pull-right f-12\"><a href=\"#\">Purchase Plans</a></span>\r\n                                            <div class=\"clearfix\"></div>\r\n                                            <hr>\r\n                                            <table class=\"table border-0\">\r\n                                                <tbody>\r\n                                                <tr>\r\n                                                    <td><span class=\"text-muted\"> You do not have any active subscription plan.</span> </td>\r\n\r\n                                                </tr>\r\n\r\n\r\n                                                </tbody>\r\n                                            </table>\r\n                                        </div>\r\n\r\n\r\n                                    </div>\r\n\r\n\r\n\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n\r\n\r\n                    </div>\r\n                    <div  [ngClass]=\"[billingTab ? 'tab-pane show active' : '']\" id=\"billing\" *ngIf=\"billingTab\" role=\"tabpanel\" aria-labelledby=\"tab3\">\r\n                        <div class=\"card shadow mt-2\">\r\n                            <div class=\"pt-3 pb-3 pl-0 pr-0\">\r\n                                <div class=\"pl-5 pr-5\">\r\n\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div  [ngClass]=\"[purchaseTab ? 'tab-pane show active' : '']\" id=\"purchase\" *ngIf=\"purchaseTab\" role=\"tabpanel\" aria-labelledby=\"tab3\">\r\n                        <div class=\"card shadow mt-2\">\r\n                            <div class=\"pt-3 pb-3 pl-0 pr-0\">\r\n                                <div class=\"pl-5 pr-5\">\r\n                                    <p class=\"text-black fw-6\"><b>Your Orders</b></p>\r\n                                    <table class=\"table table-hover cart-table\">\r\n                                        <tr>\r\n                                            <th>Sn.</th>\r\n                                            <th>Transaction ID</th>\r\n                                            <th>Total</th>\r\n                                            <th>Order Date</th>\r\n                                            <th>Payment Gatway</th>\r\n                                           <th>Details</th>\r\n                                        </tr>\r\n                                        <tr *ngFor=\"let order of orderData;let i= index\">\r\n                                            <td>{{i+1}}</td>\r\n                                            <td>{{order.txn_id}}</td>\r\n                                            <td>{{order.order_total}}</td>\r\n                                            <td>{{order.order_date}}</td>\r\n                                            <td>{{order.paymentgatway}}</td>\r\n                                            <td (click)=\"orderDetails(i)\">Details</td>\r\n                                        </tr>\r\n                                    </table>\r\n                                    <p class=\"text-black fw-6\" *ngIf=\"order_items\"><b>Order Details</b></p>\r\n                                    <table *ngIf=\"order_items\" class=\"table cart-table\">\r\n                                        <tr>\r\n                                            <th>Sn.</th>\r\n                                            <th>Image</th>\r\n                                            <th>Name</th>\r\n                                            <th>Size</th>\r\n                                            <th>Price</th>\r\n                                            <th>Download</th>\r\n                                        </tr>\r\n                                        <tr  *ngFor=\"let orderitem of order_items;let j= index\">\r\n                                            <td>{{j+1}}</td>\r\n                                            <td> <div class=\"product-info\">\r\n                                                <a href=\"javascript:void(0)\" *ngIf=\"orderitem.product_web=='2'\" >\r\n                                                    <img src=\"{{orderitem.product_thumb}}\" alt=\"product-img\" />\r\n                                                </a>\r\n                                                <a href=\"javascript:void(0)\" *ngIf=\"orderitem.product_web=='3'\" >\r\n                                                    <video  width=\"200\" height=\"150\" poster=\"{{orderitem.product_thumb}}\" controls onmouseover=\"this.play()\" onmouseout=\"this.pause()\">\r\n                                                        <source src=\"{{orderitem.product_thumb}}\" type=\"video/mp4\">\r\n                                                        Your browser does not support the video tag.\r\n                                                    </video>\r\n                                                </a>\r\n\r\n                                            </div></td>\r\n                                            <td>{{orderitem.product_name}}</td>\r\n                                            <td>{{orderitem.standard_size}}</td>\r\n                                            <td>{{orderitem.total}}</td>\r\n                                            <td>Download</td>\r\n                                        </tr>\r\n                                    </table>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/wishlist/wishlist.component.html":
  /*!****************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/wishlist/wishlist.component.html ***!
    \****************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppWishlistWishlistComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"loader-bg\" *ngIf=\"loadingData\">\n    <div class=\"loader\">\n        Loading\n        <span></span>\n    </div>\n</div>\n<section>\n <div class=\"container\">\n          <div class=\"card pb-3 shadow-sm\" *ngIf=\"wishListDataItems.length>0\">\n            <form method=\"#\">\n              <div class=\"table-responsive\">\n                <table class=\"table cart-table\">\n                  <tbody>\n                  <tr *ngFor=\"let wishList of wishListDataItems;let i= index\">\n                      <td width=\"3%\"> <div class=\"custom-control custom-checkbox\">\n<!--                          <input type=\"checkbox\" class=\"custom-control-input\" id=$index name=\"'example'+i\">-->\n<!--                          <label class=\"custom-control-label\" for=$index></label>-->\n                      </div>\n                      </td>\n                      <td width=\"25%\" align=\"center\">\n                          <div class=\"product-info\">\n                              <a href=\"javascript:void(0)\" *ngIf=\"wishList.product_web=='2'\" >\n                                  <img src=\"{{wishList.product_thumb}}\" alt=\"product-img\" />\n                              </a>\n                              <a href=\"javascript:void(0)\" *ngIf=\"wishList.product_web=='3'\" >\n                                  <video  width=\"200\" height=\"150\" [poster]=\"'https://p5iconsp.s3-accelerate.amazonaws.com/'+wishList.product_main_footage\" controls controlsList=\"nodownload\" onmouseover=\"this.play()\" onmouseout=\"this.load()\">\n                                      <source src=\"{{wishList.product_thumb}}\" type=\"video/mp4\">\n                                      Your browser does not support the video tag.\n                                  </video>\n                              </a>\n\n                          </div>\n\n                      </td>\n\n                      <td width=\"50%\">\n                          <p class=\"mb-1 text-black f-18\"><strong>{{wishList.product_name}}</strong></p>\n                          <p class=\"mb-1 f-16\"><strong>Size:</strong>  {{wishList.standard_size}}</p>\n                          <p class=\"mb-1\">{{wishList.product_desc}}</p>\n\n                          <div class=\"clearfix\"></div>\n                          <div class=\"mt-2\">\n                              <a  class=\"btn btn-danger btn-sm f-12\" (click)=\"removeProductFromCart(wishList)\"><i class=\"fa fa-times-circle\"></i> Remove</a>\n                                <a  class=\"btn btn-success btn-sm f-12 text-white ml-1\" (click)=\"addtolightbox(wishList)\"><i class=\"fa fa-heart\"></i> Wishlist</a>\n                          </div>\n\n                      </td>\n                      <td width=\"25%\" align=\"right\"><p class=\"f-18 text-black\"><strong>{{wishList.total}} INR</strong></p>\n\n                      </td>\n                  </tr>\n\n                  </tbody>\n                </table>\n              </div>\n\n              <hr>\n            \n                <div class=\"col-12\">\n                <div class=\"p-3 row\">\n                  <div class=\"col-md-4 col-sm-4 col-lg-4\">\n                  <a href=\"javascript:void();\" id=\"promocode\" (click)=\"promocode()\">Have a promo code ?</a>\n                  <div class=\"show-promocode\" *ngIf=\"promocodeflag\">\n                  <div class=\"row\">\n                    <div class=\"col-md-8 col-sm-8 col-lg-8\">                        \n                      <input type=\"text\" name=\"\" class=\"form-control\" placeholder=\"Coupon Code\">\n                    </div>\n                    <div class=\"col-md-4 col-sm-4 col-lg-4 pl-1\">                        \n                      <button class=\"btn btn-success\">Apply</button>\n                    </div>\n                  </div>\n                  </div>\n                </div>\n                 <div class=\"col-md-8 col-sm-8 col-lg-8\">\n                  <ul class=\"list-unstyled text-right text-black f-18 text-black\">\n                    <li class=\"pb-3 fw-6 \">Sub Total <span class=\"d-inline-block w-100px\">{{showTotalPrice()}} INR</span></li>\n                    <li class=\"pb-5 fw-6 \">Taxes <span class=\"d-inline-block w-100px\">10.00 INR</span></li>\n                    <li class=\"pb-2 fw-8 f-22\">Grand Total <span class=\"d-inline-block w-100px\">{{showTotalPrice() + 10}} INR</span></li>\n                  </ul>\n                  </div>\n                  </div>\n                  <div class=\"my-3\">\n                   <hr>\n              <a href=\"javascript:void(0)\"  class=\"btn btn-success float-right pt-3 pb-3 pl-5 pr-5 f-20 text-uppercase\" (click)=\"redirectToCheckout()\"><strong>Checkout</strong></a>\n              </div>\n                </div>\n              \n             \n            </form>\n          </div>\n     <div class=\"card pb-3 shadow-sm\" *ngIf=\"wishListDataItems.length==0\">\n        Your Cart is Empty.\n     </div>\n  </div>\n</section>\n";
    /***/
  },

  /***/
  "./node_modules/tslib/tslib.es6.js":
  /*!*****************************************!*\
    !*** ./node_modules/tslib/tslib.es6.js ***!
    \*****************************************/

  /*! exports provided: __extends, __assign, __rest, __decorate, __param, __metadata, __awaiter, __generator, __exportStar, __values, __read, __spread, __spreadArrays, __await, __asyncGenerator, __asyncDelegator, __asyncValues, __makeTemplateObject, __importStar, __importDefault */

  /***/
  function node_modulesTslibTslibEs6Js(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__extends", function () {
      return __extends;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__assign", function () {
      return _assign;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__rest", function () {
      return __rest;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__decorate", function () {
      return __decorate;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__param", function () {
      return __param;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__metadata", function () {
      return __metadata;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__awaiter", function () {
      return __awaiter;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__generator", function () {
      return __generator;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__exportStar", function () {
      return __exportStar;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__values", function () {
      return __values;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__read", function () {
      return __read;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__spread", function () {
      return __spread;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__spreadArrays", function () {
      return __spreadArrays;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__await", function () {
      return __await;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__asyncGenerator", function () {
      return __asyncGenerator;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__asyncDelegator", function () {
      return __asyncDelegator;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__asyncValues", function () {
      return __asyncValues;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__makeTemplateObject", function () {
      return __makeTemplateObject;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__importStar", function () {
      return __importStar;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "__importDefault", function () {
      return __importDefault;
    });
    /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0
    
    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.
    
    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */

    /* global Reflect, Promise */


    var _extendStatics = function extendStatics(d, b) {
      _extendStatics = Object.setPrototypeOf || {
        __proto__: []
      } instanceof Array && function (d, b) {
        d.__proto__ = b;
      } || function (d, b) {
        for (var p in b) {
          if (b.hasOwnProperty(p)) d[p] = b[p];
        }
      };

      return _extendStatics(d, b);
    };

    function __extends(d, b) {
      _extendStatics(d, b);

      function __() {
        this.constructor = d;
      }

      d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    }

    var _assign = function __assign() {
      _assign = Object.assign || function __assign(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
          s = arguments[i];

          for (var p in s) {
            if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
          }
        }

        return t;
      };

      return _assign.apply(this, arguments);
    };

    function __rest(s, e) {
      var t = {};

      for (var p in s) {
        if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0) t[p] = s[p];
      }

      if (s != null && typeof Object.getOwnPropertySymbols === "function") for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
        if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i])) t[p[i]] = s[p[i]];
      }
      return t;
    }

    function __decorate(decorators, target, key, desc) {
      var c = arguments.length,
          r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc,
          d;
      if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);else for (var i = decorators.length - 1; i >= 0; i--) {
        if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
      }
      return c > 3 && r && Object.defineProperty(target, key, r), r;
    }

    function __param(paramIndex, decorator) {
      return function (target, key) {
        decorator(target, key, paramIndex);
      };
    }

    function __metadata(metadataKey, metadataValue) {
      if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(metadataKey, metadataValue);
    }

    function __awaiter(thisArg, _arguments, P, generator) {
      return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) {
          try {
            step(generator.next(value));
          } catch (e) {
            reject(e);
          }
        }

        function rejected(value) {
          try {
            step(generator["throw"](value));
          } catch (e) {
            reject(e);
          }
        }

        function step(result) {
          result.done ? resolve(result.value) : new P(function (resolve) {
            resolve(result.value);
          }).then(fulfilled, rejected);
        }

        step((generator = generator.apply(thisArg, _arguments || [])).next());
      });
    }

    function __generator(thisArg, body) {
      var _ = {
        label: 0,
        sent: function sent() {
          if (t[0] & 1) throw t[1];
          return t[1];
        },
        trys: [],
        ops: []
      },
          f,
          y,
          t,
          g;
      return g = {
        next: verb(0),
        "throw": verb(1),
        "return": verb(2)
      }, typeof Symbol === "function" && (g[Symbol.iterator] = function () {
        return this;
      }), g;

      function verb(n) {
        return function (v) {
          return step([n, v]);
        };
      }

      function step(op) {
        if (f) throw new TypeError("Generator is already executing.");

        while (_) {
          try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];

            switch (op[0]) {
              case 0:
              case 1:
                t = op;
                break;

              case 4:
                _.label++;
                return {
                  value: op[1],
                  done: false
                };

              case 5:
                _.label++;
                y = op[1];
                op = [0];
                continue;

              case 7:
                op = _.ops.pop();

                _.trys.pop();

                continue;

              default:
                if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) {
                  _ = 0;
                  continue;
                }

                if (op[0] === 3 && (!t || op[1] > t[0] && op[1] < t[3])) {
                  _.label = op[1];
                  break;
                }

                if (op[0] === 6 && _.label < t[1]) {
                  _.label = t[1];
                  t = op;
                  break;
                }

                if (t && _.label < t[2]) {
                  _.label = t[2];

                  _.ops.push(op);

                  break;
                }

                if (t[2]) _.ops.pop();

                _.trys.pop();

                continue;
            }

            op = body.call(thisArg, _);
          } catch (e) {
            op = [6, e];
            y = 0;
          } finally {
            f = t = 0;
          }
        }

        if (op[0] & 5) throw op[1];
        return {
          value: op[0] ? op[1] : void 0,
          done: true
        };
      }
    }

    function __exportStar(m, exports) {
      for (var p in m) {
        if (!exports.hasOwnProperty(p)) exports[p] = m[p];
      }
    }

    function __values(o) {
      var m = typeof Symbol === "function" && o[Symbol.iterator],
          i = 0;
      if (m) return m.call(o);
      return {
        next: function next() {
          if (o && i >= o.length) o = void 0;
          return {
            value: o && o[i++],
            done: !o
          };
        }
      };
    }

    function __read(o, n) {
      var m = typeof Symbol === "function" && o[Symbol.iterator];
      if (!m) return o;
      var i = m.call(o),
          r,
          ar = [],
          e;

      try {
        while ((n === void 0 || n-- > 0) && !(r = i.next()).done) {
          ar.push(r.value);
        }
      } catch (error) {
        e = {
          error: error
        };
      } finally {
        try {
          if (r && !r.done && (m = i["return"])) m.call(i);
        } finally {
          if (e) throw e.error;
        }
      }

      return ar;
    }

    function __spread() {
      for (var ar = [], i = 0; i < arguments.length; i++) {
        ar = ar.concat(__read(arguments[i]));
      }

      return ar;
    }

    function __spreadArrays() {
      for (var s = 0, i = 0, il = arguments.length; i < il; i++) {
        s += arguments[i].length;
      }

      for (var r = Array(s), k = 0, i = 0; i < il; i++) {
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++) {
          r[k] = a[j];
        }
      }

      return r;
    }

    ;

    function __await(v) {
      return this instanceof __await ? (this.v = v, this) : new __await(v);
    }

    function __asyncGenerator(thisArg, _arguments, generator) {
      if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
      var g = generator.apply(thisArg, _arguments || []),
          i,
          q = [];
      return i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () {
        return this;
      }, i;

      function verb(n) {
        if (g[n]) i[n] = function (v) {
          return new Promise(function (a, b) {
            q.push([n, v, a, b]) > 1 || resume(n, v);
          });
        };
      }

      function resume(n, v) {
        try {
          step(g[n](v));
        } catch (e) {
          settle(q[0][3], e);
        }
      }

      function step(r) {
        r.value instanceof __await ? Promise.resolve(r.value.v).then(fulfill, reject) : settle(q[0][2], r);
      }

      function fulfill(value) {
        resume("next", value);
      }

      function reject(value) {
        resume("throw", value);
      }

      function settle(f, v) {
        if (f(v), q.shift(), q.length) resume(q[0][0], q[0][1]);
      }
    }

    function __asyncDelegator(o) {
      var i, p;
      return i = {}, verb("next"), verb("throw", function (e) {
        throw e;
      }), verb("return"), i[Symbol.iterator] = function () {
        return this;
      }, i;

      function verb(n, f) {
        i[n] = o[n] ? function (v) {
          return (p = !p) ? {
            value: __await(o[n](v)),
            done: n === "return"
          } : f ? f(v) : v;
        } : f;
      }
    }

    function __asyncValues(o) {
      if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
      var m = o[Symbol.asyncIterator],
          i;
      return m ? m.call(o) : (o = typeof __values === "function" ? __values(o) : o[Symbol.iterator](), i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () {
        return this;
      }, i);

      function verb(n) {
        i[n] = o[n] && function (v) {
          return new Promise(function (resolve, reject) {
            v = o[n](v), settle(resolve, reject, v.done, v.value);
          });
        };
      }

      function settle(resolve, reject, d, v) {
        Promise.resolve(v).then(function (v) {
          resolve({
            value: v,
            done: d
          });
        }, reject);
      }
    }

    function __makeTemplateObject(cooked, raw) {
      if (Object.defineProperty) {
        Object.defineProperty(cooked, "raw", {
          value: raw
        });
      } else {
        cooked.raw = raw;
      }

      return cooked;
    }

    ;

    function __importStar(mod) {
      if (mod && mod.__esModule) return mod;
      var result = {};
      if (mod != null) for (var k in mod) {
        if (Object.hasOwnProperty.call(mod, k)) result[k] = mod[k];
      }
      result.default = mod;
      return result;
    }

    function __importDefault(mod) {
      return mod && mod.__esModule ? mod : {
        default: mod
      };
    }
    /***/

  },

  /***/
  "./src/app/_helpers/image-footer-helper.ts":
  /*!*************************************************!*\
    !*** ./src/app/_helpers/image-footer-helper.ts ***!
    \*************************************************/

  /*! exports provided: imageFooterHelper */

  /***/
  function srcApp_helpersImageFooterHelperTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "imageFooterHelper", function () {
      return imageFooterHelper;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var imageFooterHelper =
    /*#__PURE__*/
    function () {
      function imageFooterHelper() {
        _classCallCheck(this, imageFooterHelper);
      }

      _createClass(imageFooterHelper, [{
        key: "mustMatch",
        // custom validator to check that two fields match
        value: function mustMatch(controlName, matchingControlName) {
          return function (formGroup) {
            var control = formGroup.controls[controlName];
            var matchingControl = formGroup.controls[matchingControlName];

            if (matchingControl.errors && !matchingControl.errors.mustMatch) {
              // return if another validator has already found an error on the matchingControl
              return;
            } // set error on matchingControl if validation fails


            if (control.value !== matchingControl.value) {
              matchingControl.setErrors({
                mustMatch: true
              });
            } else {
              matchingControl.setErrors(null);
            }
          };
        }
      }, {
        key: "shuffleArray",
        value: function shuffleArray(array) {
          var m = array.length,
              t,
              i; // While there remain elements to shuffle

          while (m) {
            // Pick a remaining element…
            i = Math.floor(Math.random() * m--); // And swap it with the current element.

            t = array[m];
            array[m] = array[i];
            array[i] = t;
          }

          return array;
        }
      }]);

      return imageFooterHelper;
    }();

    imageFooterHelper = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    })], imageFooterHelper);
    /***/
  },

  /***/
  "./src/app/about-us/about-us.component.css":
  /*!*************************************************!*\
    !*** ./src/app/about-us/about-us.component.css ***!
    \*************************************************/

  /*! exports provided: default */

  /***/
  function srcAppAboutUsAboutUsComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2Fib3V0LXVzL2Fib3V0LXVzLmNvbXBvbmVudC5jc3MifQ== */";
    /***/
  },

  /***/
  "./src/app/about-us/about-us.component.ts":
  /*!************************************************!*\
    !*** ./src/app/about-us/about-us.component.ts ***!
    \************************************************/

  /*! exports provided: AboutUsComponent */

  /***/
  function srcAppAboutUsAboutUsComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AboutUsComponent", function () {
      return AboutUsComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var AboutUsComponent =
    /*#__PURE__*/
    function () {
      function AboutUsComponent() {
        _classCallCheck(this, AboutUsComponent);
      }

      _createClass(AboutUsComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }]);

      return AboutUsComponent;
    }();

    AboutUsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-about-us',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./about-us.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/about-us/about-us.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./about-us.component.css */
      "./src/app/about-us/about-us.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])], AboutUsComponent);
    /***/
  },

  /***/
  "./src/app/app-routing.module.ts":
  /*!***************************************!*\
    !*** ./src/app/app-routing.module.ts ***!
    \***************************************/

  /*! exports provided: AppRoutingModule */

  /***/
  function srcAppAppRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AppRoutingModule", function () {
      return AppRoutingModule;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./dashboard/dashboard.component */
    "./src/app/dashboard/dashboard.component.ts");
    /* harmony import */


    var _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./heroes/heroes.component */
    "./src/app/heroes/heroes.component.ts");
    /* harmony import */


    var _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./hero-detail/hero-detail.component */
    "./src/app/hero-detail/hero-detail.component.ts");
    /* harmony import */


    var _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./about-us/about-us.component */
    "./src/app/about-us/about-us.component.ts");
    /* harmony import */


    var _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ./sign-up/sign-up.component */
    "./src/app/sign-up/sign-up.component.ts");
    /* harmony import */


    var _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ./wishlist/wishlist.component */
    "./src/app/wishlist/wishlist.component.ts");
    /* harmony import */


    var _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ./contact-us/contact-us.component */
    "./src/app/contact-us/contact-us.component.ts");
    /* harmony import */


    var _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! ./licence-agreement/licence-agreement.component */
    "./src/app/licence-agreement/licence-agreement.component.ts");
    /* harmony import */


    var _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! ./terms-and-conditions/terms-and-conditions.component */
    "./src/app/terms-and-conditions/terms-and-conditions.component.ts");
    /* harmony import */


    var _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! ./privacy-policy/privacy-policy.component */
    "./src/app/privacy-policy/privacy-policy.component.ts");
    /* harmony import */


    var _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! ./hero-search/hero-search.component */
    "./src/app/hero-search/hero-search.component.ts");
    /* harmony import */


    var _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! ./checkout/checkout.component */
    "./src/app/checkout/checkout.component.ts");
    /* harmony import */


    var _contributor_sign_up_contributor_sign_up_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! ./contributor-sign-up/contributor-sign-up.component */
    "./src/app/contributor-sign-up/contributor-sign-up.component.ts");
    /* harmony import */


    var _pricing_pricing_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! ./pricing/pricing.component */
    "./src/app/pricing/pricing.component.ts");
    /* harmony import */


    var _order_confirmation_order_confirmation_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! ./order-confirmation/order-confirmation.component */
    "./src/app/order-confirmation/order-confirmation.component.ts");
    /* harmony import */


    var _user_profile_user_profile_component__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! ./user-profile/user-profile.component */
    "./src/app/user-profile/user-profile.component.ts");
    /* harmony import */


    var _reset_password_reset_password_component__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! ./reset-password/reset-password.component */
    "./src/app/reset-password/reset-password.component.ts");
    /* harmony import */


    var _lightbox_lightbox_component__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(
    /*! ./lightbox/lightbox.component */
    "./src/app/lightbox/lightbox.component.ts");

    var routes = [// { path: '/', redirectTo: '', pathMatch: 'full' },
    {
      path: '',
      component: _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_3__["DashboardComponent"]
    }, {
      path: 'detail/:id/:webtype/:type',
      component: _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_5__["HeroDetailComponent"]
    }, {
      path: 'search',
      component: _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_13__["HeroSearchComponent"]
    }, {
      path: 'heroes',
      component: _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_4__["HeroesComponent"]
    }, {
      path: 'aboutUs',
      component: _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_6__["AboutUsComponent"]
    }, {
      path: 'signUp',
      component: _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_7__["SignUpComponent"]
    }, {
      path: 'cart',
      component: _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_8__["WishlistComponent"]
    }, {
      path: 'contactUs',
      component: _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_9__["ContactUsComponent"]
    }, {
      path: 'license',
      component: _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_10__["LicenceAgreementComponent"]
    }, {
      path: 'terms',
      component: _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_11__["TermsAndConditionsComponent"]
    }, {
      path: 'privacy',
      component: _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_12__["PrivacyPolicyComponent"]
    }, {
      path: 'tagging',
      component: _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_9__["ContactUsComponent"]
    }, {
      path: 'checkout',
      component: _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_14__["CheckoutComponent"]
    }, {
      path: 'pricing',
      component: _pricing_pricing_component__WEBPACK_IMPORTED_MODULE_16__["PricingComponent"]
    }, {
      path: 'contributor-sign-up',
      component: _contributor_sign_up_contributor_sign_up_component__WEBPACK_IMPORTED_MODULE_15__["ContributorSignUpComponent"]
    }, {
      path: 'orderConfirmation/:id',
      component: _order_confirmation_order_confirmation_component__WEBPACK_IMPORTED_MODULE_17__["OrderConfirmationComponent"]
    }, {
      path: 'user-profile',
      component: _user_profile_user_profile_component__WEBPACK_IMPORTED_MODULE_18__["UserProfileComponent"]
    }, {
      path: 'user-reset-password',
      component: _reset_password_reset_password_component__WEBPACK_IMPORTED_MODULE_19__["ResetPasswordComponent"]
    }, {
      path: 'lightbox',
      component: _lightbox_lightbox_component__WEBPACK_IMPORTED_MODULE_20__["LightboxComponent"]
    }];

    var AppRoutingModule = function AppRoutingModule() {
      _classCallCheck(this, AppRoutingModule);
    };

    AppRoutingModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forRoot(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], AppRoutingModule);
    /***/
  },

  /***/
  "./src/app/app.component.css":
  /*!***********************************!*\
    !*** ./src/app/app.component.css ***!
    \***********************************/

  /*! exports provided: default */

  /***/
  function srcAppAppComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2FwcC5jb21wb25lbnQuY3NzIn0= */";
    /***/
  },

  /***/
  "./src/app/app.component.ts":
  /*!**********************************!*\
    !*** ./src/app/app.component.ts ***!
    \**********************************/

  /*! exports provided: AppComponent */

  /***/
  function srcAppAppComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AppComponent", function () {
      return AppComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/common */
    "./node_modules/@angular/common/fesm2015/common.js");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");

    var AppComponent =
    /*#__PURE__*/
    function () {
      function AppComponent(router, actRoute, spinner, document) {
        _classCallCheck(this, AppComponent);

        this.router = router;
        this.actRoute = actRoute;
        this.spinner = spinner;
        this.document = document;
        this.scrollPosition = 0;
        this.title = 'Image Footage';
        this.footerEle = true;
        this.dashboardEle = false;
      }

      _createClass(AppComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this = this;

          /*if (environment.production) {
           if (location.protocol === 'http:') {
            window.location.href = location.href.replace('http', 'https');
           }
          }*/
          this.sub = this.router.events.subscribe(function (event) {
            if (event instanceof _angular_router__WEBPACK_IMPORTED_MODULE_2__["NavigationEnd"]) {
              if (event.url.includes("/search?")) {
                _this.footerEle = false;
              } else {
                _this.footerEle = true;
              }

              if (event.url == "/" || event.url == "/#page-top") {
                _this.dashboardEle = true;
              } else {
                _this.dashboardEle = false;
              }
            }

            window.scrollTo(0, 0);
          }); //window.addEventListener('scroll', this.scroll, true); //third parameter
        }
      }, {
        key: "ngOnDestroy",
        value: function ngOnDestroy() {// window.removeEventListener('scroll', this.scroll, true);
        }
      }, {
        key: "onWindowScroll",
        value: function onWindowScroll() {
          this.scrollPosition = document.documentElement.scrollTop;
        }
      }, {
        key: "minWidth",
        value: function minWidth() {
          return this.scrollPosition > 0;
        }
      }]);

      return AppComponent;
    }();

    AppComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"]
      }, {
        type: ngx_spinner__WEBPACK_IMPORTED_MODULE_4__["NgxSpinnerService"]
      }, {
        type: Document,
        decorators: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"],
          args: [_angular_common__WEBPACK_IMPORTED_MODULE_3__["DOCUMENT"]]
        }]
      }];
    };

    tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["HostListener"])("window:scroll", []), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Function), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", []), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:returntype", void 0)], AppComponent.prototype, "onWindowScroll", null);
    AppComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-root',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./app.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/app.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./app.component.css */
      "./src/app/app.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__param"](3, Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"])(_angular_common__WEBPACK_IMPORTED_MODULE_3__["DOCUMENT"])), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"], ngx_spinner__WEBPACK_IMPORTED_MODULE_4__["NgxSpinnerService"], Document])], AppComponent);
    /***/
  },

  /***/
  "./src/app/app.module.ts":
  /*!*******************************!*\
    !*** ./src/app/app.module.ts ***!
    \*******************************/

  /*! exports provided: getAuthServiceConfigs, AppModule */

  /***/
  function srcAppAppModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "getAuthServiceConfigs", function () {
      return getAuthServiceConfigs;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AppModule", function () {
      return AppModule;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/platform-browser */
    "./node_modules/@angular/platform-browser/fesm2015/platform-browser.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/fesm2015/forms.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/fesm2015/http.js");
    /* harmony import */


    var _angular_http__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/http */
    "./node_modules/@angular/http/fesm2015/http.js");
    /* harmony import */


    var _app_routing_module__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./app-routing.module */
    "./src/app/app-routing.module.ts");
    /* harmony import */


    var _app_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ./app.component */
    "./src/app/app.component.ts");
    /* harmony import */


    var _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ./dashboard/dashboard.component */
    "./src/app/dashboard/dashboard.component.ts");
    /* harmony import */


    var _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ./hero-detail/hero-detail.component */
    "./src/app/hero-detail/hero-detail.component.ts");
    /* harmony import */


    var _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! ./heroes/heroes.component */
    "./src/app/heroes/heroes.component.ts");
    /* harmony import */


    var _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! ./hero-search/hero-search.component */
    "./src/app/hero-search/hero-search.component.ts");
    /* harmony import */


    var _messages_messages_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! ./messages/messages.component */
    "./src/app/messages/messages.component.ts");
    /* harmony import */


    var _footer_footer_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! ./footer/footer.component */
    "./src/app/footer/footer.component.ts");
    /* harmony import */


    var _header_header_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! ./header/header.component */
    "./src/app/header/header.component.ts");
    /* harmony import */


    var _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! ./about-us/about-us.component */
    "./src/app/about-us/about-us.component.ts");
    /* harmony import */


    var _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! ./sign-up/sign-up.component */
    "./src/app/sign-up/sign-up.component.ts");
    /* harmony import */


    var _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! ./wishlist/wishlist.component */
    "./src/app/wishlist/wishlist.component.ts");
    /* harmony import */


    var _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! @ng-bootstrap/ng-bootstrap */
    "./node_modules/@ng-bootstrap/ng-bootstrap/fesm2015/ng-bootstrap.js");
    /* harmony import */


    var _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! ./contact-us/contact-us.component */
    "./src/app/contact-us/contact-us.component.ts");
    /* harmony import */


    var _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(
    /*! ./terms-and-conditions/terms-and-conditions.component */
    "./src/app/terms-and-conditions/terms-and-conditions.component.ts");
    /* harmony import */


    var _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(
    /*! ./privacy-policy/privacy-policy.component */
    "./src/app/privacy-policy/privacy-policy.component.ts");
    /* harmony import */


    var _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(
    /*! ./licence-agreement/licence-agreement.component */
    "./src/app/licence-agreement/licence-agreement.component.ts");
    /* harmony import */


    var _login_login_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(
    /*! ./login/login.component */
    "./src/app/login/login.component.ts");
    /* harmony import */


    var _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(
    /*! ./checkout/checkout.component */
    "./src/app/checkout/checkout.component.ts");
    /* harmony import */


    var _contributor_sign_up_contributor_sign_up_component__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(
    /*! ./contributor-sign-up/contributor-sign-up.component */
    "./src/app/contributor-sign-up/contributor-sign-up.component.ts");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");
    /* harmony import */


    var _angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(
    /*! @angular/platform-browser/animations */
    "./node_modules/@angular/platform-browser/fesm2015/animations.js");
    /* harmony import */


    var _order_confirmation_order_confirmation_component__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(
    /*! ./order-confirmation/order-confirmation.component */
    "./src/app/order-confirmation/order-confirmation.component.ts");
    /* harmony import */


    var _pricing_pricing_component__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(
    /*! ./pricing/pricing.component */
    "./src/app/pricing/pricing.component.ts");
    /* harmony import */


    var _user_profile_user_profile_component__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(
    /*! ./user-profile/user-profile.component */
    "./src/app/user-profile/user-profile.component.ts");
    /* harmony import */


    var angular_tabs_component__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(
    /*! angular-tabs-component */
    "./node_modules/angular-tabs-component/dist/index.js");
    /* harmony import */


    var _reset_password_reset_password_component__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(
    /*! ./reset-password/reset-password.component */
    "./src/app/reset-password/reset-password.component.ts");
    /* harmony import */


    var angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(
    /*! angular-6-social-login */
    "./node_modules/angular-6-social-login/angular-6-social-login.umd.js");
    /* harmony import */


    var angular_6_social_login__WEBPACK_IMPORTED_MODULE_33___default =
    /*#__PURE__*/
    __webpack_require__.n(angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__);
    /* harmony import */


    var _lightbox_lightbox_component__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(
    /*! ./lightbox/lightbox.component */
    "./src/app/lightbox/lightbox.component.ts");
    /* harmony import */


    var _angular_cdk_layout__WEBPACK_IMPORTED_MODULE_35__ = __webpack_require__(
    /*! @angular/cdk/layout */
    "./node_modules/@angular/cdk/esm2015/layout.js");
    /* harmony import */


    var _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_36__ = __webpack_require__(
    /*! @angular/material/toolbar */
    "./node_modules/@angular/material/esm2015/toolbar.js");
    /* harmony import */


    var _angular_material_button__WEBPACK_IMPORTED_MODULE_37__ = __webpack_require__(
    /*! @angular/material/button */
    "./node_modules/@angular/material/esm2015/button.js");
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_38__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/esm2015/sidenav.js");
    /* harmony import */


    var _angular_material_icon__WEBPACK_IMPORTED_MODULE_39__ = __webpack_require__(
    /*! @angular/material/icon */
    "./node_modules/@angular/material/esm2015/icon.js");
    /* harmony import */


    var _angular_material_list__WEBPACK_IMPORTED_MODULE_40__ = __webpack_require__(
    /*! @angular/material/list */
    "./node_modules/@angular/material/esm2015/list.js");
    /* harmony import */


    var ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_41__ = __webpack_require__(
    /*! ngx-perfect-scrollbar */
    "./node_modules/ngx-perfect-scrollbar/dist/ngx-perfect-scrollbar.es5.js"); //sidebar
    //sidebar end
    // Configs 


    function getAuthServiceConfigs() {
      var config = new angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__["AuthServiceConfig"]([{
        id: angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__["FacebookLoginProvider"].PROVIDER_ID,
        provider: new angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__["FacebookLoginProvider"]("396074584437141") // live 509349303296309
        // test 396074584437141

      }, {
        id: angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__["GoogleLoginProvider"].PROVIDER_ID,
        provider: new angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__["GoogleLoginProvider"]("1015801520785-q9mr6cas6mkp5l13l27dm9ke7ejhv9la.apps.googleusercontent.com") // amit 167319950494-feg723qt2cnhkugetigtguo6314tog9r.apps.googleusercontent.com
        // aksrinivas 1015801520785-q9mr6cas6mkp5l13l27dm9ke7ejhv9la.apps.googleusercontent.com

      }]);
      return config;
    } //sidebar


    var DEFAULT_PERFECT_SCROLLBAR_CONFIG = {
      suppressScrollX: true
    }; //sidebar end

    var AppModule = function AppModule() {
      _classCallCheck(this, AppModule);
    };

    AppModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__["BrowserModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormsModule"], _app_routing_module__WEBPACK_IMPORTED_MODULE_6__["AppRoutingModule"], _angular_common_http__WEBPACK_IMPORTED_MODULE_4__["HttpClientModule"], _angular_http__WEBPACK_IMPORTED_MODULE_5__["HttpModule"], _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_18__["NgbModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["ReactiveFormsModule"], ngx_spinner__WEBPACK_IMPORTED_MODULE_26__["NgxSpinnerModule"], angular_tabs_component__WEBPACK_IMPORTED_MODULE_31__["TabModule"], _angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_27__["NoopAnimationsModule"], angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__["SocialLoginModule"], _angular_cdk_layout__WEBPACK_IMPORTED_MODULE_35__["LayoutModule"], _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_36__["MatToolbarModule"], _angular_material_button__WEBPACK_IMPORTED_MODULE_37__["MatButtonModule"], _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_38__["MatSidenavModule"], _angular_material_icon__WEBPACK_IMPORTED_MODULE_39__["MatIconModule"], _angular_material_list__WEBPACK_IMPORTED_MODULE_40__["MatListModule"], ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_41__["PerfectScrollbarModule"] // The HttpClientInMemoryWebApiModule module intercepts HTTP requests
      // and returns simulated server responses.
      // Remove it when a real server is ready to receive requests.
      // HttpClientInMemoryWebApiModule.forRoot(
      //   InMemoryDataService, { dataEncapsulation: false }
      // )
      ],
      declarations: [_app_component__WEBPACK_IMPORTED_MODULE_7__["AppComponent"], _dashboard_dashboard_component__WEBPACK_IMPORTED_MODULE_8__["DashboardComponent"], _heroes_heroes_component__WEBPACK_IMPORTED_MODULE_10__["HeroesComponent"], _hero_detail_hero_detail_component__WEBPACK_IMPORTED_MODULE_9__["HeroDetailComponent"], _messages_messages_component__WEBPACK_IMPORTED_MODULE_12__["MessagesComponent"], _hero_search_hero_search_component__WEBPACK_IMPORTED_MODULE_11__["HeroSearchComponent"], _footer_footer_component__WEBPACK_IMPORTED_MODULE_13__["FooterComponent"], _header_header_component__WEBPACK_IMPORTED_MODULE_14__["HeaderComponent"], _about_us_about_us_component__WEBPACK_IMPORTED_MODULE_15__["AboutUsComponent"], _sign_up_sign_up_component__WEBPACK_IMPORTED_MODULE_16__["SignUpComponent"], _wishlist_wishlist_component__WEBPACK_IMPORTED_MODULE_17__["WishlistComponent"], _contact_us_contact_us_component__WEBPACK_IMPORTED_MODULE_19__["ContactUsComponent"], _terms_and_conditions_terms_and_conditions_component__WEBPACK_IMPORTED_MODULE_20__["TermsAndConditionsComponent"], _privacy_policy_privacy_policy_component__WEBPACK_IMPORTED_MODULE_21__["PrivacyPolicyComponent"], _licence_agreement_licence_agreement_component__WEBPACK_IMPORTED_MODULE_22__["LicenceAgreementComponent"], _login_login_component__WEBPACK_IMPORTED_MODULE_23__["LoginComponent"], _checkout_checkout_component__WEBPACK_IMPORTED_MODULE_24__["CheckoutComponent"], _contributor_sign_up_contributor_sign_up_component__WEBPACK_IMPORTED_MODULE_25__["ContributorSignUpComponent"], _order_confirmation_order_confirmation_component__WEBPACK_IMPORTED_MODULE_28__["OrderConfirmationComponent"], _pricing_pricing_component__WEBPACK_IMPORTED_MODULE_29__["PricingComponent"], _user_profile_user_profile_component__WEBPACK_IMPORTED_MODULE_30__["UserProfileComponent"], _reset_password_reset_password_component__WEBPACK_IMPORTED_MODULE_32__["ResetPasswordComponent"], _lightbox_lightbox_component__WEBPACK_IMPORTED_MODULE_34__["LightboxComponent"]],
      exports: [_login_login_component__WEBPACK_IMPORTED_MODULE_23__["LoginComponent"]],
      providers: [{
        provide: angular_6_social_login__WEBPACK_IMPORTED_MODULE_33__["AuthServiceConfig"],
        useFactory: getAuthServiceConfigs
      }, {
        provide: ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_41__["PERFECT_SCROLLBAR_CONFIG"],
        useValue: DEFAULT_PERFECT_SCROLLBAR_CONFIG
      }],
      bootstrap: [_app_component__WEBPACK_IMPORTED_MODULE_7__["AppComponent"]]
    })], AppModule);
    /***/
  },

  /***/
  "./src/app/checkout/checkout.component.css":
  /*!*************************************************!*\
    !*** ./src/app/checkout/checkout.component.css ***!
    \*************************************************/

  /*! exports provided: default */

  /***/
  function srcAppCheckoutCheckoutComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "body{ font-weight:normal;background: #f1f5f6;}\r\n#mainNav{background:#000;}\r\nhr {\r\n    border-top: 1px solid #ddd!important;\r\n}\r\n[type=radio] {\r\n    position: absolute;\r\n    opacity: 0;\r\n    width: 0;\r\n    height: 0;\r\n}\r\n/* IMAGE STYLES */\r\n[type=radio] + img {\r\n    cursor: pointer;\r\n}\r\n/* CHECKED STYLES */\r\n[type=radio]:checked + img {\r\n    outline: 2px solid #8bc34a;\r\n}\r\n\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvY2hlY2tvdXQvY2hlY2tvdXQuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxNQUFNLGtCQUFrQixDQUFDLG1CQUFtQixDQUFDO0FBQzdDLFNBQVMsZUFBZSxDQUFDO0FBQ3pCO0lBQ0ksb0NBQW9DO0FBQ3hDO0FBRUE7SUFDSSxrQkFBa0I7SUFDbEIsVUFBVTtJQUNWLFFBQVE7SUFDUixTQUFTO0FBQ2I7QUFFQSxpQkFBaUI7QUFDakI7SUFDSSxlQUFlO0FBQ25CO0FBRUEsbUJBQW1CO0FBQ25CO0lBQ0ksMEJBQTBCO0FBQzlCIiwiZmlsZSI6InNyYy9hcHAvY2hlY2tvdXQvY2hlY2tvdXQuY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbImJvZHl7IGZvbnQtd2VpZ2h0Om5vcm1hbDtiYWNrZ3JvdW5kOiAjZjFmNWY2O31cclxuI21haW5OYXZ7YmFja2dyb3VuZDojMDAwO31cclxuaHIge1xyXG4gICAgYm9yZGVyLXRvcDogMXB4IHNvbGlkICNkZGQhaW1wb3J0YW50O1xyXG59XHJcblxyXG5bdHlwZT1yYWRpb10ge1xyXG4gICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgb3BhY2l0eTogMDtcclxuICAgIHdpZHRoOiAwO1xyXG4gICAgaGVpZ2h0OiAwO1xyXG59XHJcblxyXG4vKiBJTUFHRSBTVFlMRVMgKi9cclxuW3R5cGU9cmFkaW9dICsgaW1nIHtcclxuICAgIGN1cnNvcjogcG9pbnRlcjtcclxufVxyXG5cclxuLyogQ0hFQ0tFRCBTVFlMRVMgKi9cclxuW3R5cGU9cmFkaW9dOmNoZWNrZWQgKyBpbWcge1xyXG4gICAgb3V0bGluZTogMnB4IHNvbGlkICM4YmMzNGE7XHJcbn1cclxuIl19 */";
    /***/
  },

  /***/
  "./src/app/checkout/checkout.component.ts":
  /*!************************************************!*\
    !*** ./src/app/checkout/checkout.component.ts ***!
    \************************************************/

  /*! exports provided: CheckoutComponent */

  /***/
  function srcAppCheckoutCheckoutComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "CheckoutComponent", function () {
      return CheckoutComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/fesm2015/forms.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ../_helpers/image-footer-helper */
    "./src/app/_helpers/image-footer-helper.ts");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");

    var CheckoutComponent =
    /*#__PURE__*/
    function () {
      function CheckoutComponent(authenticationService, router, formBuilder, dataHelper, spinner) {
        var _this2 = this;

        _classCallCheck(this, CheckoutComponent);

        this.authenticationService = authenticationService;
        this.router = router;
        this.formBuilder = formBuilder;
        this.dataHelper = dataHelper;
        this.spinner = spinner;
        this.wishListDataItems = [];
        this.priceArray = [];
        this.loading = false;
        this.submitted = false;
        this.stateInfo = [];
        this.countryInfo = [];
        this.cityInfo = [];
        this.taxPrice = 10;
        this.loadingData = false;
        this.paymentShow = false;
        this.payuData = '';
        this.hash = '';
        this.authenticationService.currentUser.subscribe(function (x) {
          _this2.currentUser = x;

          if (!_this2.currentUser) {
            _this2.router.navigate(['/']);
          }
        });
      }

      _createClass(CheckoutComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this3 = this;

          //this.spinner.show();
          this.loadingData = true;
          var billing_address = localStorage.getItem('billing_address');

          if (billing_address) {
            var billdata = JSON.parse(billing_address);
            this.onChangeCountry(billdata.country);
            this.onChangeState(billdata.state);
            this.checkoutForm = this.formBuilder.group({
              first_name: [billdata.first_name, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              last_name: [billdata.last_name, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              address: [billdata.address, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              country: [billdata.country, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              state: [billdata.state, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              city: [billdata.city, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              pincode: [billdata.pincode, [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(6), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(6)]]
            });
          } else {
            this.checkoutForm = this.formBuilder.group({
              first_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              last_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              address: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              country: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              state: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              city: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
              pincode: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(6), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(6)]]
            });
          }

          this.getCountries();
          this.authenticationService.getcartItemsData().subscribe(function (data) {
            _this3.wishListDataItems = data;

            _this3.wishListDataItems.forEach(function (element) {
              console.log(element);

              _this3.priceArray.push(element["total"]);
            }); // this.spinner.hide();


            _this3.loadingData = false;
          }, function (error) {});
        }
      }, {
        key: "getCountries",
        value: function getCountries() {
          var _this4 = this;

          this.authenticationService.allCountries().subscribe(function (data2) {
            //this.countryInfo=data2.Countries;
            _this4.countryInfo = data2; //console.log('Data:', this.countryInfo);
          }, function (err) {
            return console.log(err);
          }, function () {
            return console.log('complete');
          });
        }
      }, {
        key: "onChangeCountry",
        value: function onChangeCountry(countryValue) {
          var _this5 = this;

          this.loadingData = true; //  console.log(this.countryInfo[countryValue]);

          this.authenticationService.allstates(countryValue).subscribe(function (data2) {
            //this.countryInfo=data2.Countries;
            _this5.stateInfo = data2;
            _this5.loadingData = false; //console.log('Data:', this.countryInfo);
          }, function (err) {
            return console.log(err);
          }, function () {
            return console.log('complete');
          }); // this.registerForm.controls['country'].setValue(this.countryInfo[countryValue].CountryName);
          // this.stateInfo=this.countryInfo[countryValue].States;
          // this.cityInfo=this.stateInfo[0].Cities;
          //  console.log(this.cityInfo);
        }
      }, {
        key: "onChangeCity",
        value: function onChangeCity(cityValue) {// console.log(this.cityInfo[cityValue]);
          // this.registerForm.controls['city'].setValue(this.cityInfo[cityValue]);
        }
      }, {
        key: "onChangeState",
        value: function onChangeState(stateValue) {
          var _this6 = this;

          this.loadingData = true; // console.log(this.stateInfo[stateValue]);

          this.authenticationService.allCities(stateValue).subscribe(function (data2) {
            //this.countryInfo=data2.Countries;
            _this6.cityInfo = data2;
            _this6.loadingData = false; //console.log('Data:', this.countryInfo);
          }, function (err) {
            return console.log(err);
          }, function () {
            return console.log('complete');
          }); // this.registerForm.controls['state'].setValue(this.stateInfo[stateValue].StateName);
          // this.cityInfo=this.stateInfo[stateValue].Cities;
          // console.log(this.cityInfo);j
        }
      }, {
        key: "onSubmit",
        value: function onSubmit() {
          this.loadingData = true;
          this.submitted = true; //console.log(this.checkoutForm);
          // stop here if form is invalid

          if (this.checkoutForm.invalid) {
            console.log('at invalid');
            this.loadingData = false; //console.log(this.checkoutForm);

            return;
          }

          this.paymentShow = true;
          this.loadingData = false;
          localStorage.setItem('billing_address', JSON.stringify(this.checkoutForm.value));
        }
      }, {
        key: "showTotalPrice",
        value: function showTotalPrice() {
          return this.priceArray.reduce(function (acc, val) {
            return acc + val;
          }, 0);
        }
      }, {
        key: "goToWishList",
        value: function goToWishList() {
          this.router.navigate(['/cart']);
        }
      }, {
        key: "onSubmitPayment",
        value: function onSubmitPayment(paymentgatway) {
          var _this7 = this;

          this.loadingData = true;
          console.log(paymentgatway);
          this.authenticationService.payment(this.checkoutForm.value, this.priceArray, paymentgatway) // .pipe(first())
          .subscribe(function (data2) {
            // alert("Sucessfully Registered");
            console.log(data2);
            console.log(paymentgatway);
            _this7.loadingData = false;

            if (paymentgatway == 'atom') {
              window.location.href = data2.url;
            } else if (paymentgatway == 'payu') {
              console.log(data2); //this.hash = data2.hash;

              window.location.href = data2.url; //document.getElementById('payuform').onsubmit;
              //this.payuData = data2;
            } //this.router.navigate([data2.url]);
            // console.log(data2);
            // console.log(data2.message);
            // console.log(data2["message"]);
            // if(data2.status=='1'){
            //   alert(data2.message);
            //   this.router.navigate(['/']);
            // }else{
            //   alert(data2.message);
            // }

          }, function (error) {
            _this7.loading = false;
          });
        }
      }, {
        key: "f",
        get: function get() {
          return this.checkoutForm.controls;
        }
      }]);

      return CheckoutComponent;
    }();

    CheckoutComponent.ctorParameters = function () {
      return [{
        type: _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"]
      }, {
        type: ngx_spinner__WEBPACK_IMPORTED_MODULE_6__["NgxSpinnerService"]
      }];
    };

    CheckoutComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-checkout',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./checkout.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/checkout/checkout.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./checkout.component.css */
      "./src/app/checkout/checkout.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"], _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"], ngx_spinner__WEBPACK_IMPORTED_MODULE_6__["NgxSpinnerService"]])], CheckoutComponent);
    /***/
  },

  /***/
  "./src/app/contact-us/contact-us.component.css":
  /*!*****************************************************!*\
    !*** ./src/app/contact-us/contact-us.component.css ***!
    \*****************************************************/

  /*! exports provided: default */

  /***/
  function srcAppContactUsContactUsComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "body{ font-weight:normal;}\r\n#mainNav{background:#000;}\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvY29udGFjdC11cy9jb250YWN0LXVzLmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUEsTUFBTSxrQkFBa0IsQ0FBQztBQUN6QixTQUFTLGVBQWUsQ0FBQyIsImZpbGUiOiJzcmMvYXBwL2NvbnRhY3QtdXMvY29udGFjdC11cy5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiYm9keXsgZm9udC13ZWlnaHQ6bm9ybWFsO31cclxuI21haW5OYXZ7YmFja2dyb3VuZDojMDAwO30iXX0= */";
    /***/
  },

  /***/
  "./src/app/contact-us/contact-us.component.ts":
  /*!****************************************************!*\
    !*** ./src/app/contact-us/contact-us.component.ts ***!
    \****************************************************/

  /*! exports provided: ContactUsComponent */

  /***/
  function srcAppContactUsContactUsComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ContactUsComponent", function () {
      return ContactUsComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/fesm2015/forms.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var rxjs_operators__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! rxjs/operators */
    "./node_modules/rxjs/_esm2015/operators/index.js");

    var ContactUsComponent =
    /*#__PURE__*/
    function () {
      function ContactUsComponent(formBuilder, authenticationService, router) {
        _classCallCheck(this, ContactUsComponent);

        this.formBuilder = formBuilder;
        this.authenticationService = authenticationService;
        this.router = router;
        this.loading = false;
        this.submitted = false;
      }

      _createClass(ContactUsComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.contactForm = this.formBuilder.group({
            user_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            user_email: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].email]],
            mobile_number: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(10), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(10)]],
            user_message: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            user_subject: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          });
        }
      }, {
        key: "onContactSubmit",
        value: function onContactSubmit() {
          var _this8 = this;

          this.submitted = true; // stop here if form is invalid

          if (this.contactForm.invalid) {
            // console.log('at invalid');   console.log(this.contactForm);
            return;
          } // console.log(this.contactForm.value);


          this.authenticationService.contactUs(this.contactForm.value).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_5__["first"])()).subscribe(function (data) {
            _this8.router.navigate(['/']);
          }, function (error) {
            _this8.loading = false;
          });
        }
      }, {
        key: "f",
        get: function get() {
          return this.contactForm.controls;
        }
      }]);

      return ContactUsComponent;
    }();

    ContactUsComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]
      }];
    };

    ContactUsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-contact-us',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./contact-us.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/contact-us/contact-us.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./contact-us.component.css */
      "./src/app/contact-us/contact-us.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]])], ContactUsComponent);
    /***/
  },

  /***/
  "./src/app/contributor-sign-up/contributor-sign-up.component.css":
  /*!***********************************************************************!*\
    !*** ./src/app/contributor-sign-up/contributor-sign-up.component.css ***!
    \***********************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppContributorSignUpContributorSignUpComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = " /* body{ font-weight:normal;background: #f1f5f6;} */\r\n #mainNav{background:#000;}\r\n hr {\r\n    border-top: 1px solid #ddd!important;\r\n}\r\n .con-bg {\r\n    background: url('beauty.jpg') center;\r\n    position: relative;\r\n    background-size: cover;\r\n    background-repeat: no-repeat;\r\n}\r\n .layer {\r\n    background-color: rgba(0, 0, 0, 0.7);\r\n    position: absolute;\r\n    top: 0;\r\n    left: 0;\r\n    width: 100%;\r\n    height: 100%;\r\n    display: -webkit-box;\r\n    display: -ms-flexbox;\r\n    display: flex;\r\n    -webkit-box-align: center;\r\n        -ms-flex-align: center;\r\n            align-items: center;\r\n}\r\n .font-normal {\r\n    font-weight: normal !important;\r\n}\r\n h1, h2, h3, h4, h5, h6 {\r\n    font-family: 'Open Sans', sans-serif;\r\n    color: #13113a;\r\n    line-height: 1.2;\r\n    margin-bottom: 0;\r\n    margin-top: 0;\r\n    font-weight: 700;\r\n}\r\n h1, h2, h3, h4, h5, h6 {\r\n    line-height: 1.2;\r\n}\r\n\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvY29udHJpYnV0b3Itc2lnbi11cC9jb250cmlidXRvci1zaWduLXVwLmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkNBQUMsbURBQW1EO0NBQ25ELFNBQVMsZUFBZSxDQUFDO0NBQ3pCO0lBQ0csb0NBQW9DO0FBQ3hDO0NBQ0E7SUFDSSxvQ0FBc0Q7SUFDdEQsa0JBQWtCO0lBQ2xCLHNCQUFzQjtJQUN0Qiw0QkFBNEI7QUFDaEM7Q0FDQTtJQUNJLG9DQUFvQztJQUNwQyxrQkFBa0I7SUFDbEIsTUFBTTtJQUNOLE9BQU87SUFDUCxXQUFXO0lBQ1gsWUFBWTtJQUNaLG9CQUFhO0lBQWIsb0JBQWE7SUFBYixhQUFhO0lBQ2IseUJBQW1CO1FBQW5CLHNCQUFtQjtZQUFuQixtQkFBbUI7QUFDdkI7Q0FFQTtJQUNJLDhCQUE4QjtBQUNsQztDQUNBO0lBQ0ksb0NBQW9DO0lBQ3BDLGNBQWM7SUFDZCxnQkFBZ0I7SUFDaEIsZ0JBQWdCO0lBQ2hCLGFBQWE7SUFDYixnQkFBZ0I7QUFDcEI7Q0FDQTtJQUNJLGdCQUFnQjtBQUNwQiIsImZpbGUiOiJzcmMvYXBwL2NvbnRyaWJ1dG9yLXNpZ24tdXAvY29udHJpYnV0b3Itc2lnbi11cC5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiIC8qIGJvZHl7IGZvbnQtd2VpZ2h0Om5vcm1hbDtiYWNrZ3JvdW5kOiAjZjFmNWY2O30gKi9cclxuICNtYWluTmF2e2JhY2tncm91bmQ6IzAwMDt9XHJcbiBociB7XHJcbiAgICBib3JkZXItdG9wOiAxcHggc29saWQgI2RkZCFpbXBvcnRhbnQ7XHJcbn1cclxuLmNvbi1iZyB7XHJcbiAgICBiYWNrZ3JvdW5kOiB1cmwoLi4vLi4vYXNzZXRzL2ltYWdlcy9iZWF1dHkuanBnKSBjZW50ZXI7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICBiYWNrZ3JvdW5kLXNpemU6IGNvdmVyO1xyXG4gICAgYmFja2dyb3VuZC1yZXBlYXQ6IG5vLXJlcGVhdDtcclxufVxyXG4ubGF5ZXIge1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYSgwLCAwLCAwLCAwLjcpO1xyXG4gICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgdG9wOiAwO1xyXG4gICAgbGVmdDogMDtcclxuICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbn1cclxuXHJcbi5mb250LW5vcm1hbCB7XHJcbiAgICBmb250LXdlaWdodDogbm9ybWFsICFpbXBvcnRhbnQ7XHJcbn1cclxuaDEsIGgyLCBoMywgaDQsIGg1LCBoNiB7XHJcbiAgICBmb250LWZhbWlseTogJ09wZW4gU2FucycsIHNhbnMtc2VyaWY7XHJcbiAgICBjb2xvcjogIzEzMTEzYTtcclxuICAgIGxpbmUtaGVpZ2h0OiAxLjI7XHJcbiAgICBtYXJnaW4tYm90dG9tOiAwO1xyXG4gICAgbWFyZ2luLXRvcDogMDtcclxuICAgIGZvbnQtd2VpZ2h0OiA3MDA7XHJcbn1cclxuaDEsIGgyLCBoMywgaDQsIGg1LCBoNiB7XHJcbiAgICBsaW5lLWhlaWdodDogMS4yO1xyXG59XHJcbiJdfQ== */";
    /***/
  },

  /***/
  "./src/app/contributor-sign-up/contributor-sign-up.component.ts":
  /*!**********************************************************************!*\
    !*** ./src/app/contributor-sign-up/contributor-sign-up.component.ts ***!
    \**********************************************************************/

  /*! exports provided: ContributorSignUpComponent */

  /***/
  function srcAppContributorSignUpContributorSignUpComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ContributorSignUpComponent", function () {
      return ContributorSignUpComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/fesm2015/forms.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var rxjs_operators__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! rxjs/operators */
    "./node_modules/rxjs/_esm2015/operators/index.js");

    var ContributorSignUpComponent =
    /*#__PURE__*/
    function () {
      function ContributorSignUpComponent(router, formBuilder, authenticationService) {
        _classCallCheck(this, ContributorSignUpComponent);

        this.router = router;
        this.formBuilder = formBuilder;
        this.authenticationService = authenticationService;
        this.showloginPopup = false;
        this.submitted = false;
        this.loading = false;
        this.fileToUpload = null;
        this.form = new FormData();
        this.error_message = null;
        this.success_message = null;
        this.loadingData = false;
        this.otp = false;
        this.completflag = false;
      }

      _createClass(ContributorSignUpComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.contributorForm = this.formBuilder.group({
            contributor_fname: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            contributor_lname: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            contributor_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            contributor_email: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].email]],
            contributor_mobile: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].pattern(/^[6-9]\d{9}$/)]],
            contributor_password: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].minLength(6)]],
            contributor_type: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            contributor_idproof: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            bank_holder_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            bank_account_number: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].pattern(/[0-9]/)]],
            ifsc_number: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            bank_name: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required]],
            contributor_acceptTerms: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required]
          });
          this.contributorotpForm = this.formBuilder.group({
            otp: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required]
          });
        }
      }, {
        key: "clickLoginPopup",
        value: function clickLoginPopup() {
          this.showloginPopup = true;
        }
      }, {
        key: "handleFileInput",
        value: function handleFileInput(files) {
          //const form = new FormData();
          //this.fileToUpload = files.item(0);
          //this.formData.append( "file", file[i], file[i]['name'] );
          for (var i = 0; i < files.length; i++) {
            console.log(files[i]);
            console.log(files[i]['name']);
            this.form.append("image", files[i], files[i]['name']);
          }

          console.log(this.form);
        }
      }, {
        key: "onSubmit",
        value: function onSubmit() {
          var _this9 = this;

          this.submitted = true; // stop here if form is invalid

          if (this.contributorForm.invalid) {
            console.log('at invalid');
            console.log(this.contributorForm);
            return;
          }

          this.loadingData = true;
          this.form.append('Info', JSON.stringify(this.contributorForm.value)); //var options = { content: this.form };
          //console.log(options);

          this.authenticationService.contributorRegister(this.form).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_5__["first"])()).subscribe(function (data2) {
            console.log(data2);
            _this9.loadingData = false;

            if (data2.status == '1') {
              _this9.otp = true;
              _this9.error_message = null;
              _this9.success_message = data2.message;
            } else {
              _this9.otp = false;
              _this9.success_message = null;
              _this9.error_message = data2.message;
            }
          }, function (error) {
            _this9.loading = false;
          });
        }
      }, {
        key: "resend_otp",
        value: function resend_otp() {
          var _this10 = this;

          this.loadingData = true;
          var email = this.contributorForm.controls['contributor_email'].value;
          var mobile = this.contributorForm.controls['contributor_mobile'].value;
          this.authenticationService.resendOtp(email, mobile).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_5__["first"])()).subscribe(function (data2) {
            console.log(data2);
            _this10.loadingData = false;

            if (data2.status == '1') {
              _this10.error_message = null;
              _this10.success_message = data2.message;
            } else {
              _this10.success_message = null;
              _this10.error_message = data2.message;
            }
          }, function (error) {
            _this10.loading = false;
          });
        }
      }, {
        key: "onSubmitotp",
        value: function onSubmitotp() {
          var _this11 = this;

          this.submitted = true; // stop here if form is invalid

          if (this.contributorotpForm.invalid) {
            console.log('at invalid');
            console.log(this.contributorotpForm);
            return;
          }

          this.loadingData = true;
          var email = this.contributorForm.controls['contributor_email'].value;
          var mobile = this.contributorForm.controls['contributor_mobile'].value;
          this.authenticationService.verifyOtp(email, mobile, this.contributorotpForm.value).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_5__["first"])()).subscribe(function (data2) {
            console.log(data2);
            _this11.loadingData = false;

            if (data2.status == '1') {
              _this11.error_message = null;

              _this11.contributorotpForm.reset();

              _this11.completflag = true;
              _this11.success_message = data2.message;
            } else {
              _this11.success_message = null;
              _this11.error_message = data2.message;
            }
          }, function (error) {
            _this11.loading = false;
          });
        }
      }, {
        key: "hideLoginPopup",
        value: function hideLoginPopup(event) {
          this.showloginPopup = false;

          if (event) {
            this.router.navigate(['']);
          }
        }
      }, {
        key: "f",
        get: function get() {
          return this.contributorForm.controls;
        }
      }, {
        key: "o",
        get: function get() {
          return this.contributorotpForm.controls;
        }
      }]);

      return ContributorSignUpComponent;
    }();

    ContributorSignUpComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormBuilder"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"]
      }];
    };

    ContributorSignUpComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'contributor-sign-up',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./contributor-sign-up.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/contributor-sign-up/contributor-sign-up.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./contributor-sign-up.component.css */
      "./src/app/contributor-sign-up/contributor-sign-up.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormBuilder"], _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"]])], ContributorSignUpComponent);
    /***/
  },

  /***/
  "./src/app/dashboard/dashboard.component.css":
  /*!***************************************************!*\
    !*** ./src/app/dashboard/dashboard.component.css ***!
    \***************************************************/

  /*! exports provided: default */

  /***/
  function srcAppDashboardDashboardComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".loader-bg{background:rgba(0,0,0,0.9); position: fixed; width: 100%; height: 100%; z-index: 999999; overflow: hidden; top: 0;} \r\n\r\n.loader{\r\n  position: absolute;\r\n  top: 50%;\r\n  left: 50%;\r\n  -webkit-transform: translate(-50%,-50%);\r\n      -ms-transform: translate(-50%,-50%);\r\n          transform: translate(-50%,-50%); \r\n  width: 150px;\r\n  height: 150px;\r\n  background: transparent;\r\n  border: 3px solid #3c3c3c;\r\n  border-radius: 50%;\r\n  text-align: center;\r\n  line-height: 150px;\r\n  font-size: 20px;\r\n  color: #fff000;\r\n  letter-spacing:4px;\r\n  text-transform: uppercase;\r\n  text-shadow:0 0 10px #fff000;\r\n  box-shadow: 0 0 20px rgba(0,0,0,.5);\r\n      z-index: 9999;\r\n} \r\n\r\n.loader:before {\r\n  content: '';\r\n  position: absolute;\r\n  top: -3px;\r\n  left: -3px;\r\n  width: 100%;\r\n  height: 100%;\r\n  border: 3px solid transparent;\r\n  border-top: 3px solid #fff000;\r\n  border-right: 3px solid #fff000;\r\n  border-radius: 50%;\r\n  -webkit-animation: animateCircle 2s linear infinite;\r\n          animation: animateCircle 2s linear infinite;\r\n} \r\n\r\n.loader span {\r\n  display: block;\r\n  position: absolute;\r\n  top: calc(50% - 2px);\r\n  left: 50%;\r\n  width: 50%;\r\n  height: 4px;\r\n  background: transparent;\r\n  -webkit-transform-origin:left;\r\n      -ms-transform-origin:left;\r\n          transform-origin:left;\r\n  -webkit-animation: animate 2s linear infinite;\r\n          animation: animate 2s linear infinite;\r\n} \r\n\r\n.loader span:before {\r\n  content:'';\r\n  position: absolute;\r\n  width: 16px;\r\n  height: 16px;\r\n  border-radius: 50%;\r\n  background-color: #fff000;\r\n  top: -6px;\r\n  right: -8px;\r\n  box-shadow: 0 0 20px #fff000;\r\n} \r\n\r\n@-webkit-keyframes animateCircle\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(0deg);\r\n            transform: rotate(0deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(360deg);\r\n            transform: rotate(360deg);\r\n  }\r\n} \r\n\r\n@keyframes animateCircle\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(0deg);\r\n            transform: rotate(0deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(360deg);\r\n            transform: rotate(360deg);\r\n  }\r\n} \r\n\r\n@-webkit-keyframes animate\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(45deg);\r\n            transform: rotate(45deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(405deg);\r\n            transform: rotate(405deg);\r\n  }\r\n} \r\n\r\n@keyframes animate\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(45deg);\r\n            transform: rotate(45deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(405deg);\r\n            transform: rotate(405deg);\r\n  }\r\n} \r\n\r\n.dropdown-menu{\r\n\t        top: -232px !important;\r\n}\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvZGFzaGJvYXJkL2Rhc2hib2FyZC5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLFdBQVcsMEJBQTBCLEVBQUUsZUFBZSxFQUFFLFdBQVcsRUFBRSxZQUFZLEVBQUUsZUFBZSxFQUFFLGdCQUFnQixFQUFFLE1BQU0sQ0FBQzs7QUFFN0g7RUFDRSxrQkFBa0I7RUFDbEIsUUFBUTtFQUNSLFNBQVM7RUFDVCx1Q0FBK0I7TUFBL0IsbUNBQStCO1VBQS9CLCtCQUErQjtFQUMvQixZQUFZO0VBQ1osYUFBYTtFQUNiLHVCQUF1QjtFQUN2Qix5QkFBeUI7RUFDekIsa0JBQWtCO0VBQ2xCLGtCQUFrQjtFQUNsQixrQkFBa0I7RUFDbEIsZUFBZTtFQUNmLGNBQWM7RUFDZCxrQkFBa0I7RUFDbEIseUJBQXlCO0VBQ3pCLDRCQUE0QjtFQUM1QixtQ0FBbUM7TUFDL0IsYUFBYTtBQUNuQjs7QUFDQTtFQUNFLFdBQVc7RUFDWCxrQkFBa0I7RUFDbEIsU0FBUztFQUNULFVBQVU7RUFDVixXQUFXO0VBQ1gsWUFBWTtFQUNaLDZCQUE2QjtFQUM3Qiw2QkFBNkI7RUFDN0IsK0JBQStCO0VBQy9CLGtCQUFrQjtFQUNsQixtREFBMkM7VUFBM0MsMkNBQTJDO0FBQzdDOztBQUNBO0VBQ0UsY0FBYztFQUNkLGtCQUFrQjtFQUNsQixvQkFBb0I7RUFDcEIsU0FBUztFQUNULFVBQVU7RUFDVixXQUFXO0VBQ1gsdUJBQXVCO0VBQ3ZCLDZCQUFxQjtNQUFyQix5QkFBcUI7VUFBckIscUJBQXFCO0VBQ3JCLDZDQUFxQztVQUFyQyxxQ0FBcUM7QUFDdkM7O0FBQ0E7RUFDRSxVQUFVO0VBQ1Ysa0JBQWtCO0VBQ2xCLFdBQVc7RUFDWCxZQUFZO0VBQ1osa0JBQWtCO0VBQ2xCLHlCQUF5QjtFQUN6QixTQUFTO0VBQ1QsV0FBVztFQUNYLDRCQUE0QjtBQUM5Qjs7QUFFQzs7RUFFQzs7SUFFRSwrQkFBdUI7WUFBdkIsdUJBQXVCO0VBQ3pCO0VBQ0E7O0lBRUUsaUNBQXlCO1lBQXpCLHlCQUF5QjtFQUMzQjtBQUNGOztBQVZDOztFQUVDOztJQUVFLCtCQUF1QjtZQUF2Qix1QkFBdUI7RUFDekI7RUFDQTs7SUFFRSxpQ0FBeUI7WUFBekIseUJBQXlCO0VBQzNCO0FBQ0Y7O0FBQ0E7O0VBRUU7O0lBRUUsZ0NBQXdCO1lBQXhCLHdCQUF3QjtFQUMxQjtFQUNBOztJQUVFLGlDQUF5QjtZQUF6Qix5QkFBeUI7RUFDM0I7QUFDRjs7QUFWQTs7RUFFRTs7SUFFRSxnQ0FBd0I7WUFBeEIsd0JBQXdCO0VBQzFCO0VBQ0E7O0lBRUUsaUNBQXlCO1lBQXpCLHlCQUF5QjtFQUMzQjtBQUNGOztBQUNBO1NBQ1Msc0JBQXNCO0FBQy9CIiwiZmlsZSI6InNyYy9hcHAvZGFzaGJvYXJkL2Rhc2hib2FyZC5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLmxvYWRlci1iZ3tiYWNrZ3JvdW5kOnJnYmEoMCwwLDAsMC45KTsgcG9zaXRpb246IGZpeGVkOyB3aWR0aDogMTAwJTsgaGVpZ2h0OiAxMDAlOyB6LWluZGV4OiA5OTk5OTk7IG92ZXJmbG93OiBoaWRkZW47IHRvcDogMDt9IFxyXG5cclxuLmxvYWRlcntcclxuICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgdG9wOiA1MCU7XHJcbiAgbGVmdDogNTAlO1xyXG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlKC01MCUsLTUwJSk7IFxyXG4gIHdpZHRoOiAxNTBweDtcclxuICBoZWlnaHQ6IDE1MHB4O1xyXG4gIGJhY2tncm91bmQ6IHRyYW5zcGFyZW50O1xyXG4gIGJvcmRlcjogM3B4IHNvbGlkICMzYzNjM2M7XHJcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICBsaW5lLWhlaWdodDogMTUwcHg7XHJcbiAgZm9udC1zaXplOiAyMHB4O1xyXG4gIGNvbG9yOiAjZmZmMDAwO1xyXG4gIGxldHRlci1zcGFjaW5nOjRweDtcclxuICB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlO1xyXG4gIHRleHQtc2hhZG93OjAgMCAxMHB4ICNmZmYwMDA7XHJcbiAgYm94LXNoYWRvdzogMCAwIDIwcHggcmdiYSgwLDAsMCwuNSk7XHJcbiAgICAgIHotaW5kZXg6IDk5OTk7XHJcbn1cclxuLmxvYWRlcjpiZWZvcmUge1xyXG4gIGNvbnRlbnQ6ICcnO1xyXG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICB0b3A6IC0zcHg7XHJcbiAgbGVmdDogLTNweDtcclxuICB3aWR0aDogMTAwJTtcclxuICBoZWlnaHQ6IDEwMCU7XHJcbiAgYm9yZGVyOiAzcHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgYm9yZGVyLXRvcDogM3B4IHNvbGlkICNmZmYwMDA7XHJcbiAgYm9yZGVyLXJpZ2h0OiAzcHggc29saWQgI2ZmZjAwMDtcclxuICBib3JkZXItcmFkaXVzOiA1MCU7XHJcbiAgYW5pbWF0aW9uOiBhbmltYXRlQ2lyY2xlIDJzIGxpbmVhciBpbmZpbml0ZTtcclxufVxyXG4ubG9hZGVyIHNwYW4ge1xyXG4gIGRpc3BsYXk6IGJsb2NrO1xyXG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICB0b3A6IGNhbGMoNTAlIC0gMnB4KTtcclxuICBsZWZ0OiA1MCU7XHJcbiAgd2lkdGg6IDUwJTtcclxuICBoZWlnaHQ6IDRweDtcclxuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcclxuICB0cmFuc2Zvcm0tb3JpZ2luOmxlZnQ7XHJcbiAgYW5pbWF0aW9uOiBhbmltYXRlIDJzIGxpbmVhciBpbmZpbml0ZTtcclxufVxyXG4ubG9hZGVyIHNwYW46YmVmb3JlIHtcclxuICBjb250ZW50OicnO1xyXG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICB3aWR0aDogMTZweDtcclxuICBoZWlnaHQ6IDE2cHg7XHJcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmYwMDA7XHJcbiAgdG9wOiAtNnB4O1xyXG4gIHJpZ2h0OiAtOHB4O1xyXG4gIGJveC1zaGFkb3c6IDAgMCAyMHB4ICNmZmYwMDA7XHJcbn1cclxuXHJcbiBAa2V5ZnJhbWVzIGFuaW1hdGVDaXJjbGVcclxue1xyXG4gIDAlXHJcbiAge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoMGRlZyk7XHJcbiAgfVxyXG4gIDEwMCVcclxuICB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgzNjBkZWcpO1xyXG4gIH1cclxufVxyXG5Aa2V5ZnJhbWVzIGFuaW1hdGVcclxue1xyXG4gIDAlXHJcbiAge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gIH1cclxuICAxMDAlXHJcbiAge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoNDA1ZGVnKTtcclxuICB9XHJcbn1cclxuLmRyb3Bkb3duLW1lbnV7XHJcblx0ICAgICAgICB0b3A6IC0yMzJweCAhaW1wb3J0YW50O1xyXG59Il19 */";
    /***/
  },

  /***/
  "./src/app/dashboard/dashboard.component.ts":
  /*!**************************************************!*\
    !*** ./src/app/dashboard/dashboard.component.ts ***!
    \**************************************************/

  /*! exports provided: DashboardComponent */

  /***/
  function srcAppDashboardDashboardComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "DashboardComponent", function () {
      return DashboardComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _hero__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../hero */
    "./src/app/hero.ts");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ../_helpers/image-footer-helper */
    "./src/app/_helpers/image-footer-helper.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");

    var DashboardComponent =
    /*#__PURE__*/
    function () {
      function DashboardComponent(heroService, dataHelper, myElement, router) {
        var _this12 = this;

        _classCallCheck(this, DashboardComponent);

        this.heroService = heroService;
        this.dataHelper = dataHelper;
        this.myElement = myElement;
        this.router = router;
        this.heroes = [];
        this.carouselSliderImages = [];
        this.aoslSliderImages = [];
        this.aoslSliderImagesData = [];
        this.randomNumber = 0;
        this.searchBoxLabel = 1;
        this.page = 1;
        this.pageSize = 32;
        this.aosSliderSizes = [];

        this.onPageChange = function (pageNumber) {
          var el = _this12.myElement.nativeElement.querySelector('ngb-carousel');

          el.scrollIntoView();
        };
      }

      _createClass(DashboardComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this13 = this;

          this.heroService.getcarouselSliderImages().subscribe(function (data) {
            var _carouselSlider = new _hero__WEBPACK_IMPORTED_MODULE_2__["carouselSlider"]();

            var _carouselSliderArray = new Array();

            _carouselSlider.id = 1;
            _carouselSlider.categoryNames = data["0"]; // [{id: data[], name: 'Skin Care'}, {id: 2, name: 'Cannabis'}, {
            //     id: 3,
            //     name: 'Business'
            // }, {id: 4, name: 'Curated'}, {id: 5, name: 'Video'}, {id: 6, name: 'Autumn'}]

            _carouselSliderArray.push(_carouselSlider);

            var _carouselSlider1 = new _hero__WEBPACK_IMPORTED_MODULE_2__["carouselSlider"]();

            _carouselSlider1.id = 2;
            _carouselSlider1.categoryNames = data["1"]; //     [{id: 11, name: 'Dr Nice'}, {id: 12, name: 'Narco'}, {
            //     id: 13,
            //     name: 'Bombasto'
            // }, {id: 14, name: 'Celeritas'}, {id: 15, name: 'Magneta'}, {id: 16, name: 'RubberMan'}]

            _carouselSliderArray.push(_carouselSlider1);

            var _carouselSlider2 = new _hero__WEBPACK_IMPORTED_MODULE_2__["carouselSlider"]();

            _carouselSlider2.id = 3;
            _carouselSlider2.categoryNames = data["2"]; //     [{id: 21, name: 'Family'}, {id: 22, name: 'Halloween'}, {
            //     id: 23,
            //     name: 'Seniors'
            // }, {id: 24, name: 'Cats & Dogs'}, {id: 25, name: 'Time to Party'}, {id: 26, name: 'Food'}]

            _carouselSliderArray.push(_carouselSlider2);

            var _carouselSlider3 = new _hero__WEBPACK_IMPORTED_MODULE_2__["carouselSlider"]();

            _carouselSlider3.id = 4;
            _carouselSlider3.categoryNames = data["3"]; //     [{id: 31, name: 'The Digital Frontier'}, {
            //     id: 32,
            //     name: 'Christmas'
            // }, {id: 33, name: 'Real People & Places'}, {id: 34, name: 'Art & Concept'}, {
            //     id: 35,
            //     name: 'Magma'
            // }, {id: 36, name: 'Tornado'}]

            _carouselSliderArray.push(_carouselSlider3);

            _this13.carouselSliderImages = _carouselSliderArray;
            ;
          }); //console.log( this.carouselSliderImages);
          // .subscribe(carouselSliderImages => {
          //   console.log(carouselSliderImages);
          //   this.carouselSliderImages = carouselSliderImages;
          // });

          this.heroService.getAosSliderImages().subscribe(function (aoslSliderImages) {
            // console.log(aoslSliderImages);
            _this13.aoslSliderImages = aoslSliderImages;
            _this13.aoslSliderImagesData = aoslSliderImages;

            _this13.maintainAosSlider();
          });
        }
      }, {
        key: "getClassName",
        value: function getClassName(ele) {
          //return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
          return 'col-6 col-md-3 col-lg-3';
        }
      }, {
        key: "searchAosData",
        value: function searchAosData(search) {
          // debounceTime(400),
          if (search.trim().length > 2) {
            this.router.navigate(['/search'], {
              queryParams: {
                type: this.searchBoxLabel,
                keyword: search.trim()
              }
            });
          }
        }
      }, {
        key: "maintainAosSlider",
        value: function maintainAosSlider() {
          var _this14 = this;

          var i = 4,
              j = 0;
          var randArr = [[3, 2, 3, 4], [5, 2, 3, 2], [4, 3, 2, 3], [2, 2, 4, 4], [3, 3, 4, 2], [4, 4, 2, 2], [3, 4, 2, 3], [3, 3, 3, 3], [4, 2, 4, 2], [3, 4, 3, 2]];
          var mathRandom = Math.floor(Math.random() * 10);
          this.aoslSliderImagesData.forEach(function (ele) {
            if (i > j) {
              // console.log(mathRandom)
              ele.eleClass = randArr[mathRandom][j];
              j = j + 1;

              if (j == i) {
                _this14.dataHelper.shuffleArray(randArr);

                j = 0;
                mathRandom = Math.floor(Math.random() * 10);
              }
            }
          });
        }
      }, {
        key: "searchDropDownClick",
        value: function searchDropDownClick(type) {
          this.searchBoxLabel = type;
        }
      }, {
        key: "returnonposter",
        value: function returnonposter(footage) {
          console.log('hello'); //console.log(footage);
          //let posterUrl = footage.getAttribute('poster');
          //console.log(posterUrl);

          footage.load();
          footage.play(); //let posterUrl = footage.getAttribute('poster');
          // footage.getAttribute('poster','');
          // footage.setAttribute('poster',posterUrl);
        }
      }, {
        key: "returnonposterpause",
        value: function returnonposterpause(footage) {
          footage.pause(); //alert ('hi');
        }
      }]);

      return DashboardComponent;
    }();

    DashboardComponent.ctorParameters = function () {
      return [{
        type: _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"]
      }, {
        type: _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__["imageFooterHelper"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]
      }];
    };

    DashboardComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-dashboard',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./dashboard.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/dashboard/dashboard.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./dashboard.component.css */
      "./src/app/dashboard/dashboard.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__["imageFooterHelper"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"], _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]])], DashboardComponent);
    /***/
  },

  /***/
  "./src/app/footer/footer.component.css":
  /*!*********************************************!*\
    !*** ./src/app/footer/footer.component.css ***!
    \*********************************************/

  /*! exports provided: default */

  /***/
  function srcAppFooterFooterComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2Zvb3Rlci9mb290ZXIuY29tcG9uZW50LmNzcyJ9 */";
    /***/
  },

  /***/
  "./src/app/footer/footer.component.ts":
  /*!********************************************!*\
    !*** ./src/app/footer/footer.component.ts ***!
    \********************************************/

  /*! exports provided: FooterComponent */

  /***/
  function srcAppFooterFooterComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "FooterComponent", function () {
      return FooterComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var FooterComponent =
    /*#__PURE__*/
    function () {
      function FooterComponent() {
        _classCallCheck(this, FooterComponent);
      }

      _createClass(FooterComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }]);

      return FooterComponent;
    }();

    FooterComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-footer',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./footer.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/footer/footer.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./footer.component.css */
      "./src/app/footer/footer.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])], FooterComponent);
    /***/
  },

  /***/
  "./src/app/header/header.component.css":
  /*!*********************************************!*\
    !*** ./src/app/header/header.component.css ***!
    \*********************************************/

  /*! exports provided: default */

  /***/
  function srcAppHeaderHeaderComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".loader-bg{background:rgba(0,0,0,0.9); position: fixed; width: 100%; height: 100%; z-index: 999999; overflow: hidden; top: 0;} \r\n\r\n.loader{\r\n  position: absolute;\r\n  top: 50%;\r\n  left: 50%;\r\n  -webkit-transform: translate(-50%,-50%);\r\n      -ms-transform: translate(-50%,-50%);\r\n          transform: translate(-50%,-50%); \r\n  width: 150px;\r\n  height: 150px;\r\n  background: transparent;\r\n  border: 3px solid #3c3c3c;\r\n  border-radius: 50%;\r\n  text-align: center;\r\n  line-height: 150px;\r\n  font-size: 20px;\r\n  color: #fff000;\r\n  letter-spacing:4px;\r\n  text-transform: uppercase;\r\n  text-shadow:0 0 10px #fff000;\r\n  box-shadow: 0 0 20px rgba(0,0,0,.5);\r\n      z-index: 9999;\r\n} \r\n\r\n.loader:before {\r\n  content: '';\r\n  position: absolute;\r\n  top: -3px;\r\n  left: -3px;\r\n  width: 100%;\r\n  height: 100%;\r\n  border: 3px solid transparent;\r\n  border-top: 3px solid #fff000;\r\n  border-right: 3px solid #fff000;\r\n  border-radius: 50%;\r\n  -webkit-animation: animateCircle 2s linear infinite;\r\n          animation: animateCircle 2s linear infinite;\r\n} \r\n\r\n.loader span {\r\n  display: block;\r\n  position: absolute;\r\n  top: calc(50% - 2px);\r\n  left: 50%;\r\n  width: 50%;\r\n  height: 4px;\r\n  background: transparent;\r\n  -webkit-transform-origin:left;\r\n      -ms-transform-origin:left;\r\n          transform-origin:left;\r\n  -webkit-animation: animate 2s linear infinite;\r\n          animation: animate 2s linear infinite;\r\n} \r\n\r\n.loader span:before {\r\n  content:'';\r\n  position: absolute;\r\n  width: 16px;\r\n  height: 16px;\r\n  border-radius: 50%;\r\n  background-color: #fff000;\r\n  top: -6px;\r\n  right: -8px;\r\n  box-shadow: 0 0 20px #fff000;\r\n} \r\n\r\n@-webkit-keyframes animateCircle\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(0deg);\r\n            transform: rotate(0deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(360deg);\r\n            transform: rotate(360deg);\r\n  }\r\n} \r\n\r\n@keyframes animateCircle\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(0deg);\r\n            transform: rotate(0deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(360deg);\r\n            transform: rotate(360deg);\r\n  }\r\n} \r\n\r\n@-webkit-keyframes animate\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(45deg);\r\n            transform: rotate(45deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(405deg);\r\n            transform: rotate(405deg);\r\n  }\r\n} \r\n\r\n@keyframes animate\r\n{\r\n  0%\r\n  {\r\n    -webkit-transform: rotate(45deg);\r\n            transform: rotate(45deg);\r\n  }\r\n  100%\r\n  {\r\n    -webkit-transform: rotate(405deg);\r\n            transform: rotate(405deg);\r\n  }\r\n}\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaGVhZGVyL2hlYWRlci5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLFdBQVcsMEJBQTBCLEVBQUUsZUFBZSxFQUFFLFdBQVcsRUFBRSxZQUFZLEVBQUUsZUFBZSxFQUFFLGdCQUFnQixFQUFFLE1BQU0sQ0FBQzs7QUFFN0g7RUFDRSxrQkFBa0I7RUFDbEIsUUFBUTtFQUNSLFNBQVM7RUFDVCx1Q0FBK0I7TUFBL0IsbUNBQStCO1VBQS9CLCtCQUErQjtFQUMvQixZQUFZO0VBQ1osYUFBYTtFQUNiLHVCQUF1QjtFQUN2Qix5QkFBeUI7RUFDekIsa0JBQWtCO0VBQ2xCLGtCQUFrQjtFQUNsQixrQkFBa0I7RUFDbEIsZUFBZTtFQUNmLGNBQWM7RUFDZCxrQkFBa0I7RUFDbEIseUJBQXlCO0VBQ3pCLDRCQUE0QjtFQUM1QixtQ0FBbUM7TUFDL0IsYUFBYTtBQUNuQjs7QUFDQTtFQUNFLFdBQVc7RUFDWCxrQkFBa0I7RUFDbEIsU0FBUztFQUNULFVBQVU7RUFDVixXQUFXO0VBQ1gsWUFBWTtFQUNaLDZCQUE2QjtFQUM3Qiw2QkFBNkI7RUFDN0IsK0JBQStCO0VBQy9CLGtCQUFrQjtFQUNsQixtREFBMkM7VUFBM0MsMkNBQTJDO0FBQzdDOztBQUNBO0VBQ0UsY0FBYztFQUNkLGtCQUFrQjtFQUNsQixvQkFBb0I7RUFDcEIsU0FBUztFQUNULFVBQVU7RUFDVixXQUFXO0VBQ1gsdUJBQXVCO0VBQ3ZCLDZCQUFxQjtNQUFyQix5QkFBcUI7VUFBckIscUJBQXFCO0VBQ3JCLDZDQUFxQztVQUFyQyxxQ0FBcUM7QUFDdkM7O0FBQ0E7RUFDRSxVQUFVO0VBQ1Ysa0JBQWtCO0VBQ2xCLFdBQVc7RUFDWCxZQUFZO0VBQ1osa0JBQWtCO0VBQ2xCLHlCQUF5QjtFQUN6QixTQUFTO0VBQ1QsV0FBVztFQUNYLDRCQUE0QjtBQUM5Qjs7QUFFQzs7RUFFQzs7SUFFRSwrQkFBdUI7WUFBdkIsdUJBQXVCO0VBQ3pCO0VBQ0E7O0lBRUUsaUNBQXlCO1lBQXpCLHlCQUF5QjtFQUMzQjtBQUNGOztBQVZDOztFQUVDOztJQUVFLCtCQUF1QjtZQUF2Qix1QkFBdUI7RUFDekI7RUFDQTs7SUFFRSxpQ0FBeUI7WUFBekIseUJBQXlCO0VBQzNCO0FBQ0Y7O0FBQ0E7O0VBRUU7O0lBRUUsZ0NBQXdCO1lBQXhCLHdCQUF3QjtFQUMxQjtFQUNBOztJQUVFLGlDQUF5QjtZQUF6Qix5QkFBeUI7RUFDM0I7QUFDRjs7QUFWQTs7RUFFRTs7SUFFRSxnQ0FBd0I7WUFBeEIsd0JBQXdCO0VBQzFCO0VBQ0E7O0lBRUUsaUNBQXlCO1lBQXpCLHlCQUF5QjtFQUMzQjtBQUNGIiwiZmlsZSI6InNyYy9hcHAvaGVhZGVyL2hlYWRlci5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLmxvYWRlci1iZ3tiYWNrZ3JvdW5kOnJnYmEoMCwwLDAsMC45KTsgcG9zaXRpb246IGZpeGVkOyB3aWR0aDogMTAwJTsgaGVpZ2h0OiAxMDAlOyB6LWluZGV4OiA5OTk5OTk7IG92ZXJmbG93OiBoaWRkZW47IHRvcDogMDt9IFxyXG5cclxuLmxvYWRlcntcclxuICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgdG9wOiA1MCU7XHJcbiAgbGVmdDogNTAlO1xyXG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlKC01MCUsLTUwJSk7IFxyXG4gIHdpZHRoOiAxNTBweDtcclxuICBoZWlnaHQ6IDE1MHB4O1xyXG4gIGJhY2tncm91bmQ6IHRyYW5zcGFyZW50O1xyXG4gIGJvcmRlcjogM3B4IHNvbGlkICMzYzNjM2M7XHJcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICBsaW5lLWhlaWdodDogMTUwcHg7XHJcbiAgZm9udC1zaXplOiAyMHB4O1xyXG4gIGNvbG9yOiAjZmZmMDAwO1xyXG4gIGxldHRlci1zcGFjaW5nOjRweDtcclxuICB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlO1xyXG4gIHRleHQtc2hhZG93OjAgMCAxMHB4ICNmZmYwMDA7XHJcbiAgYm94LXNoYWRvdzogMCAwIDIwcHggcmdiYSgwLDAsMCwuNSk7XHJcbiAgICAgIHotaW5kZXg6IDk5OTk7XHJcbn1cclxuLmxvYWRlcjpiZWZvcmUge1xyXG4gIGNvbnRlbnQ6ICcnO1xyXG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICB0b3A6IC0zcHg7XHJcbiAgbGVmdDogLTNweDtcclxuICB3aWR0aDogMTAwJTtcclxuICBoZWlnaHQ6IDEwMCU7XHJcbiAgYm9yZGVyOiAzcHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgYm9yZGVyLXRvcDogM3B4IHNvbGlkICNmZmYwMDA7XHJcbiAgYm9yZGVyLXJpZ2h0OiAzcHggc29saWQgI2ZmZjAwMDtcclxuICBib3JkZXItcmFkaXVzOiA1MCU7XHJcbiAgYW5pbWF0aW9uOiBhbmltYXRlQ2lyY2xlIDJzIGxpbmVhciBpbmZpbml0ZTtcclxufVxyXG4ubG9hZGVyIHNwYW4ge1xyXG4gIGRpc3BsYXk6IGJsb2NrO1xyXG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICB0b3A6IGNhbGMoNTAlIC0gMnB4KTtcclxuICBsZWZ0OiA1MCU7XHJcbiAgd2lkdGg6IDUwJTtcclxuICBoZWlnaHQ6IDRweDtcclxuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcclxuICB0cmFuc2Zvcm0tb3JpZ2luOmxlZnQ7XHJcbiAgYW5pbWF0aW9uOiBhbmltYXRlIDJzIGxpbmVhciBpbmZpbml0ZTtcclxufVxyXG4ubG9hZGVyIHNwYW46YmVmb3JlIHtcclxuICBjb250ZW50OicnO1xyXG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICB3aWR0aDogMTZweDtcclxuICBoZWlnaHQ6IDE2cHg7XHJcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmYwMDA7XHJcbiAgdG9wOiAtNnB4O1xyXG4gIHJpZ2h0OiAtOHB4O1xyXG4gIGJveC1zaGFkb3c6IDAgMCAyMHB4ICNmZmYwMDA7XHJcbn1cclxuXHJcbiBAa2V5ZnJhbWVzIGFuaW1hdGVDaXJjbGVcclxue1xyXG4gIDAlXHJcbiAge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoMGRlZyk7XHJcbiAgfVxyXG4gIDEwMCVcclxuICB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgzNjBkZWcpO1xyXG4gIH1cclxufVxyXG5Aa2V5ZnJhbWVzIGFuaW1hdGVcclxue1xyXG4gIDAlXHJcbiAge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gIH1cclxuICAxMDAlXHJcbiAge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoNDA1ZGVnKTtcclxuICB9XHJcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/header/header.component.ts":
  /*!********************************************!*\
    !*** ./src/app/header/header.component.ts ***!
    \********************************************/

  /*! exports provided: HeaderComponent */

  /***/
  function srcAppHeaderHeaderComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "HeaderComponent", function () {
      return HeaderComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var aos__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! aos */
    "./node_modules/aos/dist/aos.js");
    /* harmony import */


    var aos__WEBPACK_IMPORTED_MODULE_4___default =
    /*#__PURE__*/
    __webpack_require__.n(aos__WEBPACK_IMPORTED_MODULE_4__);

    var HeaderComponent =
    /*#__PURE__*/
    function () {
      function HeaderComponent( //  private window:Window,
      //  private document: Document,
      router, route, authenticationService) {
        var _this15 = this;

        _classCallCheck(this, HeaderComponent);

        this.router = router;
        this.route = route;
        this.authenticationService = authenticationService;
        this.showloginPopup = false;
        this.isCollapsed = true;
        this.keywordEle = ' ';
        this.authenticationService.currentUser.subscribe(function (x) {
          _this15.currentUser = x;
        });
      }
      /*
      @HostListener("window:scroll", [])
      onWindowScroll() {
        let number = this.window.pageYOffset || this.document.documentElement.scrollTop || this.document.body.scrollTop || 0;
        console.log(number);
        if (number > 100) {
        //  this.navIsFixed = true;
        } else if (this.navIsFixed &amp;&amp; number < 10) {
          this.navIsFixed = false;
        }
      }*/


      _createClass(HeaderComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this16 = this;

          aos__WEBPACK_IMPORTED_MODULE_4__["init"]();
          this.sub = this.route.queryParams.subscribe(function (params) {
            _this16.productType = params.type;
            _this16.keywordEle = params.keyword;
          });
        }
      }, {
        key: "searchDropDownClick",
        value: function searchDropDownClick(type) {
          this.productType = type;
        }
      }, {
        key: "onKeydown",
        value: function onKeydown(event) {
          if (event.key === "Enter") {
            this.router.navigate(['/search'], {
              queryParams: {
                type: this.productType,
                keyword: this.keywordEle.trim()
              }
            });
          }
        }
      }, {
        key: "clickLoginPopup",
        value: function clickLoginPopup() {
          this.showloginPopup = true;
        }
      }, {
        key: "hideLoginPopup",
        value: function hideLoginPopup(event) {
          this.showloginPopup = false;
          this.router.navigate(['/']);
        }
      }, {
        key: "logout",
        value: function logout() {
          this.authenticationService.logout();
          this.router.navigate(['']);
        }
      }]);

      return HeaderComponent;
    }();

    HeaderComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"]
      }];
    };

    tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)], HeaderComponent.prototype, "dashboardCssEle", void 0);
    tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)], HeaderComponent.prototype, "footerCssEle", void 0);
    tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)], HeaderComponent.prototype, "scrollEle", void 0);
    HeaderComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-header',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./header.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/header/header.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./header.component.css */
      "./src/app/header/header.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"], _hero_service__WEBPACK_IMPORTED_MODULE_3__["HeroService"]])], HeaderComponent);
    /***/
  },

  /***/
  "./src/app/hero-detail/hero-detail.component.css":
  /*!*******************************************************!*\
    !*** ./src/app/hero-detail/hero-detail.component.css ***!
    \*******************************************************/

  /*! exports provided: default */

  /***/
  function srcAppHeroDetailHeroDetailComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "nav#mainNav {\r\n    background: #000 !important;\r\n   /* padding-top: 25px;\r\n    padding-bottom: 25px;*/\r\n}\r\n#mainNav {\r\n    padding-bottom: 0px;\r\n    padding-top: 0px;\r\n    /*background: #000 !important;*/\r\n}\r\nbody {\r\n    padding-top: 0px !important;\r\n}\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaGVyby1kZXRhaWwvaGVyby1kZXRhaWwuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtJQUNJLDJCQUEyQjtHQUM1QjswQkFDdUI7QUFDMUI7QUFDQTtJQUNJLG1CQUFtQjtJQUNuQixnQkFBZ0I7SUFDaEIsK0JBQStCO0FBQ25DO0FBQ0E7SUFDSSwyQkFBMkI7QUFDL0IiLCJmaWxlIjoic3JjL2FwcC9oZXJvLWRldGFpbC9oZXJvLWRldGFpbC5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsibmF2I21haW5OYXYge1xyXG4gICAgYmFja2dyb3VuZDogIzAwMCAhaW1wb3J0YW50O1xyXG4gICAvKiBwYWRkaW5nLXRvcDogMjVweDtcclxuICAgIHBhZGRpbmctYm90dG9tOiAyNXB4OyovXHJcbn1cclxuI21haW5OYXYge1xyXG4gICAgcGFkZGluZy1ib3R0b206IDBweDtcclxuICAgIHBhZGRpbmctdG9wOiAwcHg7XHJcbiAgICAvKmJhY2tncm91bmQ6ICMwMDAgIWltcG9ydGFudDsqL1xyXG59XHJcbmJvZHkge1xyXG4gICAgcGFkZGluZy10b3A6IDBweCAhaW1wb3J0YW50O1xyXG59Il19 */";
    /***/
  },

  /***/
  "./src/app/hero-detail/hero-detail.component.ts":
  /*!******************************************************!*\
    !*** ./src/app/hero-detail/hero-detail.component.ts ***!
    \******************************************************/

  /*! exports provided: HeroDetailComponent */

  /***/
  function srcAppHeroDetailHeroDetailComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "HeroDetailComponent", function () {
      return HeroDetailComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/common */
    "./node_modules/@angular/common/fesm2015/common.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ../_helpers/image-footer-helper */
    "./src/app/_helpers/image-footer-helper.ts");
    /* harmony import */


    var util__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! util */
    "./node_modules/util/util.js");
    /* harmony import */


    var util__WEBPACK_IMPORTED_MODULE_6___default =
    /*#__PURE__*/
    __webpack_require__.n(util__WEBPACK_IMPORTED_MODULE_6__);
    /* harmony import */


    var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/platform-browser */
    "./node_modules/@angular/platform-browser/fesm2015/platform-browser.js");

    var HeroDetailComponent =
    /*#__PURE__*/
    function () {
      function HeroDetailComponent(route, heroService, location, dataHelper, authenticationService, router, sanitizer) {
        var _this17 = this;

        _classCallCheck(this, HeroDetailComponent);

        this.route = route;
        this.heroService = heroService;
        this.location = location;
        this.dataHelper = dataHelper;
        this.authenticationService = authenticationService;
        this.router = router;
        this.sanitizer = sanitizer;
        this.aoslSliderImagesData = [];
        this.page = 1;
        this.pageSize = 5;
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
        this.standardTab = true;
        this.extendedTab = false;
        this.keyword = [];
        this.loadingData = false;
        this.imagefootId = '';
        this.authenticationService.currentUser.subscribe(function (x) {
          _this17.currentUser = x;
        });
      }

      _createClass(HeroDetailComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this18 = this;

          //this.spinner.show();
          this.loadingData = true; //this.getcategoryCarouselImages();

          this.getDetailinfo();
          this.authenticationService.currentUser.subscribe(function (x) {
            _this18.currentUser = x;
          }); // this.heroService.getMarketdeatils()
          //  .subscribe(data => {
          //    this.marketDetails = data;
          //  });

          var id = +this.route.snapshot.paramMap.get('id');
          var webtype = +this.route.snapshot.paramMap.get('webtype');
          var type = this.route.snapshot.paramMap.get('type');
          this.heroService.getDetailPagedetails(id, webtype, type).subscribe(function (data) {
            console.log(data);

            if (webtype == 2) {// this.detailPageInfo = data[0];
              // this.imagefootId = data[1];
              // let keywords  = this.detailPageInfo['metadata']['keywords_top10'];
              // this.keyword = keywords.split(",").map(item => item.trim());
              // this.filePreview = data[2];
              //this.base64changefunction(this.detailPageInfo['media']['preview_url_no_wm']);
            } else if (webtype == 3) {} // this.detailPageInfo = data;
            // let keywords  = this.detailPageInfo[0].items[0].kw;
            // this.keyword = keywords.split(",").map(item => item.trim());
            //this.keyword = keywords.split(',',10);
            //this.spinner.hide();


            _this18.loadingData = false;
          });
        }
      }, {
        key: "getDetailinfo",
        value: function getDetailinfo() {
          var _this19 = this;

          this.id = +this.route.snapshot.paramMap.get('id');
          this.webtype = +this.route.snapshot.paramMap.get('webtype');
          this.type = this.route.snapshot.paramMap.get('type');
          this.heroService.getDetailPagedetails(this.id, this.webtype, this.type).subscribe(function (data) {
            console.log(data);

            if (_this19.webtype == 2) {
              _this19.detailPageInfo = data[0];
              _this19.imagefootId = data[1];
              var keywords = _this19.detailPageInfo['metadata']['keywords_top10'];
              _this19.keyword = keywords.split(",").map(function (item) {
                return item.trim();
              });
              _this19.filePreview = data[2]; //this.base64changefunction(this.detailPageInfo['media']['preview_url_no_wm']);
            } else if (_this19.webtype == 3) {
              _this19.detailPageInfo = data;
              var _keywords = _this19.detailPageInfo[0].items[0].kw;
              _this19.keyword = _keywords.split(",").map(function (item) {
                return item.trim();
              });
            } //this.keyword = keywords.split(',',10);
            //this.spinner.hide();


            _this19.loadingData = false;
          });
        }
      }, {
        key: "checkout",
        value: function checkout() {
          this.router.navigate(['/checkout']);
        }
      }, {
        key: "getcategoryCarouselImages",
        value: function getcategoryCarouselImages() {
          var _this20 = this;

          var id = +this.route.snapshot.paramMap.get('id');
          this.heroService.getAosSliderImages().subscribe(function (aoslSliderImages) {
            if (!Object(util__WEBPACK_IMPORTED_MODULE_6__["isNullOrUndefined"])(aoslSliderImages)) {
              _this20.carouselSliderImages = aoslSliderImages;
              var randArr = [4, 3, 2, 3];

              var tempCarouselSlider = _this20.chunkArray(_this20.carouselSliderImages.categoryImages, 4);

              _this20.carouselSliderImages.categoryImages = JSON.parse(JSON.stringify(tempCarouselSlider));

              for (var i = 0; i < _this20.carouselSliderImages.categoryImages.length; i++) {
                if (_this20.carouselSliderImages.categoryImages[i].length < 4) {
                  var lessItem = 4 - _this20.carouselSliderImages.categoryImages[i].length;
                  var newArray = tempCarouselSlider[0].splice(0, lessItem);
                  _this20.carouselSliderImages.categoryImages[i] = _this20.carouselSliderImages.categoryImages[i].concat(newArray);
                }
              }

              _this20.carouselSliderImages.categoryImages.forEach(function (element) {
                var temp = 0;

                _this20.dataHelper.shuffleArray(randArr);

                element.forEach(function (ele) {
                  ele.eleClass = randArr[temp];
                  temp = temp + 1;
                });
              });
            }
          });
        }
      }, {
        key: "getClassName",
        value: function getClassName(ele) {
          return 'col-6 col-md-' + ele.eleClass + ' col-lg-' + ele.eleClass;
        }
      }, {
        key: "addToCheckoutItem",
        value: function addToCheckoutItem(productinfo, cartproduct, total, extended, type) {
          var _this21 = this;

          if (!this.currentUser) {
            this.showloginPopup = true;
            localStorage.setItem('beforeLoginCart', JSON.stringify({
              productinfo: productinfo,
              cartproduct: cartproduct,
              total: total,
              extended: extended,
              type: type
            }));
          } else {
            if (cartproduct.length == 0) {
              alert("Please select size of product !!");
              return false;
            }

            this.loadingData = true;
            this.addedCartItem = !this.addedCartItem;
            this.token = localStorage.getItem('currentUser');
            var cartval = {
              "product_info": productinfo,
              "selected_product": cartproduct,
              "total": total,
              "extended": extended,
              "token": this.token,
              "type": type
            };
            this.heroService.addcartItemsData(cartval).subscribe(function (data) {
              console.log(data);

              _this21.checkoutArray.push(cartval);

              if (data["status"] == '1') {
                _this21.loadingData = false;
                localStorage.setItem('checkoutAray', _this21.checkoutArray);

                _this21.router.navigate(['/cart']);
              } else {
                _this21.loadingData = false;
                alert(data["message"]);
              }
            }); // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated
          }
        }
      }, {
        key: "checkPriceTotal",
        value: function checkPriceTotal(selectedPrice) {
          console.log(selectedPrice);
          this.currunt_selected_price = selectedPrice.price * 80;
          this.total = this.currunt_selected_price;
          this.extended_price = 0;
          this.standard = selectedPrice;
        }
      }, {
        key: "addExtendedPriceTotal",
        value: function addExtendedPriceTotal(selectedPrice) {
          this.extended_price = selectedPrice.price * 80;
          this.total = this.extended_price;
          this.currunt_selected_price = 0;
          this.extended = selectedPrice;
        }
      }, {
        key: "checkPriceTotalFootage",
        value: function checkPriceTotalFootage(selectedPrice) {
          console.log(selectedPrice);
          this.currunt_selected_price = selectedPrice.pr * 80;
          this.total = this.currunt_selected_price;
          this.standard = selectedPrice;
        }
        /* showCartLabel(){
           let addCart = this.checkoutArray.find(ele=>ele == this.id);
           if(isNullOrUndefined(addCart))
                 this.addedCartItem=false;
           else
             this.addedCartItem=true;
         }*/

      }, {
        key: "chunkArray",
        value: function chunkArray(myArray, chunk_size) {
          var results = [];

          while (myArray.length) {
            results.push(myArray.splice(0, chunk_size));
          }

          return results;
        }
      }, {
        key: "hideLoginPopup",
        value: function hideLoginPopup(event) {
          this.showloginPopup = false;

          if (event) {
            this.addToCheckoutItem(this.detailPageInfo, this.standard, this.total, this.extended, '2');
          }
        }
      }, {
        key: "tabshow",
        value: function tabshow(type) {
          if (type == '1') {
            this.standardTab = true;
            this.extendedTab = false;
          } else if (type == '2') {
            this.standardTab = false;
            this.extendedTab = true;
          }
        }
      }, {
        key: "base64changefunction",
        value: function base64changefunction(fileUrl) {
          var _this22 = this;

          var reader = new FileReader();

          if (fileUrl) {
            var file = fileUrl;
            reader.readAsDataURL(file);

            reader.onload = function () {
              alert(reader.result.split(',')[1]);
              _this22.fileName = file.name + " " + file.type;
              _this22.filePreview = 'data:image/png' + ';base64,' + reader.result.split(',')[1];
            };
          }
        }
      }, {
        key: "sanitize",
        value: function sanitize(url) {
          //return url;
          return this.sanitizer.bypassSecurityTrustUrl(url);
        }
      }, {
        key: "addtolightbox",
        value: function addtolightbox(id) {
          var _this23 = this;

          console.log(id);
          this.loadingData = true;
          this.heroService.addWishListItemsData(id).subscribe(function (data) {
            if (data["status"] == '1') {
              _this23.loadingData = false;

              _this23.router.navigate(['/lightbox']);
            } else {
              _this23.loadingData = false;
              alert(data["message"]);
            }
          });
        }
      }]);

      return HeroDetailComponent;
    }();

    HeroDetailComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"]
      }, {
        type: _angular_common__WEBPACK_IMPORTED_MODULE_3__["Location"]
      }, {
        type: _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]
      }, {
        type: _angular_platform_browser__WEBPACK_IMPORTED_MODULE_7__["DomSanitizer"]
      }];
    };

    HeroDetailComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-hero-detail',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./hero-detail.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/hero-detail/hero-detail.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./hero-detail.component.css */
      "./src/app/hero-detail/hero-detail.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"], _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"], _angular_common__WEBPACK_IMPORTED_MODULE_3__["Location"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"], _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _angular_platform_browser__WEBPACK_IMPORTED_MODULE_7__["DomSanitizer"]])], HeroDetailComponent);
    /***/
  },

  /***/
  "./src/app/hero-search/hero-search.component.css":
  /*!*******************************************************!*\
    !*** ./src/app/hero-search/hero-search.component.css ***!
    \*******************************************************/

  /*! exports provided: default */

  /***/
  function srcAppHeroSearchHeroSearchComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\r\n\r\n/* HeroSearch private styles */\r\nbody{padding-top: 70px;}\r\n#mainNav{padding-bottom: 0px;padding-top: 0px;background: #000 !important;}\r\n.search-result li {\r\n  border-bottom: 1px solid gray;\r\n  border-left: 1px solid gray;\r\n  border-right: 1px solid gray;\r\n  width: 195px;\r\n  height: 16px;\r\n  padding: 5px;\r\n  background-color: white;\r\n  cursor: pointer;\r\n  list-style-type: none;\r\n}\r\n.search-result li:hover {\r\n  background-color: #607D8B;\r\n}\r\n.search-result li a {\r\n  color: #888;\r\n  display: block;\r\n  text-decoration: none;\r\n}\r\n.search-result li a:hover {\r\n  color: white;\r\n}\r\n.search-result li a:active {\r\n  color: white;\r\n}\r\n#search-box {\r\n  width: 200px;\r\n  height: 20px;\r\n}\r\nul.search-result {\r\n  margin-top: 0;\r\n  padding-left: 0;\r\n}\r\n.bg-dark search_menu_l{\r\n\tz-index:-1 !important;\r\n}\r\n\r\n\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaGVyby1zZWFyY2gvaGVyby1zZWFyY2guY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOztBQUVBLDhCQUE4QjtBQUM5QixLQUFLLGlCQUFpQixDQUFDO0FBQ3ZCLFNBQVMsbUJBQW1CLENBQUMsZ0JBQWdCLENBQUMsMkJBQTJCLENBQUM7QUFFMUU7RUFDRSw2QkFBNkI7RUFDN0IsMkJBQTJCO0VBQzNCLDRCQUE0QjtFQUM1QixZQUFZO0VBQ1osWUFBWTtFQUNaLFlBQVk7RUFDWix1QkFBdUI7RUFDdkIsZUFBZTtFQUNmLHFCQUFxQjtBQUN2QjtBQUVBO0VBQ0UseUJBQXlCO0FBQzNCO0FBRUE7RUFDRSxXQUFXO0VBQ1gsY0FBYztFQUNkLHFCQUFxQjtBQUN2QjtBQUVBO0VBQ0UsWUFBWTtBQUNkO0FBQ0E7RUFDRSxZQUFZO0FBQ2Q7QUFDQTtFQUNFLFlBQVk7RUFDWixZQUFZO0FBQ2Q7QUFHQTtFQUNFLGFBQWE7RUFDYixlQUFlO0FBQ2pCO0FBQ0E7Q0FDQyxxQkFBcUI7QUFDdEIiLCJmaWxlIjoic3JjL2FwcC9oZXJvLXNlYXJjaC9oZXJvLXNlYXJjaC5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiXHJcblxyXG4vKiBIZXJvU2VhcmNoIHByaXZhdGUgc3R5bGVzICovXHJcbmJvZHl7cGFkZGluZy10b3A6IDcwcHg7fVxyXG4jbWFpbk5hdntwYWRkaW5nLWJvdHRvbTogMHB4O3BhZGRpbmctdG9wOiAwcHg7YmFja2dyb3VuZDogIzAwMCAhaW1wb3J0YW50O31cclxuXHJcbi5zZWFyY2gtcmVzdWx0IGxpIHtcclxuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgZ3JheTtcclxuICBib3JkZXItbGVmdDogMXB4IHNvbGlkIGdyYXk7XHJcbiAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgZ3JheTtcclxuICB3aWR0aDogMTk1cHg7XHJcbiAgaGVpZ2h0OiAxNnB4O1xyXG4gIHBhZGRpbmc6IDVweDtcclxuICBiYWNrZ3JvdW5kLWNvbG9yOiB3aGl0ZTtcclxuICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgbGlzdC1zdHlsZS10eXBlOiBub25lO1xyXG59XHJcblxyXG4uc2VhcmNoLXJlc3VsdCBsaTpob3ZlciB7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogIzYwN0Q4QjtcclxufVxyXG5cclxuLnNlYXJjaC1yZXN1bHQgbGkgYSB7XHJcbiAgY29sb3I6ICM4ODg7XHJcbiAgZGlzcGxheTogYmxvY2s7XHJcbiAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG59XHJcblxyXG4uc2VhcmNoLXJlc3VsdCBsaSBhOmhvdmVyIHtcclxuICBjb2xvcjogd2hpdGU7XHJcbn1cclxuLnNlYXJjaC1yZXN1bHQgbGkgYTphY3RpdmUge1xyXG4gIGNvbG9yOiB3aGl0ZTtcclxufVxyXG4jc2VhcmNoLWJveCB7XHJcbiAgd2lkdGg6IDIwMHB4O1xyXG4gIGhlaWdodDogMjBweDtcclxufVxyXG5cclxuXHJcbnVsLnNlYXJjaC1yZXN1bHQge1xyXG4gIG1hcmdpbi10b3A6IDA7XHJcbiAgcGFkZGluZy1sZWZ0OiAwO1xyXG59XHJcbi5iZy1kYXJrIHNlYXJjaF9tZW51X2x7XHJcblx0ei1pbmRleDotMSAhaW1wb3J0YW50O1xyXG59XHJcblxyXG4iXX0= */";
    /***/
  },

  /***/
  "./src/app/hero-search/hero-search.component.ts":
  /*!******************************************************!*\
    !*** ./src/app/hero-search/hero-search.component.ts ***!
    \******************************************************/

  /*! exports provided: HeroSearchComponent */

  /***/
  function srcAppHeroSearchHeroSearchComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "HeroSearchComponent", function () {
      return HeroSearchComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var rxjs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! rxjs */
    "./node_modules/rxjs/_esm2015/index.js");
    /* harmony import */


    var _hero__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ../hero */
    "./src/app/hero.ts");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ../_helpers/image-footer-helper */
    "./src/app/_helpers/image-footer-helper.ts");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");
    /* harmony import */


    var util__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! util */
    "./node_modules/util/util.js");
    /* harmony import */


    var util__WEBPACK_IMPORTED_MODULE_8___default =
    /*#__PURE__*/
    __webpack_require__.n(util__WEBPACK_IMPORTED_MODULE_8__);
    /* harmony import */


    var aos__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! aos */
    "./node_modules/aos/dist/aos.js");
    /* harmony import */


    var aos__WEBPACK_IMPORTED_MODULE_9___default =
    /*#__PURE__*/
    __webpack_require__.n(aos__WEBPACK_IMPORTED_MODULE_9__);
    /* harmony import */


    var _angular_animations__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @angular/animations */
    "./node_modules/@angular/animations/fesm2015/animations.js");

    var HeroSearchComponent =
    /*#__PURE__*/
    function () {
      function HeroSearchComponent(heroService, route, dataHelper, myElement, spinner) {
        var _this24 = this;

        _classCallCheck(this, HeroSearchComponent);

        this.heroService = heroService;
        this.route = route;
        this.dataHelper = dataHelper;
        this.myElement = myElement;
        this.spinner = spinner;
        this.keywordEle = ' ';
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
        this.sideBarEle = true;
        this.loadingData = false;
        this.keyword = [];
        this.isMenuOpen = true;
        this.show = true;
        this.buttonName = 'Show';

        this.onPageChange = function (pageNumber) {
          var el = _this24.myElement.nativeElement.querySelector('main');

          el.scrollIntoView();
        };

        this.searchData = new _hero__WEBPACK_IMPORTED_MODULE_3__["Search"]();
      } // Push a search term into the observable stream.


      _createClass(HeroSearchComponent, [{
        key: "search",
        value: function search(term) {
          this.searchTerms.next(term);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this25 = this;

          aos__WEBPACK_IMPORTED_MODULE_9__["init"]();
          this.sub = this.route.queryParams.subscribe(function (params) {
            _this25.productType = params.type;
            _this25.keywordEle = params.keyword;
            _this25.loadingData = true; //  this.spinner.show();

            _this25.searchData.productType = params.type;
            _this25.searchData.search = params.keyword;

            if (!Object(util__WEBPACK_IMPORTED_MODULE_8__["isNullOrUndefined"])(params.sideBar)) {
              _this25.sideBarEle = params.sideBar;
            }

            _this25.searchData.letest = 0;
            _this25.searchData.curated = 1;
            _this25.searchData.populer = 0;

            _this25.searchAPIRequest();
          });
          this.heroService.getSearchLeftFilter().subscribe(function (leftsideData) {
            // this.carouselSliderImages = carouselSliderImages; 
            console.log(leftsideData);
            _this25.leftsideData = leftsideData;
          });
        }
      }, {
        key: "searchDropDownClick",
        value: function searchDropDownClick(type) {
          this.loadingData = true;
          this.searchData.productType = type;
          this.searchAPIRequest();
        }
      }, {
        key: "searchAPIRequest",
        value: function searchAPIRequest() {
          var _this26 = this;

          this.searchData.product_people = this.slidebarPeopleMenu.join();
          this.searchData.product_gender = this.slidebarGenderMenu.join();
          this.searchData.product_ethinicities = this.slidebarEthnicityMenu.join();
          this.searchData.product_locations = this.slidebarLocationMenu.join();
          this.searchData.product_colors = this.slidebarColorMenu.join();
          this.searchData.product_imagesizes = this.slidebarImageSizeMenu.join();
          this.searchData.product_imagetypes = this.slidebarImageTypeMenu.join();
          this.searchData.product_orientation = this.slidebarOrientationsMenu.join();
          this.searchData.product_sortType = this.sliderSortTypeMenu.join();
          this.heroService.getAosSliderSearchImages(this.searchData).subscribe(function (aoslSliderImages) {
            //  if(aoslSliderImages.hasOwnProperty('code')) {
            //   window.location.href = aoslSliderImages['url']
            //}else {
            _this26.aoslSliderImages = aoslSliderImages;
            var type = _this26.aoslSliderImages["0"].product_keywords;
            _this26.keyword = type.split(',', 9);
            console.log(_this26.keyword);

            _this26.maintainAosSlider(); //  this.spinner.hide();


            _this26.loadingData = false; // }
            // this.maintainSearchData(aoslSliderImages);
          }, function (error) {
            _this26.loadingData = false;
            console.log(error);
            alert('No data found ....');
          });
        }
      }, {
        key: "getSideBarClassName",
        value: function getSideBarClassName(type, id) {
          if (type == 'people') {
            var indexPeople = this.slidebarPeopleMenu.indexOf(id);

            if (indexPeople > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'gender') {
            var indexGender = this.slidebarGenderMenu.indexOf(id);

            if (indexGender > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'ethinicity') {
            var indexEthnicity = this.slidebarEthnicityMenu.indexOf(id);

            if (indexEthnicity > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'locations') {
            var indexLocation = this.slidebarLocationMenu.indexOf(id);

            if (indexLocation > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'colors') {
            var indexColor = this.slidebarColorMenu.indexOf(id);

            if (indexColor > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'imagesizes') {
            var indexImagesize = this.slidebarImageSizeMenu.indexOf(id);

            if (indexImagesize > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'imageTypes') {
            var indexImageType = this.slidebarImageTypeMenu.indexOf(id);

            if (indexImageType > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'orientation') {
            var indexOrientation = this.slidebarOrientationsMenu.indexOf(id);

            if (indexOrientation > -1) {
              return true;
            } else {
              return false;
            }
          } else if (type == 'sorttype') {
            var indexSorttype = this.sliderSortTypeMenu.indexOf(id);

            if (indexSorttype > -1) {
              return true;
            } else {
              return false;
            }
          }
        }
      }, {
        key: "onSideMenuClick",
        value: function onSideMenuClick(type, id) {
          this.loadingData = true;

          if (type == 'people') {
            var indexPeople = this.slidebarPeopleMenu.indexOf(id);

            if (indexPeople > -1) {
              this.slidebarPeopleMenu.splice(indexPeople, 1);
            } else {
              this.slidebarPeopleMenu.push(id);
            } //  this.searchData.product_people =this.slidebarPeopleMenu.join(); 

          } else if (type == 'gender') {
            var indexGender = this.slidebarGenderMenu.indexOf(id);

            if (indexGender > -1) {
              this.slidebarGenderMenu.splice(indexGender, 1);
            } else {
              this.slidebarGenderMenu.push(id);
            } // this.searchData.product_gender = this.slidebarGenderMenu.join();          

          } else if (type == 'ethinicity') {
            var indexEthnicity = this.slidebarEthnicityMenu.indexOf(id);

            if (indexEthnicity > -1) {
              this.slidebarEthnicityMenu.splice(indexEthnicity, 1);
            } else {
              this.slidebarEthnicityMenu.push(id);
            } // this.searchData.product_ethinicities = this.slidebarEthnicityMenu.join();          

          } else if (type == 'locations') {
            var indexLocation = this.slidebarLocationMenu.indexOf(id);

            if (indexLocation > -1) {
              this.slidebarLocationMenu.splice(indexLocation, 1);
            } else {
              this.slidebarLocationMenu.push(id);
            } // this.searchData.product_locations = this.slidebarLocationMenu.join();

          } else if (type == 'colors') {
            var indexColor = this.slidebarColorMenu.indexOf(id);

            if (indexColor > -1) {
              this.slidebarColorMenu.splice(indexColor, 1);
            } else {
              this.slidebarColorMenu.push(id);
            } // this.searchData.product_colors = this.slidebarColorMenu.join();

          } else if (type == 'imagesizes') {
            var indexImagesize = this.slidebarImageSizeMenu.indexOf(id);

            if (indexImagesize > -1) {
              this.slidebarImageSizeMenu.splice(indexImagesize, 1);
            } else {
              this.slidebarImageSizeMenu.push(id);
            } //  this.searchData.product_imagesizes = this.slidebarImageSizeMenu.join();

          } else if (type == 'imageTypes') {
            var indexImageType = this.slidebarImageTypeMenu.indexOf(id);

            if (indexImageType > -1) {
              this.slidebarImageTypeMenu.splice(indexImageType, 1);
            } else {
              this.slidebarImageTypeMenu.push(id);
            } // this.searchData.product_imagetypes = this.slidebarImageTypeMenu.join();

          } else if (type == 'orientation') {
            var indexOrientation = this.slidebarOrientationsMenu.indexOf(id);

            if (indexOrientation > -1) {
              this.slidebarOrientationsMenu.splice(indexOrientation, 1);
            } else {
              this.slidebarOrientationsMenu.push(id);
            } // this.searchData.product_orientation = this.slidebarOrientationsMenu.join();

          } else if (type == 'sorttype') {
            var indexSorttype = this.sliderSortTypeMenu.indexOf(id);

            if (indexSorttype > -1) {
              this.sliderSortTypeMenu.splice(indexSorttype, 1);
            } else {
              this.sliderSortTypeMenu.push(id);
            } // this.searchData.product_sortType = this.sliderSortTypeMenu.join();

          }

          this.searchAPIRequest();
        }
      }, {
        key: "onTabClick",
        value: function onTabClick(number) {
          console.log(number);
          this.loadingData = true;

          if (number == 2) {
            this.searchData.letest = 0;
            this.searchData.curated = 1;
            this.searchData.populer = 0;
          } else if (number == 3) {
            this.searchData.letest = 0;
            this.searchData.curated = 0;
            this.searchData.populer = 1;
          } else {
            this.searchData.letest = 1;
            this.searchData.curated = 0;
            this.searchData.populer = 0;
          }

          this.searchAPIRequest();
        }
      }, {
        key: "getClassName",
        value: function getClassName(ele) {
          // return 'col-6 col-md-'+ele.eleClass+' col-lg-'+ele.eleClass;
          return 'col-6 col-md-3 col-lg-3';
        }
      }, {
        key: "onKeydown",
        value: function onKeydown(event) {
          if (event.key === "Enter") {
            this.searchData.letest = 1;
            this.searchData.curated = 0;
            this.searchData.populer = 0;
            this.searchAPIRequest();
          }
        }
      }, {
        key: "maintainSearchData",
        value: function maintainSearchData(aoslSliderImages) {
          var _this27 = this;

          this.aoslSliderImagesData = aoslSliderImages;

          if (this.searchData.productType == 1) {
            this.aoslSliderImagesData = this.aoslSliderImages.filter(function (ele) {
              return ele.product_main_type == "Image";
            });
          } else if (this.searchData.productType == 2) {
            this.aoslSliderImagesData = this.aoslSliderImages.filter(function (ele) {
              return ele.product_main_type != "Image";
            });
          } else {
            this.aoslSliderImagesData = this.aoslSliderImages;
          }

          if (this.searchData.search.length > 2) {
            this.aoslSliderImagesData = this.aoslSliderImagesData.filter(function (ele) {
              return ele.product_title.includes(_this27.name.trim());
            });
          }

          this.maintainAosSlider();
        }
      }, {
        key: "maintainAosSlider",
        value: function maintainAosSlider() {
          var _this28 = this;

          var i = 4,
              j = 0;
          var randArr = [[3, 2, 3, 4], [5, 2, 3, 2], [4, 3, 2, 3], [2, 2, 4, 4], [3, 3, 4, 2], [4, 4, 2, 2], [3, 4, 2, 3], [3, 3, 3, 3], [4, 2, 4, 2], [3, 4, 3, 2]];
          var mathRandom = Math.floor(Math.random() * 10);
          this.aoslSliderImages.forEach(function (ele) {
            if (i > j) {
              // console.log(mathRandom)
              ele.eleClass = randArr[mathRandom][j];
              j = j + 1;

              if (j == i) {
                _this28.dataHelper.shuffleArray(randArr);

                j = 0;
                mathRandom = Math.floor(Math.random() * 10);
              }
            }
          });
        }
      }, {
        key: "toggle",
        value: function toggle() {
          this.show = !this.show; // CHANGE THE NAME OF THE BUTTON.

          if (this.show) this.buttonName = "Hide";else this.buttonName = "Show";
        }
      }]);

      return HeroSearchComponent;
    }();

    HeroSearchComponent.ctorParameters = function () {
      return [{
        type: _hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_5__["ActivatedRoute"]
      }, {
        type: _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_6__["imageFooterHelper"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
      }, {
        type: ngx_spinner__WEBPACK_IMPORTED_MODULE_7__["NgxSpinnerService"]
      }];
    };

    HeroSearchComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-hero-search',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./hero-search.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/hero-search/hero-search.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      animations: [Object(_angular_animations__WEBPACK_IMPORTED_MODULE_10__["trigger"])('slide', [Object(_angular_animations__WEBPACK_IMPORTED_MODULE_10__["state"])('up', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_10__["style"])({
        height: 0
      })), Object(_angular_animations__WEBPACK_IMPORTED_MODULE_10__["state"])('down', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_10__["style"])({
        height: '*'
      })), Object(_angular_animations__WEBPACK_IMPORTED_MODULE_10__["transition"])('up <=> down', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_10__["animate"])(200))])],
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./hero-search.component.css */
      "./src/app/hero-search/hero-search.component.css")).default, tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./sidebar.component.scss */
      "./src/app/hero-search/sidebar.component.scss")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_4__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_5__["ActivatedRoute"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_6__["imageFooterHelper"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"], ngx_spinner__WEBPACK_IMPORTED_MODULE_7__["NgxSpinnerService"]])], HeroSearchComponent);
    /***/
  },

  /***/
  "./src/app/hero-search/sidebar.component.scss":
  /*!****************************************************!*\
    !*** ./src/app/hero-search/sidebar.component.scss ***!
    \****************************************************/

  /*! exports provided: default */

  /***/
  function srcAppHeroSearchSidebarComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "@charset \"UTF-8\";\n@-webkit-keyframes swing {\n  0% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  10% {\n    -webkit-transform: rotate(10deg);\n            transform: rotate(10deg);\n  }\n  30% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  40% {\n    -webkit-transform: rotate(-10deg);\n            transform: rotate(-10deg);\n  }\n  50% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  60% {\n    -webkit-transform: rotate(5deg);\n            transform: rotate(5deg);\n  }\n  70% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  80% {\n    -webkit-transform: rotate(-5deg);\n            transform: rotate(-5deg);\n  }\n  100% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n}\n@keyframes swing {\n  0% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  10% {\n    -webkit-transform: rotate(10deg);\n            transform: rotate(10deg);\n  }\n  30% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  40% {\n    -webkit-transform: rotate(-10deg);\n            transform: rotate(-10deg);\n  }\n  50% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  60% {\n    -webkit-transform: rotate(5deg);\n            transform: rotate(5deg);\n  }\n  70% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  80% {\n    -webkit-transform: rotate(-5deg);\n            transform: rotate(-5deg);\n  }\n  100% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n}\n@-webkit-keyframes sonar {\n  0% {\n    -webkit-transform: scale(0.9);\n            transform: scale(0.9);\n    opacity: 1;\n  }\n  100% {\n    -webkit-transform: scale(2);\n            transform: scale(2);\n    opacity: 0;\n  }\n}\n@keyframes sonar {\n  0% {\n    -webkit-transform: scale(0.9);\n            transform: scale(0.9);\n    opacity: 1;\n  }\n  100% {\n    -webkit-transform: scale(2);\n            transform: scale(2);\n    opacity: 0;\n  }\n}\n.sidebar {\n  width: 260px;\n  height: 100%;\n  max-height: 100%;\n  position: fixed;\n  top: 92px;\n  left: 0px;\n  z-index: 999;\n  -webkit-transition: left 0.3s ease;\n  transition: left 0.3s ease;\n}\n.sidebar a {\n  text-decoration: none;\n  -webkit-transition: color 0.3s ease;\n  transition: color 0.3s ease;\n}\n.sidebar .sidebar-content {\n  max-height: calc(100% - 30px);\n  height: calc(100% - 30px);\n  overflow-y: auto;\n  position: relative;\n}\n.sidebar .sidebar-content .sidebar-header {\n  padding: 10px 20px;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-align: center;\n      -ms-flex-align: center;\n          align-items: center;\n}\n.sidebar .sidebar-content .sidebar-header > a {\n  text-transform: uppercase;\n  font-weight: bold;\n  -webkit-box-flex: 1;\n      -ms-flex-positive: 1;\n          flex-grow: 1;\n  text-decoration: none;\n}\n.sidebar .sidebar-content .sidebar-header #close-sidebar {\n  cursor: pointer;\n  font-size: 20px;\n  -webkit-transition: color 0.3s ease;\n  transition: color 0.3s ease;\n}\n.sidebar .sidebar-content .sidebar-profile {\n  padding: 20px;\n  overflow: hidden;\n}\n.sidebar .sidebar-content .sidebar-profile .user-pic {\n  float: left;\n  width: 60px;\n  padding: 2px;\n  border-radius: 12px;\n  margin-right: 15px;\n  overflow: hidden;\n}\n.sidebar .sidebar-content .sidebar-profile .user-pic img {\n  -o-object-fit: cover;\n     object-fit: cover;\n  height: 100%;\n  width: 100%;\n}\n.sidebar .sidebar-content .sidebar-profile .user-info {\n  float: left;\n}\n.sidebar .sidebar-content .sidebar-profile .user-info > span {\n  display: block;\n}\n.sidebar .sidebar-content .sidebar-profile .user-info .user-role {\n  font-size: 12px;\n}\n.sidebar .sidebar-content .sidebar-profile .user-info .user-status {\n  font-size: 11px;\n  margin-top: 4px;\n}\n.sidebar .sidebar-content .sidebar-profile .user-info .user-status i {\n  font-size: 8px;\n  margin-right: 4px;\n  color: #5cb85c;\n}\n.sidebar .sidebar-content .sidebar-search > div {\n  padding: 10px 20px;\n}\n.sidebar .sidebar-content .sidebar-search .input-group-append .input-group-text {\n  border-left: 0;\n}\n.sidebar .sidebar-content .sidebar-menu {\n  padding-bottom: 10px;\n}\n.sidebar .sidebar-content .sidebar-menu .header-menu span {\n  font-weight: bold;\n  font-size: 14px;\n  padding: 15px 20px 5px 20px;\n  display: inline-block;\n}\n.sidebar .sidebar-content .sidebar-menu ul {\n  list-style-type: none;\n  padding: 0;\n  margin: 0;\n}\n.sidebar .sidebar-content .sidebar-menu ul li a {\n  display: inline-block;\n  width: 100%;\n  text-decoration: none;\n  position: relative;\n  padding: 8px 30px 8px 20px;\n}\n.sidebar .sidebar-content .sidebar-menu ul li a i {\n  margin-right: 10px;\n  font-size: 12px;\n  width: 30px;\n  height: 30px;\n  line-height: 30px;\n  text-align: center;\n  border-radius: 4px;\n}\n.sidebar .sidebar-content .sidebar-menu ul li a:hover > i::before {\n  display: inline-block;\n  -webkit-animation: swing ease-in-out 0.5s 1 alternate;\n          animation: swing ease-in-out 0.5s 1 alternate;\n}\n.sidebar .sidebar-content .sidebar-menu ul li a span.label,\n.sidebar .sidebar-content .sidebar-menu ul li a span.badge {\n  float: right;\n  margin-top: 8px;\n  margin-left: 5px;\n}\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown > a:after {\n  font-family: \"Font Awesome 5 Free\";\n  font-weight: 900;\n  content: \"\";\n  display: inline-block;\n  font-style: normal;\n  font-variant: normal;\n  text-rendering: auto;\n  -webkit-font-smoothing: antialiased;\n  -moz-osx-font-smoothing: grayscale;\n  text-align: center;\n  background: 0 0;\n  position: absolute;\n  right: 15px;\n  top: 14px;\n  -webkit-transition: -webkit-transform 0.3s ease;\n  transition: -webkit-transform 0.3s ease;\n  transition: transform 0.3s ease;\n  transition: transform 0.3s ease, -webkit-transform 0.3s ease;\n}\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown .sidebar-submenu {\n  overflow: hidden;\n}\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown .sidebar-submenu ul {\n  padding: 5px 0;\n}\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown .sidebar-submenu li {\n  padding-left: 25px;\n  font-size: 13px;\n}\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before {\n  content: \"\";\n  font-family: \"Font Awesome 5 Free\";\n  font-weight: 400;\n  font-style: normal;\n  display: inline-block;\n  text-align: center;\n  text-decoration: none;\n  -webkit-font-smoothing: antialiased;\n  -moz-osx-font-smoothing: grayscale;\n  margin-right: 10px;\n  font-size: 8px;\n}\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .badge,\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .label {\n  float: right;\n  margin-top: 0px;\n}\n.sidebar .sidebar-content .sidebar-menu .sidebar-dropdown.active > a:after {\n  -webkit-transform: rotate(90deg);\n      -ms-transform: rotate(90deg);\n          transform: rotate(90deg);\n  right: 15px;\n}\n.sidebar .sidebar-footer {\n  position: absolute;\n  width: 100%;\n  bottom: 0;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n}\n.sidebar .sidebar-footer > div {\n  -webkit-box-flex: 1;\n      -ms-flex-positive: 1;\n          flex-grow: 1;\n  text-align: center;\n  height: 30px;\n  line-height: 30px;\n  position: static;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n}\n.sidebar .sidebar-footer > div > a {\n  -webkit-box-flex: 1;\n      -ms-flex-positive: 1;\n          flex-grow: 1;\n}\n.sidebar .sidebar-footer > div a .notification {\n  position: absolute;\n  top: 0;\n}\n.sidebar .sidebar-footer .dropdown-menu {\n  bottom: 31px;\n  left: 0 !important;\n  top: initial !important;\n  right: 0 !important;\n  -webkit-transform: none !important;\n      -ms-transform: none !important;\n          transform: none !important;\n  border-bottom-left-radius: 0;\n  border-bottom-right-radius: 0;\n  font-size: 0.9rem;\n}\n.sidebar .sidebar-footer .messages .dropdown-item {\n  padding: 0.25rem 1rem;\n}\n.sidebar .sidebar-footer .messages .messages-header {\n  padding: 0 1rem;\n}\n.sidebar .sidebar-footer .messages .message-content {\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n}\n.sidebar .sidebar-footer .messages .message-content .pic {\n  width: 40px;\n  height: 40px;\n  border-radius: 4px;\n  overflow: hidden;\n}\n.sidebar .sidebar-footer .messages .message-content .pic img {\n  -o-object-fit: cover;\n     object-fit: cover;\n  height: 100%;\n}\n.sidebar .sidebar-footer .messages .message-content .content {\n  line-height: 1.6;\n  padding-left: 5px;\n  width: calc(100% - 40px);\n}\n.sidebar .sidebar-footer .messages .message-content .content .message-title {\n  font-size: 13px;\n}\n.sidebar .sidebar-footer .messages .message-content .content .message-detail {\n  font-size: 12px;\n  white-space: nowrap;\n  overflow: hidden;\n  text-overflow: ellipsis;\n}\n.sidebar .sidebar-footer .notifications .dropdown-item {\n  padding: 0.25rem 1rem;\n}\n.sidebar .sidebar-footer .notifications .notifications-header {\n  padding: 0 1rem;\n}\n.sidebar .sidebar-footer .notifications .notification-content {\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n}\n.sidebar .sidebar-footer .notifications .notification-content .icon {\n  width: 40px;\n  height: 40px;\n}\n.sidebar .sidebar-footer .notifications .notification-content .icon i {\n  width: 35px;\n  height: 35px;\n  text-align: center;\n  line-height: 35px;\n  border-radius: 4px;\n}\n.sidebar .sidebar-footer .notifications .notification-content .content {\n  line-height: 1.6;\n  padding-left: 5px;\n  width: calc(100% - 40px);\n}\n.sidebar .sidebar-footer .notifications .notification-content .content .notification-time {\n  font-size: 0.7rem;\n  color: #828282;\n}\n.sidebar .sidebar-footer .notifications .notification-content .content .notification-detail {\n  font-size: 12px;\n  white-space: nowrap;\n  overflow: hidden;\n  text-overflow: ellipsis;\n}\n.sidebar .sidebar-footer .badge-sonar {\n  display: inline-block;\n  background: #980303;\n  border-radius: 50%;\n  height: 8px;\n  width: 8px;\n  position: absolute;\n  top: 0;\n}\n.sidebar .sidebar-footer .badge-sonar:after {\n  content: \"\";\n  position: absolute;\n  top: 0;\n  left: 0;\n  border: 2px solid #980303;\n  opacity: 0;\n  border-radius: 50%;\n  width: 100%;\n  height: 100%;\n  -webkit-animation: sonar 1.5s infinite;\n          animation: sonar 1.5s infinite;\n}\n/*------------------------------default theme---------------------------------*/\n.sidebar {\n  background-color: #1d1d1d;\n}\n.sidebar .sidebar-profile,\n.sidebar .sidebar-search,\n.sidebar .sidebar-menu {\n  border-top: 1px solid #2b2b2b;\n}\n.sidebar .sidebar-search input.search-menu,\n.sidebar .sidebar-search .input-group-text {\n  border-color: #2b2b2b;\n  box-shadow: none;\n}\n.sidebar .sidebar-profile .user-info .user-role,\n.sidebar .sidebar-profile .user-info .user-status,\n.sidebar .sidebar-search input.search-menu,\n.sidebar .sidebar-search .input-group-text,\n.sidebar .sidebar-header > a,\n.sidebar .sidebar-menu ul li a,\n.sidebar .sidebar-footer > div > a,\n.sidebar #close-sidebar {\n  color: #bdbdbd;\n}\n.sidebar .sidebar-menu ul li:hover > a,\n.sidebar .sidebar-menu .sidebar-dropdown.active > a,\n.sidebar .sidebar-profile .user-info,\n.sidebar .sidebar-header > a:hover,\n.sidebar .sidebar-footer > div > a:hover i,\n.sidebar #close-sidebar:hover {\n  color: #ffffff;\n}\n.sidebar ul li:hover a i,\n.sidebar .sidebar-dropdown .sidebar-submenu li a:hover:before,\n.sidebar .sidebar-search input.search-menu:focus + span,\n.sidebar .sidebar-menu .sidebar-dropdown.active a i {\n  color: #ffffff;\n}\n.sidebar .sidebar-menu ul li a i,\n.sidebar .sidebar-menu .sidebar-dropdown div,\n.sidebar .sidebar-search input.search-menu,\n.sidebar .sidebar-search .input-group-text {\n  background-color: #2b2b2b;\n  border: none;\n  margin-left: 1px;\n}\n.sidebar .sidebar-menu .header-menu span {\n  color: #6c7b88;\n}\n.sidebar .sidebar-footer {\n  background-color: #2b2b2b;\n  box-shadow: 0px -1px 5px #131212;\n  border-top: 1px solid #3a3a3a;\n}\n.sidebar .sidebar-footer > div:first-child {\n  border-left: none;\n}\n.sidebar .sidebar-footer > div:last-child {\n  border-right: none;\n}\n.sidebar.sidebar-bg {\n  background-image: url(/assets/img/bg1.jpg);\n  background-size: cover;\n  background-position: center;\n  background-repeat: no-repeat;\n}\n.sidebar.sidebar-bg:before {\n  content: \"\";\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  background-color: rgba(29, 29, 29, 0.8);\n}\n.sidebar.sidebar-bg .sidebar-profile,\n.sidebar.sidebar-bg .sidebar-search,\n.sidebar.sidebar-bg .sidebar-menu {\n  border-top: 1px solid rgba(255, 255, 255, 0.1);\n}\n.sidebar.sidebar-bg .sidebar-search input.search-menu,\n.sidebar.sidebar-bg .sidebar-search .input-group-text {\n  border-color: rgba(255, 255, 255, 0.1);\n  box-shadow: none;\n}\n.sidebar.sidebar-bg .sidebar-menu ul li a i,\n.sidebar.sidebar-bg .sidebar-menu .sidebar-dropdown div,\n.sidebar.sidebar-bg .sidebar-search input.search-menu,\n.sidebar.sidebar-bg .sidebar-search .input-group-text {\n  background-color: rgba(255, 255, 255, 0.1);\n}\n.sidebar.sidebar-bg .sidebar-footer {\n  background-color: rgba(43, 43, 43, 0.5);\n  box-shadow: 0px -1px 5px rgba(43, 43, 43, 0.5);\n  border-top: 1px solid rgba(255, 255, 255, 0.1);\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaGVyby1zZWFyY2gvc2lkZWJhci5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvaGVyby1zZWFyY2gvQzpcXHhhbXBwXFxodGRvY3NcXGltYWdlZm9vdGFnZW5ld1xcZnJvbnRlbmQvc3JjXFxhcHBcXGhlcm8tc2VhcmNoXFxzaWRlYmFyLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLGdCQUFnQjtBQ0FoQjtFQUNFO0lBQ0UsK0JBQUE7WUFBQSx1QkFBQTtFREVGO0VDQ0E7SUFDRSxnQ0FBQTtZQUFBLHdCQUFBO0VEQ0Y7RUNFQTtJQUNFLCtCQUFBO1lBQUEsdUJBQUE7RURBRjtFQ0dBO0lBQ0UsaUNBQUE7WUFBQSx5QkFBQTtFRERGO0VDSUE7SUFDRSwrQkFBQTtZQUFBLHVCQUFBO0VERkY7RUNLQTtJQUNFLCtCQUFBO1lBQUEsdUJBQUE7RURIRjtFQ01BO0lBQ0UsK0JBQUE7WUFBQSx1QkFBQTtFREpGO0VDT0E7SUFDRSxnQ0FBQTtZQUFBLHdCQUFBO0VETEY7RUNRQTtJQUNFLCtCQUFBO1lBQUEsdUJBQUE7RURORjtBQUNGO0FDN0JBO0VBQ0U7SUFDRSwrQkFBQTtZQUFBLHVCQUFBO0VERUY7RUNDQTtJQUNFLGdDQUFBO1lBQUEsd0JBQUE7RURDRjtFQ0VBO0lBQ0UsK0JBQUE7WUFBQSx1QkFBQTtFREFGO0VDR0E7SUFDRSxpQ0FBQTtZQUFBLHlCQUFBO0VEREY7RUNJQTtJQUNFLCtCQUFBO1lBQUEsdUJBQUE7RURGRjtFQ0tBO0lBQ0UsK0JBQUE7WUFBQSx1QkFBQTtFREhGO0VDTUE7SUFDRSwrQkFBQTtZQUFBLHVCQUFBO0VESkY7RUNPQTtJQUNFLGdDQUFBO1lBQUEsd0JBQUE7RURMRjtFQ1FBO0lBQ0UsK0JBQUE7WUFBQSx1QkFBQTtFRE5GO0FBQ0Y7QUNTQTtFQUNFO0lBQ0UsNkJBQUE7WUFBQSxxQkFBQTtJQUNBLFVBQUE7RURQRjtFQ1VBO0lBQ0UsMkJBQUE7WUFBQSxtQkFBQTtJQUNBLFVBQUE7RURSRjtBQUNGO0FDREE7RUFDRTtJQUNFLDZCQUFBO1lBQUEscUJBQUE7SUFDQSxVQUFBO0VEUEY7RUNVQTtJQUNFLDJCQUFBO1lBQUEsbUJBQUE7SUFDQSxVQUFBO0VEUkY7QUFDRjtBQ1dBO0VBQ0UsWUFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtFQUNBLGVBQUE7RUFDQSxTQUFBO0VBQ0EsU0FBQTtFQUNBLFlBQUE7RUFDQSxrQ0FBQTtFQUFBLDBCQUFBO0FEVEY7QUNXRTtFQUNFLHFCQUFBO0VBQ0EsbUNBQUE7RUFBQSwyQkFBQTtBRFRKO0FDWUU7RUFDRSw2QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtBRFZKO0FDWUk7RUFDRSxrQkFBQTtFQUNBLG9CQUFBO0VBQUEsb0JBQUE7RUFBQSxhQUFBO0VBQ0EseUJBQUE7TUFBQSxzQkFBQTtVQUFBLG1CQUFBO0FEVk47QUNZTTtFQUNFLHlCQUFBO0VBQ0EsaUJBQUE7RUFDQSxtQkFBQTtNQUFBLG9CQUFBO1VBQUEsWUFBQTtFQUNBLHFCQUFBO0FEVlI7QUNhTTtFQUNFLGVBQUE7RUFDQSxlQUFBO0VBQ0EsbUNBQUE7RUFBQSwyQkFBQTtBRFhSO0FDZUk7RUFDRSxhQUFBO0VBQ0EsZ0JBQUE7QURiTjtBQ2VNO0VBQ0UsV0FBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0EsbUJBQUE7RUFDQSxrQkFBQTtFQUNBLGdCQUFBO0FEYlI7QUNlUTtFQUNFLG9CQUFBO0tBQUEsaUJBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtBRGJWO0FDaUJNO0VBQ0UsV0FBQTtBRGZSO0FDaUJRO0VBQ0UsY0FBQTtBRGZWO0FDa0JRO0VBQ0UsZUFBQTtBRGhCVjtBQ21CUTtFQUNFLGVBQUE7RUFDQSxlQUFBO0FEakJWO0FDbUJVO0VBQ0UsY0FBQTtFQUNBLGlCQUFBO0VBQ0EsY0FBQTtBRGpCWjtBQzBCTTtFQUNFLGtCQUFBO0FEeEJSO0FDMkJNO0VBQ0UsY0FBQTtBRHpCUjtBQzZCSTtFQUNFLG9CQUFBO0FEM0JOO0FDNkJNO0VBQ0UsaUJBQUE7RUFDQSxlQUFBO0VBQ0EsMkJBQUE7RUFDQSxxQkFBQTtBRDNCUjtBQytCTTtFQUNFLHFCQUFBO0VBQ0EsVUFBQTtFQUNBLFNBQUE7QUQ3QlI7QUMrQlE7RUFDRSxxQkFBQTtFQUNBLFdBQUE7RUFDQSxxQkFBQTtFQUNBLGtCQUFBO0VBQ0EsMEJBQUE7QUQ3QlY7QUMrQlU7RUFDRSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxrQkFBQTtBRDdCWjtBQ2dDVTtFQUNFLHFCQUFBO0VBQ0EscURBQUE7VUFBQSw2Q0FBQTtBRDlCWjtBQ2lDVTs7RUFFRSxZQUFBO0VBQ0EsZUFBQTtFQUNBLGdCQUFBO0FEL0JaO0FDcUNRO0VBQ0Usa0NBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7RUFDQSxxQkFBQTtFQUNBLGtCQUFBO0VBQ0Esb0JBQUE7RUFDQSxvQkFBQTtFQUNBLG1DQUFBO0VBQ0Esa0NBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxTQUFBO0VBQ0EsK0NBQUE7RUFBQSx1Q0FBQTtFQUFBLCtCQUFBO0VBQUEsNERBQUE7QURuQ1Y7QUN1Q1E7RUFFRSxnQkFBQTtBRHRDVjtBQ3dDVTtFQUNFLGNBQUE7QUR0Q1o7QUN5Q1U7RUFDRSxrQkFBQTtFQUNBLGVBQUE7QUR2Q1o7QUMwQ2M7RUFDRSxZQUFBO0VBQ0Esa0NBQUE7RUFDQSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EscUJBQUE7RUFDQSxrQkFBQTtFQUNBLHFCQUFBO0VBQ0EsbUNBQUE7RUFDQSxrQ0FBQTtFQUNBLGtCQUFBO0VBQ0EsY0FBQTtBRHhDaEI7QUMyQ2M7O0VBRUUsWUFBQTtFQUNBLGVBQUE7QUR6Q2hCO0FDK0NRO0VBQ0UsZ0NBQUE7TUFBQSw0QkFBQTtVQUFBLHdCQUFBO0VBQ0EsV0FBQTtBRDdDVjtBQ3NERTtFQUVFLGtCQUFBO0VBQ0EsV0FBQTtFQUNBLFNBQUE7RUFDQSxvQkFBQTtFQUFBLG9CQUFBO0VBQUEsYUFBQTtBRHJESjtBQ3VESTtFQUNFLG1CQUFBO01BQUEsb0JBQUE7VUFBQSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0VBQ0EsaUJBQUE7RUFDQSxnQkFBQTtFQUNBLG9CQUFBO0VBQUEsb0JBQUE7RUFBQSxhQUFBO0FEckROO0FDdURNO0VBQ0UsbUJBQUE7TUFBQSxvQkFBQTtVQUFBLFlBQUE7QURyRFI7QUN3RE07RUFDRSxrQkFBQTtFQUNBLE1BQUE7QUR0RFI7QUMwREk7RUFDRSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0VBQ0Esa0NBQUE7TUFBQSw4QkFBQTtVQUFBLDBCQUFBO0VBQ0EsNEJBQUE7RUFDQSw2QkFBQTtFQUNBLGlCQUFBO0FEeEROO0FDNERNO0VBQ0UscUJBQUE7QUQxRFI7QUM2RE07RUFDRSxlQUFBO0FEM0RSO0FDOERNO0VBQ0Usb0JBQUE7RUFBQSxvQkFBQTtFQUFBLGFBQUE7QUQ1RFI7QUM4RFE7RUFDRSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0EsZ0JBQUE7QUQ1RFY7QUM4RFU7RUFDRSxvQkFBQTtLQUFBLGlCQUFBO0VBQ0EsWUFBQTtBRDVEWjtBQ2dFUTtFQUNFLGdCQUFBO0VBQ0EsaUJBQUE7RUFDQSx3QkFBQTtBRDlEVjtBQ2dFVTtFQUNFLGVBQUE7QUQ5RFo7QUNpRVU7RUFDRSxlQUFBO0VBQ0EsbUJBQUE7RUFDQSxnQkFBQTtFQUNBLHVCQUFBO0FEL0RaO0FDd0VNO0VBQ0UscUJBQUE7QUR0RVI7QUN5RU07RUFDRSxlQUFBO0FEdkVSO0FDMEVNO0VBQ0Usb0JBQUE7RUFBQSxvQkFBQTtFQUFBLGFBQUE7QUR4RVI7QUMwRVE7RUFDRSxXQUFBO0VBQ0EsWUFBQTtBRHhFVjtBQzBFVTtFQUNFLFdBQUE7RUFDQSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0FEeEVaO0FDNEVRO0VBQ0UsZ0JBQUE7RUFDQSxpQkFBQTtFQUNBLHdCQUFBO0FEMUVWO0FDNEVVO0VBQ0UsaUJBQUE7RUFDQSxjQUFBO0FEMUVaO0FDNkVVO0VBQ0UsZUFBQTtFQUNBLG1CQUFBO0VBQ0EsZ0JBQUE7RUFDQSx1QkFBQTtBRDNFWjtBQ2tGSTtFQUNFLHFCQUFBO0VBQ0EsbUJBQUE7RUFDQSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxVQUFBO0VBQ0Esa0JBQUE7RUFDQSxNQUFBO0FEaEZOO0FDa0ZNO0VBQ0UsV0FBQTtFQUNBLGtCQUFBO0VBQ0EsTUFBQTtFQUNBLE9BQUE7RUFDQSx5QkFBQTtFQUNBLFVBQUE7RUFDQSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0Esc0NBQUE7VUFBQSw4QkFBQTtBRGhGUjtBQ3lGQSwrRUFBQTtBQWtCQTtFQUVFLHlCQW5Cb0I7QURyRnRCO0FDMEdFOzs7RUFHRSw2QkFBQTtBRHhHSjtBQzJHRTs7RUFFRSxxQkE1Qlk7RUE2QlosZ0JBQUE7QUR6R0o7QUM0R0U7Ozs7Ozs7O0VBUUUsY0F0Q0c7QURwRVA7QUM2R0U7Ozs7OztFQU1FLGNBN0NTO0FEOURiO0FDOEdFOzs7O0VBSUUsY0FwRFM7QUR4RGI7QUMrR0U7Ozs7RUFJRSx5QkEvRFk7RUFnRVosWUFBQTtFQUNBLGdCQUFBO0FEN0dKO0FDZ0hFO0VBQ0UsY0FsRWdCO0FENUNwQjtBQ2lIRTtFQUNFLHlCQXpFWTtFQTBFWixnQ0FBQTtFQUNBLDZCQUFBO0FEL0dKO0FDa0hFO0VBQ0UsaUJBQUE7QURoSEo7QUNtSEU7RUFDRSxrQkFBQTtBRGpISjtBQ3FIRTtFQUVFLDBDQUFBO0VBQ0Esc0JBQUE7RUFDQSwyQkFBQTtFQUNBLDRCQUFBO0FEcEhKO0FDc0hJO0VBQ0UsV0FBQTtFQUNBLGtCQUFBO0VBQ0EsTUFBQTtFQUNBLFFBQUE7RUFDQSxTQUFBO0VBQ0EsT0FBQTtFQUNBLHVDQTVGb0I7QUR4QjFCO0FDdUhJOzs7RUFHRSw4Q0FBQTtBRHJITjtBQ3dISTs7RUFFRSxzQ0F0R2M7RUF1R2QsZ0JBQUE7QUR0SE47QUN5SEk7Ozs7RUFJRSwwQ0E5R2M7QURUcEI7QUMySEk7RUFDRSx1Q0FsSFU7RUFtSFYsOENBQUE7RUFDQSw4Q0FBQTtBRHpITiIsImZpbGUiOiJzcmMvYXBwL2hlcm8tc2VhcmNoL3NpZGViYXIuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJAY2hhcnNldCBcIlVURi04XCI7XG5Aa2V5ZnJhbWVzIHN3aW5nIHtcbiAgMCUge1xuICAgIHRyYW5zZm9ybTogcm90YXRlKDBkZWcpO1xuICB9XG4gIDEwJSB7XG4gICAgdHJhbnNmb3JtOiByb3RhdGUoMTBkZWcpO1xuICB9XG4gIDMwJSB7XG4gICAgdHJhbnNmb3JtOiByb3RhdGUoMGRlZyk7XG4gIH1cbiAgNDAlIHtcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMTBkZWcpO1xuICB9XG4gIDUwJSB7XG4gICAgdHJhbnNmb3JtOiByb3RhdGUoMGRlZyk7XG4gIH1cbiAgNjAlIHtcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSg1ZGVnKTtcbiAgfVxuICA3MCUge1xuICAgIHRyYW5zZm9ybTogcm90YXRlKDBkZWcpO1xuICB9XG4gIDgwJSB7XG4gICAgdHJhbnNmb3JtOiByb3RhdGUoLTVkZWcpO1xuICB9XG4gIDEwMCUge1xuICAgIHRyYW5zZm9ybTogcm90YXRlKDBkZWcpO1xuICB9XG59XG5Aa2V5ZnJhbWVzIHNvbmFyIHtcbiAgMCUge1xuICAgIHRyYW5zZm9ybTogc2NhbGUoMC45KTtcbiAgICBvcGFjaXR5OiAxO1xuICB9XG4gIDEwMCUge1xuICAgIHRyYW5zZm9ybTogc2NhbGUoMik7XG4gICAgb3BhY2l0eTogMDtcbiAgfVxufVxuLnNpZGViYXIge1xuICB3aWR0aDogMjYwcHg7XG4gIGhlaWdodDogMTAwJTtcbiAgbWF4LWhlaWdodDogMTAwJTtcbiAgcG9zaXRpb246IGZpeGVkO1xuICB0b3A6IDkycHg7XG4gIGxlZnQ6IDBweDtcbiAgei1pbmRleDogOTk5O1xuICB0cmFuc2l0aW9uOiBsZWZ0IDAuM3MgZWFzZTtcbn1cbi5zaWRlYmFyIGEge1xuICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XG4gIHRyYW5zaXRpb246IGNvbG9yIDAuM3MgZWFzZTtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQge1xuICBtYXgtaGVpZ2h0OiBjYWxjKDEwMCUgLSAzMHB4KTtcbiAgaGVpZ2h0OiBjYWxjKDEwMCUgLSAzMHB4KTtcbiAgb3ZlcmZsb3cteTogYXV0bztcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1oZWFkZXIge1xuICBwYWRkaW5nOiAxMHB4IDIwcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLWhlYWRlciA+IGEge1xuICB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlO1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgZmxleC1ncm93OiAxO1xuICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLWhlYWRlciAjY2xvc2Utc2lkZWJhciB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgZm9udC1zaXplOiAyMHB4O1xuICB0cmFuc2l0aW9uOiBjb2xvciAwLjNzIGVhc2U7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLXByb2ZpbGUge1xuICBwYWRkaW5nOiAyMHB4O1xuICBvdmVyZmxvdzogaGlkZGVuO1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1wcm9maWxlIC51c2VyLXBpYyB7XG4gIGZsb2F0OiBsZWZ0O1xuICB3aWR0aDogNjBweDtcbiAgcGFkZGluZzogMnB4O1xuICBib3JkZXItcmFkaXVzOiAxMnB4O1xuICBtYXJnaW4tcmlnaHQ6IDE1cHg7XG4gIG92ZXJmbG93OiBoaWRkZW47XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLXByb2ZpbGUgLnVzZXItcGljIGltZyB7XG4gIG9iamVjdC1maXQ6IGNvdmVyO1xuICBoZWlnaHQ6IDEwMCU7XG4gIHdpZHRoOiAxMDAlO1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1wcm9maWxlIC51c2VyLWluZm8ge1xuICBmbG9hdDogbGVmdDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItcHJvZmlsZSAudXNlci1pbmZvID4gc3BhbiB7XG4gIGRpc3BsYXk6IGJsb2NrO1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1wcm9maWxlIC51c2VyLWluZm8gLnVzZXItcm9sZSB7XG4gIGZvbnQtc2l6ZTogMTJweDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItcHJvZmlsZSAudXNlci1pbmZvIC51c2VyLXN0YXR1cyB7XG4gIGZvbnQtc2l6ZTogMTFweDtcbiAgbWFyZ2luLXRvcDogNHB4O1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1wcm9maWxlIC51c2VyLWluZm8gLnVzZXItc3RhdHVzIGkge1xuICBmb250LXNpemU6IDhweDtcbiAgbWFyZ2luLXJpZ2h0OiA0cHg7XG4gIGNvbG9yOiAjNWNiODVjO1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1zZWFyY2ggPiBkaXYge1xuICBwYWRkaW5nOiAxMHB4IDIwcHg7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLXNlYXJjaCAuaW5wdXQtZ3JvdXAtYXBwZW5kIC5pbnB1dC1ncm91cC10ZXh0IHtcbiAgYm9yZGVyLWxlZnQ6IDA7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLW1lbnUge1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItbWVudSAuaGVhZGVyLW1lbnUgc3BhbiB7XG4gIGZvbnQtd2VpZ2h0OiBib2xkO1xuICBmb250LXNpemU6IDE0cHg7XG4gIHBhZGRpbmc6IDE1cHggMjBweCA1cHggMjBweDtcbiAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1tZW51IHVsIHtcbiAgbGlzdC1zdHlsZS10eXBlOiBub25lO1xuICBwYWRkaW5nOiAwO1xuICBtYXJnaW46IDA7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLW1lbnUgdWwgbGkgYSB7XG4gIGRpc3BsYXk6IGlubGluZS1ibG9jaztcbiAgd2lkdGg6IDEwMCU7XG4gIHRleHQtZGVjb3JhdGlvbjogbm9uZTtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBwYWRkaW5nOiA4cHggMzBweCA4cHggMjBweDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItbWVudSB1bCBsaSBhIGkge1xuICBtYXJnaW4tcmlnaHQ6IDEwcHg7XG4gIGZvbnQtc2l6ZTogMTJweDtcbiAgd2lkdGg6IDMwcHg7XG4gIGhlaWdodDogMzBweDtcbiAgbGluZS1oZWlnaHQ6IDMwcHg7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1tZW51IHVsIGxpIGE6aG92ZXIgPiBpOjpiZWZvcmUge1xuICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG4gIGFuaW1hdGlvbjogc3dpbmcgZWFzZS1pbi1vdXQgMC41cyAxIGFsdGVybmF0ZTtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItbWVudSB1bCBsaSBhIHNwYW4ubGFiZWwsXG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLW1lbnUgdWwgbGkgYSBzcGFuLmJhZGdlIHtcbiAgZmxvYXQ6IHJpZ2h0O1xuICBtYXJnaW4tdG9wOiA4cHg7XG4gIG1hcmdpbi1sZWZ0OiA1cHg7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLW1lbnUgLnNpZGViYXItZHJvcGRvd24gPiBhOmFmdGVyIHtcbiAgZm9udC1mYW1pbHk6IFwiRm9udCBBd2Vzb21lIDUgRnJlZVwiO1xuICBmb250LXdlaWdodDogOTAwO1xuICBjb250ZW50OiBcIu+EhVwiO1xuICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG4gIGZvbnQtc3R5bGU6IG5vcm1hbDtcbiAgZm9udC12YXJpYW50OiBub3JtYWw7XG4gIHRleHQtcmVuZGVyaW5nOiBhdXRvO1xuICAtd2Via2l0LWZvbnQtc21vb3RoaW5nOiBhbnRpYWxpYXNlZDtcbiAgLW1vei1vc3gtZm9udC1zbW9vdGhpbmc6IGdyYXlzY2FsZTtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBiYWNrZ3JvdW5kOiAwIDA7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgcmlnaHQ6IDE1cHg7XG4gIHRvcDogMTRweDtcbiAgdHJhbnNpdGlvbjogdHJhbnNmb3JtIDAuM3MgZWFzZTtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItbWVudSAuc2lkZWJhci1kcm9wZG93biAuc2lkZWJhci1zdWJtZW51IHtcbiAgb3ZlcmZsb3c6IGhpZGRlbjtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItbWVudSAuc2lkZWJhci1kcm9wZG93biAuc2lkZWJhci1zdWJtZW51IHVsIHtcbiAgcGFkZGluZzogNXB4IDA7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLW1lbnUgLnNpZGViYXItZHJvcGRvd24gLnNpZGViYXItc3VibWVudSBsaSB7XG4gIHBhZGRpbmctbGVmdDogMjVweDtcbiAgZm9udC1zaXplOiAxM3B4O1xufVxuLnNpZGViYXIgLnNpZGViYXItY29udGVudCAuc2lkZWJhci1tZW51IC5zaWRlYmFyLWRyb3Bkb3duIC5zaWRlYmFyLXN1Ym1lbnUgbGkgYTpiZWZvcmUge1xuICBjb250ZW50OiBcIu+EkVwiO1xuICBmb250LWZhbWlseTogXCJGb250IEF3ZXNvbWUgNSBGcmVlXCI7XG4gIGZvbnQtd2VpZ2h0OiA0MDA7XG4gIGZvbnQtc3R5bGU6IG5vcm1hbDtcbiAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIHRleHQtZGVjb3JhdGlvbjogbm9uZTtcbiAgLXdlYmtpdC1mb250LXNtb290aGluZzogYW50aWFsaWFzZWQ7XG4gIC1tb3otb3N4LWZvbnQtc21vb3RoaW5nOiBncmF5c2NhbGU7XG4gIG1hcmdpbi1yaWdodDogMTBweDtcbiAgZm9udC1zaXplOiA4cHg7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLW1lbnUgLnNpZGViYXItZHJvcGRvd24gLnNpZGViYXItc3VibWVudSBsaSBhIC5iYWRnZSxcbi5zaWRlYmFyIC5zaWRlYmFyLWNvbnRlbnQgLnNpZGViYXItbWVudSAuc2lkZWJhci1kcm9wZG93biAuc2lkZWJhci1zdWJtZW51IGxpIGEgLmxhYmVsIHtcbiAgZmxvYXQ6IHJpZ2h0O1xuICBtYXJnaW4tdG9wOiAwcHg7XG59XG4uc2lkZWJhciAuc2lkZWJhci1jb250ZW50IC5zaWRlYmFyLW1lbnUgLnNpZGViYXItZHJvcGRvd24uYWN0aXZlID4gYTphZnRlciB7XG4gIHRyYW5zZm9ybTogcm90YXRlKDkwZGVnKTtcbiAgcmlnaHQ6IDE1cHg7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHdpZHRoOiAxMDAlO1xuICBib3R0b206IDA7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgPiBkaXYge1xuICBmbGV4LWdyb3c6IDE7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgaGVpZ2h0OiAzMHB4O1xuICBsaW5lLWhlaWdodDogMzBweDtcbiAgcG9zaXRpb246IHN0YXRpYztcbiAgZGlzcGxheTogZmxleDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciA+IGRpdiA+IGEge1xuICBmbGV4LWdyb3c6IDE7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgPiBkaXYgYSAubm90aWZpY2F0aW9uIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDA7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgLmRyb3Bkb3duLW1lbnUge1xuICBib3R0b206IDMxcHg7XG4gIGxlZnQ6IDAgIWltcG9ydGFudDtcbiAgdG9wOiBpbml0aWFsICFpbXBvcnRhbnQ7XG4gIHJpZ2h0OiAwICFpbXBvcnRhbnQ7XG4gIHRyYW5zZm9ybTogbm9uZSAhaW1wb3J0YW50O1xuICBib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOiAwO1xuICBib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czogMDtcbiAgZm9udC1zaXplOiAwLjlyZW07XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgLm1lc3NhZ2VzIC5kcm9wZG93bi1pdGVtIHtcbiAgcGFkZGluZzogMC4yNXJlbSAxcmVtO1xufVxuLnNpZGViYXIgLnNpZGViYXItZm9vdGVyIC5tZXNzYWdlcyAubWVzc2FnZXMtaGVhZGVyIHtcbiAgcGFkZGluZzogMCAxcmVtO1xufVxuLnNpZGViYXIgLnNpZGViYXItZm9vdGVyIC5tZXNzYWdlcyAubWVzc2FnZS1jb250ZW50IHtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciAubWVzc2FnZXMgLm1lc3NhZ2UtY29udGVudCAucGljIHtcbiAgd2lkdGg6IDQwcHg7XG4gIGhlaWdodDogNDBweDtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xuICBvdmVyZmxvdzogaGlkZGVuO1xufVxuLnNpZGViYXIgLnNpZGViYXItZm9vdGVyIC5tZXNzYWdlcyAubWVzc2FnZS1jb250ZW50IC5waWMgaW1nIHtcbiAgb2JqZWN0LWZpdDogY292ZXI7XG4gIGhlaWdodDogMTAwJTtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciAubWVzc2FnZXMgLm1lc3NhZ2UtY29udGVudCAuY29udGVudCB7XG4gIGxpbmUtaGVpZ2h0OiAxLjY7XG4gIHBhZGRpbmctbGVmdDogNXB4O1xuICB3aWR0aDogY2FsYygxMDAlIC0gNDBweCk7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgLm1lc3NhZ2VzIC5tZXNzYWdlLWNvbnRlbnQgLmNvbnRlbnQgLm1lc3NhZ2UtdGl0bGUge1xuICBmb250LXNpemU6IDEzcHg7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgLm1lc3NhZ2VzIC5tZXNzYWdlLWNvbnRlbnQgLmNvbnRlbnQgLm1lc3NhZ2UtZGV0YWlsIHtcbiAgZm9udC1zaXplOiAxMnB4O1xuICB3aGl0ZS1zcGFjZTogbm93cmFwO1xuICBvdmVyZmxvdzogaGlkZGVuO1xuICB0ZXh0LW92ZXJmbG93OiBlbGxpcHNpcztcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciAubm90aWZpY2F0aW9ucyAuZHJvcGRvd24taXRlbSB7XG4gIHBhZGRpbmc6IDAuMjVyZW0gMXJlbTtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciAubm90aWZpY2F0aW9ucyAubm90aWZpY2F0aW9ucy1oZWFkZXIge1xuICBwYWRkaW5nOiAwIDFyZW07XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgLm5vdGlmaWNhdGlvbnMgLm5vdGlmaWNhdGlvbi1jb250ZW50IHtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciAubm90aWZpY2F0aW9ucyAubm90aWZpY2F0aW9uLWNvbnRlbnQgLmljb24ge1xuICB3aWR0aDogNDBweDtcbiAgaGVpZ2h0OiA0MHB4O1xufVxuLnNpZGViYXIgLnNpZGViYXItZm9vdGVyIC5ub3RpZmljYXRpb25zIC5ub3RpZmljYXRpb24tY29udGVudCAuaWNvbiBpIHtcbiAgd2lkdGg6IDM1cHg7XG4gIGhlaWdodDogMzVweDtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBsaW5lLWhlaWdodDogMzVweDtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xufVxuLnNpZGViYXIgLnNpZGViYXItZm9vdGVyIC5ub3RpZmljYXRpb25zIC5ub3RpZmljYXRpb24tY29udGVudCAuY29udGVudCB7XG4gIGxpbmUtaGVpZ2h0OiAxLjY7XG4gIHBhZGRpbmctbGVmdDogNXB4O1xuICB3aWR0aDogY2FsYygxMDAlIC0gNDBweCk7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgLm5vdGlmaWNhdGlvbnMgLm5vdGlmaWNhdGlvbi1jb250ZW50IC5jb250ZW50IC5ub3RpZmljYXRpb24tdGltZSB7XG4gIGZvbnQtc2l6ZTogMC43cmVtO1xuICBjb2xvcjogIzgyODI4Mjtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciAubm90aWZpY2F0aW9ucyAubm90aWZpY2F0aW9uLWNvbnRlbnQgLmNvbnRlbnQgLm5vdGlmaWNhdGlvbi1kZXRhaWwge1xuICBmb250LXNpemU6IDEycHg7XG4gIHdoaXRlLXNwYWNlOiBub3dyYXA7XG4gIG92ZXJmbG93OiBoaWRkZW47XG4gIHRleHQtb3ZlcmZsb3c6IGVsbGlwc2lzO1xufVxuLnNpZGViYXIgLnNpZGViYXItZm9vdGVyIC5iYWRnZS1zb25hciB7XG4gIGRpc3BsYXk6IGlubGluZS1ibG9jaztcbiAgYmFja2dyb3VuZDogIzk4MDMwMztcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xuICBoZWlnaHQ6IDhweDtcbiAgd2lkdGg6IDhweDtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDA7XG59XG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgLmJhZGdlLXNvbmFyOmFmdGVyIHtcbiAgY29udGVudDogXCJcIjtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDA7XG4gIGxlZnQ6IDA7XG4gIGJvcmRlcjogMnB4IHNvbGlkICM5ODAzMDM7XG4gIG9wYWNpdHk6IDA7XG4gIGJvcmRlci1yYWRpdXM6IDUwJTtcbiAgd2lkdGg6IDEwMCU7XG4gIGhlaWdodDogMTAwJTtcbiAgYW5pbWF0aW9uOiBzb25hciAxLjVzIGluZmluaXRlO1xufVxuXG4vKi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLWRlZmF1bHQgdGhlbWUtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0qL1xuLnNpZGViYXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMWQxZDFkO1xufVxuLnNpZGViYXIgLnNpZGViYXItcHJvZmlsZSxcbi5zaWRlYmFyIC5zaWRlYmFyLXNlYXJjaCxcbi5zaWRlYmFyIC5zaWRlYmFyLW1lbnUge1xuICBib3JkZXItdG9wOiAxcHggc29saWQgIzJiMmIyYjtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLXNlYXJjaCBpbnB1dC5zZWFyY2gtbWVudSxcbi5zaWRlYmFyIC5zaWRlYmFyLXNlYXJjaCAuaW5wdXQtZ3JvdXAtdGV4dCB7XG4gIGJvcmRlci1jb2xvcjogIzJiMmIyYjtcbiAgYm94LXNoYWRvdzogbm9uZTtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLXByb2ZpbGUgLnVzZXItaW5mbyAudXNlci1yb2xlLFxuLnNpZGViYXIgLnNpZGViYXItcHJvZmlsZSAudXNlci1pbmZvIC51c2VyLXN0YXR1cyxcbi5zaWRlYmFyIC5zaWRlYmFyLXNlYXJjaCBpbnB1dC5zZWFyY2gtbWVudSxcbi5zaWRlYmFyIC5zaWRlYmFyLXNlYXJjaCAuaW5wdXQtZ3JvdXAtdGV4dCxcbi5zaWRlYmFyIC5zaWRlYmFyLWhlYWRlciA+IGEsXG4uc2lkZWJhciAuc2lkZWJhci1tZW51IHVsIGxpIGEsXG4uc2lkZWJhciAuc2lkZWJhci1mb290ZXIgPiBkaXYgPiBhLFxuLnNpZGViYXIgI2Nsb3NlLXNpZGViYXIge1xuICBjb2xvcjogI2JkYmRiZDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLW1lbnUgdWwgbGk6aG92ZXIgPiBhLFxuLnNpZGViYXIgLnNpZGViYXItbWVudSAuc2lkZWJhci1kcm9wZG93bi5hY3RpdmUgPiBhLFxuLnNpZGViYXIgLnNpZGViYXItcHJvZmlsZSAudXNlci1pbmZvLFxuLnNpZGViYXIgLnNpZGViYXItaGVhZGVyID4gYTpob3Zlcixcbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciA+IGRpdiA+IGE6aG92ZXIgaSxcbi5zaWRlYmFyICNjbG9zZS1zaWRlYmFyOmhvdmVyIHtcbiAgY29sb3I6ICNmZmZmZmY7XG59XG4uc2lkZWJhciB1bCBsaTpob3ZlciBhIGksXG4uc2lkZWJhciAuc2lkZWJhci1kcm9wZG93biAuc2lkZWJhci1zdWJtZW51IGxpIGE6aG92ZXI6YmVmb3JlLFxuLnNpZGViYXIgLnNpZGViYXItc2VhcmNoIGlucHV0LnNlYXJjaC1tZW51OmZvY3VzICsgc3Bhbixcbi5zaWRlYmFyIC5zaWRlYmFyLW1lbnUgLnNpZGViYXItZHJvcGRvd24uYWN0aXZlIGEgaSB7XG4gIGNvbG9yOiAjZmZmZmZmO1xufVxuLnNpZGViYXIgLnNpZGViYXItbWVudSB1bCBsaSBhIGksXG4uc2lkZWJhciAuc2lkZWJhci1tZW51IC5zaWRlYmFyLWRyb3Bkb3duIGRpdixcbi5zaWRlYmFyIC5zaWRlYmFyLXNlYXJjaCBpbnB1dC5zZWFyY2gtbWVudSxcbi5zaWRlYmFyIC5zaWRlYmFyLXNlYXJjaCAuaW5wdXQtZ3JvdXAtdGV4dCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMyYjJiMmI7XG4gIGJvcmRlcjogbm9uZTtcbiAgbWFyZ2luLWxlZnQ6IDFweDtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLW1lbnUgLmhlYWRlci1tZW51IHNwYW4ge1xuICBjb2xvcjogIzZjN2I4ODtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMyYjJiMmI7XG4gIGJveC1zaGFkb3c6IDBweCAtMXB4IDVweCAjMTMxMjEyO1xuICBib3JkZXItdG9wOiAxcHggc29saWQgIzNhM2EzYTtcbn1cbi5zaWRlYmFyIC5zaWRlYmFyLWZvb3RlciA+IGRpdjpmaXJzdC1jaGlsZCB7XG4gIGJvcmRlci1sZWZ0OiBub25lO1xufVxuLnNpZGViYXIgLnNpZGViYXItZm9vdGVyID4gZGl2Omxhc3QtY2hpbGQge1xuICBib3JkZXItcmlnaHQ6IG5vbmU7XG59XG4uc2lkZWJhci5zaWRlYmFyLWJnIHtcbiAgYmFja2dyb3VuZC1pbWFnZTogdXJsKC9hc3NldHMvaW1nL2JnMS5qcGcpO1xuICBiYWNrZ3JvdW5kLXNpemU6IGNvdmVyO1xuICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiBjZW50ZXI7XG4gIGJhY2tncm91bmQtcmVwZWF0OiBuby1yZXBlYXQ7XG59XG4uc2lkZWJhci5zaWRlYmFyLWJnOmJlZm9yZSB7XG4gIGNvbnRlbnQ6IFwiXCI7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgdG9wOiAwO1xuICByaWdodDogMDtcbiAgYm90dG9tOiAwO1xuICBsZWZ0OiAwO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKDI5LCAyOSwgMjksIDAuOCk7XG59XG4uc2lkZWJhci5zaWRlYmFyLWJnIC5zaWRlYmFyLXByb2ZpbGUsXG4uc2lkZWJhci5zaWRlYmFyLWJnIC5zaWRlYmFyLXNlYXJjaCxcbi5zaWRlYmFyLnNpZGViYXItYmcgLnNpZGViYXItbWVudSB7XG4gIGJvcmRlci10b3A6IDFweCBzb2xpZCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSk7XG59XG4uc2lkZWJhci5zaWRlYmFyLWJnIC5zaWRlYmFyLXNlYXJjaCBpbnB1dC5zZWFyY2gtbWVudSxcbi5zaWRlYmFyLnNpZGViYXItYmcgLnNpZGViYXItc2VhcmNoIC5pbnB1dC1ncm91cC10ZXh0IHtcbiAgYm9yZGVyLWNvbG9yOiByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSk7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4uc2lkZWJhci5zaWRlYmFyLWJnIC5zaWRlYmFyLW1lbnUgdWwgbGkgYSBpLFxuLnNpZGViYXIuc2lkZWJhci1iZyAuc2lkZWJhci1tZW51IC5zaWRlYmFyLWRyb3Bkb3duIGRpdixcbi5zaWRlYmFyLnNpZGViYXItYmcgLnNpZGViYXItc2VhcmNoIGlucHV0LnNlYXJjaC1tZW51LFxuLnNpZGViYXIuc2lkZWJhci1iZyAuc2lkZWJhci1zZWFyY2ggLmlucHV0LWdyb3VwLXRleHQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSk7XG59XG4uc2lkZWJhci5zaWRlYmFyLWJnIC5zaWRlYmFyLWZvb3RlciB7XG4gIGJhY2tncm91bmQtY29sb3I6IHJnYmEoNDMsIDQzLCA0MywgMC41KTtcbiAgYm94LXNoYWRvdzogMHB4IC0xcHggNXB4IHJnYmEoNDMsIDQzLCA0MywgMC41KTtcbiAgYm9yZGVyLXRvcDogMXB4IHNvbGlkIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xKTtcbn0iLCJAa2V5ZnJhbWVzIHN3aW5nIHtcclxuICAwJSB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgwZGVnKTtcclxuICB9XHJcblxyXG4gIDEwJSB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgxMGRlZyk7XHJcbiAgfVxyXG5cclxuICAzMCUge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoMGRlZyk7XHJcbiAgfVxyXG5cclxuICA0MCUge1xyXG4gICAgdHJhbnNmb3JtOiByb3RhdGUoLTEwZGVnKTtcclxuICB9XHJcblxyXG4gIDUwJSB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgwZGVnKTtcclxuICB9XHJcblxyXG4gIDYwJSB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSg1ZGVnKTtcclxuICB9XHJcblxyXG4gIDcwJSB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgwZGVnKTtcclxuICB9XHJcblxyXG4gIDgwJSB7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtNWRlZyk7XHJcbiAgfVxyXG5cclxuICAxMDAlIHtcclxuICAgIHRyYW5zZm9ybTogcm90YXRlKDBkZWcpO1xyXG4gIH1cclxufVxyXG5cclxuQGtleWZyYW1lcyBzb25hciB7XHJcbiAgMCUge1xyXG4gICAgdHJhbnNmb3JtOiBzY2FsZSguOSk7XHJcbiAgICBvcGFjaXR5OiAxO1xyXG4gIH1cclxuXHJcbiAgMTAwJSB7XHJcbiAgICB0cmFuc2Zvcm06IHNjYWxlKDIpO1xyXG4gICAgb3BhY2l0eTogMDtcclxuICB9XHJcbn1cclxuXHJcbi5zaWRlYmFyIHtcclxuICB3aWR0aDogMjYwcHg7XHJcbiAgaGVpZ2h0OiAxMDAlO1xyXG4gIG1heC1oZWlnaHQ6IDEwMCU7XHJcbiAgcG9zaXRpb246IGZpeGVkO1xyXG4gIHRvcDogOTJweDtcclxuICBsZWZ0OiAwcHg7XHJcbiAgei1pbmRleDogOTk5O1xyXG4gIHRyYW5zaXRpb246IGxlZnQgLjNzIGVhc2U7XHJcblxyXG4gIGEge1xyXG4gICAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG4gICAgdHJhbnNpdGlvbjogY29sb3IgLjNzIGVhc2U7XHJcbiAgfVxyXG5cclxuICAuc2lkZWJhci1jb250ZW50IHtcclxuICAgIG1heC1oZWlnaHQ6IGNhbGMoMTAwJSAtIDMwcHgpO1xyXG4gICAgaGVpZ2h0OiBjYWxjKDEwMCUgLSAzMHB4KTtcclxuICAgIG92ZXJmbG93LXk6IGF1dG87XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcblxyXG4gICAgLnNpZGViYXItaGVhZGVyIHtcclxuICAgICAgcGFkZGluZzogMTBweCAyMHB4O1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgPmEge1xyXG4gICAgICAgIHRleHQtdHJhbnNmb3JtOiB1cHBlcmNhc2U7XHJcbiAgICAgICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICAgICAgZmxleC1ncm93OiAxO1xyXG4gICAgICAgIHRleHQtZGVjb3JhdGlvbjogbm9uZTtcclxuICAgICAgfVxyXG5cclxuICAgICAgI2Nsb3NlLXNpZGViYXIge1xyXG4gICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICBmb250LXNpemU6IDIwcHg7XHJcbiAgICAgICAgdHJhbnNpdGlvbjogY29sb3IgLjNzIGVhc2U7XHJcbiAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuc2lkZWJhci1wcm9maWxlIHtcclxuICAgICAgcGFkZGluZzogMjBweDtcclxuICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuXHJcbiAgICAgIC51c2VyLXBpYyB7XHJcbiAgICAgICAgZmxvYXQ6IGxlZnQ7XHJcbiAgICAgICAgd2lkdGg6IDYwcHg7XHJcbiAgICAgICAgcGFkZGluZzogMnB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDEycHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcblxyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICBvYmplY3QtZml0OiBjb3ZlcjtcclxuICAgICAgICAgIGhlaWdodDogMTAwJTtcclxuICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG5cclxuICAgICAgLnVzZXItaW5mbyB7XHJcbiAgICAgICAgZmxvYXQ6IGxlZnQ7XHJcblxyXG4gICAgICAgID5zcGFuIHtcclxuICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnVzZXItcm9sZSB7XHJcbiAgICAgICAgICBmb250LXNpemU6IDEycHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAudXNlci1zdGF0dXMge1xyXG4gICAgICAgICAgZm9udC1zaXplOiAxMXB4O1xyXG4gICAgICAgICAgbWFyZ2luLXRvcDogNHB4O1xyXG5cclxuICAgICAgICAgIGkge1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDhweDtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiA0cHg7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNWNiODVjO1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAuc2lkZWJhci1zZWFyY2gge1xyXG5cclxuICAgICAgPmRpdiB7XHJcbiAgICAgICAgcGFkZGluZzogMTBweCAyMHB4O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuaW5wdXQtZ3JvdXAtYXBwZW5kIC5pbnB1dC1ncm91cC10ZXh0IHtcclxuICAgICAgICBib3JkZXItbGVmdDogMDtcclxuICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5zaWRlYmFyLW1lbnUge1xyXG4gICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuXHJcbiAgICAgIC5oZWFkZXItbWVudSBzcGFuIHtcclxuICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICBmb250LXNpemU6IDE0cHg7XHJcbiAgICAgICAgcGFkZGluZzogMTVweCAyMHB4IDVweCAyMHB4O1xyXG4gICAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgICAgfVxyXG5cclxuXHJcbiAgICAgIHVsIHtcclxuICAgICAgICBsaXN0LXN0eWxlLXR5cGU6IG5vbmU7XHJcbiAgICAgICAgcGFkZGluZzogMDtcclxuICAgICAgICBtYXJnaW46IDA7XHJcblxyXG4gICAgICAgIGxpIGEge1xyXG4gICAgICAgICAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xyXG4gICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XHJcbiAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICBwYWRkaW5nOiA4cHggMzBweCA4cHggMjBweDtcclxuXHJcbiAgICAgICAgICBpIHtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDEycHg7XHJcbiAgICAgICAgICAgIHdpZHRoOiAzMHB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDMwcHg7XHJcbiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDRweDtcclxuICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAmOmhvdmVyPmk6OmJlZm9yZSB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgICAgICAgICAgYW5pbWF0aW9uOiBzd2luZyBlYXNlLWluLW91dCAuNXMgMSBhbHRlcm5hdGU7XHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgc3Bhbi5sYWJlbCxcclxuICAgICAgICAgIHNwYW4uYmFkZ2Uge1xyXG4gICAgICAgICAgICBmbG9hdDogcmlnaHQ7XHJcbiAgICAgICAgICAgIG1hcmdpbi10b3A6IDhweDtcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDVweDtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5zaWRlYmFyLWRyb3Bkb3duIHtcclxuICAgICAgICA+YTphZnRlciB7XHJcbiAgICAgICAgICBmb250LWZhbWlseTogXCJGb250IEF3ZXNvbWUgNSBGcmVlXCI7XHJcbiAgICAgICAgICBmb250LXdlaWdodDogOTAwO1xyXG4gICAgICAgICAgY29udGVudDogXCJcXGYxMDVcIjtcclxuICAgICAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgICAgICAgIGZvbnQtc3R5bGU6IG5vcm1hbDtcclxuICAgICAgICAgIGZvbnQtdmFyaWFudDogbm9ybWFsO1xyXG4gICAgICAgICAgdGV4dC1yZW5kZXJpbmc6IGF1dG87XHJcbiAgICAgICAgICAtd2Via2l0LWZvbnQtc21vb3RoaW5nOiBhbnRpYWxpYXNlZDtcclxuICAgICAgICAgIC1tb3otb3N4LWZvbnQtc21vb3RoaW5nOiBncmF5c2NhbGU7XHJcbiAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAwIDA7XHJcbiAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICByaWdodDogMTVweDtcclxuICAgICAgICAgIHRvcDogMTRweDtcclxuICAgICAgICAgIHRyYW5zaXRpb246IHRyYW5zZm9ybSAuM3MgZWFzZTtcclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuc2lkZWJhci1zdWJtZW51IHtcclxuICAgICAgICAgIC8vIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICBvdmVyZmxvdzogaGlkZGVuO1xyXG5cclxuICAgICAgICAgIHVsIHtcclxuICAgICAgICAgICAgcGFkZGluZzogNXB4IDA7XHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgbGkge1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDI1cHg7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTNweDtcclxuXHJcbiAgICAgICAgICAgIGEge1xyXG4gICAgICAgICAgICAgICY6YmVmb3JlIHtcclxuICAgICAgICAgICAgICAgIGNvbnRlbnQ6IFwiXFxmMTExXCI7XHJcbiAgICAgICAgICAgICAgICBmb250LWZhbWlseTogXCJGb250IEF3ZXNvbWUgNSBGcmVlXCI7XHJcbiAgICAgICAgICAgICAgICBmb250LXdlaWdodDogNDAwO1xyXG4gICAgICAgICAgICAgICAgZm9udC1zdHlsZTogbm9ybWFsO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xyXG4gICAgICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG4gICAgICAgICAgICAgICAgLXdlYmtpdC1mb250LXNtb290aGluZzogYW50aWFsaWFzZWQ7XHJcbiAgICAgICAgICAgICAgICAtbW96LW9zeC1mb250LXNtb290aGluZzogZ3JheXNjYWxlO1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiA4cHg7XHJcbiAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAuYmFkZ2UsXHJcbiAgICAgICAgICAgICAgLmxhYmVsIHtcclxuICAgICAgICAgICAgICAgIGZsb2F0OiByaWdodDtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDBweDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYuYWN0aXZlPmE6YWZ0ZXIge1xyXG4gICAgICAgICAgdHJhbnNmb3JtOiByb3RhdGUoOTBkZWcpO1xyXG4gICAgICAgICAgcmlnaHQ6IDE1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcblxyXG4gICAgfVxyXG5cclxuXHJcbiAgfVxyXG5cclxuICAuc2lkZWJhci1mb290ZXIge1xyXG5cclxuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgYm90dG9tOiAwO1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuXHJcbiAgICA+ZGl2IHtcclxuICAgICAgZmxleC1ncm93OiAxO1xyXG4gICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgbGluZS1oZWlnaHQ6IDMwcHg7XHJcbiAgICAgIHBvc2l0aW9uOiBzdGF0aWM7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcblxyXG4gICAgICA+YSB7XHJcbiAgICAgICAgZmxleC1ncm93OiAxO1xyXG4gICAgICB9XHJcblxyXG4gICAgICBhIC5ub3RpZmljYXRpb24ge1xyXG4gICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICB0b3A6IDA7XHJcbiAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZHJvcGRvd24tbWVudSB7XHJcbiAgICAgIGJvdHRvbTogMzFweDtcclxuICAgICAgbGVmdDogMCAhaW1wb3J0YW50O1xyXG4gICAgICB0b3A6IGluaXRpYWwgIWltcG9ydGFudDtcclxuICAgICAgcmlnaHQ6IDAgIWltcG9ydGFudDtcclxuICAgICAgdHJhbnNmb3JtOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgIGJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6IDA7XHJcbiAgICAgIGJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOiAwO1xyXG4gICAgICBmb250LXNpemU6IC45cmVtO1xyXG4gICAgfVxyXG5cclxuICAgIC5tZXNzYWdlcyB7XHJcbiAgICAgIC5kcm9wZG93bi1pdGVtIHtcclxuICAgICAgICBwYWRkaW5nOiAuMjVyZW0gMXJlbTtcclxuICAgICAgfVxyXG5cclxuICAgICAgLm1lc3NhZ2VzLWhlYWRlciB7XHJcbiAgICAgICAgcGFkZGluZzogMCAxcmVtO1xyXG4gICAgICB9XHJcblxyXG4gICAgICAubWVzc2FnZS1jb250ZW50IHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG5cclxuICAgICAgICAucGljIHtcclxuICAgICAgICAgIHdpZHRoOiA0MHB4O1xyXG4gICAgICAgICAgaGVpZ2h0OiA0MHB4O1xyXG4gICAgICAgICAgYm9yZGVyLXJhZGl1czogNHB4O1xyXG4gICAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuXHJcbiAgICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICBvYmplY3QtZml0OiBjb3ZlcjtcclxuICAgICAgICAgICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmNvbnRlbnQge1xyXG4gICAgICAgICAgbGluZS1oZWlnaHQ6IDEuNjtcclxuICAgICAgICAgIHBhZGRpbmctbGVmdDogNXB4O1xyXG4gICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDQwcHgpO1xyXG5cclxuICAgICAgICAgIC5tZXNzYWdlLXRpdGxlIHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxM3B4O1xyXG4gICAgICAgICAgfVxyXG5cclxuICAgICAgICAgIC5tZXNzYWdlLWRldGFpbCB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTJweDtcclxuICAgICAgICAgICAgd2hpdGUtc3BhY2U6IG5vd3JhcDtcclxuICAgICAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgICAgICAgICAgdGV4dC1vdmVyZmxvdzogZWxsaXBzaXM7XHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAubm90aWZpY2F0aW9ucyB7XHJcbiAgICAgIC5kcm9wZG93bi1pdGVtIHtcclxuICAgICAgICBwYWRkaW5nOiAuMjVyZW0gMXJlbTtcclxuICAgICAgfVxyXG5cclxuICAgICAgLm5vdGlmaWNhdGlvbnMtaGVhZGVyIHtcclxuICAgICAgICBwYWRkaW5nOiAwIDFyZW07XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5ub3RpZmljYXRpb24tY29udGVudCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuXHJcbiAgICAgICAgLmljb24ge1xyXG4gICAgICAgICAgd2lkdGg6IDQwcHg7XHJcbiAgICAgICAgICBoZWlnaHQ6IDQwcHg7XHJcblxyXG4gICAgICAgICAgaSB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAzNXB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDM1cHg7XHJcbiAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDM1cHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDRweDtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5jb250ZW50IHtcclxuICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxLjY7XHJcbiAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDVweDtcclxuICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSA0MHB4KTtcclxuXHJcbiAgICAgICAgICAubm90aWZpY2F0aW9uLXRpbWUge1xyXG4gICAgICAgICAgICBmb250LXNpemU6IC43cmVtO1xyXG4gICAgICAgICAgICBjb2xvcjogIzgyODI4MjtcclxuICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAubm90aWZpY2F0aW9uLWRldGFpbCB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTJweDtcclxuICAgICAgICAgICAgd2hpdGUtc3BhY2U6IG5vd3JhcDtcclxuICAgICAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgICAgICAgICAgdGV4dC1vdmVyZmxvdzogZWxsaXBzaXM7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG5cclxuICAgIC5iYWRnZS1zb25hciB7XHJcbiAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgICAgYmFja2dyb3VuZDogIzk4MDMwMztcclxuICAgICAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gICAgICBoZWlnaHQ6IDhweDtcclxuICAgICAgd2lkdGg6IDhweDtcclxuICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICB0b3A6IDA7XHJcblxyXG4gICAgICAmOmFmdGVyIHtcclxuICAgICAgICBjb250ZW50OiAnJztcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgdG9wOiAwO1xyXG4gICAgICAgIGxlZnQ6IDA7XHJcbiAgICAgICAgYm9yZGVyOiAycHggc29saWQgIzk4MDMwMztcclxuICAgICAgICBvcGFjaXR5OiAwO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDUwJTtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgICAgYW5pbWF0aW9uOiBzb25hciAxLjVzIGluZmluaXRlO1xyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG5cclxuICB9XHJcbn1cclxuXHJcblxyXG4vKi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLWRlZmF1bHQgdGhlbWUtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0qL1xyXG4kYmctc2lkZWJhci13cmFwcGVyIDogIzFkMWQxZDtcclxuJGJvcmRlci1jb2xvciA6ICMyYjJiMmI7XHJcbiRmb290ZXItdG9wLWJvcmRlci1jb2xvciA6IzNhM2EzYTtcclxuJGNvbG9yOiNiZGJkYmQ7XHJcbiRoZWFkZXItbWVudS1jb2xvciA6IzZjN2I4ODtcclxuJGhvdmVyLWNvbG9yOiNmZmZmZmY7XHJcbiRzaGFkb3ctY29sb3I6IzEzMTIxMjtcclxuJGJnLXNjcm9sbGJhciA6IzYzNjM2MztcclxuXHJcbi8vIGNvbG9ycyB3aXRoIGJhY2tnb3VuZCBpbWFnZVxyXG4kaW1nLWJnLXNpZGViYXItd3JhcHBlciA6IHJnYmEoMjksIDI5LCAyOSwgMC44KTtcclxuJGltZy1ib3JkZXItY29sb3IgOiByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSk7XHJcbiRpbWctYmctZm9vdGVyIDpyZ2JhKDQzLCA0MywgNDMsIDAuNSk7XHJcbiRpbWctc2hhZG93LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41KTtcclxuXHJcblxyXG5cclxuLnNpZGViYXIge1xyXG5cclxuICBiYWNrZ3JvdW5kLWNvbG9yOiAkYmctc2lkZWJhci13cmFwcGVyO1xyXG5cclxuICAuc2lkZWJhci1wcm9maWxlLFxyXG4gIC5zaWRlYmFyLXNlYXJjaCxcclxuICAuc2lkZWJhci1tZW51IHtcclxuICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAkYm9yZGVyLWNvbG9yO1xyXG4gIH1cclxuXHJcbiAgLnNpZGViYXItc2VhcmNoIGlucHV0LnNlYXJjaC1tZW51LFxyXG4gIC5zaWRlYmFyLXNlYXJjaCAuaW5wdXQtZ3JvdXAtdGV4dCB7XHJcbiAgICBib3JkZXItY29sb3I6ICRib3JkZXItY29sb3I7XHJcbiAgICBib3gtc2hhZG93OiBub25lO1xyXG4gIH1cclxuXHJcbiAgLnNpZGViYXItcHJvZmlsZSAudXNlci1pbmZvIC51c2VyLXJvbGUsXHJcbiAgLnNpZGViYXItcHJvZmlsZSAudXNlci1pbmZvIC51c2VyLXN0YXR1cyxcclxuICAuc2lkZWJhci1zZWFyY2ggaW5wdXQuc2VhcmNoLW1lbnUsXHJcbiAgLnNpZGViYXItc2VhcmNoIC5pbnB1dC1ncm91cC10ZXh0LFxyXG4gIC5zaWRlYmFyLWhlYWRlcj5hLFxyXG4gIC5zaWRlYmFyLW1lbnUgdWwgbGkgYSxcclxuICAuc2lkZWJhci1mb290ZXI+ZGl2PmEsXHJcbiAgI2Nsb3NlLXNpZGViYXIge1xyXG4gICAgY29sb3I6ICRjb2xvcjtcclxuICB9XHJcblxyXG4gIC5zaWRlYmFyLW1lbnUgdWwgbGk6aG92ZXI+YSxcclxuICAuc2lkZWJhci1tZW51IC5zaWRlYmFyLWRyb3Bkb3duLmFjdGl2ZT5hLFxyXG4gIC5zaWRlYmFyLXByb2ZpbGUgLnVzZXItaW5mbyxcclxuICAuc2lkZWJhci1oZWFkZXI+YTpob3ZlcixcclxuICAuc2lkZWJhci1mb290ZXI+ZGl2PmE6aG92ZXIgaSxcclxuICAjY2xvc2Utc2lkZWJhcjpob3ZlciB7XHJcbiAgICBjb2xvcjogJGhvdmVyLWNvbG9yO1xyXG4gIH1cclxuXHJcbiAgdWwgbGk6aG92ZXIgYSBpLFxyXG4gIC5zaWRlYmFyLWRyb3Bkb3duIC5zaWRlYmFyLXN1Ym1lbnUgbGkgYTpob3ZlcjpiZWZvcmUsXHJcbiAgLnNpZGViYXItc2VhcmNoIGlucHV0LnNlYXJjaC1tZW51OmZvY3VzK3NwYW4sXHJcbiAgLnNpZGViYXItbWVudSAuc2lkZWJhci1kcm9wZG93bi5hY3RpdmUgYSBpIHtcclxuICAgIGNvbG9yOiAkaG92ZXItY29sb3I7XHJcbiAgfVxyXG5cclxuICAuc2lkZWJhci1tZW51IHVsIGxpIGEgaSxcclxuICAuc2lkZWJhci1tZW51IC5zaWRlYmFyLWRyb3Bkb3duIGRpdixcclxuICAuc2lkZWJhci1zZWFyY2ggaW5wdXQuc2VhcmNoLW1lbnUsXHJcbiAgLnNpZGViYXItc2VhcmNoIC5pbnB1dC1ncm91cC10ZXh0IHtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICRib3JkZXItY29sb3I7XHJcbiAgICBib3JkZXI6IG5vbmU7XHJcbiAgICBtYXJnaW4tbGVmdDogMXB4O1xyXG4gIH1cclxuXHJcbiAgLnNpZGViYXItbWVudSAuaGVhZGVyLW1lbnUgc3BhbiB7XHJcbiAgICBjb2xvcjogJGhlYWRlci1tZW51LWNvbG9yO1xyXG4gIH1cclxuXHJcbiAgLnNpZGViYXItZm9vdGVyIHtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICRib3JkZXItY29sb3I7XHJcbiAgICBib3gtc2hhZG93OiAwcHggLTFweCA1cHggJHNoYWRvdy1jb2xvcjtcclxuICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAkZm9vdGVyLXRvcC1ib3JkZXItY29sb3I7XHJcbiAgfVxyXG5cclxuICAuc2lkZWJhci1mb290ZXI+ZGl2OmZpcnN0LWNoaWxkIHtcclxuICAgIGJvcmRlci1sZWZ0OiBub25lO1xyXG4gIH1cclxuXHJcbiAgLnNpZGViYXItZm9vdGVyPmRpdjpsYXN0LWNoaWxkIHtcclxuICAgIGJvcmRlci1yaWdodDogbm9uZTtcclxuICB9XHJcblxyXG4gIC8vIHN0eWxlcyB3aXRoIGJhY2tncm91bmQgaW1hZ2VcclxuICAmLnNpZGViYXItYmcge1xyXG5cclxuICAgIGJhY2tncm91bmQtaW1hZ2U6IHVybCgvYXNzZXRzL2ltZy9iZzEuanBnKTtcclxuICAgIGJhY2tncm91bmQtc2l6ZTogY292ZXI7XHJcbiAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiBjZW50ZXI7XHJcbiAgICBiYWNrZ3JvdW5kLXJlcGVhdDogbm8tcmVwZWF0O1xyXG5cclxuICAgICY6YmVmb3JlIHtcclxuICAgICAgY29udGVudDogJyc7XHJcbiAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgdG9wOiAwO1xyXG4gICAgICByaWdodDogMDtcclxuICAgICAgYm90dG9tOiAwO1xyXG4gICAgICBsZWZ0OiAwO1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAkaW1nLWJnLXNpZGViYXItd3JhcHBlcjtcclxuICAgIH1cclxuXHJcbiAgICAuc2lkZWJhci1wcm9maWxlLFxyXG4gICAgLnNpZGViYXItc2VhcmNoLFxyXG4gICAgLnNpZGViYXItbWVudSB7XHJcbiAgICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAkaW1nLWJvcmRlci1jb2xvcjtcclxuICAgIH1cclxuXHJcbiAgICAuc2lkZWJhci1zZWFyY2ggaW5wdXQuc2VhcmNoLW1lbnUsXHJcbiAgICAuc2lkZWJhci1zZWFyY2ggLmlucHV0LWdyb3VwLXRleHQge1xyXG4gICAgICBib3JkZXItY29sb3I6ICRpbWctYm9yZGVyLWNvbG9yO1xyXG4gICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgfVxyXG5cclxuICAgIC5zaWRlYmFyLW1lbnUgdWwgbGkgYSBpLFxyXG4gICAgLnNpZGViYXItbWVudSAuc2lkZWJhci1kcm9wZG93biBkaXYsXHJcbiAgICAuc2lkZWJhci1zZWFyY2ggaW5wdXQuc2VhcmNoLW1lbnUsXHJcbiAgICAuc2lkZWJhci1zZWFyY2ggLmlucHV0LWdyb3VwLXRleHQge1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAkaW1nLWJvcmRlci1jb2xvcjtcclxuXHJcbiAgICB9XHJcblxyXG4gICAgLnNpZGViYXItZm9vdGVyIHtcclxuICAgICAgYmFja2dyb3VuZC1jb2xvcjogJGltZy1iZy1mb290ZXI7XHJcbiAgICAgIGJveC1zaGFkb3c6IDBweCAtMXB4IDVweCAkaW1nLWJnLWZvb3RlcjtcclxuICAgICAgYm9yZGVyLXRvcDogMXB4IHNvbGlkICRpbWctYm9yZGVyLWNvbG9yO1xyXG4gICAgfVxyXG5cclxuICB9XHJcblxyXG59XHJcbiJdfQ== */";
    /***/
  },

  /***/
  "./src/app/hero.service.ts":
  /*!*********************************!*\
    !*** ./src/app/hero.service.ts ***!
    \*********************************/

  /*! exports provided: HeroService */

  /***/
  function srcAppHeroServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "HeroService", function () {
      return HeroService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/fesm2015/http.js");
    /* harmony import */


    var rxjs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! rxjs */
    "./node_modules/rxjs/_esm2015/index.js");
    /* harmony import */


    var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! rxjs/operators */
    "./node_modules/rxjs/_esm2015/operators/index.js");
    /* harmony import */


    var _hero__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./hero */
    "./src/app/hero.ts");
    /* harmony import */


    var _message_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./message.service */
    "./src/app/message.service.ts");

    var HeroService =
    /*#__PURE__*/
    function () {
      function HeroService(http, messageService) {
        _classCallCheck(this, HeroService);

        this.http = http;
        this.messageService = messageService; //https://imagefootage.com/backend/api/ For Live
        //http://localhost/imagefootagenew/backend/api/ For Local

        this.heroesUrl = 'https://imagefootage.com/backend/api/'; // URL to web api

        this.localhostUrl = 'http://localhost/imagefootagenew/backend/api/';
        this.carouselImagesUrl = 'api/carouselImages';
        this.aosImagesUrl = 'api/aosImages';
        this.countryUrl = "https://raw.githubusercontent.com/sagarshirbhate/Country-State-City-Database/master/Contries.json";
        this.httpOptions = {
          headers: new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json'
          })
        };
        this.currentUserSubject = new rxjs__WEBPACK_IMPORTED_MODULE_3__["BehaviorSubject"](JSON.parse(localStorage.getItem('currentUser')));
        this.currentUser = this.currentUserSubject.asObservable();
      }

      _createClass(HeroService, [{
        key: "allCountries",
        value: function allCountries() {
          var url = "".concat(this.heroesUrl, "getCountyStatesCityList"); //return this.http.get(this.countryUrl);

          return this.http.get(url);
        }
      }, {
        key: "allstates",
        value: function allstates(country) {
          var url = "".concat(this.heroesUrl, "getCountyStatesList/") + country; //return this.http.get(this.countryUrl);

          return this.http.get(url);
        }
      }, {
        key: "allCities",
        value: function allCities(state) {
          var url = "".concat(this.heroesUrl, "getStateCityList/") + state; //return this.http.get(this.countryUrl);

          return this.http.get(url);
        }
        /** GET Slider Images from the server */

      }, {
        key: "getcarouselSliderImages",
        value: function getcarouselSliderImages() {
          var url = "".concat(this.heroesUrl, "categoryListApi");
          var data = this.http.get(url);
          return data; //console.log(categories);
          // if(data) {

          var _carouselSlider = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();

          var _carouselSliderArray = new Array();

          _carouselSlider.id = 1;
          _carouselSlider.categoryNames = data["0"]; // [{id: data[], name: 'Skin Care'}, {id: 2, name: 'Cannabis'}, {
          //     id: 3,
          //     name: 'Business'
          // }, {id: 4, name: 'Curated'}, {id: 5, name: 'Video'}, {id: 6, name: 'Autumn'}]

          _carouselSliderArray.push(_carouselSlider);

          var _carouselSlider1 = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();

          _carouselSlider1.id = 2;
          _carouselSlider1.categoryNames = data["1"]; //     [{id: 11, name: 'Dr Nice'}, {id: 12, name: 'Narco'}, {
          //     id: 13,
          //     name: 'Bombasto'
          // }, {id: 14, name: 'Celeritas'}, {id: 15, name: 'Magneta'}, {id: 16, name: 'RubberMan'}]

          _carouselSliderArray.push(_carouselSlider1);

          var _carouselSlider2 = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();

          _carouselSlider2.id = 3;
          _carouselSlider2.categoryNames = data["2"]; //     [{id: 21, name: 'Family'}, {id: 22, name: 'Halloween'}, {
          //     id: 23,
          //     name: 'Seniors'
          // }, {id: 24, name: 'Cats & Dogs'}, {id: 25, name: 'Time to Party'}, {id: 26, name: 'Food'}]

          _carouselSliderArray.push(_carouselSlider2);

          var _carouselSlider3 = new _hero__WEBPACK_IMPORTED_MODULE_5__["carouselSlider"]();

          _carouselSlider3.id = 4;
          _carouselSlider3.categoryNames = data["4"]; //     [{id: 31, name: 'The Digital Frontier'}, {
          //     id: 32,
          //     name: 'Christmas'
          // }, {id: 33, name: 'Real People & Places'}, {id: 34, name: 'Art & Concept'}, {
          //     id: 35,
          //     name: 'Magma'
          // }, {id: 36, name: 'Tornado'}]

          _carouselSliderArray.push(_carouselSlider3); //return _carouselSliderArray;
          //}
          // return aosImagesUrl;

        }
        /** GET Slider Images from the server */

        /** GET Slider Images from the server */

      }, {
        key: "getAosSliderImages",
        value: function getAosSliderImages() {
          var url = "".concat(this.heroesUrl, "home");
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (aosImagesUrl) {
            return aosImagesUrl.api; // return aosImagesUrl;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getCarouselImages', [])));
        }
      }, {
        key: "getAosSliderSearchImages",
        value: function getAosSliderSearchImages(searchData) {
          var url = "".concat(this.heroesUrl, "search");
          /* if(searchData.productType == 2){
             url = `${this.localhostUrl}search`;
           }*/

          return this.http.post(url, searchData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (searchResultSet) {
            return searchResultSet.imgfootage;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "getSearchLeftFilter",
        value: function getSearchLeftFilter() {
          var url = "".concat(this.heroesUrl, "get_side_filtes");
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (searchSideMenu) {
            return searchSideMenu.data; // return aosImagesUrl;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('searchSideMenu', [])));
        }
      }, {
        key: "getLogin",
        value: function getLogin(email, password) {
          var _this29 = this;

          var url = "".concat(this.heroesUrl, "login");
          return this.http.post(url, {
            email: email,
            password: password
          }, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (user) {
            console.log(user);
            localStorage.setItem('currentUser', JSON.stringify(user));

            _this29.currentUserSubject.next(user);

            return user;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "fbLogin",
        value: function fbLogin(userData) {
          var _this30 = this;

          var url = "".concat(this.heroesUrl, "fbLogin");
          return this.http.post(url, {
            userData: userData
          }, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (user) {
            console.log(user);
            localStorage.setItem('currentUser', JSON.stringify(user));

            _this30.currentUserSubject.next(user);

            return user;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "register",
        value: function register(usrData) {
          var _this31 = this;

          var url = "".concat(this.heroesUrl, "signup");
          return this.http.post(url, usrData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (userInfo) {
            console.log(userInfo);

            if (userInfo['status'] == '1') {
              localStorage.setItem('currentUser', JSON.stringify(userInfo['userdata']));

              _this31.currentUserSubject.next(userInfo['userdata']);
            }

            return userInfo;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to register data")));
          ;
        }
      }, {
        key: "contributorRegister",
        value: function contributorRegister(contributorData) {
          var url = "".concat(this.heroesUrl, "contributorSignup");
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': undefined
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, contributorData).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (contributorInfo) {
            return contributorInfo;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to register data")));
          ;
        }
      }, {
        key: "resendOtp",
        value: function resendOtp(email, mobile) {
          var url = "".concat(this.heroesUrl, "resendOtp");
          return this.http.post(url, {
            email: email,
            mobile: mobile
          }, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (otpInfo) {
            return otpInfo;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to resend otp data")));
        }
      }, {
        key: "verifyOtp",
        value: function verifyOtp(email, mobile, otp) {
          var url = "".concat(this.heroesUrl, "verifyOtp");
          return this.http.post(url, {
            email: email,
            mobile: mobile,
            otp: otp
          }, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (verifyInfo) {
            return verifyInfo;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to verify data")));
        }
      }, {
        key: "contactUs",
        value: function contactUs(contactData) {
          var url = "".concat(this.heroesUrl, "user_contactus");
          return this.http.post(url, contactData, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (userInfo) {
            return true;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to user_contactus data")));
          ;
        }
      }, {
        key: "logout",
        value: function logout() {
          localStorage.removeItem('currentUser');
          this.currentUserSubject.next(null);
        }
      }, {
        key: "getcategoryCarouselImages",
        value: function getcategoryCarouselImages(categoryId) {
          var _this32 = this;

          var url = "api/detailPageCarouselImages/?".concat(categoryId);
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this32.log("fetched CarouselImages id=".concat(categoryId));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=".concat(categoryId))));
        }
      }, {
        key: "getDetailPagedetails",
        value: function getDetailPagedetails(id, webtype, type) {
          var _this33 = this;

          console.log(id); //const url = `api/detailPageInfo/?${id}`;

          var url = "".concat(this.heroesUrl, "details/").concat(id, "/").concat(webtype, "/").concat(type);
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this33.log("fetched detail Page Info id=".concat(id));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=".concat(id))));
        }
      }, {
        key: "addcartItemsData",
        value: function addcartItemsData(product) {
          var url = "".concat(this.heroesUrl, "add_to_cart");
          var tokenData = JSON.parse(product.token);
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.token
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, {
            product: product
          }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (cart) {
            console.log(cart); //this.currentUserSubject.next(cart);

            return cart;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "removeCartItemsData",
        value: function removeCartItemsData(product) {
          console.log(product);
          var url = "".concat(this.heroesUrl, "delete_cart_item"); //let tokenData =JSON.parse(product.token);

          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json'
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, {
            product: product
          }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (cart) {
            console.log(cart);
            return cart;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "getcartItemsData",
        value: function getcartItemsData() {
          //let params = new HttpParams();
          var url = "".concat(this.heroesUrl, "user_cart_list");
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.access_token
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, tokenData, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (cart) {
            console.log(cart); //this.currentUserSubject.next(cart);

            return cart;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "getMarketdeatils",
        value: function getMarketdeatils() {
          var _this34 = this;

          var url = "api/marketFreeze";
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this34.log("fetched market Info id");
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id")));
        }
        /** GET heroes from the server */

      }, {
        key: "getHeroes",
        value: function getHeroes() {
          var _this35 = this;

          return this.http.get(this.heroesUrl).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this35.log('fetched heroes');
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('getHeroes', [])));
        }
        /** GET hero by id. Return `undefined` when id not found */

      }, {
        key: "getHeroNo404",
        value: function getHeroNo404(id) {
          var _this36 = this;

          var url = "".concat(this.heroesUrl, "/?id=").concat(id);
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (heroes) {
            return heroes[0];
          }), // returns a {0|1} element array
          Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (h) {
            var outcome = h ? "fetched" : "did not find";

            _this36.log("".concat(outcome, " hero id=").concat(id));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=".concat(id))));
        }
        /** GET hero by id. Will 404 if id not found */

      }, {
        key: "getHero",
        value: function getHero(id) {
          var _this37 = this;

          var url = "".concat(this.heroesUrl, "/").concat(id);
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this37.log("fetched hero id=".concat(id));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("getHero id=".concat(id))));
        }
        /* GET heroes whose name contains search term */

      }, {
        key: "searchHeroes",
        value: function searchHeroes(term) {
          var _this38 = this;

          if (!term.trim()) {
            // if not search term, return empty hero array.
            return Object(rxjs__WEBPACK_IMPORTED_MODULE_3__["of"])([]);
          }

          return this.http.get("".concat(this.heroesUrl, "/?name=").concat(term)).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this38.log("found heroes matching \"".concat(term, "\""));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('searchHeroes', [])));
        } //////// Save methods //////////

        /** POST: add a new hero to the server */

      }, {
        key: "addHero",
        value: function addHero(hero) {
          var _this39 = this;

          return this.http.post(this.heroesUrl, hero, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (newHero) {
            return _this39.log("added hero w/ id=".concat(newHero.id));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('addHero')));
        }
        /** DELETE: delete the hero from the server */

      }, {
        key: "deleteHero",
        value: function deleteHero(hero) {
          var _this40 = this;

          var id = typeof hero === 'number' ? hero : hero.id;
          var url = "".concat(this.heroesUrl, "/").concat(id);
          return this.http.delete(url, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this40.log("deleted hero id=".concat(id));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('deleteHero')));
        }
        /** PUT: update the hero on the server */

      }, {
        key: "updateHero",
        value: function updateHero(hero) {
          var _this41 = this;

          return this.http.put(this.heroesUrl, hero, this.httpOptions).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["tap"])(function (_) {
            return _this41.log("updated hero id=".concat(hero.id));
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError('updateHero')));
        }
        /**
         * Handle Http operation that failed.
         * Let the app continue.
         * @param operation - name of the operation that failed
         * @param result - optional value to return as the observable result
         */

      }, {
        key: "handleError",
        value: function handleError() {
          var _this42 = this;

          var operation = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'operation';
          var result = arguments.length > 1 ? arguments[1] : undefined;
          return function (error) {
            // TODO: send the error to remote logging infrastructure
            console.error(error); // log to console instead
            // TODO: better job of transforming error for user consumption

            _this42.log("".concat(operation, " failed: ").concat(error.message)); // Let the app keep running by returning an empty result.


            return Object(rxjs__WEBPACK_IMPORTED_MODULE_3__["of"])(result);
          };
        }
        /** Log a HeroService message with the MessageService */

      }, {
        key: "log",
        value: function log(message) {
          this.messageService.add("HeroService: ".concat(message));
        }
      }, {
        key: "payment",
        value: function payment(usrData, cartval, type) {
          var url = "".concat(this.heroesUrl, "payment");
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));

          if (type == 'atom') {
            var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
              'Content-Type': 'application/json',
              'Authorization': 'Bearer ' + tokenData.access_token
            });
            var options = {
              headers: headers
            };
            return this.http.post(url, {
              usrData: usrData,
              cartval: cartval,
              type: type,
              tokenData: tokenData
            }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (userInfo) {
              return userInfo;
            }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to register data")));
            ;
          } else if (type == 'payu') {
            var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
              'Content-Type': 'application/json',
              'Authorization': 'Bearer ' + tokenData.access_token
            });
            var _options = {
              headers: headers
            };
            return this.http.post(url, {
              usrData: usrData,
              cartval: cartval,
              type: type,
              tokenData: tokenData
            }, _options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (userInfo) {
              return userInfo; //console.log(JSON.stringify(userInfo));
              //return JSON.stringify(userInfo);
            }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to register data")));
          }
        }
      }, {
        key: "getOrderDetails",
        value: function getOrderDetails(id) {
          //let params = new HttpParams();
          var url = "".concat(this.heroesUrl, "orderDetails");
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.access_token
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, {
            id: id
          }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (orderDetails) {
            console.log(orderDetails); //this.currentUserSubject.next(cart);

            return orderDetails;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "getUserprofileData",
        value: function getUserprofileData() {
          //let params = new HttpParams();
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));
          var url = "".concat(this.heroesUrl, "userprofile/") + tokenData.Utype;
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (UserProfile) {
            //console.log(UserProfile);
            //this.currentUserSubject.next(cart);
            return UserProfile;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "resetPassword",
        value: function resetPassword(email) {
          var url = "".concat(this.heroesUrl, "validUser");
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json'
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, {
            email: email
          }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (userInfo) {
            return userInfo; //console.log(JSON.stringify(userInfo));
            //return JSON.stringify(userInfo);
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to register data")));
        }
      }, {
        key: "getUserOrderData",
        value: function getUserOrderData() {
          //let params = new HttpParams();
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));
          var url = "".concat(this.heroesUrl, "userOrders/") + tokenData.Utype;
          return this.http.get(url).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (orders) {
            console.log(orders); //this.currentUserSubject.next(cart);

            return orders;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "getLightboxItemsData",
        value: function getLightboxItemsData() {
          //let params = new HttpParams();
          var url = "".concat(this.heroesUrl, "wishlist");
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.access_token
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, tokenData, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (lightBox) {
            console.log(lightBox); //this.currentUserSubject.next(cart);

            return lightBox;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "removeDataFromWishlist",
        value: function removeDataFromWishlist(product) {
          var url = "".concat(this.heroesUrl, "delete_wishlist_product");
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.access_token
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, {
            product: product,
            tokenData: tokenData
          }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (lightBox) {
            console.log(lightBox); //this.currentUserSubject.next(cart);

            return lightBox;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "addWishListItemsData",
        value: function addWishListItemsData(product) {
          var url = "".concat(this.heroesUrl, "addto_wishlist");
          var tokenData = JSON.parse(localStorage.getItem('currentUser'));
          var headers = new _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpHeaders"]({
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + tokenData.access_token
          });
          var options = {
            headers: headers
          };
          return this.http.post(url, {
            product: product,
            tokenData: tokenData
          }, options).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["map"])(function (lightBox) {
            console.log(lightBox); //this.currentUserSubject.next(cart);

            return lightBox;
          }), Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["catchError"])(this.handleError("unable to get data")));
        }
      }, {
        key: "currentUserValue",
        get: function get() {
          return this.currentUserSubject.value;
        }
      }]);

      return HeroService;
    }();

    HeroService.ctorParameters = function () {
      return [{
        type: _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"]
      }, {
        type: _message_service__WEBPACK_IMPORTED_MODULE_6__["MessageService"]
      }];
    };

    HeroService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"], _message_service__WEBPACK_IMPORTED_MODULE_6__["MessageService"]])], HeroService);
    /***/
  },

  /***/
  "./src/app/hero.ts":
  /*!*************************!*\
    !*** ./src/app/hero.ts ***!
    \*************************/

  /*! exports provided: Hero, carouselSlider, Category, Search, aosSlider, userData, carouselSliderImages, detailPageInfo, market, cartItemData */

  /***/
  function srcAppHeroTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "Hero", function () {
      return Hero;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "carouselSlider", function () {
      return carouselSlider;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "Category", function () {
      return Category;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "Search", function () {
      return Search;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "aosSlider", function () {
      return aosSlider;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "userData", function () {
      return userData;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "carouselSliderImages", function () {
      return carouselSliderImages;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "detailPageInfo", function () {
      return detailPageInfo;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "market", function () {
      return market;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "cartItemData", function () {
      return cartItemData;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");

    var Hero = function Hero() {
      _classCallCheck(this, Hero);
    };

    var carouselSlider = function carouselSlider() {
      _classCallCheck(this, carouselSlider);
    };

    var Category = function Category() {
      _classCallCheck(this, Category);
    };

    var Search = function Search() {
      _classCallCheck(this, Search);
    };

    var aosSlider = function aosSlider() {
      _classCallCheck(this, aosSlider);
    };

    var userData = function userData() {
      _classCallCheck(this, userData);
    };

    var carouselSliderImages = function carouselSliderImages() {
      _classCallCheck(this, carouselSliderImages);
    };

    var detailPageInfo = function detailPageInfo() {
      _classCallCheck(this, detailPageInfo);
    };

    var market = function market() {
      _classCallCheck(this, market);
    };

    var cartItemData = function cartItemData() {
      _classCallCheck(this, cartItemData);
    };
    /***/

  },

  /***/
  "./src/app/heroes/heroes.component.css":
  /*!*********************************************!*\
    !*** ./src/app/heroes/heroes.component.css ***!
    \*********************************************/

  /*! exports provided: default */

  /***/
  function srcAppHeroesHeroesComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "/* HeroesComponent's private CSS styles */\n.heroes {\n  margin: 0 0 2em 0;\n  list-style-type: none;\n  padding: 0;\n  width: 15em;\n}\n.heroes li {\n  position: relative;\n  cursor: pointer;\n  background-color: #EEE;\n  margin: .5em;\n  padding: .3em 0;\n  height: 1.6em;\n  border-radius: 4px;\n}\n.heroes li:hover {\n  color: #607D8B;\n  background-color: #DDD;\n  left: .1em;\n}\n.heroes a {\n  color: #333;\n  text-decoration: none;\n  position: relative;\n  display: block;\n  width: 250px;\n}\n.heroes a:hover {\n  color:#607D8B;\n}\n.heroes .badge {\n  display: inline-block;\n  font-size: small;\n  color: white;\n  padding: 0.8em 0.7em 0 0.7em;\n  background-color:#405061;\n  line-height: 1em;\n  position: relative;\n  left: -1px;\n  top: -4px;\n  height: 1.8em;\n  min-width: 16px;\n  text-align: right;\n  margin-right: .8em;\n  border-radius: 4px 0 0 4px;\n}\nbutton {\n  background-color: #eee;\n  border: none;\n  padding: 5px 10px;\n  border-radius: 4px;\n  cursor: pointer;\n  cursor: hand;\n  font-family: Arial;\n}\nbutton:hover {\n  background-color: #cfd8dc;\n}\nbutton.delete {\n  position: relative;\n  left: 194px;\n  top: -32px;\n  background-color: gray !important;\n  color: white;\n}\n\n\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaGVyb2VzL2hlcm9lcy5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLHlDQUF5QztBQUN6QztFQUNFLGlCQUFpQjtFQUNqQixxQkFBcUI7RUFDckIsVUFBVTtFQUNWLFdBQVc7QUFDYjtBQUNBO0VBQ0Usa0JBQWtCO0VBQ2xCLGVBQWU7RUFDZixzQkFBc0I7RUFDdEIsWUFBWTtFQUNaLGVBQWU7RUFDZixhQUFhO0VBQ2Isa0JBQWtCO0FBQ3BCO0FBRUE7RUFDRSxjQUFjO0VBQ2Qsc0JBQXNCO0VBQ3RCLFVBQVU7QUFDWjtBQUVBO0VBQ0UsV0FBVztFQUNYLHFCQUFxQjtFQUNyQixrQkFBa0I7RUFDbEIsY0FBYztFQUNkLFlBQVk7QUFDZDtBQUVBO0VBQ0UsYUFBYTtBQUNmO0FBRUE7RUFDRSxxQkFBcUI7RUFDckIsZ0JBQWdCO0VBQ2hCLFlBQVk7RUFDWiw0QkFBNEI7RUFDNUIsd0JBQXdCO0VBQ3hCLGdCQUFnQjtFQUNoQixrQkFBa0I7RUFDbEIsVUFBVTtFQUNWLFNBQVM7RUFDVCxhQUFhO0VBQ2IsZUFBZTtFQUNmLGlCQUFpQjtFQUNqQixrQkFBa0I7RUFDbEIsMEJBQTBCO0FBQzVCO0FBRUE7RUFDRSxzQkFBc0I7RUFDdEIsWUFBWTtFQUNaLGlCQUFpQjtFQUNqQixrQkFBa0I7RUFDbEIsZUFBZTtFQUNmLFlBQVk7RUFDWixrQkFBa0I7QUFDcEI7QUFFQTtFQUNFLHlCQUF5QjtBQUMzQjtBQUVBO0VBQ0Usa0JBQWtCO0VBQ2xCLFdBQVc7RUFDWCxVQUFVO0VBQ1YsaUNBQWlDO0VBQ2pDLFlBQVk7QUFDZCIsImZpbGUiOiJzcmMvYXBwL2hlcm9lcy9oZXJvZXMuY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbIi8qIEhlcm9lc0NvbXBvbmVudCdzIHByaXZhdGUgQ1NTIHN0eWxlcyAqL1xuLmhlcm9lcyB7XG4gIG1hcmdpbjogMCAwIDJlbSAwO1xuICBsaXN0LXN0eWxlLXR5cGU6IG5vbmU7XG4gIHBhZGRpbmc6IDA7XG4gIHdpZHRoOiAxNWVtO1xufVxuLmhlcm9lcyBsaSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUVFO1xuICBtYXJnaW46IC41ZW07XG4gIHBhZGRpbmc6IC4zZW0gMDtcbiAgaGVpZ2h0OiAxLjZlbTtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xufVxuXG4uaGVyb2VzIGxpOmhvdmVyIHtcbiAgY29sb3I6ICM2MDdEOEI7XG4gIGJhY2tncm91bmQtY29sb3I6ICNEREQ7XG4gIGxlZnQ6IC4xZW07XG59XG5cbi5oZXJvZXMgYSB7XG4gIGNvbG9yOiAjMzMzO1xuICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgZGlzcGxheTogYmxvY2s7XG4gIHdpZHRoOiAyNTBweDtcbn1cblxuLmhlcm9lcyBhOmhvdmVyIHtcbiAgY29sb3I6IzYwN0Q4Qjtcbn1cblxuLmhlcm9lcyAuYmFkZ2Uge1xuICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG4gIGZvbnQtc2l6ZTogc21hbGw7XG4gIGNvbG9yOiB3aGl0ZTtcbiAgcGFkZGluZzogMC44ZW0gMC43ZW0gMCAwLjdlbTtcbiAgYmFja2dyb3VuZC1jb2xvcjojNDA1MDYxO1xuICBsaW5lLWhlaWdodDogMWVtO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGxlZnQ6IC0xcHg7XG4gIHRvcDogLTRweDtcbiAgaGVpZ2h0OiAxLjhlbTtcbiAgbWluLXdpZHRoOiAxNnB4O1xuICB0ZXh0LWFsaWduOiByaWdodDtcbiAgbWFyZ2luLXJpZ2h0OiAuOGVtO1xuICBib3JkZXItcmFkaXVzOiA0cHggMCAwIDRweDtcbn1cblxuYnV0dG9uIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VlZTtcbiAgYm9yZGVyOiBub25lO1xuICBwYWRkaW5nOiA1cHggMTBweDtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGN1cnNvcjogaGFuZDtcbiAgZm9udC1mYW1pbHk6IEFyaWFsO1xufVxuXG5idXR0b246aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjY2ZkOGRjO1xufVxuXG5idXR0b24uZGVsZXRlIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBsZWZ0OiAxOTRweDtcbiAgdG9wOiAtMzJweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogZ3JheSAhaW1wb3J0YW50O1xuICBjb2xvcjogd2hpdGU7XG59XG5cbiJdfQ== */";
    /***/
  },

  /***/
  "./src/app/heroes/heroes.component.ts":
  /*!********************************************!*\
    !*** ./src/app/heroes/heroes.component.ts ***!
    \********************************************/

  /*! exports provided: HeroesComponent */

  /***/
  function srcAppHeroesHeroesComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "HeroesComponent", function () {
      return HeroesComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");

    var HeroesComponent =
    /*#__PURE__*/
    function () {
      function HeroesComponent(heroService) {
        _classCallCheck(this, HeroesComponent);

        this.heroService = heroService;
      }

      _createClass(HeroesComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.getHeroes();
        }
      }, {
        key: "getHeroes",
        value: function getHeroes() {
          var _this43 = this;

          this.heroService.getHeroes().subscribe(function (heroes) {
            return _this43.heroes = heroes;
          });
        }
      }, {
        key: "add",
        value: function add(name) {
          var _this44 = this;

          name = name.trim();

          if (!name) {
            return;
          }

          this.heroService.addHero({
            name: name
          }).subscribe(function (hero) {
            _this44.heroes.push(hero);
          });
        }
      }, {
        key: "delete",
        value: function _delete(hero) {
          this.heroes = this.heroes.filter(function (h) {
            return h !== hero;
          });
          this.heroService.deleteHero(hero).subscribe();
        }
      }]);

      return HeroesComponent;
    }();

    HeroesComponent.ctorParameters = function () {
      return [{
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }];
    };

    HeroesComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-heroes',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./heroes.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/heroes/heroes.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./heroes.component.css */
      "./src/app/heroes/heroes.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]])], HeroesComponent);
    /***/
  },

  /***/
  "./src/app/licence-agreement/licence-agreement.component.css":
  /*!*******************************************************************!*\
    !*** ./src/app/licence-agreement/licence-agreement.component.css ***!
    \*******************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppLicenceAgreementLicenceAgreementComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2xpY2VuY2UtYWdyZWVtZW50L2xpY2VuY2UtYWdyZWVtZW50LmNvbXBvbmVudC5jc3MifQ== */";
    /***/
  },

  /***/
  "./src/app/licence-agreement/licence-agreement.component.ts":
  /*!******************************************************************!*\
    !*** ./src/app/licence-agreement/licence-agreement.component.ts ***!
    \******************************************************************/

  /*! exports provided: LicenceAgreementComponent */

  /***/
  function srcAppLicenceAgreementLicenceAgreementComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "LicenceAgreementComponent", function () {
      return LicenceAgreementComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var LicenceAgreementComponent =
    /*#__PURE__*/
    function () {
      function LicenceAgreementComponent() {
        _classCallCheck(this, LicenceAgreementComponent);
      }

      _createClass(LicenceAgreementComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }]);

      return LicenceAgreementComponent;
    }();

    LicenceAgreementComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-licence-agreement',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./licence-agreement.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/licence-agreement/licence-agreement.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./licence-agreement.component.css */
      "./src/app/licence-agreement/licence-agreement.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])], LicenceAgreementComponent);
    /***/
  },

  /***/
  "./src/app/lightbox/lightbox.component.css":
  /*!*************************************************!*\
    !*** ./src/app/lightbox/lightbox.component.css ***!
    \*************************************************/

  /*! exports provided: default */

  /***/
  function srcAppLightboxLightboxComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2xpZ2h0Ym94L2xpZ2h0Ym94LmNvbXBvbmVudC5jc3MifQ== */";
    /***/
  },

  /***/
  "./src/app/lightbox/lightbox.component.ts":
  /*!************************************************!*\
    !*** ./src/app/lightbox/lightbox.component.ts ***!
    \************************************************/

  /*! exports provided: LightboxComponent */

  /***/
  function srcAppLightboxLightboxComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "LightboxComponent", function () {
      return LightboxComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");

    var LightboxComponent =
    /*#__PURE__*/
    function () {
      function LightboxComponent(heroService, authenticationService, router) {
        var _this45 = this;

        _classCallCheck(this, LightboxComponent);

        this.heroService = heroService;
        this.authenticationService = authenticationService;
        this.router = router;
        this.lightBoxListDataItems = [];
        this.priceArray = [];
        this.loadingData = false;
        this.promocodeflag = false;
        this.authenticationService.currentUser.subscribe(function (x) {
          _this45.currentUser = x;

          if (!_this45.currentUser) {
            _this45.router.navigate(['/']);
          }
        });
      }

      _createClass(LightboxComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          //this.spinner.show();
          this.loadingData = true; // console.log(localStorage.getItem('checkoutAray'));

          this.loaddata();
        }
      }, {
        key: "loaddata",
        value: function loaddata() {
          var _this46 = this;

          this.authenticationService.getLightboxItemsData().subscribe(function (data) {
            _this46.loadingData = false;

            if (data.status == '1') {
              _this46.lightBoxListDataItems = data.data;
            } else {
              alert(data.message);
            } // this.lightBoxListDataItems.forEach(element => {
            //   this.priceArray.push(element["total"]);
            // });
            //this.spinner.hide();

          }, function (error) {});
        }
      }, {
        key: "removeProductFromWishlist",
        value: function removeProductFromWishlist(productinfo) {
          var _this47 = this;

          if (confirm('Are you sure?') == true) {
            this.loadingData = true;
            this.authenticationService.removeDataFromWishlist(productinfo).subscribe(function (data) {
              _this47.loadingData = false;

              if (data["status"] == '1') {
                alert(data["message"]);

                _this47.loaddata();
              } else {
                alert(data["message"]);
              }
            });
          } else {
            return false;
          }
        }
      }]);

      return LightboxComponent;
    }();

    LightboxComponent.ctorParameters = function () {
      return [{
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]
      }];
    };

    LightboxComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-lightbox',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./lightbox.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/lightbox/lightbox.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./lightbox.component.css */
      "./src/app/lightbox/lightbox.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])], LightboxComponent);
    /***/
  },

  /***/
  "./src/app/login/login.component.css":
  /*!*******************************************!*\
    !*** ./src/app/login/login.component.css ***!
    \*******************************************/

  /*! exports provided: default */

  /***/
  function srcAppLoginLoginComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2xvZ2luL2xvZ2luLmNvbXBvbmVudC5jc3MifQ== */";
    /***/
  },

  /***/
  "./src/app/login/login.component.ts":
  /*!******************************************!*\
    !*** ./src/app/login/login.component.ts ***!
    \******************************************/

  /*! exports provided: LoginComponent */

  /***/
  function srcAppLoginLoginComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "LoginComponent", function () {
      return LoginComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/fesm2015/forms.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! rxjs/operators */
    "./node_modules/rxjs/_esm2015/operators/index.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var angular_6_social_login__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! angular-6-social-login */
    "./node_modules/angular-6-social-login/angular-6-social-login.umd.js");
    /* harmony import */


    var angular_6_social_login__WEBPACK_IMPORTED_MODULE_6___default =
    /*#__PURE__*/
    __webpack_require__.n(angular_6_social_login__WEBPACK_IMPORTED_MODULE_6__);

    var LoginComponent =
    /*#__PURE__*/
    function () {
      function LoginComponent(formBuilder, router, authenticationService, socialAuthService) {
        _classCallCheck(this, LoginComponent);

        this.formBuilder = formBuilder;
        this.router = router;
        this.authenticationService = authenticationService;
        this.socialAuthService = socialAuthService;
        this.closeLoginPopup = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.loading = false;
        this.submitted = false;

        if (this.authenticationService.currentUserValue) {
          this.router.navigate(['/']);
        }
      }

      _createClass(LoginComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.loginForm = this.formBuilder.group({
            email: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].compose([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')])],
            password: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          });
        }
        /* sign in with social media */

      }, {
        key: "socialSignIn",
        value: function socialSignIn(socialPlatform) {
          var _this48 = this;

          var socialPlatformProvider;

          if (socialPlatform == "facebook") {
            socialPlatformProvider = angular_6_social_login__WEBPACK_IMPORTED_MODULE_6__["FacebookLoginProvider"].PROVIDER_ID;
          } else if (socialPlatform == "google") {
            socialPlatformProvider = angular_6_social_login__WEBPACK_IMPORTED_MODULE_6__["GoogleLoginProvider"].PROVIDER_ID;
          }
          /* else if (socialPlatform == "linkedin") {
          socialPlatformProvider = LinkedinLoginProvider.PROVIDER_ID;
          }*/


          this.socialAuthService.signIn(socialPlatformProvider).then(function (userData) {
            console.log(socialPlatform + " sign in data : ", userData); // Now sign-in with userData

            console.log(userData.name);
            console.log(userData.email); //fbLogin

            _this48.authenticationService.fbLogin(userData).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["first"])()).subscribe(function (data) {
              console.log(data);

              if (data == undefined) {
                alert("You are non registered user");
              } else {
                _this48.closeLoginPopup.emit(true);
              }
            }, function (error) {
              _this48.loading = false;
            });
          });
        }
        /* end signin with social media */
        // convenience getter for easy access to form fields

      }, {
        key: "closePopup",
        value: function closePopup() {
          this.closeLoginPopup.emit(false);
        }
        /* closeLoginPopupForReg(){
            this.closeLoginPopup.emit(false);
        } */

      }, {
        key: "onSubmit",
        value: function onSubmit() {
          var _this49 = this;

          this.submitted = true; // stop here if form is invalid

          if (this.loginForm.invalid) {
            return;
          }

          this.loading = true;
          this.authenticationService.getLogin(this.f.email.value, this.f.password.value).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["first"])()).subscribe(function (data) {
            console.log(data);

            if (data == undefined) {
              alert("Please enter correct username or password");
            } else {
              _this49.closeLoginPopup.emit(true);
            }
          }, function (error) {
            _this49.loading = false;
          });
        }
      }, {
        key: "resetPassword",
        value: function resetPassword() {
          this.closePopup();
          this.router.navigate(['/user-reset-password']);
        }
      }, {
        key: "f",
        get: function get() {
          return this.loginForm.controls;
        }
      }]);

      return LoginComponent;
    }();

    LoginComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_5__["HeroService"]
      }, {
        type: angular_6_social_login__WEBPACK_IMPORTED_MODULE_6__["AuthService"]
      }];
    };

    tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)], LoginComponent.prototype, "openLoginPopup", void 0);
    tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"])], LoginComponent.prototype, "closeLoginPopup", void 0);
    tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)], LoginComponent.prototype, "closeLoginPopupForReg", void 0);
    LoginComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-login',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./login.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/login/login.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./login.component.css */
      "./src/app/login/login.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"], _hero_service__WEBPACK_IMPORTED_MODULE_5__["HeroService"], angular_6_social_login__WEBPACK_IMPORTED_MODULE_6__["AuthService"]])], LoginComponent);
    /***/
  },

  /***/
  "./src/app/message.service.ts":
  /*!************************************!*\
    !*** ./src/app/message.service.ts ***!
    \************************************/

  /*! exports provided: MessageService */

  /***/
  function srcAppMessageServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "MessageService", function () {
      return MessageService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var MessageService =
    /*#__PURE__*/
    function () {
      function MessageService() {
        _classCallCheck(this, MessageService);

        this.messages = [];
      }

      _createClass(MessageService, [{
        key: "add",
        value: function add(message) {
          this.messages.push(message);
        }
      }, {
        key: "clear",
        value: function clear() {
          this.messages = [];
        }
      }]);

      return MessageService;
    }();

    MessageService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    })], MessageService);
    /***/
  },

  /***/
  "./src/app/messages/messages.component.css":
  /*!*************************************************!*\
    !*** ./src/app/messages/messages.component.css ***!
    \*************************************************/

  /*! exports provided: default */

  /***/
  function srcAppMessagesMessagesComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "/* MessagesComponent's private CSS styles */\nh2 {\n  color: red;\n  font-family: Arial, Helvetica, sans-serif;\n  font-weight: lighter;\n}\nbody {\n  margin: 2em;\n}\nbody, input[text], button {\n  color: crimson;\n  font-family: Cambria, Georgia;\n}\nbutton.clear {\n  font-family: Arial;\n  background-color: #eee;\n  border: none;\n  padding: 5px 10px;\n  border-radius: 4px;\n  cursor: pointer;\n  cursor: hand;\n}\nbutton:hover {\n  background-color: #cfd8dc;\n}\nbutton:disabled {\n  background-color: #eee;\n  color: #aaa;\n  cursor: auto;\n}\nbutton.clear {\n  color: #333;\n  margin-bottom: 12px;\n}\n\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbWVzc2FnZXMvbWVzc2FnZXMuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSwyQ0FBMkM7QUFDM0M7RUFDRSxVQUFVO0VBQ1YseUNBQXlDO0VBQ3pDLG9CQUFvQjtBQUN0QjtBQUNBO0VBQ0UsV0FBVztBQUNiO0FBQ0E7RUFDRSxjQUFjO0VBQ2QsNkJBQTZCO0FBQy9CO0FBRUE7RUFDRSxrQkFBa0I7RUFDbEIsc0JBQXNCO0VBQ3RCLFlBQVk7RUFDWixpQkFBaUI7RUFDakIsa0JBQWtCO0VBQ2xCLGVBQWU7RUFDZixZQUFZO0FBQ2Q7QUFDQTtFQUNFLHlCQUF5QjtBQUMzQjtBQUNBO0VBQ0Usc0JBQXNCO0VBQ3RCLFdBQVc7RUFDWCxZQUFZO0FBQ2Q7QUFDQTtFQUNFLFdBQVc7RUFDWCxtQkFBbUI7QUFDckIiLCJmaWxlIjoic3JjL2FwcC9tZXNzYWdlcy9tZXNzYWdlcy5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLyogTWVzc2FnZXNDb21wb25lbnQncyBwcml2YXRlIENTUyBzdHlsZXMgKi9cbmgyIHtcbiAgY29sb3I6IHJlZDtcbiAgZm9udC1mYW1pbHk6IEFyaWFsLCBIZWx2ZXRpY2EsIHNhbnMtc2VyaWY7XG4gIGZvbnQtd2VpZ2h0OiBsaWdodGVyO1xufVxuYm9keSB7XG4gIG1hcmdpbjogMmVtO1xufVxuYm9keSwgaW5wdXRbdGV4dF0sIGJ1dHRvbiB7XG4gIGNvbG9yOiBjcmltc29uO1xuICBmb250LWZhbWlseTogQ2FtYnJpYSwgR2VvcmdpYTtcbn1cblxuYnV0dG9uLmNsZWFyIHtcbiAgZm9udC1mYW1pbHk6IEFyaWFsO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVlO1xuICBib3JkZXI6IG5vbmU7XG4gIHBhZGRpbmc6IDVweCAxMHB4O1xuICBib3JkZXItcmFkaXVzOiA0cHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgY3Vyc29yOiBoYW5kO1xufVxuYnV0dG9uOmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2NmZDhkYztcbn1cbmJ1dHRvbjpkaXNhYmxlZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZWU7XG4gIGNvbG9yOiAjYWFhO1xuICBjdXJzb3I6IGF1dG87XG59XG5idXR0b24uY2xlYXIge1xuICBjb2xvcjogIzMzMztcbiAgbWFyZ2luLWJvdHRvbTogMTJweDtcbn1cbiJdfQ== */";
    /***/
  },

  /***/
  "./src/app/messages/messages.component.ts":
  /*!************************************************!*\
    !*** ./src/app/messages/messages.component.ts ***!
    \************************************************/

  /*! exports provided: MessagesComponent */

  /***/
  function srcAppMessagesMessagesComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "MessagesComponent", function () {
      return MessagesComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _message_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../message.service */
    "./src/app/message.service.ts");

    var MessagesComponent =
    /*#__PURE__*/
    function () {
      function MessagesComponent(messageService) {
        _classCallCheck(this, MessagesComponent);

        this.messageService = messageService;
      }

      _createClass(MessagesComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }]);

      return MessagesComponent;
    }();

    MessagesComponent.ctorParameters = function () {
      return [{
        type: _message_service__WEBPACK_IMPORTED_MODULE_2__["MessageService"]
      }];
    };

    MessagesComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-messages',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./messages.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/messages/messages.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./messages.component.css */
      "./src/app/messages/messages.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_message_service__WEBPACK_IMPORTED_MODULE_2__["MessageService"]])], MessagesComponent);
    /***/
  },

  /***/
  "./src/app/order-confirmation/order-confirmation.component.css":
  /*!*********************************************************************!*\
    !*** ./src/app/order-confirmation/order-confirmation.component.css ***!
    \*********************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppOrderConfirmationOrderConfirmationComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL29yZGVyLWNvbmZpcm1hdGlvbi9vcmRlci1jb25maXJtYXRpb24uY29tcG9uZW50LmNzcyJ9 */";
    /***/
  },

  /***/
  "./src/app/order-confirmation/order-confirmation.component.ts":
  /*!********************************************************************!*\
    !*** ./src/app/order-confirmation/order-confirmation.component.ts ***!
    \********************************************************************/

  /*! exports provided: OrderConfirmationComponent */

  /***/
  function srcAppOrderConfirmationOrderConfirmationComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "OrderConfirmationComponent", function () {
      return OrderConfirmationComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");

    var OrderConfirmationComponent =
    /*#__PURE__*/
    function () {
      function OrderConfirmationComponent(route, heroService, authenticationService, router, spinner) {
        _classCallCheck(this, OrderConfirmationComponent);

        this.route = route;
        this.heroService = heroService;
        this.authenticationService = authenticationService;
        this.router = router;
        this.spinner = spinner;
        this.loadingData = false;
        this.id = '';
        this.OrderDetailData = [];
      }

      _createClass(OrderConfirmationComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this50 = this;

          this.loadingData = true;
          this.id = +this.route.snapshot.paramMap.get('id');
          this.authenticationService.getOrderDetails(this.id).subscribe(function (data) {
            if (data.status == 'success') {
              _this50.OrderDetailData = data.data[0];
              _this50.loadingData = false;
            } else {
              //this.OrderDetailData = data;
              _this50.loadingData = false;
              alert(data.message);
            } //this.spinner.hide();

          }, function (error) {});
        }
      }]);

      return OrderConfirmationComponent;
    }();

    OrderConfirmationComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]
      }, {
        type: ngx_spinner__WEBPACK_IMPORTED_MODULE_4__["NgxSpinnerService"]
      }];
    };

    OrderConfirmationComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-order-confirmation',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./order-confirmation.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/order-confirmation/order-confirmation.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./order-confirmation.component.css */
      "./src/app/order-confirmation/order-confirmation.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"], ngx_spinner__WEBPACK_IMPORTED_MODULE_4__["NgxSpinnerService"]])], OrderConfirmationComponent);
    /***/
  },

  /***/
  "./src/app/pricing/pricing.component.css":
  /*!***********************************************!*\
    !*** ./src/app/pricing/pricing.component.css ***!
    \***********************************************/

  /*! exports provided: default */

  /***/
  function srcAppPricingPricingComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3ByaWNpbmcvcHJpY2luZy5jb21wb25lbnQuY3NzIn0= */";
    /***/
  },

  /***/
  "./src/app/pricing/pricing.component.ts":
  /*!**********************************************!*\
    !*** ./src/app/pricing/pricing.component.ts ***!
    \**********************************************/

  /*! exports provided: PricingComponent */

  /***/
  function srcAppPricingPricingComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "PricingComponent", function () {
      return PricingComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var PricingComponent =
    /*#__PURE__*/
    function () {
      function PricingComponent() {
        _classCallCheck(this, PricingComponent);
      }

      _createClass(PricingComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }]);

      return PricingComponent;
    }();

    PricingComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'pricing',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./pricing.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/pricing/pricing.component.html")).default,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./pricing.component.css */
      "./src/app/pricing/pricing.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])], PricingComponent);
    /***/
  },

  /***/
  "./src/app/privacy-policy/privacy-policy.component.css":
  /*!*************************************************************!*\
    !*** ./src/app/privacy-policy/privacy-policy.component.css ***!
    \*************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppPrivacyPolicyPrivacyPolicyComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3ByaXZhY3ktcG9saWN5L3ByaXZhY3ktcG9saWN5LmNvbXBvbmVudC5jc3MifQ== */";
    /***/
  },

  /***/
  "./src/app/privacy-policy/privacy-policy.component.ts":
  /*!************************************************************!*\
    !*** ./src/app/privacy-policy/privacy-policy.component.ts ***!
    \************************************************************/

  /*! exports provided: PrivacyPolicyComponent */

  /***/
  function srcAppPrivacyPolicyPrivacyPolicyComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "PrivacyPolicyComponent", function () {
      return PrivacyPolicyComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var PrivacyPolicyComponent =
    /*#__PURE__*/
    function () {
      function PrivacyPolicyComponent() {
        _classCallCheck(this, PrivacyPolicyComponent);
      }

      _createClass(PrivacyPolicyComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }]);

      return PrivacyPolicyComponent;
    }();

    PrivacyPolicyComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-privacy-policy',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./privacy-policy.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/privacy-policy/privacy-policy.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./privacy-policy.component.css */
      "./src/app/privacy-policy/privacy-policy.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])], PrivacyPolicyComponent);
    /***/
  },

  /***/
  "./src/app/reset-password/reset-password.component.css":
  /*!*************************************************************!*\
    !*** ./src/app/reset-password/reset-password.component.css ***!
    \*************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppResetPasswordResetPasswordComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "body{ font-weight:normal;background: #f1f5f6;}\r\n#mainNav{background:#000;}\r\nhr {\r\n    border-top: 1px solid #ddd!important;\r\n}\r\n.table.border-0>tbody>tr>td{border:none;}\r\n.border-1{border: 1px solid #ddd;}\r\n\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvcmVzZXQtcGFzc3dvcmQvcmVzZXQtcGFzc3dvcmQuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxNQUFNLGtCQUFrQixDQUFDLG1CQUFtQixDQUFDO0FBQzdDLFNBQVMsZUFBZSxDQUFDO0FBQ3pCO0lBQ0ksb0NBQW9DO0FBQ3hDO0FBQ0EsNEJBQTRCLFdBQVcsQ0FBQztBQUN4QyxVQUFVLHNCQUFzQixDQUFDIiwiZmlsZSI6InNyYy9hcHAvcmVzZXQtcGFzc3dvcmQvcmVzZXQtcGFzc3dvcmQuY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbImJvZHl7IGZvbnQtd2VpZ2h0Om5vcm1hbDtiYWNrZ3JvdW5kOiAjZjFmNWY2O31cclxuI21haW5OYXZ7YmFja2dyb3VuZDojMDAwO31cclxuaHIge1xyXG4gICAgYm9yZGVyLXRvcDogMXB4IHNvbGlkICNkZGQhaW1wb3J0YW50O1xyXG59XHJcbi50YWJsZS5ib3JkZXItMD50Ym9keT50cj50ZHtib3JkZXI6bm9uZTt9XHJcbi5ib3JkZXItMXtib3JkZXI6IDFweCBzb2xpZCAjZGRkO31cclxuIl19 */";
    /***/
  },

  /***/
  "./src/app/reset-password/reset-password.component.ts":
  /*!************************************************************!*\
    !*** ./src/app/reset-password/reset-password.component.ts ***!
    \************************************************************/

  /*! exports provided: ResetPasswordComponent */

  /***/
  function srcAppResetPasswordResetPasswordComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ResetPasswordComponent", function () {
      return ResetPasswordComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/fesm2015/forms.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");
    /* harmony import */


    var rxjs_operators__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! rxjs/operators */
    "./node_modules/rxjs/_esm2015/operators/index.js");

    var ResetPasswordComponent =
    /*#__PURE__*/
    function () {
      function ResetPasswordComponent(heroService, formBuilder, authenticationService, router, spinner) {
        var _this51 = this;

        _classCallCheck(this, ResetPasswordComponent);

        this.heroService = heroService;
        this.formBuilder = formBuilder;
        this.authenticationService = authenticationService;
        this.router = router;
        this.spinner = spinner;
        this.loadingData = false;
        this.submitted = false;
        this.loading = false;
        this.authenticationService.currentUser.subscribe(function (x) {
          _this51.currentUser = x;

          if (_this51.currentUser) {
            _this51.router.navigate(['/']);
          }
        });
      }

      _createClass(ResetPasswordComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.resetpasswordForm = this.formBuilder.group({
            user_email: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required]
          });
        }
      }, {
        key: "onSubmit",
        value: function onSubmit() {
          var _this52 = this;

          this.submitted = true; // stop here if form is invalid

          if (this.resetpasswordForm.invalid) {
            console.log('at invalid');
            console.log(this.resetpasswordForm);
            return;
          }

          this.loadingData = true;
          this.authenticationService.resetPassword(this.resetpasswordForm.value).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_6__["first"])()).subscribe(function (data2) {
            console.log(data2);
            _this52.loadingData = false;

            if (data2.status == '1') {// this.otp = true;
              // this.error_message = null;
              // this.success_message = data2.message;
            } else {// this.otp = false;
                // this.success_message = null;
                // this.error_message = data2.message;
              }
          }, function (error) {
            _this52.loading = false;
          });
        }
      }, {
        key: "f",
        get: function get() {
          return this.resetpasswordForm.controls;
        }
      }]);

      return ResetPasswordComponent;
    }();

    ResetPasswordComponent.ctorParameters = function () {
      return [{
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormBuilder"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]
      }, {
        type: ngx_spinner__WEBPACK_IMPORTED_MODULE_5__["NgxSpinnerService"]
      }];
    };

    ResetPasswordComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-reset-password',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./reset-password.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/reset-password/reset-password.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./reset-password.component.css */
      "./src/app/reset-password/reset-password.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormBuilder"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"], ngx_spinner__WEBPACK_IMPORTED_MODULE_5__["NgxSpinnerService"]])], ResetPasswordComponent);
    /***/
  },

  /***/
  "./src/app/sign-up/sign-up.component.css":
  /*!***********************************************!*\
    !*** ./src/app/sign-up/sign-up.component.css ***!
    \***********************************************/

  /*! exports provided: default */

  /***/
  function srcAppSignUpSignUpComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "/*body{ font-weight:normal; background: # !important;}*/\r\n/*#mainNav{background:#000;}*/\r\n/*hr {*/\r\n/*    border-top: 1px solid #ddd !important;*/\r\n/*}*/\r\n\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvc2lnbi11cC9zaWduLXVwLmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUEsdURBQXVEO0FBQ3ZELDZCQUE2QjtBQUM3QixPQUFPO0FBQ1AsNkNBQTZDO0FBQzdDLElBQUkiLCJmaWxlIjoic3JjL2FwcC9zaWduLXVwL3NpZ24tdXAuY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbIi8qYm9keXsgZm9udC13ZWlnaHQ6bm9ybWFsOyBiYWNrZ3JvdW5kOiAjICFpbXBvcnRhbnQ7fSovXHJcbi8qI21haW5OYXZ7YmFja2dyb3VuZDojMDAwO30qL1xyXG4vKmhyIHsqL1xyXG4vKiAgICBib3JkZXItdG9wOiAxcHggc29saWQgI2RkZCAhaW1wb3J0YW50OyovXHJcbi8qfSovXHJcbiJdfQ== */";
    /***/
  },

  /***/
  "./src/app/sign-up/sign-up.component.ts":
  /*!**********************************************!*\
    !*** ./src/app/sign-up/sign-up.component.ts ***!
    \**********************************************/

  /*! exports provided: SignUpComponent */

  /***/
  function srcAppSignUpSignUpComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "SignUpComponent", function () {
      return SignUpComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/fesm2015/forms.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ../_helpers/image-footer-helper */
    "./src/app/_helpers/image-footer-helper.ts");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var rxjs_operators__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! rxjs/operators */
    "./node_modules/rxjs/_esm2015/operators/index.js");

    var SignUpComponent =
    /*#__PURE__*/
    function () {
      function SignUpComponent(formBuilder, authenticationService, router, dataHelper) {
        _classCallCheck(this, SignUpComponent);

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
        this.checkoutArray = [];
        this.loadingData = false;
      }

      _createClass(SignUpComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.registerForm = this.formBuilder.group({
            first_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            last_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            password: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(6)]],
            confirmPassword: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            email: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].email]],
            occupation: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            company: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            mobileNumber: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/^[6-9]\d{9}$/)]],
            phoneNumber: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            country: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            state: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            city: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            pincode: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(6), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(6)]],
            address: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            iagree: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          }, {
            validator: this.dataHelper.mustMatch('password', 'confirmPassword')
          });
          this.getCountries();
        }
      }, {
        key: "getCountries",
        value: function getCountries() {
          var _this53 = this;

          this.authenticationService.allCountries().subscribe(function (data2) {
            //this.countryInfo=data2.Countries;
            _this53.countryInfo = data2; //console.log('Data:', this.countryInfo);
          }, function (err) {
            return console.log(err);
          }, function () {
            return console.log('complete');
          });
        }
      }, {
        key: "onChangeCountry",
        value: function onChangeCountry(countryValue) {
          var _this54 = this;

          //  console.log(this.countryInfo[countryValue]);
          this.authenticationService.allstates(countryValue).subscribe(function (data2) {
            //this.countryInfo=data2.Countries;
            _this54.stateInfo = data2; //console.log('Data:', this.countryInfo);
          }, function (err) {
            return console.log(err);
          }, function () {
            return console.log('complete');
          }); // this.registerForm.controls['country'].setValue(this.countryInfo[countryValue].CountryName);
          // this.stateInfo=this.countryInfo[countryValue].States;
          // this.cityInfo=this.stateInfo[0].Cities;
          //  console.log(this.cityInfo);
        }
      }, {
        key: "onChangeState",
        value: function onChangeState(stateValue) {
          var _this55 = this;

          // console.log(this.stateInfo[stateValue]);
          this.authenticationService.allCities(stateValue).subscribe(function (data2) {
            //this.countryInfo=data2.Countries;
            _this55.cityInfo = data2; //console.log('Data:', this.countryInfo);
          }, function (err) {
            return console.log(err);
          }, function () {
            return console.log('complete');
          }); // this.registerForm.controls['state'].setValue(this.stateInfo[stateValue].StateName);
          // this.cityInfo=this.stateInfo[stateValue].Cities;
          // console.log(this.cityInfo);j
        }
      }, {
        key: "onChangeCity",
        value: function onChangeCity(cityValue) {// console.log(this.cityInfo[cityValue]);
          // this.registerForm.controls['city'].setValue(this.cityInfo[cityValue]);
        }
      }, {
        key: "onSubmit",
        value: function onSubmit() {
          var _this56 = this;

          this.submitted = true; // stop here if form is invalid

          if (this.registerForm.invalid) {
            // console.log('at invalid');      console.log(this.registerForm);
            return;
          }

          this.loadingData = true; // console.log(this.registerForm.value);

          this.authenticationService.register(this.registerForm.value).pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_6__["first"])()).subscribe(function (data2) {
            //alert("Sucessfully Registered");
            // this.router.navigate(['/']);
            if (data2.status == '1') {
              alert(data2.message);
              var cartData = localStorage.getItem('beforeLoginCart');

              if (cartData.length > 0) {
                var finalData = JSON.parse(cartData);
                _this56.token = localStorage.getItem('currentUser'); //console.log(finalData);
                // console.log(finalData.productinfo);

                var cartval = {
                  "product_info": finalData.productinfo,
                  "selected_product": finalData.cartproduct,
                  "total": finalData.total,
                  "extended": finalData.extended,
                  "token": _this56.token,
                  "type": finalData.type
                };

                _this56.authenticationService.addcartItemsData(cartval).subscribe(function (data) {
                  console.log(data);

                  _this56.checkoutArray.push(cartval);

                  if (data["status"] == '1') {
                    _this56.loadingData = false;
                    localStorage.setItem('checkoutAray', _this56.checkoutArray);
                    localStorage.removeItem("beforeLoginCart");

                    _this56.router.navigate(['/cart']);
                  } else {
                    _this56.loadingData = false;
                    alert(data["message"]);
                  }
                });
              } else {
                _this56.loadingData = false;

                _this56.router.navigate(['/']);
              }
            } else {
              _this56.loadingData = false;
              alert(data2.message);
            }
          }, function (error) {
            _this56.loading = false;
          });
        }
      }, {
        key: "clickLoginPopup",
        value: function clickLoginPopup() {
          this.showloginPopup = true;
        }
      }, {
        key: "hideLoginPopup",
        value: function hideLoginPopup(event) {
          this.showloginPopup = false;

          if (event) {
            this.router.navigate(['']);
          }
        }
      }, {
        key: "f",
        get: function get() {
          return this.registerForm.controls;
        }
      }]);

      return SignUpComponent;
    }();

    SignUpComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_5__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]
      }, {
        type: _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__["imageFooterHelper"]
      }];
    };

    SignUpComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-sign-up',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./sign-up.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/sign-up/sign-up.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./sign-up.component.css */
      "./src/app/sign-up/sign-up.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _hero_service__WEBPACK_IMPORTED_MODULE_5__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_4__["imageFooterHelper"]])], SignUpComponent);
    /***/
  },

  /***/
  "./src/app/terms-and-conditions/terms-and-conditions.component.css":
  /*!*************************************************************************!*\
    !*** ./src/app/terms-and-conditions/terms-and-conditions.component.css ***!
    \*************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppTermsAndConditionsTermsAndConditionsComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3Rlcm1zLWFuZC1jb25kaXRpb25zL3Rlcm1zLWFuZC1jb25kaXRpb25zLmNvbXBvbmVudC5jc3MifQ== */";
    /***/
  },

  /***/
  "./src/app/terms-and-conditions/terms-and-conditions.component.ts":
  /*!************************************************************************!*\
    !*** ./src/app/terms-and-conditions/terms-and-conditions.component.ts ***!
    \************************************************************************/

  /*! exports provided: TermsAndConditionsComponent */

  /***/
  function srcAppTermsAndConditionsTermsAndConditionsComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "TermsAndConditionsComponent", function () {
      return TermsAndConditionsComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");

    var TermsAndConditionsComponent =
    /*#__PURE__*/
    function () {
      function TermsAndConditionsComponent() {
        _classCallCheck(this, TermsAndConditionsComponent);
      }

      _createClass(TermsAndConditionsComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }]);

      return TermsAndConditionsComponent;
    }();

    TermsAndConditionsComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-terms-and-conditions',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./terms-and-conditions.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/terms-and-conditions/terms-and-conditions.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./terms-and-conditions.component.css */
      "./src/app/terms-and-conditions/terms-and-conditions.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])], TermsAndConditionsComponent);
    /***/
  },

  /***/
  "./src/app/user-profile/user-profile.component.css":
  /*!*********************************************************!*\
    !*** ./src/app/user-profile/user-profile.component.css ***!
    \*********************************************************/

  /*! exports provided: default */

  /***/
  function srcAppUserProfileUserProfileComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "body{ font-weight:normal; background: #f1f5f6 !important;}\r\n#mainNav{background:#000;}\r\nhr {\r\n    border-top: 1px solid #ddd !important;\r\n}\r\n.nice-select {\r\n    -webkit-tap-highlight-color: transparent;\r\n    background-color: #fff;\r\n    border-radius: 0px;\r\n    border: solid 1px #e8e8e8;\r\n    box-sizing: border-box;\r\n    clear: both;\r\n    cursor: pointer;\r\n    display: block;\r\n    float: left;\r\n    font-family: inherit;\r\n    font-size: 14px;\r\n    font-weight: normal;\r\n    height: 42px;\r\n    /*  line-height: 40px;\r\n    */  outline: none;\r\n    padding-left: 18px;\r\n    padding-right: 30px;\r\n    position: relative;\r\n    text-align: left !important;\r\n    -webkit-transition: all 0.2s ease-in-out;\r\n    transition: all 0.2s ease-in-out;\r\n    -webkit-user-select: none;\r\n    -moz-user-select: none;\r\n    -ms-user-select: none;\r\n    user-select: none;\r\n    white-space: nowrap;\r\n    width: 100% }\r\n.nice-select:hover {\r\n    border-color: #dbdbdb; }\r\n.nice-select:active, .nice-select.open, .nice-select:focus {\r\n    border-color: #999; }\r\n.nice-select:after {\r\n    border-bottom: 2px solid #999;\r\n    border-right: 2px solid #999;\r\n    content: '';\r\n    display: block;\r\n    height: 5px;\r\n    margin-top: -4px;\r\n    pointer-events: none;\r\n    position: absolute;\r\n    right: 12px;\r\n    top: 50%;\r\n    -webkit-transform-origin: 66% 66%;\r\n    -ms-transform-origin: 66% 66%;\r\n    transform-origin: 66% 66%;\r\n    -webkit-transform: rotate(45deg);\r\n    -ms-transform: rotate(45deg);\r\n    transform: rotate(45deg);\r\n    -webkit-transition: all 0.15s ease-in-out;\r\n    transition: all 0.15s ease-in-out;\r\n    width: 5px; }\r\n.nice-select.open:after {\r\n    -webkit-transform: rotate(-135deg);\r\n    -ms-transform: rotate(-135deg);\r\n    transform: rotate(-135deg); }\r\n.nice-select.open .list {\r\n    opacity: 1;\r\n    pointer-events: auto;\r\n    -webkit-transform: scale(1) translateY(0);\r\n    -ms-transform: scale(1) translateY(0);\r\n    transform: scale(1) translateY(0); }\r\n.nice-select.disabled {\r\n    border-color: #ededed;\r\n    color: #999;\r\n    pointer-events: none; }\r\n.nice-select.disabled:after {\r\n    border-color: #cccccc; }\r\n.nice-select.wide {\r\n    width: 100%; }\r\n.nice-select.wide .list {\r\n    left: 0 !important;\r\n    right: 0 !important; }\r\n.nice-select.right {\r\n    float: right; }\r\n.nice-select.right .list {\r\n    left: auto;\r\n    right: 0; }\r\n.nice-select.small {\r\n    font-size: 12px;\r\n    height: 36px;\r\n    line-height: 34px; }\r\n.nice-select.small:after {\r\n    height: 4px;\r\n    width: 4px; }\r\n.nice-select.small .option {\r\n    line-height: 34px;\r\n    min-height: 34px; }\r\n.nice-select .list {\r\n    width:100%;\r\n    background-color: #fff;\r\n    border-radius: 5px;\r\n    box-shadow: 0 0 0 1px rgba(68, 68, 68, 0.11);\r\n    box-sizing: border-box;\r\n    margin-top: 4px;\r\n    opacity: 0;\r\n    overflow: hidden;\r\n    padding: 0;\r\n    pointer-events: none;\r\n    position: absolute;\r\n    top: 100%;\r\n    left: 0;\r\n    -webkit-transform-origin: 50% 0;\r\n    -ms-transform-origin: 50% 0;\r\n    transform-origin: 50% 0;\r\n    -webkit-transform: scale(0.75) translateY(-21px);\r\n    -ms-transform: scale(0.75) translateY(-21px);\r\n    transform: scale(0.75) translateY(-21px);\r\n    -webkit-transition: all 0.2s cubic-bezier(0.5, 0, 0, 1.25), opacity 0.15s ease-out;\r\n    transition: all 0.2s cubic-bezier(0.5, 0, 0, 1.25), opacity 0.15s ease-out;\r\n    z-index: 9; }\r\n.nice-select .list:hover .option:not(:hover) {\r\n    background-color: transparent !important; }\r\n.nice-select .option {\r\n    cursor: pointer;\r\n    font-weight: 400;\r\n    line-height: 40px;\r\n    list-style: none;\r\n    min-height: 40px;\r\n    outline: none;\r\n    padding-left: 18px;\r\n    padding-right: 29px;\r\n    text-align: left;\r\n    -webkit-transition: all 0.2s;\r\n    transition: all 0.2s; }\r\n.nice-select .option:hover, .nice-select .option.focus, .nice-select .option.selected.focus {\r\n    background-color: #f6f6f6; }\r\n.nice-select .option.selected {\r\n    font-weight: bold; }\r\n.nice-select .option.disabled {\r\n    background-color: transparent;\r\n    color: #999;\r\n    cursor: default; }\r\n.no-csspointerevents .nice-select .list {\r\n    display: none; }\r\n.no-csspointerevents .nice-select.open .list {\r\n    display: block; }\r\n.pos-rel{position: relative;}\r\n.icon_view{position: absolute;\r\n    top: 40px;\r\n    right: 16px;\r\n    color: #999;}\r\n.account-list>li>a{color: #333; font-weight: 600; display: inline-block; padding: 15px 0px;}\r\n.table.border-0 td{border:none;}\r\n.text-muted {\r\n    color: #8e9a9d !important;\r\n}\r\n.fw-6{font-weight: 600;}\r\n.z-depth-0{box-shadow:none !important;}\r\n/*.account-list>li>a.active{color:#ef6c57}*/\r\n\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvdXNlci1wcm9maWxlL3VzZXItcHJvZmlsZS5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLE1BQU0sa0JBQWtCLEVBQUUsOEJBQThCLENBQUM7QUFDekQsU0FBUyxlQUFlLENBQUM7QUFDekI7SUFDSSxxQ0FBcUM7QUFDekM7QUFDQTtJQUNJLHdDQUF3QztJQUN4QyxzQkFBc0I7SUFDdEIsa0JBQWtCO0lBQ2xCLHlCQUF5QjtJQUN6QixzQkFBc0I7SUFDdEIsV0FBVztJQUNYLGVBQWU7SUFDZixjQUFjO0lBQ2QsV0FBVztJQUNYLG9CQUFvQjtJQUNwQixlQUFlO0lBQ2YsbUJBQW1CO0lBQ25CLFlBQVk7SUFDWjtLQUNDLEdBQUcsYUFBYTtJQUNqQixrQkFBa0I7SUFDbEIsbUJBQW1CO0lBQ25CLGtCQUFrQjtJQUNsQiwyQkFBMkI7SUFDM0Isd0NBQXdDO0lBQ3hDLGdDQUFnQztJQUNoQyx5QkFBeUI7SUFDekIsc0JBQXNCO0lBQ3RCLHFCQUFxQjtJQUNyQixpQkFBaUI7SUFDakIsbUJBQW1CO0lBQ25CLFlBQVk7QUFDaEI7SUFDSSxxQkFBcUIsRUFBRTtBQUMzQjtJQUNJLGtCQUFrQixFQUFFO0FBQ3hCO0lBQ0ksNkJBQTZCO0lBQzdCLDRCQUE0QjtJQUM1QixXQUFXO0lBQ1gsY0FBYztJQUNkLFdBQVc7SUFDWCxnQkFBZ0I7SUFDaEIsb0JBQW9CO0lBQ3BCLGtCQUFrQjtJQUNsQixXQUFXO0lBQ1gsUUFBUTtJQUNSLGlDQUFpQztJQUNqQyw2QkFBNkI7SUFDN0IseUJBQXlCO0lBQ3pCLGdDQUFnQztJQUNoQyw0QkFBNEI7SUFDNUIsd0JBQXdCO0lBQ3hCLHlDQUF5QztJQUN6QyxpQ0FBaUM7SUFDakMsVUFBVSxFQUFFO0FBQ2hCO0lBQ0ksa0NBQWtDO0lBQ2xDLDhCQUE4QjtJQUM5QiwwQkFBMEIsRUFBRTtBQUNoQztJQUNJLFVBQVU7SUFDVixvQkFBb0I7SUFDcEIseUNBQXlDO0lBQ3pDLHFDQUFxQztJQUNyQyxpQ0FBaUMsRUFBRTtBQUN2QztJQUNJLHFCQUFxQjtJQUNyQixXQUFXO0lBQ1gsb0JBQW9CLEVBQUU7QUFDMUI7SUFDSSxxQkFBcUIsRUFBRTtBQUMzQjtJQUNJLFdBQVcsRUFBRTtBQUNqQjtJQUNJLGtCQUFrQjtJQUNsQixtQkFBbUIsRUFBRTtBQUN6QjtJQUNJLFlBQVksRUFBRTtBQUNsQjtJQUNJLFVBQVU7SUFDVixRQUFRLEVBQUU7QUFDZDtJQUNJLGVBQWU7SUFDZixZQUFZO0lBQ1osaUJBQWlCLEVBQUU7QUFDdkI7SUFDSSxXQUFXO0lBQ1gsVUFBVSxFQUFFO0FBQ2hCO0lBQ0ksaUJBQWlCO0lBQ2pCLGdCQUFnQixFQUFFO0FBQ3RCO0lBQ0ksVUFBVTtJQUNWLHNCQUFzQjtJQUN0QixrQkFBa0I7SUFDbEIsNENBQTRDO0lBQzVDLHNCQUFzQjtJQUN0QixlQUFlO0lBQ2YsVUFBVTtJQUNWLGdCQUFnQjtJQUNoQixVQUFVO0lBQ1Ysb0JBQW9CO0lBQ3BCLGtCQUFrQjtJQUNsQixTQUFTO0lBQ1QsT0FBTztJQUNQLCtCQUErQjtJQUMvQiwyQkFBMkI7SUFDM0IsdUJBQXVCO0lBQ3ZCLGdEQUFnRDtJQUNoRCw0Q0FBNEM7SUFDNUMsd0NBQXdDO0lBQ3hDLGtGQUFrRjtJQUNsRiwwRUFBMEU7SUFDMUUsVUFBVSxFQUFFO0FBQ2hCO0lBQ0ksd0NBQXdDLEVBQUU7QUFDOUM7SUFDSSxlQUFlO0lBQ2YsZ0JBQWdCO0lBQ2hCLGlCQUFpQjtJQUNqQixnQkFBZ0I7SUFDaEIsZ0JBQWdCO0lBQ2hCLGFBQWE7SUFDYixrQkFBa0I7SUFDbEIsbUJBQW1CO0lBQ25CLGdCQUFnQjtJQUNoQiw0QkFBNEI7SUFDNUIsb0JBQW9CLEVBQUU7QUFDMUI7SUFDSSx5QkFBeUIsRUFBRTtBQUMvQjtJQUNJLGlCQUFpQixFQUFFO0FBQ3ZCO0lBQ0ksNkJBQTZCO0lBQzdCLFdBQVc7SUFDWCxlQUFlLEVBQUU7QUFFckI7SUFDSSxhQUFhLEVBQUU7QUFFbkI7SUFDSSxjQUFjLEVBQUU7QUFFcEIsU0FBUyxrQkFBa0IsQ0FBQztBQUM1QixXQUFXLGtCQUFrQjtJQUN6QixTQUFTO0lBQ1QsV0FBVztJQUNYLFdBQVcsQ0FBQztBQUNoQixtQkFBbUIsV0FBVyxFQUFFLGdCQUFnQixFQUFFLHFCQUFxQixFQUFFLGlCQUFpQixDQUFDO0FBQzNGLG1CQUFtQixXQUFXLENBQUM7QUFDL0I7SUFDSSx5QkFBeUI7QUFDN0I7QUFDQSxNQUFNLGdCQUFnQixDQUFDO0FBQ3ZCLFdBQVcsMEJBQTBCLENBQUM7QUFDdEMsMkNBQTJDIiwiZmlsZSI6InNyYy9hcHAvdXNlci1wcm9maWxlL3VzZXItcHJvZmlsZS5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiYm9keXsgZm9udC13ZWlnaHQ6bm9ybWFsOyBiYWNrZ3JvdW5kOiAjZjFmNWY2ICFpbXBvcnRhbnQ7fVxyXG4jbWFpbk5hdntiYWNrZ3JvdW5kOiMwMDA7fVxyXG5ociB7XHJcbiAgICBib3JkZXItdG9wOiAxcHggc29saWQgI2RkZCAhaW1wb3J0YW50O1xyXG59XHJcbi5uaWNlLXNlbGVjdCB7XHJcbiAgICAtd2Via2l0LXRhcC1oaWdobGlnaHQtY29sb3I6IHRyYW5zcGFyZW50O1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICAgIGJvcmRlcjogc29saWQgMXB4ICNlOGU4ZTg7XHJcbiAgICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xyXG4gICAgY2xlYXI6IGJvdGg7XHJcbiAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIGZsb2F0OiBsZWZ0O1xyXG4gICAgZm9udC1mYW1pbHk6IGluaGVyaXQ7XHJcbiAgICBmb250LXNpemU6IDE0cHg7XHJcbiAgICBmb250LXdlaWdodDogbm9ybWFsO1xyXG4gICAgaGVpZ2h0OiA0MnB4O1xyXG4gICAgLyogIGxpbmUtaGVpZ2h0OiA0MHB4O1xyXG4gICAgKi8gIG91dGxpbmU6IG5vbmU7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDE4cHg7XHJcbiAgICBwYWRkaW5nLXJpZ2h0OiAzMHB4O1xyXG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgdGV4dC1hbGlnbjogbGVmdCAhaW1wb3J0YW50O1xyXG4gICAgLXdlYmtpdC10cmFuc2l0aW9uOiBhbGwgMC4ycyBlYXNlLWluLW91dDtcclxuICAgIHRyYW5zaXRpb246IGFsbCAwLjJzIGVhc2UtaW4tb3V0O1xyXG4gICAgLXdlYmtpdC11c2VyLXNlbGVjdDogbm9uZTtcclxuICAgIC1tb3otdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAtbXMtdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICB1c2VyLXNlbGVjdDogbm9uZTtcclxuICAgIHdoaXRlLXNwYWNlOiBub3dyYXA7XHJcbiAgICB3aWR0aDogMTAwJSB9XHJcbi5uaWNlLXNlbGVjdDpob3ZlciB7XHJcbiAgICBib3JkZXItY29sb3I6ICNkYmRiZGI7IH1cclxuLm5pY2Utc2VsZWN0OmFjdGl2ZSwgLm5pY2Utc2VsZWN0Lm9wZW4sIC5uaWNlLXNlbGVjdDpmb2N1cyB7XHJcbiAgICBib3JkZXItY29sb3I6ICM5OTk7IH1cclxuLm5pY2Utc2VsZWN0OmFmdGVyIHtcclxuICAgIGJvcmRlci1ib3R0b206IDJweCBzb2xpZCAjOTk5O1xyXG4gICAgYm9yZGVyLXJpZ2h0OiAycHggc29saWQgIzk5OTtcclxuICAgIGNvbnRlbnQ6ICcnO1xyXG4gICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICBoZWlnaHQ6IDVweDtcclxuICAgIG1hcmdpbi10b3A6IC00cHg7XHJcbiAgICBwb2ludGVyLWV2ZW50czogbm9uZTtcclxuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgIHJpZ2h0OiAxMnB4O1xyXG4gICAgdG9wOiA1MCU7XHJcbiAgICAtd2Via2l0LXRyYW5zZm9ybS1vcmlnaW46IDY2JSA2NiU7XHJcbiAgICAtbXMtdHJhbnNmb3JtLW9yaWdpbjogNjYlIDY2JTtcclxuICAgIHRyYW5zZm9ybS1vcmlnaW46IDY2JSA2NiU7XHJcbiAgICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKDQ1ZGVnKTtcclxuICAgIC1tcy10cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XHJcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XHJcbiAgICAtd2Via2l0LXRyYW5zaXRpb246IGFsbCAwLjE1cyBlYXNlLWluLW91dDtcclxuICAgIHRyYW5zaXRpb246IGFsbCAwLjE1cyBlYXNlLWluLW91dDtcclxuICAgIHdpZHRoOiA1cHg7IH1cclxuLm5pY2Utc2VsZWN0Lm9wZW46YWZ0ZXIge1xyXG4gICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTM1ZGVnKTtcclxuICAgIC1tcy10cmFuc2Zvcm06IHJvdGF0ZSgtMTM1ZGVnKTtcclxuICAgIHRyYW5zZm9ybTogcm90YXRlKC0xMzVkZWcpOyB9XHJcbi5uaWNlLXNlbGVjdC5vcGVuIC5saXN0IHtcclxuICAgIG9wYWNpdHk6IDE7XHJcbiAgICBwb2ludGVyLWV2ZW50czogYXV0bztcclxuICAgIC13ZWJraXQtdHJhbnNmb3JtOiBzY2FsZSgxKSB0cmFuc2xhdGVZKDApO1xyXG4gICAgLW1zLXRyYW5zZm9ybTogc2NhbGUoMSkgdHJhbnNsYXRlWSgwKTtcclxuICAgIHRyYW5zZm9ybTogc2NhbGUoMSkgdHJhbnNsYXRlWSgwKTsgfVxyXG4ubmljZS1zZWxlY3QuZGlzYWJsZWQge1xyXG4gICAgYm9yZGVyLWNvbG9yOiAjZWRlZGVkO1xyXG4gICAgY29sb3I6ICM5OTk7XHJcbiAgICBwb2ludGVyLWV2ZW50czogbm9uZTsgfVxyXG4ubmljZS1zZWxlY3QuZGlzYWJsZWQ6YWZ0ZXIge1xyXG4gICAgYm9yZGVyLWNvbG9yOiAjY2NjY2NjOyB9XHJcbi5uaWNlLXNlbGVjdC53aWRlIHtcclxuICAgIHdpZHRoOiAxMDAlOyB9XHJcbi5uaWNlLXNlbGVjdC53aWRlIC5saXN0IHtcclxuICAgIGxlZnQ6IDAgIWltcG9ydGFudDtcclxuICAgIHJpZ2h0OiAwICFpbXBvcnRhbnQ7IH1cclxuLm5pY2Utc2VsZWN0LnJpZ2h0IHtcclxuICAgIGZsb2F0OiByaWdodDsgfVxyXG4ubmljZS1zZWxlY3QucmlnaHQgLmxpc3Qge1xyXG4gICAgbGVmdDogYXV0bztcclxuICAgIHJpZ2h0OiAwOyB9XHJcbi5uaWNlLXNlbGVjdC5zbWFsbCB7XHJcbiAgICBmb250LXNpemU6IDEycHg7XHJcbiAgICBoZWlnaHQ6IDM2cHg7XHJcbiAgICBsaW5lLWhlaWdodDogMzRweDsgfVxyXG4ubmljZS1zZWxlY3Quc21hbGw6YWZ0ZXIge1xyXG4gICAgaGVpZ2h0OiA0cHg7XHJcbiAgICB3aWR0aDogNHB4OyB9XHJcbi5uaWNlLXNlbGVjdC5zbWFsbCAub3B0aW9uIHtcclxuICAgIGxpbmUtaGVpZ2h0OiAzNHB4O1xyXG4gICAgbWluLWhlaWdodDogMzRweDsgfVxyXG4ubmljZS1zZWxlY3QgLmxpc3Qge1xyXG4gICAgd2lkdGg6MTAwJTtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICBib3JkZXItcmFkaXVzOiA1cHg7XHJcbiAgICBib3gtc2hhZG93OiAwIDAgMCAxcHggcmdiYSg2OCwgNjgsIDY4LCAwLjExKTtcclxuICAgIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XHJcbiAgICBtYXJnaW4tdG9wOiA0cHg7XHJcbiAgICBvcGFjaXR5OiAwO1xyXG4gICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgIHBhZGRpbmc6IDA7XHJcbiAgICBwb2ludGVyLWV2ZW50czogbm9uZTtcclxuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgIHRvcDogMTAwJTtcclxuICAgIGxlZnQ6IDA7XHJcbiAgICAtd2Via2l0LXRyYW5zZm9ybS1vcmlnaW46IDUwJSAwO1xyXG4gICAgLW1zLXRyYW5zZm9ybS1vcmlnaW46IDUwJSAwO1xyXG4gICAgdHJhbnNmb3JtLW9yaWdpbjogNTAlIDA7XHJcbiAgICAtd2Via2l0LXRyYW5zZm9ybTogc2NhbGUoMC43NSkgdHJhbnNsYXRlWSgtMjFweCk7XHJcbiAgICAtbXMtdHJhbnNmb3JtOiBzY2FsZSgwLjc1KSB0cmFuc2xhdGVZKC0yMXB4KTtcclxuICAgIHRyYW5zZm9ybTogc2NhbGUoMC43NSkgdHJhbnNsYXRlWSgtMjFweCk7XHJcbiAgICAtd2Via2l0LXRyYW5zaXRpb246IGFsbCAwLjJzIGN1YmljLWJlemllcigwLjUsIDAsIDAsIDEuMjUpLCBvcGFjaXR5IDAuMTVzIGVhc2Utb3V0O1xyXG4gICAgdHJhbnNpdGlvbjogYWxsIDAuMnMgY3ViaWMtYmV6aWVyKDAuNSwgMCwgMCwgMS4yNSksIG9wYWNpdHkgMC4xNXMgZWFzZS1vdXQ7XHJcbiAgICB6LWluZGV4OiA5OyB9XHJcbi5uaWNlLXNlbGVjdCAubGlzdDpob3ZlciAub3B0aW9uOm5vdCg6aG92ZXIpIHtcclxuICAgIGJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7IH1cclxuLm5pY2Utc2VsZWN0IC5vcHRpb24ge1xyXG4gICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgZm9udC13ZWlnaHQ6IDQwMDtcclxuICAgIGxpbmUtaGVpZ2h0OiA0MHB4O1xyXG4gICAgbGlzdC1zdHlsZTogbm9uZTtcclxuICAgIG1pbi1oZWlnaHQ6IDQwcHg7XHJcbiAgICBvdXRsaW5lOiBub25lO1xyXG4gICAgcGFkZGluZy1sZWZ0OiAxOHB4O1xyXG4gICAgcGFkZGluZy1yaWdodDogMjlweDtcclxuICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbiAgICAtd2Via2l0LXRyYW5zaXRpb246IGFsbCAwLjJzO1xyXG4gICAgdHJhbnNpdGlvbjogYWxsIDAuMnM7IH1cclxuLm5pY2Utc2VsZWN0IC5vcHRpb246aG92ZXIsIC5uaWNlLXNlbGVjdCAub3B0aW9uLmZvY3VzLCAubmljZS1zZWxlY3QgLm9wdGlvbi5zZWxlY3RlZC5mb2N1cyB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjZmNmY2OyB9XHJcbi5uaWNlLXNlbGVjdCAub3B0aW9uLnNlbGVjdGVkIHtcclxuICAgIGZvbnQtd2VpZ2h0OiBib2xkOyB9XHJcbi5uaWNlLXNlbGVjdCAub3B0aW9uLmRpc2FibGVkIHtcclxuICAgIGJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50O1xyXG4gICAgY29sb3I6ICM5OTk7XHJcbiAgICBjdXJzb3I6IGRlZmF1bHQ7IH1cclxuXHJcbi5uby1jc3Nwb2ludGVyZXZlbnRzIC5uaWNlLXNlbGVjdCAubGlzdCB7XHJcbiAgICBkaXNwbGF5OiBub25lOyB9XHJcblxyXG4ubm8tY3NzcG9pbnRlcmV2ZW50cyAubmljZS1zZWxlY3Qub3BlbiAubGlzdCB7XHJcbiAgICBkaXNwbGF5OiBibG9jazsgfVxyXG5cclxuLnBvcy1yZWx7cG9zaXRpb246IHJlbGF0aXZlO31cclxuLmljb25fdmlld3twb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICB0b3A6IDQwcHg7XHJcbiAgICByaWdodDogMTZweDtcclxuICAgIGNvbG9yOiAjOTk5O31cclxuLmFjY291bnQtbGlzdD5saT5he2NvbG9yOiAjMzMzOyBmb250LXdlaWdodDogNjAwOyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7IHBhZGRpbmc6IDE1cHggMHB4O31cclxuLnRhYmxlLmJvcmRlci0wIHRke2JvcmRlcjpub25lO31cclxuLnRleHQtbXV0ZWQge1xyXG4gICAgY29sb3I6ICM4ZTlhOWQgIWltcG9ydGFudDtcclxufVxyXG4uZnctNntmb250LXdlaWdodDogNjAwO31cclxuLnotZGVwdGgtMHtib3gtc2hhZG93Om5vbmUgIWltcG9ydGFudDt9XHJcbi8qLmFjY291bnQtbGlzdD5saT5hLmFjdGl2ZXtjb2xvcjojZWY2YzU3fSovXHJcbiJdfQ== */";
    /***/
  },

  /***/
  "./src/app/user-profile/user-profile.component.ts":
  /*!********************************************************!*\
    !*** ./src/app/user-profile/user-profile.component.ts ***!
    \********************************************************/

  /*! exports provided: UserProfileComponent */

  /***/
  function srcAppUserProfileUserProfileComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "UserProfileComponent", function () {
      return UserProfileComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/common */
    "./node_modules/@angular/common/fesm2015/common.js");
    /* harmony import */


    var _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ../_helpers/image-footer-helper */
    "./src/app/_helpers/image-footer-helper.ts");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");

    var UserProfileComponent =
    /*#__PURE__*/
    function () {
      function UserProfileComponent(route, heroService, location, dataHelper, authenticationService, router, spinner) {
        var _this57 = this;

        _classCallCheck(this, UserProfileComponent);

        this.route = route;
        this.heroService = heroService;
        this.location = location;
        this.dataHelper = dataHelper;
        this.authenticationService = authenticationService;
        this.router = router;
        this.spinner = spinner;
        this.profileTab = true;
        this.plansTab = false;
        this.billingTab = false;
        this.purchaseTab = false;
        this.loadingData = false;
        this.profileData = '';
        this.orderData = '';
        this.order_items = '';
        this.authenticationService.currentUser.subscribe(function (x) {
          _this57.currentUser = x;

          if (!_this57.currentUser) {
            _this57.router.navigate(['/']);
          }
        });
      }

      _createClass(UserProfileComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this58 = this;

          this.loadingData = true;
          this.authenticationService.getUserprofileData().subscribe(function (data) {
            _this58.profileData = data.data[0];
            _this58.loadingData = false;
          }, function (error) {});
          this.authenticationService.getUserOrderData().subscribe(function (orders) {
            _this58.orderData = orders.data;
            _this58.loadingData = false;
          }, function (error) {});
        }
      }, {
        key: "tabshow",
        value: function tabshow(type) {
          if (type == 'profile') {
            this.location.go('user-profile');
            this.profileTab = true;
            this.plansTab = false;
            this.billingTab = false;
            this.purchaseTab = false;
          } else if (type == 'plans') {
            this.profileTab = false;
            this.plansTab = true;
            this.billingTab = false;
            this.purchaseTab = false;
          } else if (type == 'billing') {
            this.profileTab = false;
            this.plansTab = false;
            this.billingTab = true;
            this.purchaseTab = false;
          } else if (type == 'purchase') {
            this.location.go('purchase');
            this.profileTab = false;
            this.plansTab = false;
            this.billingTab = false;
            this.purchaseTab = true;
          }
        }
      }, {
        key: "orderDetails",
        value: function orderDetails(dataid) {
          this.order_items = this.orderData[dataid]['items'];
        }
      }]);

      return UserProfileComponent;
    }();

    UserProfileComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _angular_common__WEBPACK_IMPORTED_MODULE_4__["Location"]
      }, {
        type: _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]
      }, {
        type: ngx_spinner__WEBPACK_IMPORTED_MODULE_6__["NgxSpinnerService"]
      }];
    };

    UserProfileComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-user-profile',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./user-profile.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/user-profile/user-profile.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./user-profile.component.css */
      "./src/app/user-profile/user-profile.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_common__WEBPACK_IMPORTED_MODULE_4__["Location"], _helpers_image_footer_helper__WEBPACK_IMPORTED_MODULE_5__["imageFooterHelper"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"], ngx_spinner__WEBPACK_IMPORTED_MODULE_6__["NgxSpinnerService"]])], UserProfileComponent);
    /***/
  },

  /***/
  "./src/app/wishlist/wishlist.component.css":
  /*!*************************************************!*\
    !*** ./src/app/wishlist/wishlist.component.css ***!
    \*************************************************/

  /*! exports provided: default */

  /***/
  function srcAppWishlistWishlistComponentCss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "body{ font-weight:normal; background: #f1f5f6 !important;}\r\n#mainNav{background:#000;}\r\nhr {\r\n    border-top: 1px solid #ddd!important;\r\n}\r\n.btn {\r\n    border-radius: 30px;\r\n}\r\n.btn-danger {\r\n    color: #fff;\r\n    background-color: #f23a2e;\r\n    border-color: #f23a2e;\r\n}\r\n.btn-success {\r\n    color: #212529;\r\n    background-color: #8bc34a;\r\n    border-color: #8bc34a;\r\n}\r\n\r\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvd2lzaGxpc3Qvd2lzaGxpc3QuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxNQUFNLGtCQUFrQixFQUFFLDhCQUE4QixDQUFDO0FBQ3pELFNBQVMsZUFBZSxDQUFDO0FBQ3pCO0lBQ0ksb0NBQW9DO0FBQ3hDO0FBQ0E7SUFDSSxtQkFBbUI7QUFDdkI7QUFDQTtJQUNJLFdBQVc7SUFDWCx5QkFBeUI7SUFDekIscUJBQXFCO0FBQ3pCO0FBQ0E7SUFDSSxjQUFjO0lBQ2QseUJBQXlCO0lBQ3pCLHFCQUFxQjtBQUN6QiIsImZpbGUiOiJzcmMvYXBwL3dpc2hsaXN0L3dpc2hsaXN0LmNvbXBvbmVudC5jc3MiLCJzb3VyY2VzQ29udGVudCI6WyJib2R5eyBmb250LXdlaWdodDpub3JtYWw7IGJhY2tncm91bmQ6ICNmMWY1ZjYgIWltcG9ydGFudDt9XHJcbiNtYWluTmF2e2JhY2tncm91bmQ6IzAwMDt9XHJcbmhyIHtcclxuICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZGRkIWltcG9ydGFudDtcclxufVxyXG4uYnRuIHtcclxuICAgIGJvcmRlci1yYWRpdXM6IDMwcHg7XHJcbn1cclxuLmJ0bi1kYW5nZXIge1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjIzYTJlO1xyXG4gICAgYm9yZGVyLWNvbG9yOiAjZjIzYTJlO1xyXG59XHJcbi5idG4tc3VjY2VzcyB7XHJcbiAgICBjb2xvcjogIzIxMjUyOTtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICM4YmMzNGE7XHJcbiAgICBib3JkZXItY29sb3I6ICM4YmMzNGE7XHJcbn1cclxuIl19 */";
    /***/
  },

  /***/
  "./src/app/wishlist/wishlist.component.ts":
  /*!************************************************!*\
    !*** ./src/app/wishlist/wishlist.component.ts ***!
    \************************************************/

  /*! exports provided: WishlistComponent */

  /***/
  function srcAppWishlistWishlistComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "WishlistComponent", function () {
      return WishlistComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _hero_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../hero.service */
    "./src/app/hero.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/fesm2015/router.js");
    /* harmony import */


    var ngx_spinner__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ngx-spinner */
    "./node_modules/ngx-spinner/fesm2015/ngx-spinner.js");

    var WishlistComponent =
    /*#__PURE__*/
    function () {
      function WishlistComponent(heroService, authenticationService, router, spinner) {
        var _this59 = this;

        _classCallCheck(this, WishlistComponent);

        this.heroService = heroService;
        this.authenticationService = authenticationService;
        this.router = router;
        this.spinner = spinner;
        this.wishListDataItems = [];
        this.priceArray = [];
        this.loadingData = false;
        this.promocodeflag = false;
        this.authenticationService.currentUser.subscribe(function (x) {
          _this59.currentUser = x;

          if (!_this59.currentUser) {
            _this59.router.navigate(['/']);
          }
        });
      }

      _createClass(WishlistComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this60 = this;

          //this.spinner.show();
          this.loadingData = true; // console.log(localStorage.getItem('checkoutAray'));

          this.authenticationService.getcartItemsData().subscribe(function (data) {
            _this60.wishListDataItems = data;

            _this60.wishListDataItems.forEach(function (element) {
              _this60.priceArray.push(element["total"]);
            });

            _this60.loadingData = false; //this.spinner.hide();
          }, function (error) {});
        }
      }, {
        key: "showTotalPrice",
        value: function showTotalPrice() {
          return this.priceArray.reduce(function (acc, val) {
            return acc + val;
          }, 0);
        }
      }, {
        key: "redirectToCheckout",
        value: function redirectToCheckout() {
          this.router.navigate(['/checkout']);
        }
      }, {
        key: "promocode",
        value: function promocode() {
          this.promocodeflag = !this.promocodeflag;
        }
      }, {
        key: "removeProductFromCart",
        value: function removeProductFromCart(productinfo) {
          var _this61 = this;

          console.log(productinfo);

          if (confirm('Are you sure?') == true) {
            this.loadingData = true;
            this.heroService.removeCartItemsData(productinfo).subscribe(function (data) {
              if (data["status"] == '1') {
                _this61.priceArray = [];

                _this61.authenticationService.getcartItemsData().subscribe(function (data) {
                  _this61.wishListDataItems = data;

                  _this61.wishListDataItems.forEach(function (element) {
                    _this61.priceArray.push(element["total"]);
                  });

                  _this61.loadingData = false;
                }, function (error) {});
              } else {
                alert(data["message"]);
              }
            }); // this.checkoutArray.push(2);this.checkoutArray.push(3); //remove the line when api integrated
          } else {
            return false;
          }
        }
      }, {
        key: "addtolightbox",
        value: function addtolightbox(productinfo) {
          var _this62 = this;

          console.log(productinfo);
          this.loadingData = true;
          this.heroService.addWishListItemsData(productinfo.cart_product_id).subscribe(function (data) {
            if (data["status"] == '1') {
              _this62.loadingData = false;

              _this62.heroService.removeCartItemsData(productinfo).subscribe(function (data) {
                if (data["status"] == '1') {
                  _this62.priceArray = [];
                } else {
                  alert(data["message"]);
                }
              });

              _this62.router.navigate(['/lightbox']);
            } else {
              _this62.loadingData = false;
              alert(data["message"]);
            }
          });
        }
      }]);

      return WishlistComponent;
    }();

    WishlistComponent.ctorParameters = function () {
      return [{
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]
      }, {
        type: ngx_spinner__WEBPACK_IMPORTED_MODULE_4__["NgxSpinnerService"]
      }];
    };

    WishlistComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-wishlist',
      template: tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! raw-loader!./wishlist.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/wishlist/wishlist.component.html")).default,
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"](__webpack_require__(
      /*! ./wishlist.component.css */
      "./src/app/wishlist/wishlist.component.css")).default]
    }), tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _hero_service__WEBPACK_IMPORTED_MODULE_2__["HeroService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"], ngx_spinner__WEBPACK_IMPORTED_MODULE_4__["NgxSpinnerService"]])], WishlistComponent);
    /***/
  },

  /***/
  "./src/environments/environment.ts":
  /*!*****************************************!*\
    !*** ./src/environments/environment.ts ***!
    \*****************************************/

  /*! exports provided: environment */

  /***/
  function srcEnvironmentsEnvironmentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "environment", function () {
      return environment;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js"); // This file can be replaced during build by using the `fileReplacements` array.
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

    /***/
  },

  /***/
  "./src/main.ts":
  /*!*********************!*\
    !*** ./src/main.ts ***!
    \*********************/

  /*! no exports provided */

  /***/
  function srcMainTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var hammerjs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! hammerjs */
    "./node_modules/hammerjs/hammer.js");
    /* harmony import */


    var hammerjs__WEBPACK_IMPORTED_MODULE_1___default =
    /*#__PURE__*/
    __webpack_require__.n(hammerjs__WEBPACK_IMPORTED_MODULE_1__);
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/fesm2015/core.js");
    /* harmony import */


    var _angular_platform_browser_dynamic__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/platform-browser-dynamic */
    "./node_modules/@angular/platform-browser-dynamic/fesm2015/platform-browser-dynamic.js");
    /* harmony import */


    var _app_app_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./app/app.module */
    "./src/app/app.module.ts");
    /* harmony import */


    var _environments_environment__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./environments/environment */
    "./src/environments/environment.ts");

    if (_environments_environment__WEBPACK_IMPORTED_MODULE_5__["environment"].production) {
      Object(_angular_core__WEBPACK_IMPORTED_MODULE_2__["enableProdMode"])();
    }

    Object(_angular_platform_browser_dynamic__WEBPACK_IMPORTED_MODULE_3__["platformBrowserDynamic"])().bootstrapModule(_app_app_module__WEBPACK_IMPORTED_MODULE_4__["AppModule"]);
    /***/
  },

  /***/
  0:
  /*!***************************!*\
    !*** multi ./src/main.ts ***!
    \***************************/

  /*! no static exports found */

  /***/
  function _(module, exports, __webpack_require__) {
    module.exports = __webpack_require__(
    /*! C:\xampp\htdocs\imagefootagenew\frontend\src\main.ts */
    "./src/main.ts");
    /***/
  }
}, [[0, "runtime", "vendor"]]]);
//# sourceMappingURL=main-es5.js.map