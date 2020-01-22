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
        Product Category List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Category List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Product Category List</h3>
                </div>

                @include('admin.partials.message')


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Product Category</th>
                        <th>Product Category Alignment</th>
                        <th>Is Display HomePage</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     @foreach($productcategory as $category)
                    <tr>
  <td>{{ $category['category_id'] }} </td>
  <td>{{ $category['category_name'] }} </td>
  <td>{{ $category['category_order'] }} </td>
  <td>@if($category['is_display_home'] =='1')
        Yes
  @else
      No
  @endif
  </td>
  <td>{{ date('Y-m-d',strtotime($category['category_added_on'])) }} </td>
  <td>  @if($category['category_status'] =='Active')
  			<a href="{{ url('admin/productcategory/Inactive/'.$category['category_id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         @elseif($category['category_status'] =='Inactive')
         	<a href="{{ url('admin/productcategory/Active/'.$category['category_id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        @endif

            <a href="{{ url('admin/updateproductcategory/'.$category['category_id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deleteproductcategory/'.$category['category_id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this product category?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
@endforeach
                    </tbody>
                    <tfoot>
                       <th>Id</th>
                        <th>Product Category</th>
                        <th>Product Category Order</th>
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
