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
                      <label for="exampleInputEmail1">Product Bank/Owner Name </label>
                      <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Product Bank/Owner Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="product_type" value="Image"> Image
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Footage"> Footage
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Editorial"> Editorial
                          </label>
                    	</div>
                    </div>
                    <div class="form-group">
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
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Keywords</label>
                      <textarea name="prodect_keywords" class="form-control" placeholder="Product Keywords">
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Release Details</label>
                      <textarea name="release_details" class="form-control" placeholder="Release Details">
                      </textarea>
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
                    </div>
                     <div class="form-group">
                      <label for="exampleInputFile">Product Size</label>
                      <input type="text" id="product_size" placeholder="Product Size" class="form-control" name="product_size" readonly="readonly">
                      <p class="help-block">Example block-level help text here.</p>
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
