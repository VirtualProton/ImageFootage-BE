@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper" ng-controller="editquotatationController">
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><%title%></h3><a href="{{ url('admin/users/invoices', $userDetail->id) }}" class="btn pull-right">Back</a>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
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
													<input type="radio" value="custom" name="quotation_type" checked="checked" ng-click="quotation_type_set('custom')">
													Custom
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="">
								<div class="row">
									<div class="col-sm-12">
										<div class="col-lg-6 col-md-4 col-xs-4 repeated-dv " ng-repeat="product in quotation.product">
											<div class="form-group">
												<label class="">Product Type <%$index+1%> (Image/Footage/Music)</label>
												<select required="" class="form-control" ng-model="product.type" ng-change="checkProduct(product)">
													<option value="">--Select a Type--</option>
													<option value="Image">Image</option>
													<option value="Footage">Footage</option>
													<option value="Music">Music</option>
												</select>
												<div>
												</div>
											</div>
											<div class="form-group">
												<label class=""><%product.type%> <%$index+1%> (Product ID)</label>
												<input type="hidden" class="form-control" ng-model="product.id">
												<input ng-if="product.type=='Footage' || product.type=='Image'" type="text" class="form-control" ng-model="product.name" name="product_name" id="product_1" required="" ng-blur="getproduct(product)">
												<input ng-if="product.type=='Music'" type="text" class="form-control" ng-model="product.name" name="product_name" id="product_1" required="">
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
											<div class="form-group" ng-show="product.type!='Music'">
												<label for="sub_total"><%product.type%> Size</label>
												<select class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Image'">
													<option value="">--Select a size--</option>
													<option value="Small">Web</option>
													<option value="Medium">Medium</option>
													<option value="X-Large">XX-Large</option>
												</select>
												<select class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)" ng-show="product.type=='Footage'">
													<option value="">--Select a size--</option>
													@foreach ($getFootageSizeDetails as $getFootageSizeDetail)
													<option value="{{ $getFootageSizeDetail['type'] }}">{{ $getFootageSizeDetail['type'] }}</option>
													@endforeach
													<!-- <option ng-repeat="price in prices[$index]" value="<%price.size%>"><%price.size%></option> -->
												</select>
											</div>
											<div class="form-group" ng-if="product.type=='Image'">
												<label for="pro_type"><%product.type%> type</label>
												<select required="" class="form-control" ng-model="product.pro_type">
													<option value="">--Select a Type--</option>
													<option value="royalty_free">Royalty Free</option>
												</select>
											</div>
											<div class="form-group" ng-show="((product.type=='Image' && product.pro_type=='royalty_free') || product.type=='Music')">
												<label for="pro_type"><%product.type%> Licence type</label>
												<select required="" class="form-control" ng-model="product.licence_type" ng-change="getThetotalAmount(product)" ng-if="product.type=='Music'">
													<option value="">--Select a Licence Type--</option>
													@foreach ($getMusicLicenceDetails as $getMusicLicenceDetail)
													<option value="{{ $getMusicLicenceDetail['value'] }}">{{ $getMusicLicenceDetail['licence_type'] }}</option>
													@endforeach
												</select>
												<select required="" class="form-control" ng-model="product.licence_type" ng-if="product.type=='Image'">
													<option value="">--Select a Licence Type--</option>
													@foreach ($getMusicLicenceDetails as $getMusicLicenceDetail)
													<option value="{{ $getMusicLicenceDetail['value'] }}">{{ $getMusicLicenceDetail['licence_type'] }}</option>
													@endforeach
												</select>
											</div>

											<!-- <div class="form-group" ng-if="product.type=='Image'">
												<label for="licence_type"><%product.type%> Licence type</label>
												<textarea class="form-control licence_type" id="licence_type-<%$index+1%>" ng-model="product.licence_type"></textarea>
											</div> -->
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
														<input type="checkbox" ng-model="is_gst_applied" ng-change="checkThetax(GST,'GST');" name="tax_checkbox[]">&nbsp;&nbsp; GST- +{{ config('constants.GST_VALUE').'%' }}
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
												<input type="text" class="form-control" name="promoCode" ng-model="promoCode" id="promo_code">
												<span id="span-message"></span>
											</div>
											<button class="btn btn-primary" type="button" id="btn-promocode">Apply Promo Code</button>
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
												<input type="hidden" class="form-control" id="email_id" name="email_id" ng-model="email" value="{{$userDetail->email}}">
												<label for="expiry">Expiry Period</label><br>
												<input type="radio" ng-value="7" name="expiry" ng-model="expiry_time">&nbsp;&nbsp;7 Days &nbsp;&nbsp;
												<input type="radio" ng-value="30" name="expiry" ng-model="expiry_time">&nbsp;&nbsp;30 Days
											</div>
											<!-- </div>
										</div>
										<div class="col-lg-4 col-md-6 col-xs-4"></div> -->
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

		// Example Validataion Standard Mode
		// ---------------------------------
		(function() {

			var i = 1;

			$('#adminform').formValidation({
				framework: "bootstrap",
				button: {
					selector: '#validateButton2',
					disabled: 'disabled'
				},
				icon: null,
				fields: {
					account_name: {
						validators: {
							notEmpty: {
								message: 'Account Name is required'
							}
						}
					},

					email: {
						validators: {
							notEmpty: {
								message: 'The email address is required and cannot be empty'
							},
							emailAddress: {
								message: 'The email address is not valid'
							}
						}
					},

					phone: {
						validators: {
							notEmpty: {
								message: 'The phone number is required and cannot be empty'
							},
							digits: {
								message: 'Please enter only digits'
							},
							stringLength: {
								min: 10,
								max: 10,
								message: 'Mobile number length should be 10 digits'
							}
						}
					},
					website: {
						validators: {
							uri: {
								message: 'Please enter valid URL.'
							}
						}
					},
					bill_country: {
						validators: {
							notEmpty: {
								message: 'Billing country is required'
							}
						}
					},
					bill_state: {
						validators: {
							notEmpty: {
								message: 'Billing state is required'
							}
						}
					},
					bill_city: {
						validators: {
							notEmpty: {
								message: 'Billing city is required'
							}
						}
					},
					bill_address: {
						validators: {
							notEmpty: {
								message: 'Address is required'
							}
						}
					},
					bill_postal: {
						validators: {
							notEmpty: {
								message: 'Bill postal is required'
							},
							digits: {
								message: 'Please enter only digits'
							},
						}
					},
					industry_type_id: {
						validators: {
							notEmpty: {
								message: 'Industry Type is required'
							}
						}
					},
					curruncy_id: {
						validators: {
							notEmpty: {
								message: 'Curruncy is required'
							}
						}
					},
					global_region: {
						validators: {
							notEmpty: {
								message: 'Global region is required'
							}
						}
					},

				}
			});
		})();

		$('#btn-promocode').hide();
		$('#promo_code').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('#btn-promocode').show()
			else {
				$('#btn-promocode').hide()
				let gsttax = angular.element($("#btn-promocode")).scope().tax;
				let isGST = gsttax > 0 ? true : false;
				angular.element($("#btn-promocode")).scope().checkThetax(isGST, 'GST');
				angular.element('#btn-promocode').scope().$apply();
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
						});
						angular.element('#btn-promocode').scope().$apply();
						$('#promo_code_id').val(result.data.id);
					}
				}
			});
		});

	});

	// function getproduct(data){
	//    $.ajax({
	//             url: '{{ URL::to("admin/product") }}'+'/'+data.value,
	//             headers: {
	//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	//             },
	//             error: function() {
	//             //$('#info').html('<p>An error has occurred</p>');
	//             },
	//             success: function(response) {
	//                console.log(response);
	//            },
	//             type: 'GET'
	//             });
	// }
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
	// $(function() {
	// 	$("#poDate").datepicker();
	// 	setTimeout(function() {
	// 		$('.licence_type').each(function() {
	// 			CKEDITOR.replace($(this).prop('id'));
	// 		});
	// 	});
	// });
</script>

@stop