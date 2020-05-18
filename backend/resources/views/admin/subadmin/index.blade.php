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
        <li class="active">Accounts</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Admin User List</h3>
                </div>
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="box-body">
            <table id="subadmin" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Department</th>
                <th>Role</th>
                <th>Created Date</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($agentlist) > 0)
                    @foreach($agentlist as $k=>$agent)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>{{$agent['name']}}</td>
                  <td>{{$agent['email']}}</td>
                  <td>{{$agent['mobile']}}</td>
                  <td>{{$agent['department']['department']}}</td>
                  <td>{{$agent['role']['role']}}</td>
                  <td><?php echo date('D, d M, Y',strtotime($agent['created_at'])) ?></td>
                  <td><?php echo ($agent['admin_status']=='A'?"Active":"Inactive"); ?></td>

                  <td>
                  @if($agent['admin_status'] =='A')
                    <a href="{{ url('admin/subadmin/status/I/'.$agent['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                  @elseif($agent['admin_status'] =='I')
                    <a href="{{ url('admin/subadmin/status/A/'.$agent['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                  @endif
                  <a href="{{ URL::to('admin/subadmin/'.$agent['id'].'/edit') }}"><i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; &nbsp;

                  <form action="{{ route('subadmin.destroy', $agent['id']) }}" method="POST">
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
    $('#subadmin').DataTable();
 })
    </script>

@stop
