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
        Promotion List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Promotion List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Promotion List</h3>
                </div>

                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
                @endif

                <table id="promotion" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Event Name</th>
                        <th>Page Type</th>
                        <th>Actions</th>
                    </thead>

                  <tbody>
                        @foreach($promotionlist as $promotion)
                      <tr>
                        <td>{{ $promotion['id'] }} </td>
                        <td>{{ $promotion['event_name'] }} </td>
                        <td> {{ $promotion['page_type'] }} </td>
                        <td>  @if($promotion['status'] =='1')
                            <a href="{{ url('admin/promotionstatus/0/'.$promotion['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                            @elseif($promotion['status'] =='0')
                              <a href="{{ url('admin/promotionstatus/1/'.$promotion['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                            @endif

                            <a href="{{ url('admin/updatepromotion/'.$promotion['id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <a href="{{ url('admin/deletepromotion/'.$promotion['id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this promotion?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
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
    $('#promotion').DataTable();
 })
    </script>
  @endsection


