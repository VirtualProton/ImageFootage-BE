@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper" ng-controller="editquotatationController">
<section class="content">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><%title%></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                @include('admin.partials.message')

              <div class="box-body">
               
              <div class="panel-body">
						<form role="form" name="downloadOnBehalf" method="post"  class="" enctype="multipart/form-data" ng-submit="submitQuotation()">
						<div class="row">
							<div class="col-sm-6">
									<div class="">
										<div class="form-group">
											<label>UID</label>
											<input type="text" name="uid" id="uid" ng-model="uid" class="form-control"   readonly >
										</div>
									</div>

									<!-- /.col-lg-6 (nested) -->
																		<!-- /.col-lg-6 (nested) -->
									<div class="">
										<div class="form-group">
											
											<label class="margin-right">
												<input type="radio"  ng-value="1"  name="quotation_type" ng-model="quotation_type">
												Subscription 
											  </label>
											  <label class="margin-right">
												<input type="radio"  ng-value="2" name="quotation_type" ng-model="quotation_type">
												Download Packs
											  </label>
											  <label class="margin-right">
											  <input type="radio"  ng-value="3"  name="quotation_type"  ng-model="quotation_type">
												Custom
											  </label>
											
										</div>
									</div>
									</div>
						<div class="col-lg-6 col-md-6 col-xs-6 text-right">	
						<!--ng-click="uploadImageInCrm();"-->
								
								
						</div>
						
									<!-- /.col-lg-6 (nested) -->
									
						<!-- ngIf: vm.formData.type=='custom' --><div  class="">		
				<div class="row">					
				<div class="col-sm-12">					
						<!-- ngRepeat: name in vm.formData.names track by $index -->
						<div class="col-lg-6 col-md-4 col-xs-4 repeated-dv " ng-repeat="product in quotation.product">
								
								<div class="form-group">
									
								<label class="">Image <%$index+1%></label>
								<input type="hidden" class="form-control" ng-model="product.id">
								<input type="text" class="form-control" ng-model="product.name" name="product_name" id="product_1" required="" ng-blur="getproduct(product)" >
								
								<div>
								
								</div>
								</div>
								<div class="form-group">
									<span ng-show="product.image"><img src="<%product.image%>" width="150" /></span>
									<span ng-show="!product.thumbnail_image"> <input class="form-control" type="file" name="file<%$index+1%>" id="file<%$index+1%>" style="position:inherit;top:0;left:0;z-index:2;opacity:1;cursor:pointer;"></span>
								</div>
								<div class="form-group">
									
									<label for="sub_total">Image Size</label>
									<select  required=""  class="form-control" ng-model="product.pro_size" ng-change="getThetotalAmount(product)">
										<option value="" selected="">--Select a size--</option>
										<option value="Small">Small</option>
										<option value="Medium">Medium</option>
										<option value="Large">Large</option>
										<option value="X-Large">X-Large</option>
										<option value="Custom">Custom</option>
									</select>
									
								</div>
								<div class="form-group">
									
									<label for="pro_type">Image type</label>
									<select  required="" class="form-control" ng-model="product.pro_type">
										<option value="">--Select a Type--</option>
										<option value="right_managed">Right Managed</option>
										<option value="royalty_free">Royality Free</option>
										
									</select>
									
								</div>
								
							<!-- start main div for the oriduct id --->	
					<div>
						
					<div ng-show="product.price">
								<div class="form-group">
								 <label for="sub_total">Sub Total</label>
								<input type="text" class="form-control" ng-model="product.price" name="price" required ng-keyup="getTheTotal(product);" ngMousedown="getTheTotal(product);" >
					</div>	

						</div>	
					</div>
								
					<label><button type="button" class="btn btn-danger"  ng-click="removeProduct(product)" ng-show="$last">Delete Image</button> </label>
					&nbsp;
					<label  class="">
				
					
					<button  type="button" class="btn btn-danger"  ng-click="addProduct()" ng-show="$last">Add More Image</button> </label>
			
			</div><!-- end ngRepeat: name in vm.formData.names track by $index -->
	
				</div>				
<!--Main div for the type of products-->	
				</div>
			
				<div class="col-lg-6 col-md-6 col-xs-6">				
								<div class="form-group">
								 <label for="promoCode">Promo code</label>
							
								<input type="text" class="form-control"  name="promoCode" ng-model="promoCode">

							
								</div>		
								<div class="form-group">
								 <label for="tax">Tax Applicable</label>
								 
								 
								<!-- ngRepeat: tax in vm.formData.taxes track by $index --><div>
							
							
								<input type="checkbox" ng-model="SGST" ng-change="checkThetax(SGST,'SGST');" name="tax_checkbox[]" ng-checked="SGST==1"> SGST- +6%
								</div><!-- end ngRepeat: tax in vm.formData.taxes track by $index --><div  class="ng-binding ng-scope">
							
							
								<input type="checkbox" ng-model="CGST" ng-change="checkThetax(CGST,'CGST');" name="tax_checkbox[]" ng-checked="CGST==1"> CGST- +6%
								</div><!-- end ngRepeat: tax in vm.formData.taxes track by $index --><div  class="ng-binding ng-scope">
							
							
								<input type="checkbox" ng-model="IGST"  ng-change="checkThetax(IGST,'IGST');" name="tax_checkbox[]" ng-checked="IGST==1"> IGST- +12%
								</div><!-- end ngRepeat: tax in vm.formData.taxes track by $index --><div  class="ng-binding ng-scope">
							
							
								<input type="checkbox"  ng-model="IGSTT" ng-change="checkThetax(IGSTT,'IGSTT');" name="tax_checkbox[]" ng-checked="IGSTT==1"> IGST- +18%
								</div><!-- end ngRepeat: tax in vm.formData.taxes track by $index -->
								
								<input type="text" ng-model="tax" class="form-control " name="tax" readonly="">
							
								</div>	

								<div class="form-group">
								 <label for="Total">Total</label>
						
								<input type="text" class="form-control " ng-model="total" name="Total" readonly="">

							
								</div>
						</div>
				
					
					
						<div class="col-lg-6 col-md-6 col-xs-6">
							<div class="form-group">
							 <label for="job_number">JOb Ref/Po #</label>
					
							<!--<input type="text" class="form-control" ng-model="vm.formData.job_number" name="job_number" >-->
							<select  class="form-control" required=""  ng-model="po">
								<option value="">--Select a Job PO--</option>
								<!-- <option value="upload_po">Upload PO</option>
								<option value="email_approval">Email Approval</option> -->
								<option value="po_in_3days">PO Due In 3 Days</option>
								<option value="po_in_7days">PO Due In 7 Days</option>
								<option value="po_in_15days">PO Due In 15 Days</option>
								</select>
							</div>
							
						<!-- ngIf: vm.formData.job_number --><div class="">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-xs-12">
								<!-- ngIf: vm.formData.job_number=='upload_po' --><div class="form-group" >
									<label for="po_no">PO No.</label>
									<input type="text" class="form-control"  name="poDate" id="poDate" ng-model="poDate">
									
									
								</div><!-- end ngIf: vm.formData.job_number=='upload_po' -->
					
								
								
								<!-- ngIf: vm.formData.job_number!='upload_po' -->
							</div>
							
							<div class="col-lg-6 col-md-6 col-xs-12">
								<!-- ngIf: (vm.formData.job_number=='email_approval' || vm.formData.job_number=='upload_po') --><div class="form-group" >
									<!-- <label for="upload_imge">Upload File</label> ngIf: imagedatafound -->
									
									 <!-- <input class="form-control" type="file" id="file" name="file" style="position:inherit;top:0;left:0;z-index:2;opacity:1;cursor:pointer;"> -->
								</div><!-- end ngIf: (vm.formData.job_number=='email_approval' || vm.formData.job_number=='upload_po') -->
							</div>
							
							</div>
						</div><!-- end ngIf: vm.formData.job_number -->
					
										
					
						<div class="form-group">
							 <label for="email_id">Email</label>
					
					  <input type="email" class="form-control" id="email_id" name="email_id" ng-model="email" >
				</div>	
							<div class="form-group">
										
											<label for="expiry">Expiry Period</label><br>
											<input type="radio"  ng-value="7" name="expiry" ng-model="expiry_time">7 Days
											<input type="radio"  ng-value="30" name="expiry" ng-model="expiry_time">30 Days
										
									</div> 
						</div>
						
						<div class="col-lg-4 col-md-6 col-xs-4">
						
										
									
						</div>
						
					<!--	<div class="col-lg-4 col-md-6 col-xs-4" ng-if="vm.formData.mode">
							<div class="form-group">
							 <label for="email_id">Address 1</label>
					
							<input type="text" class="form-control" ng-model="vm.formData.address" name="address" >

						
							</div>
							<div class="form-group">
							 <label for="email_id">Address 2</label>
					
							<input type="text" class="form-control" ng-model="vm.formData.address1" name="address1" >

						
							</div>
							<country-with-states-with-cites ></country-with-states-with-cites>		
							<div class="form-group">
								<label>Zipcode</label>
								<input class="form-control" placeholder="Please Enter Zipcode" name="zipcode" ng-model="vm.formData.zipcode">
							</div>	
						</div>-->
						</div><!-- end ngIf: vm.formData.type=='custom' -->
														
							</div>
							<!-- /.row (nested) -->
							
							<div class="row">
								<div class="col-lg-12 col-md-12 col-xs-12" align="center">
									<button type="submit" class="btn btn-danger ng-binding">Submit</button>
									<button type="reset" class="btn btn-danger">Reset</button>
								</div>
							</div>
						</form>
						<!--form ended-->
					</div>
              </div>
             
</div>
              <!-- /.box-body -->
              

    </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @endsection
    @section('scripts')
<script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script>

$(document).ready(function ($) {

   // Example Validataion Standard Mode
    // ---------------------------------
    (function () {

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
                stringLength:{
                    min:10,
                    max:10,
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
function getcity(data){
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
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#bill_city').html(option);
               }

            },
            type: 'POST'
            });
}
$( function() {
    $( "#poDate" ).datepicker();
  } );
</script>

@stop
