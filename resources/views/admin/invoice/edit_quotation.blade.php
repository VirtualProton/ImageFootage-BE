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
													<button type="button" class="btn btn-danger" ng-click="getPlans()">Get Plan</button>
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
												<input ng-if="product.type=='Footage' || product.type=='Image'" type="text" class="form-control" ng-model="product.name" name="product_name" id="product_1" ng-change="getproduct(product)">
												<input ng-if="product.type=='Music'" type="text" class="form-control" ng-model="product.name" name="product_name" id="product_1">
												<div>
												</div>
											</div>
											<div class="form-group" ng-show="product.type=='Image'">
												<span ng-show="product.image"><img src="<%product.image%>" width="150" height="150" /></span>
												<span ng-show="!product.thumbnail_image"> <input class="form-control" type="file" name="file<%$index+1%>" ng-model="product.image" id="file<%$index+1%>" style="position:inherit;top:0;left:0;z-index:2;opacity:1;cursor:pointer;" ng-file-select="onFileSelect($files)"></span>
											</div>
											<div class="form-group" ng-show="product.type =='Footage'">
												<span ng-show="product.image">
													<video class="for_mobile" controls="" width="300px" controlslist="nodownload" onmouseout="this.load()" onmouseover="this.play()" poster="<%product.image%>">
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
                                            <div class="form-group" ng-show="(product.type=='Image' || product.type=='Music') && product.pro_type=='royalty_free' && product.licence_type !='' && flag ==2">
                                                <label for="licence_type"></label>
                                                <input type="text" class="form-control" ng-model="product.extra_details" id="extra_details"/>
                                             </div>
											<div ng-if="product.type">
												<div>
													<div class="form-group">
														<label for="sub_total">Sub Total</label>
														<input type="text" class="form-control" ng-model="product.price" name="price" ng-keyup="getTheTotal();" ngMousedown="getTheTotal();">
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
														<input type="checkbox" ng-model="is_gst_applied" ng-change="checkThetax(GST,'GST',{},{{$userDetail->country}});" name="tax_checkbox[]">&nbsp;&nbsp; GST- +{{ config('constants.GST_VALUE').'%' }}
													</span>
													<span style="float: left;padding-left:20px;">
														<input type="text" ng-model="tax" class="form-control" style="width:150px;" name="tax" readonly="">
													</span>
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
											</div>
											<button class="btn btn-primary" type="button" id="btn-promocode">Apply Promo Code</button>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<input type="hidden" class="form-control" id="email_id" name="email_id" ng-model="email" value="{{$userDetail->email}}">
												<input type="hidden" class="form-control" id="flag" name="flag" ng-model="flag" value="1">
												<label for="expiry">Expiry Period</label><br>
												<input type="radio" ng-value="7" name="expiry" ng-model="expiry_time">&nbsp;&nbsp;7 Days &nbsp;&nbsp;
												<input type="radio" ng-value="30" name="expiry" ng-model="expiry_time">&nbsp;&nbsp;30 Days
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
												<label for="sub_total">Plan Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a plan--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%></option>
												</select>
											</div>
											<div class="form-group" ng-if="plan_type == 'quarterly'">
												<label for="sub_total">Plan Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a plan--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%></option>
												</select>
											</div>
											<div class="form-group" ng-if="plan_type == 'half_yearly'">
												<label for="sub_total">Plan Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a plan--</option>
													<option ng-value="<%plan.package_id%>" ng-selected="selected_sub_plan == plan.package_id" ng-repeat="plan in plansData"><%plan.package_description%></option>
												</select>
											</div>
											<div class="form-group" ng-if="plan_type == 'annual'">
												<label for="sub_total">Plan Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'subscription')">
													<option ng-value="">--Select a plan--</option>
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
														<input type="text" ng-model="subsc_tax" class="form-control" style="width:150px;" name="subsc_tax" readonly="">
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
											</div>
											<button class="btn btn-primary" type="button" id="btn-promocode-sub">Apply Promo Code</button>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<input type="hidden" class="form-control" id="subsc_email_id" name="subsc_email_id" ng-model="subsc_email_id" value="{{$userDetail->email}}">
												<label for="expiry">Expiry Period</label><br>
												<input type="radio" ng-value="7" name="subsc_expiry" ng-model="subsc_expiry_time">&nbsp;&nbsp;7 Days &nbsp;&nbsp;
												<input type="radio" ng-value="30" name="subsc_expiry" ng-model="subsc_expiry_time">&nbsp;&nbsp;30 Days
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
												<label for="sub_total">Plan Name</label>
												<select id="myDropdown" class="form-control" ng-model="selected_sub_plan" ng-change="selectPlanfromlist(selected_sub_plan, 'download')">
													<option ng-value="">--Select a plan--</option>
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
												<label for="tax">Tax Applicable</label>
												<div>
													<span style="float: left;">
														<input type="checkbox" ng-model="GSTD" ng-checked="true" ng-change="checkDownloadtax(GSTD,'GST',{{$userDetail->country ?? 0}});" name="tax_checkbox_download[]">&nbsp;&nbsp; GST- +{{ config('constants.GST_VALUE').'%' }}
													</span>
													<span style="float: left;padding-left:20px;">
														<input type="text" ng-model="taxdownload" class="form-control" style="width:150px;" name="taxdownload" readonly="">
													</span>
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
											</div>
											<button class="btn btn-primary" type="button" id="btn-promocode-dis">Apply Promo Code</button>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-6">
											<div class="form-group">
												<input type="hidden" class="form-control" id="download_email_id" name="download_email_id" value="{{$userDetail->email}}">
												<label for="expiry">Expiry Period</label><br>
												<input type="radio" ng-value="7" name="download_expiry" ng-model="download_expiry">&nbsp;&nbsp;7 Days &nbsp;&nbsp;
												<input type="radio" ng-value="30" name="download_expiry" ng-model="download_expiry">&nbsp;&nbsp;30 Days
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
		$('#promo_code').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('#btn-promocode').show()
			else {
				$('#btn-promocode').hide()
				let gsttax = angular.element($("#btn-promocode")).scope().tax;
				let isGST = gsttax > 0 ? true : false;
				angular.element($("#btn-promocode")).scope().checkThetax(isGST, 'GST',{},countryId);
				angular.element('#btn-promocode').scope().$apply();
			}
		});
		$('#promo_code_sub').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('#btn-promocode-sub').show()
			else {
				$('#btn-promocode-sub').hide()
			}
		});
		$('#promo_code_dis').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('#btn-promocode-dis').show()
			else {
				$('#btn-promocode-dis').hide()
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
						let gsttax = angular.element($("#btn-promocode")).scope().tax;
						let isGST = gsttax > 0 ? true : false;
						angular.element($("#btn-promocode")).scope().checkThetax(isGST, 'GST', {
							'type': discountType,
							'discount': discountValue
						},countryId);
						angular.element('#btn-promocode').scope().$apply();
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
						let gsttax = angular.element($("#btn-promocode-sub")).scope().tax;
						let isGST = gsttax > 0 ? true : false;
						angular.element($("#btn-promocode-sub")).scope().checkTheSubtax(isGST, 'GST', {
							'type': discountType,
							'discount': discountValue
						},countryId);
						angular.element('#btn-promocode-sub').scope().$apply();
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
						let gsttax = angular.element($("#btn-promocode-dis")).scope().tax;
						let isGST = gsttax > 0 ? true : false;
						angular.element($("#btn-promocode-dis")).scope().checkTheDistax(isGST, 'GST', {
							'type': discountType,
							'discount': discountValue
						},countryId);
						angular.element('#btn-promocode-dis').scope().$apply();
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
