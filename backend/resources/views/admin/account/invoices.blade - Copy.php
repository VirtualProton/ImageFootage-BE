@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" ng-controller="invoiceController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Quotation/Invoices List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation/Invoices List</li>
      </ol>
    </section>
    <section class="content" ng-co>
      <?php //echo "<pre>"; print_r($account_invoices); die; ?>
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Quotation/Invoices List</h3>
                  <a href="{{ url('admin/quotation/'.$user_id) }}" style="float:right;"><strong>Create Quotation/Proforma Invoice</strong></a>
                </div>
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="box-body">
            <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <thead>
                <tr>
                <th>Sl No</th>
                <th>Trans Id</th>
                <!-- <th>Invoice/Quotation Number</th> -->
                <!-- <th>Email ID</th> -->
                <!-- <th>Expiry Invoices</th> -->
                <th>Inv Date</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Payment Mode</th>
                <th>Transaction Type Subscription</th>
                <!-- <th>Download Quotation</th> -->
                <!-- <th>Download Invoice</th> -->
                <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                    @if(count($account_invoices) > 0)
                    @foreach($account_invoices as $k=>$invioces)
                    @if($invioces['invoice_type']==1)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>
                      @if($invioces['proforma_type']==2)
                        @if($invioces['invoice_url'])
                          <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a><br>
                          <a href="{{$invioces['invoice_url']}}" target="_blank">IN{{$invioces['invoice_name']}}</a>
                        @else
                          IN{{$invioces['invoice_name']}}
                        @endif
                      @else
                       @if($invioces['quotation_url'])
                        <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a>
                        @else
                          Q{{$invioces['invoice_name']}}
                        @endif
                      @endif

                  </td>
                  <!-- <td>{{$invioces['invoice_name']}}</td> -->
                  <!-- <td>{{$invioces['email_id']}}</td> -->
                  <!-- <td>{{$invioces['expiry_invoices']}} Days</td> -->
                    <td>{{$invioces['created']}}</td>
                    <td>{{$invioces['total']}}</td>
                  <td>
                  <select <?php if($invioces['status']==3){ echo "disabled" ; } ?> onchange="changestatus(this,{{$invioces['id']}},{{$invioces['status']}})">
                      <option value="0"  <?php if($invioces['status'] =='0'){ echo "Selected";} ?>>Pending</option>
                      <option value="1" <?php if($invioces['status'] =='1'){ echo "Selected";} ?>>Paid</option>
                      <option value="2" <?php if($invioces['status'] =='2'){ echo "Selected";} ?>>Purched</option>
                      <option value="3"  <?php if($invioces['status'] =='3'){ echo "Selected";} ?>>Cancel</option>
                    </select>
               </td>
               <td>{{$invioces['payment_mode']}}</td>
               <td>
                @if($invioces['invoice_type']==2)
                  Subscription
                @endif
               </td>
                 <!-- <td>
                     @if($invioces['quotation_url'])
                     <a href="{{$invioces['quotation_url']}}" target="_blank">Download</a>
                     @endif
                 </td>
                    <td>
                        @if($invioces['invoice_url'])
                            <a href="{{$invioces['invoice_url']}}" target="_blank">Download</a>
                        @endif
                    </td> -->

               <!-- <td>
                   <?php if($invioces['status']!=3){ ?>
                  <a href="{{ url('admin/edit_quotation/'.$invioces['id']) }}" title="Edit Quotation"><i class="fa fa-check" aria-hidden="true"></i></a> &nbsp;&nbsp;
                  <a href="javascript:void(0);" ng-click="create_invoice({{$invioces['id']}},{{$user_id}})" title="Send Invoice"><i class="fa fa-file-pdf-o " aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;
      }
      }
{{--                  <a href="{{ url('admin/invoice/'.$invioces['id']) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>--}}

                  <?php } ?>
                    <form action="{{ route('accounts.destroy', $invioces['id']) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button  onclick="return confirm('Do You want to remove ?')"><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form> -->
                  <!-- </td> --> 
                </tr>
                @endif
                @endforeach
                @endif

              </table>


              <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <thead>
                <tr>
                <th>Sl No</th>
                <th>Trans Id</th>
                <!-- <th>Invoice/Quotation Number</th> -->
                <!-- <th>Email ID</th> -->
                <!-- <th>Expiry Invoices</th> -->
                <th>Inv Date</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Payment Mode</th>
                <th>Transaction Type Download</th>
                <!-- <th>Download Quotation</th> -->
                <!-- <th>Download Invoice</th> -->
                <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                    @if(count($account_invoices) > 0)
                    @foreach($account_invoices as $k=>$invioces)
                    @if($invioces['invoice_type']==2)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>
                      @if($invioces['proforma_type']==2)
                        @if($invioces['invoice_url'])
                          <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a><br>
                          <a href="{{$invioces['invoice_url']}}" target="_blank">IN{{$invioces['invoice_name']}}</a>
                        @else
                          IN{{$invioces['invoice_name']}}
                        @endif
                      @else
                       @if($invioces['quotation_url'])
                        <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a>
                        @else
                          Q{{$invioces['invoice_name']}}
                        @endif
                      @endif

                  </td>
                  <!-- <td>{{$invioces['invoice_name']}}</td> -->
                  <!-- <td>{{$invioces['email_id']}}</td> -->
                  <!-- <td>{{$invioces['expiry_invoices']}} Days</td> -->
                    <td>{{$invioces['created']}}</td>
                    <td>{{$invioces['total']}}</td>
                  <td>
                  <select <?php if($invioces['status']==3){ echo "disabled" ; } ?> onchange="changestatus(this,{{$invioces['id']}},{{$invioces['status']}})">
                      <option value="0"  <?php if($invioces['status'] =='0'){ echo "Selected";} ?>>Pending</option>
                      <option value="1" <?php if($invioces['status'] =='1'){ echo "Selected";} ?>>Paid</option>
                      <option value="2" <?php if($invioces['status'] =='2'){ echo "Selected";} ?>>Purched</option>
                      <option value="3"  <?php if($invioces['status'] =='3'){ echo "Selected";} ?>>Cancel</option>
                    </select>
               </td>
               <td>{{$invioces['payment_mode']}}</td>
               <td>
                @if($invioces['invoice_type']==1)
                  Download
                @endif
               </td>
                 <!-- <td>
                     @if($invioces['quotation_url'])
                     <a href="{{$invioces['quotation_url']}}" target="_blank">Download</a>
                     @endif
                 </td>
                    <td>
                        @if($invioces['invoice_url'])
                            <a href="{{$invioces['invoice_url']}}" target="_blank">Download</a>
                        @endif
                    </td> -->

               <!-- <td>
                   <?php if($invioces['status']!=3){ ?>
                  <a href="{{ url('admin/edit_quotation/'.$invioces['id']) }}" title="Edit Quotation"><i class="fa fa-check" aria-hidden="true"></i></a> &nbsp;&nbsp;
                  <a href="javascript:void(0);" ng-click="create_invoice({{$invioces['id']}},{{$user_id}})" title="Send Invoice"><i class="fa fa-file-pdf-o " aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;
      }
      }
{{--                  <a href="{{ url('admin/invoice/'.$invioces['id']) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>--}}

                  <?php } ?>
                    <form action="{{ route('accounts.destroy', $invioces['id']) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button  onclick="return confirm('Do You want to remove ?')"><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form> -->
                  <!-- </td> --> 
                </tr>
                @endif
                @endforeach
                @endif

              </table>

              <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <thead>
                <tr>
                <th>Sl No</th>
                <th>Trans Id</th>
                <!-- <th>Invoice/Quotation Number</th> -->
                <!-- <th>Email ID</th> -->
                <!-- <th>Expiry Invoices</th> -->
                <th>Inv Date</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Payment Mode</th>
                <th>Transaction Type Custom</th>
                <!-- <th>Download Quotation</th> -->
                <!-- <th>Download Invoice</th> -->
                <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                    @if(count($account_invoices) > 0)
                    @foreach($account_invoices as $k=>$invioces)
                    @if($invioces['invoice_type']==3)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>
                      @if($invioces['proforma_type']==2)
                        @if($invioces['invoice_url'])
                          <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a><br>
                          <a href="{{$invioces['invoice_url']}}" target="_blank">IN{{$invioces['invoice_name']}}</a>
                        @else
                          IN{{$invioces['invoice_name']}}
                        @endif
                      @else
                       @if($invioces['quotation_url'])
                        <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a>
                        @else
                          Q{{$invioces['invoice_name']}}
                        @endif
                      @endif

                  </td>
                  <!-- <td>{{$invioces['invoice_name']}}</td> -->
                  <!-- <td>{{$invioces['email_id']}}</td> -->
                  <!-- <td>{{$invioces['expiry_invoices']}} Days</td> -->
                    <td>{{$invioces['created']}}</td>
                    <td>{{$invioces['total']}}</td>
                  <td>
                  <select <?php if($invioces['status']==3){ echo "disabled" ; } ?> onchange="changestatus(this,{{$invioces['id']}},{{$invioces['status']}})">
                      <option value="0"  <?php if($invioces['status'] =='0'){ echo "Selected";} ?>>Pending</option>
                      <option value="1" <?php if($invioces['status'] =='1'){ echo "Selected";} ?>>Paid</option>
                      <option value="2" <?php if($invioces['status'] =='2'){ echo "Selected";} ?>>Purched</option>
                      <option value="3"  <?php if($invioces['status'] =='3'){ echo "Selected";} ?>>Cancel</option>
                    </select>
               </td>
               <td>{{$invioces['payment_mode']}}</td>
               <td>
                @if($invioces['invoice_type']==3)
                  Custom
                @endif
               </td>
                 <!-- <td>
                     @if($invioces['quotation_url'])
                     <a href="{{$invioces['quotation_url']}}" target="_blank">Download</a>
                     @endif
                 </td>
                    <td>
                        @if($invioces['invoice_url'])
                            <a href="{{$invioces['invoice_url']}}" target="_blank">Download</a>
                        @endif
                    </td> -->

               <!-- <td>
                   <?php if($invioces['status']!=3){ ?>
                  <a href="{{ url('admin/edit_quotation/'.$invioces['id']) }}" title="Edit Quotation"><i class="fa fa-check" aria-hidden="true"></i></a> &nbsp;&nbsp;
                  <a href="javascript:void(0);" ng-click="create_invoice({{$invioces['id']}},{{$user_id}})" title="Send Invoice"><i class="fa fa-file-pdf-o " aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;
      }
      }
{{--                  <a href="{{ url('admin/invoice/'.$invioces['id']) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>--}}

                  <?php } ?>
                    <form action="{{ route('accounts.destroy', $invioces['id']) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button  onclick="return confirm('Do You want to remove ?')"><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form> -->
                  <!-- </td> --> 
                </tr>
                @endif
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
    $('.account').DataTable({
        paging: false
    });
 })

     function changestatus(statust,quotation_id,oldstatus){
         event.preventDefault();
         if(confirm('Do you want to change the status of invoice/quotation')===true) {
             $('#loading').show();
             $.ajax({
                 type: "POST",
                 data: {quotation_id: quotation_id, status: statust.value},
                 url: "{{ url('admin/change_invoice_status')}}",
                 success: function (result) {
                     $('#loading').hide();
                     console.log(result);
                     if (result.resp.statuscode == '1') {
                         alert(result.resp.statusdesc);
                     } else {
                         alert(result.resp.statusdesc);
                     }
                     window.location.reload();
                 }
             });
         }else{
             statust.value = oldstatus;
            return false;
         }
     }
    </script>

@stop
