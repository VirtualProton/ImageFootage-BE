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
        Colors List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Colors List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Colors List</h3>
                </div>

                @include('admin.partials.message')


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     @foreach($pcolorlist as $product)
                    <tr>
  <td>{{ $product['id'] }} </td>
  <td>{{ $product['name'] }} </td>
 

  <td>{{ date('Y-m-d',strtotime($product['created_at'])) }} </td>
  <td>  @if($product['status'] =='1')
  			<a href="{{ url('admin/product_colors_status/0/'.$product['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         @elseif($product['status'] =='0')
         	<a href="{{ url('admin/product_colors_status/1/'.$product['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        @endif
            <a href="{{ url('admin/editproductcolor/'.$product['id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deletepcolor/'.$product['id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this product color?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
@endforeach
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        <th>Name</th>
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
