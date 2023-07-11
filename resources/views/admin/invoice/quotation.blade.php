@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper" ng-controller="quotatationController">
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><%title%></h3>
         </div>
         @include('admin.partials.message')
         <div class="box-body">
            <div class="panel-body">
               <form role="form" name="downloadOnBehalf" method="post" class="" enctype="multipart/form-data" ng-submit="submitQuotation()" novalidate>
                  <div class="row">
                     <div class="">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label>UID</label>
                                    <input type="text" name="uname" id="uname" class="form-control" value="{{$userDetail->first_name}} {{$userDetail->last_name}}" readonly>
                                    <input type="hidden" name="uid" id="uid" class="form-control" value="{{$userDetail->id}}" readonly>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6" style="padding-top: 31px;">
                                 <div class="form-group">
                                    <label class="margin-right">
                                       <input type="radio" value="Subscription" name="quotation_type" ng-click="quotation_type_set('subscription')">
                                       Subscription
                                    </label>
                                    <label class="margin-right">
                                       <input type="radio" value="Download_Packs" name="quotation_type" ng-click="quotation_type_set('download')">
                                       Download Packs
                                    </label>
                                    <label class="margin-right">
                                       <input type="radio" value="custom" name="quotation_type" checked="checked" ng-click="quotation_type_set('custom')">
                                       Custom
                                    </label>
                                 </div>
                                 <div class="form-group" ng-if="quotation_type_var !='custom'">
                                    <label class="margin-right">
                                       <input type="radio" value="Images" name="selection_type_prod" ng-click="prod_type('img')">
                                       Images
                                    </label>
                                    <label class="margin-right" ng-if="quotation_type_var =='download'">
                                       <input type="radio" value="Footage" name="selection_type_prod" ng-click="prod_type('foot')">
                                       Footage
                                    </label>
                                 </div>
                                 <div class="form-group" ng-if="quotation_type_var == 'subscription' && prod_type_var == 'img'">
                                    <label class="margin-right">
                                       <input type="radio" value="Monthly" name="plan_type" ng-click="plan_type_select('monthly')">
                                       Monthly
                                    </label>
                                    <label class="margin-right">
                                       <input type="radio" value="Annual" name="plan_type" ng-click="plan_type_select('annual')">
                                       Annual
                                    </label>
                                 </div>
                                 <div class="form-group" ng-show="quotation_type_var !='custom'">
                                    <label>
                                       <button type="button" class="btn btn-danger" ng-click="getPlans()">Get Plan</button>
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="" ng-show="quotation_type_var=='custom'">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="col-lg-6 col-md-4 col-xs-4 repeated-dv " ng-repeat="product in quotation.product">
                                 <div class="form-group">
                                    <label class="">Product Type <%$index+1%> (Image/Footage)</label>
                                    <select required="" class="form-control" ng-model="product.type" ng-change="checkProduct(product)">
                                       <option value="">--Select a Type--</option>
                                       <option value="Image">Image</option>
                                       <option value="Footage">Footage</option>
                                    </select>
                                    <div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class=""><%product.type%> <%$index+1%> (Product ID)</label>
                                    <input type="hidden" class="form-control" ng-model="product.id">
                                    <input type="text" class="form-control" ng-model="product.name" name="product_name" id="product_1" required="" ng-blur="getproduct(product)">
                                    <div>
                                    </div>
                                 </div>
                                 <div class="form-group" ng-show="product.type=='Image'">
                                    <span ng-show="product.image"><img src="<%product.image%>" width="150" height="150" /></span>
                                    <!-- <span ng-show="!product.thumbnail_image"> <input  class="form-control" type="file" name="file<%$index+1%>" ng-model="product.image" id="file<%$index+1%>" style="position:inherit;top:0;left:0;z-index:2;opacity:1;cursor:pointer;" ng-file-select="onFileSelect($files)"></span> -->
                                 </div>
                                 <div class="form-group" ng-show="product.type =='Footage'">
                                    <span ng-show="product.image">
                                    <video class="for_mobile" controls="" width="300px" controlslist="nodownload" onmouseout="this.load()" onmouseover="this.play()" poster="<%product.image%>">
                                       <source type="video/mp4" src="<%product.footage%>"> 
                                       Your browser does not support the video tag. 
                                    </video>
                                 </span>
                                 </div>
                                 <div class="form-group">
                                    <label for="sub_total"><%product.type%> Size</label>
                                    <select required="" class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Image'">
                                       <option value="" selected="">--Select a size--</option>
                                       <option value="Small">Web</option>
                                       <option value="Medium">Medium</option>
                                       <option value="Large">Large</option>
                                       <option value="X-Large">XX-Large</option>
                                       <option value="Custom">Custom</option>
                                    </select>
                                    <select required="" class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Footage'">
                                       <option value="" selected="">--Select a size--</option>
                                       <option ng-repeat="price in prices[$index]" value="<%price.size%>"><%price.size%></option>
                                    </select>
                                 </div>
                                 <div class="form-group" ng-show="product.type=='Image'">
                                    <label for="pro_type"><%product.type%> type</label>
                                    <select required="" class="form-control" ng-model="product.pro_type">
                                       <option value="">--Select a Type--</option>
                                       <option value="right_managed">Right Managed</option>
                                       <option value="royalty_free">Royalty Free</option>
                                    </select>
                                 </div>
                                 <div>
                                    <div>
                                       <div class="form-group">
                                          <label for="sub_total">Sub Total</label>
                                          <input type="text" class="form-control" ng-model="product.price" name="price" required ng-keyup="getTheTotal();" ngMousedown="getTheTotal();">
                                       </div>
                                    </div>
                                 </div>
                                 <label>
                                    <button type="button" class="btn btn-danger" ng-click="removeProduct(product)" ng-show="$last">Delete Image</button>
                                 </label>&nbsp;
                                 <label class="">
                                    <button type="button" class="btn btn-danger" ng-click="addProduct()" ng-show="$last">Add More Image</button>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="tax">Tax Applicable</label>
                                    <div>
                                       <span style="float: left;">
                                          <input type="checkbox" ng-model="GST" ng-change="checkThetax(GST,'GST');" name="tax_checkbox[]">&nbsp;&nbsp; GST- +{{ config('constants.GST_VALUE').'%' }}
                                       </span>
                                       <span style="float: left;padding-left:20px;">
                                          <input type="text" ng-model="tax" class="form-control" style="width:150px;" name="tax" readonly="">
                                       </span>
                                    </div>
                                    <!-- <div>
                                          <input type="checkbox" ng-model="SGST" ng-change="checkThetax(SGST,'SGST');" name="tax_checkbox[]"> SGST- +6%
                                       </div>
                                       <div class="">
                                          <input type="checkbox" ng-model="CGST" ng-change="checkThetax(CGST,'CGST');" name="tax_checkbox[]"> CGST- +6%
                                       </div>
                                       <div class="ng-binding ng-scope">
                                          <input type="checkbox" ng-model="IGST" ng-change="checkThetax(IGST,'IGST');" name="tax_checkbox[]"> IGST- +12%
                                       </div>
                                       <div class="ng-binding ng-scope">
                                          <input type="checkbox" ng-model="IGSTT" ng-change="checkThetax(IGSTT,'IGSTT');" name="tax_checkbox[]"> IGST- +18%
                                       </div> -->
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="Total">Total</label>
                                    <input type="text" class="form-control " ng-model="total" name="Total" readonly="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="promoCode">Promo code</label>
                                    <input type="text" class="form-control" name="promoCode" ng-model="promoCode">
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <!-- <div class="form-group">
                                    <label for="job_number">JOb Ref/Po #</label>
                                    <select  class="form-control" required="" name="po" ng-model="po">
                                       <option value="">--Select a Job PO--</option>
                                       <!-- <option value="upload_po">Upload PO</option>
                                          <option value="email_approval">Email Approval</option> -->
                                 <!-- <option value="po_in_3days">PO Due In 3 Days</option>
                                       <option value="po_in_7days">PO Due In 7 Days</option>
                                       <option value="po_in_15days">PO Due In 15 Days</option>
                                    </select>
                                 </div> -->
                                 <!-- <div class="">
                                    <div class="row"> -->
                                 <?php /* <div class="col-lg-6 col-md-6 col-xs-12">
                                          <div class="form-group" >
                                             <label for="po_no">PO No.</label>
                                             <input type="text" class="form-control"  name="poDate" id="poDate" ng-model="poDate" autocomplete="false">
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-md-6 col-xs-12"></div>
                                    </div>
                                    <div class="form-group">
                                       <label for="email_id">Email</label>
                                       
                                    </div> */ ?>
                                 <div class="form-group">
                                    <input type="hidden" class="form-control" id="email_id" name="email_id" ng-model="email" value ="{{$userDetail->email}}">
                                    <input type="hidden" class="form-control" id="flag" name="flag" ng-model="flag" value ="1">
                                    <label for="expiry">Expiry Period</label><br>
                                    <input type="radio" ng-value="'7'" name="expiry" ng-model="expiry_time">&nbsp;&nbsp;7 Days &nbsp;&nbsp;
                                    <input type="radio" ng-value="'30'" name="expiry" ng-model="expiry_time">&nbsp;&nbsp;30 Days
                                 </div>
                                 <!-- </div>
                                 </div>
                                 <div class="col-lg-4 col-md-6 col-xs-4"></div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="" ng-show="quotation_type_var=='subscription' && search === true">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
                                 <div class="form-group" ng-if="plan_type_var == 'monthly'">
                                    <label for="sub_total">Plan Name</label>
                                    <select id="myDropdown" required="" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
                                       <option value="" selected="">--Select a plan--</option>
                                       <option value="<%plan%>" ng-repeat="plan in plansData"><%plan.package_description%></option>
                                    </select>
                                 </div>
                                 <div class="form-group" ng-if="plan_type_var == 'annual'">
                                    <label for="sub_total">Plan Name</label>
                                    <select id="myDropdown" required="" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
                                       <option value="" selected="">--Select a plan--</option>
                                       <option value="<%plan%>" ng-repeat="plan in plansData"><%plan.package_description%> For 1 Year</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
                                 <div class="form-group">
                                    <label for="sub_total">Sub Total</label>
                                    <input type="text" class="form-control" ng-model="subscriptionprice" name="subscriptionprice" required ng-keyup="getTheTotal(product);" ngMousedown="getTheTotal(product);">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="tax">Tax Applicable</label>
                                    <div>
                                       <span style="float: left;">
                                          <input type="checkbox" ng-model="GSTS" ng-change="checksubsctax(GSTS, 'GST');" name="tax_checkbox[]">&nbsp;&nbsp; GST- +{{ config('constants.GST_VALUE').'%' }}
                                       </span>
                                       <span style="float: left;padding-left:20px;">
                                          <input type="text" ng-model="subsc_tax" class="form-control" style="width:150px;" name="subsc_tax" readonly="">
                                       </span>
                                    </div>
                                    <!-- <div>
                                             <input type="checkbox" ng-model="SGSTS" ng-change="checksubsctax(SGSTS,'SGST');" name="tax_checkbox[]"> SGST- +6%
                                          </div>
                                          <div  class="">
                                             <input type="checkbox" ng-model="CGSTS" ng-change="checksubsctax(CGSTS,'CGST');" name="tax_checkbox[]"> CGST- +6%
                                          </div>
                                          <div  class="ng-binding ng-scope">
                                             <input type="checkbox" ng-model="IGSTS"  ng-change="checksubsctax(IGSTS,'IGST');" name="tax_checkbox[]" > IGST- +12%
                                          </div>
                                          <div  class="ng-binding ng-scope">
                                             <input type="checkbox"  ng-model="IGSTTS" ng-change="checksubsctax(IGSTTS,'IGSTT');" name="tax_checkbox[]" > IGST- +18%
                                          </div> -->
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="Total">Total</label>
                                    <input type="text" class="form-control " ng-model="subsc_total" name="subsc_total" readonly="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="promoCode">Promo code</label>
                                    <input type="text" class="form-control" name="promoCode" ng-model="promoCode">
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <!-- <div class="form-group">
                                    <label for="job_number">JOb Ref/Po #</label>
                                    <select  class="form-control" required="" name="subsc_po" ng-model="subsc_po">
                                       <option value="">--Select a Job PO--</option>
                                       <!-- <option value="upload_po">Upload PO</option>
                                          <option value="email_approval">Email Approval</option> -->
                                 <!-- <option value="po_in_3days">PO Due In 3 Days</option>
                                       <option value="po_in_7days">PO Due In 7 Days</option>
                                       <option value="po_in_15days">PO Due In 15 Days</option>
                                    </select>
                                 </div> -->
                                 <!-- <div class="">
                                    <div class="row"> -->
                                 <?php /* <div class="col-lg-6 col-md-6 col-xs-12">
                                          <div class="form-group" >
                                             <label for="po_no">PO No.</label>
                                             <input type="text" class="form-control" name="subsc_poDate" id="subsc_poDate" ng-model="subsc_poDate" autocomplete="false">
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-md-6 col-xs-12"></div>
                                    </div>
                                    <div class="form-group">
                                       <label for="email_id">Email</label>
                                       <input type="email" class="form-control"  id="subsc_email_id" name="subsc_email_id" ng-model="subsc_email_id" >
                                    </div> */ ?>
                                 <div class="form-group">
                                    <input type="hidden" class="form-control"  id="subsc_email_id" name="subsc_email_id" ng-model="subsc_email_id" value ="{{$userDetail->email}}">
                                    <label for="expiry">Expiry Period</label><br>
                                    <input type="radio" ng-value="'7'" name="subsc_expiry" ng-model="subsc_expiry_time">&nbsp;&nbsp;7 Days &nbsp;&nbsp;
                                    <input type="radio" ng-value="'30'" name="subsc_expiry" ng-model="subsc_expiry_time">&nbsp;&nbsp;30 Days
                                 </div>
                                 <!-- </div>
                                 </div>
                                 <div class="col-lg-4 col-md-6 col-xs-4"></div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="" ng-show="quotation_type_var=='download' && search === true">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
                                 <div class="form-group">
                                    <label for="sub_total">Plan Name</label>
                                    <select id="myDropdown" required="" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'download')">
                                       <option value="" selected="">--Select a plan--</option>
                                       <option value="<%plan%>" ng-repeat="plan in plansData"><%plan.package_description%> Within 1 Year </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
                                 <div class="form-group">
                                    <label for="sub_total">Sub Total</label>
                                    <input type="text" class="form-control" ng-model="downloadprice" name="downloadprice" required ng-keyup="getTheTotal(product);" ngMousedown="getTheTotal(product);">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="tax">Tax Applicable</label>
                                    <div>
                                       <span style="float: left;">
                                          <input type="checkbox" ng-model="GSTD" ng-change="checkDownloadtax(GSTD,'GST');" name="tax_checkbox_download[]">&nbsp;&nbsp; GST- +{{ config('constants.GST_VALUE').'%' }}
                                       </span>
                                       <span style="float: left;padding-left:20px;">
                                          <input type="text" ng-model="taxdownload" class="form-control" style="width:150px;" name="taxdownload" readonly="">
                                       </span>
                                    </div>
                                    <!-- <div>
                                          <input type="checkbox" ng-model="SGSTD" ng-change="checkDownloadtax(SGSTD,'SGST');" name="tax_checkbox_download[]"> SGST- +6%
                                       </div>
                                       <div  class="">
                                          <input type="checkbox" ng-model="CGSTD" ng-change="checkDownloadtax(CGSTD,'CGST');" name="tax_checkbox_download[]"> CGST- +6%
                                       </div>
                                       <div  class="ng-binding ng-scope">
                                          <input type="checkbox" ng-model="IGSTD"  ng-change="checkDownloadtax(IGSTD,'IGST');" name="tax_checkbox_download[]" > IGST- +12%
                                       </div>
                                       <div  class="ng-binding ng-scope">
                                          <input type="checkbox"  ng-model="IGSTTD" ng-change="checkDownloadtax(IGSTTD,'IGSTT');" name="tax_checkbox_download[]" > IGST- +18%
                                       </div> -->
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="Total">Total</label>
                                    <input type="text" class="form-control " ng-model="total_download" name="total_download" readonly="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <div class="form-group">
                                    <label for="promoCode">Promo code</label>
                                    <input type="text" class="form-control" name="promoCode" ng-model="promoCode">
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6">
                                 <!-- <div class="form-group">
                                    <label for="job_number">JOb Ref/Po #</label>
                                    <select  class="form-control" required="" name="poDownload"  ng-model="poDownload">
                                       <option value="">--Select a Job PO--</option>
                                       <!-- <option value="upload_po">Upload PO</option>
                                          <option value="email_approval">Email Approval</option> -->
                                 <!-- <option value="po_in_3days">PO Due In 3 Days</option>
                                       <option value="po_in_7days">PO Due In 7 Days</option>
                                       <option value="po_in_15days">PO Due In 15 Days</option>
                                    </select>
                                 </div> -->
                                 <!-- <div class="">
                                    <div class="row"> -->
                                 <?php /* <div class="col-lg-6 col-md-6 col-xs-12">
                                          <div class="form-group" >
                                             <label for="po_no">PO No.</label>
                                             <input type="text" class="form-control"  name="downloadpoDate" id="downloadpoDate" ng-model="downloadpoDate" autocomplete="false">
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-md-6 col-xs-12"></div>
                                    </div>
                                    <div class="form-group">
                                       <label for="email_id">Email</label>
                                       <input type="email" class="form-control" id="download_email_id" name="download_email_id" ng-model="download_email_id" >
                                    </div> */ ?>
                                 <div class="form-group">
                                    <input type="hidden" class="form-control" id="download_email_id" name="download_email_id" value ="{{$userDetail->email}}">
                                    <label for="expiry">Expiry Period</label><br>
                                    <input type="radio" ng-value="'7'" name="download_expiry" ng-model="download_expiry">&nbsp;&nbsp;7 Days &nbsp;&nbsp;
                                    <input type="radio" ng-value="'30'" name="download_expiry" ng-model="download_expiry">&nbsp;&nbsp;30 Days
                                 </div>
                                 <!-- </div>
                                 </div>
                                 <div class="col-lg-4 col-md-6 col-xs-4"></div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12" align="center" ng-show="search === true || quotation_type_var=='custom'">
                              <button name="submit" class="btn btn-danger ng-binding">Submit</button>
                              <button type="reset" class="btn btn-danger">Reset</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</div>

@endsection
@section('scripts')

<script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script>
   $(function() {
      $("#poDate").datepicker();
      $("#downloadpoDate").datepicker();
      $("#subsc_poDate").datepicker();
   });
</script>

@stop