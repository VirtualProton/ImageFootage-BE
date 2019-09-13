@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Product</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/createproduct') }}" role="form" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Product Title </label>
                      <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Product Title">
                       @if ($errors->has('product_title'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_title') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Bank/Owner Name </label>
                       <select class="form-control" name="owner_name" id="owner_name">
                      <option value="">--Product Bank/Owner Name--</option>
                        @foreach($contributor as $contributor)
                        <option value="{{ $contributor['contributor_memberid'] }}" >{{ $contributor['contributor_name'] }}</option>
                        @endforeach
                      </select>
                       @if ($errors->has('owner_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('owner_name') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Category </label>
                      <select class="form-control" name="product_category" id="product_category">
                      <option value="">--Select Category--</option>
                        @foreach($productcategory as $category)
                        <option value="{{ $category['category_id'] }}" >{{ $category['category_name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_category'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_category') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Sub Category </label>
                      <select class="form-control" name="product_sub_category" id="product_sub_category">
                      <option value="">--Select Sub Category --</option>
                      @foreach($productsubcategory as $subcategory)
                        <option value="{{ $subcategory['subcategory_id'] }}" >{{ $subcategory['subcategory_name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_sub_category'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_sub_category') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="product_type" value="Image" class="product_type"> Image
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Footage" class="product_type"> Footage
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Editorial" class="product_type"> Editorial
                          </label>
                    	</div>
                    </div>
                    @if ($errors->has('product_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_type') }}</div>
                    @endif
                    <div class="form-group" style="display:none;" id="sub_product_type">
                      <label for="exampleInputPassword1">Sub Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="sub_product_type" value="Photo"> Photo
                          </label>
                          <label>
                            <input type="radio" name="sub_product_type" value="Vector"> Vector
                          </label>
                          <label>
                            <input type="radio" name="sub_product_type" value="Illustrator"> Illustrator
                          </label>
                    	</div>
                    </div>
                     @if ($errors->has('sub_product_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('sub_product_type') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Vertical</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="product_vertical" value="Royalty Free"> Royalty Free
                          </label>
                          <label>
                            <input type="radio" name="product_vertical" value="Rights Managed"> Rights Managed
                          </label>
                          <label>
                            <input type="radio" name="product_vertical" value="Premium Rights Managed"> Premium Rights Managed
                          </label>
                    	</div>
                         @if ($errors->has('product_vertical'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_vertical') }}</div>
                         @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Keywords</label>
                      <textarea name="prodect_keywords" class="form-control" placeholder="Product Keywords">
                      </textarea>
                       @if ($errors->has('prodect_keywords'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('prodect_keywords') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Release Details</label>
                      <textarea name="release_details" class="form-control" placeholder="Release Details">
                      </textarea>
                       @if ($errors->has('release_details'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('release_details') }}</div>
                    @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Small </label>
                      <input type="text" class="form-control" name="Price_small" id="owner_name" placeholder="Product Bank/Owner Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Medium </label>
                      <input type="text" class="form-control" name="price_medium" id="price_medium" placeholder="Product Bank/Owner Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Large </label>
                      <input type="text" class="form-control" name="price_large" id="price_large" placeholder="Product Bank/Owner Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Extra Large </label>
                      <input type="text" class="form-control" name="price_extra_large" id="price_extra_large" placeholder="Product Bank/Owner Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Product</label>
                      <input type="file" id="product_image" name="product_image">
    
                      <p class="help-block">Example block-level help text here.</p>
                      @if ($errors->has('product_image'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_image') }}</div>
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
  @endsection
