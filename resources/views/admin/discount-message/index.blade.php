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
      Discount Messages List
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Discount Messages List</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary" style="overflow-x:auto;">
          <div class="box-header with-border" style="overflow-x:auto;">
            <h3 class="box-title">Discount Messages List</h3>
          </div>

          @if(session()->has('success'))
          <div class="alert alert-success">
            {{ session()->get('success') }}
          </div>
          @endif
          @if(session()->has('error'))
          <div class="alert alert-danger">
            {{ session()->get('error') }}
          </div>
          @endif

          <table id="discountMessage" class="table table-bordered table-hover">
            <thead>
              <th>Id</th>
              <th>Page Type</th>
              <th>Title</th>
              <th>Description</th>
              <th>Link</th>
              <th>Button Text</th>
              <th>Actions</th>
            </thead>

            <tbody>
              @foreach($discountMessages as $discountMessage)
              <tr>
                <td>{{ $discountMessage['id'] }} </td>
                <td>{{ $discountMessage['page_type'] }} </td>
                <td>{{ $discountMessage['title'] }} </td>
                <td>{{ $discountMessage['description'] }} </td>
                <td>{{ $discountMessage['link'] }} </td>
                <td>{{ $discountMessage['button_text'] }} </td>
                <td> @if($discountMessage['status'] =='1')
                  <a href="{{ url('admin/discountmessagestatus/0/'.$discountMessage['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                  @elseif($discountMessage['status'] =='0')
                  <a href="{{ url('admin/discountmessagestatus/1/'.$discountMessage['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                  @endif

                  <a href="{{ url('admin/editdiscountmessage/'.$discountMessage['id']) }}" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <a href="{{ url('admin/deletediscountmessage/'.$discountMessage['id']) }}" title="Delete" onclick="return confirm('Are you sure you want to delete this discount message?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
  $(function() {
    $('#discountMessage').DataTable();
  })
</script>
@endsection