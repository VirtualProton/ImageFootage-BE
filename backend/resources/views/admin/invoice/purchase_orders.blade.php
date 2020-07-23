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
          Purchase Orders
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase Orders</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
            <div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title"> Purchase Orders List</h3>
                </div>
                @include('admin.partials.message')
                <!-- /.box-header -->
                <div class="box-body">

                <!-- <table id="account" class="table table-bordered table-striped dataTable " class="col-sm-12"> -->
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr >
                  <th>SN</th>
                  <th>User Name</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th colspan="2">Sale Type</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($userlist) > 0)
                    @foreach($userlist as $k=>$user)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td><a href="{{ url('admin/users/invoices/'.$user['id'])}}" target="_blank">{{$user['user_name']}}</a></td>
                  <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                  <td>{{$user['email']}}</td>
                  <td>{{$user['mobile']}}</td>
                  <td><a href="{{ url('admin/users/invoices/'.$user['id'])}}" target="_blank">Offline Sale</a></td>
                  <td><a href="{{ url('admin/users/user_orders/'.$user['id'])}}" target="_blank">Online Sale</a></td>
                </tr>
                @endforeach
                @endif

                </table>

              </div>
            </div>
            </div>
        </div>
                {{ $userlist->links() }}

{{--    </div>--}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @endsection
  @section('scripts')
  <script>
  $(function () {

   /* $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });*/
  });
</script>
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
  $('.reset_cont_pass').click(function(){
    var cont_id=$(this).attr('cont_id');
    $.ajax({
            type: "POST",
            data: {},
            url: "{{ url('admin/request_for_contributorpass/')}}/"+cont_id+"",
            success: function(msg) {
        var data=msg.trim();
        if(data=='success'){
          alert('Password request rised successfully.');
        }else{
          alert('Some problem occured.');
        }
        }
      });
  });
</script>
  @endsection
