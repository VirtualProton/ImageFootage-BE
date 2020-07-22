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
        Package List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Package List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Package List</h3>
                </div>

                @include('admin.partials.message')


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Package-Plan Type</th>
                        <th>Name</th>
                        <th>Price </th>
                        <th>Description</th>
                        <th>Products Count</th>
                        <th>Type</th>
                        <th>Added On</th>
                        <th>Expiry</th>
                        <th>Downloads Per Month</th>
                        <th>Carry Forward</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     @foreach($package as $packages)
                    <tr>
  <td>{{ $packages['package_id'] }} </td>
  <td>@if($packages['package_plan']==1)
       Download
     @else
        Subscription
    @endif
  </td>
  <td>{{ $packages['package_name'] }} </td>
  <td>{{ $packages['package_price'] }} </td>
  <td>{{ $packages['package_description'] }} </td>
  <td>{{ $packages['package_products_count'] }} </td>
  <td>{{ $packages['package_type'] }} </td>
  <td>{{  date('Y-m-d',strtotime($packages['package_added_on'])) }} </td>
  <td>
      @if($packages['package_expiry']==1 && $packages['package_plan']==2)
          Expire in 1 month
      @elseif($packages['package_expiry_yearly']==1 && $packages['package_plan']==2)
          Expire limit per month till 1 year.
       @elseif($packages['package_plan']==1)
          Expire in 1 year.
      @endif
      </td>
  <td>{{ $packages['package_permonth_download'] }}</td>
  <td>{{ $packages['package_pcarry_forward'] }}</td>
  <td>  @if($packages['package_status'] =='Active')
  			<a href="{{ url('admin/package/Inactive/'.$packages['package_id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         @elseif($packages['package_status'] =='Inactive')
         	<a href="{{ url('admin/package/Active/'.$packages['package_id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        @endif
            <a href="{{ url('admin/updatepackage/'.$packages['package_id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deletepackage/'.$packages['package_id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this package?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
@endforeach
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        <th>Package-Plan Type</th>
                        <th>Name</th>
                        <th>Price </th>
                        <th>Description</th>
                        <th>Products Count</th>
                        <th>Type</th>
                        <th>Added On</th>
                        <th>Expiry</th>
                        <th>Downloads Per Month</th>
                        <th>Carry Forward</th>
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
