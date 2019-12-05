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
        Orders List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Orders List</h3>
                </div>

                @include('admin.partials.message')


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        
<th>user_id</th>
<th>txn_id</th>
<th>plan_id</th>
<th>invoice</th>
<th>download_plan_id</th>
<th>download_plan_title</th>

<th>tax</th>
<th>tax_selected</th>
<th>coupon_code</th>
<th>coupon_type</th>
<th>coupon_value</th>
<th>coupon_discount</th>
<th>order_total</th>
<th>order_date</th>
<th>order_status</th>
<th>order_title</th>
<th>order_cancel_status</th>
<th>order_type</th>
<th>order_email</th>

<th>ip</th>
<th>payment_mode</th>
<th>cc_number</th>
<th>cc_expiry_date</th>
<th>job_number</th>
<th>po_detail</th>
<th>po_image</th>
<th>order_comments</th>
<th>bill_firstname</th>
<th>bill_lastname</th>
<th>bill_address1</th>
<th>bill_address2</th>
<th>bill_city</th>
<th>bill_state</th>
<th>bill_zip</th>
<th>bill_country</th>
<th>bill_phone</th>
<th>created</th>
<th>modified</th>
<th>invoice_type</th>
<th>expiry_invoices</th>
<th>deletion_date</th>
<th>invoice_closed</th>
                        
                    </thead>

                    <tbody>
                     @foreach($orders as $orders)
                    <tr>
  <td>{{ $orders['package_id'] }} </td>
  <td>{{ $orders['package_plan'] }} </td>
  <td>{{ $orders['package_name'] }} </td>
  <td>{{ $orders['package_price'] }} </td>
  <td>{{ $orders['package_description'] }} </td>
  <td>{{ $orders['package_products_count'] }} </td>
  <td>{{ $orders['package_type'] }} </td>
  <td>{{  date('Y-m-d',strtotime($orders['package_added_on'])) }} </td>
  <td>{{ $orders['package_expiry'] }} </td>
  <td>{{ $orders['package_permonth_download'] }}</td>
  <td>{{ $orders['package_pcarry_forward'] }}</td>
  <td>  @if($orders['package_status'] =='Active')
  			<a href="{{ url('admin/package/Inactive/'.$orders['package_id']) }}" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         @elseif($packages['package_status'] =='Inactive')
         	<a href="{{ url('admin/package/Active/'.$orders['package_id']) }}" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        @endif
            <a href="{{ url('admin/updatepackage/'.$orders['package_id']) }}" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="{{ url('admin/deletepackage/'.$orders['package_id']) }}" title="Deleate" onclick="return confirm('Are you sure you want to delete this package?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
            <td></td>
            <td></td>
            <td></td>
 </tr>
@endforeach
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        
<th>user_id</th>
<th>txn_id</th>
<th>plan_id</th>
<th>invoice</th>
<th>download_plan_id</th>
<th>download_plan_title</th>

<th>tax</th>
<th>tax_selected</th>
<th>coupon_code</th>
<th>coupon_type</th>
<th>coupon_value</th>
<th>coupon_discount</th>
<th>order_total</th>
<th>order_date</th>
<th>order_status</th>
<th>order_title</th>
<th>order_cancel_status</th>
<th>order_type</th>
<th>order_email</th>

<th>ip</th>
<th>payment_mode</th>
<th>cc_number</th>
<th>cc_expiry_date</th>
<th>job_number</th>
<th>po_detail</th>
<th>po_image</th>
<th>order_comments</th>
<th>bill_firstname</th>
<th>bill_lastname</th>
<th>bill_address1</th>
<th>bill_address2</th>
<th>bill_city</th>
<th>bill_state</th>
<th>bill_zip</th>
<th>bill_country</th>
<th>bill_phone</th>
<th>created</th>
<th>modified</th>
<th>invoice_type</th>
<th>expiry_invoices</th>
<th>deletion_date</th>
<th>invoice_closed</th>
                    </tfoot>
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
