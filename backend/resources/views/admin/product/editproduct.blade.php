@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Product</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/editproduct') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                 <input type="hidden" name="file_name" value="{{ $product['product_main_image'] }}">
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Product Title </label>
                      <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Product Title" value="{{ $product['product_title'] }}">
                       @if ($errors->has('product_title'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_title') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Bank/Owner Name </label>
                      <select class="form-control" name="owner_name" id="owner_name">
                      <option value="">--Product Bank/Owner Name--</option>
                        @foreach($contributor as $contributor)
                        <option value="{{ $contributor['contributor_memberid'] }}" @if($product['product_owner']==$contributor['contributor_memberid']) selected="selected" @endif >{{ $contributor['contributor_name'] }}</option>
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
                        <option value="{{ $category['category_id'] }}" @if($product['product_category']==$category['category_id']) selected="selected" @endif >{{ $category['category_name'] }}</option>
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
                      	
                      </select>
                    </div>
                    @if ($errors->has('product_sub_category'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_sub_category') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="product_type" value="Image" class="product_type" @if($product['product_main_type']=='Image') checked="checked" @endif > Image
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Footage" class="product_type" @if($product['product_main_type']=='Footage') checked="checked" @endif> Footage
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Editorial" class="product_type" @if($product['product_main_type']=='Editorial') checked="checked" @endif> Editorial
                          </label>
                    	</div>
                        @if ($errors->has('product_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_type') }}</div>
                       @endif
                    </div>
                    
                   
                    <div class="form-group"     @if($product['product_main_type']=='Image' || $product['product_main_type']=='Editorial' ) 
                    style="display:block;" @elseif($product['product_main_type']=='Footage')  style="display:none;" @endif id="sub_product_type">
                      <label for="exampleInputPassword1">Sub Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="sub_product_type" value="Photo" @if($product['product_sub_type']=='Photo') checked="checked" @endif> Photo
                          </label>
                          <label>
                            <input type="radio" name="sub_product_type" value="Vector" @if($product['product_sub_type']=='Vector') checked="checked" @endif> Vector
                          </label>
                          <label>
                            <input type="radio" name="sub_product_type" value="Illustrator" @if($product['product_sub_type']=='Illustrator') checked="checked" @endif> Illustrator
                          </label>
                    	</div>
                    </div>
                     @if ($errors->has('sub_product_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('sub_product_type') }}</div>
                    @endif
                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Color </label>
                      <select class="form-control select2" name="product_color[]" id="product_color" multiple="multiple">
                      <option value="">--Select Product Color --</option>
                      @foreach($pcolorlist as $color)
                        <option value="{{ $color['id'] }}" @if(in_array($color['id'],$product_color_array)) selected="selected" @endif >{{ $color['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_color'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_color') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Gender </label>
                      <select class="form-control select2" name="product_gender[]" id="product_gender" multiple="multiple">
                      <option value="">--Select Product Gender --</option>
                      @foreach($productGenders as $gender)
                        <option value="{{ $gender['id'] }}" @if(in_array($gender['id'],$product_gender_array)) selected="selected" @endif >{{ $gender['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_gender'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_gender') }}</div>
                    @endif
                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Glow Type </label>
                      <select class="form-control select2" name="product_glow_type[]" id="product_glow_type" multiple="multiple">
                      <option value="">--Select Product Glow Type --</option>
                      @foreach($productimagetypes as $imageglow)
                        <option value="{{ $imageglow['id'] }}" @if(in_array($imageglow['id'],$product_glow_type_array)) selected="selected" @endif>{{ $imageglow['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_glow_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_glow_type') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Image Size </label>
                      <select class="form-control select2" name="product_image_size[]" id="product_image_size" multiple="multiple">
                      <option value="">--Select Product Image Size --</option>
                      @foreach($productimagesize as $imagesize)
                        <option value="{{ $imagesize['id'] }}" @if(in_array($imagesize['id'],$product_image_size_array)) selected="selected" @endif >{{ $imagesize['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_image_size'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_image_size') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Image Age </label>
                      <select class="form-control select2" name="product_image_age[]" id="product_image_age" multiple="multiple">
                      <option value="">--Select Product Image Size --</option>
                      @foreach($productagewises as $imageage)
                        <option value="{{ $imageage['id'] }}" @if(in_array($imageage['id'],$product_image_age_array)) selected="selected" @endif >{{ $imageage['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_image_age'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_image_age') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Vertical</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="product_vertical" value="Royalty Free"  @if($product['product_vertical']=='Royalty Free') checked="checked" @endif> Royalty Free
                          </label>
                          <label>
                            <input type="radio" name="product_vertical" value="Rights Managed" @if($product['product_vertical']=='Rights Managed') checked="checked" @endif> Rights Managed
                          </label>
                          <label>
                            <input type="radio" name="product_vertical" value="Premium Rights Managed" @if($product['product_vertical']=='Premium Rights Managed') checked="checked" @endif> Premium Rights Managed
                          </label>
                    	</div>
                         @if ($errors->has('product_vertical'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_vertical') }}</div>
                         @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Keywords</label>
                      <textarea name="prodect_keywords" class="form-control" placeholder="Product Keywords" >{{ $product['product_keywords'] }}</textarea>
                       @if ($errors->has('prodect_keywords'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('prodect_keywords') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Release Details</label>
                      <textarea name="release_details" class="form-control" placeholder="Release Details">{{ $product['product_release_details'] }}</textarea>
                       @if ($errors->has('release_details'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('release_details') }}</div>
                    @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Small </label>
                      <input type="text" class="form-control" name="Price_small" id="owner_name" placeholder="Product Bank/Owner Name" value="{{ $product['product_price_small'] }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Medium </label>
                      <input type="text" class="form-control" name="price_medium" id="price_medium" placeholder="Product Bank/Owner Name" value="{{ $product['product_price_medium'] }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Large </label>
                      <input type="text" class="form-control" name="price_large" id="price_large" placeholder="Product Bank/Owner Name" value="{{ $product['product_price_large'] }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Extra Large </label>
                      <input type="text" class="form-control" name="price_extra_large" id="price_extra_large" placeholder="Product Bank/Owner Name" value="{{ $product['product_price_extralarge'] }}">
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
 	var prod_id=$("#product_category").val();
	var prod_subcat="{{ $product['product_subcategory'] }}";
	var csrf='{{ csrf_token() }}';
	$.ajax({
			url: '{{ url("admin/get_related_subcat") }}',
			type: 'POST',
			data: {'prod_id':prod_id,'_token':csrf,'prod_subcat':prod_subcat},
			success:function(data){
				$("#product_sub_category").html('');
				$("#product_sub_category").html(data);
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
$('.select2').select2();
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
                product_title: {
                    validators: {
                        notEmpty: {
                            message: 'Product title is required'
                        }
                    }
                },
                owner_name: {
                    validators: {
                        notEmpty: {
                            message: 'Owner name is required'
                        }
                    }
                },
                product_category: {
                    validators: {
                        notEmpty: {
                            message: 'Product category is required'
                        }
                    }
                },
                product_sub_category: {
                 validators: {
                notEmpty: {
                  message: 'Product sub category is required'
                }
              }
            },
            product_type: {
              validators: {
               stringLength: {
                  message: 'Product type is required'
                }
              }
            },
            prodect_keywords: {
              validators: {
                notEmpty: {
                  message: 'Product keywords is required'
                }
              }
             },
              release_details: {
                    validators: {
                        notEmpty: {
                            message: 'Release details is required'
                        }
                    }
                }
			 

            }
        });
    })();

});
</script>
  @endsection
