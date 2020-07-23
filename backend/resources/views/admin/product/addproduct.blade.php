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
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Product</h3><a href="{{ URL::to('admin/add_product') }}" class="btn pull-right">Back</a>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/createproduct') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
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
                      <label for="exampleInputEmail1">License Type </label>
                      <select class="form-control" name="license_type" id="license_type">
                          <option value="">--Select Type--</option>
                          <option value="Standard">Standard</option>
                          <option value="Extended">Extended</option>
                      </select>
                    </div>
                    @if($errors->has('license_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('license_type') }}</div>
                    @endif
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
                      <label for="exampleInputEmail1">Product Color </label>
                      <select class="form-control select2" name="product_color[]" id="product_color" multiple="multiple" data-placeholder="Select Product Color">
                      <option value="">--Select Product Color --</option>
                      @foreach($pcolorlist as $color)
                        <option value="{{ $color['id'] }}" >{{ $color['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_color'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_color') }}</div>
                    @endif
                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Gender </label>
                      <select class="form-control select2" name="product_gender[]" id="product_gender" multiple="multiple" data-placeholder="Select Product Gender" >
                      <option value="">--Select Product Gender --</option>
                      @foreach($productGenders as $gender)
                        <option value="{{ $gender['id'] }}" >{{ $gender['name'] }}</option>
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
                        <option value="{{ $imageglow['id'] }}" >{{ $imageglow['name'] }}</option>
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
                        <option value="{{ $imagesize['id'] }}" >{{ $imagesize['name'] }}</option>
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
                        <option value="{{ $imageage['id'] }}" >{{ $imageage['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_image_age'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_image_age') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Ethinicities </label>
                      <select class="form-control select2" name="product_ethinicities[]" id="product_ethinicities" multiple="multiple">
                      <option value="">--Select Product Ethinicities --</option>
                      @foreach($productethinicities as $ethinicities)
                        <option value="{{ $ethinicities['id'] }}" >{{ $ethinicities['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_ethinicities'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_ethinicities') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Locations </label>
                      <select class="form-control select2" name="product_locations[]" id="product_locations" multiple="multiple">
                      <option value="">--Select Product Locations --</option>
                      @foreach($productlocations as $locations)
                        <option value="{{ $locations['id'] }}" >{{ $locations['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_locations'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_locations') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Peoples </label>
                      <select class="form-control select2" name="product_peoples[]" id="product_peoples" multiple="multiple">
                      <option value="">--Select Product Peoples --</option>
                      @foreach($productPeoples as $peoples)
                        <option value="{{ $peoples['id'] }}" >{{ $peoples['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_peoples'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_peoples') }}</div>
                    @endif
                      <div class="form-group">
                      <label for="exampleInputEmail1">Product Resolution </label>
                      <select class="form-control select2" name="product_resolution[]" id="product_resolution" multiple="multiple">
                      <option value="">--Select Product Resolution --</option>
                      @foreach($imageResolution as $presolut)
                        <option value="{{ $presolut['id'] }}" >{{ $presolut['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_resolution'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_resolution') }}</div>
                    @endif
                      <div class="form-group">
                      <label for="exampleInputEmail1">Product Orientations </label>
                      <select class="form-control select2" name="product_orientations[]" id="product_orientations" multiple="multiple">
                      <option value="">--Select Product Orientations --</option>
                      @foreach($productOrientations as $porient)
                        <option value="{{ $porient['id'] }}" >{{ $porient['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_orientations'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_orientations') }}</div>
                    @endif
                      <div class="form-group">
                      <label for="exampleInputEmail1">Product Sort Types </label>
                      <select class="form-control select2" name="product_sort_types[]" id="product_sort_types" multiple="multiple">
                      <option value="">--Select Product Locations --</option>
                      @foreach($imageSortTypes as $sortty)
                        <option value="{{ $sortty['id'] }}" >{{ $sortty['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    @if ($errors->has('product_sort_types'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_sort_types') }}</div>
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
                    <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
                    <a href="{{ url('admin/all_products') }}" class="btn btn-primary">Back</a>
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
                },
			  product_image: {
                    validators: {
                        notEmpty: {
                            message: 'Product image is required'
                        }
                    }
                }

            }
        });
    })();

});
</script>
  @endsection
  
