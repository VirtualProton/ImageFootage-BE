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
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Products List</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
              
                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Product Id</th>
                        <th>Product Category</th>
                        <th>Product Subcategory</th>
                        <th>Product Owner</th>
                        <th>Product Vertical</th>
                        <th>Product Keywords</th>
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
  <td>{{ $product['product_main_image'] }} </td>
  <td>{{ date('Y-m-d',strtotime($product['product_added_on'])) }} </td>
  <td></td>
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
   
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
  @endsection
