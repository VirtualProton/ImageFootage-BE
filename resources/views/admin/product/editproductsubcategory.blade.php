@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Product Subcategory
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product Subcategory</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Product Subcategory</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/editproductsubcategory') }}" role="form" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="product_subcategory_id" value="{{ $ProductSubCategory['subcategory_id'] }}">
                 <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <select class="form-control" name="category" id="category"> 
                      	<option value="">Select Category</option>
                        @foreach($productcategory as $category)
                        <option value="{{ $category['category_id'] }}" @if( $ProductSubCategory['category_id']==$category['category_id'] ) selected="selected" @endif >{{ $category['category_name'] }}</option>
                        @endforeach
                      </select>
                       @if ($errors->has('category'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('category') }}</div>
                       @endif
                  </div>
                  <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Sub Category Name </label>
                      <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" placeholder="Sub Category Name" value="{{ $ProductSubCategory['subcategory_name'] }}">
                       @if ($errors->has('sub_category_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('sub_category_name') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category Display Order </label>
                      <input type="text" class="form-control" name="sub_category_order" id="sub_category_order" placeholder="Sub Category Display Order" value="{{ $ProductSubCategory['subcategory_order'] }}">
                       @if ($errors->has('sub_category_order'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('sub_category_order') }}</div>
                       @endif
                    </div>
           
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
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
