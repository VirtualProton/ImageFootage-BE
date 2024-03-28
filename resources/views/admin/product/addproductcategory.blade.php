@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="quotatationController">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Product Category
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add Product Category</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add Product Category</h3><a href="{{ URL::to('admin/all_product_category') }}" class="btn pull-right">Back</a>
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
          <form action="{{ url('admin/insert_product_category') }}" role="form" method="post" id="productform" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Category Name </label>
                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name">
                @if ($errors->has('category_name'))
                <div class="has_error" style="color:red;">{{ $errors->first('category_name') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Category Display Order </label>
                <input type="text" class="form-control" name="category_order" id="category_order" placeholder="Category Display Order">
                @if ($errors->has('category_order'))
                <div class="has_error" style="color:red;">{{ $errors->first('category_order') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Category Keywords</label>
                <input type="text" class="form-control" name="category_keywords" id="category_keywords" placeholder="Category Keywords">
                @if ($errors->has('category_keywords'))
                <div class="has_error" style="color:red;">{{ $errors->first('category_keywords') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" class="form-control" name="product_id" id="product_id" placeholder="Product ID" ng-blur="getProductImage()">
                <input type="hidden" name="image_path" id="image_path" value="" />
                @if ($errors->has('product_id'))
                <div class="has_error" style="color:red;">{{ $errors->first('product_id') }}</div>
                @endif
                @if ($errors->has('image_path'))
                <div class="has_error" style="color:red;">{{ $errors->first('image_path') }}</div>
                @endif
              </div>
              <div class="form-group" ng-if="is_display_product_image">
                <span><img id="display_image" src="" width="150" height="150" style="margin-top: 6px;" /></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Is Display On Home </label>
                <input type="radio" name="display" value="1" /> Yes
                <input type="radio" name="display" value="0" checked /> No
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Select Category Type </label>
                <input type="radio" name="product_type" value="1" checked /> Image
                <input type="radio" name="product_type" value="2"  /> Footage
                <input type="radio" name="product_type" value="3"  /> Music
              </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
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
  $('.product_type').click(function() {
    if ($(this).is(":checked")) {
      var ptype = $(this).val();
      if (ptype == 'Image' || ptype == 'Editorial') {
        $("#sub_product_type").css("display", "block");
      } else {
        $("#sub_product_type").css("display", "none");
      }
    }
  });
  $(document).ready(function($) {

    // Example Validataion Standard Mode
    // ---------------------------------
    (function() {

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

    $('input[name="product_type"]').on('change', function () {
            // Reset Product ID field
            $('#product_id').val('');
            // Reset image_path field if needed
            $('#image_path').val('');
            $("#display_image").val('');
            $('.form-group label[for="product_id"]').parent().removeClass('has-success');
            angular.element(document.getElementById('product_id')).scope().$apply(function () {
                angular.element(document.getElementById('product_id')).scope().is_display_product_image = false;
            });
        });

  });
</script>
@endsection
