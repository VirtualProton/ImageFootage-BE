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
        Module List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Module List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Module List</h3>
                </div>

                @include('admin.partials.message')


                <table id="module" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Module Name</th>
                        <th>URL</th>
                        <th>Parent Module Name</th>
                        <th>Actions</th>
                    </thead>

                  <tbody>
                        @foreach($moduleslist as $module)
                      <tr>
                        <td>{{ $module['id'] }} </td>
                        <td>{{ $module['module_name'] }} </td>
                        <td>{{ $module['url'] }} </td>
                        <td> {{ isset($module->parentmodules) ? $module->parentmodules->module_name : "Parent" }}</td>
                        <td>  @if($module['status'] =='A')
                            <a href="{{ url('admin/modulestatus/I/'.$module['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                            @elseif($module['status'] =='I')
                              <a href="{{ url('admin/modulestatus/A/'.$module['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                            @endif

                            <a href="{{ url('admin/updatemodule/'.$module['id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <a href="{{ url('admin/deletemodule/'.$module['id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this model?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                   </table>
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
    $('#module').DataTable();
 })
    </script>
  @endsection
