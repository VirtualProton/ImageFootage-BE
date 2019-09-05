@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Product Sub Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Product Sub Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Product Sub Category</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/insert_product_category') }}" role="form" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <select class="form-control" name="category" id="category"> 
                      	<option value="">Select Category</option>
                      </select>
                       @if ($errors->has('category'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('category') }}</div>
                       @endif
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category Name </label>
                      <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" placeholder="Sub Category Name">
                       @if ($errors->has('sub_category_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('sub_category_name') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category Display Order </label>
                      <input type="text" class="form-control" name="sub_category_order" id="sub_category_order" placeholder="Sub Category Display Order">
                       @if ($errors->has('sub_category_order'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('sub_category_order') }}</div>
                       @endif
                    </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
  </script>
  @endsection
