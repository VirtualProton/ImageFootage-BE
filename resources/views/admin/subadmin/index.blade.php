@extends('admin.layouts.default')

@section('content')

<div class="content-wrapper">
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Admin/Agent List</h3>
            </div>
            @include('admin.partials.message')

            <!-- /.box-header -->
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="" style="width: 213.247px;">Name</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="width: 262.135px;">Email</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="width: 232.135px;">Mobile</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="width: 183.247px;">Department</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="width: 134.236px;">Role</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="width: 134.236px;">Created Date</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="width: 134.236px;">Status</th>
                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="width: 134.236px;">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($agentlist) > 0)
                    @foreach($agentlist as $agent)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{$agent['name']}}</td>
                  <td>{{$agent['email']}}</td>
                  <td>{{$agent['mobile']}}</td>
                  <td>{{$agent['department']['department']}}</td>
                  <td>{{$agent['role']['role']}}</td>
                  <td><?php echo date('D, d M, Y',strtotime($agent['created_at'])) ?></td>
                  <td><?php echo ($agent['created_at']=='A'?"Active":"Inactive"); ?></td>
                  <td><button href="{{ URL::to('admin/subadmin/edit/'.$agent['id']) }}"><i class="fa fa-edit" aria-hidden="true"></i></button> &nbsp; &nbsp;
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
              </div>
              </div>
            <!-- /.box-body -->
          </div>
<div>
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
    $('#example1').DataTable();
 })
    </script>

@stop
