@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lead/Contact/User List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lead/Contact/User List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box" style="overflow: auto;">
                <div class="box-header">
                  <h3 class="box-title">Lead/Contact/User List</h3>
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
                <th>Account Manager</th>
                <th>Type</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Status</th>
                @if(Auth::guard('admins')->user()->role == '1')
                  <th>Action</th>
                @endif
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
                  <td>@if(isset($user['account']['account_name']) && !empty($user['account']['account_name']))
                          {{$user['account']['account_name']}}
                      @endif
                  </td>
                  <td>{{$user['type']}}</td>
                  <td><?php echo date('D, d M, Y',strtotime($user['created_at'])) ?></td>
                  <td><?php echo date('D, d M, Y',strtotime($user['updated_at'])) ?></td>
                  <td><?php echo ($user['status']=='1'?"Active":"Inactive"); ?></td>
                  @if(Auth::guard('admins')->user()->role == '1')
                    <td>
                        @if($user['status'] =='1')
                          <a href="{{ url('admin/users/status/0/'.$user['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                        @elseif($user['status'] =='0')
                          <a href="{{ url('admin/users/status/1/'.$user['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                        @endif
                        <a href="{{ URL::to('admin/users/'.$user['id'].'/edit') }}"><i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; &nbsp;
                        <form action="{{ route('users.destroy', $user['id']) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button  onclick="return confirm('Do You want to remove ?')"><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form>
                    </td>
                  @endif
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
