@extends('admin.layouts.default')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection



@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Product Id : {{ $product[0]['product_id'] }}</h3>
                  <input type="hidden" value="{{ $product[0]['id'] }}" id="product_id" />
                  <span class="pull-right">
                  <button class="btn vbutton" id="verifybuttion" type="Verify" @if($product[0]['product_verification']=='Verify') style="background:#090;color:#fff;" @endif>Verify</button>
                  
                  <button class="btn btn-info" data-toggle="collapse" data-target="#demo" type="Reject">Reject</button>
                  <a class="btn btn-info" href="{{ url('admin/editproduct/'.$product[0]['id']) }}"  type="Edit"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                  <a class="btn btn-info" href="{{ url('admin/deleteproduct/'.$product[0]['id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                 @if($product[0]['product_status'] =='Active')
  					<a class="btn btn-info" href="{{ url('admin/product/Inactive/'.$product[0]['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> Status </a>
         		 @elseif($product[0]['product_status'] =='Inactive')
         			<a class="btn btn-info" href="{{ url('admin/product/Active/'.$product[0]['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i> Status</a>
        		 @endif
                  <?php /*?><button class="btn vbutton" type="Suggest">Suggest</button><?php */?>
                  <div id="demo" class="collapse">
   <textarea id="reject_message" class="form-control" placeholder="Reason to reject"></textarea>
   <button class="btn btn-info vbutton" type="Reject">Reject</button>
   
  </div>
  </span>
                </div>

                @include('admin.partials.message')
                <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                    Product Title
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_title'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    Product Id
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_id'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    Product Owner
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_owner'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    Product Category
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['category_name'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    Product Subcategory
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['subcategory_name'] }}
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-4">
                    Product Keywords
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_keywords'] }}
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-4">
                    Product Release Details
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_release_details'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    Small Price
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_price_small'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     Medium Price
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_price_medium'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     Large Price
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_price_large'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     Extra Large Price
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_price_extralarge'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     Size
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_size'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     Main Type
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_main_type'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     Sub type
                    </div>
                    <div class="col-md-6">
                    {{ $product[0]['product_sub_type'] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     Created At
                    </div>
                    <div class="col-md-6">
                    {{ date('Y-m-d',strtotime($product[0]['product_added_on'])) }}
                    </div>
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">Product Type :</label>
                      {{ $product[0]['product_main_type'] }}
                    </div>
                    <div class="form-group"     @if($product[0]['product_main_type']=='Image' || $product[0]['product_main_type']=='Editorial' ) 
                    style="display:block;" @elseif($product[0]['product_main_type']=='Footage')  style="display:none;" @endif id="sub_product_type">
                      <label for="exampleInputPassword1">Sub Product Type :</label>
                      {{ $product[0]['product_sub_type'] }}
                     
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Color : </label>
                      @if(isset($product_color_array))
                          @foreach($pcolorlist as $color)
                             @if(in_array($color['id'],$product_color_array)) <span>{{ $color['name'] }}</span> @endif
                          @endforeach
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Gender : </label>
                      @foreach($productGenders as $gender)
                        @if(in_array($gender['id'],$product_gender_array)) <span>{{ $gender['name'] }}</span> @endif 
                      @endforeach
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Glow Type : </label>
                      @foreach($productimagetypes as $imageglow)
                         @if(in_array($imageglow['id'],$product_glow_type_array)) <span>{{ $imageglow['name'] }}</span> @endif
                      @endforeach
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Image Size : </label>
                      @foreach($productimagesize as $imagesize)
                         @if(in_array($imagesize['id'],$product_image_size_array)) <span>{{ $imagesize['name'] }}</span> @endif 
                      @endforeach
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Ethinicities : </label>
                      @foreach($productethinicities as $ethinicities)
                        @if(in_array($ethinicities['id'],$filterethinicitiesarray)) <span>{{ $ethinicities['name'] }}</span> @endif 
                      @endforeach
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Locations : </label>
                      @foreach($productlocations as $locations)
                        @if(in_array($locations['id'],$filterlocationsarray)) <span>{{ $locations['name'] }}</span> @endif
                      @endforeach
                    </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Product Peoples : </label>
                      @foreach($productPeoples as $peoples)
                         @if(in_array($peoples['id'],$filterpeoplessarray)) <span>{{ $peoples['name'] }}</span> @endif
                      @endforeach
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Resolution : </label>
                      @foreach($imageResolution as $presolut)
                         @if(in_array($presolut['id'],$filterresolutionarray)) <span>{{ $presolut['name'] }}</span> @endif
                        @endforeach
                    </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Product Orientations : </label>
                      @foreach($productOrientations as $porient)
                        @if(in_array($porient['id'],$filterproductorientationsarray)) <span>{{ $porient['name'] }}</span> @endif
                      @endforeach
                    </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1">Product Sort Types : </label>
                      @foreach($imageSortTypes as $sortty)
                         @if(in_array($sortty['id'],$filtersort_typessarray)) <span>{{ $sortty['name'] }} </span>  @endif
                      @endforeach
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Image Age : </label>
                      @foreach($productagewises as $imageage)
                        @if(in_array($imageage['id'],$product_image_age_array)) <span>{{ $imageage['name'] }} </span> @endif
                      @endforeach
                     
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Vertical :</label>{{ $product[0]['product_vertical'] }}
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Keywords</label>
                      {{ $product[0]['product_keywords'] }}
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Release Details</label>
                      {{ $product[0]['product_release_details'] }}
                     
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Small :{{ $product[0]['product_price_small'] }} </label>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Medium : {{ $product[0]['product_price_medium'] }}</label>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Large : {{ $product[0]['product_price_large'] }} </label>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Extra Large : {{ $product[0]['product_price_extralarge'] }} </label>
                      
                    </div>

                
                
                
                
                
                
                
              @if($product[0]['product_main_type']=='Image')
              		<img src="{{ $product[0]['product_main_image'] }}" alt="User Image" width="600">
              	
              @elseif($product[0]['product_main_type']=='Footage')
                  <video width="320" height="240" controls>
                      <source src="{{ $product[0]['product_main_image'] }}" type="video/mp4">
                      <source src="{{ $product[0]['product_main_image'] }}" type="video/ogg">
                             browser does not support the video tag.
                 </video>
              @elseif($product[0]['product_main_type']=='Editorial')
              		<img src="{{ $product[0]['product_main_image'] }}" alt="User Image" width="600">
              @endif
                </div>
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
  	$(".vbutton").click(function(){
    	var btn_type=$(this).attr('type');
		var csrf='{{ csrf_token() }}';
		var prod_id=$('#product_id').val();
		var message=$('#reject_message').val();
		if(btn_type=='Reject' && message ==''){
			alert('Reason is required.');
			return false;
		}
    if(btn_type=='Reject' && message !=''){
      alert('Message has been sent.');
      return true;
    }
        $.ajax({
			url: '{{ url("admin/update_product_verify") }}',
			type: 'POST',
			data: {'prod_id':prod_id,'_token':csrf,'type':btn_type,'message':message},
			success:function(data){
        // $("#verifybuttion").css("background:#090;color:#fff;");
        $("#verifybuttion").css("background-color", "#090");
        $("#verifybuttion").css("color", "#fff");

				alert(data);

			}
		});
    });
	</script>
  
  @endsection