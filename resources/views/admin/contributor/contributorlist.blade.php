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
        Contributor List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contributor List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Contributor List</h3>
                </div>

                @include('admin.partials.message')


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Member Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>ID Proof</th>
                        <th>Type</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     @foreach($contributor as $contributor)
                    <tr>
  <td>{{ $contributor['contributor_id'] }} </td>
  <td>{{ $contributor['contributor_memberid'] }} </td>
  <td>{{ $contributor['contributor_name'] }} </td>
  <td>{{ $contributor['contributor_email'] }} </td>
  <td><img src="{{URL::asset('uploads/idproof/'.$contributor['contributor_idproof'])}}" alt="Id Proof" width="100"> </td>
  <td>{{ $contributor['contributor_type'] }} </td>
  <td>{{ date('Y-m-d',strtotime($contributor['created_at'])) }} </td>
  <td>  @if($contributor['contributor_status'] =='Active')
  			<a href="{{ url('admin/contributor_status/Inactive/'.$contributor['contributor_id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         @elseif($contributor['contributor_status'] =='Inactive')
         	<a href="{{ url('admin/contributor_status/Active/'.$contributor['contributor_id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        @endif

            <a href="{{ url('admin/updatecontributor/'.$contributor['contributor_id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deletecontributor/'.$contributor['contributor_id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this contributor?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
@endforeach
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        <th>Member Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>ID Proof</th>
                        <th>Type</th>
                        <th>Created At</th>
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
