@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Product Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Product Category</h3><a href="{{ URL::to('admin/all_product_category') }}" class="btn pull-right">Back</a>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/editproductcategory') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="product_category_id" value="{{ $productcategory['category_id'] }}">
                  <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Category Name </label>
                      <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name" value="{{ $productcategory['category_name'] }}">
                       @if ($errors->has('category_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('category_name') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                     <label for="exampleInputEmail1">Category Display Order </label>
                      <input type="text" class="form-control" name="category_order" id="category_order" placeholder="Category Display Order" value="{{ $productcategory['category_order'] }}">
                       @if ($errors->has('category_order'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('category_order') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Keywords</label>
                      <input type="text" class="form-control" name="category_keywords" id="category_keywords" placeholder="Category Keywords" value="{{ $productcategory['category_keywords'] }}">
                       @if ($errors->has('category_keywords'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('category_keywords') }}</div>
                       @endif
                    </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Is Display On Home </label>
                          <input type="radio"  name="display"  value="1" <?php if($productcategory['is_display_home']=='1'){ echo "checked";} ?> /> Yes
                          <input type="radio"  name="display"  value="0" <?php if($productcategory['is_display_home']=='0'){ echo "checked";} ?> /> No
                      </div>

           
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Save</button>
                    <a href="{{ url('admin/all_product_category') }}" class="btn btn-primary">Back</a>
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
                category_name: {
                    validators: {
                        notEmpty: {
                            message: 'Category Name is required'
                        }
                    }
                },
                category_order: {
                    validators: {
                        integer: {
                        	message: 'The value is not an integer'
                    	}
                    }
                }
            }
        });
    })();

});
  </script>
  @endsection
