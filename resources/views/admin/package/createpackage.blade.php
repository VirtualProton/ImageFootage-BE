@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Package
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Package</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Create Package</h3><a href="{{ URL::to('admin/package_list') }}" class="btn pull-right">Back</a>
                </div>
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                <form action="{{ url('admin/addpackage') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Package-Plan Type </label>
                      <select class="form-control" name="package_plan" id="package_plan">
                      <option value="1">Download Pack</option>
                      <option value="2">Subscription</option>
                      </select>
                       @if ($errors->has('package_plan'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_plan') }}</div>
                       @endif
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">HD/4K </label>
                      <select class="form-control" name="pacage_size" id="pacage_size">
                      <option value="1">HD</option>
                      <option value="2">4K</option>
                      </select>
                       @if ($errors->has('pacage_size'))
                          <div class="has_error" style="color:red;">{{ $errors->first('pacage_size') }}</div>
                       @endif
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail1">Package Name </label>
                      <input type="text" class="form-control" name="package_name" id="package_name" placeholder="Package name">
                       @if ($errors->has('package_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_name') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Price</label>
                      <input type="text" class="form-control" name="package_price" id="package_price" placeholder="Package Price">
                    </div>
                    @if ($errors->has('package_price'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_price') }}</div>
                    @endif
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Description</label>
                       <textarea type="text" class="form-control" name="package_description" id="package_description" placeholder="Package Description"></textarea>
                         @if ($errors->has('package_description'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_description') }}</div>
                         @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Package Products Count</label>
                      <input type="text" class="form-control" name="package_products_count" id="package_products_count" placeholder="Package Products Count">
                    </div>
                     @if ($errors->has('package_products_count'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_products_count') }}</div>
                     @endif
                     <div id="for_pro" style="display:none;">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Per Month Download</label>
                      <input type="text" class="form-control" name="package_month_count" id="package_month_count" placeholder="Products per month Count">
                    </div>
                     @if ($errors->has('package_month_count'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_month_count') }}</div>
                     @endif
                     <div class="form-group">
                      <label for="exampleInputEmail1">Products Carry Forward <input type="checkbox" name="products_carry_forward" id="products_carry_forward" value="yes" /> </label>
                      
                     </div>
                     </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Package Type</label>
                      <select type="text" class="form-control" name="package_type" id="package_type" >
                      	<option value="Image">Image</option>
                        <option value="Footage">Footage</option>
                        <option value="Music">Music</option>
                      </select>
                    </div>
                     @if ($errors->has('package_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_type') }}</div>
                     @endif
                     <div class="form-group" id="footageTierDiv">
                      <label for="exampleInputEmail1">Licence Type</label>
                      <select type="text" class="form-control" name="footage_tier" id="footage_tier" >
                        <option value="">Select</option>
                        <option value="1">Commercial</option>
                        <option value="2">Media Non-commercial (Editorial)</option>
                        <option value="3">Digital</option>
                      	<option value="4">Full RF Licence</option>
                      </select>
                    </div>
                     @if ($errors->has('footage_tier'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('footage_tier') }}</div>
                     @endif
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Expiry in Months</label>
                      <input type="text" class="form-control" name="package_expiry" id="package_expiry" placeholder="Package Expiry in Months">
                    </div>
                    @if ($errors->has('package_expiry'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_expiry') }}</div>
                    @endif
                    <div class="form-group" id="div_quarterly">
                      <label for="exampleInputPassword1">Package Expiry in Quarterly</label>
                      <input type="text" class="form-control" name="package_expiry_quarterly" id="package_expiry_quarterly" placeholder="Package Expiry in Quarterly">
                    </div>
                    @if ($errors->has('package_expiry_quarterly'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_expiry_quarterly') }}</div>
                    @endif
                    <div class="form-group" id="div_half_yearly">
                      <label for="exampleInputPassword1">Package Expiry in Half Year</label>
                      <input type="text" class="form-control" name="package_expiry_half_yearly" id="package_expiry_half_yearly" placeholder="Package Expiry in Half Year">
                    </div>
                    @if ($errors->has('package_expiry_half_yearly'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_expiry_half_yearly') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Expiry Per Year</label>
                      <input type="text" class="form-control" name="package_expiry_year" id="package_expiry_year" placeholder="Package Expiry Per Year">
                    </div>
                    @if ($errors->has('package_expiry_year'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_expiry_year') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="display_for">Display For</label>
                      <select class="form-control" name="display_for" id="display_for" >
                        <option value="3">All</option>
                      	<option value="1">Frontend</option>
                        <option value="2">Backend</option>
                      </select>
                    </div>
                     @if ($errors->has('display_for'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('display_for') }}</div>
                     @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select class="form-control" name="package_status">
                          <option value="Active" {{ old('package_status') == 'Active' ? 'selected' : '' }}>Active</option>
                          <option value="Inactive" {{ old('package_status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                      @if($errors->has('package_status'))
                      <div class="has_error" style="color:red;">{{ $errors->first('package_status') }}</div>
                      @endif
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
                    <a href="{{ url('admin/package_list') }}" class="btn btn-primary">Back</a>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @section('scripts')
  <script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
  <script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
  <script>
 //sub_product_type
 $('.product_type').click(function(){
 	if($(this).is(":checked")){
               var ptype=$(this).val();
			   if(ptype == 'Image' || ptype == 'Editorial' ){
				   $("#sub_product_type").css("display","block");
			   }else{
				   $("#sub_product_type").css("display","none");
			   }
    }
 });
 $("#product_category").on('change',function(){
	var prod_id=$(this).val();
	var csrf='{{ csrf_token() }}';
	$.ajax({
			url: '{{ url("admin/get_related_subcat") }}',
			type: 'POST',
			data: {'prod_id':prod_id,'_token':csrf},
			success:function(data){
				$("#product_sub_category").html('');
				$("#product_sub_category").html(data);
			}
		});
 });
  </script>
  <script>

$(document).ready(function ($) {

   // Example Validataion Standard Mode
    // ---------------------------------
    (function () {

        var i = 1;

        $('#productform').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#validateButton2',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                package_name: {
                    validators: {
                        notEmpty: {
                            message: 'Package name is required'
                        }
                    }
                },
                package_price: {
                    validators: {
                        notEmpty: {
                            message: 'Package price is required'
                        }
                    }
                },
                package_description: {
                    validators: {
                        notEmpty: {
                            message: 'Package description is required'
                        }
                    }
                },
                package_products_count: {
                 validators: {
                notEmpty: {
                  message: 'Package products count is required'
                },
                numeric: {
                  message: 'The value is not an integer'
                }
              }
            },
            package_type: {
              validators: {
               stringLength: {
                  message: 'Package type is required'
                }
              }
            },
            package_expiry: {
              validators: {
                notEmpty: {
                  message: 'Package expiry in months is required'
                },
                numeric: {
                  message: 'The value is not an integer'
                }
              }
             },
             package_expiry_quarterly: {
              validators: {
                notEmpty: {
                  message: 'Package expiry in quarterly is required'
                },
                numeric: {
                  message: 'The value is not an integer'
                }
              }
             },
             package_expiry_half_yearly: {
              validators: {
                notEmpty: {
                  message: 'Package expiry in half year is required'
                },
                numeric: {
                  message: 'The value is not an integer'
                }
              }
             },
             package_expiry_year: {
              validators: {
                notEmpty: {
                  message: 'Package expiry per year is required'
                },
                numeric: {
                  message: 'The value is not an integer'
                }
              }
             },
             display_for: {
              validators: {
               stringLength: {
                  message: 'Display for is required'
                }
              }
            },
            }
        });
    })();

    $('#div_quarterly').hide();
    $('#div_half_yearly').hide();
    $("#footageTierDiv").hide();

});
$("#package_plan").change(function(){
	var pack_type=$(this).val();
	if(pack_type =='1'){
		$("#package_month_count").val("");
		$('#for_pro').css('display','none');
    $('#div_quarterly').hide();
    $('#div_half_yearly').hide();
	}else{
    $('#for_pro').css('display','block');
    $('#div_quarterly').show();
    $('#div_half_yearly').show();
	}
	
});
$("#package_type").change(function(){
	var pack_type=$(this).val();
	if(pack_type =='Footage'){
    $("#footageTierDiv").show();
  } else {
    $("#footageTierDiv").hide();
  }
});
</script>
  @endsection
  
