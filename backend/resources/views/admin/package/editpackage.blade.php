@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Package
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Package</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Package</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/editpackage') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
                <input type="hidden" class="form-control" name="package_id" id="package_id"  value="{{ $package[0]['package_id'] }}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Package Name </label>
                      <input type="text" class="form-control" name="package_name" id="package_name" placeholder="Package name" value="{{ $package[0]['package_name'] }}">
                       @if ($errors->has('package_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_name') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Price</label>
                      <input type="text" class="form-control" name="package_price" id="package_price" placeholder="Package Price" value="{{ $package[0]['package_price'] }}">
                    </div>
                    @if ($errors->has('package_price'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_price') }}</div>
                    @endif
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Description</label>
                       <textarea type="text" class="form-control" name="package_description" id="package_description" placeholder="Package Description">{{ $package[0]['package_description'] }}</textarea>
                         @if ($errors->has('package_description'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_description') }}</div>
                         @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Package Products Count</label>
                      <input type="text" class="form-control" name="package_products_count" id="package_products_count" placeholder="Package Products Count" value="{{ $package[0]['package_products_count'] }}">
                    </div>
                     @if ($errors->has('package_products_count'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_products_count') }}</div>
                     @endif
                     <div class="form-group">
                      <label for="exampleInputEmail1">Package Type</label>
                      <select type="text" class="form-control" name="package_type" id="package_type" >
                      	<option value="Image" @if($package[0]['package_type']=='Image') selected="selected" @endif >Image</option>
                        <option value="Footage" @if($package[0]['package_type']=='Footage') selected="selected" @endif >Footage</option>
                      </select>
                    </div>
                     @if ($errors->has('package_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_type') }}</div>
                     @endif
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Expiry in Months</label>
                      <input type="text" class="form-control" name="package_expiry" id="package_expiry" placeholder="Package Expiry in Months" value="{{ $package[0]['package_expiry'] }}">
                    </div>
                    @if ($errors->has('package_expiry'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('package_expiry') }}</div>
                    @endif
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Save</button>
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
                }
              }
             }
            }
        });
    })();

});
</script>
  @endsection
  
