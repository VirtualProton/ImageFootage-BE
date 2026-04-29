@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper" ng-controller="editquotatationController">
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><%title%></h3><a href="{{ url('admin/users/invoices', $userDetail->id) }}" class="btn pull-right">Back</a>
			</div>
			@include('admin.partials.message')

			<div class="box-body">

				<div class="panel-body">
					<form role="form" name="downloadOnBehalf" method="post" class="" enctype="multipart/form-data" ng-submit="submitQuotation()">
						<div class="row">
							<div class="">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<label>UID</label>
												<input type="text" name="uname" id="uname" class="form-control" value="{{$userDetail->first_name}} {{$userDetail->last_name}}" readonly>
												<input type="hidden" name="uid" id="uid" class="form-control" value="{{$userDetail->id}}" readonly>
												<input type="hidden" name="promo_code_id" id="promo_code_id" class="form-control" readonly>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-6" style="padding-top: 31px;">
											<div class="form-group">
												<label class="margin-right">
													<input type="radio" name="quotation_type" ng-click="edit_quotation_type_set(1)" ng-model="quotation_type" ng-value="1">
													Subscription
												</label>
												<label class="margin-right">
													<input type="radio" name="quotation_type" ng-click="edit_quotation_type_set(2)" ng-model="quotation_type" ng-value="2">
													Download Packs
												</label>
												<label class="margin-right">
													<input type="radio" name="quotation_type" ng-click="edit_quotation_type_set(3)" ng-model="quotation_type" ng-value="3">
													Custom
												</label>
											</div>
											<div class="form-group" ng-if="quotation_type !='3'">
												<label class="margin-right">
													<input type="radio" name="prod_type" ng-model="prod_type" ng-value="'Image'" ng-click="edit_prod_type_set('Image')">
													Images
												</label>
												<label class="margin-right" ng-if="quotation_type =='2'">
													<input type="radio" name="prod_type" ng-model="prod_type" ng-value="'Footage'" ng-click="edit_prod_type_set('Footage')">
													Footage
												</label>
												 <label class="margin-right" ng-if="quotation_type !='3'">
                                      				 <input type="radio" name="prod_type" ng-model="prod_type" ng-value="'Music'" ng-click="edit_prod_type_set('Music')">
                                       					Music
                                    			</label>
											</div>
											<div class="form-group" ng-if="quotation_type == '1' && prod_type == 'Image'">
												<label class="margin-right">
													<input type="radio" ng-value="'monthly'" ng-model="plan_type" name="plan_type" ng-click="edit_plan_type_select('monthly')">
													Monthly
												</label>
												<label class="margin-right">
													<input type="radio" ng-value="'quarterly'" ng-model="plan_type" name="plan_type" ng-click="edit_plan_type_select('quarterly')">
													Quarterly
												</label>
												<label class="margin-right">
													<input type="radio" ng-value="'half_yearly'" ng-model="plan_type" name="plan_type" ng-click="edit_plan_type_select('half_yearly')">
													Half Year
												</label>
												<label class="margin-right">
													<input type="radio" ng-value="'annual'" ng-model="plan_type" name="plan_type" ng-click="edit_plan_type_select('annual')">
													Annual
												</label>
											</div>
											<div class="form-group" ng-show="quotation_type !='3'">
												<label>
													<button type="button" class="btn btn-danger" ng-click="getPlans()">Get Package</button>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row" ng-if="flag == 2">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<label>End Client Field</label>
												<input type="text" ng-model="end_client" id="end_client" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="" ng-show="quotation_type == '3'">
								<div class="row">
									<div class="col-sm-12">
										<div class="col-lg-6 col-md-4 col-xs-4 repeated-dv " ng-repeat="product in quotation.product">
											<div class="form-group">
												<label class="">Product Type <%$index+1%> (Image/Footage/Music)</label>
												<select class="form-control" ng-model="product.type" ng-change="checkProduct(product)">
													<option value="">--Select a Type--</option>
													<option value="Image">Image</option>
													<option value="Footage">Footage</option>
													<option value="Music">Music</option>
												</select>
												<div>
												</div>
											</div>
											<div class="form-group" ng-if="product.type">
												<label class=""><%product.type%> <%$index+1%> (Product ID)</label>
												<input type="hidden" class="form-control" ng-model="product.id">
												<input ng-if="product.type=='Footage' || product.type=='Image'" type="text" class="form-control" ng-model="product.name" name="product_name" id="product_<%$index+1%>" ng-change="getproduct(product)">
												<input ng-if="product.type=='Music'" type="text" class="form-control" ng-model="product.name" name="product_name" id="product_<%$index+1%>">
												<div>
												</div>
											</div>
											<div class="form-group" ng-show="product.type=='Image'">
												<label>OR Upload Thumbnail</label>
												<span ng-show="product.image"><img ng-src="<%product.image%>" width="150" height="150" /></span>
												<span ng-show="!product.thumbnail_image"> <input class="form-control" type="file" accept="image/*" name="file<%$index+1%>" ng-model="product.image" id="file<%$index+1%>" style="position:inherit;top:0;left:0;z-index:2;opacity:1;cursor:pointer;" ng-file-select="onFileSelect($files)"></span>
											</div>
											<div class="form-group" ng-show="product.type =='Footage'">
												<span ng-show="product.image">
													<video class="for_mobile" controls="" width="300px" controlslist="nodownload" onmouseout="this.load()" onmouseover="this.play()" ng-attr-poster="<%product.image%>">
														<source type="video/mp4" src="<%product.footage%>">
														Your browser does not support the video tag.
													</video>
												</span>
											</div>
											<div class="form-group" ng-show="product.type=='Footage'">
												<label for="pro_type"><%product.type%> Licence Type</label>
												<select class="form-control" ng-model="product.pro_type">
													<option value="">--Select a Licence--</option>
													<option value="1">Commercial (Promotion, Marketing, Advertising)</option>
													<option value="2">Media Non Commercial (Doc, Education, News)</option>
													<option value="3">Web Only</option>
													<option value="4">All Media</option>
												</select>
											</div>
											<div class="form-group" ng-if="product.type && flag !==2" ng-show="product.type!='Music'">
												<label for="sub_total"><%product.type%> Size</label>
												<select class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Image'">
													<option value="">--Select a size--</option>
													<option value="Small">Web</option>
													<option value="Medium">Medium</option>
													<option value="X-Large">XX-Large</option>
													<option value="Custom">Custom</option>
												</select>
												<select class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Footage'">
													<option value="">--Select a size--</option>
													@foreach ($getFootageSizeDetails as $getFootageSizeDetail)
													<option value="{{ $getFootageSizeDetail['type'] }}">{{ $getFootageSizeDetail['type'] }}</option>
													@endforeach
												</select>
											</div>
                                            <div class="form-group" ng-if="product.type && flag == 2" ng-show="product.type!='Music'">
												<label for="sub_total"><%product.type%> Size</label>
												<select class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Image'">
													<option value="">--Select a size--</option>
													<option value="Small">Web</option>
													<option value="Medium">Medium</option>
                                                    <option value="Large">Large</option>
													<option value="X-Large">XX-Large</option>
													<option value="Custom">Custom</option>
												</select>
												<select class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Footage'">
													<option value="">--Select a size--</option>
													@foreach ($getFootageSizeDetails as $getFootageSizeDetail)
													<option value="{{ $getFootageSizeDetail['type'] }}">{{ $getFootageSizeDetail['type'] }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group" ng-if="product.type=='Image'">
												<label for="pro_type"><%product.type%> type</label>
												<select class="form-control" ng-model="product.pro_type">
													<option value="">--Select a Type--</option>
													<option value="royalty_free">Royalty Free</option>
												</select>
											</div>
											<div class="form-group" ng-show="((product.type=='Image' && product.pro_type=='royalty_free') || product.type=='Music')">
												<label for="licence_type"><%product.type%> Licence type</label>
												<select class="form-control" ng-model="product.licence_type" ng-change="getThetotalAmount(product)"  id="licence_dropdown">
													<option value="">--Select a Licence Type--</option>
													@foreach ($getMusicLicenceDetails as $getMusicLicenceDetail)
													<option value="{{ $getMusicLicenceDetail['value'] }}">{{ $getMusicLicenceDetail['licence_type'] }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group" ng-show="(product.type=='Image' || product.type=='Music') && product.pro_type=='right_managed'">
												<label for="licence_type"><%product.type%> Licence type</label>
												<textarea class="form-control licence_type" id="licence_type-<%$index+1%>" ng-model="product.licence_type"></textarea>
											</div>
                                            <!-- <div class="form-group" ng-show="(product.type=='Image' || product.type=='Music') && product.pro_type=='royalty_free' && product.licence_type !='' && flag ==2">
                                                <label for="licence_type"></label>
                                                <input type="text" class="form-control" ng-model="product.extra_details" id="extra_details"/>
                                             </div> -->
											 <div class="form-group">
												<label for="extra_details">Description</label>
												<textarea id="extra_details" class="form-control" ng-model="product.extra_details" rows="3" placeholder="Enter description"></textarea>
											</div>
											<div ng-if="product.type">
												<div>
													<div class="form-group">
														<label for="sub_total">Sub Total</label>
														<input type="text" class="form-control" ng-model="product.price" name="price" inputmode="decimal" two-decimal-amount ng-change="sanitizeProductPrice(product); getTheTotal();">
													</div>
												</div>
											</div>
											<label ng-if="quotation.product.length > 1" style="margin-right:8px;">
												<button type="button" class="btn btn-danger" ng-click="removeProduct(product)">Delete</button>
											</label>
											<label class="">
												<button type="button" class="btn btn-danger" ng-click="addProduct()" ng-show="$last">Add More</button>
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<div style="display:flex;flex-wrap:wrap;align-items:flex-end;gap:16px;">
													<div style="flex:1 1 260px;min-width:260px;">
														<label for="tax" style="display:block;">Tax Applicable</label>
														<div style="display:flex;flex-wrap:wrap;align-items:center;gap:12px;">
															<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;">
																<input type="checkbox" ng-model="is_gst_applied" ng-change="checkThetax(GST,'GST',{},{{$userDetail->country}});" name="tax_checkbox[]" style="margin-right:8px;"> GST- +{{ config('constants.GST_VALUE').'%' }}
															</label>
															<input type="text" ng-model="tax" class="form-control" style="flex:1 1 180px;min-width:180px;" name="tax" readonly="">
														</div>
													</div>
													<div style="flex:1 1 160px;min-width:160px;">
														<label for="currency" style="display:block;">Currency</label>
														<select class="form-control" ng-model="selected_currency" ng-init="selected_currency = selected_currency || 'INR'" ng-change="syncCustomProductCurrencies()">
															<option value="INR">INR</option>
															<option value="USD">USD</option>
														</select>
													</div>
												</div>
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
												<input type="text" class="form-control" name="promoCode" ng-model="promoCode" id="promo_code">
												<span id="span-message"></span>
												<div class="text-info" ng-show="discount_amount_display">Discount Applied: <%selected_currency || 'INR'%> <%discount_amount_display%></div>
											</div>
											<button class="btn btn-primary" type="button" id="btn-promocode">Apply Promo Code</button>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<input type="hidden" class="form-control" id="email_id" name="email_id" ng-model="email" value="{{$userDetail->email}}">
												<input type="hidden" class="form-control" id="flag" name="flag" ng-model="flag" value="1">
												<label for="expiry" style="display:block;">Expiry Period</label>
												<div style="display:flex;flex-wrap:wrap;align-items:center;gap:12px 18px;">
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'7'" name="expiry" ng-model="expiry_time" style="margin:0 6px 0 0;">7 Days
													</label>
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'15'" name="expiry" ng-model="expiry_time" style="margin:0 6px 0 0;">15 Days
													</label>
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'30'" name="expiry" ng-model="expiry_time" style="margin:0 6px 0 0;">30 Days
													</label>
													<div style="display:inline-flex;align-items:center;gap:8px;">
														<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
															<input type="radio" ng-value="'custom'" name="expiry" ng-model="expiry_time" style="margin:0 6px 0 0;">Custom
														</label>
														<input type="number" class="form-control" ng-model="custom_expiry_time" min="1" placeholder="Enter days" ng-disabled="expiry_time != 'custom'" ng-style="{'visibility': expiry_time == 'custom' ? 'visible' : 'hidden'}" style="width:120px;display:inline-block;">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="" ng-show="quotation_type=='1'">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
											<div class="form-group" ng-if="plan_type == 'monthly'">
												<label for="sub_total">Package Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a package--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%></option>
												</select>
											</div>
											<div class="form-group" ng-if="plan_type == 'quarterly'">
												<label for="sub_total">Package Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a package--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%></option>
												</select>
											</div>
											<div class="form-group" ng-if="plan_type == 'half_yearly'">
												<label for="sub_total">Package Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a package--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%></option>
												</select>
											</div>
											<div class="form-group" ng-if="plan_type == 'annual'">
												<label for="sub_total">Package Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a package--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%> For 1 Year</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
											<div class="form-group">
												<label for="sub_total">Sub Total</label>
												<input type="text" class="form-control" ng-model="subscriptionprice" name="subscriptionprice" ng-keyup="getTheTotal();" ngMousedown="getTheTotal();">
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
														<input type="checkbox" ng-model="GSTS" ng-change="checksubsctax(GSTS, 'GST',{{$userDetail->country}});" name="tax_checkbox[]">&nbsp;&nbsp; GST- +{{ config('constants.GST_VALUE').'%' }}
													</span>
													<span style="float: left;padding-left:20px;">
														<input type="text" ng-model="subsc_tax" class="form-control" style="flex:1 1 180px;min-width:180px;" name="subsc_tax" readonly="">
													</span>
												</div>
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
												<input type="text" class="form-control" name="promoCode" ng-model="promoCode" id="promo_code_sub">
												<span id="span-message-sub"></span>
												<div class="text-info" ng-show="subsc_discount_amount_display">Discount Applied: INR <%subsc_discount_amount_display%></div>
											</div>
											<button class="btn btn-primary" type="button" id="btn-promocode-sub">Apply Promo Code</button>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<input type="hidden" class="form-control" id="subsc_email_id" name="subsc_email_id" ng-model="subsc_email_id" value="{{$userDetail->email}}">
												<label for="expiry" style="display:block;">Expiry Period</label>
												<div style="display:flex;flex-wrap:wrap;align-items:center;gap:12px 18px;">
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'7'" name="subsc_expiry" ng-model="subsc_expiry_time" style="margin:0 6px 0 0;">7 Days
													</label>
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'15'" name="subsc_expiry" ng-model="subsc_expiry_time" style="margin:0 6px 0 0;">15 Days
													</label>
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'30'" name="subsc_expiry" ng-model="subsc_expiry_time" style="margin:0 6px 0 0;">30 Days
													</label>
													<div style="display:inline-flex;align-items:center;gap:8px;">
														<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
															<input type="radio" ng-value="'custom'" name="subsc_expiry" ng-model="subsc_expiry_time" style="margin:0 6px 0 0;">Custom
														</label>
														<input type="number" class="form-control" ng-model="custom_subsc_expiry_time" min="1" placeholder="Enter days" ng-disabled="subsc_expiry_time != 'custom'" ng-style="{'visibility': subsc_expiry_time == 'custom' ? 'visible' : 'hidden'}" style="width:120px;display:inline-block;">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="" ng-show="quotation_type=='2'">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
											<div class="form-group">
												<label for="sub_total">Package Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'download')">
													<option ng-value="">--Select a package--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%> Within 1 Year </option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-4 col-xs-4 repeated-dv">
											<div class="form-group">
												<label for="sub_total">Sub Total</label>
												<input type="text" class="form-control" ng-model="downloadprice" name="downloadprice" ng-keyup="getTheTotal(product);" ngMousedown="getTheTotal(product);">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<div style="display:flex;flex-wrap:wrap;align-items:flex-end;gap:16px;">
													<div style="flex:1 1 260px;min-width:260px;">
														<label for="tax" style="display:block;">Tax Applicable</label>
														<div style="display:flex;flex-wrap:wrap;align-items:center;gap:12px;">
															<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;">
																<input type="checkbox" ng-model="GSTD" ng-checked="true" ng-change="checkDownloadtax(GSTD,'GST',{{$userDetail->country ?? 0}});" name="tax_checkbox_download[]" style="margin-right:8px;"> GST- +{{ config('constants.GST_VALUE').'%' }}
															</label>
															<input type="text" ng-model="taxdownload" class="form-control" style="flex:1 1 180px;min-width:180px;" name="taxdownload" readonly="">
														</div>
													</div>
													<div style="flex:1 1 160px;min-width:160px;">
														<label for="currency" style="display:block;">Currency</label>
														<select class="form-control" ng-model="selected_currency" ng-init="selected_currency = selected_currency || 'INR'">
															<option value="INR">INR</option>
															<option value="USD">USD</option>
														</select>
													</div>
												</div>
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
												<input type="text" class="form-control" name="promoCode" ng-model="promoCode" id="promo_code_dis">
												<span id="span-message-dis"></span>
												<div class="text-info" ng-show="download_discount_amount_display">Discount Applied: <%selected_currency || 'INR'%> <%download_discount_amount_display%></div>
											</div>
											<button class="btn btn-primary" type="button" id="btn-promocode-dis">Apply Promo Code</button>
										</div>

										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<input type="hidden" class="form-control" id="download_email_id" name="download_email_id" value="{{$userDetail->email}}">
												<label for="expiry" style="display:block;">Expiry Period</label>
												<div style="display:flex;flex-wrap:wrap;align-items:center;gap:12px 18px;">
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'7'" name="download_expiry" ng-model="download_expiry" style="margin:0 6px 0 0;">7 Days
													</label>
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'15'" name="download_expiry" ng-model="download_expiry" style="margin:0 6px 0 0;">15 Days
													</label>
													<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
														<input type="radio" ng-value="'30'" name="download_expiry" ng-model="download_expiry" style="margin:0 6px 0 0;">30 Days
													</label>
													<div style="display:inline-flex;align-items:center;gap:8px;">
														<label style="display:inline-flex;align-items:center;font-weight:400;margin:0;white-space:nowrap;">
															<input type="radio" ng-value="'custom'" name="download_expiry" ng-model="download_expiry" style="margin:0 6px 0 0;">Custom
														</label>
														<input type="number" class="form-control" ng-model="custom_download_expiry" min="1" placeholder="Enter days" ng-disabled="download_expiry != 'custom'" ng-style="{'visibility': download_expiry == 'custom' ? 'visible' : 'hidden'}" style="width:120px;display:inline-block;">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row" ng-if="quotation_type=='1'">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="col-lg-6 col-md-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="currency">Currency</label>
                                                <input type="text" class="form-control" ng-model="selected_currency" ng-init="selected_currency = selected_currency || 'INR'" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-xs-12" align="center">
									<button type="submit" class="btn btn-danger ng-binding">Submit</button>
									<button type="reset" class="btn btn-danger">Reset</button>
									<a href="{{ url('admin/users/invoices', $userDetail->id) }}" class="btn btn-primary">Back</a>
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
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
	var getFootageSizeDetails = @json($getFootageSizeDetails);
	var getMusicLicenceDetails = @json($getMusicLicenceDetails);

	$(document).ready(function($) {
        var countryId = @json($userDetail->country);

		// Example Validataion Standard Mode
		// ---------------------------------
		(function() {

		})();

		$('#btn-promocode').hide();
		function toAmount(value) {
			var amount = parseFloat(value);
			return isNaN(amount) ? 0 : amount;
		}

		function getPromoTaxRate() {
			return toAmount(window.gst_value);
		}

		function roundAmount(value) {
			return Math.round((toAmount(value) + Number.EPSILON) * 100) / 100;
		}

		function sumProductPrices(scope) {
			var subtotal = 0;
			angular.forEach((scope.quotation && scope.quotation.product) || [], function(product) {
				subtotal += toAmount(product && product.price);
			});
			return roundAmount(subtotal);
		}

		function calculatePromoTotals(subtotal, promo, applyTax) {
			var normalizedSubtotal = roundAmount(subtotal);
			var normalizedPromo = promo || {};
			var discount = 0;

			if (normalizedPromo.type === 'flat') {
				discount = toAmount(normalizedPromo.discount);
			} else if (normalizedPromo.type === 'percentage') {
				discount = normalizedSubtotal * (toAmount(normalizedPromo.discount) / 100);
			}

			discount = roundAmount(Math.min(Math.max(discount, 0), normalizedSubtotal));
			var discountedSubtotal = roundAmount(Math.max(normalizedSubtotal - discount, 0));
			var tax = applyTax ? roundAmount((discountedSubtotal * getPromoTaxRate()) / 100) : 0;
			var total = roundAmount(discountedSubtotal + tax);

			return {
				discount: discount > 0 ? discount.toFixed(2) : '',
				tax: tax,
				total: total.toFixed(2)
			};
		}

		function applyPromoCalculation(buttonSelector, mode, promo) {
			var scope = angular.element($(buttonSelector)).scope();
			if (!scope) {
				return;
			}

			if (mode === 'custom') {
				var customResult = calculatePromoTotals(
					sumProductPrices(scope),
					promo,
					!!scope.is_gst_applied || toAmount(scope.tax) > 0
				);
				scope.tax = customResult.tax;
				scope.total = customResult.total;
				scope.discount_amount_display = customResult.discount;
			} else if (mode === 'subscription') {
				var subResult = calculatePromoTotals(
					toAmount(scope.subscriptionprice),
					promo,
					!!scope.GSTS || toAmount(scope.subsc_tax) > 0
				);
				scope.subsc_tax = subResult.tax;
				scope.subsc_total = subResult.total;
				scope.subsc_discount_amount_display = subResult.discount;
			} else if (mode === 'download') {
				var downloadResult = calculatePromoTotals(
					toAmount(scope.downloadprice),
					promo,
					!!scope.GSTD || toAmount(scope.taxdownload) > 0
				);
				scope.taxdownload = downloadResult.tax;
				scope.total_download = downloadResult.total;
				scope.download_discount_amount_display = downloadResult.discount;
			}

			if (!scope.$$phase) {
				scope.$apply();
			}
		}

		function resetPromoState(buttonSelector, mode, messageSelector) {
			$('#promo_code_id').val('');
			applyPromoCalculation(buttonSelector, mode, {});
			if (messageSelector) {
				$(messageSelector).removeAttr('class');
				$(messageSelector).text('');
			}
		}

		$('#promo_code').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('#btn-promocode').show()
			else {
				$('#btn-promocode').hide()
				resetPromoState("#btn-promocode", "custom", "#span-message");
			}
		});
		$('#promo_code_sub').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('#btn-promocode-sub').show()
			else {
				$('#btn-promocode-sub').hide()
				resetPromoState("#btn-promocode-sub", "subscription", "#span-message-sub");
			}
		});
		$('#promo_code_dis').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('#btn-promocode-dis').show()
			else {
				$('#btn-promocode-dis').hide()
				resetPromoState("#btn-promocode-dis", "download", "#span-message-dis");
			}
		});
		$(document).on("click", "#btn-promocode", function(e) {

			e.preventDefault();

			let promoCode = $("#promo_code").val();

			$.ajax({
				url: '{{ URL::to("admin/getPromoCode") }}',
				type: 'POST',
				data: {
					promo_code: promoCode,
				},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				error: function() {
					alert("error");
				},
				success: function(result) {
					// if error
					if (result.status === 'error') {
						$('#promo_code_id').val('');
						applyPromoCalculation("#btn-promocode", "custom", {});
						$('#span-message').removeAttr('class');
						$('#span-message').text(result.message);
						$('#span-message').addClass('text-danger');
						return false;
					}
					// if success
					if (result.status === 'success') {
						$('#span-message').removeAttr('class');
						$('#span-message').text(result.message);
						$('#span-message').addClass('text-success');
						let discountValue = result.data.discount;
						let discountType = result.data.type;
						applyPromoCalculation("#btn-promocode", "custom", {
							'type': discountType,
							'discount': discountValue
						});
						$('#promo_code_id').val(result.data.id);
					}
				}
			});
		});
		$(document).on("click", "#btn-promocode-sub", function(e) {

			e.preventDefault();

			let promoCode = $("#promo_code_sub").val();

			$.ajax({
				url: '{{ URL::to("admin/getPromoCode") }}',
				type: 'POST',
				data: {
					promo_code: promoCode,
				},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				error: function() {
					alert("error");
				},
				success: function(result) {
					if (result.status === 'error') {
						$('#promo_code_id').val('');
						applyPromoCalculation("#btn-promocode-sub", "subscription", {});
						$('#span-message-sub').removeAttr('class');
						$('#span-message-sub').text(result.message);
						$('#span-message-sub').addClass('text-danger');
						return false;
					}
					if (result.status === 'success') {
						$('#span-message-sub').removeAttr('class');
						$('#span-message-sub').text(result.message);
						$('#span-message-sub').addClass('text-success');
						let discountValue = result.data.discount;
						let discountType = result.data.type;
						applyPromoCalculation("#btn-promocode-sub", "subscription", {
							'type': discountType,
							'discount': discountValue
						});
						$('#promo_code_id').val(result.data.id);
					}
				}
			});
		});

		$(document).on("click", "#btn-promocode-dis", function(e) {

			e.preventDefault();

			let promoCode = $("#promo_code_dis").val();

			$.ajax({
				url: '{{ URL::to("admin/getPromoCode") }}',
				type: 'POST',
				data: {
					promo_code: promoCode,
				},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				error: function() {
					alert("error");
				},
				success: function(result) {
					if (result.status === 'error') {
						$('#promo_code_id').val('');
						applyPromoCalculation("#btn-promocode-dis", "download", {});
						$('#span-message-dis').removeAttr('class');
						$('#span-message-dis').text(result.message);
						$('#span-message-dis').addClass('text-danger');
						return false;
					}
					if (result.status === 'success') {
						$('#span-message-dis').removeAttr('class');
						$('#span-message-dis').text(result.message);
						$('#span-message-dis').addClass('text-success');
						let discountValue = result.data.discount;
						let discountType = result.data.type;
						applyPromoCalculation("#btn-promocode-dis", "download", {
							'type': discountType,
							'discount': discountValue
						});
						$('#promo_code_id').val(result.data.id);
					}
				}
			});
		});

	});

	function getcity(data) {
		console.log(data.value);
		$.ajax({
			url: '{{ URL::to("admin/getCityByState") }}',
			data: {
				state_code: data.value,
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			error: function() {
				//$('#info').html('<p>An error has occurred</p>');
			},
			success: function(data) {
				console.log(data);
				if (data.response == 'success') {
					var option = '<option value="">Please Select</option>';
					$.each(data.data, function(i, val) {
						option = option + '<option value="' + val.id + '">' + val.name + '</option>';
					});
					$('#bill_city').html(option);
				}

			},
			type: 'POST'
		});
	}
	$(document).ready(function($) {
		$('.licence_type').each(function() {
			CKEDITOR.replace($(this).prop('id'));
		});
        $("#licence_dropdown").change(function() {
        var type = $(this).val();
        if(type == ''){
            $('#extra_details').hide()
        }else{
            $('#extra_details').show()
        }
      })
	});
</script>

@stop
