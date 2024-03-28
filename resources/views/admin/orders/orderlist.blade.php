@extends('admin.layouts.default')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" ng-controller="ordersController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content" >
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Orders List</h3>
                </div>
     @include('admin.partials.message')
                <table id="example2" class="table table-bordered table-striped dataTable " class="col-sm-12">
                	<thead>
<th>User Name</th>
<th>Invoice</th>
<th>Subtotal</th>
<th>Tax</th>
<th>Total</th>
<th>Order Date</th>
<th>Payment Status</th>
<th>Payment Provider</th>
<th>Bill Full Name</th>
<th>Billing Address</th>
{{-- <th>Bill city</th>
<th>Bill State</th> --}}
<!-- <th>Billing Country</th> -->
<th>Billing Zip</th>
 <th>Invoice</th> 
 <th>Action</th> 
</thead>
 <tbody>
@php
  //  dd($orderlists[29]);
@endphp 
@foreach($orderlists as $orders)
@php //dd($orders['city']['name']);@endphp 
 <!-- <tr ng-if="orderslist" ng-repeat="orders in orderslist"> -->
 <tr>
     <td>
        @if(isset($orders['user']['id']))
            <a href="{{ url('admin/users/invoices/'.$orders['user']['id'])}}" target="_blank">{{$orders['user']['user_name']}}</a>
        @endif
    </td>
     <td><a target="_blank" href="{{$orders['invoice']}}" ng-show="{{$orders['invoice']}}">Download</a></td>
     <td>{{$orders['order_total'] - $orders['tax'] }}</td>
     <td>{{$orders['tax']}}</td>
     <td>{{$orders['order_total']}}</td>
     <td>{{$orders['created_at']}}</td>
     <td>{{$orders['order_status']}}</td>
     <td>{{$orders['paymentgatway']}}</td>

     <td>{{$orders['bill_firstname']}} {{$orders['bill_lastname']}}</td>
     <td>{{$orders['bill_address1']}}</td>
    <?php /*<td>{{$orders['state']['state']}}</td> 
    <td> @php if($orders['city']['name'] != null ) {{$orders['city']['name']}}</td>

     <!-- <td>{{$orders['country']['name']}}</td> -->
     <td>{{$orders['bill_zip']}}</td>
     <td><a target="_blank" href="<%orders['invoice']" ng-show="orders['invoice']">Download</a></td> 
     <td><a data-toggle="modal"  ng-click="showProduct(orders['items'])">Details</a></td> 
 </tr>
 <!-- <tr>
     <td colspan="15" ng-if="!orderslist" class="text-center">No Orders Found !!</td>
 </tr> -->

@endforeach
</tbody>
 </table>
              </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
     <div class="modal fade" id="modal-default">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span></button>
                     <h4 class="modal-title">Images/Footages Orders Details</h4>
                 </div>
                 <div class="modal-body">
                     <table class="table table-bordered table-striped">
                         <thead>
                         <th>Type</th>
                         <th>Product Image/Footage</th>
                         <th>Product ID</th>
                         <th>Product Name</th>
                         <th>Size</th>
                         <th>Price</th>
                         <thead>
                         <tbody>
                            @foreach($orders['items'] as $item)
                             <tr ng-repeat="item in products">
                                                         <td ng-show="item['product_web']=='2'"> Image </td>
                                                         <td ng-show="item['product_web']=='3'">Footage</td>
                                                         <td ng-show="item['product_web']=='2'">
                                                             <img src="{{$item['product_thumb']}}" width="150" height="100">
                                                         </td>
                                                         <td ng-show="item['product_web']=='3'">
                                                             <video controls controlsList="nodownload" onmouseover="this.play()"
                                                                                                       onmouseout="this.load()" width="150" height="150">
                                                                 <source src="{{$item['product_thumb']}}"
                                                                         type="video/mp4">
                                                                 Your browser does not support the video tag.
                                                             </video>

                                                         </td>
                                                         <td>{{$item['product_id']}} </td>
                                                         <td>{{$item['product_name']}} </td>
                                                         <td>{{$item['standard_size']}} </td>
                                                         <td>{{$item['standard_price']}}</td>
                                                     </tr>
                                                     @endforeach
                          </tbody>
                     </table>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                 </div>
             </div>
             <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
     </div>
  </div>

  <!-- /.content-wrapper -->

  @endsection

  @section('scripts')
  <script>
   $(function () { 
     $('#example2').DataTable();
   });

</script>
  @endsection
