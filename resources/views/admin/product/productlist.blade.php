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
        Products List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Products List</h3>
                </div>

                @include('admin.partials.message')


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Product Id</th>
                        <th>Product Category</th>
                        <th>Product Subcategory</th>
                        <th>Product Owner</th>
                        <th>Product Vertical</th>
                        <th>Product Keywords</th>
                        <th>Product Type</th>
                        <th>Product</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     @foreach($products as $product)
                    <tr>
  <td>{{ $product['id'] }} </td>
  <td>{{ $product['product_id'] }} </td>
  <td>{{ $product['product_category'] }} </td>
  <td>{{ $product['product_subcategory'] }} </td>
  <td>{{ $product['product_owner'] }} </td>
  <td>{{ $product['product_vertical'] }} </td>
  <td>{{ $product['product_keywords'] }} </td>
  <td>{{ $product['product_main_type'] }} </td>
  <td>

  @if($product['product_main_type'] =='Image')
  	@if($product['product_sub_type'] =='Vector')

    @elseif($product['product_sub_type'] =='Photo')
    <img src="{{URL::asset('uploads/image/photo/'.$product['product_main_image'])}}" alt="User Image" width="100">
    @elseif($product['product_sub_type'] =='Illustrator')
    @endif

  @elseif($product['product_main_type'] =='Footage')
  @elseif($product['product_main_type'] =='Editorial')
  	@if($product['product_sub_type'] =='Vector')

    @elseif($product['product_sub_type'] =='Photo')
    <img src="{{URL::asset('uploads/editorial/photo/'.$product['product_main_image'])}}" alt="User Image" width="100">
    @elseif($product['product_sub_type'] =='Illustrator')
    @endif
  @endif

			</td>
  <td>{{ date('Y-m-d',strtotime($product['product_added_on'])) }} </td>
  <td>  @if($product['product_status'] =='Active')
  			<a href="{{ url('admin/product/Inactive/'.$product['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         @elseif($product['product_status'] =='Inactive')
         	<a href="{{ url('admin/product/Active/'.$product['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        @endif

            <a href="{{ url('admin/editproduct/'.$product['id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deleteproduct/'.$product['id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
@endforeach
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        <th>Product Id</th>
                        <th>Product Category</th>
                        <th>Product Subcategory</th>
                        <th>Product Owner</th>
                        <th>Product Vertical</th>
                        <th>Product Keywords</th>
                        <th>Product Type</th>
                        <th>Product</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </tfoot>
                </table>
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
  $(function () {

    $('#example2').DataTable(/*{
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    }*/);
  });
</script>
  @endsection
