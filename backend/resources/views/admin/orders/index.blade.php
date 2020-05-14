@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Orders List By User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lead/Contact/User List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box" style="overflow: auto;">
                <div class="box-header">
                  <h3 class="box-title"> Orders List</h3>
                </div>
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="box-body">

            <table id="account" class="table table-bordered table-striped dataTable " class="col-sm-12">
                <thead>
                <tr >
                <th>SN</th>
                <th>User Name</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Offline Orders</th>
                <th>Online Orders</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($userlist) > 0)
                    @foreach($userlist as $k=>$user)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>{{$user['user_name']}}</td>
                  <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                  <td>{{$user['title']}}</td>
                  <td>{{$user['email']}}</td>
                  <td>{{$user['mobile']}}</td>
                  <td><a href="{{ url('admin/users/invoices/'.$user['id'])}}" target="_blank">Offline Orders</a></td>
                  <td><a href="{{ url('admin/users/user_orders/'.$user['id'])}}" target="_blank">Online Orders</a></td>
                </tr>
                @endforeach
                @endif

              </table>

              </div>
            </div>
            </div>
        </div>
{{--    </div>--}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @endsection
    @section('scripts')
    <script>
    $(function () {
    $('#account').DataTable();
 })
    </script>

@stop
