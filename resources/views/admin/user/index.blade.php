@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Admin/Agent List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin/Agent List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Admin List</h3>
                </div>
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="box-body">
            <table id="account" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Global Region</th>
                <th>Domestic Region</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($accountlist) > 0)
                    @foreach($accountlist as $k=>$account)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>{{$account['account_name']}}</td>
                  <td>{{$account['email']}}</td>
                  <td>{{$account['phone']}}</td>
                  <td>{{$account['global_region']}}</td>
                  <td>{{$account['domestic_region']}}</td>
                  <td><?php echo date('D, d M, Y',strtotime($account['created_at'])) ?></td>
                  <td><?php echo date('D, d M, Y',strtotime($account['updated_at'])) ?></td>
                  <td><?php echo ($account['status']=='1'?"Active":"Inactive"); ?></td>
                  <td>
                  @if($account['status'] =='1')
                    <a href="{{ url('admin/accounts/status/0/'.$account['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                  @elseif($account['status'] =='0')
                    <a href="{{ url('admin/accounts/status/1/'.$account['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                  @endif
                  <a href="{{ URL::to('admin/accounts/'.$account['id'].'/edit') }}"><i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; &nbsp;

                  <form action="{{ route('accounts.destroy', $account['id']) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button  onclick="return confirm('Do You want to remove ?')"><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form>
                  </td>
                </tr>
                @endforeach
                @endif

              </table>
              </table>
              </div>
            </div>
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
    $('#account').DataTable();
 })
    </script>

@stop
