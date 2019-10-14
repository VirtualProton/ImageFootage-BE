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
        View Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">View Product</h3>
                  <input type="hidden" value="{{ $product[0]['id'] }}" id="product_id" />
                  <button class="btn vbutton" type="Verify" @if($product[0]['product_verification']=='Verify') style="background:#090;color:#fff;" @endif>Verify</button><button class="btn btn-info" data-toggle="collapse" data-target="#demo" type="Reject">Reject</button><button class="btn vbutton" type="Suggest">Suggest</button>
                  <div id="demo" class="collapse">
   <textarea id="reject_message" class="form-control" placeholder="Reason to reject"></textarea>
   <button class="btn btn-info vbutton" type="Reject">Reject</button>
   
  </div>
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
        $.ajax({
			url: '{{ url("admin/update_product_verify") }}',
			type: 'POST',
			data: {'prod_id':prod_id,'_token':csrf,'type':btn_type,'message':message},
			success:function(data){
				alert(data);
			}
		});
    });
	</script>
  
  @endsection