@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PromoCodes List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">PromoCodes List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">PromoCodes List</h3>
                </div>
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="box-body">
            <table id="promo-codes" class="table table-bordered table-striped dataTable">
                <thead>
                    <!-- <tr class="col-sm-12"> -->
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Max Usage</th>
                        <th>Total Applied Code</th>
                        <th>Discount</th>
                        <th>Valid Upto Type</th>
                        <th>Valid Start Date</th>
                        <th>Valid Till Date</th>
                        <th>Status</th>
                        <th>Promo Will Use</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($promocodes) > 0)
                    @foreach($promocodes as $k => $promocode)
                    <tr role="row">
                          <td>{{$k+1}}</td>
                          <td>{{$promocode['name']}}</td>
                          <td>{{$promocode['type']}}</td>
                          <td>{{$promocode['max_usage']}}</td>
                          <td>{{$promocode['total_applied_code']}}</td>
                          <td>{{$promocode['discount']}}</td>
                          <td>{{$promocode['valid_upto_type']}}</td>
                          <td>{{$promocode['valid_start_date'] ?? '-'}}</td>
                          <td>{{$promocode['valid_till_date']}}</td>
                          <td><?php echo ($promocode['status']=='1'?"Active":"Inactive"); ?></td>
                          <td><?php if ($promocode['will_apply_by'] == '1') {
                            echo "Frontend";  
                          } else if ($promocode['will_apply_by'] == '2') {
                            echo "Backend";
                          } else {
                            echo "All";
                          }
                          ?></td>
                          <td>
                            @if($promocode['status'] =='1')
                              <a href="{{ url('admin/promo-codes/status/0/'.$promocode['id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                            @elseif($promocode['status'] =='0')
                              <a href="{{ url('admin/promo-codes/status/1/'.$promocode['id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                            @endif
                            <a href="{{ URL::to('admin/promo-codes/'.$promocode['id'].'/edit') }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                          </td>
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
    $(function () {
    $('#promo-codes').DataTable();
 })
    </script>

@stop
