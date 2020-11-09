@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          User List with first Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User List with first Order</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box" style="overflow: auto;">
                <div class="box-header">
                  <h3 class="box-title"> User List</h3>
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
                <th>Plan/Package Purchased</th>
                <th>Amount</th>
                <th>Prchase Date</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($userlist1) > 0)
                    @foreach($userlist1 as $k=>$list)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td><a href="{{ url('admin/users/invoices/'.$list['user']['id'])}}" target="_blank">{{$list['user']['user_name']}}</a></td>
                  <td>{{$list['user']['first_name']}} {{$list['user']['last_name']}}</td>
                  <td>{{$list['user']['email']}}</td>
                  <td>{{$list['user']['mobile']}}</td>
                  <td>{{$list['download_plan_title']}}</td>
                  <td>{{$list['order_total']}}</td>
                  <td>{{$list['created_at']}}</td>

                  <!-- <td><a href="{{ url('admin/users/invoices/'.$list['user']['id'])}}" target="_blank">Invoice</a></td> -->
                  <!-- <td><a href="{{ url('admin/users/user_orders/'.$list['user']['id'])}}" target="_blank">Online Sale</a></td> -->
                </tr>
                @endforeach
                @endif

                 @if(count($userlist2) > 0)
                    @foreach($userlist2  as $k=>$list)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td><a href="{{ url('admin/users/invoices/'.$list['user']['id'])}}" target="_blank">{{$list['user']['user_name']}}</a></td>
                  <td>{{$list['user']['first_name']}} {{$list['user']['last_name']}}</td>
                  <td>{{$list['user']['email']}}</td>
                  <td>{{$list['user']['mobile']}}</td>
                  <td>{{$list['package_name']}}</td>
                  <td>{{$list['package_price']}}</td>
                  <td>{{$list['created_at']}}</td>
                  <!-- <td><a href="{{ url('admin/users/invoices/'.$list['user']['id'])}}" target="_blank">Invoice</a></td> -->
                  <!-- <td><a href="{{ url('admin/users/user_orders/'.$list['user']['id'])}}" target="_blank">Online Sale</a></td> -->
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
