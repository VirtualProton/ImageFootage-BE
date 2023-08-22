@extends('admin.layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editorial List
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin/Editorial List</li>
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
                        <table id="editorial" class="table table-bordered table-striped dataTable">
                            <thead>
                                <!-- <tr class="col-sm-12"> -->
                                <tr>
                                    <th>SN</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Product Id</th>
                                    <th>No Of Selected Images</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($editoriallist) > 0)
                                @foreach($editoriallist as $k=>$editorial)
                                <tr role="row">

                                    <td>{{$k+1}}</td>
                                    <td>{{ !empty($editorial['title']) ? $editorial['title'] : '-' }}</td>
                                    <td>{{ !empty($editorial['type']) ? $editorial['type'] : '-' }}</td>
                                    <td>{{ !empty($editorial['main_image_id']) ? $editorial['main_image_id'] : '-' }}</td>
                                    <td>{{count(explode(',', $editorial['selected_values']))}} </td>
                                    <td><?php echo ($editorial['status'] == '1' ? "Active" : "Inactive"); ?></td>
                                    <td><?php echo date('D, d M, Y', strtotime($editorial['created_at'])) ?></td>
                                    <td><?php echo date('D, d M, Y', strtotime($editorial['updated_at'])) ?></td>
                                    <td></td>
                                </tr>
                                @endforeach
                                @endif

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
    $(function() {
        $('#editorial').DataTable();
    })
</script>

@stop