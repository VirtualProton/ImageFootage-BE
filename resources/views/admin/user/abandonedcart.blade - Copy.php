@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Abandoned Cart List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Abandoned Cart List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box" style="overflow: auto;">
                <div class="box-header">
                  <h3 class="box-title">Abandoned Cart List</h3>
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
                <th>Phone</th>
                <th>Product Id</th>
                <th>Product Type</th>
                <th>Total Price</th>
                <th>Case Date Time</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($userCart) > 0)
                    @foreach($userCart as $userCar)
                <tr role="row" class="odd">
                    @foreach($userCar as $k=>$user)

                      @if($k != 1)
                    <tr role="row" class="odd">

                  <td>{{$k+1}}</td>
                  <td><a href="{{ url('admin/users/invoices/'.$user['user']['id'])}}">{{isset($user['user']['user_name'])?$user['user']['user_name']:""}}</td>
                  <td>{{$user['user']['first_name']}} {{$user['user']['last_name']}}</td>
                  <td>{{$user['user']['title']}} </td>
                  <td>{{$user['user']['email']}} </td>
                  <td>{{$user['user']['phone']}} </td>
                  <td>{{isset($user['product']['product_id'])?$user['product']['product_id']:""}} </td>
                  <td>{{$user['cart_product_type']}} </td>
                  <td>{{$user['total']}} </td>
                  <td>{{$user['cart_added_on']}} </td>
                  <td>
                    <select name='status'>
                      <option value="1">Pending</option>
                      <option value="2">Contact Again Later</option>
                      <option value="3">Closed</option>
                      
                    </select>
                    
                  </td>
                  <td>
                    <button>Update</button>
                  </td>
                  </tr>
                  @else
                  <tr role="row" class="odd">

                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>{{isset($user['product']['product_id'])?$user['product']['product_id']:""}} </td>
                  <td> </td>
                  <td>{{$user['total']}} </td>
                  <td> </td>
                  <td>
                    <select name='status'>
                      <option value="1">Pending</option>
                      <option value="2">Contact Again Later</option>
                      <option value="3">Closed</option>
                      
                    </select>
                    
                  </td>
                  <td>
                    <button>Update</button>
                  </td>
                  </tr>
                  @endif
                @endforeach
                  
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
