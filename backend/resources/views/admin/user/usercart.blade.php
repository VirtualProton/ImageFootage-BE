@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Registrants
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New Registrants</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box" style="overflow: auto;">
                <div class="box-header">
                  <h3 class="box-title">New Registrants</h3>
                </div>
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="box-body">

            <table id="account" class="col-sm-12 table table-bordered table-striped dataTable" >
                <thead>
                <tr >
                <th>SN</th>
                <th>User Name</th>
                <th>Name</th>
                <th>Title</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Registration Date</th>
                <th>New Purchases</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($userlist) > 0)
                    @foreach($userlist as $k=>$user)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td><a href="{{ url('admin/users/invoices/'.$user['id'])}}">{{$user['user_name']}}</td>
                  <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                  <td>{{$user['title']}}</td>
                  <td>{{$user['email']}}</td>
                  <td>{{$user['mobile']}}</td>
                  
                  <td><?php echo date('D, d M, Y',strtotime($user['created_at'])) ?></td>
                  <td>
                    @if(!($user['plans'])->isEmpty())
                    Yes
                    @else
                    No

                    @endif                    
                  </td>
                  <td><?php echo ($user['status']=='1'?"Active":"Inactive"); ?></td>
                  
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
