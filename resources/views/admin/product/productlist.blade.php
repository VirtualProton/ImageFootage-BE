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
      Products List
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products List</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary" style="overflow-x:auto;">
          <div class="box-header with-border" style="overflow-x:auto;">
            <h3 class="box-title">Products List</h3>
          </div>

          @include('admin.partials.message')

          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <th>Sl. No</th>
              <th>Product Id</th>
              <th>Product Owner</th>
              <th>Category</th>
              <th>License Type</th>
              <th>Keywords</th>
              <th>Type</th>
              <th>Product Type</th>
              <th>Added On</th>
            </thead>

            <tbody>
              @foreach($products as $product)
              <tr>
                <td>{{ $product['id'] }}</td>
                <td><a href="{{ url('admin/viewproduct/'.$product['id']) }}">{{ $product['product_id'] }}</a> </td>
                <td>{{ $product['product_owner'] }}</td>
                <td>{{ $product['category_name'] }} </td>
                <td>{{ $product['product_vertical'] }} </td>
                <td><span style="width:300px;display: flex;overflow:auto;">{{ $product['product_keywords'] }}</span> </td>
                <td>{{ $product['product_main_type'] }} </td>
                <td>

                  @if($product['product_main_type'] =='Image')
                  <img src="{{ $product['product_main_image']}}" alt="User Image" width="100">
                  @elseif($product['product_main_type'] =='Footage')
                  <video width="150" height="120" controls>
                    <source src="{{$product['product_main_image'] }}" type="video/mp4">
                    <source src="{{ $product['product_main_image'] }}" type="video/ogg">
                    <source src="{{ $product['product_main_image'] }}" type="video/flv">
                    Your browser does not support the video tag.
                  </video>
                  @elseif($product['product_main_type'] =='Editorial')
                  <img src="{{ $product['image_name']}}" alt="User Image" width="100">

                  @endif

                </td>
                <td>{{ date('Y-m-d',strtotime($product['product_added_on'])) }} </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{ $products->links() }}
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<script>
  $(function() {});
</script>
<script>
  $(function() {
    $('#example2').DataTable();
  });
  $('.reset_cont_pass').click(function() {
    var cont_id = $(this).attr('cont_id');
    $.ajax({
      type: "POST",
      data: {},
      url: "{{ url('admin/request_for_contributorpass/')}}/" + cont_id + "",
      success: function(msg) {
        var data = msg.trim();
        if (data == 'success') {
          alert('Password request rised successfully.');
        } else {
          alert('Some problem occured.');
        }
      }
    });
  });
</script>
@endsection