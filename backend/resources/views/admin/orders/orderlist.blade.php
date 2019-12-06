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
  <td>{{ $orders['id'] }} </td>
  <td>{{ $orders['user_id'] }} </td>
  <td>{{ $orders['txn_id'] }} </td>
  <td>{{ $orders['plan_id'] }} </td>
  <td>{{ $orders['invoice'] }} </td>
  <td>{{ $orders['download_plan_id'] }} </td>
  <td>{{ $orders['download_plan_title'] }} </td>
  <td>{{ $orders['tax'] }} </td>
  <td>{{ $orders['tax_selected'] }} </td>
  <td>{{ $orders['coupon_code'] }}</td>
  <td>{{ $orders['coupon_type'] }}</td>
  <td>{{ $orders['coupon_value'] }}</td>
  <td>{{ $orders['coupon_discount'] }}</td>
  <td>{{ $orders['order_total'] }}</td>
  <td>{{  date('Y-m-d',strtotime($orders['order_date'])) }} </td>
  <td>{{ $orders['order_status'] }}</td>
  <td>{{ $orders['order_title'] }}</td>
  <td>{{ $orders['order_cancel_status'] }}</td>
  <td>{{ $orders['order_type'] }}</td>
  
  
  
  <td>{{ $orders['order_email'] }}</td>
  <td>{{ $orders['ip'] }}</td>
  <td>{{ $orders['payment_mode'] }}</td>
  <td>{{ $orders['cc_number'] }}</td>
  
  
   <td>{{ $orders['cc_expiry_date'] }}</td>
    <td>{{ $orders['job_number'] }}</td>
     <td>{{ $orders['po_detail'] }}</td>
      <td>{{ $orders['po_image'] }}</td>
  
  <td>{{ $orders['order_comments'] }}</td>
  <td>{{ $orders['bill_firstname'] }}</td>
  <td>{{ $orders['bill_lastname'] }}</td>
  <td>{{ $orders['bill_address1'] }}</td>
   <td>{{ $orders['bill_address2'] }}</td>
    <td>{{ $orders['bill_city'] }}</td>
     <td>{{ $orders['bill_state'] }}</td>
     
     <td>{{ $orders['bill_zip'] }}</td>
     <td>{{ $orders['bill_country'] }}</td>
     <td>{{ $orders['bill_phone'] }}</td>
     <td>{{ $orders['created'] }}</td>
     
     
     
     
     <td>{{ $orders['modified'] }}</td>
     <td>{{ $orders['invoice_type'] }}</td>
     <td>{{ $orders['expiry_invoices'] }}</td>
     <td>{{ $orders['deletion_date'] }}</td>
     <td>{{ $orders['invoice_closed'] }}</td>
  
  
  
  
  
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
