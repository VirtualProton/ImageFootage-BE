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
        Package List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Package List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Package List</h3>
                </div>

                @include('admin.partials.message')


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Title</th>
                        <th>URL </th>
                        <th>Description</th>
                        <th>Keywords</th>
                        <th>Slug</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     @foreach($pages as $page)
                    <tr>
  <td>{{ $page['page_id'] }} </td>
  <td>{{ $page['page_title'] }} </td>
  <td>{{ $page['page_url'] }} </td>
  <td>{{ $page['page_meta_desc'] }} </td>
  <td>{{ $page['page_meta_keywords'] }} </td>
  <td>{{ $page['page_slug'] ?? '' }} </td>
  <td>{{  date('Y-m-d',strtotime($page['page_added_on'])) }} </td>
  <td>  @if($page['image_status'] =='Active')
  			<a href="{{ url('admin/staticpages/Inactive/'.$page['page_id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         @elseif($page['image_status'] =='Inactive')
         	<a href="{{ url('admin/staticpages/Active/'.$page['page_id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        @endif
            <a href="{{ url('admin/updatestaticpage/'.$page['page_id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deletestaticpage/'.$page['page_id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this static page?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
@endforeach
                    </tbody>
                    {{-- <tfoot>
                       <th>Id</th>
                        <th>Title</th>
                        <th>URL </th>
                        <th>Description</th>
                        <th>Keywords</th>
                        <th>Content</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </tfoot> --}}
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

    $('#example2').DataTable(/*{
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    }*/);
  });
</script>
  @endsection
