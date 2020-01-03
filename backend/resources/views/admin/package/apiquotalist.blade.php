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
        API Quota List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">API Quota List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">API Quota List</h3>
                </div>
                @include('admin.partials.message')
                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Package Provider</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                     @foreach($package as $packages)
                    <tr>
  <td>{{ $packages['api_provider'] }} </td>
  <td>{{ $packages['api_amount'] }} </td>
  
  <td>      <a href="{{ url('admin/updateapiquata/'.$packages['api_id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deleteapiquata/'.$packages['api_id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this API Quata?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
@endforeach
                    </tbody>
                    <tfoot>
                        <th>Package Provider</th>
                        <th>Amount</th>
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
