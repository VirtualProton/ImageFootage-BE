@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" ng-controller="quotatationController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Product Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                      <label for="exampleInputEmail1">Product ID</label>
                      <input type="text" class="form-control" name="product_id" id="product_id" placeholder="Product ID" value="{{ $productcategory['product_id'] }}" ng-init="getProductImageEditPageInit()" ng-blur="getProductImageEditPage()">
                      <input type="hidden" name="image_path" id="image_path" value="{{ $productcategory['image_path'] }}" />
                      @if ($errors->has('product_id'))
                      <div class="has_error" style="color:red;">{{ $errors->first('product_id') }}</div>
                      @endif
                      @if ($errors->has('image_path'))
                      <div class="has_error" style="color:red;">{{ $errors->first('image_path') }}</div>
                      @endif
                    </div>
                    <div class="form-group" ng-if="is_display_product_image_edit_page">
                      <span><img id="display_image" src="{{ $productcategory['image_path'] }}" width="150" height="150" style="margin-top: 6px;" /></span>
                    </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Want to Display on Home</label>
                          <input type="radio"  name="display"  value="1" <?php if($productcategory['is_display_home']=='1'){ echo "checked";} ?> /> Yes
                          <input type="radio"  name="display"  value="0" <?php if($productcategory['is_display_home']=='0'){ echo "checked";} ?> /> No
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Type</label>
                        <div class="checkbox">
                            <label>
                              <input type="radio" name="product_type" value="1" class="product_type" <?php if($productcategory['type']=='1'){ echo "checked";}?> /> Image
                            </label>
                            <label>
                              <input type="radio" name="product_type" value="2" class="product_type" <?php if($productcategory['type']=='2'){ echo "checked";}?> /> Footage
                            </label>
                            <label>
                              <input type="radio" name="product_type" value="3" class="product_type" <?php if($productcategory['type']=='3'){ echo "checked";}?> /> Music
                            </label>
                          </div>
                      </div>
                      @if ($errors->has('product_type'))
                                <div class="has_error" style="color:red;">{{ $errors->first('product_type') }}</div>
                      @endif


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
                  notEmpty: {
                    message: 'Category Name is required'
                  },
                  numeric: {
                    message: 'The value is not an integer'
                  }
                }
              },
              product_id: {
                validators: {
                  notEmpty: {
                    message: 'Product ID is required'
                  }
                }
              },
            }
        });
    })();

});
  </script>
  @endsection
